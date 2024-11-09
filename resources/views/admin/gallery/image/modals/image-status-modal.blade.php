<!-- Modal-->
<div class="modal fade" id="singleVideoStatus" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tekli Video Aktiflik Durumu Düzenle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="singleVideoStatusForm">
                    <label for="is_active" class="form-label">Aktiflik</label>
                    <div class="">
                   <span class="switch switch-icon">
                        <label>
                             <input type="checkbox"  id="is_active" name="is_active"/>
                             <span></span>
                        </label>
                   </span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">İptal</button>
                <button type="button" id="singleVideoStatusModalButton" class="btn btn-primary font-weight-bold">Güncelle</button>
            </div>
        </div>
    </div>
</div>
