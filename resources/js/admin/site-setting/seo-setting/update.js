// Class definition
var KTTagifyDemos = function() {
    // Private functions
    var demo1 = function() {
        var input = document.getElementById('tagify'),
            // init Tagify script on the above inputs
            tagify = new Tagify(input, {
                height: 'auto'
            })

    }


    return {
        // public functions
        init: function() {
            demo1();
        }
    };
}();

$(document).ready(function() {
    KTTagifyDemos.init();
});
