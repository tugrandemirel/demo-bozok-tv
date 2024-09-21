
var btn = KTUtil.getById("publicationStatusEditModalButton");

KTUtil.addEvent(btn, "click", function () {
    btn.disabled = true;
    KTUtil.btnWait(btn, "spinner spinner-right spinner-white pr-15", "Lütfen bekleyiniz.");
    let newsletter_uuid = $(this).data('uuid')
    setTimeout(function () {
        let form = $('#publicationStatusEditModalForm')
        let form_data = new FormData(form[0])

        form_data.append('newsletter', newsletter_uuid)
        let url = "/admin/dashboard/newsletters/publication-status/change-status"

        axios.post(url, form_data)
            .then(function (response) {
                if (response.status === 200) {
                    $('#publicationStatusEditModal').modal('hide');
                    form[0].reset();
                    success(response)
                    window.location.reload()
                }
            })
            .catch(function (errors) {
                error(errors)
            })
            .finally(function () {
                KTUtil.btnRelease(btn);
                btn.disabled = false;
            });
    }, 2000);
});
