
$(function() {
    // Config Validation
    $("#searchForm form").validate({
        onfocusout: function() {
            $("#searchForm form").valid();
        },
        rules: {
            email: {
                email: true
            },
            phone: {
                digits: true,
            },
        }
    });
});