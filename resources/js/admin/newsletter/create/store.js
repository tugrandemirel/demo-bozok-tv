let btn = KTUtil.getById("newsletterStoreButton");

KTUtil.addEvent(btn, "click", function () {
    btn.disabled = true;
    KTUtil.btnWait(btn, "spinner spinner-right spinner-white pr-15", "Lütfen bekleyiniz.");

    setTimeout(function () {
        let form = $('#newslettersFormStore')
        let form_data = new FormData(form[0])

        let url = "/admin/dashboard/newsletters/store"

        axios.post(url, form_data)
            .then(function (response) {
                if (response.status === 200) {
                    $('#newsletterSourceCreateModal').modal('hide');
                    form[0].reset();
                    success(response)
                    setTimeout(function () {
                        window.location.reload()
                    },2000)
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
    }, 1000);
});
