$(document).on('click', '.update-gallery', function () {
    let button = $(this)
    let gallery_uuid = button.data('uuid');
    let url = "/admin/dashboard/galleries/edit/"+ gallery_uuid
    axios.get(url)
        .then(function (response) {
            let { data } = response.data
            let modal = $('#galleryUpdateModal')
            modal.find('#title').val(data.title);
            modal.find('#description').val(data.description); // Eğer açıklama da varsa ekleyin
            modal.find('#gallery_type').val(data.type).trigger('change'); // Galeri türünü ayarlayın
            modal.find('input[name="is_active"]').prop('checked', data.is_active); // Aktiflik durumunu ayarlayın
            modal.find('.image-input-wrapper').css('background-image', 'url(/' + data.path + ')');

            // UUID inputunu kontrol et
            let galleryUuidInput = modal.find('#gallery_uuid');

            if (galleryUuidInput.length) { // Eğer UUID inputu varsa
                galleryUuidInput.val(data.gallery_uuid); // Mevcut UUID'yi ata
            } else { // UUID inputu yoksa oluştur
                $('<input>').attr({
                    type: 'hidden',
                    id: 'gallery_uuid',
                    name: 'gallery_uuid',
                    value: data.gallery_uuid // Burada doğru UUID'yi kullanmalısınız
                }).appendTo('#galleryUpdateForm');
            }

            modal.modal('show'); // Modal'ı göster
        })
        .catch(function (errors) {
            error(errors)
        })
})
