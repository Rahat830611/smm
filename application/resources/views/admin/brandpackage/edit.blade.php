@extends('admin.layouts.app')
@section('panel')

    <div class="row mb-none-30">
        <div class="col-lg-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.brandpackage.update', $brandPackage->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">@lang('Name')</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ $brandPackage->name }}" required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="price" class="font-weight-bold">@lang('Price')</label>
                                    <input type="number" name="price" id="price" class="form-control"
                                        value="{{ showAmount($brandPackage->price) }}" required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label class="font-weight-bold">@lang('Link Field Name')</label>
                                <div class="content-fields">
                                    @php
                                        $linkField = json_decode($brandPackage->link_field, true);
                                    @endphp
                                    @if (!empty($linkField) && is_array($linkField))
                                        @foreach (json_decode(@$brandPackage->link_field, true) as $key => $value)
                                            <div class="row mb-2 content-field">
                                                <div class="col-12">
                                                    <div class="form-group form-wrapper-beside">
                                                        <div class="input-right-wrap">
                                                        <div class="form-group">
                                                            <input type="text" name="link_fields[{{ $key }}]"
                                                                id="content_{{ $key }}" value="{{ $value }}"
                                                                class="form-control" placeholder="@lang('Link Filed')">
                                                        </div>

                                                        </div>
                                                        <div class="input-close-wrap mt-0">
                                                        <button type="button" class="btn text--danger removeLinkField"><i
                                                                class="la la-times"></i></button>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>

                                <div class="col-12">
                                    <div id="linkField"></div>
                                </div>

                                <div class="col-12">
                                    <button type="button" class="btn btn--primary btn-block btn-lg addLinkField ms-0 mb-4">
                                        @lang('Add Item') <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>



                            <div class="col-lg-6">
                                <label class="font-weight-bold">@lang('Content')</label>
                                <div class="content-fields">
                                    @php
                                        $contents = json_decode($brandPackage->content, true);
                                    @endphp
                                    @if (!empty($contents) && is_array($contents))
                                        @foreach (json_decode(@$brandPackage->content) as $key => $value)
                                            <div class="row mb-2 content-field">
                                                <div class="col-12">
                                                    <div class="form-group form-wrapper-beside">
                                                        <div class="input-right-wrap">
                                                            <div class="form-group">
                                                                <input type="text" name="contents[{{ $key }}]"
                                                                    id="content_{{ $key }}" value="{{ $value }}"
                                                                    class="form-control" placeholder="@lang('Content')">
                                                            </div>

                                                        </div>

                                                        <div class="input-close-wrap mt-0">
                                                            <button type="button" class="btn text--danger removePlanContent"><i
                                                                    class="la la-times"></i></button>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        @endforeach
                                    @endif
                                </div>

                                <div class="col-12">
                                    <div id="planContent"></div>
                                </div>

                                <div class="col-12 mb-4">
                                    <button type="button" class="btn btn--primary btn-block btn-lg  addPlanContent ms-0">
                                        @lang('Add Item') <i class="fa fa-plus"></i></button>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <label class="fw-bold">@lang('Status')</label>
                                <label class="switch m-0">
                                    <input type="checkbox" class="toggle-switch" name="status"
                                        {{ $brandPackage->status ? 'checked' : null }}>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>

                        <div class="row text-end">
                            <div class="col-lg-12 ">
                                <div class="form-group float-end p-3">
                                    <button type="submit" class="btn btn--primary btn-block btn-lg">
                                        @lang('Update')</button>
                                </div>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('breadcrumb-plugins')
    <a href="{{ route('admin.brandpackage.index') }}" class="btn btn-sm btn--primary box--shadow1 text--small"><i
            class="las la-angle-double-left"></i>@lang('Go Back')</a>
@endpush

@push('script')
    <script>
        "use strict";
        (function($) {

            var fileAdded = 0;
            $('.addPlanContent').on('click', function() {

                $("#planContent").append(`
                    <div class="row">
                        <div class="col-10">
                            <div class="form-group">
                                        <input type="text" name="contents[]" id="content" value="{{ old('contents.0') }}"
                                            class="form-control" placeholder="@lang('Content')">
                            </div>
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn text--danger planContentDelete"><i class="la la-times ms-0"></i></button>
                        </div>
                    </div>
                `)
            });

            $(document).on('click', '.planContentDelete', function() {
                fileAdded--;
                $(this).closest('.row').remove();
            });



            // Remove content field
            $(document).on('click', '.removePlanContent', function() {
                $(this).closest('.content-field').remove();
            });

        })(jQuery);

        (function($) {
            var fileAdded = 0;
            $('.addLinkField').on('click', function() {

                $("#linkField").append(`
                <div class="row">
                    <div class="col-10">
                        <div class="form-group">
                                    <input type="text" name="link_fields[]" id="content" value="{{ old('link_fields.0') }}"
                                        class="form-control" placeholder="@lang('Link Filed')">
                        </div>
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn text--danger linkFieldDelete"><i class="la la-times ms-0"></i></button>
                    </div>
                </div>
            `)
            });

            $(document).on('click', '.linkFieldDelete', function() {
                fileAdded--;
                $(this).closest('.row').remove();
            });



            // Remove content field
            $(document).on('click', '.removeLinkField', function() {
                $(this).closest('.content-field').remove();
            });

        })(jQuery);
    </script>
@endpush
