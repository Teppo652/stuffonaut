
$("#images").change(function(){
    $("#uploadForm").submit();
});

$('#uploadForm').ajaxForm({
    target:'#imagesPreview',
    beforeSubmit:function(){
        $('.userIconBig').addClass("hidden");
        $('.loadingIcon').removeClass("hidden");






    },
    success:function(){           
        $('#images').val('');
        alert('after img ajax Submit');
        $('#uploadStatus').html('');
        $('.loadingIcon').addClass("hidden");
        $('#deleteProfileImage').removeClass("hidden"); 






                       
    },
    error:function(){
        $('#uploadStatus').html('Images upload failed, please try again.');
    }
});
$('#deleteProfileImage').click( function(e) {
    e.preventDefault();
    //alert('deleteProfileImage clicked');
     $('#imagesPreview').html('');
     $('.userIconBig').removeClass("hidden");
     $('#deleteProfileImage').addClass("hidden");
});