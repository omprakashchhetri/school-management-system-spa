jQuery(document).ready(function(){
    const baseUrl = jQuery('#globalBaseUrl').val();
    
    jQuery(document).off('click', '.delete-section-btn').on('click', '.delete-section-btn', function(){
        let sectionId = jQuery(this).attr('data-section-id');
        if(confirm("Do you want to delete this section?")) {
            jQuery.ajax({
                url: baseUrl + "post-login-employee/admin/delete-section",
                type: "POST",
                data: {
                    id: sectionId,
                },
                success:function(res){
                    res = JSON.parse(res);
                    alert(res.message);
                    window.location.reload();
                }
            });
        }
    });
    

    jQuery(document).off('click', '#saveNewSectionBtn').on('click', '#saveNewSectionBtn', function(){
        jQuery('#newSectionLabel').removeClass('border-danger');
        let newSectionLabel = jQuery('#newSectionLabel').val();
        if(newSectionLabel == "") {
            jQuery('#newSectionLabel').parent().append('<span class="text-danger">Enter a value for this field!</span>');
            jQuery('#newSectionLabel').addClass('border-danger');
            return;
        }
        jQuery('.preloader').show();
        jQuery.ajax({
            url: baseUrl + "post-login-employee/admin/add-section",
            type: "POST",
            data: {
                section_label: newSectionLabel,
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

    jQuery(document).off('click', '.editSectionJs').on('click', '.editSectionJs', function(){
        let sectionId = jQuery(this).attr('data-section-id');
        let sectionLabel = jQuery(this).attr('data-section-label');
        jQuery('#editSectionId').val(sectionId);
        jQuery('#editSectionLabel').val(sectionLabel);
        jQuery('#editSectionModal').modal('show');
    });

    jQuery(document).off('click', '#editSectionBtn').on('click', '#editSectionBtn', function(){
        jQuery('#editSectionLabel').removeClass('border-danger');
        let editSectionLabel = jQuery('#editSectionLabel').val();
        let editSectionId = jQuery('#editSectionId').val();
        if(editSectionLabel == "") {
            jQuery('#editSectionLabel').parent().append('<span class="text-danger">Enter a value for this field!</span>');
            jQuery('#editSectionLabel').addClass('border-danger');
            return;
        }
        jQuery('.preloader').show();
        jQuery.ajax({
            url: baseUrl + "post-login-employee/admin/edit-section",
            type: "POST",
            data: {
                id: editSectionId,
                section_label: editSectionLabel,
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