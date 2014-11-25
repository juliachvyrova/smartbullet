    DAMAGE = 20;
    wariors = [];
$(document).ready(function(){
    $('#aim').hide();
    $('#miss').hide();
    //disable user control while dont get map
    $.each( $('.solut') , function(){
            this.disabled = true;
    });

    giveMap();
    /*for(i = 0; i < 6; i++)
    {
        $wariors[i]= new Warior();
    }*/
    
    flag = false; //flag of user choise
    MaxTime = $("#my_timer").html();

    $('#output').animate({'scrollTop': 99999999});
    //setInterval(chatPolling, 3000);
    
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
                         wariors[i-1]= new Warior(data[i]);
                         $('#w'+i + ' b').html(data['l'+(i)]);
                    }
                    
                    $.each( $('.solut') , function(){
                        this.disabled = false;
                    });
                    //console.log(data);
                    startTimer();
                }
            }     
        });
}

function makeWarior(selector,id)
{
    $(selector).append('<div class="warior" id="w' + id + 
            '"><b class="user-login"></b><div class="hp-bar"><div class="hp2"><div class="hp">  </div></div></div>\n\
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
                    setTimeout(gamePolling,3000);
                }else{
                    var i = 0;
                    $.each(data,function(){
                        var self = this;
                        setTimeout(function(){
                           i = play(self,i);
                        },1000);
                    });
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
        case 'Heal':
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

                        
function play(data,time)
{
    setTimeout(function(){
        //console.log(data);
            for(i = 0; i < 6; i++)
            {
                if(data.user == wariors[i].id)
                {
                    if(data.action == 1) {
                        if(data.result == 1)
                        {
                            if( i < 3)
                            {
                                hit(2 + parseInt(data.direction),i);
                            }else{
                                hit(parseInt(data.direction) -1,i);
                            }
                        }else{
                            if( i < 3)
                            {
                                miss(2 + parseInt(data.direction),i);
                            }else{
                                miss(parseInt(data.direction) -1,i);
                            }
                        }
                    }
                    if(data.action == 3){
                        if( i > 2)
                            {
                                heal(2 + parseInt(data.direction));
                            }else{
                                heal(parseInt(data.direction)-1);
                            }
                    }
                }
            }
        },time*2500);
        console.log('deley: ' + time);
        return time+1;
}

function hit(place,i)
{
   // console.log(place +' <= '+i);
    var offset = $('#w'+(i+1)).offset();
   // console.log(offset);
   // console.log(offset);
    $('#aim').css('left', offset.left + 50);
    $('#aim').css('top', offset.top + 50);
    $('#aim').show(800);
    offset = $('#w'+(place+1)).offset();
    //console.log(offset);
    $('#aim').animate({left: offset.left + 100  , top: offset.top + 50 },500,function(){
        wariors[place].hp -= 20;
        if (wariors[place].hp < 0) wariors[place].hp = 0;
        $('#w' + (place +1) +' .hp').animate({width: wariors[place].hp +'%'},'slow');
    });
   // console.log(place + '  place');
    $('#aim').hide(800);
}

function heal(place)
{
    wariors[place].hp += 20;
    if (wariors[place].hp > 100) wariors[place].hp = 100;
    $('#w' + (place +1) +' .hp').css('background-color','green');
    $('#w' + (place +1) +' .hp').animate({width: wariors[place].hp +'%'},'slow',function(){
       $('#w' + (place +1) +' .hp').css('background-color','red'); 
    });
    
}

function miss(place,i)
{
    var offset = $('#w'+(i+1)).offset();
    $('#aim').css('left', offset.left + 50);
    $('#aim').css('top', offset.top + 50);
    $('#aim').show(800);
    offset = $('#w'+(place+1)).offset();
    //console.log(offset);
    $('#aim').animate({left: offset.left + 100  , top: offset.top + 50 },500,function(){
        $('#miss').css('left', offset.left + 150);
        $('#miss').css('top', offset.top + 70);
        $('#miss').show(1000);
        $('#miss').animate({top: '-=40'},'slow');
        $('#miss').hide(1000);
    });
    $('#aim').hide(800);
}
