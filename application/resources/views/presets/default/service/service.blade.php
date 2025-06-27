@extends($activeTemplate.'layouts.frontend')
@section('content')
<!-- ==================== Service Start Here ==================== -->
@foreach ($categories as $item)
<section class="single-service-area pt-80 py-80 ">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading d-flex align-items-center">

                    <div class="experience__icon mb-1 me-2">
                        <img src="{{ getImage(getFilePath('category').'/'.@$item->logo,getFileSize('category'))}}" alt="image">
                    </div>
                    <h2 class="section-heading__title">
                       {{__($item->name)}}
                    </h2>
                </div>
            </div>
        </div>
        <div class="row gy-4 justify-content-center">
            @forelse($item->services  as $value)
            <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                <div class="single-service text-center">
                    <div class="single-service__icon">
                        <img src="{{ getImage(getFilePath('category').'/'.@$item->logo,getFileSize('category'))}}" alt="image">
                    </div>
                    <div class="single-service__content">
                        <h3 class="title" title="{{__($value->name)}}">
                            @if(strlen(__($value->name)) >20)
                            {{substr( __($value->name), 0,20).'...' }}
                            @else
                            {{__($value->name)}}
                            @endif
                            <br>
                            <span class="mt-2">{{$general->cur_sym}} {{showAmount($value->price)}}</span>
                        </h3>
                    </div>
                    <div class="single-service__bottom">
                        <a href="{{route('user.direct.order',$value->id)}}" class="btn--small ">@lang('Order Now')</a>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</p>
            @endforelse
        </div>
    </div>
</section>
@endforeach

<!-- ==================== Service End Here ==================== -->
@endsection
