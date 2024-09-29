$(document).on('click', '#galleryUpdateModalButton', function () {
    let form = $('#galleryUpdateForm')
    let form_data = new FormData(form[0])
    let url = "/admin/dashboard/galleries/update"

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
