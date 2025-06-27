@extends('admin.layouts.app')
@section('panel')

<div class="row mb-none-30">
    <div class="col-lg-12 mb-30">
        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.api.provider.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name" class="font-weight-bold">@lang('Api Name')</label>
                                <input type="text" name="name" id="name" value="{{old('name')}}"
                                    class="form-control" placeholder="@lang('Api Name')"
                                    required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="short_name" class="font-weight-bold">@lang('Api Short Name')</label>
                                <input type="text" name="short_name" id="short_name" value="{{old('short_name')}}"
                                    class="form-control" placeholder="@lang('Api Short Name')"
                                    required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="api_url" class="font-weight-bold">@lang('Api Url ')</label>
                                <input type="text" name="api_url" id="api_url" value="{{old('api_url')}}"
                                    class="form-control" placeholder="@lang('Api Url')"
                                    required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="api_key" class="font-weight-bold">@lang('Api Key ')</label>
                                <input type="text" name="api_key" id="api_key" value="{{old('api_key')}}"
                                    class="form-control" placeholder="@lang('Api Key')"
                                    required>
                            </div>
                        </div>

                        <div class="row text-end">
                            <div class="col-lg-12 ">
                                <div class="form-group float-end p-3">
                                    <button type="submit" class="btn btn--primary btn-block btn-lg"> @lang('Create Api Provider')</button>
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
<a href="{{route('admin.api.provider.index')}}" class="btn btn-sm btn--primary box--shadow1 text--small"><i
        class="las la-angle-double-left"></i>@lang('Go Back')</a>
@endpush


