$(document).ready(function(){
    MaxTime = $("#my_timer").html();
    startTimer();
    $('#output').animate({'scrollTop':999});
    lol = $('#output').scrollTop();
    setInterval(polling, 3000);
    $('input[type="submit"]').on('click',function(){
         $('#output').animate({'scrollTop':999});
    });
    $('.solut').on('click',function(){
        $('#choise').slideToggle(1500);
        $.ajax({
            url: 'index.php?r=game/fight&id=0',
            type: "post",
            dataType: "json",
            data: {
                "value" : des(this.value),
                "select": des($('#direction option:selected').html()),
                "tern": $('#tern').val()
            },
            success: function(data){
                $('#field').html(' ');
                $.each(data,function (){
                    if(this.tern == $("#tern").val() ){
                        $('#field').append(this.action + ' ');
                    }
                });    
            }     
        });
    });
});


function polling(){
    $.ajax({
            url: 'index.php?r=game/polling&id=' + $('#game_id').val(),
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


function des(data){
    switch(data){
        case 'Left':
            return 1;
        case 'Right':
            return 2;
        case 'Back':
            return 3;
        case 'Attack':
            return 1;
        case 'Dodge':
            return 2;
        case 'Special':
            return 3;
    }
}


function startTimer() {
    var my_timer = $("#my_timer").html();
    if (my_timer == 0) {
          $('#choise').slideDown(1000);
          $("#my_timer").html(MaxTime);
          setTimeout(startTimer, 1000);
          $("#tern").val(parseInt($("#tern").val())+1);
          return;
    }
    my_timer--;
    $("#my_timer").html(my_timer);
    setTimeout(startTimer, 1000);
  }
