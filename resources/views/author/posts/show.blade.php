@extends('admin.layouts.app')
@section('title', 'Köşe Yazısı')
@push('css')
    @vite([
    "resources/css/full-screen-modal.css"
])
@endpush
@section('content')
    <div class="subheader py-2 py-lg-6  subheader-solid " id="kt_subheader">
        <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <a href="{{ route('admin.posts.index') }}" class="btn btn-bg-white btn-icon-danger btn-hover-primary btn-icon mr-3 my-2 my-lg-0">
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
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Köşe Yazıları</h5>
                <!--end::Page Title-->

                <!--begin::Action-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>

                <!--end::Action-->
            </div>
            <!--end::Info-->
        </div>
    </div>
    <div class="card card-custom border-left-">
        <div class="card-body">
            <!--begin::Details-->
            <div class="d-flex mb-9">
                <!--begin: Pic-->
                <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">
                    <div class="symbol symbol-50 symbol-lg-120">
                        <img src="{{ asset($post->image_path) }}" alt="image">
                    </div>

                    <div class="symbol symbol-50 symbol-lg-120 symbol-primary d-none">
                        <span class="font-size-h3 symbol-label font-weight-boldest">JM</span>
                    </div>
                </div>
                <!--end::Pic-->

                <!--begin::Info-->
                <div class="flex-grow-1">
                    <!--begin::Title-->
                    <div class="d-flex justify-content-between flex-wrap mt-1">
                        <div class="d-flex mr-3">
                            <a href="#" class="text-dark-75 text-hover-primary font-size-h5 font-weight-bold mr-3">{{ $post->user_name  }} {{ $post->user_surname  }}</a>
{{--                            <a href="#"><i class="flaticon2-correct text-success font-size-h5"></i></a>--}}
                        </div>

                        <div class="my-lg-0 my-3">
{{--                            <a href="#" class="btn btn-sm btn-light-success font-weight-bolder text-uppercase mr-3">ask</a>--}}
                            <a href="#" class="btn btn-sm btn-{{ \App\Helpers\Custom\CustomHelper::getPostStatusLabelColor($post->post_status_code) }} font-weight-bolder text-uppercase">{{ $post->post_status_name }}</a>
                        </div>
                    </div>
                    <!--end::Title-->

                    <!--begin::Content-->
                    <div class="d-flex flex-wrap justify-content-between mt-1">
                        <div class="d-flex flex-column flex-grow-1 pr-8">
                            <div class="d-flex flex-wrap mb-4">
                                <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2"><i class="flaticon2-new-email mr-2 font-size-lg"></i>{{ $post->user_email }}</a>
{{--                                <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2"><i class="flaticon2-calendar-3 mr-2 font-size-lg"></i>PR Manager </a>--}}
                                <a href="#" class="text-dark-50 text-hover-primary font-weight-bold"><i class="flaticon-time-3 mr-2 font-size-lg"></i>{{ $post->created_at->translatedFormat('j F Y') }}</a>
                            </div>

                            <span class="font-weight-bold text-dark-50">{{ $post->post_title }}</span>
                        </div>
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Info-->
            </div>
            <!--end::Details-->

            <div class="separator separator-solid"></div>

            <!--begin::Items-->
            <div class="d-flex align-items-center flex-wrap mt-8">
                <!--begin::Item-->
                <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                <span class="mr-4">
                     <i class="flaticon-file-2 display-4 text-muted font-weight-bold"></i>
                </span>
                    <div class="d-flex flex-column text-dark-75">
                        <span class="font-weight-bolder font-size-sm">İçerik Detayı</span>
                        <a href="#" class="text-primary font-weight-bolder" data-toggle="modal" data-target="#exampleModalCenter">Görüntüle</a>
                    </div>
                </div>
                <!--begin::Item-->
                <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                <span class="mr-4">
                    <i class="flaticon-pie-chart display-4 text-muted font-weight-bold"></i>
                </span>
                    <div class="d-flex flex-column text-dark-75">
                        <span class="font-weight-bolder font-size-sm">Görüntülenme Sayısı</span>
                        <span class="font-weight-bolder font-size-h5"><span class="text-dark-50 font-weight-bold">$</span>782,300</span>
                    </div>
                </div>
                <!--end::Item-->

                <!--begin::Item-->
                <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                <span class="mr-4">
                    <i class="flaticon-file-2 display-4 text-muted font-weight-bold"></i>
                </span>
                    <div class="d-flex flex-column flex-lg-fill">
                        <span class="text-dark-75 font-weight-bolder font-size-sm">Geri Bildirimler</span>
                        <a href="#" class="text-primary font-weight-bolder" data-toggle="modal" data-target="#reviewNote">Görüntüle</a>
                    </div>
                </div>
                <!--end::Item-->

                <!--begin::Item-->
                <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                <span class="mr-4">
                    <i class="flaticon-chat-1 display-4 text-muted font-weight-bold"></i>
                </span>
                    <div class="d-flex flex-column">
                        <span class="text-dark-75 font-weight-bolder font-size-sm">Yorumlar</span>
                        <a href="#" class="text-primary font-weight-bolder">Görüntüle</a>
                    </div>
                </div>
                <!--end::Item-->
                <!--end::Item-->
            </div>
            <!--begin::Items-->
        </div>

    </div>
   @include('author.posts.modals.content-modal')
   @include('author.posts.modals.review-note-modal')
@endsection
@push('js')
    @vite([
    "resources/js/select2.js",
    "resources/js/summernote.js",
    "resources/js/admin/posts/post-status-modal.js",
])
@endpush
