<?php

namespace App\Http\Controllers\Gateway;

use App\Models\User;
use App\Models\Order;
use App\Models\Deposit;
use App\Models\Services;
use App\Lib\FormProcessor;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\GatewayCurrency;
use App\Models\AdminNotification;
use App\Models\BrandPackageOrder;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\User\OrderController;

class PaymentController extends Controller
{

    public function deposit()
    {
        $gatewayCurrency = GatewayCurrency::whereHas('method', function ($gate) {
            $gate->where('status', 1);
        })->with('method')->orderby('method_code')->get();
        $pageTitle = 'Deposit Methods';
        return view($this->activeTemplate . 'user.payment.deposit', compact('gatewayCurrency', 'pageTitle'));
    }

    public function depositInsert(Request $request)
    {

        if($request->gateway == 'balance'){
            $user = auth()->user();
            // user balance check
            if($user->balance < $request->amount){
                $notify[] = ["error", 'Insufficient balance. Please deposit and try again'];
                return back()->withNotify($notify);
            }

            // service order insert
            $serviceOrderData = Session::get('serviceOrder');
            if(@$serviceOrderData){
                $orderController = new OrderController();
                $serviceOrder  = $orderController->serviceOrderInsert($serviceOrderData,0);
                Session::forget('serviceOrder');
            }

            // brandPackage order insert
            $orderData = Session::get('brandPackageOrder');
            if (@$orderData) {
                $orderController = new OrderController();
                $bpOrder  = $orderController->bPOrderInsert($orderData,0);
                Session::forget('brandPackageOrder');
            }

            // less user balance
            $user->balance -= $serviceOrder->price ?? $bpOrder->price;
            $user->save();

            $trx = getTrx();
            $transaction                =   new Transaction();
            $transaction->user_id       =   $user->id;
            $transaction->amount        =   $serviceOrder->price ?? $bpOrder->price;
            $transaction->post_balance  =   $user->balance;
            $transaction->charge        =   0;
            $transaction->trx_type      =   '-';
            $transaction->details       =   'Order Place';
            $transaction->trx           =   $trx;
            $transaction->remark        =   'Order Place';
            $transaction->save();

            $adminNotification = new AdminNotification();
            $adminNotification->user_id = $user->id;
            $adminNotification->title = $serviceOrder->order_no ?? $bpOrder->name.'Order pending from '.$user->username;
            $adminNotification->click_url = urlPath('admin.users.detail',$user->id);
            $adminNotification->save();

            if(isset($serviceOrder)){
                notify($user, 'PENDING_ORDER', [
                    'service_name'  => $serviceOrder->service->name,
                    'username' => $serviceOrder->user->username,
                    'price' => $serviceOrder->price,
                ]);
            }

            if(isset($bpOrder)){
                notify($user, 'PENDING_ORDER', [
                    'service_name'  => $bpOrder->name,
                    'username' => $bpOrder->user->username,
                    'price' => $bpOrder->price,
                ]);
            }

            $notify[] = ['success', 'Order has been created successfully'];
            return to_route('home')->withNotify($notify);
        }

            $request->validate([
                'amount' => 'required|numeric|gt:0',
                'method_code' => 'required',
                'currency' => 'required',
            ]);

        $user = auth()->user();
        // service order insert
        $serviceOrderData = Session::get('serviceOrder');
        if(@$serviceOrderData){
            $orderController = new OrderController();
            $serviceOrder  = $orderController->serviceOrderInsert($serviceOrderData);
            Session::forget('serviceOrder');
        }

        // brandPackage order insert
        $orderData = Session::get('brandPackageOrder');
        if (@$orderData) {
            $orderController = new OrderController();
            $bpOrder  = $orderController->bPOrderInsert($orderData);
            Session::forget('brandPackageOrder');
        }

        $gate = GatewayCurrency::whereHas('method', function ($gate) {
            $gate->where('status', 1);
        })->where('method_code', $request->method_code)->where('currency', $request->currency)->first();

        if (!$gate) {
            $notify[] = ['error', 'Invalid gateway'];
            return back()->withNotify($notify);
        }

        if ($gate->min_amount > $request->amount || $gate->max_amount < $request->amount) {
            $notify[] = ['error', 'Please follow deposit limit'];
            return back()->withNotify($notify);
        }

        $charge = $gate->fixed_charge + ($request->amount * $gate->percent_charge / 100);
        $payable = $request->amount + $charge;
        $final_amo = $payable * $gate->rate;

        $data = new Deposit();
        $data->user_id = $user->id;
        $data->method_code = $gate->method_code;
        $data->method_currency = strtoupper($gate->currency);
        $data->amount = $request->amount;
        if(isset($serviceOrder->id) && $serviceOrder->id !== ''){
            $data->order_id = $serviceOrder->id;
        }
        if(isset($bpOrder->id) && $bpOrder->id !='' ){
            $data->brand_package_order_id = $bpOrder->id;
        }
        $data->amount = $request->amount;
        $data->charge = $charge;
        $data->rate = $gate->rate;
        $data->final_amo = $final_amo;
        $data->btc_amo = 0;
        $data->btc_wallet = "";
        $data->trx = getTrx();
        $data->try = 0;
        $data->status = 0;
        $data->save();
        session()->put('Track', $data->trx);
        return to_route('user.deposit.confirm');
    }

