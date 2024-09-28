<div class="modal fade" id="galleryStoreModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Galeri Düzenle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="galleryStoreForm">
                    <div class="form-group">
                        <label for="title">Galeri Başlığı</label>
                        <input type="text" class="form-control" name="title" id="title">
                    </div>
                    <div class="form-group">
                        <label for="description">Galeri Açıklaması</label>
                        <textarea name="description" id="description" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <div class=" text-center">
                            <h2>Kapak Fotoğrafı <span class="text-danger">*</span></h2>
                            <div class="image-input image-input-outline" id="file">
                                <div class="image-input-wrapper" style="background-image: url({{ asset('assets/media/users/100_1.jpg') }})"></div>

                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Kapak Görselini değiştir">
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
                    <div class="form-group row justify-content-between">
                        <label for="type">Galeri Türü</label>
                        <select name="type" id="type" class="form-control select2">
                            <option value="" disabled selected>Seçim Yapınız</option>
                            @foreach(\App\Enum\Gallery\GalleryTypeEnum::cases() as $type)
                                <option value="{{ $type->name }}">{{ \App\Helpers\Custom\CustomHelper::getGalleryTypeName($type) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group row justify-content-between">
                        <div class="col-md-6">
                            <label class="col-md-4 form-label">Aktiflik</label>
                           <span class="switch switch-icon">
                                <label>
                                     <input type="checkbox" name="is_active"/>
                                     <span></span>
                                </label>
                           </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">İptal</button>
                <button type="button" id="galleryStoreModalStoreButton" class="btn btn-primary font-weight-bold">Kaydet</button>
            </div>
        </div>
    </div>
</div>
