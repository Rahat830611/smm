@extends($activeTemplate.'layouts.frontend')
@section('content')

<section class="pricing-plan section-bg py-80">
    <div class="container">
        <div class="row gy-4 justify-content-center position-relative">
            @foreach ($brandPackages as $item)
            <div class="col-lg-4 col-md-6">
                <div class="pricing-plan-item">
                    <img class="price-shape-bg" src="{{asset($activeTemplateTrue.'images/price-shape-bg.png')}}" alt="image">
                    <div class="price-shape-2"></div>
                    <div class="pricing-plan-item__top">
                        <h3 class="title" title="{{__($item->name)}}">
                            @if(strlen(__($item->name)) >20)
                            {{substr( __($item->name), 0,20).'...' }}
                            @else
                            {{__($item->name)}}
                            @endif
                        </h3>
                        <p class="pricing-plan-item__top-desc">@lang('What You Are Looking For')!</p>
                    </div>
                    <div class="pricing-plan-item__price">
                        <h3 class="title">{{$general->cur_sym}} {{showAmount($item->price)}}</h3>
                    </div>
                    <div class="pricing-plan-item__list">
                        <ul>
                            @if(@$item->content)
                            @foreach(json_decode(@$item->content) as $value)
                            <li> <i class="far fa-check-circle"></i> {{$value}}</li>
                            @endforeach
                            @endif
                        </ul>
                    </div>
                    <div class="pricing-plan-item__bottom">
                        <a class="btn btn--base" href="{{route('user.brnad.package',$item->id)}}">
                            @lang('Get Started') <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@if($sections->secs != null)
@foreach(json_decode($sections->secs) as $sec)
@include($activeTemplate.'sections.'.$sec)
@endforeach
@endif
@endsection