    public function appDepositConfirm($hash)
    {
        try {
            $id = decrypt($hash);
        } catch (\Exception $ex) {
            return "Sorry, invalid URL.";
        }
        $data = Deposit::where('id', $id)->where('status', 0)->orderBy('id', 'DESC')->firstOrFail();
        $user = User::findOrFail($data->user_id);
        auth()->login($user);
        session()->put('Track', $data->trx);
        return to_route('user.deposit.confirm');
    }

    public function depositConfirm()
    {
        $track = session()->get('Track');
        $deposit = Deposit::where('trx', $track)->where('status',0)->orderBy('id', 'DESC')->with('gateway')->firstOrFail();

        if ($deposit->method_code >= 1000) {
            return to_route('user.deposit.manual.confirm');
        }


        $dirName = $deposit->gateway->alias;
        $new = __NAMESPACE__ . '\\' . $dirName . '\\ProcessController';

        $data = $new::process($deposit);
        $data = json_decode($data);


        if (isset($data->error)) {
            $notify[] = ['error', $data->message];
            return to_route(gatewayRedirectUrl())->withNotify($notify);
        }
        if (isset($data->redirect)) {
            return redirect($data->redirect_url);
        }

        // for Stripe V3
        if(@$data->session){
            $deposit->btc_wallet = $data->session->id;
            $deposit->save();
        }

        $pageTitle = 'Payment Confirm';
        return view($this->activeTemplate . $data->view, compact('data', 'pageTitle', 'deposit'));
    }

