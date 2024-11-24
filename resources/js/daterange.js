$(function() {

    moment.locale('tr');
    $('.daterange').daterangepicker({
        singleDatePicker: true,
        drops: 'auto',
        showDropdowns: true,
        minYear: 1901,
        maxYear: parseInt(moment().format('YYYY'),10),
        startDate: moment().startOf('hour'),
        endDate: moment().startOf('hour').add(32, 'hour'),
        autoUpdateInput: false, // Otomatik olarak input alanını güncellemeyi kapatır
        locale: {
            format: 'YYYY-MM-DD HH:mm:ss', // Tarih formatı
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
    $('.daterange').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD HH:mm:ss'));
    });

// İptal butonuna basıldığında input'u temizler
    $('.daterange').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });
});
