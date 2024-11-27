@php
    $personal_information_toggle = 'active';
@endphp
@extends('admin.profile.index')
@section('title', 'Kişi Bilgileri')
@push('profile-css') @endpush
@section('profile')
    <div class="card card-custom card-stretch">
        <!--begin::Header-->
        <div class="card-header py-3">
            <div class="card-title align-items-start flex-column">
                <h3 class="card-label font-weight-bolder text-dark">Kişisel Bilgiler</h3>
                <span class="text-muted font-weight-bold font-size-sm mt-1">Kişisel bilgilerinizi güncelleyebilirsiniz.</span>
            </div>
            <div class="card-toolbar">
                <button type="button" id="updatePersonalInformation" class="btn btn-success mr-2">Kaydet</button>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Form-->
        <form id="updatePersonalInformationForm">
            <!--begin::Body-->
            <div class="card-body">
                <div class="row">
                    <label class="col-xl-3"></label>
                    <div class="col-lg-9 col-xl-6">
                        <h5 class="font-weight-bold mb-6">Bilgiler</h5>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Profil Resmi</label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="image-input image-input-outline" id="kt_profile_avatar" style="background-image: url('{{ $user->profile_image }}')">
                            <div class="image-input-wrapper" style="background-image: url('{{ $user->profile_image }}')"></div>
                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Değiştir">
                                <i class="fa fa-pen icon-sm text-muted"></i>
                                <input type="file" name="profile" accept=".png, .jpg, .jpeg" />
                                <input type="hidden" name="profile_avatar_remove" />
                            </label>
                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="İptal et">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                        </div>
                        <span class="form-text text-muted">Kabul edilen tipler: png, jpg, jpeg.</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Adınız</label>
                    <div class="col-lg-9 col-xl-6">
                        <input class="form-control form-control-lg form-control-solid" type="text" name="name" value="{{ $user->name ?? '' }}" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Soyadınız</label>
                    <div class="col-lg-9 col-xl-6">
                        <input class="form-control form-control-lg form-control-solid" type="text" name="surname" value="{{ $user->surname ?? '' }}" />
                    </div>
                </div>
                <div class="row">
                    <label class="col-xl-3"></label>
                    <div class="col-lg-9 col-xl-6">
                        <h5 class="font-weight-bold mt-10 mb-6">İletişim Bilgileri</h5>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">İletişim Numarası</label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="input-group input-group-lg input-group-solid">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="la la-phone"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control form-control-lg form-control-solid phone-mask" name="phone" value="{{ $user->phone ?? '' }}" placeholder="Telefon Numarası" />
                        </div>
                        <span class="form-text text-muted">İletişim numaranızı kimse ile paylaşmayacağız.</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">E-Posta Adresiniz</label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="input-group input-group-lg input-group-solid">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="la la-at"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control form-control-lg form-control-solid" value="{{ $user->email ?? '-' }}" name="email" placeholder="E-Posta" />
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Body-->
        </form>
        <!--end::Form-->
    </div>
@endsection
@push('profile-js')
    @vite([
        "resources/js/admin/profile/update-personal-information.js",
        "resources/js/admin/profile/profile-image.js",
        "resources/js/admin/input-mask.js"
    ])
@endpush
