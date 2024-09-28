var gallery_main_category = new KTImageInput('file');

gallery_main_category.on('cancel', function(imageInput) {
    swal.fire({
        title: 'Resim yükleme iptal edildi',
        icon: 'success',
        buttonsStyling: false,
        confirmButtonText: 'Tamam!',
        confirmButtonClass: 'btn btn-primary font-weight-bold'
    });
});

gallery_main_category.on('change', function(imageInput) {
    swal.fire({
        title: 'Resim Başarılı bir şekilde değiştirildi.',
        icon: 'success',
        buttonsStyling: false,
        confirmButtonText: 'Tamam!',
        confirmButtonClass: 'btn btn-primary font-weight-bold'
    });
});

gallery_main_category.on('remove', function(imageInput) {
    swal.fire({
        title: 'Resim başarılı bir şekilde kaldırıldı.',
        type: 'error',
        buttonsStyling: false,
        confirmButtonText: 'Tamam!',
        confirmButtonClass: 'btn btn-primary font-weight-bold'
    });
});
var file_update = new KTImageInput('file_update');

file_update.on('cancel', function(imageInput) {
    swal.fire({
        title: 'Resim yükleme iptal edildi',
        icon: 'success',
        buttonsStyling: false,
        confirmButtonText: 'Tamam!',
        confirmButtonClass: 'btn btn-primary font-weight-bold'
    });
});

file_update.on('change', function(imageInput) {
    swal.fire({
        title: 'Resim Başarılı bir şekilde değiştirildi.',
        icon: 'success',
        buttonsStyling: false,
        confirmButtonText: 'Tamam!',
        confirmButtonClass: 'btn btn-primary font-weight-bold'
    });
});

file_update.on('remove', function(imageInput) {
    swal.fire({
        title: 'Resim başarılı bir şekilde kaldırıldı.',
        type: 'error',
        buttonsStyling: false,
        confirmButtonText: 'Tamam!',
        confirmButtonClass: 'btn btn-primary font-weight-bold'
    });
});
