(function( $ ) {
    'use strict';
    $(document).ready(function(){
        $('#alipayment').on('submit', function(e) {
            e.preventDefault();
            var form_array = {};
            $.post(ajaxurl, {'action': 'call_api',
                             'data': form_array},
                            function (data){
                                $('#wpbody-content').html(data);
                            });
        });
    })

})( jQuery );
