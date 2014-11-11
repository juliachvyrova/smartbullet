$(document).ready(function(){
    $('#output').animate({'scrollTop':999});
    lol = $('#output').scrollTop();
    alert (lol);
    setInterval(polling, 3000);
    
    $('input[type="submit"]').on('click',function(){
         $('#output').animate({'scrollTop':999});
    });
});

function polling(){
   //$('#output').animate({'scrollTop':999});
 //  rol = $('#rol').outerHeight();
  // alert(rol);
  // alert($('#output').height());
    $.ajax({
            type: "post",
            dataType: "json",
            data: {
                "msg" : '',
                'polling': 0
            },
            success: function(data){
             $('#output').html(data.result) ;
             if ($('#output').scrollTop() === lol)
                 $('#output').animate({'scrollTop':999});
           //  $('#output').scrollTop();
            }
        });
}
