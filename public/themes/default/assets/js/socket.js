var server = require('http').Server();
var io = require('socket.io')(server);
var Redis = require('ioredis');


var redis = new Redis();

redis.subscribe('vijay-notification-created');

redis.on('message',function(channel, message){
    var message = JSON.parse(message)
    console.log(channel,message)
    io.emit(channel,message);
});

server.listen(3000);