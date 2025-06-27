<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BrandPackage;
use Illuminate\Http\Request;

class BrandPackageController extends Controller
{
    public function index(){
        $pageTitle = 'Brand Package';
        $brandPackages = BrandPackage::orderBy('created_at','desc')->paginate(getPaginate());
        return view('admin.brandpackage.index',compact('pageTitle','brandPackages'));
    }

    public function create(){
        $pageTitle = 'Add Brand Package';
        return view('admin.brandpackage.create',compact('pageTitle'));
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required|unique:brand_packages,name',
            'price'=>'required',
            'link_fields' => 'required|array',
            'link_fields.*' => 'required',
            'contents' => 'required|array',
            'contents.*' => 'required',
        ]);


        $content =  json_encode($request->contents);
        $linkFileds =  json_encode($request->link_fileds);

        $brandPackage = new BrandPackage();
        $brandPackage->name = $request->name;
        $brandPackage->price = $request->price;
        $brandPackage->link_field = $linkFileds;
        $brandPackage->content = $content;
        $brandPackage->status = 1;
        $brandPackage->save();

        $notify[] = ['success', 'brand package has been created successfully'];
        return to_route('admin.brandpackage.index')->withNotify($notify);
    }

    public function edit($id){
        $pageTitle = 'Update';
        $brandPackage = BrandPackage::findOrFail($id);

        return view('admin.brandpackage.edit',compact('pageTitle','brandPackage'));
    }

    public function update(Request $request,$id){
        $request->validate([
            'name'=>'required',
            'price'=>'required',
            'link_fields' => 'required|array',
            'link_fields.*' => 'required',
            'contents' => 'required|array',
            'contents.*' => 'required',
        ]);


        $content =  json_encode($request->contents);
        $linkFileds =  json_encode($request->link_fields);

        $brandPackage = BrandPackage::findOrFail($id);
        $brandPackage->name = $request->name;
        $brandPackage->price = $request->price;
        $brandPackage->link_field = $linkFileds;
        $brandPackage->content = $content;
        $brandPackage->status = $request->status ? 1 : 0;
        $brandPackage->save();

        $notify[] = ['success', 'brand package has been updated successfully'];
        return to_route('admin.brandpackage.index')->withNotify($notify);
    }

    public function delete(Request $request){
        $plan = BrandPackage::findOrFail($request->id);
        $plan->delete();

        $notify[] = ['success', 'Brand Package has been deleted successfully'];
        return back()->withNotify($notify);
    }
}
