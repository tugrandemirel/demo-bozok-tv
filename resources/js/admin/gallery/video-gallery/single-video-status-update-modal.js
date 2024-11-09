$(document).on('click', '.single-video-status-modal', function () {
    let uuid = $(this).data('uuid')
    let url = '/admin/dashboard/galleries/video/edit/' + uuid

    axios.get(url)
        .then(function (response) {
            // success(response)
            let {data} = response.data.data
            let { status } = response
            if (status === 200) {
                let uuid_input = $('#singleVideoStatusForm').find('[name=uuid]');

                let is_active_input = $('#singleVideoStatusForm').find('[name=is_active]')
                if (uuid_input) {
                    uuid_input.val(data.uuid)
                } else {
                    $('<input>').attr({
                        type: 'hidden',
                        id: 'uuid',
                        name: 'uuid',
                        value: data.uuid
                    }).appendTo('#singleVideoStatusForm');
                }

                is_active_input.prop('checked', data.is_active === 1)
                $('#singleVideoStatus').modal('show')
            }

        })
        .catch(function (response) {
            error(response)
        })

})
$(document).on('click', '#singleVideoStatusModalButton', function () {

})
