var image = new KTImageInput('file');

image.on('cancel', function(imageInput) {
    swal.fire({
        title: 'Resim yükleme iptal edildi',
        icon: 'success',
        buttonsStyling: false,
        confirmButtonText: 'Tamam!',
        confirmButtonClass: 'btn btn-primary font-weight-bold'
    });
});

image.on('change', function(imageInput) {
    swal.fire({
        title: 'Resim Başarılı bir şekilde değiştirildi.',
        icon: 'success',
        buttonsStyling: false,
        confirmButtonText: 'Tamam!',
        confirmButtonClass: 'btn btn-primary font-weight-bold'
    });
});

image.on('remove', function(imageInput) {
    swal.fire({
        title: 'Resim başarılı bir şekilde kaldırıldı.',
        type: 'error',
        buttonsStyling: false,
        confirmButtonText: 'Tamam!',
        confirmButtonClass: 'btn btn-primary font-weight-bold'
    });
});
$(document).on('change', '#ad_type', function () {
    let input = $(this)
    if (input.val() === 'google_ads') {
        $('#url_row').hide()
        $('#image_row').hide()
        $('#ad_code_row').show()
    } else if(input.val() === 'special_ads') {
        $('#url_row').show()
        $('#image_row').show()
        $('#ad_code_row').hide()
    }
})
