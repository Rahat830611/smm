@extends('admin.layouts.app')
@section('panel')

<div class="row mb-none-30">
    <div class="col-lg-12 mb-30">
        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.services.update',$services->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="api_provider_id" value="{{$services->api_provider_id}}">
                    <input type="hidden" name="api_service_id" value="{{$services->api_service_id}}">
                    <div class="row">
                        @if($services->api_provider_id && $services->api_service_id)
                        <span class="badge badge--primary">@lang('this service created  through api') {{$services->api_service_id}}</span>
                        @endif
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="category_id" class="font-weight-bold">@lang('Category Name')</label>
                                <select class="form-control" name="category_id" id="category_id" required="">
                                    <option selected>@lang('Select One')...</option>
                                    @foreach($categories as $category)
                                     <option value="{{$category->id}}"{{$category->id == $services->category_id ? 'selected' : '' }}>{{__($category->name)}}</option>
                                     @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="name" class="font-weight-bold">@lang('Service Name')</label>
                                <input type="text" name="name" id="name" value="{{$services->name}}"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="price" class="font-weight-bold">@lang('Price per 1k')</label>
                                <input type="number" name="price" id="price" value="{{$services->price}}"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="min" class="font-weight-bold">@lang('Min')</label>
                                <input type="number" name="min" id="min" value="{{$services->min}}"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="max" class="font-weight-bold">@lang('Max')</label>
                                <input type="number" name="max" id="max" value="{{$services->max}}"
                                    class="form-control" required>

                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="type" class="font-weight-bold">@lang('Status')</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1"{{$services->status == 1 ? 'selected' : '' }}>@lang('Active')</option>
                                    <option value="0"{{$services->status == 0 ? 'selected' : '' }}>@lang('Deactive')</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="details" class="font-weight-bold ">@lang('Details')</label>
                                <textarea name="details" class="form-control" id="details" cols="30" rows="10">{{$services->details}}</textarea>
                            </div>
                        </div>

                        <div class="row text-end">
                            <div class="col-lg-12 ">
                                <div class="form-group float-end ">
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
<a href="{{route('admin.services.index')}}" class="btn btn-sm btn--primary box--shadow1 text--small"><i
        class="las la-angle-double-left"></i>@lang('Go Back')</a>
@endpush


