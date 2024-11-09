const btn = KTUtil.getById("imageGalleryCreateModalButton");

KTUtil.addEvent(btn, "click", function () {
    btn.disabled = true;
    KTUtil.btnWait(btn, "spinner spinner-right spinner-white pr-15", "Lütfen bekleyiniz.");
    const modal = $('#imageGalleryCreateModal')
    const modal_form = modal.find('#imageGalleryCreateModalForm')
    let uuid = modal_form.data('uuid')

    setTimeout(function () {
        let form_data = new FormData(modal_form[0])
        form_data.append('gallery_uuid', uuid)
        console.log(form_data.get('gallery_uuid'))
        let url = "/admin/dashboard/galleries/image/store"

        axios.post(url, form_data)
            .then(function (response) {
                if (response.status === 200) {
                    modal.modal('hide');
                    modal_form[0].reset();
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
