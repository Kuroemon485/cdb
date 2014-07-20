(function($, window, document) {
    var base_url = '/cdb/';
    var response_title = $('#response-title');
    var response_message = $('#response-message');
    var response_modal = $('#response-modal');
    function login(u,p,r) {
        return $.ajax({
            url: base_url+'admin/account/login_verify',
            type: 'post',
            dataType: 'json',
            data: {
                username: u,
                password: p,
                remember: r,
            },
        });
    }
    $(function() {
        $('#login-form').submit(function(event) {
            event.preventDefault();
            user_name = $('[name="username"]').val();
            pass = $('[name="password"]').val();
            remember = "yes";
            login(user_name, pass, remember).done(function(response) {
                response_title.text(response.title);
                response_message.text(response.message);
                switch(response.status) {
                    case "success":
                        response_modal.modal('show');
                        window.setTimeout(function() { window.location.replace(base_url); }, 1000);
                    break;
                    case "fail":
                        response_modal.modal('show');
                    break;
                    default:
                    break;
                }
            });
        });
    });
}(window.jQuery, window, document));