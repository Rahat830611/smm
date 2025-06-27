@extends('admin.layouts.app')

@section('panel')
@if(@json_decode($general->system_info)->message)
<div class="row">
    @foreach(json_decode($general->system_info)->message as $msg)
    <div class="col-md-12">
        <div class="alert border border--primary" role="alert">
            <div class="alert__icon bg--primary"><i class="far fa-bell"></i></div>
            <p class="alert__message">@php echo $msg; @endphp</p>
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    </div>
    @endforeach
</div>
@endif
<div class="row gy-4">
    <div class="col-xl-6">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">@lang('Monthly Deposit Report') (@lang('This Month'))</h5>
                <div id="account-chart"></div>
            </div>
        </div>
    </div>
    <div class="col-xl-6">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">@lang('Order Place Report (last 30 days)')</h5>
                <div id="subscription-chart"></div>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">@lang('Daily Logins') (@lang('Last 10 days'))</h5>
                <div id="login-chart"></div>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="row gy-4">
            <div class="col-sm-6">
                <a href="{{route('admin.deposit.list')}}">
                    <div class="card prod-p-card background-pattern">
                        <div class="card-body">
                            <div class="row align-items-center m-b-0">
                                <div class="col">
                                    <h6 class="m-b-5">@lang('Total Deposited')</h6>
                                    <h3 class="m-b-0">{{ $general->cur_sym
                                        }}{{showAmount($deposit['total_deposit_amount'])}}</h3>
                                </div>
                                <div class="col-auto">
                                    <i class="dashboard-widget__icon fas fa-hand-holding-usd"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-6">
                <a href="{{route('admin.deposit.list')}}">
                    <div class="card prod-p-card background-pattern-white bg--primary">
                        <div class="card-body">
                            <div class="row align-items-center m-b-0">
                                <div class="col">
                                    <h6 class="m-b-5 text-white">@lang('Deposited Charge')</h6>
                                    <h3 class="m-b-0 text-white">{{ $general->cur_sym
                                        }}{{showAmount($deposit['total_deposit_charge'])}}</h3>
                                </div>
                                <div class="col-auto">
                                    <i class="dashboard-widget__icon fas fa-percentage text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-6">
                <a href="{{route('admin.order.index')}}">
                    <div class="card prod-p-card background-pattern-white bg--primary">
                        <div class="card-body">
                            <div class="row align-items-center m-b-0">
                                <div class="col">
                                    <h6 class="m-b-5 text-white">@lang('Total Orders')</h6>
                                    <h3 class="m-b-0 text-white">{{__($orderCount['total_order'])}}</h3>
                                </div>
                                <div class="col-auto">
                                    <i class="dashboard-widget__icon las la-cart-arrow-down text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-6">
                <a href="{{route('admin.order.complete')}}">
                    <div class="card prod-p-card background-pattern">
                        <div class="card-body">
                            <div class="row align-items-center m-b-0">
                                <div class="col">
                                    <h6 class="m-b-5">@lang('Total Complete Orders')</h6>
                                    <h3 class="m-b-0">{{__($completeOrderCount['total_complete_order'])}}</h3>
                                </div>
                                <div class="col-auto">
                                    <i class="dashboard-widget__icon las la-shopping-bag"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-12">
                <div class="card p-3 rounded-3">
                    <div class="row g-0">
                        <div class="col-sm-4 col-6 col-xl-6 col-xxl-4">
                            <div class="dashboard-widget">
                                <div class="dashboard-widget__icon">
                                    <i class="dashboard-card-icon las la-users"></i>
                                </div>
                                <div class="dashboard-widget__content">
                                    <a title="@lang('View all')" class="dashboard-widget-link"
                                        href="{{route('admin.users.all')}}"></a>
                                    <h5>{{$widget['total_users']}}</h5>
                                    <span>@lang('Total Users')</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-6 col-xl-6 col-xxl-4 ">
                            <div class="dashboard-widget">
                                <div class="dashboard-widget__icon">
                                    <i class="dashboard-card-icon las la-user-check"></i>
                                </div>
                                <div class="dashboard-widget__content">
                                    <a title="@lang('View all')" class="dashboard-widget-link"
                                        href="{{route('admin.users.active')}}"></a>
                                    <h5>{{$widget['verified_users']}}</h5>
                                    <span>@lang('Active Users')</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-6 col-xl-6 col-xxl-4">
                            <div class="dashboard-widget">
                                <div class="dashboard-widget__icon">
                                    <i class="dashboard-card-icon las la-envelope"></i>
                                </div>
                                <div class="dashboard-widget__content">
                                    <a title="@lang('View all')" class="dashboard-widget-link"
                                        href="{{route('admin.users.email.unverified')}}"></a>
                                    <h5>{{$widget['email_unverified_users']}}</h5>
                                    <span>@lang('Email Unverified')</span>
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-4 col-6 col-xl-6 col-xxl-4">
                            <div class="dashboard-widget">
                                <div class="dashboard-widget__icon">
                                    <i class="dashboard-card-icon las la-list"></i>
                                </div>
                                <div class="dashboard-widget__content">
                                    <a title="@lang('View all')" class="dashboard-widget-link"
                                        href="{{route('admin.services.index')}}"></a>
                                    <h5>{{__($serviceCount['total_service'])}}</h5>
                                    <span>@lang('Total Service')</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-6 col-xl-6 col-xxl-4">
                            <div class="dashboard-widget">
                                <div class="dashboard-widget__icon">
                                    <i class="dashboard-card-icon las la-spinner"></i>
                                </div>
                                <div class="dashboard-widget__content">
                                    <a title="@lang('View all')" class="dashboard-widget-link"
                                        href="{{route('admin.deposit.pending')}}"></a>
                                    <h5>{{$deposit['total_deposit_pending']}}</h5>
                                    <span>@lang('Pending Deposits')</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-6 col-xl-6 col-xxl-4">
                            <div class="dashboard-widget">
                                <div class="dashboard-widget__icon">
                                    <i class="dashboard-card-icon las la-ban"></i>
                                </div>
                                <div class="dashboard-widget__content">
                                    <a title="@lang('View all')" class="dashboard-widget-link"
                                        href="{{route('admin.deposit.rejected')}}">
                                    </a>
                                    <h5>{{$deposit['total_deposit_rejected']}}</h5>
                                    <span>@lang('Rejected Deposits')</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h5 class="card-title">@lang('Recent Tickets')</h5>
                    <a href="{{route('admin.ticket.pending')}}" class="float-end" target="_blank">@lang('View all')</a>
                </div>
                <div class="table-responsive--sm table-responsive">
                    <table class="table table--light">
                        <thead>
                            <tr>
                                <th>@lang('Subject')</th>
                                <th>@lang('Status')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($newTickets as $item)
                            <tr>
                                <td>
                                    <a class="" href="{{ route('admin.ticket.view', $item->id) }}" class="fw-bold">
                                        @lang('Ticket')#{{ $item->ticket }} - {{ strLimit($item->subject,30) }} </a>
                                </td>
                                <td>
                                    @php echo $item->statusBadge; @endphp
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

  {{-- cron modal --}}
