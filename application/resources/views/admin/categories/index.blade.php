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
                                <th>@lang('Name')</th>
                                <th>@lang('Icon')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <img src="{{ getImage(getFilePath('category').'/'.@$item->logo,getFileSize('category'))}}" alt="image">
                                </td>

                                <td>
                                    @php
                                        echo $item->statusBadge($item->status);
                                    @endphp
                                </td>

                                <td>
                                    <a href="{{route('admin.category.edit',$item->id)}}" title="@lang('Edit')"
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
            @if ($categories->hasPages())
            <div class="card-footer py-4">
                {{ paginateLinks($categories) }}
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
                <h5 class="modal-title">@lang('Delete Category Confirmation')</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="las la-times"></i>
                </button>
            </div>
            <form action="{{route('admin.category.delete')}}" method="POST">
                @csrf
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p>@lang('Are you sure to') <span class="fw-bold">@lang('delete')</span> <span
                            class="fw-bold withdraw-amount text-success"></span> @lang('this category') <span
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
<a href="{{route('admin.category.create')}}" class="btn btn-sm btn--primary ">
    @lang('Add Category')</a>
@endpush

@push('script')
<script>
    $('.rejectBtn').on('click', function () {
            var modal = $('#rejectModal');
            modal.find('input[name=id]').val($(this).data('id'));
            modal.modal('show');
        });
</script>
@endpush

