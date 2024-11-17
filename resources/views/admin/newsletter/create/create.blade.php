@php
    $newsletterToggle = 'active';
@endphp
@extends('admin.layouts.app')
@section('title', 'Haber Oluştur')
@push('css')
@endpush
@section('content')
    <div class="subheader py-2 py-lg-6  subheader-solid " id="kt_subheader">
        <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <a href="{{ route('admin.newsletters.index') }}" class="btn btn-bg-white btn-icon-danger btn-hover-primary btn-icon mr-3 my-2 my-lg-0">
                   <span class="svg-icon svg-icon-primary svg-icon-2x">
                       <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24"/>
                            <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-12.000000, -12.000000) " x="11" y="5" width="2" height="14" rx="1"/>
                            <path d="M3.7071045,15.7071045 C3.3165802,16.0976288 2.68341522,16.0976288 2.29289093,15.7071045 C1.90236664,15.3165802 1.90236664,14.6834152 2.29289093,14.2928909 L8.29289093,8.29289093 C8.67146987,7.914312 9.28105631,7.90106637 9.67572234,8.26284357 L15.6757223,13.7628436 C16.0828413,14.136036 16.1103443,14.7686034 15.7371519,15.1757223 C15.3639594,15.5828413 14.7313921,15.6103443 14.3242731,15.2371519 L9.03007346,10.3841355 L3.7071045,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(9.000001, 11.999997) scale(-1, -1) rotate(90.000000) translate(-9.000001, -11.999997) "/>
                        </g>
                    </svg>
                   </span>
                </a>
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Haberler</h5>
                <!--end::Page Title-->

                <!--begin::Action-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>

                <a href="{{ route('admin.newsletters.create') }}" class="btn btn-light-primary font-weight-bolder btn-sm">
                    Haber Oluştur
                </a>
                <!--end::Action-->
            </div>
            <!--end::Info-->

            <!--begin::Toolbar-->
            <div class="d-flex align-items-center flex-wrap">
                <!--end::Actions-->
                <!--begin::Daterange-->
                <a href="#" class="btn btn-bg-white font-weight-bold mr-3 my-2 my-lg-0" id="kt_dashboard_daterangepicker" data-toggle="tooltip" title="" data-placement="left" data-original-title="Select dashboard daterange">
                    <span class="text-muted font-weight-bold mr-2" id="kt_dashboard_daterangepicker_title">Bugün:</span>
                    <span class="text-primary font-weight-bolder" id="kt_dashboard_daterangepicker_date">{{ \Carbon\Carbon::now()->translatedFormat('j F') }}</span>
                </a>
            </div>
            <!--end::Toolbar-->
        </div>
    </div>
    <div class="card-flush pt-5">
        <form id="newslettersFormStore" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-2">
                   @include('admin.newsletter.create.partials.left')
                </div>
                <div class="col-md-10">
                    @include('admin.newsletter.create.partials.right')
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-end">
                    <button type="button" id="newsletterStoreButton" class="btn btn-primary mr-2">Kaydet</button>
                </div>
            </div>
        </form>
    </div>
    @include('admin.newsletter.create.modals.newsletter-source.category-create-modal')
    @include('admin.newsletter.create.modals.newsletter-source.newsletter-source-create-modal')
@endsection
@push('js')

    <script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/js/pages/select2.js') }}"></script>

    @vite([
        "resources/js/select2.js",
        "resources/js/admin/newsletter/create.js",
        "resources/js/admin/newsletter/general-setting-tab.js",
        "resources/js/summernote.js",
        "resources/js/admin/newsletter/category-store.js",
        "resources/js/admin/newsletter/newsletter-source-store.js",
        "resources/js/admin/newsletter/create/store.js",
    ])
@endpush
