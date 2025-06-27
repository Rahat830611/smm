<?php

namespace App\Http\Controllers\Admin;

use App\Lib\CurlRequest;
use App\Models\Category;
use App\Models\Services;
use App\Models\ApiProvider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServicesController extends Controller
{
    public function index(){
        $pageTitle = 'Services';
        $services = Services::with(['category','provider'])->orderBy('created_at','desc')->paginate(getPaginate());
        return view('admin.services.index',compact('pageTitle','services'));
    }


    public function create(){
        $pageTitle = 'Add Service';
        $categories = Category::where('status',1)->get();
        $apiLists   = ApiProvider::where('status',1)->get();
        return view('admin.services.create',compact('pageTitle','categories','apiLists'));
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required|unique:services,name',
            'price'=>'required',
            'min'=>'required',
            'max'=>'required',
            'category_id' => function ($attribute, $value, $fail) use ($request) {
                if (empty($value) && empty($request->category)) {
                    $fail('Category  is required.');
                }
            },
            'category' => function ($attribute, $value, $fail) use ($request) {
                if (empty($value) && empty($request->category_id)) {
                    $fail('Category  is required.');
                }
            },
        ]);


        if(isset($request->category)){
            $existsCategory = Category::where('name',$request->category)->first();
            if( $existsCategory){
             $category = $existsCategory;
            }else{
                $category = new Category();
                $category->name = $request->category;
                $category->status = $request->status == 1  ? 1 : 0;
                $category->save();
            }
        }

        $service = new Services();
        $service->api_provider_id = $request->api_provider_id ?? 0;
        $service->api_service_id  = $request->api_service_id ?? 0;
        $service->name = $request->name;
        $service->category_id = $request->category_id ?: $category->id;
        $service->price = $request->price;
        $service->min = $request->min;
        $service->max = $request->max;
        $service->details = $request->details;
        $service->status = $request->status == 1  ? 1 : 0;
        $service->save();

        $notify[] = ['success', 'service has been created successfully'];
        return to_route('admin.services.index')->withNotify($notify);
    }

    public function edit($id){
        $pageTitle = 'Update';
        $services = Services::findOrFail($id);
        $categories = Category::get();
        return view('admin.services.edit',compact('pageTitle','categories','services'));
    }

    public function update(Request $request ,$id){
        $request->validate([
            'name'=>'required',
            'price'=>'required',
            'category_id'=>'required',
            'min'=>'required',
            'max'=>'required',
        ]);

        $service = Services::findOrFail($id);
        $service->name = $request->name;
        $service->category_id = $request->category_id;
        $service->price = $request->price;
        $service->min = $request->min;
        $service->max = $request->max;
        $service->details = $request->details;
        $service->status = $request->status == 1  ? 1 : 0;
        $service->api_provider_id = $request->api_provider_id ? $request->api_provider_id : 0;
        $service->api_service_id = $request->api_service_id ? $request->api_service_id : 0;
        $service->save();

        $notify[] = ['success', 'service has been updated successfully'];
        return to_route('admin.services.index')->withNotify($notify);
    }


    public function delete(Request $request){
        $service = Services::findOrFail($request->id);
        $service->delete();

        $notify[] = ['success', 'Service has been deleted successfully'];
        return back()->withNotify($notify);
    }








    //Api services
    public function apiServices($id)
    {

        $pageTitle  = "API Services";
        $api        = ApiProvider::where('status',1)->findOrFail($id);
        $categories = Category::where('status',1)->get();

        $existsServices = Services::where('api_provider_id', $api->id)->count();
        $url        = $api->api_url;

        $arr        = [
            'key'    => $api->api_key,
            'action' => 'services',
        ];
        $response = CurlRequest::curlPostContent($url, $arr);

        $response = json_decode($response);

        if (@$response->error) {
            $notify[] = ['info', 'Please enter your api credentials from API Setting Option'];
            $notify[] = ['error', $response->error];
            return back()->withNotify($notify);
        }
        $data = [];
        foreach ($response as $value) {
            $value->api_id = $id;
            array_push($data, $value);
        }

        $response = collect($data);
        $response = $response->skip($existsServices);

        $services = $response;


        return view('admin.services.api_services', compact('pageTitle', 'services','categories'));
    }
}
