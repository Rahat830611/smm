@php
$counterElements = getContent('counter.element',false,4);
@endphp


<!-- ==================== Experience Start Here ==================== -->
<section class="experience-area section-bg py-80 ">
    <div class="container">
        <div class="row gy-4 justify-content-center">
            @foreach($counterElements as $item)
            <div class="col-lg-3 col-md-4">
                <div class="experience">
                    <div class="experience__icon">
                        @php
                        echo $item->data_values->counter_icon;
                        @endphp
                    </div>
                    <div class="experience__count">
                        <h3><span class="odometer" data-count="{{__($item->data_values->counter_digit)}}">00</span><span class="letter">+</span></h3>
                    </div>
                    <div class="experience__content">
                        <h3 class="title">{{__($item->data_values->title)}}</h3>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- ==================== Experience End Here ==================== -->
