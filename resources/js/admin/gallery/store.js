var btn = KTUtil.getById("galleryStoreModalStoreButton");

KTUtil.addEvent(btn, "click", function () {
    btn.disabled = true;
    KTUtil.btnWait(btn, "spinner spinner-right spinner-white pr-15", "Lütfen bekleyiniz.");
    let newsletter_uuid = $(this).data('uuid')
    setTimeout(function () {
        let form = $('#galleryStoreForm')
        let form_data = new FormData(form[0])

        let url = "/admin/dashboard/galleries/store"

        axios.post(url, form_data)
            .then(function (response) {
                if (response.status === 200) {
                    $('#galleryStoreModal').modal('hide');
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
