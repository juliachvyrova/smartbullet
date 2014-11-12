$(document).ready(function(){
    $('#output').animate({'scrollTop':999});
    lol = $('#output').scrollTop();
    setInterval(polling, 3000);
    
    $('input[type="submit"]').on('click',function(){
         $('#output').animate({'scrollTop':999});
    });
    
    $('.solut').on('click',function(){
        $.ajax({
            url: 'php/engine.php',
            type: "post",
            dataType: "json",
            data: {
                "value" : this.value ,
                "select": $('#direction option:selected').html()
            },
            success: function(data){
                $('#field').html(data.result);
            }
        });
        $('#choise').slideToggle(1500);
        setTimeout($('#choise').slideToggle(1500), 1000) ;
    });
});

function polling(){
    $.ajax({
            type: "post",
            dataType: "json",
            data: {
                "msg" : '',
                'polling': 0
            },
            success: function(data){
             $('#output').html(data.result) ;
             if ($('#output').scrollTop() === lol)//scroll down if we in bottom of chat
                 $('#output').animate({'scrollTop':999});
            }
        });
}
