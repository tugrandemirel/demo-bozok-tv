@php
    $newslettersToggle = 'menu-item-open';
    $newsletterOutStandingsToggle = 'menu-item-active';
@endphp
@extends('admin.layouts.app')
@section('title', 'Öne Çıkanlar')
@push('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <div class="subheader py-2 py-lg-6  subheader-solid " id="kt_subheader">
        <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">

                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Öne Çıkanlar</h5>
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
    <div class="card card-custom gutter-b">
        <div class="card-header flex-wrap py-5">
            <div class="card-title">
                <h3 class="card-label">Haberler</h3>
            </div>
        </div>

        <div class="card-body">

            <!--begin: Datatable-->
            <div class="table-responsive">
                <table id="newsletters_outstandings_datatable" class="table align-middle table-row-dashed fs-6 gy-5">
                    <thead>
                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                            <th></th>
                            <th>Başlık</th>
                            <th>Kategori</th>
                            <th>Durum</th>
                            <th>Yayınlanma Tarihi</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-semibold" id="draggable">
{{--                        @forelse($newsletter_outstandings as $newsletter)--}}
{{--                            <tr>--}}
{{--                                <td class="">--}}
{{--                                    <a href="#" class="btn btn-icon btn-sm btn-hover-light-primary draggable-handle">--}}
{{--                                        <i class="ki ki-menu "></i>--}}
{{--                                    </a>--}}
{{--                                    <a href="#" class=" font-weight-bolder font-size-sm">{{ $newsletter->order }}</a>--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    @if($newsletter?->image)--}}
{{--                                        <div class="d-flex align-items-center">--}}
{{--                                            <div class="symbol symbol-50 flex-shrink-0">--}}
{{--                                                <img src="{{ asset($newsletter?->image) }}" alt="photo">--}}
{{--                                            </div>--}}
{{--                                            <div class="ml-3">--}}
{{--                                                <span class="text-dark-75 font-weight-bold  text-hover-primary line-height-sm d-block pb-2">{{ $newsletter->title }}</span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    @else--}}
{{--                                        <div class="d-flex align-items-center">--}}
{{--                                            <div class="symbol symbol-50 flex-shrink-0">--}}
{{--                                                <a class="nav nav-pills nav-danger nav-link active" data-toggle="pill" href="#tab_forms_widget_4">--}}
{{--                                            <span class="nav-icon py-2 w-auto text-danger" >--}}
{{--                                                <span class="svg-icon svg-icon-3x">--}}
{{--                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">--}}
{{--                                                        <defs></defs>--}}
{{--                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
{{--                                                            <rect x="0" y="0" width="24" height="24"></rect>--}}
{{--                                                            <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"></rect>--}}
{{--                                                            <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>--}}
{{--                                                            <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>--}}
{{--                                                            <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>--}}
{{--                                                        </g>--}}
{{--                                                    </svg>--}}
{{--                                                </span>--}}
{{--                                            </span>--}}
{{--                                                    <span class="nav-text font-size-lg py-2 font-weight-bolder text-center">--}}
{{--                                            </span>--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
{{--                                            <div class="ml-3">--}}
{{--                                                <span class="text-dark-75 font-weight-bold  text-hover-primary line-height-sm d-block pb-2">{{ $newsletter->title }}</span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    @endif--}}
{{--                                </td>--}}
{{--                                <td>{{ $newsletter->category }}</td>--}}
{{--                                <td>--}}
{{--                                    @if($newsletter->status_code == "on-the-air")--}}
{{--                                        <span style="width: 120px;">--}}
{{--                                            <span class="label label-success label-dot mr-2"></span>--}}
{{--                                            <span class="font-weight-bold text-success">{{ $newsletter->status_name }}</span>--}}
{{--                                        </span>--}}
{{--                                    @elseif($newsletter->status_code == "draft")--}}
{{--                                        <span style="width: 120px;">--}}
{{--                                            <span class="label label-success label-dot mr-2"></span>--}}
{{--                                            <span class="font-weight-bold text-success">{{ $newsletter->status_name }}</span>--}}
{{--                                        </span>--}}
{{--                                    @elseif($newsletter->status_code == "archive")--}}
{{--                                        <span style="width: 120px;">--}}
{{--                                            <span class="label label-success label-dot mr-2"></span>--}}
{{--                                            <span class="font-weight-bold text-success">{{ $newsletter->status_name }}</span>--}}
{{--                                        </span>--}}
{{--                                    @elseif($newsletter->status_code == "removed")--}}
{{--                                        <span style="width: 120px;">--}}
{{--                                            <span class="label label-success label-dot mr-2"></span>--}}
{{--                                            <span class="font-weight-bold text-success">{{ $newsletter->status_name }}</span>--}}
{{--                                        </span>--}}
{{--                                    @endif--}}
{{--                                </td>--}}
{{--                                <td>{{ $newsletter->created_at->translatedFormat('d F Y') }}</td>--}}
{{--                                <td>--}}
{{--                                    <a href="/admin/dashboard/newsletters/show/${row.uuid}" class="btn btn-icon btn-light btn-sm">--}}
{{--                                        <span class="svg-icon svg-icon-md svg-icon-warning">--}}
{{--                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">--}}
{{--                                            <defs></defs>--}}
{{--                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
{{--                                                    <polygon points="0 0 24 0 24 24 0 24"></polygon>--}}
{{--                                                    <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000) " x="11" y="5" width="2" height="14" rx="1"></rect>--}}
{{--                                                    <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997) "></path>--}}
{{--                                                </g>--}}
{{--                                            </svg><!--end::Svg Icon-->--}}
{{--                                        </span>--}}
{{--                                    </a>--}}

{{--                                    <a href="/admin/dashboard/newsletters/edit/${row.uuid}" class="btn btn-icon btn-light btn-sm" data-toggle="tooltip" title="Düzenle" data-placement="left" data-original-title="Düzenle">--}}
{{--                                        <span class="svg-icon svg-icon-md svg-icon-primary">--}}
{{--                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">--}}
{{--                                                <defs></defs>--}}
{{--                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
{{--                                                    <rect x="0" y="0" width="24" height="24"/>--}}
{{--                                                    <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>--}}
{{--                                                    <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>--}}
{{--                                                </g>--}}
{{--                                            </svg><!--end::Svg Icon-->--}}
{{--                                        </span>--}}

{{--                                    </a>--}}

{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @empty--}}
{{--                            @include('admin.not-founded')--}}
{{--                        @endforelse--}}
                    </tbody>
                </table>
            </div>

            <!--end: Datatable-->
        </div>
    </div>
{{--    {{ $newsletter_outstandings->links('vendor.pagination.custom') }}--}}
@endsection
@push('js')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    @vite([
    "resources/js/admin/newsletter/fetch-newsletter-outstandings-datatable.js",
    ])
@endpush
