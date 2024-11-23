$(document).on('click', '.edit-survey', function () {
    let button = $(this)
    let modal = $('#updateSurveyModal')
    let survey_uuid = button.data('uuid')
    let url = "/admin/dashboard/surveys/edit/" + survey_uuid
    axios.get(url)
        .then((response) => {
            if (response.status === 200) {
                let {data} = response.data
                modal.find('#surveyUpdateForm #title').val(data?.title)
                modal.find('#surveyUpdateForm #description').summernote('code', data?.description)
                modal.find('#surveyUpdateForm #start_date').val(data?.start_date)
                modal.find('#surveyUpdateForm #end_date').val(data?.end_date)
                modal.find('#surveyUpdateForm #status').prop('checked', data.status && data.status === 'active');
                let uuid_input = modal.find('#surveyUpdateForm #uuid')
                if (uuid_input.length > 0) {
                    uuid_input.val(data.uuid)
                } else {
                    createUuidInput(modal.find('#surveyUpdateForm'), data.uuid)
                }
                modal.modal('show')
            }
        })
        .catch((errors) => {
            error(errors)
        })
})

const createUuidInput = (form, uuid) => {
    $('<input>').attr({
        type: 'hidden',
        id: 'uuid',
        name: 'uuid',
        value: uuid // Burada doğru UUID'yi kullanmalısınız
    }).appendTo(form);
}
