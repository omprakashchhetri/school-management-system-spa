jQuery(document).ready(function(){
    const baseUrl = jQuery('#globalBaseUrl').val();
    //Sort Roles In List Page
    jQuery(document).off('change', '#sortRoles').on('change', '#sortRoles', function(){
        let sortOption = jQuery(this).val();
        if (sortOption !== "") {
            let url = window.location.origin + window.location.pathname;
            window.location.href = url + "?sortOption=" + encodeURIComponent(sortOption);
        }
    });
    
    jQuery(document).off('click', '.delete-role-btn').on('click', '.delete-role-btn', function(){
        let roleId = jQuery(this).attr('data-id');
        if(confirm("Do you want to delete this role?")) {
            jQuery.ajax({
                url: baseUrl + "post-login-employee/admin/delete-role",
                type: "POST",
                data: {
                    id: roleId,
                },
                success:function(res){
                    res = JSON.parse(res);
                    alert(res.message);
                    window.location.reload();
                }
            });
        }
    });

    jQuery(document).off('click', '#saveRoleDetails').on('click', '#saveRoleDetails', function(){
        let data = {};
        data['id'] = jQuery('#roleId').val();
        data['roleName'] = jQuery('#roleName').val();
        data['toolPermission'] = {};
    
        jQuery('.tool-item').each(function(){
            let toolId = jQuery(this).attr('data-tool-permission-id');
    
            // Initialize object for this tool
            data['toolPermission'][toolId] = {};
    
            jQuery(this).find('.tool-item-permission').each(function(){
                let permissionType = jQuery(this).attr('data-permission');
                let permission = jQuery(this).is(':checked') ? 1 : 0; // checkbox state
                data['toolPermission'][toolId][permissionType] = permission;
            });
        });
    
        jQuery('.preloader').show();
        jQuery.ajax({
            url: baseUrl + "post-login-employee/admin/edit-role",
            type: "POST",
            data: {
                data: data,
            },
            success:function(res) {
                res = JSON.parse(res);
                alert(res.message);
                window.location.reload();
            },
            complete:function() {
                jQuery('.preloader').hide();
            }
        });
    });
    

    jQuery(document).off('click', '#saveNewRoleBtn').on('click', '#saveNewRoleBtn', function(){
        jQuery('#newRoleName').removeClass('border-danger');
        let newRoleName = jQuery('#newRoleName').val();
        if(newRoleName == "") {
            jQuery('#newRoleName').parent().append('<span class="text-danger">Enter a value for this field!</span>');
            jQuery('#newRoleName').addClass('border-danger');
            return;
        }
        jQuery('.preloader').show();
        jQuery.ajax({
            url: baseUrl + "post-login-employee/admin/add-role",
            type: "POST",
            data: {
                role_name: newRoleName,
            },
            success:function(res) {
                res = JSON.parse(res);
                alert(res.message);
                window.location.reload();
            },
            complete:function() {
                jQuery('.preloader').hide();
            }
        });
    });
});