<div class="modal fade" id="surveyQuestionUpdateModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Soru Düzenle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-custom alert-outline-danger alert-shadow fade show gutter-b" role="alert">
                    <div class="alert-icon">
                        <span class="svg-icon svg-icon-danger svg-icon-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <title>Stockholm-icons / Tools / Compass</title>
                                <desc>Created with Sketch.</desc>
                                <defs></defs>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <path d="M7.07744993,12.3040451 C7.72444571,13.0716094 8.54044565,13.6920474 9.46808594,14.1079953 L5,23 L4.5,18 L7.07744993,12.3040451 Z M14.5865511,14.2597864 C15.5319561,13.9019016 16.375416,13.3366121 17.0614026,12.6194459 L19.5,18 L19,23 L14.5865511,14.2597864 Z M12,3.55271368e-14 C12.8284271,3.53749572e-14 13.5,0.671572875 13.5,1.5 L13.5,4 L10.5,4 L10.5,1.5 C10.5,0.671572875 11.1715729,3.56793164e-14 12,3.55271368e-14 Z" fill="#000000" opacity="0.3"></path>
                                    <path d="M12,10 C13.1045695,10 14,9.1045695 14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 C10,9.1045695 10.8954305,10 12,10 Z M12,13 C9.23857625,13 7,10.7614237 7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 C17,10.7614237 14.7614237,13 12,13 Z" fill="#000000" fill-rule="nonzero"></path>
                                </g>
                            </svg><!--end::Svg Icon-->
                        </span>
                    </div>
                    <div class="alert-text">
                       Sorunuzda en az bir adet soru seçeneği olmak zorundadır.
                    </div>
                </div>
                <form id="surveyQuestionUpdateForm" data-survey-uuid="{{ $survey?->uuid }}">
                    <div class="form-group">
                        <label for="question_text">Soru</label>
                        <input type="text" class="form-control" name="question_text" id="question_text">
                    </div>
                    <div class="form-group">
                        <label for="answer">Soru Seçeneği</label>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="answer_text[]" id="answer">
                            </div>
                            <div class="col-md-6">
                                <a href="#" class="btn btn-icon btn-circle btn-transparent-primary" id="addAnswer" data-toggle="tooltip" title="Soru Cevabı Ekle">
                                    <i class="flaticon-add-circular-button"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">İptal</button>
                <button type="button" id="surveyQuestionUpdateButton" class="btn btn-primary font-weight-bold">Kaydet</button>
            </div>
        </div>
    </div>
</div>
