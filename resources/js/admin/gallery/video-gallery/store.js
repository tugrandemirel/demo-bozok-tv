$(document).on('click', '#videoGalleryCreateModalButton', function() {
    let modal = $('#videoGalleryCreateModal')
    let form = $('#videoGalleryCreateModalForm')
    let form_data = new FormData(form[0])
    let url = '/admin/dashboard/galleries/video/store'
    let gallery_uuid = form.data('uuid')
    form_data.append('gallery_uuid', gallery_uuid)

    axios.post(url, form_data)
        .then(function(response) {
            success(response)
            form[0].reset()
            modal.modal('toggle')
            window.location.reload()
        })
        .catch(function (response) {
            error(response)
        })

})
