$('table').on('click', 'input[type="button"]', function(e){
   
   
   var spr =$(this)[0].id;
   var spt = spr.split("=+=");
   var client =spt[1]; 
   var title =spt[0];        
                   
    $.ajax({
        url: "/doctor/messages",
        type: "POST",
        data:{delete:true,title:title,client:client},
        dataType: "json",
        traditional: true,
        //contentType: "application/json; charset=utf-8",
        success: function (data) 
        {
        }
    }).done(function (data) {
        console.log(data);
    });
   
   
   
   
    $(this).closest('tr').remove();
 });