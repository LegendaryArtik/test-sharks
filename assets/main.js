jQuery(document).ready(function () {
    jQuery('#form').on('submit', function (e) {
        let fd = new FormData(this);
        e.preventDefault();
        jQuery.ajax({
            url: variables.ajax_url+'/api/cities/new',
            data: fd,
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            type: "POST",
            success: function(){
                document.location.reload();
            }
        })
    });
});