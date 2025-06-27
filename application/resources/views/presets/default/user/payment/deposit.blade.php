@extends($activeTemplate.'layouts.master')
@section('content')
<div class="col-xl-9 col-lg-12">
    <div class="dashboard-body account-form">
        <div class="dashboard-body__bar">
            <span class="dashboard-body__bar-icon"><i class="las la-bars"></i></span>
        </div>
        <div class="row gy-4 justify-content-center">
            <form action="{{route('user.deposit.insert')}}" method="post">
                @csrf
                <input type="hidden" name="method_code">
                <input type="hidden" name="currency">
                    <h3 class="contact__title">{{$pageTitle}}</h3>
                        <div class="form-group">
                            <label class="form--label">@lang('Select Gateway')</label>
                            <select class="form-control form--control" name="gateway" required>
                                <option value="">@lang('Select One')</option>
                                @foreach($gatewayCurrency as $data)
                                <option value="{{$data->method_code}}" @selected(old('gateway')==$data->method_code)
                                    data-gateway="{{ $data }}">{{$data->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form--label">@lang('Amount')</label>
                            <div class="input-group country-code">
                                <span class="input-group-text">{{ $general->cur_text }}</span>
                                <input type="number" step="any" name="amount" class="form-control form--control"
                                    value="{{ old('amount') }}" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="mt-3 preview-details d-none">
                            <span>@lang('Limit')</span>
                            <span><span class="min fw-bold">0</span> {{__($general->cur_text)}} - <span
                                    class="max fw-bold">0</span> {{__($general->cur_text)}} , </span>
                            <span>@lang('Charge')</span>
                            <span><span class="charge fw-bold">0</span> {{__($general->cur_text)}} ,</span>
                            <span>@lang('Payable')</span> <span><span class="payable fw-bold"> 0</span>
                                {{__($general->cur_text)}} </span>
                        </div>
                        <button type="submit" class="btn btn--base w-50 mt-3">@lang('Submit')</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    (function ($) {
        "use strict";
        $('select[name=gateway]').change(function () {
            if (!$('select[name=gateway]').val()) {
                $('.preview-details').addClass('d-none');
                return false;
            }
            var resource = $('select[name=gateway] option:selected').data('gateway');
            var fixed_charge = parseFloat(resource.fixed_charge);
            var percent_charge = parseFloat(resource.percent_charge);
            var rate = parseFloat(resource.rate)
            if (resource.method.crypto == 1) {
                var toFixedDigit = 8;
                $('.crypto_currency').removeClass('d-none');
            } else {
                var toFixedDigit = 2;
                $('.crypto_currency').addClass('d-none');
            }
            $('.min').text(parseFloat(resource.min_amount).toFixed(2));
            $('.max').text(parseFloat(resource.max_amount).toFixed(2));
            var amount = parseFloat($('input[name=amount]').val());
            if (!amount) {
                amount = 0;
            }
            if (amount <= 0) {
                $('.preview-details').addClass('d-none');
                return false;
            }
            $('.preview-details').removeClass('d-none');
            var charge = parseFloat(fixed_charge + (amount * percent_charge / 100)).toFixed(2);
            $('.charge').text(charge);
            var payable = parseFloat((parseFloat(amount) + parseFloat(charge))).toFixed(2);
            $('.payable').text(payable);
            var final_amo = (parseFloat((parseFloat(amount) + parseFloat(charge))) * rate).toFixed(toFixedDigit);
            $('.final_amo').text(final_amo);
            if (resource.currency != '{{ $general->cur_text }}') {
                var rateElement = `<span class="fw-bold">@lang('Conversion Rate')</span> <span><span  class="fw-bold">1 {{__($general->cur_text)}} = <span class="rate">${rate}</span>  <span class="base-currency">${resource.currency}</span></span></span>`;
                $('.rate-element').html(rateElement)
                $('.rate-element').removeClass('d-none');
                $('.in-site-cur').removeClass('d-none');
                $('.rate-element').addClass('d-flex');
                $('.in-site-cur').addClass('d-flex');
            } else {
                $('.rate-element').html('')
                $('.rate-element').addClass('d-none');
                $('.in-site-cur').addClass('d-none');
                $('.rate-element').removeClass('d-flex');
                $('.in-site-cur').removeClass('d-flex');
            }
            $('.base-currency').text(resource.currency);
            $('.method_currency').text(resource.currency);
            $('input[name=currency]').val(resource.currency);
            $('input[name=method_code]').val(resource.method_code);
            $('input[name=amount]').on('input');
        });
        $('input[name=amount]').on('input', function () {
            $('select[name=gateway]').change();
            $('.amount').text(parseFloat($(this).val()).toFixed(2));
        });
    })(jQuery);
</script>
@endpush
