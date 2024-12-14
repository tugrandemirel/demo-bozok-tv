<form id="generalSettingForm">
    <div class="form-group row">
         <label class="col-xl-3 col-lg-3 text-right col-form-label">Logo</label>
         <div class="col-lg-9 col-xl-9">
             <div class="image-input image-input-outline" id="logo" style="background-image: url(assets/media/users/blank.png)">
                 <div class="image-input-wrapper" style="background-image: url({{ asset($general_setting?->logo['path'] ?? '') }})"></div>
                 <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                     <i class="fa fa-pen icon-sm text-muted"></i>
                     <input type="file" name="logo" accept=".png, .jpg, .jpeg" />
                     <input type="hidden" name="logo" />
                 </label>
                 <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                </span>
                 <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                </span>
             </div>
         </div>
    </div>
    <div class="form-group row">
         <label class="col-xl-3 col-lg-3 text-right col-form-label">Favicon</label>
         <div class="col-lg-9 col-xl-9">
             <div class="image-input image-input-outline" id="favicon" style="background-image: url(assets/media/users/blank.png)">
                 <div class="image-input-wrapper" style="background-image: url({{ asset($general_setting?->favicon['path'] ?? '') }})"></div>
                 <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                     <i class="fa fa-pen icon-sm text-muted"></i>
                     <input type="file" name="favicon" accept=".png, .jpg, .jpeg, .ico, .gif" />
                     <input type="hidden" name="favicon" />
                 </label>
                 <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                </span>
                 <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                </span>
             </div>
         </div>
    </div>
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 text-right col-form-label">Site Adı</label>
        <div class="col-lg-9 col-xl-6">
            <input class="form-control form-control-lg form-control-solid" type="text" name="site_name" value="{{ $general_setting?->site_name ?? ''}}" />
        </div>
    </div>
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 text-right col-form-label">Slogan</label>
        <div class="col-lg-9 col-xl-6">
            <input class="form-control form-control-lg form-control-solid" type="text" name="slogan" value="{{ $general_setting?->slogan ?? ''}}" />
        </div>
    </div>
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 text-right col-form-label">URL</label>
        <div class="col-lg-9 col-xl-6">
            <div class="input-group input-group-lg input-group-solid">
                <input type="text" class="form-control form-control-lg form-control-solid" name="url" placeholder="url" value="{{ $general_setting?->url ?? ''}}" />
                <div class="input-group-append">
                    <span class="input-group-text">.com</span>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 text-right col-form-label">Site Aktifliği</label>
        <div class="col-lg-9 col-xl-6">
            <span class="switch">
                <label>
                    <input type="checkbox" @checked($general_setting->is_active) name="is_active" />
                    <span></span>
                </label>
            </span>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-12 text-right">
            <button type="button" class="btn btn-success mr-2" id="generalSettingButton">Güncelle</button>
        </div>
    </div>
</form>
