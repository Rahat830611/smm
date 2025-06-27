@extends($activeTemplate.'layouts.master')
@section('content')
@php
    $user = auth()->user();
@endphp
<div class="col-xl-9 col-lg-12">
    <div class="dashboard-body">
        <div class="dashboard-body__bar">
            <span class="dashboard-body__bar-icon"><i class="las la-bars"></i></span>
        </div>
        <div class="row gy-4 justify-content-center">
            <div class="col-xl-4 col-lg-4 col-sm-4">
                <div class="dashboard-card">
                    <span class="banner-effect-1"></span>
                    <div class="dashboard-card__icon">
                        <i class="las la-hand-holding-usd"></i>
                    </div>
                    <div class="dashboard-card__content">
                        <h5 class="dashboard-card__title">@lang('Balance')</h5>
                        <h4 class="dashboard-card__amount">{{$general->cur_sym}} {{ showAmount($user->balance)}}</h4>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-sm-4">
                <a class="d-block" href="{{route('user.order.index')}}">
                <div class="dashboard-card">
                    <span class="banner-effect-1"></span>
                    <div class="dashboard-card__icon">
                        <i class="fas fa-cart-plus"></i>
                    </div>
                    <div class="dashboard-card__content">
                        <h5 class="dashboard-card__title">@lang('Orders') </h5>
                        <h4 class="dashboard-card__amount">{{__($orderCount)}}</h4>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-xl-4 col-lg-4 col-sm-4">
                <a class="d-block" href="{{route('user.brnad.package.index')}}">
                <div class="dashboard-card">
                    <span class="banner-effect-1"></span>
                    <div class="dashboard-card__icon">
                        <i class="fas fa-cart-plus"></i>
                    </div>
                    <div class="dashboard-card__content">
                        <h5 class="dashboard-card__title">@lang('Brand Package Orders') </h5>
                        <h4 class="dashboard-card__amount">{{__($brandOrderCount)}}</h4>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-xl-4 col-lg-4 col-sm-4">
                <a class="d-block" href="{{route('user.transactions')}}">
                    <div class="dashboard-card">
                        <span class="banner-effect-1"></span>
                        <div class="dashboard-card__icon">
                            <i class="fas fa-funnel-dollar"></i>
                        </div>
                        <div class="dashboard-card__content">
                            <h5 class="dashboard-card__title">@lang('Transactions')</h5>
                            <h4 class="dashboard-card__amount">{{$transectionCount}}</h4>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xl-4 col-lg-4 col-sm-4">
                <a class="d-block" href="{{route('user.deposit.history')}}">
                    <div class="dashboard-card">
                        <span class="banner-effect-1"></span>
                        <div class="dashboard-card__icon">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                        <div class="dashboard-card__content">
                            <h5 class="dashboard-card__title">@lang('Deposit Log')</h5>
                            <h4 class="dashboard-card__amount">{{$depositCount}}</h4>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-4 col-lg-4 col-sm-4">
                <a class="d-block" href="{{route('ticket')}}">
                    <div class="dashboard-card">
                        <span class="banner-effect-1"></span>
                        <div class="dashboard-card__icon">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                        <div class="dashboard-card__content">
                            <h5 class="dashboard-card__title">@lang('Tickets')</h5>
                            <h4 class="dashboard-card__amount">{{$ticketCount}}</h4>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
