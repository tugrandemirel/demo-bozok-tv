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
                        </li>
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
                @foreach($gallery->videoGalleries as $video_gallery)
                <div class="col-xl-3 col-sm-12">
                    <div class="card card-custom gutter-b">
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Top-->
                            <div class="d-flex align-items-center">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-45 symbol-light mr-5">
                                    <span class="symbol-label">
                                        <span class="svg-icon svg-icon-{{ $video_gallery->is_active === \App\Enum\Gallery\VideoGallery\VideoGalleryIsActiveEnum::ACTIVE ? 'primary' : 'danger' }} svg-icon-2x">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <title>Stockholm-icons / Devices / Video-camera</title>
                                                <desc>Created with Sketch.</desc>
                                                <defs/>
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"/>
                                                    <rect fill="#000000" x="2" y="6" width="13" height="12" rx="2"/>
                                                    <path d="M22,8.4142119 L22,15.5857848 C22,16.1380695 21.5522847,16.5857848 21,16.5857848 C20.7347833,16.5857848 20.4804293,16.4804278 20.2928929,16.2928912 L16.7071064,12.7071013 C16.3165823,12.3165768 16.3165826,11.6834118 16.7071071,11.2928877 L20.2928936,7.70710477 C20.683418,7.31658067 21.316583,7.31658098 21.7071071,7.70710546 C21.8946433,7.89464181 22,8.14899558 22,8.4142119 Z" fill="#000000" opacity="0.3"/>
                                                </g>
                                            </svg><!--end::Svg Icon-->
                                        </span>
                                    </span>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Info-->
                                <div class="d-flex flex-column flex-grow-1">
                                    <a href="#" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder"></a>
                                </div>
                                <!--end::Info-->
                                <div class="dropdown dropdown-inline ml-2" data-toggle="tooltip" title="" data-placement="left" data-original-title="Quick actions">
                                    <a href="#" class="btn btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="ki ki-bold-more-hor"></i>
                                    </a>
                                    <div class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-right">
                                        <!--begin::Navigation-->
                                        <ul class="navi navi-hover">
                                            {{--<li class="navi-footer py-4">
                                                <a class="btn-clean w-100 font-weight-bold btn-sm single-video-status-modal" data-uuid="{{ $video_gallery->uuid }}" href="#">
                                                    Durum
                                                </a>
                                            </li>--}}
                                            <li class="navi-footer py-4">
                                                <a class="btn-clean w-100 font-weight-bold btn-sm single-video-update-modal" data-uuid="{{ $video_gallery->uuid }}" href="#">
                                                    Düzenle
                                                </a>
                                            </li>
                                           {{-- <li class="navi-footer py-4">
                                                <a class="btn-clean w-100 font-weight-bold btn-sm single-video-delete" data-uuid="{{ $video_gallery->uuid }}" href="#">
                                                    Sil
                                                </a>
                                            </li>--}}
                                        </ul>
                                        <!--end::Navigation-->
                                    </div>
                                </div>
                            </div>
                            <!--end::Top-->

                            <!--begin::Bottom-->
                            <div class="pt-3">
                                <!--begin::Text-->
                                <p class="text-dark-75 font-size-lg font-weight-normal pt-5 mb-7">
                                    {{ $video_gallery->caption ?? 'AÇIKLAMA BULUNAMADI' }}
                                </p>
                                <!--end::Text-->

                                <!--begin::Video-->
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item rounded" src="https://www.youtube.com/embed/{{ $video_gallery->embed }}" allowfullscreen=""></iframe>
                                </div>
                                <!--end::Video-->

                                <!--begin::Action-->
                               {{-- <a href="#" class="btn btn-hover-text-primary btn-hover-icon-primary btn-sm btn-text-dark-50 bg-hover-light-primary rounded font-weight-bolder font-size-sm p-2 mt-7">
                                    <span class="svg-icon svg-icon-md svg-icon-dark-25 pr-2"><!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Group-chat.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <title>Stockholm-icons / Communication / Group-chat</title>
                                            <desc>Created with Sketch.</desc>
                                            <defs></defs>
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776218,3 C21.8728674,3 23.0039375,4.13107011 23.0039375,5.52631579 L23.0039375,13.1052632 L23.0206157,17.786793 C23.0215995,18.0629336 22.7985408,18.2875874 22.5224001,18.2885711 C22.3891754,18.2890457 22.2612702,18.2363324 22.1670655,18.1421277 L19.6565168,15.6315789 L16,15.6315789 Z" fill="#000000"></path>
                                                <path d="M1.98505595,18 L1.98505595,13 C1.98505595,11.8954305 2.88048645,11 3.98505595,11 L11.9850559,11 C13.0896254,11 13.9850559,11.8954305 13.9850559,13 L13.9850559,18 C13.9850559,19.1045695 13.0896254,20 11.9850559,20 L4.10078614,20 L2.85693427,21.1905292 C2.65744295,21.3814685 2.34093638,21.3745358 2.14999706,21.1750444 C2.06092565,21.0819836 2.01120804,20.958136 2.01120804,20.8293182 L2.01120804,18.32426 C1.99400175,18.2187196 1.98505595,18.1104045 1.98505595,18 Z M6.5,14 C6.22385763,14 6,14.2238576 6,14.5 C6,14.7761424 6.22385763,15 6.5,15 L11.5,15 C11.7761424,15 12,14.7761424 12,14.5 C12,14.2238576 11.7761424,14 11.5,14 L6.5,14 Z M9.5,16 C9.22385763,16 9,16.2238576 9,16.5 C9,16.7761424 9.22385763,17 9.5,17 L11.5,17 C11.7761424,17 12,16.7761424 12,16.5 C12,16.2238576 11.7761424,16 11.5,16 L9.5,16 Z" fill="#000000" opacity="0.3"></path>
                                            </g>
                                        </svg><!--end::Svg Icon-->
                                    </span>
                                    268 Comments
                                </a>--}}
                                <!--end::Action-->
                            </div>
                            <!--end::Bottom-->
                        </div>
                        <!--end::Body-->
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @include('admin.gallery.video.modals.status-modal')
    @include('admin.gallery.video.modals.video-status-modal')
    @include('admin.gallery.video.modals.update-video-gallery-modal')
    @include('admin.gallery.video.modals.create-video-gallery-modal')
@endsection
@push('js')
    @vite([
        "resources/js/select2.js",
        "resources/js/admin/gallery/video-gallery/video-preview.js",
        "resources/js/admin/gallery/video-gallery/store.js",
        "resources/js/admin/gallery/video-gallery/single-video-status-update-modal.js",
        "resources/js/admin/gallery/video-gallery/update.js",
    ])
@endpush
