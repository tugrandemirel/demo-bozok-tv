<!-- Modal-->
<div class="modal fade" id="videoGalleryCreateModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Video Oluştur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="videoGalleryCreateModalForm" data-uuid="{{ $gallery?->uuid }}">
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
                    <div class="form-group"  id="videoPreview">

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">İptal</button>
                <button type="button" id="videoGalleryCreateModalButton" class="btn btn-primary font-weight-bold">Kaydet</button>
            </div>
        </div>
    </div>
</div>

