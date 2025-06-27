@extends($activeTemplate .'layouts.frontend')
@section('content')
<section class="account bg-img login py-80 position-relative">
    <div class="account-inner">
        <div class="container">
            <div class="row gy-4 justify-content-center">
               <div class="col-md-8 col-xl-6 col-lg-8  col-12">
                <div class="verification-code-wrapper account-form">
                    <div class="verification-area">
                        <h5 class="pb-3 text-center border-bottom">{{ __($pageTitle) }}</h5>
                        <p>@lang('To recover your account please provide your email or username to find your account.')
                        </p>
                         <form method="POST" action="{{ route('user.password.email') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <label class="form-label">@lang('Email or Username')</label>
                                <input type="text" class="form-control form--control" name="value"
                                    value="{{ old('value') }}" required autofocus="off">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn--base w-50">@lang('Submit')</button>
                            </div>
                        </form>
                    </div>
                </div>
               </div>
            </div>
        </div>
    </div>
</section>
@endsection
