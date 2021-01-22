
        $( document ).ready(function() { 
            loadChatData();
            $(document).on('change', '#search-list', async function() {
                var select=this.value;
                var res=select.split("-");
                var found = users.find(element => 
                    element.clientName == res[0] || element.doctorName == res[0] ||
                    element.clientName == res[1] || element.doctorName == res[1] 
                    );
                if(!found)
                {
                    console.log("found");

                    var rst;

                   await  $.ajax({
                        url: "/contact/getChats",
                        type: "POST",
                        data:{'firstname': res[0],'lastname':res[1]},
                        dataType: "json",
                        traditional: true,
                        //contentType: "application/json; charset=utf-8",
                        success: function (data) 
                        {

                        }
                    }).done(function (data) {
                        console.log(data);
                            rst=data.user;
                        
                            chat_messages="";

                            var New="New";
                            if(rst[5]==1)
                            {
                            chat_messages+=
                                    '<div class="chat_list" id="'+rst[0]+'"  onclick=getChat(this)>'+
                                    '<div class="chat_people"  id="'+rst[2]+'">'+
                                    '<div class="chat_img"> <img src="/img/img11.jpg" alt="sunil"> </div>'+
                                    '<div class="chat_ib">'+
                                        '<h5 id="doctor_'+rst[0]+'">'+rst[5]+'</h5>'+
                                        '<span class="chat_date">'+rst[4]+'</span>'+
                                        '<p>'+rst[3]+'</p>'+
                                    '</div>'+
                                    '</div>'+
                                '</div>';
                            }
                            else
                            {
                                chat_messages+=
                                '<div class="chat_list" id="'+rst[1]+'"  onclick=getChat(this)>'+
                                '<div class="chat_people"  id="'+rst[2]+'">'+
                                '<div class="chat_img"> <img src="/img/img11.jpg" alt="sunil"> </div>'+
                                '<div class="chat_ib">'+
                                    '<h5 id="doctor_'+rst[1]+'">'+rst[5]+'</h5>'+
                                    '<span class="chat_date">'+rst[4]+'</span>'+
                                    '<p>'+rst[3]+'</p>'+
                                '</div>'+
                                '</div>'+
                            '</div>';
                            }


                                document.getElementById('inbox_chat').innerHTML+=chat_messages;
                                chat_messages="";
                    });

                }
                else
                {
                    //add error message
                    console.log("found");
                }
            });

        });



        var setTarget='';
        var doctor;
        var ws;
        var ready=false;
        var users;




        const loadChatData =async() =>
        {

            var chatData= await getChatDataPHP();

           
            users = chatData;
            var id = chatData.pop();
      

           if(id!=null)
           {
            console.log("trying connection..."+id);
            ws = await connect(id);

            if(ws==false)
            {
                console.log("connection not made");
            }

           }
           else
           {
               console.log("connection not made");
           }

           var myobj = document.getElementById("loadbox");
           myobj.remove();

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
        } 



        const connect=async(id)=> {
            if(id!=null)
            {
                return new Promise(function(resolve, reject) {
                    var ws = new WebSocket('wss://trinity-recovery-chat.herokuapp.com/'+id);
                    ws.onopen = function() {
                        resolve(ws);
                    };
                    ws.onerror = function(err) {
                        reject(err);
                    };

                    ws.onmessage=({data}) => getMessage(data);


                    ws.onclose = function(){
                        console.log("refresh");
                        setTimeout(connect, 1000);
                    };
                });
            }
            else
            {
                return false;
            }
        }




        
        const getChatDataPHP =async() =>
        {
        return await  $.ajax({
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

        const  chatSubmit=()=>
        {
        var chat = document.querySelector('.active_chat');
        var chatId= chat.firstChild.id;

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



    const sendMessage=(msg,target,twofrom,sender,chatId)=>
    {
    
    if(setTarget!=null)
    {    
            
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

                }
            }).done(function (data) {
                if(data.status)
                {
                   wsSendMessage([target,msg]);
                }
                else{
                    console.log("message error");
                }
            });
    }
    else
    console.log("Target not set");  
    
    }



    function wsSendMessage(msg){
        // Wait until the state of the socket is not ready and send the message when it is...
        waitForSocketConnection(ws, function(){
            ws.send(JSON.stringify(msg));
        });
    }
    
    // Make the function wait until the connection is made...
    function waitForSocketConnection(socket, callback){
        setTimeout(
            function () {
                if (socket.readyState === 1) {
                    console.log("Connection is made")
                    if (callback != null){
                        callback();
                    }
                } else {
                    console.log("wait for connection...")
                    waitForSocketConnection(socket, callback);
                }
    
            }, 5); // wait 5 milisecond for the connection...
    }

  

        const  getMessage= (msg) => {
        var msgs= msg.split('-');
        var chat = document.getElementById(msgs[0]);
        if (chat) 
        {

            chatbox="";
            chatbox+=
            '<div class="incoming_msg">'+
            '<div class="incoming_msg_img"> <img src="/img/img11.jpg" alt="sunil"> </div>'+
                '<div class="received_msg">'+
                    '<div class="received_withd_msg">'+
                        '<p>' + msgs[1] + '</p>'+
                        '<span class="time_date"> 11:01 AM    |    June 9</span> </div>'+
                        '</div>'+
                '</div>'+
            '</div>';
                            
                            
        document.getElementById("msg_history").innerHTML += chatbox;
        }
        };


      
window.onunload = function() {
    ws.close();
}


