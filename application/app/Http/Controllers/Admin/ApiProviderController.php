<?php

namespace App\Http\Controllers\Admin;

use App\Models\ApiProvider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiProviderController extends Controller
{
    public function index()
    {
        $pageTitle    = "Api Providers";
        $apiProviders = ApiProvider::orderBy('created_at','desc')->paginate(getPaginate(12));
        return view('admin.apiProvider.index', compact('pageTitle', 'apiProviders'));
    }

    public function create(){
        $pageTitle = 'Api Provider Create';
        return view('admin.apiProvider.create',compact('pageTitle'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required',
            'api_url'    => 'required|url',
            'api_key'    => 'required',
            'short_name' => 'required|max:4',

        ]);

        $apiProvider = new ApiProvider();
        $apiProvider->name = $request->name;
        $apiProvider->short_name = $request->short_name;
        $apiProvider->api_url = $request->api_url;
        $apiProvider->api_key = $request->api_key;
        $apiProvider->status = 1;
        $apiProvider->save();

         $notify[] = ['success', 'Api provider has been created successfully'];
         return to_route('admin.api.provider.index')->withNotify($notify);
    }

    public function update(Request $request){
        $request->validate([
            'name'       => 'required',
            'api_url'    => 'required|url',
            'api_key'    => 'required',
            'short_name' => 'required|max:4',

        ]);

        $apiProvider = ApiProvider::findOrFail($request->id);
        $apiProvider->name = $request->name;
        $apiProvider->short_name = $request->short_name;
        $apiProvider->api_url = $request->api_url;
        $apiProvider->api_key = $request->api_key;
        $apiProvider->status = $request->status == 1 ? 1 : 0;
        $apiProvider->save();

         $notify[] = ['success', 'Api provider has been updated successfully'];
         return to_route('admin.api.provider.index')->withNotify($notify);

    }
}
