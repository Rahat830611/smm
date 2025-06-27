@extends('admin.layouts.app')
@section('panel')

<div class="row mb-none-30">
    <div class="col-lg-12 mb-30">
        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.services.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="category_id" class="font-weight-bold">@lang('Category Name')</label>
                                <select class="form-control" name="category_id" id="category_id" required="">
                                    @foreach($categories as $category)
                                     <option value="{{$category->id}}">{{__($category->name)}}</option>
                                     @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="name" class="font-weight-bold">@lang('Service Name')</label>
                                <input type="text" name="name" id="name" value="{{old('name')}}"
                                    class="form-control" placeholder="@lang('Name')"
                                    required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="price" class="font-weight-bold">@lang('Price per 1k')</label>
                                <input type="number" name="price" id="price" value="{{old('price')}}"
                                    class="form-control" placeholder="@lang('Price')"
                                    required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="min" class="font-weight-bold">@lang('Min')</label>
                                <input type="number" name="min" id="min" value="{{old('min')}}"
                                    class="form-control" placeholder="@lang('Min')"
                                    required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="max" class="font-weight-bold">@lang('Max')</label>
                                <input type="number" name="max" id="max" value="{{old('max')}}"
                                    class="form-control" placeholder="@lang('Max')"
                                    required>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="type" class="font-weight-bold">@lang('Status')</label>
                                <select name="status" id="status" class="form-control">
                                   <option value="1">@lang('Active')</option>
                                   <option value="0">@lang('Deactive')</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="details" class="font-weight-bold ">@lang('Details')</label>
                                <textarea name="details" class="form-control" id="details" cols="30" rows="10" placeholder="@lang('Details')"></textarea>
                            </div>
                        </div>

                        <div class="row text-end">
                            <div class="col-lg-12 ">
                                <div class="form-group float-end ">
                                    <button type="submit" class="btn btn--primary btn-block btn-lg"> @lang('Create')</button>
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
<a href="{{route('admin.services.index')}}" class="btn btn-sm btn--primary box--shadow1 text--small"><i
        class="las la-angle-double-left"></i>@lang('Go Back')</a>


        <button class="btn btn--primary box--shadow1 text--small" id="actionButton" data-bs-toggle="dropdown">
            @lang('Add API Services')
            <i class="las la-cloud-upload-alt"></i>
        </button>
        <div class="dropdown-menu p-0">
            @foreach ($apiLists as $apiList)
                <a href="{{ route('admin.services.api', $apiList->id) }}" class="dropdown-item">
                    <i class="las la-cloud-download-alt"></i>
                    {{ __($apiList->name) }}
                </a>
           @endforeach

        </div>
@endpush



