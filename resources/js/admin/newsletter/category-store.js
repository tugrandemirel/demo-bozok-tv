var btn = KTUtil.getById("categoryCreateModalButton");

KTUtil.addEvent(btn, "click", function () {
    btn.disabled = true;
    KTUtil.btnWait(btn, "spinner spinner-right spinner-white pr-15", "Lütfen bekleyiniz.");

    setTimeout(function () {
        let form = $('#createCategoryModalForm')
        let form_data = new FormData(form[0])
        let url = "/admin/dashboard/newsletters/category/store"

        axios.post(url, form_data)
            .then(function (response) {
                if (response.status === 200) {
                    $('#categoryCreateModal').modal('hide');
                    form[0].reset();
                    success(response)
                    updateCategory()
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

function updateCategory() {
    let url = "/admin/dashboard/newsletters/category/index"
    axios.get(url)
        .then(response => {
            // response.data, Select2'ye ekleyeceğiniz yeni veriyi içerir
            let { data } = response.data.data;

            let formattedData = data.map(item => ({
                id: item.uuid, // UUID veya benzersiz kimlik
                text: item.name // Görünen metin
            }));
            // Select2'yi temizle
            $('#category').empty();

            // Yeni verileri Select2'ye ekle
            $('#category').select2({
                data: formattedData,
                placeholder: 'Seçim Yapınız',
                allowClear: true
            });
        })
        .catch(error => {
            // Hata yönetimi
            console.error('Veri alınırken bir hata oluştu:', error);
        });
}
