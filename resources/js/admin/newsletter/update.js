let btn = KTUtil.getById("newsletterStoreButton");

KTUtil.addEvent(btn, "click", function () {
    btn.disabled = true;
    KTUtil.btnWait(btn, "spinner spinner-right spinner-white pr-15", "Lütfen bekleyiniz.");

    setTimeout(function () {
        let form = $('#newslettersFormUpdate')
        let form_data = new FormData(form[0])
        let newsletter_uuid = form.data('uuid')

        form_data.append('newsletter_uuid', newsletter_uuid)

        let url = "/admin/dashboard/newsletters/update"

        axios.post(url, form_data)
            .then(function (response) {
                if (response.status === 200) {
                    $('#newsletterSourceCreateModal').modal('hide');
                    form[0].reset();
                    success(response)

                    setTimeout(function () {
                        window.location.href = "/admin/dashboard/newsletters/show/"+newsletter_uuid
                    },2000)
                }
            })
            .catch(function (errors) {
                error(errors)
            })
            .finally(function () {
                KTUtil.btnRelease(btn);
                btn.disabled = false;
            });
    }, 1000);
});
