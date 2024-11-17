$(document).on('change', '#post_status', function() {
    let selected = $(this)
    console.log(selected.val())
    if (selected.val() === "rejected") {
        postReviewRowShow()
    } else {
        postReviewRowHidden()
    }
})

const postReviewRowHidden = () => {
    $('#review_note_row').addClass('d-none')
}
const postReviewRowShow = () => {
    $('#review_note_row').removeClass('d-none')
}

let btn = KTUtil.getById("postStatusModalButton");
KTUtil.addEvent(btn, "click", function () {
    btn.disabled = true;
    KTUtil.btnWait(btn, "spinner spinner-right spinner-white pr-15", "Lütfen bekleyiniz.");

    setTimeout(function () {
        let form = $('#postStatusModalForm')
        let form_data = new FormData(form[0])
        let post_uuid = form.data('uuid')

        form_data.append('post_uuid', post_uuid)

        let url = '/admin/dashboard/posts/update'
        axios.post(url, form_data)
            .then(function (response) {
                if (response.status === 200) {
                    success(response)

                    setTimeout(function () {
                        location.reload()
                    },2000)
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
