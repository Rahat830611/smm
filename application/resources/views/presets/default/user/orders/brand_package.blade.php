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
                <form action="{{route('user.brand.package.payment')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row gy-3">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="name" class="form--label"> @lang('Brand Package')</label>
                                <input type="text" class="form--control" id="name" name="name" value="{{$brandPackage->name}}" readonly>
                            </div>
                        </div>
                        @php
                        $brandPackageLink = json_decode($brandPackage->link_field, true);
                       @endphp
                       @if(!empty($brandPackageLink) && is_array($brandPackageLink))
                       @foreach($brandPackageLink as $key => $value)
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="link" class="form--label">{{$value}}</label>
                                <input type="text" class="form--control" id="link" name="links[]" placeholder="@lang('Your Link')">
                            </div>
                        </div>
                        @endforeach
                        @endif


                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="price" class="form--label">@lang('Price')</label>
                                <input type="text" class="form--control price" id="price" name="price" value="{{$brandPackage->price}}"  readonly>
                            </div>
                        </div>

                        <div class="card custom--card mt-4 service-details ">
                            <div class="card custom--card mt-4 service-details">
                                <div class="card-header">
                                  <h5 class="card-title">@lang('Brand Package Details')</h5>
                                </div>
                                <div class="card-body">
                                  <div class="selling-group-item">
                                    <small class="text-muted">@lang('Name')</small>
                                    <span>{{__($brandPackage->name)}}</span>
                                  </div>

                                  <div class="selling-group-item">
                                    <small class="text-muted">@lang('Price')</small>
                                    <span>{{$general->cur_sym}} {{__($brandPackage->price)}}</span>
                                  </div>

                                  <div class="selling-group-item">
                                    <small class="text-muted">@lang('Details')</small>
                                    @if(@$brandPackage->content)
                                    @foreach(json_decode(@$brandPackage->content) as $value)
                                    <span> <i class="fas fa-check"></i> {{$value}}</span>
                                    @endforeach
                                    @endif
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