<div class="modal fade" id="cronModal" role="dialog" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">@lang('Cron Job Setting Instruction')</h5>
                <button class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
                    <i class="las la-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <h3 class="text--danger text-center">@lang('Please Set Cron Job Now')</h3>
                <p class="lead">
                    @lang('To automate the api order placement, we need to set the cron job and make sure the cron job is running properly. Set the Cron time as minimum as possible. Once per 15-30 minutes is ideal while once every minute is the best option.') </p>
                <label class="font-weight-bold">@lang('Cron Command')</label>

                <div class="input-group">
                    <input class="form-control" id="referralURL" name="text" type="text" value="curl -s {{ route('cron') }}" readonly>
                    <span class="input-group-text copytext btn btn--primary copyBoard pt-2" id="copyBoard">
                        @lang('Copy')
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@push('breadcrumb-plugins')
    @php
        $lastCron = Carbon\Carbon::parse($general->last_cron)->diffInSeconds();
    @endphp
    <span
        class=" btn btn--primary @if ($lastCron < 300) text-white @elseif($lastCron < 900) text--warning @else text--white @endif">
        @lang('Last Cron Run')
        <strong>{{ diffForHumans($general->last_cron) }}</strong>
    </span>
@endpush

@push('script')
<script src="{{asset('assets/admin/js/apexcharts.min.js')}}"></script>

