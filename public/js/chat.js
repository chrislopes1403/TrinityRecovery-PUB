        //var conn = new WebSocket('wss://trinity-recovery.herokuapp.com:8085');

        //conn.onopen = function(e) {
       // console.log("Connection established!");
       // loadChatData();
        //};



        $( document ).ready(function() { 
            console.log("calling...");
           // loadChatData();
        });



        var setTarget='';
        var doctor;

        const getChat=async(element)=>
        {

        var chat = document.getElementsByClassName('chat_list');
        var id =element.id;
        var name;

        if(doctor)
            name =  document.getElementById('client_'+id+'').innerHTML;
        else
            name =  document.getElementById('doctor_'+id+'').innerHTML;
        
        setTarget = name;

        for( i = 0; i < chat.length; i++)
        {
            chat[i].classList.remove("active_chat");
        }

        element.classList.add("active_chat");
        
        var chatData= await  getChatDataPHP();
        chatData.pop();
        chatData.pop();
        chatData.sort((a, b) => a.chatId - b.chatId);

        Doctor = document.getElementById('chat_header').innerHTML;
        var IsDoctor;

        if(Doctor=="Clients")
            IsDoctor=false;
        else
            IsDoctor=true;


        msgs="";
        chatData.forEach(msg=>{
            
            if((msg.doctorId==id) || (msg.clientId==id))
            {

                // to/from = 0 Doctor => client to/from = 1 client =>Doctor 
                if(IsDoctor)
                {
                    if(msg['to/from']==0)
                    {
                    msgs+=
                    '<div class="incoming_msg">'+
                    '<div class="incoming_msg_img"> <img src="/img/img11.jpg" alt="sunil"> </div>'+
                    '<div class="received_msg">'+
                        '<div class="received_withd_msg">'+
                        '<p>'+msg.msg+'</p>'+
                        '<span class="time_date"> 11:01 AM    |    June 9</span></div>'+
                    '</div>'+
                    '</div>';
                    }
                    else
                    {
                        msgs+=
                        '<div class="outgoing_msg">'+
                            '<div class="sent_msg">'+
                            '<p>'+msg.msg+'</p>'+
                            '<span class="time_date"> 11:01 AM    |    June 9</span> </div>'+
                        '</div>';
                    }
                }
                else
                {
                    if(msg['to/from']==1)
                    {
                    msgs+=
                    '<div class="incoming_msg">'+
                    '<div class="incoming_msg_img"> <img src="/img/img11.jpg" alt="sunil"> </div>'+
                    '<div class="received_msg">'+
                        '<div class="received_withd_msg">'+
                        '<p>'+msg.msg+'</p>'+
                        '<span class="time_date"> 11:01 AM    |    June 9</span></div>'+
                    '</div>'+
                    '</div>';
                    }
                    else
                    {
                        msgs+=
                        '<div class="outgoing_msg">'+
                            '<div class="sent_msg">'+
                            '<p>'+msg.msg+'</p>'+
                            '<span class="time_date"> 11:01 AM    |    June 9</span> </div>'+
                        '</div>';
                    }
                }
            }

        
        });
        document.getElementById('msg_history').innerHTML="";
        document.getElementById('msg_history').innerHTML+=msgs;
        
        }



        const loadChatData =async() =>
        {
            console.log("load.....");

            var chatData= await  getChatDataPHP();
            
            var id = chatData.pop();


            ws = new WebSocket('wss://trinity-recovery-chat.herokuapp.com:8080/'+id);
        
            ws.onopen = () =>
            {
                console.log('Connection opened!');
            }
            console.log("return");
            /*
            conn.send(JSON.stringify({command: "setup", session: id}));
            doctor = chatData.pop();
            var chatId=0;
            var messages=[];

            chatData.sort((a, b) => a.chatId - b.chatId);
            chat_messages="";
            
            chatData.forEach((msg)=>{

                    if(chatId!=msg.chatId)
                    {
                        if(doctor)
                        {
                        chat_messages+=
                            '<div class="chat_list" id="'+msg.clientId+'"  onclick=getChat(this)>'+
                            '<div class="chat_people" id="'+msg.chatId+'">'+
                            '<div class="chat_img"> <img src="/img/img11.jpg" alt="sunil"> </div>'+
                            '<div class="chat_ib">'+
                                '<h5 id="client_'+msg.clientId+'">'+msg.clientName +'</h5>'+
                                '<span class="chat_date">'+msg.created_on+'</span>'+
                                '<p>'+msg.msg+'</p>'+
                            '</div>'+
                            '</div>'+
                        '</div>';
                        }
                        else
                        {
                            chat_messages+=
                            '<div class="chat_list" id="'+msg.doctorId+'"  onclick=getChat(this)>'+
                            '<div class="chat_people"  id="'+msg.chatId+'">'+
                            '<div class="chat_img"> <img src="/img/img11.jpg" alt="sunil"> </div>'+
                            '<div class="chat_ib">'+
                                '<h5 id="doctor_'+msg.doctorId+'">'+msg.doctorName+'</h5>'+
                                '<span class="chat_date">'+msg.created_on+'</span>'+
                                '<p>'+msg.msg+'</p>'+
                            '</div>'+
                            '</div>'+
                        '</div>';
                        }
                        document.getElementById('inbox_chat').innerHTML+=chat_messages;
                        chat_messages="";
                    }
           
              
                    chatId=msg.chatId;
                });          
                */
        } 
        
        const getChatDataPHP =async() =>
        {
        return  $.ajax({
            url: "/contact/getChats",
            type: "POST",
            //data:{'name': name},
            dataType: "json",
            traditional: true,
            //contentType: "application/json; charset=utf-8",
            success: function (data) 
            {

            }
        }).done(function (data) {
            
        });
        

        } 

        /*
        

        conn.onmessage = function(e) {
        //console.log(e.data);
        var chat = document.getElementsByClassName('active_chat');
        if (chat.length > 0) 
        {
            chatbox="";
            chatbox+=
            '<div class="incoming_msg">'+
            '<div class="incoming_msg_img"> <img src="/img/img11.jpg" alt="sunil"> </div>'+
                '<div class="received_msg">'+
                    '<div class="received_withd_msg">'+
                        '<p>' + e.data + '</p>'+
                        '<span class="time_date"> 11:01 AM    |    June 9</span> </div>'+
                        '</div>'+
                '</div>'+
            '</div>';
                            
                            
        document.getElementById("msg_history").innerHTML += chatbox;
        }
        };


        const sendMessage=(msg,target,twofrom,sender,chatId)=>
        {
        
        if(setTarget!=null)
        {    
           // console.log("trying...");   
                
                    $.ajax({
                    url: "/contact/sendChatMessage",
                    type: "POST",
                    //data:"msg="+msg+"&target="+setTarget,
                    data:{msg:msg,targetId:target,twofrom:twofrom,senderName:sender,chatId:chatId},
                    dataType: "json",
                    traditional: true,
                    //contentType: "application/json; charset=utf-8",
                    success: function (data) 
                    {
                       // console.log("ajax...");

                    }
                }).done(function (data) {
                   // console.log("sending message...");
                    if(data.status)
                    {
                        conn.send(JSON.stringify({command: "message",target:target, message: msg}));
                    }
                    else{
                        console.log("message error");
                    }
                });
        }
        else
        console.log("Target not set");  
        
        }



        const  chatSubmit=()=>
        {
        var chat = document.querySelector('.active_chat');
        var chatId= chat.firstChild.id;

        //console.log(chat.id);
        if (chat) 
        {
            var twofrom;
           
            if(doctor)
                twofrom=0;
            else
                twofrom=1;

            var msg = document.getElementById("chat_text").value;
            document.getElementById("chat_text").value= "";
            chatbox="";
            sendMessage(msg,chat.id,twofrom,setTarget,chatId);
            chatbox+=
            '<div class="outgoing_msg">'+
            '<div class="sent_msg">'+
                '<p>'+msg+'</p>'+
                '<span class="time_date"> 11:01 AM    |    June 9</span></div>'+
            '</div>'+
        '</div>';        

        document.getElementById("msg_history").innerHTML += chatbox;
        }
        else
        {
        console.log("no chat selected");
        }

    }

const searchDoctor = ()=>
{
    //console.log(22);
}
var search = document.getElementById('search');

search.addEventListener('input', searchDoctor);



 
function updateCounter(e) {
  //console.log('Logging to the console.');      
}

window.onunload = function() {
    conn.close();
}


*/
loadChatData();
