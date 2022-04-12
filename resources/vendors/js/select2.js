// -----------------------------------------------------------------------------
// This file contains all select2 js.
// -----------------------------------------------------------------------------

var $ = require('jquery');
// window.$ = $;
require('select2/dist/js/select2');

$(document).ready(function() {
    $(".select2").select2({
        placeholder: function(){
            $(this).data('placeholder');
        }
    });
});