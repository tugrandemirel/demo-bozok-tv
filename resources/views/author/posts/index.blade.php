@php
    $postsToggle = 'active';
@endphp
@extends('admin.layouts.app')
@section('title', 'Köşe Yazıları')
@push('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <div class="subheader py-2 py-lg-6  subheader-solid " id="kt_subheader">
        <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">

                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Köşe Yazıları</h5>
                <!--end::Page Title-->

                <!--begin::Action-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>


                <a href="{{ route('author.posts.create') }}" class="btn btn-light-primary font-weight-bolder btn-sm">
                    Köşe Yazısı Oluştur
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
    <div class="card card-custom">
        <div class="card-header flex-wrap py-5">
            <div class="card-title">
                <h3 class="card-label">Köşe Yazıları</h3>
            </div>
        </div>

        <div class="card-body">

            <!--begin: Datatable-->
            <div class="table-responsive">
                <table id="post_datatable" class="table align-middle table-row-dashed fs-6 gy-5">
                    <thead>
                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                        <th>Başlık</th>
                        <th>Durum</th>
                        <th>Sıra Numarası</th>
                        <th>Yayınlanma Tarihi</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-semibold">
                    </tbody>
                </table>
            </div>
            <!--end: Datatable-->
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    @vite([
        "resources/js/author/posts/fetch-posts-datatable.js",
    ])
@endpush