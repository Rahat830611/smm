@extends($activeTemplate.'layouts.frontend')
@section('content')

@php
$banner = getContent('banner.content', true);
@endphp

<!--========================== Banner Section Start ==========================-->
<section class="banner-section">
    <img class="shape-banner-bg" src="{{asset($activeTemplateTrue.'images/shape-bg.png')}}" alt="shape">
    <div class="container">
        <div class="row gy-4 align-items-center">
            <div class="col-lg-6">
                  <div class="banner-left__content">
                    <span class="subtitle">{{__($banner->data_values->top_heading)}}</span>
                      <h2>{{__($banner->data_values->heading)}}</h2>
                      <p>{{__($banner->data_values->sub_heading)}}</p>
                      <a href="{{url('/contact')}}" class="btn btn--base me-2 mb-2">
                        {{__($banner->data_values->banner_button)}} <i class="fas fa-arrow-right"></i>
                      </a>
                  </div>
              </div>
            <div class="col-lg-6">
              <div class="banner-right-wrap position-relative">
                <div class="banner-thumb">
                  <img class="experience-text " src="{{getImage(getFilePath('banner').'/'.@$banner->data_values->banner_image)}}" alt="Main-Image">
                  <img class="banner-social linkdin animate-x-axis" src="{{getImage(getFilePath('banner').'/'.@$banner->data_values->banner_social_image1)}}" alt="Side-image1">
                  <img class="banner-social pintarest animate-y-axis" src="{{getImage(getFilePath('banner').'/'.@$banner->data_values->banner_social_image2)}}" alt="Side-image2">
                  <img class="banner-social insta animate-y-axis" src="{{getImage(getFilePath('banner').'/'.@$banner->data_values->banner_social_image3)}}" alt="Side-image2">

                </div>
              </div>
            </div>
        </div>
    </div>
  </section>
<!--========================== Banner Section End ==========================-->

@if($sections->secs != null)
@foreach(json_decode($sections->secs) as $sec)
@include($activeTemplate.'sections.'.$sec)
@endforeach
@endif
@endsection

