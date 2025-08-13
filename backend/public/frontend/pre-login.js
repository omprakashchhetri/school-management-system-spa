jQuery(document).ready(function(){
    var storage = window.localStorage;
    // jQuery(function () {
    //     var token = storage.getItem('authToken');
    
    //     if (token) {
    //         // Redirect to post-login.html if token exists
    //         window.location.href = 'post-login.html';
    //     }
    // });    
    
    var baseUrl = jQuery('#baseUrl').val();

    function getLoginPage() {
        jQuery.ajax({
            url: baseUrl + "login",
            type: "POST",
            success: function(reshtml) {
                jQuery('#app').html(reshtml);
            }
        });
    }

    getLoginPage();
});