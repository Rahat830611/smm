@extends('admin.layouts.app')
@section('panel')
@include('admin.components.tabs.brand_order')
<div class="row">
    <div class="col-lg-12">
        <div class="card b-radius--10 ">
            <div class="card-body p-0">
                <div class="table-responsive--sm table-responsive">
                    <table class="table table--light style--two">
                        <thead>
                            <tr>

                                <th>@lang('Package Name')</th>
                                <th>@lang('User Name')</th>
                                <th>@lang('Link')</th>
                                <th>@lang('Price')</th>
                                <th>@lang('Time')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $item)
                            <tr>
                                <td>{{ __($item->name) }}</td>
                                <td>{{ __($item->user->username) }}</td>

                                @if($item->link)
                                <td>
                                    @foreach(json_decode($item->link) as $key=>$value)
                                    <a href="{{ $value }}" target="_blank">{{$value }}</a>
                                    <br>
                                    @endforeach
                                </td>
                                @endif
                                <td>{{$general->cur_sym}} {{ showAmount($item->price) }}</td>


                                <td>{{ showDateTime($item->created_at) }}</td>


                                <td>
                                    @php
                                        echo $item->statusBadge($item->status);
                                    @endphp
                                </td>
                                <td>
                                    <button title="@lang('Edit')"
                                     data-id="{{$item->id}}"
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
            <form action="{{route('admin.order.brand-package.update')}}" method="POST">
                @csrf
                <input type="hidden" name="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">@lang('Status'):</label>
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
            modal.modal('show');
        });
</script>
@endpush

