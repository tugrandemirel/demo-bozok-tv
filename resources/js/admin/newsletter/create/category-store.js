var btn = KTUtil.getById("categoryCreateModalButton");

KTUtil.addEvent(btn, "click", function() {
    btn.disabled = true;
    KTUtil.btnWait(btn, "spinner spinner-right spinner-white pr-15", "Lütfen bekleyiniz.");

    setTimeout(function() {
        let form = $('#createCategoryModalForm')
        let form_data = new FormData(form[0])
        let url = "/admin/dashboard/newsletters/category/store"

        axios.post(url, form_data)
            .then(function (response) {
                console.log(response)
                if (response.status === 200) {
                    // swal.fire({
                    //     icon: response.sta
                    // })
                    $('#createCategoryModal').modal('hide');
                    form[0].reset();
                }
            })
            .catch(function (error) {
                console.log(error)
                // Hata durumunda işleme
                if (error.response) {
                    // Sunucudan dönen hata yanıtı
                    console.error('Sunucu Hatası:', error.response.data);
                    alert('Kategori oluşturulurken bir hata oluştu.');
                } else if (error.request) {
                    // İstek yapıldı ama yanıt alınamadı
                    console.error('İstek Hatası:', error.request);
                    alert('İstek gönderilirken bir hata oluştu.');
                } else {
                    // Diğer hatalar
                    console.error('Hata:', error.message);
                    alert('Bir hata oluştu.');
                }
            })
            .finally(function() {
                // Spinner'ı gizle
                KTUtil.btnRelease(btn);

                // Butonu tekrar etkinleştir
                btn.disabled = false;
            });
    }, 1000);
});
