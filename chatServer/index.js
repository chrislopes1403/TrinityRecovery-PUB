const express = require('express');
const http =require('http');
const WebSocket = require('ws');

const port = 8080;

const server = http.createServer(express);
const wss = new WebSocket.Server({server});

clients={};

wss.on('connection',(ws,req)=>{

    var userID=parseInt(req.url.substring(1));
  
    clients[userID]= ws;

    ws.on('message',function incoming(message){
        var messageObj = JSON.parse(message);
        var toUserWebSocket = clients[messageObj.receiver];
        toUserWebSocket.send(messageObj.msg);
    });


    ws.on('close', function () {
    delete ws[userID];
  });

});


server.listen(port,function(){
    console.log('Server Started:'+port);
});