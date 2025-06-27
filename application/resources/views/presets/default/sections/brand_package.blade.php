@php
$brandPackage = getContent('brand_package.content',true);
$packages = App\Models\BrandPackage::where('status',1)->get();
@endphp

<section class="pricing-plan section-bg py-80">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="section-heading  text-center">
                    <span class="subtitle">{{__($brandPackage->data_values->top_heading)}}</span>
                    <h2 class="section-heading__title">
                        {{__($brandPackage->data_values->heading)}}
                    </h2>
                    <p class="section-heading__desc">{{__($brandPackage->data_values->sub_heading)}}</p>
                </div>
            </div>
        </div>
        <div class="row gy-4 justify-content-center position-relative">
            @foreach ($packages as $item)
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
