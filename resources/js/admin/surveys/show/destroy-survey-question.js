$(document).on('click', '.delete-question-modal', function () {
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
            let question_uuid = button.data('question-uuid')
            let url = '/admin/dashboard/surveys/questions/destroy'

            axios.delete(url,{
                data:{question_uuid}
            })
                .then((response) => {
                    if (response.status === 200) {
                        success(response)
                        $('#questions_datatable').DataTable().ajax.reload();
                    }
                })
                .catch((response) => {
                    error(response)
                })
        }
    })
})
