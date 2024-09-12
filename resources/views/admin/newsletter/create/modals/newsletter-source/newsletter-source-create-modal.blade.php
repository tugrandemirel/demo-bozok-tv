<!-- Modal-->
<div class="modal fade" id="newsletterSourceCreateModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Haber Kaynağı Oluştur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="newsletterSourceCreateModalForm">
                    <div class="form-group">
                        <label for="source" class="form-label">Kaynak</label>
                        <input type="text" class="form-control" id="source" placeholder="Haber Kaynağı giriniz." name="source">
                    </div>
                    <div class="form-group">
                        <label for="url" class="form-label">Kaynak URL</label>
                        <input type="text" class="form-control" id="url" placeholder="Haber Kaynağı URL giriniz" name="url">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Kapat</button>
                <button type="button" class="btn btn-primary font-weight-bold" id="newsletterSourceCreateModalButton">Kaydet</button>
            </div>
        </div>
    </div>
</div>
