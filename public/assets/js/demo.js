$(document).ready(function(){
    $('body').on('click','#btn-update',function(){
        var id = $(this).attr('update_id');
        var position = $(this).parents('tr').find('td').eq(1).text();

        $('#update_id').val(id);
        $('#update_name').val(position);
    })
})
