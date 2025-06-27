@php
$chooseUs = getContent('choose_us.content',true);
$chooseUsElements = getContent('choose_us.element',false);
@endphp
<!-- ==================== Why Choose us Start Here ==================== -->
<section class="why-choose-area section-bg py-80">
    <!-- <div class="why-choose-bg animate-zoom-fade"></div> -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="section-heading  text-center">
                    <span class="subtitle">{{__($chooseUs->data_values->top_heading)}}</span>
                    <h2 class="section-heading__title">
                        {{__($chooseUs->data_values->heading)}}
                    </h2>
                    <p class="section-heading__desc">{{__($chooseUs->data_values->sub_heading)}}</p>
                </div>
            </div>
        </div>
        <div class="row gy-4 ">
            @foreach($chooseUsElements as $item)
            <div class="col-lg-6">
                <div class="why-choose-item">
                    <div class="why-choose-item__icon">
                        @php echo $item->data_values->service_icon; @endphp
                    </div>
                    <div class="why-choose-item__content">
                        <h3 class="item-title">
                            @if(strlen(strip_tags($item->data_values->title)) >50)
                            {{substr(strip_tags($item->data_values->title), 0,50).'...' }}
                            @else
                            {{strip_tags($item->data_values->title)}}
                            @endif
                        </h3>
                        <p>
                            @if(strlen(__($item->data_values->description)) >150)
                            {{substr( __($item->data_values->description), 0,150).'...' }}
                            @else
                            {{__($item->data_values->description)}}
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- ==================== Why Choose us End Here ==================== -->
