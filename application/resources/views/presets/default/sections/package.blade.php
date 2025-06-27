@php
$package = getContent('package.content',true);
$services = App\Models\Services::where('status',1)->with('category')->inRandomOrder()->take(12)->get();
@endphp
<!-- ==================== Service Start Here ==================== -->
<section class="experience-area section-bg py-80 ">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="section-heading  text-center">
                    <span class="subtitle">{{__($package->data_values->top_heading)}}</span>
                    <h2 class="section-heading__title">
                        {{__($package->data_values->heading)}}
                    </h2>
                    <p class="section-heading__desc">{{__($package->data_values->sub_heading)}}</p>
                </div>
            </div>
        </div>
        <div class="row gy-4 justify-content-center">
            @foreach ($services as $item)
            <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                <div class="single-service text-center">
                    <div class="single-service__icon">
                        <img src="{{getImage(getFilePath('category').'/'.@$item->category->logo)}}" alt="logo">
                    </div>
                    <div class="single-service__content">
                        <h3 class="title" title="{{__($item->name)}}">
                            @if(strlen(__($item->name)) >20)
                            {{substr( __($item->name), 0,20).'...' }}
                            @else
                            {{__($item->name)}}
                            @endif
                            <br>
                            <span class="mt-2">{{$general->cur_sym}} {{showAmount($item->price)}}</span>
                        </h3>
                    </div>
                    <div class="single-service__bottom">
                        <a href="{{route('user.direct.order',$item->id)}}" class="btn--small">@lang('Order Now')</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- ==================== Service End Here ==================== -->
