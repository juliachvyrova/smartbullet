var position1='down';
var position2='up';
var showSmile='no';

function writeSmile(cod,textId){
    $(textId).val($(textId).val()+" "+cod+" ");
    $(textId).focus();   
}

    
$(document).ready(function()
{
    $("#left-menu").height($("#content").height());
    $("#openWall").css('background-image',' url("../images/arr2.jpg")');


    //просмотр информации о пользователе
    $("#openInf").on("click", function() 
    {
        if (position1=='down') {
            $("#openInf").css('background-image',' url("../images/arr2.jpg")');
            position1='up';
            $("#user-info").css('display',' block');
        } else {
            $("#openInf").css('background-image',' url("../images/arr1.jpg")');
            position1='down';
            $("#user-info").css('display',' none');
        }
        $("#left-menu").height($("#content").height());
    });


    //просмотр стены пользователя
    $("#openWall").on("click", function() 
    {
        if (position2=='down') {
            $("#openWall").css('background-image',' url("../images/arr2.jpg")');
            position2='up';
            $("#user-wall").css('display',' block');
        } else {
            $("#openWall").css('background-image',' url("../images/arr1.jpg")');
            position2='down';
            $("#user-wall").css('display',' none');
        }
        $("#left-menu").height($("#content").height());
    });
        
    
    //нажатие на кнопку "добавить в друзья"    
    $(document.body).on("click",".addFriend",function(event)
    {
        var friend=$(this).data("userid");
        var url=$(this).data("url1");
        var url2=$(this).data("url2");
        $.ajax({
            url: url,
            type: "POST",
            data: "newFriend="+friend,
            success: function(content) {
                $(".sheep").load(url2+" .sheep");
                if ($("#addFriend"+friend).data("friend")=="yes"){ 
                    url=url.replace('add','del');
                    $("#btn"+friend).html('<input type="button" id=delFriend'+friend+' class="delFriend" data-friend="yes" data-userid='+friend+' data-url1='+url+'  value="Удалить из друзей"></input>');
                } else if ($("#addFriend"+friend).data("friend")=="no") {
                    url=url.replace('add','stopFolow');
                    $("#btn"+friend).html('<input type="button" id=stopFolow'+friend+' class="stopFolow" data-friend="no" data-userid='+friend+' data-url1='+url+' value="Отписаться"></input>');
                }
                return;
            }
        });
    });


    //нажатие на кнопку "отписаться"   
    $(document.body).on("click",".stopFolow",function(event)
    {
        var friend=$(this).data("userid");
        var url=$(this).data("url1");
        var url2=$(this).data("url2");
        $.ajax({
            url:url,
            type: "POST",
            data: "friend="+friend,
            success: function(content) {
                $(".sheep").load(url2+" .sheep");
                if ($("#stopFolow"+friend).data("friend")=="no") {  
                    url=url.replace('stopFolow','add');        
                    $("#btn"+friend).html('<input type="button" class="addFriend" id=addFriend'+friend+' data-friend="no" data-userid='+friend+' data-url1='+url+'  value="Добавить в друзья"></input>');
                }
                return;
            }
        });
    });


    //нажатие на кнопку "удалить из друзей"   
    $(document.body).on("click",".delFriend",function(event)
    {
        var friend=$(this).data("userid");
        var url=$(this).data("url1");
        var url2=$(this).data("url2");
        $.ajax({
            url: url,
            type: "POST",
            data: "friend="+friend,
            success: function(content) {
                $(".sheep").load(url2+" .sheep");
                if ($("#delFriend"+friend).data("friend")=="yes") {
                    url=url.replace('del','add');    
                    $("#btn"+friend).html('<input type="button" class="addFriend" id=addFriend'+friend+' data-friend="yes" data-userid='+friend+' data-url1='+url+' value="Добавить в друзья"></input>');
                }
                return;
            }
        });
    });


    //нажатие на кнопку "оставить в подписчиках"   
    $(document.body).on("click",".seeFolow",function(event)
    {
        var friend=$(this).data("userid");
        var url=$(this).data("url1");
        $.ajax({
            url: url,
            type: "POST",
            data: "friend="+friend,
            success: function(content) {
                $("#Folow"+friend).hide();
                return;
            }
        });
    });


    //добавление поста на стену
    $(document.body).on("click","#add-post",function(event) 
    {
        var wall=$(this).data("wall");
        var url=$(this).data("url1");
        var url2=$(this).data("url2");
        var text1=document.getElementById('n-post').value;
        if (text1.length==0) {
            return;
        }
        $.ajax({
            url: url,
            type: "POST",
            data: "wall="+wall+"&text1="+text1,
            success: function(content) {
                $("#wall").load(url2+" #wall");           
                document.getElementById('n-post').value="";
                return;
            }
        });
        setTimeout('$("#left-menu").height($("#content").height())', 500);
    });


    //добавление комментария к посту
    $(document.body).on("click","#add-com",function(event)
    {
        var post=$(this).data("post");
        var url=$(this).data("url1");
        var url2=$(this).data("url2");
        var text1=document.getElementById('comm'+post).value;
        if(text1.length==0) {
            return;
        }
        $.ajax({
            url: url,
            type: "POST",
            data: "text1="+text1+"&wall="+post,
            success: function(content) {
                $("#post"+post).load(url2+" #AllComm"+post);
                return;
            }
        });
        setTimeout('$("#left-menu").height($("#content").height())', 500);
    });



    //удаление поста со стены
    $(document.body).on("click",".delPost",function(event)
    {
        var post=$(this).data("post");
        var url=$(this).data("url1");
        var url2=$(this).data("url2");
        $.ajax({
            url:  url,
            type: "POST",
            data: "num="+post,
            success: function(content) {
                $("#wall").load(url2+" #wall");        
                return;
            }
        });
        setTimeout('$("#left-menu").height($("#content").height())', 500);
        setTimeout('$("#left-menu").height($("#content").height())', 500);
    });


    //удаление комментария
    $(document.body).on("click",".delComm",function(event)
    {
        var post=$(this).data("post");
        var url=$(this).data("url1");
        var url2=$(this).data("url2");
        var com=$(this).data("com");
        $.ajax({
            url:  url,
            type: "POST",
            data: "comment="+com,
            success: function(content) {
                $("#post"+post).load(url2+" #AllComm"+post);               
                return;
            }
        });
        setTimeout('$("#left-menu").height($("#content").height())', 500);
    });


    //просмотр нового сообщения
    $(document.body).on("click",".newMess",function(event)
    {
        var id=$(this).data("id");
        var url=$(this).data("url1");
        if (id==null) {
            return;
        }
        $.ajax({
            url:  url,
            type: "POST",
            data: "message="+id,
            success: function(content){
                return;
            }
        });
    })


    //отправление нового сообщения
    $(document.body).on("click","#add-message",function(event)
    {
        var id=$(this).data("id");
        var url=$(this).data("url1");
        var text1=document.getElementById('text').value;
        if(text1.length==0) {
            return;
        }
        $.ajax({
            url: url,
            type: "POST",
            data: "user="+id+"&text="+text1,
            success: function(content){
                $(".post").html(content);
                return;
            }
        });
        setTimeout('$("#left-menu").height($("#content").height())', 500);
    })


    //удаление сообщения
    $(document.body).on("click",".delMess",function(event)
    {
        var id=$(this).data("message");
        var url=$(this).data("url1");
        $.ajax({
            url: url,
            type: "POST",
            data: "message="+id,
            success: function(content){
                $("#mess"+id).html(content);
                return;
            }
        });
        setTimeout('$("#left-menu").height($("#content").height())', 500); 
    })



    $(document.body).on("click",'a',function(event){
        setTimeout('$("#left-menu").height($("#content").height())', 500);
    })
    
    $(document.body).on("click",'.addSmile',function(event){
        var idList="#"+$(this).data("id_list");
        if (showSmile=="no") {
            $(idList).css('display',' block');
            showSmile="yes";
        } else {
            $(idList).css('display',' none');
            showSmile="no";
        }
    })
    
    
    
    
    //удаление комментария
    $(document.body).on("click",".delInvite",function(event)
    {
        var id=$(this).data("id1");
        var url=$(this).data("url1");
        /*var url2=$(this).data("url2");
        var com=$(this).data("com");*/

        $.ajax({
            url:  url,
            type: "POST",
            data: "id="+id,
            success: function(content) {     
                $("#invite"+id).html(content);
                return;
            }
        });
        setTimeout('$("#left-menu").height($("#content").height())', 500);
    });
    
    
    
     //удаление комментария
    $(document.body).on("click","#inviteGame",function(event)
    {
        var id=$(this).data("id1");
        var url=$(this).data("url1");
        var url2=$(this).data("url2");/*
        var com=$(this).data("com");
*/
        $.ajax({
            url:  url,
            type: "POST",
            data: "id="+id,
            success: function(content) {     
               /* $("#invite"+id).html(content);
                return;*/
                //setTimeout(function (){},10000);
                //alert(url2+"/"+content);
                location.href=url2+"/"+content;
               // alert(content);
            }
        });
    });
    
    

});