@php
    $newslettersToggle = 'menu-item-open';
    $newsletterMainHeadlineToggle = 'menu-item-active';
@endphp
@extends('admin.layouts.app')
@section('title', 'Ana Manşet')
@push('css') @endpush
@section('content')
    <div class="subheader py-2 py-lg-6  subheader-solid " id="kt_subheader">
        <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">

                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Ana Manşetler</h5>
                <!--end::Page Title-->

                <!--begin::Action-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>

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
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bolder text-dark">Ana Manşet</span>
            </h3>

        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body pt-2 pb-0 mt-n3">
            <div class="table-responsive">
                <table class="table table-vertical-center">
                    <thead>
                        <tr class="text-left text-uppercase">
                            <th>Sıra Numarası</th>
                            <th class="pl-7">Manşet</th>
                            <th>Durum</th>
                            <th>Manşet Türü</th>
                            <th>Oluşturma Tarihi</th>
                        </tr>
                    </thead>
                    <tbody class="draggable-zone">
                    @forelse($main_headlines as $main_headline)
                        @if($main_headline->headlineable_type === \App\Models\Ads::class)
                            <tr class="draggable"  data-uuid="{{ $main_headline->main_headline_uuid }}">
                                <td class="">
                                    <a href="#" class="btn btn-icon btn-sm btn-hover-light-primary draggable-handle">
                                        <i class="ki ki-menu "></i>
                                    </a>
                                    <a href="#" class=" font-weight-bolder font-size-sm">{{ $main_headline->order }}</a>
                                </td>
                                <td class="">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-50 symbol-light mr-4">
                                            <span class="symbol-label">
                                                    <img src="{{ asset($main_headline?->ad_image_path) }}" class="h-75 align-self-end" alt="" />
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span style="width: 120px;">
                                        <span class="label label-{{ $main_headline?->is_active === 1 ? 'success' : 'danger' }} label-dot mr-2"></span>
                                        <span class="font-weight-bold text-{{ $main_headline?->is_active === 1 ? 'success' : 'danger' }}">{{ $main_headline?->is_active === 1 ? 'Aktif' : 'Pasif' }}</span>
                                    </span>
                                </td>
                                <td>
                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $main_headline?->ad_type_name }}</span>
                                </td>
                                <td>
                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                      {{ optional($main_headline)->created_at
                                            ? \Carbon\Carbon::parse($main_headline->created_at)
                                            ->locale(app()->getLocale())
                                            ->isoFormat('ddd DD MMM YYYY')
                                            : '-'
                                        }}
                                    </span>
                                </td>
                            </tr>
                        @else
                            <tr class="draggable"  data-uuid="{{ $main_headline->main_headline_uuid }}">
                                <td class="">
                                    <a href="#" class="btn btn-icon btn-sm btn-hover-light-primary draggable-handle">
                                        <i class="ki ki-menu "></i>
                                    </a>
                                    <a href="#" class=" font-weight-bolder font-size-sm">{{ $main_headline->order }}</a>
                                </td>
                                <td class="">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-50 symbol-light mr-4">
                                            <span class="symbol-label">
                                                <img src="{{ asset($main_headline->ad_image_path) }}" class="h-75 align-self-end" alt="" />
                                            </span>
                                        </div>
                                        <div>
                                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $main_headline->title }}</a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span style="width: 120px;">
                                        <span class="label label-{{ \App\Helpers\Custom\CustomHelper::getNewsletterPublicationStatusLabelColor($main_headline->newsletter_status_code) }} label-dot mr-2"></span>
                                        <span class="font-weight-bold text-{{ \App\Helpers\Custom\CustomHelper::getNewsletterPublicationStatusLabelColor($main_headline->newsletter_status_code) }}">{{ \App\Helpers\Custom\CustomHelper::getNewsletterPublicationStatusLabelText($main_headline->newsletter_status_code) }}</span>
                                    </span>
                                </td>
                                <td>
                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                        Haber
                                    </span>
                                </td>
                                <td>
                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                      {{ optional($main_headline)->created_at
                                            ? \Carbon\Carbon::parse($main_headline->created_at)
                                            ->locale(app()->getLocale())
                                            ->isoFormat('ddd DD MMM YYYY')
                                            : '-'
                                        }}
                                    </span>
                                </td>
                            </tr>
                        @endif
                    @empty
                        @include('admin.not-founded')
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <!--end::Body-->
    </div>

@endsection
@push('js')
    <script src="{{ asset("assets/js/draggable.bundle.js") }}"></script>
    @vite([
        "resources/js/admin/newsletter/main-headline/draggable.js"
    ])
@endpush
