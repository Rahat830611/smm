@extends($activeTemplate .'layouts.frontend')
@section('content')
<section class="account bg-img login py-80 position-relative">
    <div class="account-inner">
        <div class="container">
            <div class="row gy-4 justify-content-center">
                <div class="verification-code-wrapper account-form">
                    <div class="verification-area">
                        <h5 class="pb-3 text-center border-bottom">@lang('Verify Email Address')</h5>
                        <form action="{{ route('user.password.verify.code') }}" method="POST" class="submit-form">
                            @csrf
                            <p class="verification-text">@lang('A 6 digit verification code sent to your email address')
                                : {{ showEmailAddress($email) }}</p>
                            <input type="hidden" name="email" value="{{ $email }}">

                            @include($activeTemplate.'components.verification_code')

                            <div class="form-group">
                                <button type="submit" class="btn btn--base w-50">@lang('Submit')</button>
                            </div>

                            <div class="form-group">
                                @lang('Please check including your Junk/Spam Folder. if not found, you can')
                                <a href="{{ route('user.password.request') }}">@lang('Try to send again')</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

