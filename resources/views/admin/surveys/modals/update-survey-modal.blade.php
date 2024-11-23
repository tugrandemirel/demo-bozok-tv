<div class="modal fade" id="updateSurveyModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Anket Oluştur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="surveyUpdateForm">
                    <div class="form-group">
                        <label for="title">Anket Başlığı</label>
                        <input type="text" class="form-control" name="title" id="title">
                    </div>
                    <div class="form-group">
                        <label for="description">Anket Açıklaması</label>
                        <textarea  class="summernote" name="description" id="description" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="start_date">Başkangıç Tarihi</label>
                                <input type="text" class="form-control daterange" name="start_date" id="start_date">
                            </div>
                            <div class="col-md-6">

                                <label for="end_date">Btiriş Tarihi</label>
                                <input type="text" class="form-control daterange" name="end_date" id="end_date">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row justify-content-between">
                        <div class="col-md-6">
                            <label class="col-md-4 form-label">Aktiflik</label>
                            <span class="switch switch-icon">
                                <label>
                                     <input type="checkbox" name="status" id="status"/>
                                     <span></span>
                                </label>
                           </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">İptal</button>
                <button type="button" id="surveyModalUpdateButton" class="btn btn-primary font-weight-bold">Kaydet</button>
            </div>
        </div>
    </div>
</div>
