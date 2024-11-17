@php
    $postsToggle = 'active';
@endphp
@extends('admin.layouts.app')
@section('title', 'Köşe Yazısı Oluştur')
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
    <div class="card">

        <!--begin::Card body-->
        <div class="card-body p-12">

            <form action="" id="postStoreForm">
                <div class="form-group">
                    <label class="col-form-label col-sm-12">Kapak Görseli</label>
                    <div class="col-sm-12">
                        <div class="image-input image-input-outline w-100 text-center"  id="file">
                            <div class="image-input-wrapper  w-100" style="background-image: url({{ asset('assets/media/users/100_1.jpg') }})"></div>

                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="İç Kapak Görselini değiştir">
                                <i class="fa fa-pen icon-sm text-muted"></i>
                                <input type="file" name="file" accept=".png, .jpg, .jpeg"/>
                                <input type="hidden" name="profile_avatar_remove"/>
                            </label>

                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="İptal Et">
                          <i class="ki ki-bold-close icon-xs text-muted"></i>
                     </span>
                        </div>
                        <span class="form-text">Yalnızca: png, jpg, jpeg.</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" id="title">Başlık:</label>
                    <input type="text" name="title" id="title" class="form-control">
                    <p class="form-text text-muted">En fazla 150 karakter giriniz.(<span class="character_count"> Kalan karakter sayısı: 150</span>)</p>
                </div>
                <div class="form-group">
                    <label class="form-label">İçerik:</label>
                    <textarea name="content" class="summernote" id="" cols="30" rows="10"></textarea>
                </div>
            </form>

            <div class="row">
                <div class="col-md-12 text-end">
                    <button type="button" id="postStoreButton" class="btn btn-primary mr-2">Kaydet</button>
                </div>
            </div>
        </div>

        <!--end::Card body-->
    </div>

@endsection
@push('js')
{{--    <script src="{{ asset('assets/js/ckeditor/ckeditor-classic.bundle.js') }}"></script>--}}
    <script src="{{ asset('assets/js/ckeditor/ckeditor-document.bundle.js') }}"></script>
{{--    <script src="{{ asset("assets/js/ckeditor/ckeditor-document.js") }}"></script>--}}
@vite([
    "resources/css/custom-summernote.css",
    "resources/js/author/posts/store.js",
    "resources/js/summernote.js",
    "resources/js/author/posts/image-upload.js"
])
@endpush
