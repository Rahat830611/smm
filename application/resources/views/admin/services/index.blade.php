@extends('admin.layouts.app')
@section('panel')

<div class="row">
    <div class="col-lg-12">
        <div class="card b-radius--10 ">
            <div class="card-body p-0">
                <div class="table-responsive--sm table-responsive">
                    <table class="table table--light style--two">
                        <thead>
                            <tr>
                                <th>@lang('Category Name')</th>
                                <th>@lang('Service Name')</th>
                                <th>@lang('Provider')</th>
                                <th>@lang('Price')</th>
                                <th>@lang('Min')</th>
                                <th>@lang('Max')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($services as $item)
                            <tr>
                                <td>{{ __(@$item->category->name) }}</td>
                                <td>{{ __($item->name) }}</td>
                                <td>
                                    @if (@$item->provider->name)
                                        <span class="badge badge--primary" title="Api Provider">{{ __(@$item->provider->name) }}</span>
                                        @else
                                        <span class="badge badge--warning">@lang('Manual')</span>
                                    @endif
                            </td>
                                <td>{{ showAmount($item->price) }}</td>
                                <td>{{ __($item->min) }}</td>
                                <td>{{ __($item->max) }}</td>
                                <td>
                                    @php
                                        echo $item->statusBadge($item->status);
                                    @endphp
                                </td>


                                <td>
                                    <a href="{{route('admin.services.edit',$item->id)}}" title="@lang('Edit')"
                                     data-id="{{$item->id}}"
                                        class="btn btn-sm btn--primary ">
                                        <i class="las la-edit"></i>
                                    </a>
                                    <button title="@lang('Remove')"
                                     data-id="{{$item->id}}"
                                        class="btn btn-sm btn--danger rejectBtn">
                                        <i class="las la-trash"></i>
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
            @if ($services->hasPages())
            <div class="card-footer py-4">
                {{ paginateLinks($services) }}
            </div>
            @endif
        </div><!-- card end -->
    </div>
</div>


{{-- delete modal --}}
<div id="rejectModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Delete Service Confirmation')</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="las la-times"></i>
                </button>
            </div>
            <form action="{{route('admin.services.delete')}}" method="POST">
                @csrf
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p>@lang('Are you sure to') <span class="fw-bold">@lang('delete')</span> <span
                            class="fw-bold withdraw-amount text-success"></span> @lang('this service') <span
                            class="fw-bold withdraw-user"></span>?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn--danger btn-global">@lang('Delete')</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('breadcrumb-plugins')
<a href="{{route('admin.services.create')}}" class="btn btn-sm btn--primary ">
    @lang('Add Service')</a>
@endpush

@push('script')
<script>
    "use strict";
    $('.rejectBtn').on('click', function () {
            var modal = $('#rejectModal');
            modal.find('input[name=id]').val($(this).data('id'));
            modal.modal('show');
        });
</script>
@endpush

