@extends($activeTemplate.'layouts.master')
@section('content')
<div class="col-xl-9 col-lg-12">
    <div class="dashboard-body account-form deposit">
        <div class="dashboard-body__bar">
            <span class="dashboard-body__bar-icon"><i class="las la-bars"></i></span>
        </div>
        <div class="row gy-4">
            <div class="col-lg-6 col-md-12">
                <form action="">
                    <div class="mb-3 ">
                        <div class="input-group deposit-top-search">
                            <input type="text" name="search" class="form--control" value="{{ request()->search }}"
                                placeholder="@lang('Search by transactions')">
                            <button class="btn btn--base btn--sm detailBtn" type="submit">
                                <i class="las la-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card custom--card">
                <table class="table table--responsive--lg">
                    <thead>
                        <tr>
                            <th>@lang('Gateway')</th>
                            <th class="text-center">@lang('Initiated')</th>
                            <th class="text-center">@lang('Amount')</th>
                            <th class="text-center">@lang('Conversion')</th>
                            <th class="text-center">@lang('Status')</th>
                            <th>@lang('Details')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($deposits as $deposit)
                        <tr>
                            <td data-label="@lang('Gateway')">
                                <span class="fw-bold"> <span class="text-primary">{{
                                        __($deposit->gateway?->name) }}</span> </span>

                            </td>

                            <td class="text-center" data-label="@lang('Initiated')">
                                {{ showDateTime($deposit->created_at) }}
                            </td>
                            <td class="text-center" data-label="@lang('Amount')">
                                <strong title="@lang('Amount with charge')">
                                    {{ showAmount($deposit->amount+$deposit->charge) }} {{
                                    __($general->cur_text) }}
                                </strong>
                            </td>
                            <td class="text-center" data-label="@lang('Conversion')">

                                <strong>{{ showAmount($deposit->final_amo) }}
                                    {{__($deposit->method_currency)}}</strong>
                            </td>
                            <td class="text-center" data-label="@lang('Status')">
                                @php echo $deposit->statusBadge @endphp
                            </td>
                            @php
                            $details = ($deposit->detail != null) ? json_encode($deposit->detail) : null;
                            @endphp

                            <td data-label="@lang('Details')">
                                <a href="javascript:void(0)"
                                    class="btn btn--base btn--sm @if($deposit->method_code >= 1000) detailBtn @else disabled @endif"
                                    @if($deposit->method_code >= 1000)
                                    data-info="{{ $details }}"
                                    @endif
                                    @if ($deposit->status == 3)
                                    data-admin_feedback="{{ $deposit->admin_feedback }}"
                                    @endif
                                    >
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="100%" class="text-center">{{ __($emptyMessage) }}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                @if($deposits->hasPages())
                <div class="text-end">
                    {{ $deposits->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- APPROVE MODAL --}}
<div id="detailModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Details')</h5>
                <span type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="las la-times"></i>
                </span>
            </div>
            <div class="modal-body">
                <ul class="list-group userData mb-2">
                </ul>
                <div class="feedback"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark btn-sm" data-bs-dismiss="modal">@lang('Close')</button>
            </div>
        </div>
    </div>
</div>

@endsection


@push('script')
<script>
    (function ($) {
        "use strict";
        $('.detailBtn').on('click', function () {
            var modal = $('#detailModal');

            var userData = $(this).data('info');
            var html = '';
            if (userData) {
                userData.forEach(element => {
                    if (element.type != 'file') {
                        html += `
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>${element.name}</span>
                                <span">${element.value}</span>
                            </li>`;
                    }
                });
            }

            modal.find('.userData').html(html);

            if ($(this).data('admin_feedback') != undefined) {
                var adminFeedback = `
                        <div class="my-3">
                            <strong>@lang('Admin Feedback')</strong>
                            <p>${$(this).data('admin_feedback')}</p>
                        </div>
                    `;
            } else {
                var adminFeedback = '';
            }

            modal.find('.feedback').html(adminFeedback);


            modal.modal('show');
        });
    })(jQuery);

</script>
@endpush
