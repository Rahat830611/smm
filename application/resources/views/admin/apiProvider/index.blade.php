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
                                <th>@lang('Short Name')</th>
                                <th>@lang('Url')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($apiProviders as $item)
                            <tr>
                                <td>{{__($item->name)}}</td>
                                <td>{{__($item->short_name)}}</td>
                                <td>{{__($item->api_url)}}</td>
                                <td> @php echo $item->statusBadge($item->status); @endphp</td>
                                <td>
                                    <button title="@lang('Remove')"
                                    data-id="{{$item->id}}" data-name="{{$item->name}}" data-short_name="{{$item->short_name}}"
                                    data-api_url="{{$item->api_url}}" data-api_key="{{$item->api_key}}" data-status="{{$item->status}}"
                                        class="btn btn-sm btn--primary apiUpdate">
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
            @if ($apiProviders->hasPages())
            <div class="card-footer py-4">
                {{ paginateLinks($apiProviders) }}
            </div>
            @endif
        </div><!-- card end -->
    </div>
</div>


{{-- update modal --}}
<div id="appiUpdateModel" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Update')</h5>
                <button type="button" class="close btn btn--danger" data-bs-dismiss="modal" aria-label="Close">
                    <i class="las la-times"></i>
                </button>
            </div>
            <form action="{{route('admin.api.provider.update')}}" method="POST">
                @csrf
                <input type="hidden" name="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label  for="name"> @lang('Api Name'):</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="form-group">
                        <label  for="short_name"> @lang('Api Short Name'):</label>
                        <input type="text" class="form-control" name="short_name">
                    </div>
                    <div class="form-group">
                        <label  for="api_ur"> @lang('Api Url'):</label>
                        <input type="text" class="form-control" name="api_url">
                    </div>
                    <div class="form-group">
                        <label  for="api_key"> @lang('Api Key'):</label>
                        <input type="text" class="form-control" name="api_key">
                    </div>
                    <div class="form-group">
                        <label> @lang('Status')</label>
                        <label class="switch m-0" for="statuss">
                            <input type="checkbox" class="toggle-switch" name="status" id="statuss">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn--primary btn-global">@lang('Submit')</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@push('breadcrumb-plugins')
<a href="{{route('admin.api.provider.create')}}" class="btn btn-sm btn--primary ">
    @lang('Add Api Provider')</a>
@endpush


@push('script')
<script>
    $('.apiUpdate').on('click', function () {
            var modal = $('#appiUpdateModel');
            modal.find('input[name=id]').val($(this).data('id'));
            modal.find('input[name=name]').val($(this).data('name'));
            modal.find('input[name=short_name]').val($(this).data('short_name'));
            modal.find('input[name=api_url]').val($(this).data('api_url'));
            modal.find('input[name=api_key]').val($(this).data('api_key'));
            modal.find('input[name=status]').prop('checked', $(this).data('status') == 1 ? true : false );
            modal.find('input[name=status]').val($(this).data('status') == 1 ? 1 : 0);
            modal.modal('show');
        });
</script>
@endpush

