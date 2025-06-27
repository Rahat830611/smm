<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Rules\FileTypeValidate;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index(){
        $pageTitle = 'Categories';
        $categories = Category::orderBy('created_at','desc')->paginate(getPaginate());
        return view('admin.categories.index',compact('pageTitle','categories'));
    }


    public function create(){
        $pageTitle = 'Add Category';
        return view('admin.categories.create',compact('pageTitle'));
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required|unique:categories,name',
            'logo*' => ['nullable','image',new FileTypeValidate(['jpg','jpeg','png'])]
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->status = $request->status == 1  ? 1 : 0;

        if ($request->hasFile('logo')) {
            try {

                $category->logo = fileUploader($request->logo, getFilePath('category'), getFileSize('category'));
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }

        $category->save();

        $notify[] = ['success', 'Category has been created successfully'];
        return to_route('admin.category.index')->withNotify($notify);
    }

    public function edit($id){
        $pageTitle = 'Update';
        $category = Category::findOrFail($id);
        return view('admin.categories.edit',compact('pageTitle','category'));
    }

    public function update(Request $request,$id){
        $request->validate([
            'name'=>'required',
            'logo*' => ['nullable','image',new FileTypeValidate(['jpg','jpeg','png'])]
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->status = $request->status == 1  ? 1 : 0;

        if ($request->hasFile('logo')) {
            try {
                $old = $category->logo;
                $category->logo = fileUploader($request->logo, getFilePath('category'), getFileSize('category'), $old);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }
        $category->save();

        $notify[] = ['success', 'Category has been updated successfully'];
        return to_route('admin.category.index')->withNotify($notify);
    }


    public function delete(Request $request){
        $plan = Category::findOrFail($request->id);
        $plan->delete();

        $notify[] = ['success', 'Category has been deleted successfully'];
        return back()->withNotify($notify);
    }
}
