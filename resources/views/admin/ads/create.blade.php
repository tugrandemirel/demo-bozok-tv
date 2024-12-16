@extends('admin.layouts.app')
@section('title', 'Reklam Oluştur')
@push('css') @endpush
@section('content')
    <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
            <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Details-->
                <div class="d-flex align-items-center flex-wrap mr-2">
                    <!--begin::Title-->
                    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Reklam Oluştur</h5>
                    <!--end::Title-->
                    <!--begin::Separator-->
                    <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
                    <!--end::Separator-->
                </div>
                <!--end::Details-->
            </div>
        </div>
        <!--end::Subheader-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class=" container-fluid ">
                <!--begin::Card-->
                <div class="card card-custom card-sticky" id="">
                    <div class="card-body">
                        <!--begin::Form-->
                        <form class="" id="adsFormStore">
                            <div class="row">
                                <div class="col-xl-1"></div>
                                <div class="col-xl-8">
                                    <div class="my-5">
                                        <h3 class=" text-dark font-weight-bold mb-10">Reklam Bilgileri:</h3>
                                        <div class="form-group row">
                                            <label for="ad_type" class="col-3">Reklam Türü</label>
                                            <div class="col-9">
                                                <select class="form-control form-control-solid select2" name="ad_type" id="ad_type">
                                                    <option value="" selected disabled></option>
                                                    @foreach($ad_types as $ad_type)
                                                        <option value="{{ $ad_type->code }}">{{ $ad_type->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="placement" class="col-3">Reklam Yeri</label>
                                            <div class="col-9">
                                                <select class="form-control form-control-solid select2" name="placement" id="placement">
                                                    <option value="" selected disabled></option>
                                                    @foreach($placements as $placement)
                                                        <option value="{{ $placement->code }}">{{ $placement->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row" id="image_row">
                                            <label class="col-3">Reklam Görseli</label>
                                            <div class="col-9">
                                                <div class="image-input image-input-empty image-input-outline" id="file" style="background-image: url()">
                                                    <div class="image-input-wrapper"></div>

                                                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                                        <input type="file" name="file" accept=".png, .jpg, .jpeg"/>
                                                        <input type="hidden" name="profile_avatar_remove"/>
                                                    </label>

                                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                    </span>
                                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row" id="url_row">
                                            <label for="url" class="col-3">Url</label>
                                            <div class="col-9">
                                                <input class="form-control" type="text" name="url" id="url" value=""/>
                                            </div>
                                        </div>
                                        <div class="form-group row" id="ad_code_row">
                                            <label class="col-3">Ads Code</label>
                                            <div class="col-9">
                                                <textarea name="ad_code" class="form-control" id="" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="start_date" class="col-3">Başlangıç Tarihi</label>
                                            <div class="col-9">
                                                <input class="form-control daterange" type="text" name="start_date" id="start_date" value=""/>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="end_date" class="col-3">Bitiş Tarihi</label>
                                            <div class="col-9">
                                                <input class="form-control daterange" id="end_date" type="text" name="end_date" value=""/>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="is_active" class="col-3">Aktiflik</label>
                                            <div class="col-9">
                                                <span class="switch switch-icon">
                                                    <label>
                                                         <input type="checkbox"  id="is_active" name="is_active"/>
                                                         <span></span>
                                                    </label>
                                               </span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-12 text-right">
                                                <button type="button" class="btn btn-success mr-2" id="adsFormStoreButton">Kaydet</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>

@endsection
@push('js')
    @vite([
        "resources/js/select2.js",
        "resources/js/daterange.js",

        "resources/js/admin/ads/create.js",
        "resources/js/admin/ads/store.js",
    ])
@endpush
