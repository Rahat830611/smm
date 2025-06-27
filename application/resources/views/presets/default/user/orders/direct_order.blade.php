@extends($activeTemplate.'layouts.master')
@section('content')
<div class="col-xl-9 col-lg-12">
    <div class="dashboard-body">
        <div class="order-wrap">
            <div class="account-form">
                <div class="dashboard-body__bar">
                    <span class="dashboard-body__bar-icon"><i class="las la-bars"></i></span>
                </div>
                <div class="account-form__content mb-4">
                    <h3 class="account-form__title mb-2">{{$pageTitle}} </h3>
                </div>
                <form action="{{route('user.service.order.payment')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row gy-3">
                        <div class="col-sm-6">
                            <div class="form-group mb-3">
                                <label class="form--label">@lang('Category')</label>
                                <div class="col-sm-12">
                                    <select class="select form--control category" name="category_id">
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group mb-3">
                                <label class="form--label">@lang('Service')</label>
                                <div class="col-sm-12">
                                    <select class="select form--control services" name="service_id">
                                        <option value="{{$service->id}}">{{__($service->name)}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="link" class="form--label"> @lang('Your Link')</label>
                                <input type="text" class="form--control" id="link" name="link" placeholder="@lang('Your Link')">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="quantity" class="form--label">@lang('Quantity')</label>
                                <input type="number" class="form--control" id="quantity" min="1" name="quantity" placeholder="@lang('Quantity')">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="price" class="form--label">@lang('Price')</label>
                                <input type="text" class="form--control price" id="price" name="price" value="{{$service->price}}" readonly>
                            </div>
                        </div>

                        <div class="card custom--card mt-4 service-details ">
                            <div class="card custom--card mt-4 service-details">
                                <div class="card-header">
                                  <h5 class="card-title">@lang('Service Details')</h5>
                                </div>
                                <div class="card-body">
                                  <div class="selling-group-item">
                                    <small class="text-muted">@lang('Category'):</small>
                                    <span>{{__($category->name)}}</span>
                                  </div>
                                  <div class="selling-group-item">
                                    <small class="text-muted">@lang('Service Name'):</small>
                                    <span>{{__($service->name)}}</span>
                                  </div>
                                  <div class="selling-group-item">
                                    <small class="text-muted">@lang('Price'):</small>
                                    <span>{{$general->cur_sym}} {{__($service->price)}}</span>
                                  </div>
                                  <div class="selling-group-item">
                                    <small class="text-muted">@lang('Min'):</small>
                                    <span> {{__($service->min)}}</span>
                                  </div>
                                  <div class="selling-group-item">
                                    <small class="text-muted">@lang('Max'):</small>
                                    <span> {{__($service->max)}}</span>
                                  </div>
                                  <div class="selling-group-item">
                                    <small class="text-muted">@lang('Details'):</small>
                                    <span> {{__($service->details)}}</span>
                                  </div>
                                </div>
                              </div>
                        </div>


                        <div class="col-sm-12">
                            <button type="submit" class="btn btn--base w-25">
                               @lang('Place Order') <i class="fas fa-arrow-right"></i>
                                <span style="top: 16px; left: 578px;"></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    "use strict";
  var orginalPrice = $('.price').val();
        $(document).on("input", "#quantity", function() {

        var quantity = $('#quantity').val()

        var total_price = (orginalPrice / 1000) * quantity;
            $('.price').val(total_price.toFixed(2));
        });
        $('input[name=quantity]').attr('min', {{$service->min}}).attr('max', {{$service->max}});


</script>
@endpush

