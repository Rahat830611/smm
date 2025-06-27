@extends($activeTemplate.'layouts.master')
@section('content')
<div class="col-xl-9 col-lg-12">
    <div class="dashboard-body account-form">
        <div class="dashboard-body__bar">
            <span class="dashboard-body__bar-icon"><i class="las la-bars"></i></span>
        </div>
        <div class="row gy-4 justify-content-center">
            <div class="col-lg-12">
                <div class="user-profile">
                    <form class="register" action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row gy-3">
                            <div class="col-lg-12">
                                <h4 class="mb-1">{{__($pageTitle)}}</h4>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name" class="form--label required">@lang('First Name')</label>
                                    <input type="text" class="form--control" name="firstname"
                                    value="{{$user->firstname}}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="lastname" class="form--label required">@lang('Last Name')</label>
                                    <input type="text" class="form--control" name="lastname"
                                    value="{{$user->lastname}}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email" class="form--label">@lang('Email')</label>
                                    <input type="text" class="form--control" value="{{$user->email}}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email" class="form--label">@lang('Mobile')</label>
                                    <input type="text" class="form--control" value="{{$user->mobile}}" readonly>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email" class="form--label">@lang('Address')</label>
                                    <input type="text" class="form--control" name="address"
                                    value="{{@$user->address->address}}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email" class="form--label">@lang('State')</label>
                                    <input type="text" class="form--control" name="state"
                                    value="{{@$user->address->state}}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email" class="form--label">@lang('Zip')</label>
                                    <input type="text" class="form--control" name="zip"
                                    value="{{@$user->address->zip}}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email" class="form--label">@lang('City')</label>
                                    <input type="text" class="form--control" name="city"
                                    value="{{@$user->address->city}}">
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="email" class="form--label">@lang('Country')</label>
                                    <input type="text" class="form--control" value="{{@$user->address->country}}" disabled>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn--base w-25">@lang('Update')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


