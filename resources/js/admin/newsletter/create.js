$(document).ready(function() {

    let inputElem = $('#tagify')[0] // the 'input' element which will be transformed into a Tagify component
    let tagify = new Tagify(inputElem)
    $('select').select2({
        placeholder: 'Seçim Yapınız',
    });

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
$(function() {

    moment.locale('tr');
    $('input[name="publish_date"]').daterangepicker({
        singleDatePicker: true,
        drops: 'auto',
        showDropdowns: true,
        minYear: 1901,
        maxYear: parseInt(moment().format('YYYY'),10),
        startDate: moment().startOf('hour'),
        endDate: moment().startOf('hour').add(32, 'hour'),
        locale: {
            format: 'DD/MM/YYYY HH:mm', // Tarih formatı
            applyLabel: 'Uygula', // Uygula butonunun etiketi
            cancelLabel: 'İptal', // İptal butonunun etiketi
            fromLabel: 'Başlangıç',
            toLabel: 'Bitiş',
            customRangeLabel: 'Özel',
            daysOfWeek: ['Paz', 'Pzt', 'Sal', 'Çar', 'Per', 'Cum', 'Cmt'], // Haftanın günleri
            monthNames: ['Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'], // Ay isimleri
            firstDay: 1 // Haftanın ilk günü (1: Pazartesi)
        },
        timePicker: true, // Saat seçimini etkinleştirir
        timePicker24Hour: true, // 24 saatlik formatı etkinleştirir
        minDate: moment().startOf('day'), // Bugünden önceki tarihleri engeller
        maxDate: moment().add(1, 'years').endOf('day'), // İsteğe bağlı olarak, max tarihi de belirleyebilirsiniz
    });
});
