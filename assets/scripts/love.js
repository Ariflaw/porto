;(function($) {

    "use strict";

    $(document).on('click', '.love-button', function () {
        var post_id = $(this).data('id');
        $.ajax({
            url: postlove.ajax_url,
            type: 'post',
            data: {
                action: 'legal_station_post_love_add_love',
                post_id: post_id
            },
            success: function (response) {
                $('#love-count-'+post_id).html(response);
            }
        });

        return false;
    });

})(jQuery);
