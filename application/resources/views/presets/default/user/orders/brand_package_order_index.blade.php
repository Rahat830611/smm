@extends($activeTemplate.'layouts.master')
@section('content')
<div class="col-xl-9 col-lg-12">
    <div class="dashboard-body account-form">
        <div class="dashboard-body__bar">
            <span class="dashboard-body__bar-icon"><i class="las la-bars"></i></span>
        </div>
        <div class="row gy-4 justify-content-center">
            <div class="col-lg-12">
                <div class="order-wrap">
                    <div class="row justify-content-end">
                    </div>
                        <table class="table table--responsive--lg">
                            <thead>
                                <tr>
                                    <th>@lang('Brand Package Name')</th>
                                    <th>@lang('Link')</th>
                                    <th>@lang('Price')</th>
                                    <th>@lang('Status')</th>
                                </tr>
                            </thead>
                            <tbody>
                               @forelse($brandPackageOrder as $item)
                               <tr>
                                <td data-label="@lang('Brand Package Name')">{{ __($item->name) }}</td>

                                @if($item->link)
                                <td data-label="@lang('Links')">
                                    @foreach(json_decode($item->link) as $key=>$value)
                                    <a href="{{$value}}" target="_blank">{{$value}}</a>
                                    <br><br>
                                    @endforeach
                                </td>
                                @endif

                                <td data-label="@lang('Price')">{{$general->cur_sym}} {{ showAmount($item->price) }}</td>

                                <td data-label="@lang('Status')">
                                    @php
                                        echo $item->statusBadge($item->status);
                                    @endphp
                                </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%" data-label="Package Table">{{ __($emptyMessage) }}</td>
                                </tr>
                               @endforelse
                            </tbody>
                        </table>
                   </div>
                   @if ($brandPackageOrder->hasPages())
                   <div class="py-4">
                       {{ paginateLinks($brandPackageOrder) }}
                   </div>
                   @endif
            </div>

        </div>
    </div>
</div>
@endsection
