$(document).on('click', '#imageGalleryUpdateModalFormButton', function () {
    let button =  $(this)
    let modal = $('#imageGalleryUpdateModal')
    let modal_form = modal.find('#imageGalleryUpdateModalForm')
    let form_data = new FormData(modal_form[0])
    let url =  '/admin/dashboard/galleries/image/update/'

    axios.post(url, form_data)
        .then(function (response) {
            success(response)
            setTimeout(function () {
                window.location.reload()
            },2000)
        })
        .catch(function (response) {
            error(response)
        })
})
