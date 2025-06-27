@extends($activeTemplate.'layouts.master')
@section('content')
<div class="col-xl-9 col-lg-12">
    <div class="dashboard-body account-form">
        <div class="dashboard-body__bar">
            <span class="dashboard-body__bar-icon"><i class="las la-bars"></i></span>
        </div>
        <div class="row gy-4 justify-content-center">
            <div class="col-lg-12">
                <h4>{{__($pageTitle)}}</h4>
                <div class="order-wrap">
                    <div class="row justify-content-end">
                    </div>
                        <table class="table table--responsive--lg">
                            <thead>
                                <tr>
                                    <th>@lang('Order No')</th>
                                    <th>@lang('Category Name')</th>
                                    <th>@lang('Service Name')</th>
                                    <th>@lang('Link')</th>
                                    <th>@lang('Price')</th>
                                    <th>@lang('Start Counter')</th>
                                    <th>@lang('Remain Counter')</th>
                                    <th>@lang('Status')</th>
                                </tr>
                            </thead>
                            <tbody>
                               @forelse($orders as $item)
                               <tr class="text-center">
                                <td data-label="@lang('Order No')">#{{ __($item->order_no) }}</td>
                                <td data-label="@lang('Category Name')">{{ __(@$item->category->name) }}</td>
                                <td data-label="@lang('Service Name')">{{ __(@$item->service->name) }}</td>
                                <td data-label="@lang('Link')">
                                    <a href="{{ __($item->link) }}" target="_blank">{{ __($item->link) }}</a>
                                </td>
                                <td data-label="@lang('Price')">{{$general->cur_sym}} {{ showAmount($item->price) }}</td>
                                <td data-label="@lang('Start Counter')">{{ __($item->start_count) }}</td>
                                <td data-label="@lang('Remain Counter')">{{ __($item->remain_count) }}</td>
                                <td data-label="@lang('Status')">
                                    @php
                                        echo $item->statusBadge($item->status);
                                    @endphp
                                </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%" data-label="Order Table">{{ __($emptyMessage) }}</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                   </div>
                   @if ($orders->hasPages())
                   <div class="py-4">
                       {{ paginateLinks($orders) }}
                   </div>
                   @endif
            </div>

        </div>
    </div>
</div>
@endsection
