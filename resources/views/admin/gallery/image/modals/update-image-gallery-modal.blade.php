<!-- Modal-->
<div class="modal fade" id="imageGalleryUpdateModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Video Düzenle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="imageGalleryUpdateModalForm" >
                    <div class="form-group">
                        <label for="caption">Resim Alt Açıklama</label>
                        <input type="text" name="alt_text" id="alt_text" class="form-control">
                        <small class="text-info">Bu alan seo için gereklidir. Resimin içerisinde yazmaktadır.</small>
                    </div>
                    <div class="form-group">
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
                    <div class="form-group">
                        <div class=" text-center">
                            <h2>Kapak Fotoğrafı <span class="text-danger">*</span></h2>
                            <div class="image-input image-input-outline" id="update_file">
                                <div class="image-input-wrapper" style="background-image: url({{ asset('assets/media/users/100_1.jpg') }})"></div>

                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Kapak Görselini değiştir">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input type="file" name="update_file" accept=".png, .jpg, .jpeg"/>
                                    <input type="hidden" name="profile_avatar_remove"/>
                                </label>

                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="İptal Et">
                              <i class="ki ki-bold-close icon-xs text-muted"></i>
                         </span>
                            </div>
                            <span class="form-text">Yalnızca: png, jpg, jpeg.</span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">İptal</button>
                <button type="button" id="imageGalleryUpdateModalFormButton" class="btn btn-primary font-weight-bold">Güncelle</button>
            </div>
        </div>
    </div>
</div>

