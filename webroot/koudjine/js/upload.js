function afterSuccess()
{
    $('#submit-btn').show(); //hide submit button
    $('#loading-img').hide(); //hide submit button
    //$('#rubrique').selectpicker('refresh');
    var link = '/Site/bouwou/medias';
    window.location.href=link;
    //670489673 yda

}

//function to check file size before uploading.
function beforeSubmit(){
    //check whether browser fully supports all File API
    if (window.File && window.FileReader && window.FileList && window.Blob)
    {


        if( !$('#imageInput').val()) //check empty input filed
        {
            $("#output").html("Veuillez sélectionner une image !");
            $('.alert').removeClass('hidden');
            return false
        }
        var rubrique =  $('#rubrique option:selected').val();
        //alert(rubrique);
        if(rubrique == ''){
            $("#output").html("Veuillez sélectionner une rubrique !");
            $('.alert').removeClass('hidden');
            return false
        }

        var fsize = $('#imageInput')[0].files[0].size; //get file size
        var ftype = $('#imageInput')[0].files[0].type; // get file type




        //allow only valid image file types
        switch(ftype)
        {
            case 'image/png': case 'image/gif': case 'image/jpeg': case 'image/jpg':
            break;
            default:
                $("#output").html("<b>"+ftype+"</b> Unsupported file type!");
                $('.alert').removeClass('hidden');
                return false
        }

        //Allowed file size is less than 2 MB (1048576*2)
        if(fsize>(1048576*2))
        {
            $("#output").html("<b>"+bytesToSize(fsize) +"</b> Too big Image file! <br />Please reduce the size of your photo using an image editor.");
            $('.alert').removeClass('hidden');
            return false
        }

        $('#submit-btn').hide(); //hide submit button
        $('#loading-img').show(); //hide submit button
        $("#output").html("");
        $('.alert').removeClass('hidden');
    }
    else
    {
        //Output error to older browsers that do not support HTML5 File API
        $("#output").html("Please upgrade your browser, because your current browser lacks some new features we need!");
        $('.alert').removeClass('hidden');
        return false;
    }
}

//function to format bites bit.ly/19yoIPO
function bytesToSize(bytes) {
    var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
    if (bytes == 0) return '0 Bytes';
    var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
    return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
}