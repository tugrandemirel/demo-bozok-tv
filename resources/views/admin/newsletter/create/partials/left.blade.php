<div class="card card-custom gutter-b">
    <div class="card-body text-center">
        <div class="card-title">
            <h2>Kapak Fotoğrafı <span class="text-danger">*</span></h2>
        </div>
        <div class="image-input image-input-outline" id="cover_image">
            <div class="image-input-wrapper" style="background-image: url({{ asset('assets/media/users/100_1.jpg') }})"></div>

            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Kapak Görselini değiştir">
                <i class="fa fa-pen icon-sm text-muted"></i>
                <input type="file" name="cover_image" accept=".png, .jpg, .jpeg"/>
                <input type="hidden" name="profile_avatar_remove"/>
            </label>

            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="İptal Et">
                              <i class="ki ki-bold-close icon-xs text-muted"></i>
                         </span>
        </div>
        <span class="form-text">Yalnızca: png, jpg, jpeg.</span>
    </div>
    <div class="card-body text-center">
        <div class="card-title">
            <h2>İç Kapak</h2>
        </div>
        <div class="image-input image-input-outline" id="inside_image">
            <div class="image-input-wrapper" style="background-image: url({{ asset('assets/media/users/100_1.jpg') }})"></div>

            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="İç Kapak Görselini değiştir">
                <i class="fa fa-pen icon-sm text-muted"></i>
                <input type="file" name="inside_image" accept=".png, .jpg, .jpeg"/>
                <input type="hidden" name="profile_avatar_remove"/>
            </label>

            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="İptal Et">
                              <i class="ki ki-bold-close icon-xs text-muted"></i>
                         </span>
        </div>
        <span class="form-text">Yalnızca: png, jpg, jpeg.</span>
    </div>
</div>
<div class="card card-custom gutter-b">
    <div class="card-body text-center">
        <div class="form-group">
            <label for="" class="form-label label-between">
                Haber Durumu:
                <i class="flaticon2-check-mark text-success"></i>
            </label>
            <select name="" class="form-control" id="">
                <option value="">Yayında</option>
                <option value="">Taslakta</option>
                <option value="">Arşiv</option>
            </select>
        </div>
    </div>
</div>
<div class="card card-custom gutter-b">
    <div class="card-body">
        <div class="form-group">
            <label for="" class="form-label label-between">
                Kategori Seçimi:
                <button type="button" data-toggle="modal" data-target="#categoryCreateModal" title="Kategori Ekle"><i class="flaticon2-plus text-success"></i></button>
            </label>
            <select name="" class="form-control" id="category">
                <option value="">Asayiş</option>
                <option value="">Sağlık</option>
                <option value="">Spor</option>
            </select>
        </div>
        <div class="form-group">
            <label for="" class="form-label label-between">
                Haber Kaynağı:
                <button type="button"  data-toggle="modal" data-target="#newsletterSourceCreateModal" title="Haber Kaynağı Ekle"><i class="flaticon2-plus text-success"></i></button>
            </label>
            <select name="" class="form-control" id="">
                <option value="">Bozok Tv</option>
                <option value="">İHA</option>
                <option value="">AA</option>
            </select>
        </div>
    </div>
</div>
<div class="card card-custom gutter-b">
    <div class="card-body">
        <div class="form-group">
            <label for="" class="form-label">Yayın Tarihi:</label>
            <input type="datetime-local" class="form-control" placeholder="" />
        </div>
    </div>
</div>
