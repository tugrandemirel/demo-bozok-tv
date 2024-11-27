var KTInputmask = function () {
    var demos = function () {
        $(".phone-mask").inputmask("mask", {
            "mask": "+90(999) 999-9999"
        });
    }

    return {
        init: function() {
            demos();
        }
    };
}();

jQuery(document).ready(function() {
    KTInputmask.init();
});
