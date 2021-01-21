

function loadScript(src) {
    return new Promise(function (resolve, reject) {
        var s;
        s = document.createElement('script');
        s.src = src;
        s.onload = resolve;
        s.onerror = reject;
        document.head.appendChild(s);
    });
}

var windowLoc = $(location).attr('pathname');
switch(windowLoc){      
  case "/contact/chat":
    loadScript('../js/chat.js').catch((error) => {
        console.error(error);
      });
    
    break;


  case "/appointment/booking":
    loadScript('../js/calender.js').catch((error) => {
      console.error(error);
    });
    break;

    case "/doctor/messages":
      loadScript('../js/message.js').catch((error) => {
        console.error(error);
      });
    break;
}




//==============doctor appointments=====================================
$(document).ready( function () {
    $('#doctor_table').DataTable();


    $(".toast").toast('show');



} );


