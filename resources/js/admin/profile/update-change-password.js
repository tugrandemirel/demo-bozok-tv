let btn = KTUtil.getById("changePassword");
KTUtil.addEvent(btn, "click", function () {
    btn.disabled = true;
    KTUtil.btnWait(btn, "spinner spinner-right spinner-white pr-15", "Lütfen bekleyiniz.");

    setTimeout(function () {
        let form = $('#changePasswordForm')
        let form_data = new FormData(form[0])
        console.log(form)
        let url = '/admin/dashboard/profile/update-password'
        axios.post(url, form_data)
            .then(function (response) {
                if (response.status === 200) {
                    success(response)

                    setTimeout(function () {
                        location.reload()
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
