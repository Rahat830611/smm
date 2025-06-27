@extends($activeTemplate.'layouts.master')
@section('content')
<div class="col-xl-9 col-lg-12">
    <div class="dashboard-body account-form">
        <div class="dashboard-body__bar">
            <span class="dashboard-body__bar-icon"><i class="las la-bars"></i></span>
        </div>
        <div class="row justify-content-center gy-4">
                <div class="show-filter mb-3 text-end">
                    <button type="button" class="btn btn--base showFilterBtn btn-sm"><i class="las la-check"></i>
                        @lang('Apply')</button>
                </div>
                <div class="responsive-filter-card mb-4">
                        <form action="">
                            <div class="row gy-3">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="username" class="form--label"> @lang('Transaction Number')</label>
                                        <input type="text" name="search" value="{{ request()->search }}"
                                            class="form--control">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="username" class="form--label"> @lang('Type')</label>
                                        <select name="type" class="form--control">
                                            <option value="">@lang('All')</option>
                                            <option value="+" @selected(request()->type == '+')>@lang('Plus')</option>
                                            <option value="-" @selected(request()->type == '-')>@lang('Minus')</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="username" class="form--label"> @lang('Remark')</label>
                                        <select class="form--control" name="remark">
                                            <option value="">@lang('Any')</option>
                                            @foreach($remarks as $remark)
                                            <option value="{{ $remark->remark }}" @selected(request()->remark ==
                                                $remark->remark)>{{ __(keyToTitle($remark->remark)) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="username" class="form--label"></label>
                                        <button class="btn btn--base w-100"><i class="las la-filter"></i>
                                            @lang('Filter')</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                </div>

                <table class="table table--responsive--lg">
                    <thead>
                        <tr>
                            <th>@lang('Trx')</th>
                            <th>@lang('Transacted')</th>
                            <th>@lang('Amount')</th>
                            <th>@lang('Post Balance')</th>
                            <th>@lang('Detail')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $trx)
                        <tr>
                            <td data-label="@lang('Trx')">
                                <strong>{{ $trx->trx }}</strong>
                            </td>

                            <td data-label="@lang('Transacted')">
                                {{ showDateTime($trx->created_at)}}
                            </td>

                            <td class="budget" data-label="@lang('Amount')">
                                <span
                                    class="fw-bold @if($trx->trx_type == '+')text-success @else text-danger @endif">
                                    {{ $trx->trx_type }} {{showAmount($trx->amount)}} {{ $general->cur_text
                                    }}
                                </span>
                            </td>

                            <td class="budget" data-label="@lang('Post Balance')">
                                {{ showAmount($trx->post_balance) }} {{ __($general->cur_text) }}
                            </td>


                            <td data-label="@lang('Detail')">{{ __($trx->details) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                @if($transactions->hasPages())
                <div class="text-end">
                    {{ $transactions->links() }}
                </div>
                @endif
        </div>
    </div>
</div>

@endsection
