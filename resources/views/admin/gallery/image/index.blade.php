@extends('admin.layouts.app')
@section('title', 'Resim Galeri')
@push('css') @endpush
@section('content')
    <div class="subheader py-2 py-lg-6  subheader-solid " id="kt_subheader">
        <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <a href="{{ route('admin.gallery.index') }}" class="btn btn-bg-white btn-icon-danger btn-hover-primary btn-icon mr-3 my-2 my-lg-0">
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
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Resim Galerisi</h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>

                <a href="#" data-toggle="modal" data-target="#imageGalleryCreateModal" class="btn btn-light-primary font-weight-bolder btn-sm">
                    Resim Oluştur
                </a>
            </div>
            <div class="dropdown dropdown-inline my-2 my-lg-0" data-toggle="tooltip" title="" data-placement="left" data-original-title="Hızlı Erişim Menüsü">
                <a href="#" class="btn btn-primary btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <span class="svg-icon svg-icon-md">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <path d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z" fill="#000000"></path>
                            </g>
                        </svg>
                    </span>
                </a>
                <div class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-212px, 38px, 0px);">
                    <!--begin::Navigation-->
                    <ul class="navi navi-hover">
                        {{-- <li class="navi-header font-weight-bold py-4">
                             <span class="font-size-lg">Choose Label:</span>
                             <i class="flaticon2-information icon-md text-muted" data-toggle="tooltip" data-placement="right" title="" data-original-title="Click to learn more..."></i>
                         </li>--}}
                        <li class="navi-separator mb-3 opacity-70"></li>
                        {{--<li class="navi-item mb-3">
                            <a href="#" class="navi-link" data-toggle="modal" data-target="#videoGalleryStatusModal">
                                <span class="svg-icon svg-icon-md svg-icon-primary mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <defs></defs>
                                       <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <rect fill="#000000" opacity="0.3" x="2" y="6" width="21" height="12" rx="6"/>
                                            <circle fill="#000000" cx="17" cy="12" r="4"/>
                                        </g>
                                    </svg>
                                </span>
                                <span>Video Galeri Durumu Düzenle</span>
                            </a>
                        </li>--}}
                        <li class="navi-separator mb-3 opacity-70"></li>
                    </ul>
                    <!--end::Navigation-->
                </div>
            </div>
            <!--end::Toolbar-->
        </div>

    </div>
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row">
                @foreach($gallery->images as $image_gallery)
                <div class="col-xl-3 col-sm-12">
                    <div class="card card-custom gutter-b">
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Top-->
                            <div class="d-flex align-items-center">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-40 symbol-light-{{ $image_gallery->is_active === \App\Enum\Gallery\GalleryImage\GalleryImageEnum::ACTIVE ? 'success' : 'danger' }} mr-5">
                                    <span class="symbol-label">
                                        <img src="{{ asset('assets/media/svg/avatars/047-girl-25.svg') }}" class="h-75 align-self-end" alt="">
                                    </span>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Info-->
                                <div class="d-flex flex-column flex-grow-1">
                                    <span class="text-muted font-weight-bold">{{ \Carbon\Carbon::parse($image_gallery->created_at)->translatedFormat('d M Y H:i') }}</span>
                                </div>
                                <!--end::Info-->
                                <!--begin::Dropdown-->
                                <div class="dropdown dropdown-inline ml-2" data-toggle="tooltip" title="" data-placement="left" data-original-title="İşlemler">
                                    <a href="#" class="btn btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="ki ki-bold-more-hor"></i>
                                    </a>
                                    <div class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-right">
                                        <!--begin::Navigation-->
                                        <ul class="navi navi-hover">
                                            <li class="navi-footer py-4">
                                                <a class="btn-clean w-100 font-weight-bold btn-sm single-image-update-modal" data-uuid="{{ $image_gallery->uuid }}" href="#">
                                                    Düzenle
                                                </a>
                                            </li>
                                            {{--<li class="navi-footer py-4">
                                                <a class="btn-clean w-100 font-weight-bold btn-sm single-image-delete-modal" data-uuid="{{ $image_gallery->uuid }}" href="#">
                                                    Sil
                                                </a>
                                            </li>--}}
                                        </ul>
                                        <!--end::Navigation-->
                                    </div>
                                </div>
                                <!--end::Dropdown-->
                            </div>
                            <!--end::Top-->
                            <!--begin::Bottom-->
                            <div class="pt-4">
                                <!--begin::Image-->
                                <div class="bgi-no-repeat bgi-size-cover rounded min-h-265px" style="background-image: url({{ asset($image_gallery->path) }})"></div>
                                <!--end::Image-->
                                <!--begin::Text-->
                                <p class="text-dark-75 font-size-lg font-weight-normal pt-5 mb-2">{{ $image_gallery->alt_text }}</p>
                                <!--end::Text-->
                            </div>
                            <!--end::Bottom-->
                            <!--begin::Separator-->
                            <div class="separator separator-solid mt-2 mb-4"></div>
                            <!--end::Separator-->
                        </div>
                        <!--end::Body-->
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @include('admin.gallery.image.modals.status-modal')
    @include('admin.gallery.image.modals.image-status-modal')
    @include('admin.gallery.image.modals.update-image-gallery-modal')
    @include('admin.gallery.image.modals.create-image-gallery-modal')
@endsection
@push('js')
    @vite([
        "resources/js/admin/image/store.js",
        "resources/js/admin/image/index.js",
        "resources/js/admin/image/edit.js",
        "resources/js/admin/image/update.js",
    ])
@endpush
