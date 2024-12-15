@php
    $adsToggle = 'active';
@endphp
@extends('admin.layouts.app')
@section('title', 'Reklamlar')
@push('css') @endpush
@section('content')
    <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
            <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Details-->
                <div class="d-flex align-items-center flex-wrap mr-2">

                    <!--begin::Title-->
                    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Reklamlar</h5>
                    <!--end::Title-->

                    <!--begin::Separator-->
                    <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
                    <!--end::Separator-->

                    <!--begin::Search Form-->
                    {{--<div class="d-flex align-items-center" id="kt_subheader_search">
                        <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">
                            450 Total
                        </span>
                        <form class="ml-5">
                            <div class="input-group input-group-sm input-group-solid" style="max-width: 175px">
                                <input type="text" class="form-control" id="kt_subheader_search_form" placeholder="Search...">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <span class="svg-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <defs></defs>
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"></rect>
                                                    <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                    <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero"></path>
                                                </g>
                                            </svg>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>--}}
                    <!--end::Search Form-->
                </div>
                <!--end::Details-->

                <!--begin::Toolbar-->
                <div class="d-flex align-items-center">
                    <!--begin::Button-->
                    <a href="/metronic/demo1/.html" class="">
                    </a>
                    <!--end::Button-->

                    <!--begin::Button-->
                    <a href="{{ route('admin.ads.create') }}" class="btn btn-light-primary font-weight-bold ml-2">
                        Reklam Ekle
                    </a>
                    <!--end::Button-->
                </div>
                <!--end::Toolbar-->
            </div>
        </div>
        <!--end::Subheader-->

        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class=" container-fluid ">
                <!--begin::Card-->
                @forelse($ads as $ad)
                <div class="card card-custom gutter-b">
                    <div class="ribbon ribbon-top">
                        <div class="ribbon-target bg-{{ $ad->ad_type_code === 'special_ads' ? 'danger' : 'info' }}" style="top: -2px; right: 20px;">
                            {{ $ad->ad_type_name }}
                        </div>
                    </div>
                    <div class="card-body">
                        <!--begin::Top-->
                        <div class="d-flex">
                            @if(!is_null($ad->path))
                            <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">
                                <div class="symbol symbol-50 symbol-lg-120">
                                    <img alt="Pic" src="{{ asset($ad->path) }}">
                                </div>

                                <div class="symbol symbol-50 symbol-lg-120 symbol-primary d-none">
                                    <span class="font-size-h3 symbol-label font-weight-boldest">JM</span>
                                </div>
                            </div>
                            @endif
                            <!--begin: Info-->
                            <div class="flex-grow-1">
                                <!--begin::Title-->
                                <div class="d-flex align-items-center justify-content-between flex-wrap mt-2">
                                    <!--begin::User-->
                                    <div class="mr-3">
                                        <!--begin::Name-->
                                        <a href="#" class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3">
                                            {{ $ad->placement_name }}
                                            @if($ad->is_active->value == 1)
                                                <i class="flaticon2-correct text-success icon-md ml-2"></i>
                                            @else
                                                <i class="flaticon-circle text-danger icon-md ml-2"></i>
                                            @endif
                                        </a>
                                        <!--end::Name-->
                                    </div>
                                    <!--begin::User-->
                                </div>
                                <!--end::Title-->
                                <!--begin::Content-->
                                <div class="d-flex align-items-center flex-wrap justify-content-between">
                                    <div class="flex-grow-1 font-weight-bold text-dark-50 py-5 py-lg-2 mr-5">
                                        {{ $ad->url ?? $ad->ad_code }}
                                    </div>

                                    <div class="d-flex flex-wrap align-items-center py-2">
                                        <div class="d-flex align-items-center mr-10">
                                            <div class="mr-6">
                                                <div class="font-weight-bold mb-2">Başlangıç Tarihi</div>
                                                <span class="btn btn-sm btn-text btn-light-primary text-uppercase font-weight-bold w-100">{{ isset($ad->start_date) ? \Carbon\Carbon::parse($ad->start_date)->translatedFormat('d F Y H:i') : '-' }}</span>
                                            </div>
                                            <div class="">
                                                <div class="font-weight-bold mb-2">Bitiş Tarihi</div>
                                                <span class="btn btn-sm btn-text btn-light-danger text-uppercase font-weight-bold w-100">{{ isset($ad->end_date) ? \Carbon\Carbon::parse($ad->end_date)->translatedFormat('d F Y H:i') : '-' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Top-->
                    </div>
                </div>
                @empty
                    @include('admin.not-founded')
                @endforelse
                <!--end::Card-->
                <!--begin::Pagination-->
{{--                <div class="card card-custom">
                    <div class="card-body py-7">
                        <!--begin::Pagination-->
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div class="d-flex flex-wrap mr-3">
                                <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1"><i class="ki ki-bold-double-arrow-back icon-xs"></i></a>
                                <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1"><i class="ki ki-bold-arrow-back icon-xs"></i></a>
                                <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">...</a>
                                <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">23</a>
                                <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary active mr-2 my-1">24</a>
                                <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">25</a>
                                <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">26</a>
                                <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">27</a>
                                <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">28</a>
                                <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">...</a>
                                <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1"><i class="ki ki-bold-arrow-next icon-xs"></i></a>
                                <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1"><i class="ki ki-bold-double-arrow-next icon-xs"></i></a>
                            </div>
                            <div class="d-flex align-items-center">
                                <select class="form-control form-control-sm text-primary font-weight-bold mr-4 border-0 bg-light-primary" style="width: 75px;">
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="30">30</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                                <span class="text-muted">Displaying 10 of 230 records</span>
                            </div>
                        </div>
                        <!--end:: Pagination-->
                    </div>
                </div>--}}
                <!--end::Pagination-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
@endsection
@push('js') @endpush
