<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use App\Models\Category;
use App\Models\Services;
use App\Models\BrandPackage;
use Illuminate\Http\Request;
use App\Models\GatewayCurrency;
use App\Models\BrandPackageOrder;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{

    public function index(){
        $pageTitle = 'Order Lists';
        $orders = Order::where('status','!=',5)->where('user_id',auth()->user()->id)->with(['service','user','category'])->paginate(getPaginate(12));
        return view($this->activeTemplate.'user.orders.index',compact('pageTitle','orders'));
    }

    public function create(){
        $pageTitle = 'New Order';
        $categories = Category::where('status',1)->get();
        return view($this->activeTemplate.'user.orders.create',compact('pageTitle','categories'));
    }

    // service payment
    public function ServicePayment(Request $request){

        $user = auth()->user();
        $service = Services::findOrFail($request->service_id);
        
        $request->validate([
            'price'=>'required|gt:0',
            'category_id'=>'required',
            'link'=>'required|url',
            'quantity' => 'required|integer|gte:' . $service->min . '|lte:' . $service->max,
        ]);

        $price_per_k = ($service->price / 1000) * $request->quantity;

         // Store order information temporarily in the session
         Session::put('serviceOrder', [
            'order_no' => random_int(1000, 9999),
            'category_id' => $request->category_id,
            'service_id' => $request->service_id,
            'api_service_id' => $service->api_service_id ?? 0,
            'api_provider_id' => $service->api_provider_id ?? 0,
            'api_order' =>$service->api_service_id ? 1 : 0,
            'quantity' => $request->quantity,
            'user_id' => $user->id,
            'link' =>$request->link,
            'price' =>$price_per_k,
            'start_count' => 0,
            'remain_count' => $request->quantity
        ]);

        $gatewayCurrency = GatewayCurrency::whereHas('method', function ($gate) {
            $gate->where('status', 1);
        })->with('method')->orderby('method_code')->get();
        $pageTitle = 'Payment Methods';

        return view($this->activeTemplate . 'user.payment.payment', compact('gatewayCurrency', 'pageTitle'));
    }
    // service order Insert
    public function serviceOrderInsert($serviceOrderData , $status=null)
    {
        $order = new Order();
        $order->order_no = $serviceOrderData['order_no'];
        $order->category_id =$serviceOrderData['category_id'];
        $order->service_id = $serviceOrderData['service_id'];
        $order->api_service_id  = $serviceOrderData['api_service_id'];
        $order->api_provider_id = $serviceOrderData['api_provider_id'];;
        $order->api_order =$serviceOrderData['api_order'];
        $order->quantity =$serviceOrderData['quantity'];
        $order->user_id =$serviceOrderData['user_id'];
        $order->link = $serviceOrderData['link'];
        $order->price = $serviceOrderData['price'];
        $order->start_count = $serviceOrderData['start_count'];
        $order->remain_count = $serviceOrderData['remain_count'];
        $order->status = $status ?? 5;
        $order->save();

        return $order;
    }

    public function getService($id){
        $category = Category::find($id);
        $services = $category->services;

        return response()->json([
            'services' => $services,
            'category' => $category->name,
        ]);
    }

    public function getServicePrice($id){

        $services = Services::find($id);
        return response()->json([
            'price' => $services->price,
            'name' => $services->name,
            'min' => $services->min,
            'max' => $services->max,
            'details' => $services->details,
            'category' => $services->category->name,
        ]);
    }

    public function directOrder($id){
        $service = Services::findOrFail($id);
        $category = $service->category;
        $pageTitle = 'Order Place';
        return view($this->activeTemplate.'user.orders.direct_order',compact('pageTitle','category','service'));
    }

    public function getPackageOrder(){
        $pageTitle = 'Brand Package Order Lists';
        $brandPackageOrder = BrandPackageOrder::where('status','!=',5)->where('user_id',auth()->user()->id)->with('user')->orderBy('created_at','desc')->paginate(getPaginate(12));
        return view($this->activeTemplate.'user.orders.brand_package_order_index',compact('pageTitle','brandPackageOrder'));

    }

    public function pendingOrder(){
        $pageTitle = 'Pending Orders';
        $orders = Order::where('user_id',auth()->user()->id)->where('status',0)->with(['service','user','category'])->paginate(getPaginate(12));
        return view($this->activeTemplate.'user.orders.index',compact('pageTitle','orders'));
    }

    public function processingOrder(){
        $pageTitle = 'Processing Orders';
        $orders = Order::where('user_id',auth()->user()->id)->where('status',1)->with(['service','user','category'])->paginate(getPaginate(12));
        return view($this->activeTemplate.'user.orders.index',compact('pageTitle','orders'));
    }

    public function completeOrder(){
        $pageTitle = 'Complete Orders';
        $orders = Order::where('user_id',auth()->user()->id)->where('status',2)->with(['service','user','category'])->paginate(getPaginate(12));
        return view($this->activeTemplate.'user.orders.index',compact('pageTitle','orders'));
    }

    public function refundOrder(){
        $pageTitle = 'Refund Orders';
        $orders = Order::where('user_id',auth()->user()->id)->where('status',4)->with(['service','user','category'])->paginate(getPaginate(12));
        return view($this->activeTemplate.'user.orders.index',compact('pageTitle','orders'));
    }

    public function cancelleOrder(){
        $pageTitle = 'Cancelled Orders';
        $orders = Order::where('user_id',auth()->user()->id)->where('status',3)->with(['service','user','category'])->paginate(getPaginate(12));
        return view($this->activeTemplate.'user.orders.index',compact('pageTitle','orders'));
    }



    // brand package

    public function brandPackage($id){
        $pageTitle = 'Brand Package Order';
        $brandPackage = BrandPackage::findOrFail($id);
        return view($this->activeTemplate.'user.orders.brand_package',compact('pageTitle','brandPackage'));
    }
    // BrandPackahepPayment
    public function brandPackagepPayment(Request $request){

        $request->validate([
            'name'=>'required',
            'links' => ['required', 'array'],
            'links.*' => 'required|url',
            'price'=>'required'
        ]);
        $links =  json_encode($request->links);
        $user = auth()->user();

        // Store order information temporarily in the session
        Session::put('brandPackageOrder', [
            'user_id' => $user->id,
            'name' => $request->name,
            'price' => $request->price,
            'links' => $links,
        ]);

        $gatewayCurrency = GatewayCurrency::whereHas('method', function ($gate) {
            $gate->where('status', 1);
        })->with('method')->orderby('method_code')->get();
        $pageTitle = 'Payment Methods';

        return view($this->activeTemplate . 'user.payment.payment', compact('gatewayCurrency', 'pageTitle'));
    }
    // brand package order insert
    public function bPOrderInsert($orderData , $status=null)
    {
        $brandPackageOrder = new BrandPackageOrder();
        $brandPackageOrder->user_id = $orderData['user_id'];
        $brandPackageOrder->name = $orderData['name'];
        $brandPackageOrder->price = $orderData['price'];
        $brandPackageOrder->link = $orderData['links'];
        $brandPackageOrder->status = $status ?? 5;
        $brandPackageOrder->save();

        return $brandPackageOrder;
    }





}
