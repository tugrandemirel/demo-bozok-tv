<form id="contactSettingForm">
    <!--end::Heading-->
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 text-right col-form-label">İletişim Numarası</label>
        <div class="col-lg-9 col-xl-6">
            <div class="input-group input-group-lg input-group-solid">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="la la-phone"></i>
                    </span>
                </div>
                <input type="text" class="form-control form-control-lg form-control-solid phone-mask" value="{{ $contact_setting?->phone ?? '' }}" name="phone" placeholder="İletişim Numarası" />
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 text-right col-form-label">E-Posta Adresi</label>
        <div class="col-lg-9 col-xl-6">
            <div class="input-group input-group-lg input-group-solid">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="la la-at"></i>
                    </span>
                </div>
                <input type="text" class="form-control form-control-lg form-control-solid" value="{{ $contact_setting?->email ?? '' }}" name="email" placeholder="E-Posta" />
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 text-right col-form-label">Adres</label>
        <div class="col-lg-9 col-xl-6">
            <textarea class="form-control form-control-lg form-control-solid" name="address">{{ $contact_setting?->address ?? '' }}</textarea>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-12 text-right">
            <button type="button" class="btn btn-success mr-2" id="contactSettingButton">Güncelle</button>
        </div>
    </div>
</form>
