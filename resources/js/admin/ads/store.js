const btn = KTUtil.getById("adsFormStoreButton");

KTUtil.addEvent(btn, "click", function () {
    btn.disabled = true;
    KTUtil.btnWait(btn, "spinner spinner-right spinner-white pr-15", "Lütfen bekleyiniz.");

    setTimeout(function () {
        let form = $('#adsFormStore')
        let form_data = new FormData(form[0])

        let url = "/admin/dashboard/ads/store"

        axios.post(url, form_data)
            .then(function (response) {
                if (response.status === 200) {
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