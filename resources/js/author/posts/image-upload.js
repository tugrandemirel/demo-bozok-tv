const image = new KTImageInput('file');

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