<script>
    (function($) {
        "use strict";
        @if (Carbon\Carbon::parse($general->last_cron)->diffInMinutes() > 30)
        window.onload = () => {
        $('#cronModal').modal('show');
        }
        @endif

        $('.copyBoard').on('click', function() {
            var copyText = document.getElementById("referralURL");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");
            iziToast.success({
                message: "Copied: " + copyText.value,
                position: "topRight"
            });
        });
    })(jQuery);
</script>

<script>
    "use strict";
    // [ account-chart ] start
    (function () {
        var options = {
            chart: {
                type: 'area',
                stacked: false,
                height: '310px'
            },
            stroke: {
                width: [0, 3],
                curve: 'smooth'
            },
            plotOptions: {
                bar: {
                    columnWidth: '50%'
                }
            },
            colors: ['#00adad', '#67BAA7'],
            series: [{
        name: '@lang("Deposits")',
        type: 'area',
        data: @json($depositsChart['values'])
    }],
    fill: {
        opacity: [0.85, 1],
                },
    labels: @json($depositsChart['labels']),
    markers: {
        size: 0
    },
    xaxis: {
        type: 'text'
    },
    yaxis: {
        min: 0
    },
    tooltip: {
        shared: true,
            intersect: false,
                y: {
            formatter: function (y) {
                if (typeof y !== "undefined") {
                    return "$ " + y.toFixed(0);
                }
                return y;

            }
        }
    },
    legend: {
        labels: {
            useSeriesColors: true
        },
        markers: {
            customHTML: [
                function () {
                    return ''
                },
                function () {
                    return ''
                }
            ]
        }
    }
            }
    var chart = new ApexCharts(
        document.querySelector("#account-chart"),
        options
    );
    chart.render();
        }) ();

    // [ login-chart ] start
    (function () {
        var options = {
            series: [{
                name: "User Count",
                data: @json($userLogins['values'])
    }],
    chart: {
        height: '310px',
            type: 'area',
                zoom: {
            enabled: false
        }
    },
    dataLabels: {
        enabled: false
    },
    stroke: {
        curve: 'smooth'
    },
    colors: ['#00adad'],
        labels: @json($userLogins['labels']),
    xaxis: {
        type: 'date',
            },
    yaxis: {
        opposite: true
    },
    legend: {
        horizontalAlign: 'left'
    }
        };

    var chart = new ApexCharts(document.querySelector("#login-chart"), options);
    chart.render();
    }) ();


    // subscription
    (function () {
        var options = {
            chart: {
                type: 'area',
                stacked: false,
                height: '310px'
            },
            stroke: {
                width: [0, 3],
                curve: 'smooth'
            },
            plotOptions: {
                bar: {
                    columnWidth: '50%'
                }
            },
            colors: ['#00adad', '#67BAA7'],
            series: [{
        name: "Subscriptions",
        data: @json($subscriptionsReport['values'])
    }],

    fill: {
        opacity: [0.85, 1],
    },
    labels: @json($subscriptionsReport['labels']),
    markers: {
        size: 0
    },
    xaxis: {
        type: 'text'
    },
    yaxis: {
        min: 0
    },
    tooltip: {
        shared: true,
            intersect: false,
                y: {
            formatter: function (y) {
                if (typeof y !== "undefined") {
                    return "" + y.toFixed(0);
                }
                return y;

            }
        }
    },
    legend: {
        labels: {
            useSeriesColors: true
        },
        markers: {
            customHTML: [
                function () {
                    return ''
                },
                function () {
                    return ''
                }
            ]
        }
    }
            }
    var chart = new ApexCharts(
        document.querySelector("#subscription-chart"),
        options
    );
    chart.render();
        }) ();
</script>
@endpush
