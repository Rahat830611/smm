@php
  $faq = getContent('faq.content',true);
  $faqElement = getContent('faq.element',false);
@endphp
<!-- ==================== Accordion Start Here ==================== -->
<section class="accordion-area section-bg py-80 bg-img" style="background-image: url({{asset($activeTemplateTrue.'images/faq-bg.jpg')}});">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="section-heading  text-center">
                    <span class="subtitle">{{__($faq->data_values->top_heading)}}</span>
                    <h2 class="section-heading__title text-white">
                        {{__($faq->data_values->heading)}}
                    </h2>
                    <p class="section-heading__desc text-white">{{__($faq->data_values->sub_heading)}}</p>
                </div>
            </div>
        </div>
        <div class="row gy-4 align-items-center justify-content-center">
            <div class="col-lg-6">
                <div class="accordion custom--accordion" id="accordionExample">
                    @foreach ($faqElement as $item)
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="heading{{ $loop->index }}">
                        <button class="accordion-button {{ $loop->index == 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->index }}" aria-expanded="{{$loop->index == 0 ? 'true': 'false'}}">
                            {{__(@$item->data_values->question)}}
                        </button>
                      </h2>
                      <div id="collapse{{ $loop->index }}" class="accordion-collapse collapse {{$loop->index == 0 ? 'show': ''}}" aria-labelledby="heading{{ $loop->index }}" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            {{ strLimit(strip_tags(@$item->data_values->answer),350) }}
                        </div>
                      </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ==================== Accordion End Here ==================== -->
