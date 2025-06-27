@php
$about = getContent('about.content',true);
@endphp

<!--========================== About Section Start ==========================-->
<div class="about-section pt-80 pb-100">
    <div class="container">
        <div class="row gy-4 align-items-center">

            <div class="col-lg-6 position-relative">
                <div class="about-right-content">
                     <div class="section-heading mb-0">
                        <span class="subtitle">{{__($about->data_values->top_heading)}}</span>
                         <h2 class="section-heading__title">
                            {{__($about->data_values->heading)}}
                         </h2>
                         <p class="section-heading__desc mb-3">{{__($about->data_values->description1)}}</p>

                             <p class="section-heading__desc mb-4">{{__($about->data_values->description2)}}</p>
                         <div class="about-bottom">
                            <a href="{{url('/about')}}" class="btn btn--base me-3 mb-2">
                                @lang('View More') <i class="fas fa-arrow-right"></i>
                            </a>
                         </div>
                     </div>
                </div>
            </div>

            <div class="col-lg-6 position-relative">
                <div class="about-thumb">
                    <div class="about-thumb__inner">
                        <img class="img-2" src="{{getImage(getFilePath('about').'/'.@$about->data_values->about_image)}}" alt="image">
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!--========================== About Section End ==========================-->
