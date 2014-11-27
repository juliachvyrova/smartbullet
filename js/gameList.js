
$(document).ready(function(){
    $('#create').on('click',function(){
        $.ajax({
            url: $('#baseUrl').val() + '/game/createGame',
            type: "post",
            dataType: "json",
            success: function(data){
                document.location.href += '/' + data['id'];
            }
        });
    });
});