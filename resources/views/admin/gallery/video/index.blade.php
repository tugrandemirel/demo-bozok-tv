@extends('admin.layouts.app')
@section('title', 'Video Galeri')
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
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Video Galerisi</h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>

                <a href="#" data-toggle="modal" data-target="#videoGalleryCreateModal" class="btn btn-light-primary font-weight-bolder btn-sm">
                    Video Oluştur
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
                        <li class="navi-item mb-3">
                            <a href="#" class="navi-link" data-toggle="modal" data-target="#publicationStatusEditModal">
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
                                <span>Haber Durumunu Düzenle</span>
                            </a>
                        </li>
                        <li class="navi-separator mb-3 opacity-70"></li>
                        {{--                        <li class="navi-item mb-3">--}}
                        {{--                            <a href="#" class="navi-link text-hover-danger" data-toggle="modal" data-target="#exampleModalLong">--}}
                        {{--                                <span class="svg-icon svg-icon-md svg-icon-danger mr-2">--}}
                        {{--                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">--}}
                        {{--                                    <defs></defs>--}}
                        {{--                                       <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
                        {{--                                           <rect x="0" y="0" width="24" height="24"/>--}}
                        {{--                                           <path d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z" fill="#000000" fill-rule="nonzero"/>--}}
                        {{--                                           <path d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/></g>--}}
                        {{--                                    </svg>--}}
                        {{--                                </span>--}}
                        {{--                                <span>Sil</span>--}}
                        {{--                            </a>--}}
                        {{--                        </li>--}}
                    </ul>
                    <!--end::Navigation-->
                </div>
            </div>
            <!--end::Toolbar-->
        </div>

    </div>
    @include('admin.gallery.video.modals.create-video-gallery-modal')
    @include('admin.gallery.video.modals.update-video-gallery-modal')
    @include('admin.gallery.video.modals.status-modal')
@endsection
@push('js')
    @vite([
        "resources/js/admin/gallery/video-gallery/video-preview.js",
        "resources/js/admin/gallery/video-gallery/store.js",
    ])
@endpush
