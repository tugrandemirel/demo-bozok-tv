<!-- Modal-->
<div class="modal fade" id="categoryCreateModal" data-backdrop="static" tabindex="-1" role="dialog"
     aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kategori Oluştur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="createCategoryModalForm">
                    <div class="form-group">
                        <label for="" class="form-label">Kategori Adı</label>
                        <input type="text" class="form-control" placeholder="Kategori adı giriniz." name="category">
                    </div>
                    <div class="form-group row justify-content-between">
                        <label class="col-md-4 form-label">Aktiflik</label>
                        <div class="col-md-6">
                           <span class="switch switch-icon">
                                <label>
                                     <input type="checkbox" name="is_active"/>
                                     <span></span>
                                </label>
                           </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-6 form-label">Anasayfada Göster</label>
                        <div class="col-md-6">
                           <span class="switch switch-icon">
                                <label>
                                     <input type="checkbox" name="home_page"/>
                                     <span></span>
                                </label>
                           </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Kapat</button>
                <button type="button" class="btn btn-primary font-weight-bold" id="categoryCreateModalButton">Kaydet
                </button>
            </div>
        </div>
    </div>
</div>
