$(document).on('click', '.delete-survey', function () {
    let button = $(this)
    Swal.fire({
        title: "Sil!",
        text: "Silmek istediğinize emin misiniz?",
        imageUrl: "/assets/media/svg/illustrations/23.svg",
        imageWidth: 400,
        imageHeight: 200,
        imageAlt: "Custom image",
        animation: true,
        confirmButtonClass: "btn btn-light-primary font-weight-bold",
        cancelButtonClass: "btn btn-transparent-danger font-weight-bold",
        confirmButtonText: "Sil",
        cancelButtonText: "İptal",
        showCancelButton: true,
    }).then((result) => {
        if (result.isConfirmed) {
            let survey_uuid = button.data('uuid')
            let url = '/admin/dashboard/surveys/destroy'

            axios.delete(url,{
                data:{survey_uuid}
            })
                .then((response) => {
                    if (response.status === 200) {
                        success(response)
                        $('#survey_datatable').DataTable().ajax.reload();
                    }
                })
                .catch((response) => {
                    error(response)
                })
        }
    })
})
