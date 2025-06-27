@extends('admin.layouts.app')
@section('panel')
@include('admin.components.tabs.order')
<div class="row">
    <div class="col-lg-12">
        <div class="card b-radius--10 ">
            <div class="card-body p-0">
                <div class="table-responsive--sm table-responsive">
                    <table class="table table--light style--two">
                        <thead>
                            <tr>
                                <th>@lang('Order No')</th>
                                <th>@lang('Category Name')</th>
                                <th>@lang('Service Name')</th>
                                <th>@lang('User Name')</th>
                                <th>@lang('Link')</th>
                                <th>@lang('Price')</th>
                                <th>@lang('Start Counter')</th>
                                <th>@lang('Remain Counter')</th>
                                <th>@lang('Api Order')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $item)
                            <tr>

                                <td>#{{ __($item->order_no) }}</td>
                                <td>{{ __(@$item->category->name) }}</td>
                                <td>{{ (@$item->service->name) }}</td>
                                <td>{{ __($item->user->username) }}</td>
                                <td><a href="{{ __($item->link) }}" target="_blank">{{ __($item->link) }}</a></td>
                                <td>{{$general->cur_sym}} {{ showAmount($item->price) }}</td>
                                <td>{{ __($item->start_count) }}</td>
                                <td>{{ __($item->remain_count) }}</td>
                                <td>
                                    @if ($item->api_order)
                                        <span class="badge  badge--primary">@lang('Yes')</span>
                                    @else
                                        <span class="badge  badge--warning">@lang('No')</span>
                                    @endif
                                </td>

                                <td>
                                    @php
                                        echo $item->statusBadge($item->status);
                                    @endphp
                                </td>

                                <td>
                                    <button title="@lang('Edit')"
                                     data-id="{{$item->id}}" data-start_count="{{$item->start_count}}" data-remain_count="{{$item->remain_count}}"
                                     data-status="{{$item->status}}"
                                        class="btn btn-sm btn--primary countUpdate">
                                        <i class="las la-edit"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table><!-- table end -->
                </div>
            </div>
            @if ($orders->hasPages())
            <div class="card-footer py-4">
                {{ paginateLinks($orders) }}
            </div>
            @endif
        </div><!-- card end -->
    </div>
</div>


{{-- update modal --}}
<div id="countUpdateModel" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Update')</h5>
                <button type="button" class="close btn btn--danger" data-bs-dismiss="modal" aria-label="Close">
                    <i class="las la-times"></i>
                </button>
            </div>
            <form action="{{route('admin.order.update')}}" method="POST">
                @csrf
                <input type="hidden" name="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label  for="name"> @lang('Start Counter'):</label>
                        @if (@$item->status == 0 || @$item->status == 1)
                        <input type="text" class="form-control" name="start_count">
                        @else
                        <span class="badge badge--success">{{ @$item->start_counter }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label  for="name"> @lang('Status'):</label>
                        @if (@$item->status == 0  || @$item->status == 1)
                        <select name="status" class="form-control">
                            <option value="0" {{ @$item->status == 0 ? 'selected' : '' }}>@lang('Pending')</option>
                            <option value="1" {{ @$item->status == 1 ? 'selected' : '' }}>@lang('Processing')</option>
                            <option value="2" {{ @$item->status == 2 ? 'selected' : '' }}>@lang('Completed')</option>
                            <option value="3" {{ @$item->status == 3 ? 'selected' : '' }}>@lang('Cancelled')</option>
                            <option value="4" {{ @$item->status == 4 ? 'selected' : '' }}>@lang('Refunded')</option>
                        </select>
                        @elseif(@$item->status == 2)
                            <span class="badge  badge--success">@lang('Completed')</span>
                        @elseif(@$item->status == 3)
                            <span class="badge  badge--danger">@lang('Cancelled')</span>
                        @else
                            <span class="badge  badge--dark">@lang('Refunded')</span>
                        @endif
                    </div>
                </div>
                @if (@$item->status == 0 || @$item->status == 1)
                <div class="modal-footer">
                    <button type="submit" class="btn btn--primary btn-global">@lang('Submit')</button>
                </div>
                @endif
            </form>
        </div>
    </div>
</div>

@endsection


@push('script')
<script>
    "use strict";
    $('.countUpdate').on('click', function () {
            var modal = $('#countUpdateModel');
            var statusValue = $(this).data('status');
            modal.find('select[name=status]').val(statusValue);
            modal.find('input[name=id]').val($(this).data('id'));
            modal.find('input[name=start_count]').val($(this).data('start_count'));
            modal.modal('show');
        });
</script>
@endpush

