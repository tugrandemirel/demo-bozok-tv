var logo = new KTImageInput('logo');

logo.on('cancel', function(imageInput) {
    swal.fire({
        title: 'Resim yükleme iptal edildi',
        icon: 'success',
        buttonsStyling: false,
        confirmButtonText: 'Tamam!',
        confirmButtonClass: 'btn btn-primary font-weight-bold'
    });
});

logo.on('change', function(imageInput) {
    swal.fire({
        title: 'Resim Başarılı bir şekilde değiştirildi.',
        icon: 'success',
        buttonsStyling: false,
        confirmButtonText: 'Tamam!',
        confirmButtonClass: 'btn btn-primary font-weight-bold'
    });
});

logo.on('remove', function(imageInput) {
    swal.fire({
        title: 'Resim başarılı bir şekilde kaldırıldı.',
        type: 'error',
        buttonsStyling: false,
        confirmButtonText: 'Tamam!',
        confirmButtonClass: 'btn btn-primary font-weight-bold'
    });
});

var favicon = new KTImageInput('favicon');

favicon.on('cancel', function(imageInput) {
    swal.fire({
        title: 'Resim yükleme iptal edildi',
        icon: 'success',
        buttonsStyling: false,
        confirmButtonText: 'Tamam!',
        confirmButtonClass: 'btn btn-primary font-weight-bold'
    });
});

favicon.on('change', function(imageInput) {
    swal.fire({
        title: 'Resim Başarılı bir şekilde değiştirildi.',
        icon: 'success',
        buttonsStyling: false,
        confirmButtonText: 'Tamam!',
        confirmButtonClass: 'btn btn-primary font-weight-bold'
    });
});

favicon.on('remove', function(imageInput) {
    swal.fire({
        title: 'Resim başarılı bir şekilde kaldırıldı.',
        type: 'error',
        buttonsStyling: false,
        confirmButtonText: 'Tamam!',
        confirmButtonClass: 'btn btn-primary font-weight-bold'
    });
});
