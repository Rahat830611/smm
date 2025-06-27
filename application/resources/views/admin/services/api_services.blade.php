@extends('admin.layouts.app')
@section('panel')

<div class="row mb-none-30">
    <div class="col-lg-12 mb-30">
        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.services.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="api_provider_id">
                    <input type="hidden" name="api_service_id">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="name" class="font-weight-bold">@lang('Service Name')</label>
                                <select class="form-control" name="name" id="apiInfo" required="">
                                    <option selected>@lang('Select One')</option>
                                    @foreach($services as $key=>$item)
                                     <option value="{{$item->name}}" data-service="{{ @$item->service}}"
                                        data-rate="{{ @$item->rate}}" data-min="{{ @$item->min}}" data-max="{{ @$item->max}}" data-category="{{ @$item->category}}" data-api_id="{{ @$item->api_id}}">{{__($item->name)}}</option>
                                     @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="price" class="font-weight-bold">@lang('Category Name')</label>
                                <input type="text" name="category" id="category" value="{{old('category')}}"
                                    class="form-control " placeholder="@lang('Category Name')"
                                    required readonly>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="price" class="font-weight-bold">@lang('Price')</label>
                                <input step="any" type="number" name="price" id="price" value="{{old('price')}}"
                                    class="form-control " placeholder="@lang('Price')"
                                    required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="min" class="font-weight-bold">@lang('Min')</label>
                                <input type="number" name="min" id="min" value="{{old('min')}}"
                                    class="form-control " placeholder="@lang('Min')"
                                    required readonly>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="max" class="font-weight-bold">@lang('Max')</label>
                                <input type="number" name="max" id="max" value="{{old('max')}}"
                                    class="form-control " placeholder="@lang('Max')"
                                    required readonly>
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
@endpush

@push('script')
<script>
    $(document).ready(function() {
        $('#apiInfo').on('change', function () {
            var selectedOption = $(this).find('option:selected');

            var rate = selectedOption.data('rate');
            $('input[name=price]').val(rate);

            var min = selectedOption.data('min');
            $('input[name=min]').val(min);

            var max = selectedOption.data('max');
            $('input[name=max]').val(max);

            var category = selectedOption.data('category');
            $('input[name=category]').val(category);

            var apiProviderId = selectedOption.data('api_id');
            $('input[name=api_provider_id]').val(apiProviderId);

            var apiServiceId = selectedOption.data('service');
            $('input[name=api_service_id]').val(apiServiceId);
        });
    });
</script>
@endpush



