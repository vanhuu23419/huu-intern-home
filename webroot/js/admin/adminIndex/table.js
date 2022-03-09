
var adminTable = {
    deleteUrl: null,
    editUrl: null,
    init: function($data) {
        // set data
        this.deleteUrl = $data.deleteUrl.replace(/\/0$/, ''); // remove trailing '/0'
        this.editUrl = $data.editUrl.replace(/\/0$/, ''); // remove trailing '/0'
    },
    edit: function(id) {
        window.location.href = this.editUrl + '/' + id;
    },
    delete: function(id) {
        $.ajax(this.deleteUrl + `/${id}`, {
            'method': 'post',
            'data': {
                '_csrfToken': CSRF_TOKEN,
            },
            'success': function($result) {
                if ($result.success == 1) {
                    // show delete animation & then reload page
                    $(`tr[data-id="${id}"]`).addClass('delete');
                    setTimeout(() => window.location.reload(), 2000);
                }   
                else {
                    alert('Failed to delete');
                }
            },
        });
    },
};