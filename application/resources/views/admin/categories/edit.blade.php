@extends('admin.layouts.app')
@section('panel')

<div class="row mb-none-30">
    <div class="col-lg-12 mb-30">
        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.category.update',$category->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="name" class="font-weight-bold">@lang('Name')</label>
                                <input type="text" name="name" id="name"
                                    class="form-control" value="{{$category->name}}" required>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="logo" class="font-weight-bold">@lang('Logo')</label>
                                <div class="file-upload-wrapper" data-text="Select your image!">
                                    <input type="file" name="logo" id="logo" class="file-upload-field">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="type" class="font-weight-bold">@lang('Status')</label>
                                <select name="status" id="type" class="form-control" required>
                                   <option value="1"{{$category->status == 1 ? 'selected' : '' }}>@lang('Active')</option>
                                   <option value="0"{{$category->status == 0 ? 'selected' : '' }}>@lang('Deactive')</option>
                                </select>
                            </div>
                        </div>

                        <div class="row text-end">
                            <div class="col-lg-12 ">
                                <div class="form-group float-end p-3">
                                    <button type="submit" class="btn btn--primary btn-block btn-lg"> @lang('Update')</button>
                                </div>
                            </div>
                        </div>
                 </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('breadcrumb-plugins')
<a href="{{route('admin.category.index')}}" class="btn btn-sm btn--primary box--shadow1 text--small"><i
        class="las la-angle-double-left"></i>@lang('Go Back')</a>
@endpush


