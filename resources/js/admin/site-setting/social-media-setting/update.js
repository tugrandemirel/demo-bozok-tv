
let btn = KTUtil.getById("socialMediaButton");

KTUtil.addEvent(btn, "click", function () {
    btn.disabled = true;
    KTUtil.btnWait(btn, "spinner spinner-right spinner-white pr-15", "Lütfen bekleyiniz.");

    setTimeout(function () {
        let form = $("#socialMediaForm");

        let url = "/admin/dashboard/site-setting/social-media-setting";
        let data = new FormData(form[0]);
// FormData içerisindeki verileri loglama
        for (let pair of data.entries()) {
            console.log(pair)
            console.log(pair[0] + ': ' + pair[1]);
        }
        axios.post(url, data)
            .then(function (response) {
                if (response.status === 200) {
                    success(response)
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

