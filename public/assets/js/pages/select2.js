// Class definition
var KTSelect2 = function() {

    var demos = function() {
        // tagging support
        $('#kt_select2_11').select2({
            placeholder: "Add a tag",
            tags: true,
            width: '100%'
        });
    }
    // Public functions
    return {
        init: function() {
            demos();
        }
    };
}();

// Initialization
jQuery(document).ready(function() {
    KTSelect2.init();
});
