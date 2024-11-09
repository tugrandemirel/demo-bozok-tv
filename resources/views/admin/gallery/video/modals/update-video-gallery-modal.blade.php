<!-- Modal-->
<div class="modal fade" id="videoGalleryUpdateModal" data-backdrop="static" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Video Düzenle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="videoGalleryUpdateModalForm" data-uuid="{{ $gallery?->uuid }}">
                    <div class="form-group">
                        <label for="video_url">Video Url</label>
                        <input type="text" name="video_url" id="video_url" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="caption">Açıklama</label>
                        <input type="text" name="caption" id="caption" class="form-control">
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
                    <div class="form-group"  id="videoPreviewUpdate">

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">İptal</button>
                <button type="button" id="videoGalleryUpdateModalFormButton" class="btn btn-primary font-weight-bold">Güncelle</button>
            </div>
        </div>
    </div>
</div>

