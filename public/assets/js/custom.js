$(document).ready(function(){
    // show modal
    $(document).on('click','button[data-action="show"]',function(){
        var url = $(this).data('url');

        $.ajax({
            url,
            success:function(res){
                $('#showModal .modal-body').html(res);
                $('#showModal').modal('show');
            },
            error:function(res){
                console.error("Error:");
                console.error(res);
            }

        })
    })
    // choose image
    $(document).on('click','#chooseImage',function(){
        $('#image').click();
    });
    $(document).on('change','#image',function(){
        var url = $(this).data('url');

        var formData = new FormData();
        var image = $('#image')[0].files[0];
        console.log(image);

        formData.append('image',image)
        console.log("Name = ",formData.get('image'));

        $.ajaxSetup({
            headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

        $.ajax({
            url,
            caches:false,
            data:formData,
            contentType: false,
            processData: false,
            method:'POST',
            success:function(res){
                $('#preview').html('<img src="' + res + '">');
                //generate file name
                var fileName = res.replace("/temporary/","");
                $('#imageName').val(fileName);
            }
        })
    })
})
