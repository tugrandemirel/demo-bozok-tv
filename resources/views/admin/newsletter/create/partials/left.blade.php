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
</div>
<div class="card card-custom gutter-b">
    <div class="card-body text-center">
        <div class="form-group">
            <label for="publication_status" class="form-label label-between">
                Haber Durumu:
                <i class="flaticon2-check-mark text-success"></i>
            </label>
            <select name="publication_status" class="form-control select2" id="publication_status">
                <option value="" disabled selected></option>
                @foreach($publication_statuses as $publication_status)
                    <option value="{{ $publication_status?->uuid ?? '' }}">{{ $publication_status?->name ?? '' }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="card card-custom gutter-b">
    <div class="card-body">
        <div class="form-group">
            <label for="category" class="form-label label-between">
                Kategori Seçimi:
                <button type="button" data-toggle="modal" class="btn btn-link btn-icon btn-sm" data-target="#categoryCreateModal" title="Kategori Ekle">
                    <i class="flaticon2-plus text-success"></i>
                </button>
            </label>
            <select name="category" class="form-control select2" id="category">
                <option value="" disabled selected></option>
                @foreach($categories as $category)
                    <option value="{{ $category->uuid ?? '' }}">{{ $category->name ?? '-' }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="newsletter_source" class="form-label label-between">
                Haber Kaynağı:
                <button type="button"  data-toggle="modal" class="btn btn-link btn-icon btn-sm" data-target="#newsletterSourceCreateModal" title="Haber Kaynağı Ekle">
                    <i class="flaticon2-plus text-success"></i>
                </button>
            </label>
            <select name="newsletter_source" class="form-control select2" id="newsletter_source">
                @foreach($newsletter_sources as $newsletter_source)
                    <option value="{{ $newsletter_source?->uuid ?? '' }}">{{ $newsletter_source?->name ?? '-' }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="card card-custom gutter-b">
    <div class="card-body">
        <div class="form-group">
            <label for="" class="form-label">Yayın Tarihi:</label>
            <input type="text" class="form-control" name="publish_date" placeholder="" />
        </div>
    </div>
</div>
