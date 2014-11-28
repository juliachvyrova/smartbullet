    DAMAGE = 20;
    wariors = [];
    freez = false;
$(document).ready(function(){
    $('#aim').hide();
    $('#miss').hide();
    $('#win').hide();
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
       // $(this).data('url')
        send();
        $('#msg').val('');
        $('#output').animate({'scrollTop': 999999});
    });
});

function giveMap()
{
    $('#field').html('<h1>waiting for players...</h1>');
    $.ajax({
            url: $('#baseUrl').val() + '/game/giveMap/' +  $('#game_id').val(),
            //url: '/game/giveMap/' +  $('#game_id').val(),
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
                    giveStats();
                    //console.log(data);
                    startTimer();
                }
            }     
        });
}

function giveStats()
{
    $.ajax({
            url: $('#baseUrl').val() +'/game/giveStats/' +  $('#game_id').val(),
            type: "post",
            dataType: "json",
            success: function(data){
                for(i = 1; i < 7 ; i++)
                {
                    wariors[i-1].hp= data[i];
                    $('#w' + i +' .hp').animate({width: wariors[i-1].hp +'%'},'slow');
                }
                console.log(wariors);
                God();
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
    freez = true;
    $.ajax({
            url: $('#baseUrl').val() +'/game/fight/' +  $('#game_id').val(),
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
            url: $('#baseUrl').val() +'/game/chatPolling/' + $('#game_id').val(),
            type: "post",
            dataType: "json",
            data: {
                "msg" : $('#msg').val()
            },
            success: function(data){
                $('#output').html('');
                $.each(data,function(){
                    $('#output').append('<span class="user_name">'+ this.user +
                            '</span>:' + escapeHtml(this.text) + '<br>');
                });    
        }
    });
}

function chatPolling(){
    $.ajax({
            url: $('#baseUrl').val() +'/game/chatPolling/' + $('#game_id').val(),
            type: "post",
            dataType: "json",
            data: {
                "msg" : ''
            },
            success: function(data){
             $('#output').html('');
                $.each(data,function(){
                    $('#output').append('<span class="user_name">'+ this.user +
                            '</span>:' + escapeHtml(this.text) + '<br>');
                });
            }
        });
}

function gamePolling(){
    $.ajax({
            url: $('#baseUrl').val() +'/game/gamePolling/' + $('#game_id').val(),
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
                    console.log(data);
                    $.each( $('.solut') , function(){
                        this.disabled = false;
                    });
                    $('#choise').slideDown(1000);
                    $("#my_timer").html(MaxTime);
                    freez = false;
                    //setTimeout(startTimer, 6000);
                }
            }
        });
}


function des(data){
    switch(data){
        case 'Top':
            return 1;
        case 'Center':
            return 2;
        case 'Bottom':
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
    if(freez == false){
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
                $.each( $('.solut') , function(){
                    this.disabled = true;
                });
                $('#choise').slideToggle(1500);
                user_choise(0);
            }
            return;
        }
        my_timer--;
        $("#my_timer").html(my_timer);
    }
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
    var plus = 1;
    setTimeout(function(){
            for(i = 0; i < 6; i++)
            {
                if(wariors[i].dead == false){
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
                } else plus = 0;
            }
        },time*2500);
        //console.log(wariors);
        return time + plus;
}

function hit(place,i)
{
    wariors[place].hp -= 20;
    if (wariors[place].hp < 1)
    {
        wariors[place].hp = 0;
        wariors[place].death = true;
    }
    God();
    var offset = $('#w'+(i+1)).offset();
    $('#aim').css('left', offset.left + 50);
    $('#aim').css('top', offset.top + 50);
    $('#aim').show(800);
    offset = $('#w'+(place+1)).offset();
    $('#aim').animate({left: offset.left + 100  , top: offset.top + 50 },500,function(){   
        $('#w' + (place +1) +' .hp').animate({width: wariors[place].hp +'%'},'slow');
    });
    $('#aim').hide(500);
}

function heal(place)
{
    if (wariors[place].dead == false)
    {
        wariors[place].hp += 15;
        if (wariors[place].hp > 100) wariors[place].hp = 100;
        $('#w' + (place +1) +' .hp').css('background-color','green');
        $('#w' + (place +1) +' .hp').animate({width: wariors[place].hp +'%'},'slow',function(){
           $('#w' + (place +1) +' .hp').css('background-color','red'); 
        });
    }  
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
        $('#miss').animate({top: '-=40'});
        $('#miss').hide(500);
    });
    $('#aim').hide(800);
}

function escapeHtml(text) {
  var map = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#039;'
  };

  return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}

function God()
{
    console.log('GOD');
    for(i = 0; i < 6; i++)
    {
        if (wariors[i].hp == 0 && wariors[i].dead == false)
        {   
            wariors[i].dead = true;
            $('#w'+(i+1)+' .war-img').hide();
            $('#w'+(i+1)+' .war-img').css('background' ,'url("../images/rip.png") no-repeat center');
            $('#w'+(i+1)+' .war-img').css('background-size' ,'contain');
            $('#w'+(i+1)+' .war-img').show(500);
        }
            
    }
    var offset;
    if(wariors[0].dead == true && wariors[1].dead == true && wariors[2].dead == true)
    {
        //alert('team2 win');
        offset = $('#w6').offset();
        $('#win').css('top',offset.top);
        $('#win').css('left',offset.left);
        offset = $('#w4').offset();
        $('#win').show(300);
        $('#win').animate({left: offset.left, top: offset.top},1000);
        endGame();
        setTimeout(function(){
            document.location.href = $('#baseUrl').val() + '/game';
        },1500);
    }
    if(wariors[3].dead == true && wariors[4].dead == true && wariors[5].dead == true)
    {
        //alert('team1 win');
        offset = $('#w3').offset();
        $('#win').css('top',offset.top);
        $('#win').css('left',offset.left);
        offset = $('#w1').offset();
        $('#win').show(300);
        $('#win').animate({left: offset.left, top: offset.top},1000);
        endGame();
        setTimeout(function(){
            document.location.href = $('#baseUrl').val() + '/game';
        },1500);
    }
    
}

function endGame()
{
    $.ajax({
        url: $('#baseUrl').val() +'/game/endGame/' + $('#game_id').val(),
        type: "post",
        dataType: "json"
    });
}