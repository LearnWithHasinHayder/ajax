(function ($) {
    $(document).ready(function () {
        $("#contact").on('click', function () {
            const nonce =  ajax_object.nonce;
            // alert(nonce);
            // $.post(ajax_object.ajax_url, {
            //     action: 'contact',
            //     email:$("#email").val(),
            //     subject:$("#subject").val(),
            //     message:$("#message").val(),
            //     _ajax_nonce: nonce,
            //     // n: nonce
            //     // _wpnonce: nonce
            // }, function (response) {
            //     console.log(response);
            // });
            // return false;

            $.get(ajax_object.ajax_url, {
            // $.getJSON(ajax_object.ajax_url, {
                action: 'comic',
                number:936,
                _ajax_nonce: ajax_object.comic_nonce,
            }, function (response) {
                console.log(response);
                alert(response.img);
            })
        })
    });
})(jQuery);