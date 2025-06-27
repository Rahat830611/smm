<!doctype html>
<html lang="{{ config('app.locale') }}" itemscope itemtype="http://schema.org/WebPage">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> {{ $general->siteName(__('419')) }}</title>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/common/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/main.css')}}">

</head>
<body>

<!--==================== Preloader Start ====================-->
<div id="loading">
   <div id="loading-center">
         <div id="loading-center-absolute">
            <div class="loader">
               <img class="animate-rotate" src="{{asset($activeTemplateTrue.'images/banner-img-6.png')}}" alt="image">
            </div>
         </div>
   </div>
</div>
<!--==================== Preloader End ====================-->

<!--==================== Overlay Start ====================-->
<div class="body-overlay"></div>
<!--==================== Overlay End ====================-->

<!--==================== Sidebar Overlay End ====================-->
<div class="sidebar-overlay"></div>
<!--==================== Sidebar Overlay End ====================-->

<!-- ==================== Scroll to Top End Here ==================== -->
<a class="scroll-top"><i class="fas fa-angle-double-up"></i></a>
<!-- ==================== Scroll to Top End Here ==================== -->

<section class="account">
    <div class="account-inner">
        <div class="container">
            <div class="row gy-4 justify-content-center align-items-center" style="height: 100vh">
                <div class="col-lg-6">
                    <div class="error-wrap text-center">
                        <div class="error__text">
                            <span>@lang('4')</span>
                            <span>@lang('1')</span>
                            <span>@lang('9')</span>
                        </div>
                        <h2 class="error-wrap__title">@lang('Page Expired')</h2>
                        <p class="error-wrap__desc">@lang('Sorry, Your session has expired, Please refresh and try again.')</p>
                        <a href="{{route('home')}}" class="btn btn--base">
                            <i class="la la-undo"></i> @lang('Go Home')
                            <span style="top: 212.016px; left: 168px;"></span>
                          </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="{{asset('assets/common/js/jquery-3.7.0.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'js/main.js')}}"></script>
</body>
</html>