    public static function userDataUpdate($deposit,$isManual = null)
    {
        if ($deposit->status == 0 || $deposit->status == 2) {
            $deposit->status = 1;
            $deposit->save();

            $user = User::find($deposit->user_id);
            // deposit time user balance add
            if (!isset($deposit->order_id) && !isset($deposit->brand_package_order_id)) {
                $user->balance += $deposit->amount;
                $user->save();
            }

            $transaction = new Transaction();
            $transaction->user_id = $deposit->user_id;
            $transaction->amount = $deposit->amount;
            $transaction->post_balance = $user->balance;
            $transaction->charge = $deposit->charge;
            $transaction->trx_type = '+';
            $transaction->details = 'Deposit Via ' . $deposit->gatewayCurrency()->name;
            $transaction->trx = $deposit->trx;
            $transaction->remark = 'deposit';
            $transaction->save();

            // service order data update
            if(isset($deposit->order_id)){

                $order = Order::findOrFail($deposit->order_id);
                $order->status = 0;
                $order->save();

                $adminNotification = new AdminNotification();
                $adminNotification->user_id = $user->id;
                $adminNotification->title = $order->order_no.'Order pending from '.$user->username;
                $adminNotification->click_url = urlPath('admin.users.detail',$user->id);
                $adminNotification->save();

                notify($user, 'PENDING_ORDER', [
                    'service_name'  => $order->service->name,
                    'username' => $order->user->username,
                    'price' => $order->price,
                ]);
            }

            // brand package order data update
            if(isset($deposit->brand_package_order_id)){

                $brandPackageOrder = BrandPackageOrder::findOrFail($deposit->brand_package_order_id);
                $brandPackageOrder->status = 0 ;
                $brandPackageOrder->save();

                $adminNotification = new AdminNotification();
                $adminNotification->user_id = $user->id;
                $adminNotification->title = $brandPackageOrder->name.'Order pending from '.$user->username;
                $adminNotification->click_url = urlPath('admin.users.detail',$user->id);
                $adminNotification->save();

                notify($user, 'PENDING_ORDER', [
                    'service_name'  => $brandPackageOrder->name,
                    'username' => $brandPackageOrder->user->username,
                    'price' => $brandPackageOrder->price,
                ]);
            }

            if (!$isManual) {
                $adminNotification = new AdminNotification();
                $adminNotification->user_id = $user->id;
                $adminNotification->title = 'Deposit successful via '.$deposit->gatewayCurrency()->name;
                $adminNotification->click_url = urlPath('admin.deposit.successful');
                $adminNotification->save();
            }

            notify($user, $isManual ? 'DEPOSIT_APPROVE' : 'DEPOSIT_COMPLETE', [
                'method_name' => $deposit->gatewayCurrency()->name,
                'method_currency' => $deposit->method_currency,
                'method_amount' => showAmount($deposit->final_amo),
                'amount' => showAmount($deposit->amount),
                'charge' => showAmount($deposit->charge),
                'rate' => showAmount($deposit->rate),
                'trx' => $deposit->trx,
                'post_balance' => showAmount($user->balance)
            ]);


        }
    }

    public function manualDepositConfirm()
    {
        $track = session()->get('Track');
        $data = Deposit::with('gateway')->where('status', 0)->where('trx', $track)->first();
        if (!$data) {
            return to_route(gatewayRedirectUrl());
        }
        if ($data->method_code > 999) {

            $pageTitle = 'Deposit Confirm';
            $method = $data->gatewayCurrency();
            $gateway = $method->method;
            return view($this->activeTemplate . 'user.payment.manual', compact('data', 'pageTitle', 'method','gateway'));
        }
        abort(404);
    }

    public function manualDepositUpdate(Request $request)
    {
        $track = session()->get('Track');
        $data = Deposit::with('gateway')->where('status', 0)->where('trx', $track)->first();
        if (!$data) {
            return to_route(gatewayRedirectUrl());
        }
        $gatewayCurrency = $data->gatewayCurrency();
        $gateway = $gatewayCurrency->method;
        $formData = $gateway->form->form_data;

        $formProcessor = new FormProcessor();
        $validationRule = $formProcessor->valueValidation($formData);
        $request->validate($validationRule);
        $userData = $formProcessor->processFormData($request, $formData);


        $data->detail = $userData;
        $data->status = 2; // pending
        $data->save();


        $adminNotification = new AdminNotification();
        $adminNotification->user_id = $data->user->id;
        $adminNotification->title = 'Deposit request from '.$data->user->username;
        $adminNotification->click_url = urlPath('admin.deposit.details',$data->id);
        $adminNotification->save();

        notify($data->user, 'DEPOSIT_REQUEST', [
            'method_name' => $data->gatewayCurrency()->name,
            'method_currency' => $data->method_currency,
            'method_amount' => showAmount($data->final_amo),
            'amount' => showAmount($data->amount),
            'charge' => showAmount($data->charge),
            'rate' => showAmount($data->rate),
            'trx' => $data->trx
        ]);

        $notify[] = ['success', 'Your request has been taken'];
        return to_route('user.deposit.history')->withNotify($notify);
    }





}
