const modal_form = $('#videoGalleryUpdateModalForm');
const modal = $('#videoGalleryUpdateModal');

$(document).on('click', '.single-video-update-modal', function () {
    let uuid = $(this).data('uuid');
    let url = '/admin/dashboard/galleries/video/edit/' + uuid;

    axios.get(url)
        .then(function (response) {
            let { data } = response.data.data;
            let { status } = response;
            if (status === 200) {
                // Formdaki input alanlarına veri doldurma
                modal_form.find('[name=video_url]').val(data.video_url);
                modal_form.find('[name=caption]').val(data.caption);
                modal_form.find('[name=is_active]').prop('checked', data.is_active === 1);

                // UUID inputunu kontrol etme ve oluşturma
                let uuid_input = modal_form.find('[name=uuid]');
                if (uuid_input.length) {
                    uuid_input.val(data.uuid); // Mevcut input varsa değerini güncelle
                } else {
                    $('<input>').attr({
                        type: 'hidden',
                        name: 'uuid',
                        value: data.uuid
                    }).appendTo(modal_form); // Yoksa yeni bir input oluştur
                }

                // Video önizlemesi
                videoPreview(data.video_url);

                // Modalı aç
                modal.modal('show');
            }
        })
        .catch(function (response) {
            error(response)
        })
})

$(document).on('click', '#videoGalleryUpdateModalFormButton', function () {
    let uuid = modal_form.find('[name=uuid]').val()
    let url = '/admin/dashboard/galleries/video/update/'
    let form_data = new FormData(modal_form[0])

    axios.post(url, form_data)
        .then(function(response) {
            modal_form[0].reset()
            modal.modal('toggle')
            success(response)
            window.location.reload()
        })
        .catch(function (response) {
            error(response)
        })
})

const videoPreview = (url) => {
    let preview_div = $('#videoPreviewUpdate')
    let embed_code = ''
    preview_div.empty()
    if (url.includes('youtube.com/watch?v=')) {
        const video_id = url.split('v=')[1];
        embed_code = `<iframe width="100%" height="100%" src="https://www.youtube.com/embed/${video_id}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>`;
    } else if (url.includes('vimeo.com/')) {
        const video_id = url.split('.com/')[1];
        embed_code = `<iframe src="https://player.vimeo.com/video/${video_id}" width="100%" height="100%" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>`;
    }

    if (embed_code) {
        preview_div.append(embed_code)
    } else {
        preview_div.append('')
    }
}
