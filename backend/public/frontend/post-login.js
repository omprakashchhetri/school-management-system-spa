jQuery(document).ready(function(){
    var storage = window.localStorage;
    var token = storage.getItem('authToken');
    console.log(token);
})
