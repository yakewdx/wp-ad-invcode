(function( $ ) {
    'use strict';
    $(document).ready(function(){
        $('#ivc-purchase-form').on('submit', function(e) {
            e.preventDefault();
            var form_array = {};
            $.post(ajaxurl, {'action': 'add_invcode',
                             'data': form_array},
                            function (data){
                                alert(data);
                            });
        });
    })

})( jQuery );
