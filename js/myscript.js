$(document).ready(function(){
    //disable user control while dont get map
    $.each( $('.solut') , function(){
            this.disabled = true;
    });
    
    wariors = [];
    giveMap();
    /*for(i = 0; i < 6; i++)
    {
        $wariors[i]= new Warior();
    }*/
    
    flag = false; //flag of user choise
    MaxTime = $("#my_timer").html();

    $('#output').animate({'scrollTop': 99999999});
    setInterval(chatPolling, 3000);
    
    $('.solut').on('click',function(){
        flag = true;
        $.each( $('.solut') , function(){
            this.disabled = true;
        });
        $('#choise').slideToggle(1500);
        user_choise(des(this.value));
        
    });
    
    $('#send').on('click',function(){
        send();
        $('#msg').val('');
        $('#output').animate({'scrollTop': 999999});
    });
});

function giveMap()
{
    $('#field').html('<h1>waiting for players...</h1>');
    $.ajax({
            url: 'index.php?r=game/giveMap&id=' +  $('#game_id').val(),
            type: "post",
            dataType: "json",
            success: function(data){
                if(data.count)
                {
                    $('#field').html('<h1>waiting for players...'+ (6 - data.count) +'</h1>');
                    setTimeout(giveMap,2000);
                }
                else
                {
                    makeField();
                    for(i = 1; i < 7; i++){
                         wariors[i]= new Warior(data[i]);
                         $('#w'+i + ' b').html(data['l'+i]);
                    }
                    
                    $.each( $('.solut') , function(){
                        this.disabled = false;
                    });
                    startTimer();
                }
            }     
        });
}

function makeWarior(selector,id)
{
    $(selector).append('<div class="warior" id="w' + id + 
            '"><b class="user-login"></b><div class="hp-bar"><div class="hp">  </div></div>\n\
            <div class="war-img"></div></div>');
}

function makeField()
{
    $('#field').html('<div id="left-team"></div><div id="right-team"></div>');
    for (i = 1; i < 7; i++)
    {
        if(i < 4) id = '#left-team';
        else id = '#right-team';
        
        makeWarior(id,i);
    }
}

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
            success: function(){
                gamePolling();
            }     
        });
}

function send(){
    $.ajax({
            url: 'index.php?r=game/chatPolling&id=' + $('#game_id').val(),
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
function chatPolling(){
    $.ajax({
            url: 'index.php?r=game/chatPolling&id=' + $('#game_id').val(),
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

function gamePolling(){
    $.ajax({
            url: 'index.php?r=game/gamePolling&id=' + $('#game_id').val(),
            type: "post",
            dataType: "json",
            success: function(data){
                if(data.result){
                    setTimeout(gamePolling(),5000);
                }else{
                    //play(data);
                    $('#choise').slideDown(1000);
                    $("#my_timer").html(MaxTime);
                    setTimeout(startTimer, 1000);
                }
            }
        });
}


function des(data){
    switch(data){
        case 'Left':
            return 1;
        case 'Back':
            return 2;
        case 'Right':
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
        $.each( $('.solut') , function(){
            this.disabled = false;
        });
        //$('#choise').slideDown(1000);
        //$("#my_timer").html(MaxTime);
        //setTimeout(startTimer, 1000);
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
 
function Warior(id){
    this.name = '';
    this.id = id ;
    this.hp = 100;
    this.dead = false;
}
window.onbeforeunload = function(){
    $.ajax({
            url: 'index.php?r=game/gamerExit&id=' + $('#game_id').val(),
            type: "post",
            dataType: "json",
        });
};