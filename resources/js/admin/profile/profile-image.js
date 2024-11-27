var kt_profile_avatar = new KTImageInput('kt_profile_avatar');

kt_profile_avatar.on('cancel', function(imageInput) {
    swal.fire({
        title: 'Resim yükleme iptal edildi',
        icon: 'success',
        buttonsStyling: false,
        confirmButtonText: 'Tamam!',
        confirmButtonClass: 'btn btn-primary font-weight-bold'
    });
});

kt_profile_avatar.on('change', function(imageInput) {
    swal.fire({
        title: 'Resim Başarılı bir şekilde değiştirildi.',
        icon: 'success',
        buttonsStyling: false,
        confirmButtonText: 'Tamam!',
        confirmButtonClass: 'btn btn-primary font-weight-bold'
    });
});

kt_profile_avatar.on('remove', function(imageInput) {
    swal.fire({
        title: 'Resim başarılı bir şekilde kaldırıldı.',
        type: 'error',
        buttonsStyling: false,
        confirmButtonText: 'Tamam!',
        confirmButtonClass: 'btn btn-primary font-weight-bold'
    });
});
