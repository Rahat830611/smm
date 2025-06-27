
@php
$method = getContent('payment_method.content',true);
$methodElements = getContent('payment_method.element',false);
@endphp
<!--========================== Coverage Section Start ==========================-->
<div class="client py-60 section-bg">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-lg-10 position-relative">
                <div class="section-heading  text-center">
                    <span class="subtitle">{{__($method->data_values->top_heading)}}</span>
                    <h2 class="section-heading__title ">
                        {{__($method->data_values->heading)}}
                    </h2>
                    <p class="section-heading__desc mb-30">{{__($method->data_values->sub_heading)}}</p>
                </div>
            </div>
        </div>
        <div class="client-logos client-slider">
            @foreach($methodElements as $item)
            <img src="{{getImage(getFilePath('paymentMethod').'/'.$item->data_values->method_logo)}}" alt="image">
            @endforeach
        </div>
    </div>
</div>
<!--========================== Coverage Section End ==========================-->
