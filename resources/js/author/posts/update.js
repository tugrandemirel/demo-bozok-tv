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
let btn = KTUtil.getById("postUpdateButton");

KTUtil.addEvent(btn, "click", function () {
    btn.disabled = true;
    KTUtil.btnWait(btn, "spinner spinner-right spinner-white pr-15", "Lütfen bekleyiniz.");

    setTimeout(function () {
        let form = $('#postUpdateForm')
        let form_data = new FormData(form[0])
        let post_uuid = form.data('uuid')
        form_data.append('post_uuid', post_uuid)
       let url = '/author/dashboard/posts/update'
       /* let fileInput = form.find('input[type="file"]')[0]; // Dosya input elemanını alıyoruz
        let image = ''
        if (fileInput.files.length > 0) {
            image = fileInput.files[0]
        }
        console.log(image)
        let form_data = {
            title: form.find('input[name="title"]').val(),
            content: form.find('textarea[name="content"]').val(), // content alanı genellikle textarea olmalı
            file: image ?? null, // file input'tan seçilen dosyayı alıyoruz
            post_uuid: post_uuid
        }*/

// Dosya input'unu kontrol ediyoruz ve dosyayı ekliyoruz



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
