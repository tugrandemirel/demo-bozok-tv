$(document).on('click', '.edit-question-modal', function () {
    let button = $(this)
    let modal = $("#surveyQuestionUpdateModal")
    let form = modal.find("#surveyQuestionUpdateForm")
    let question_uuid = button.data('question-uuid')
    let url = "/admin/dashboard/surveys/questions/edit/" + question_uuid
    form.find('#question_text').val('');
    form.find('.repeater').remove(); // Önceki dinamik alanları kaldır
    axios.get(url)
        .then((response) => {
            if (response.status === 200) {
                let {data} = response.data;
                let {options} = data
                console.log(data)
                modal.find('#question_text').val(data?.question_text)
                let uuid_input = modal.find("#uuid")
                if (uuid_input.length > 0) {
                    uuid_input.val(data.uuid)
                } else {
                    createUuidInput(form, data.uuid)
                }
                if (options && options.length > 0) {
                    form.find('input[name="answer_text[]"]').first().val(options[0].answer_text);

                    for (let i = 1; i < options.length; i++) {
                        addAnswerField(form, options[i].answer_text);
                    }
                }

                modal.modal('show')
            }
        })
        .catch((errors) => {
            error(errors)
        })
})

const addAnswerField = (form, answerText = '') => {
    let newAnswerField = `
        <div class="form-group repeater">
            <label for="answer">Soru Seçeneği</label>
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control" name="answer_text[]" value="${answerText}">
                </div>
                <div class="col-md-6">
                   <button type="button" class="btn btn-icon btn-circle btn-transparent-danger remove-answer"><i class="flaticon2-trash"></i></button>
                </div>
            </div>
        </div>
    `;

    form.append(newAnswerField);
};

$(document).on('click', '#surveyQuestionUpdateModal #addAnswer', function (e) {
    e.preventDefault();
    let form = $(this).closest('form');
    addAnswerField(form);
});

// Silme butonuna tıklanınca dinamik alanı kaldır
$(document).on('click', '#surveyQuestionUpdateModal .remove-answer', function (e) {
    e.preventDefault();
    $(this).closest('.repeater').remove();
});


const createUuidInput = (form, uuid) => {
    $('<input>').attr({
        type: 'hidden',
        id: 'uuid',
        name: 'uuid',
        value: uuid // Burada doğru UUID'yi kullanmalısınız
    }).appendTo(form);
}

