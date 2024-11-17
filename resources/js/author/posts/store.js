$(document).on('input', '#title', function () {
    let description = $(this);
    let character_count = description.next().find('.character_count'); // Bir sonraki sibling olan p içindeki karakter sayısını al
    character_count.text('Kalan karakter sayısı: ' + (150 - description.val().length)); // Kalan karakter sayısını güncelle
    if (description.val().length > 150) {
        description.addClass('is-invalid');
        character_count.addClass('text-danger');
    } else {
        description.removeClass('is-invalid');
        character_count.removeClass('text-danger');
    }
});
let btn = KTUtil.getById("postStoreButton");

KTUtil.addEvent(btn, "click", function () {
    btn.disabled = true;
    KTUtil.btnWait(btn, "spinner spinner-right spinner-white pr-15", "Lütfen bekleyiniz.");

    setTimeout(function () {
        let form = $('#postStoreForm')
        let form_data = new FormData(form[0])

        let url = '/author/dashboard/posts/store'

        axios.post(url, form_data)
            .then(function (response) {
                if (response.status === 200) {
                    form[0].reset();
                    success(response)
                    setTimeout(function () {
                        window.location.href
                    }, 2000)
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
