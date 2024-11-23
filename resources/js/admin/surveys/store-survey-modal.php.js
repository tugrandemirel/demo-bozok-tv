let btn = KTUtil.getById("surveyModalStoreButton");

KTUtil.addEvent(btn, "click", function () {
    btn.disabled = true;
    KTUtil.btnWait(btn, "spinner spinner-right spinner-white pr-15", "Lütfen bekleyiniz.");

    setTimeout(function () {
        let modal = $("#createSurveyModal")
        let form = modal.find("#surveyStoreForm")
        let form_data = new FormData(form[0])

        let url = "/admin/dashboard/surveys/store"

        axios.post(url, form_data)
            .then(function (response) {
                if (response.status === 200) {
                    success(response)
                    form[0].reset()
                    $('#survey_datatable').DataTable().ajax.reload();
                    modal.modal('hide')
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

