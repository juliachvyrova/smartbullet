position1='down';
position2='up';

    /*function setEqualHeight(columns)  
    {  
    var tallestcolumn = 0;  
    columns.each(  
    function()  
    {  
    currentHeight = $(this).height();  
    if(currentHeight > tallestcolumn)  
    {  
    tallestcolumn  = currentHeight;  
    }  
    }  
    );  
    columns.height(tallestcolumn);  
    }*/
    
    $(document).ready(function(){
      //  setEqualHeight($('#left-menu, #content'));
      $("#left-menu").height($("#content").height());
      $("#openWall").css('background-image',' url("./images/arr2.jpg")');


        $("#openInf").on("click", function() {
            if (position1=='down'){
            $("#openInf").css('background-image',' url("./images/arr2.jpg")');
            position1='up';
            $("#user-info").css('display',' block');
        }
        else{
            $("#openInf").css('background-image',' url("./images/arr1.jpg")');
            position1='down';
            $("#user-info").css('display',' none');
        }
            //alert("ok");
                  $("#left-menu").height($("#content").height());

        });


        $("#openWall").on("click", function() {
            if (position2=='down'){
            $("#openWall").css('background-image',' url("./images/arr2.jpg")');
            position2='up';
            $("#user-wall").css('display',' block');
        }
        else{
            $("#openWall").css('background-image',' url("./images/arr1.jpg")');
            position2='down';
            $("#user-wall").css('display',' none');
        }
            //alert("ok");
                  $("#left-menu").height($("#content").height());

        });
        
        
        $(document.body).on("click",".addFriend",function(event){
            friend=$(this).data("userid");
            url=$("#invisible").html();//$(this).data("AddUrl");//$("#invisible").html();
            url2=$("#invisible2").html();
            $.ajax({
                url: "/smartbullet/index.php?r=relationship/add",//url,
                type: "POST",
                data: "newFriend="+friend,
                success: function(content){
                    $(".sheep").load("/smartbullet/index.php/?r=user/view&id="+friend+" .sheep");
                    if ($(".addFriend").data("friend")=="yes"){ alert('yesss');
                        $("#btn"+friend).html('<input type="button" class="delFriend" data-friend="yes" data-userid='+friend+' data-url1=/smartbullet/index.php?r=relationship/del  value="Удалить из друзей"></input>');
                    }
                    return;
                }
            });
            
            event.preventDefault();
        });


        $(document.body).on("click",".stopFolow",function(event){
            
            friend=$(this).data("userid");
            $.ajax({
                url: "/smartbullet/index.php/?r=relationship/stopFolow",//url,
                type: "POST",
                data: "friend="+friend,
                success: function(content){
                    $(".sheep").load("/smartbullet/index.php/?r=user/view&id="+friend+" .sheep");
                    return;
                }
            });
            
            event.preventDefault();
        });

        $(document.body).on("click",".delFriend",function(event){
            friend=$(this).data("userid");
            url=$(this).data("url1");
            $.ajax({
                url: "/smartbullet/index.php?r=relationship/del",//url,//
                type: "POST",
                data: "friend="+friend,
                success: function(content){
                    $(".sheep").load("/smartbullet/index.php/?r=user/view&id="+friend+" .sheep");
                    if ($(".delFriend").data("friend")=="yes"){
                        $("#btn"+friend).html('<input type="button" class="addFriend" data-friend="yes" data-userid='+friend+' data-url1=/smartbullet/index.php?r=relationship/add  value="Добавить в друзья"></input>');
                    }
                        
                    return;
                }
            });
            
            event.preventDefault();
        });


        $(document.body).on("click","#add-post",function(event){
            wall=$(this).data("wall");
            url=$(this).data("AddUrl");
            text1=document.getElementById('n-post').value;
            if(text1.length==0) return;
            $.ajax({
                url: "/smartbullet/index.php?r=post/add",// url,//
                type: "POST",
                data: "wall="+wall+"&text1="+text1,//array('wall'=>wall, 'text'=>text),//
                success: function(content){
                    $("#user-wall").load("/smartbullet/index.php/?r=user/view&id="+wall+" #user-wall");           

                    return;
                }
            });
            $("#left-menu").height($("#content").height());
           //$("#left-menu").load( "/smartbullet/index.php/?r=user/view&id="+wall+" #left-menu");
            event.preventDefault();
        });


            $(document.body).on("click","#add-com",function(event){
            p=$(this).data("post");
            //alert(p);
            url=$(this).data("AddUrl");
            wall=$(this).data("wall");
            //alert(wall);
            text1=document.getElementById('comm'+p).value;
            if(text1.length==0) return;
            $.ajax({
                url: "/smartbullet/index.php?r=comment/add",// url,//
                type: "POST",
                data: "text1="+text1+"&wall="+p,
                success: function(content){                   // alert(content);
                    $("#post"+p).load("/smartbullet/index.php/?r=user/view&id="+wall+" #post"+p);           

                    return;
                }
            });
            $("#left-menu").height($("#content").height());
            event.preventDefault();
        });




            $(document.body).on("click",".delPost",function(event){
            p=$(this).data("post");
            //alert(p);
            url=$(this).data("DelUrl");
            wall=$(this).data("wall");
            //alert(wall);
           // text1=document.getElementById('comm'+p).value;
            //if(text1.length==0) return;
            $.ajax({
                url: "/smartbullet/index.php?r=post/del",// url,//
                type: "POST",
                data: "num="+p,
                success: function(content){
                   // alert(content);
                   $("#user-wall").load("/smartbullet/index.php/?r=user/view&id="+wall+" #user-wall");        

                    return;
                }
            });
            $("#left-menu").height($("#content").height());
            event.preventDefault();
        });



            $(document.body).on("click",".delComm",function(event){
            p=$(this).data("post");
            //alert(p);
            url=$(this).data("DelUrl");
            wall=$(this).data("wall");
            com=$(this).data("com");
            //alert(wall);
           // text1=document.getElementById('comm'+p).value;
            //if(text1.length==0) return;
            $.ajax({
                url: "/smartbullet/index.php?r=comment/del",// url,//
                type: "POST",
                data: "comment="+com,
                success: function(content){
                    alert(content);
                    $("#post"+p).load("/smartbullet/index.php/?r=user/view&id="+wall+" #post"+p);               

                    return;
                }
            });
            $("#left-menu").height($("#content").height());
            event.preventDefault();
        });










    });