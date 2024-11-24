let btn = KTUtil.getById("surveyQuestionStoreButton");

KTUtil.addEvent(btn, "click", function () {
    btn.disabled = true;
    KTUtil.btnWait(btn, "spinner spinner-right spinner-white pr-15", "Lütfen bekleyiniz.");

    setTimeout(function () {
        let modal = $('#surveyQuestionModal')
        let form = modal.find('#surveyQuestionStoreForm')
        let survey_uuid = form.data('survey-uuid')
        let form_data = new FormData(form[0])
        let url = '/admin/dashboard/surveys/questions/store'

        form_data.append('survey_uuid', survey_uuid)

        axios.post(url, form_data)
            .then(function (response) {
                if (response.status === 200) {
                    success(response)
                    form[0].reset()
                    form.find('.repeater').remove()
                    $('#questions_datatable').DataTable().ajax.reload();
                }
            })
            .catch(function (errors) {
                console.log(errors)
                error(errors)
            })
            .finally(function () {
                KTUtil.btnRelease(btn);
                btn.disabled = false;
            });
    }, 2000);
});

