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
                    text: "Silmek istediğinize emin misiniz?",
                    imageUrl: "/assets/media/svg/illustrations/23.svg",
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: "Custom image",
                    animation: true,
                    confirmButtonClass: "btn btn-light-primary font-weight-bold",
                    cancelButtonClass: "btn btn-transparent-danger font-weight-bold",
                    confirmButtonText: "Sil",
                    cancelButtonText: "İptal",
                    showCancelButton: true,
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
