$(document).on("click","#surveyQuestionModal #addAnswer",function(){let e=$(`
        <div class="form-group repeater">
            <label for="answer">Soru Seçeneği</label>
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control" name="answer_text[]">
                </div>
                <div class="col-md-6">
                    <button type="button" class="btn btn-icon btn-circle btn-transparent-danger remove-answer"><i class="flaticon2-trash"></i></button>
                </div>
            </div>
        </div>
    `);$(this).closest("form").append(e)});$(document).on("click","#surveyQuestionModal .remove-answer",function(e){e.preventDefault(),$(this).closest(".form-group").remove()});
