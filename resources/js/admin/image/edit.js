$(document).on('click', '.single-image-update-modal', function () {
    let button = $(this)
    let uuid = button.data('uuid')
    let url = '/admin/dashboard/galleries/image/edit/' + uuid
    let modal = $('#imageGalleryUpdateModal')

    axios.get(url)
        .then(function (response) {
            let { data } = response.data
            modal.find('input[name="alt_text"]').val(data.alt_text);
            modal.find('input[name="is_active"]').prop('checked', data.is_active); // Aktiflik durumunu ayarlayın
            modal.find('.image-input-wrapper').css('background-image', 'url(/' + data.path + ')');

            // UUID inputunu kontrol et
            let galleryUuidInput = modal.find('[name=uuid]');
            if (galleryUuidInput.length) { // Eğer UUID inputu varsa
                galleryUuidInput.val(data.uuid); // Mevcut UUID'yi ata
            } else { // UUID inputu yoksa oluştur
                $('<input>').attr({
                    type: 'hidden',
                    id: 'uuid',
                    name: 'uuid',
                    value: data.uuid // Burada doğru UUID'yi kullanmalısınız
                }).appendTo('#imageGalleryUpdateModalForm');
            }

            modal.modal('show'); // Modal'ı göster
        })
        .catch(function (errors) {
            error(errors)
        })
})
