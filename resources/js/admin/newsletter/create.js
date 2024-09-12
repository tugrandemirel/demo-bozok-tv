
$(document).ready(function() {

    let inputElem = $('#tagify')[0] // the 'input' element which will be transformed into a Tagify component
    let tagify = new Tagify(inputElem)


    var cover_image = new KTImageInput('cover_image');

    cover_image.on('cancel', function(imageInput) {
         swal.fire({
            title: 'Resim yükleme iptal edildi',
            icon: 'success',
            buttonsStyling: false,
            confirmButtonText: 'Tamam!',
            confirmButtonClass: 'btn btn-primary font-weight-bold'
        });
    });

    cover_image.on('change', function(imageInput) {
        swal.fire({
            title: 'Resim Başarılı bir şekilde değiştirildi.',
            icon: 'success',
            buttonsStyling: false,
            confirmButtonText: 'Tamam!',
            confirmButtonClass: 'btn btn-primary font-weight-bold'
        });
    });

    cover_image.on('remove', function(imageInput) {
         swal.fire({
            title: 'Resim başarılı bir şekilde kaldırıldı.',
            type: 'error',
            buttonsStyling: false,
            confirmButtonText: 'Tamam!',
            confirmButtonClass: 'btn btn-primary font-weight-bold'
        });
    });


    var inside_image = new KTImageInput('inside_image');

    inside_image.on('cancel', function(imageInput) {
        swal.fire({
            title: 'Resim yükleme iptal edildi',
            icon: 'success',
            buttonsStyling: false,
            confirmButtonText: 'Tamam!',
            confirmButtonClass: 'btn btn-primary font-weight-bold'
        });
    });

    inside_image.on('change', function(imageInput) {
        swal.fire({
            title: 'Resim Başarılı bir şekilde değiştirildi.',
            icon: 'success',
            buttonsStyling: false,
            confirmButtonText: 'Tamam!',
            confirmButtonClass: 'btn btn-primary font-weight-bold'
        });
    });

    inside_image.on('remove', function(imageInput) {
        swal.fire({
            title: 'Resim başarılı bir şekilde kaldırıldı.',
            type: 'error',
            buttonsStyling: false,
            confirmButtonText: 'Tamam!',
            confirmButtonClass: 'btn btn-primary font-weight-bold'
        });
    });
})

