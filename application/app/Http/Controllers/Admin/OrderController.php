<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\BrandPackageOrder;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(){
    $pageTitle = 'Order Lists';
    $orders = Order::where('status','!=',5)->with(['service', 'category', 'user'])->orderBy('created_at', 'desc')->paginate(getPaginate(12));
    return view('admin.orders.index',compact('pageTitle','orders'));
    }

    public function pendingOrder(){
    $pageTitle = 'Pending Orders';
    $orders = Order::where('status',0)->with(['service','user','category'])->paginate(getPaginate(12));
    return view('admin.orders.index',compact('pageTitle','orders'));
    }

    public function processingOrder(){
        $pageTitle = 'Processing Orders';
        $orders = Order::where('status',1)->with(['service','user','category'])->paginate(getPaginate(12));
        return view('admin.orders.index',compact('pageTitle','orders'));
    }

    public function completeOrder(){
        $pageTitle = 'Complete Orders';
        $orders = Order::where('status',2)->with(['service','user','category'])->paginate(getPaginate(12));
        return view('admin.orders.index',compact('pageTitle','orders'));
    }

    public function refundOrder(){
        $pageTitle = 'Refund Orders';
        $orders = Order::where('status',4)->with(['service','user','category'])->paginate(getPaginate(12));
        return view('admin.orders.index',compact('pageTitle','orders'));
    }

    public function cancelOrder(){
        $pageTitle = 'Cancelled Orders';
        $orders = Order::where('status',3)->with(['service','user','category'])->paginate(getPaginate(12));
        return view('admin.orders.index',compact('pageTitle','orders'));
    }

    public function update(Request $request){

        $order = Order::findOrFail($request->id);
        $order->start_count = $request->start_count;
        $order->remain_count = ($order->quantity - $request->start_count);
        $user = $order->user;

        if($request->status == 0){

            $order->status = $request->status;
            $order->save();

            notify($user, 'PENDING_ORDER', [
                'service_name'  => $order->service->name,
                'username' => $order->user->username,
                'price' => $order->price,
            ]);

        }

        if($request->status == 1){

            $order->status = $request->status;
            $order->save();

            notify($user, 'PROCESSING_ORDER', [
                'service_name'  => $order->service->name,
                'username' => $order->user->username,
                'price' => $order->price,
            ]);

        }

        if($request->status == 2){

            $order->status = $request->status;
            $order->save();

            notify($user, 'COMPLETED_ORDER', [
                'service_name'  => $order->service->name,
                'username' => $order->user->username,
                'price' => $order->price,
            ]);

        }

        if($request->status == 3){

            $order->status = $request->status;
            $order->save();

            notify($user, 'CANCELLED_ORDER', [
                'service_name'  => $order->service->name,
                'username' => $order->user->username,
                'price' => $order->price,
            ]);

        }

        if($request->status == 4){

            if ($order->status == 2 || $order->status == 3) {
                $notify[] = ['error', 'This order is not refundable'];
                return back()->withNotify($notify);
            }

            $order->status = $request->status;
            $order->save();

            //Refund balance
            $user->balance += $order->price;
            $user->save();

            //Create Transaction
            $transaction               = new Transaction();
            $transaction->user_id      = $user->id;
            $transaction->amount       = $order->price;
            $transaction->post_balance = $user->balance;
            $transaction->trx_type     = '+';
            $transaction->remark       = "refund_order";
            $transaction->details      = 'Refund for Order ' . @$order->service->name;
            $transaction->trx          = getTrx();
            $transaction->save();

            //Send email to user
            notify($user, 'REFUNDED_ORDER', [
                'service_name' => $order->service->name,
                'price'        => showAmount($order->price),
                'currency'     => gs()->cur_text,
                'post_balance' => showAmount($user->balance),
                'trx'          => $transaction->trx,
                ]);

        }

        $order->save();
        $notify[] = ['success', 'Oder has been updated successfully'];
        return back()->withNotify($notify);
    }



    // brand package order

    public function getBrandPackage(){
    $pageTitle = 'Order Lists';
    $orders = BrandPackageOrder::where('status','!=',5)->with('user')->orderBy('created_at','desc')->paginate(getPaginate(12));
    return view('admin.brandOrders.index',compact('pageTitle','orders'));
    }

    public function bPpendingOrder(){
        $pageTitle = 'Pending Orders';
        $orders = BrandPackageOrder::where('status',0)->with('user')->orderBy('created_at','desc')->paginate(getPaginate(12));
        return view('admin.brandOrders.index',compact('pageTitle','orders'));
    }

    public function bPprocessingOrder(){
        $pageTitle = 'Processing Orders';
        $orders = BrandPackageOrder::where('status',1)->with('user')->orderBy('created_at','desc')->paginate(getPaginate(12));
        return view('admin.brandOrders.index',compact('pageTitle','orders'));
    }

    public function bPcompleteOrder(){
        $pageTitle = 'Complete Orders';
        $orders = BrandPackageOrder::where('status',2)->with('user')->orderBy('created_at','desc')->paginate(getPaginate(12));
        return view('admin.brandOrders.index',compact('pageTitle','orders'));
    }

    public function bPrefundOrder(){
        $pageTitle = 'Refund Orders';
        $orders = BrandPackageOrder::where('status',3)->with('user')->orderBy('created_at','desc')->paginate(getPaginate(12));
        return view('admin.brandOrders.index',compact('pageTitle','orders'));
    }

    public function bPcancelOrder(){
        $pageTitle = 'Cancelled Orders';
        $orders = BrandPackageOrder::where('status',4)->with('user')->orderBy('created_at','desc')->paginate(getPaginate(12));
        return view('admin.brandOrders.index',compact('pageTitle','orders'));
    }

    public function updateBrandPackage(Request $request){
        $order = BrandPackageOrder::findOrFail($request->id);
        $user = $order->user;

        if($request->status == 0){

            $order->status = $request->status;
            $order->save();

            notify($user, 'PENDING_ORDER', [
                'service_name'  => $order->name,
                'username' => $order->user->username,
                'price' => $order->price,
            ]);

        }

        if($request->status == 1){

            $order->status = $request->status;
            $order->save();

            notify($user, 'PROCESSING_ORDER', [
                'service_name'  => $order->name,
                'username' => $order->user->username,
                'price' => $order->price,
            ]);

        }

        if($request->status == 2){

            $order->status = $request->status;
            $order->save();

            notify($user, 'COMPLETED_ORDER', [
                'service_name'  => $order->name,
                'username' => $order->user->username,
                'price' => $order->price,
            ]);

        }

        if($request->status == 3){

            $order->status = $request->status;
            $order->save();

            notify($user, 'CANCELLED_ORDER', [
                'service_name'  => $order->name,
                'username' => $order->user->username,
                'price' => $order->price,
            ]);

        }

        if($request->status == 4){

            if ($order->status == 2 || $order->status == 3) {
                $notify[] = ['error', 'This order is not refundable'];
                return back()->withNotify($notify);
            }

            $order->status = $request->status;
            $order->save();

            //Refund balance
            $user->balance += $order->price;
            $user->save();

            //Create Transaction
            $transaction               = new Transaction();
            $transaction->user_id      = $user->id;
            $transaction->amount       = $order->price;
            $transaction->post_balance = $user->balance;
            $transaction->trx_type     = '+';
            $transaction->remark       = "refund_order";
            $transaction->details      = 'Refund for Order ' . @$order->name;
            $transaction->trx          = getTrx();
            $transaction->save();

            //Send email to user
            notify($user, 'REFUNDED_ORDER', [
            'service_name' => $order->name,
            'price'        => showAmount($order->price),
            'currency'     => gs()->cur_text,
            'post_balance' => showAmount($user->balance),
            'trx'          => $transaction->trx,
            ]);

        }

        $order->save();
        $notify[] = ['success', 'Brand Package has been updated successfully'];
        return back()->withNotify($notify);
    }
}
