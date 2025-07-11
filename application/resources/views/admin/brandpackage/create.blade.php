@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-lg-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.brandpackage.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">@lang('Name')</label>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                                        class="form-control " placeholder="@lang('Name')" required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="price" class="font-weight-bold">@lang('Price')</label>
                                    <input type="number" name="price" id="price" value="{{ old('price') }}"
                                        class="form-control " placeholder="@lang('Price')" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group form-wrapper-beside">
                                    <div class="input-right-wrap">
                                        <label for="name" class="font-weight-bold">@lang('Link Field Name')</label>

                                    <input type="text" name="link_fields[]" id="content"
                                        value="{{ old('link_fields.0') }}" class="form-control"
                                        placeholder="@lang('Link Field')">
                                    </div>
                                    <div class="input-close-wrap">
                                        <button type="button" class="btn btn--white addLinkFiled ms-0"><i
                                            class="fa fa-plus"></i></button>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div id="linkField"></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group form-wrapper-beside">
                                    <div class="input-right-wrap">
                                        <label for="name" class="font-weight-bold">@lang('Content')</label>

                                        <input type="text" name="contents[]" id="content" value="{{ old('contents.0') }}"
                                            class="form-control" placeholder="@lang('Content')">
                                    </div>
                                    <div class="input-close-wrap">
                                        <button type="button" class="btn btn--white addPlanContent ms-0"><i
                                            class="fa fa-plus"></i></button>
                                    </div>

                                </div>

                                <div class="col-12">
                                    <div id="planContent"></div>
                                </div>
                            </div>

                            <div class="row text-end">
                                <div class="col-lg-12 ">
                                    <div class="form-group float-end p-3">
                                        <button type="submit" class="btn btn--primary btn-block btn-lg">
                                            @lang('Create')</button>
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

                    $("#planContent").append(`<div class="row">
                        <div class="col-10">
                            <div class="form-group">
                                <input type="text" name="contents[]" id="content" value="{{ old('contents.0') }}"
                                    class="form-control" placeholder="@lang('Content')">
                            </div>
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn text--danger planContentDelete"><i class="la la-times ms-0"></i></button>
                        </div>
                    </div>`)
                });

                $(document).on('click', '.planContentDelete', function() {
                    fileAdded--;
                    $(this).closest('.row').remove();
                });
            })(jQuery);

            (function($) {

                var fileAdded = 0;
                $('.addLinkFiled').on('click', function() {

                    $("#linkField").append(`<div class="row">
                    <div class="col-10">
                        <div class="form-group">
                            <input type="text" name="link_fileds[]" id="link_fields" value="{{ old('link_fileds.0') }}"
                                class="form-control" placeholder="@lang('Link Filed')">
                        </div>
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn text--danger linkFiledtDelete"><i class="la la-times ms-0"></i></button>
                    </div>
                </div>`)
                });

                $(document).on('click', '.linkFiledtDelete', function() {
                    fileAdded--;
                    $(this).closest('.row').remove();
                });
            })(jQuery);
        </script>
    @endpush
