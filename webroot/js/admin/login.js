$(document).ready(function() {

    // Config Validation
    $("#loginForm form").validate({
        onfocusout: function() {
            $("#loginForm form").valid();
        },
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
            },
        },
        submitHandler: function() {
            // Restrict user from resubmitting form
            $('#loginForm form input').attr('readonly', true);
            $('#loginForm form input[type="submit"]').attr('disabled', true);
            $('#loginForm form').submit();
        },
    });
});


