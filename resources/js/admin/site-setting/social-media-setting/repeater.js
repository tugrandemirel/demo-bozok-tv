var KTFormRepeater = function() {

    var demo1 = function() {
        $('#kt_repeater_1').repeater({
            initEmpty: false,

            defaultValues: {
            },
            show: function () {
                $(this).slideDown();
                var index = $(this).closest('[data-repeater-item]').index();
            },

            hide: function(deleteElement) {
                swal.fire({
                    title: 'Silme İşlemi', // status'a göre başlık ayarı
                    icon: 'info', // Varsayılan icon: 'error'
                    text: `Silmek istediğinize emin misiniz? `,
                    showConfirmButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Sil',
                    confirmCancelText: 'Hayır',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).slideUp(deleteElement);
                    }
                })
            },

        });
    }

    return {
        // public functions
        init: function() {
            demo1();
        }
    };
}();

$(document).ready(function() {
    KTFormRepeater.init();
});
