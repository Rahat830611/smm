@php
$wheretoBegin = getContent('where_to_begin.content',true);
$wheretoBeginElements = getContent('where_to_begin.element',false);
@endphp
<!-- ==================== Experience Start Here ==================== -->
<section class="experience-area py-80 ">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="section-heading  text-center">
                    <span class="subtitle">{{__($wheretoBegin->data_values->top_heading)}}</span>
                    <h2 class="section-heading__title">
                        {{__($wheretoBegin->data_values->heading)}}
                    </h2>
                    <p class="section-heading__desc">{{__($wheretoBegin->data_values->sub_heading)}}</p>
                </div>
            </div>
        </div>
        <div class="row gy-4 justify-content-center">
            @foreach($wheretoBeginElements as $item)
            <div class="col-lg-3 col-md-4">
                <div class="experience">
                    <div class="experience__icon">
                        @php echo $item->data_values->service_icon; @endphp
                    </div>
                    <div class="experience__content">
                        <h3 class="title">
                             @if(strlen(strip_tags($item->data_values->title)) >50)
                            {{substr(strip_tags($item->data_values->title), 0,50).'...' }}
                            @else
                            {{strip_tags($item->data_values->title)}}
                            @endif </h3>
                    </div>
                    <div class="experience__content">
                        <p>
                            @if(strlen(__($item->data_values->description)) >80)
                            {{substr( __($item->data_values->description), 0,80).'...' }}
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
<!-- ==================== Experience End Here ==================== -->
