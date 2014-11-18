$(document).ready(function(){
    flag = false; //flag of user choise
    MaxTime = $("#my_timer").html();
    startTimer();
    $('#output').animate({'scrollTop':999});
    bot = $('#output').scrollTop();
    setInterval(polling, 3000);
    
    $('input[type="submit"]').on('click',function(){
         $('#output').animate({'scrollTop':999});
    });
    
    $('.solut').on('click',function(){
        flag = true;
        $('#choise').slideToggle(1500);
        user_choise(des(this.value));
        
    });
    
    $('#send').on('click',function(){
        send();
        $('#msg').val('');
        $('#output').animate({'scrollTop':999});
    });
});

    

function user_choise(val)
{
    $.ajax({
            url: 'index.php?r=game/fight&id=' +  $('#game_id').val(),
            type: "post",
            dataType: "json",
            data: {
                "value" : val,
                "select": des($('#direction option:selected').html())
                //"tern": $('#tern').val()
            },
            success: function(data){
                $('#field').html('');
                $.each(data,function (){
                        $('#field').append('user: ' + this.user+ ' ' + 'action: '+ 
                                this.action +' ' + 'tern: '+ this.tern + '<br>');
                });    
            }     
        });
}

function send(){
    $.ajax({
            url: 'index.php?r=game/polling&id=' + $('#game_id').val(),
            type: "post",
            dataType: "json",
            data: {
                "msg" : $('#msg').val()
            },
            success: function(data){
                $('#output').html('');
                $.each(data,function(){
                    $('#output').append('<span class="user_name">'+ this.user +
                            '</span>:' + this.text + '<br>');
                });    
        }
    });
}
function polling(){
    $.ajax({
            url: 'index.php?r=game/polling&id=' + $('#game_id').val(),
            type: "post",
            dataType: "json",
            data: {
                "msg" : ''
            },
            success: function(data){
             $('#output').html('');
                $.each(data,function(){
                    $('#output').append('<span class="user_name">'+ this.user +
                            '</span>:' + this.text + '<br>');
                });
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
          if(flag == true)
              flag = false;
          else {
             // user_choise(0);
          }
          return;
    }
    my_timer--;
    $("#my_timer").html(my_timer);
    setTimeout(startTimer, 1000);
  }
