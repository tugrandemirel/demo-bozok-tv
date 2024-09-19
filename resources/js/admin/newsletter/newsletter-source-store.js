let btn = KTUtil.getById("newsletterSourceCreateModalButton");

KTUtil.addEvent(btn, "click", function () {
    btn.disabled = true;
    KTUtil.btnWait(btn, "spinner spinner-right spinner-white pr-15", "Lütfen bekleyiniz.");

    setTimeout(function () {
        let form = $('#newsletterSourceCreateModalForm')
        let form_data = new FormData(form[0])

        let url = "/admin/dashboard/newsletters/newsletter-source/store"

        let cover_image = $('#cover_image')[0].files[0]; // Seçilen dosyayı al

        if (cover_image) {
            form_data.append('cover_image', cover_image); // Dosyayı FormData'ya ekle
        }
        let inside_image = $('#inside_image')[0].files[0]; // Seçilen dosyayı al

        if (inside_image) {
            form_data.append('inside_image', inside_image); // Dosyayı FormData'ya ekle
        }

        let five_cuff_image = $('#five_cuff_image')[0].files[0]; // Seçilen dosyayı al
        if (five_cuff_image) {
            form_data.append('five_cuff_image', five_cuff_image); // Dosyayı FormData'ya ekle
        }

        axios.post(url, form_data)
            .then(function (response) {
                if (response.status === 200) {
                    $('#newsletterSourceCreateModal').modal('hide');
                    form[0].reset();
                    success(response)
                    // updateNewsletterSource()
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

function updateNewsletterSource() {
    let url = "/admin/dashboard/newsletters/newsletter-source/index"
    axios.get(url)
        .then(response => {
            let { data } = response.data.data;
            let formattedData = data.map(item => ({
                id: item.uuid,
                text: item.name
            }));
            $('#newsletter_source').empty();

            $('#newsletter_source').select2({
                data: formattedData,
                placeholder: 'Seçim Yapınız',
                allowClear: true
            });
        })
        .catch(error => {
            console.error('Veri alınırken bir hata oluştu:', error);
        });
}
