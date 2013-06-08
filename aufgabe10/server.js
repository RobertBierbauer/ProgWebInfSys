var express = require('express');
var app = express();
var port = 9000;

var topic = "Gruppe 1";
var superusers = 0;
var users = {};

app.get("/", function(req, res){
	res.sendfile(__dirname + '/index.html');
});
app.use(express.static(__dirname + '/'));

var io = require('socket.io').listen(app.listen(port));
io.sockets.on('connection', function (socket) {
	socket.on('newUser', function(){
		var socketId = socket.id;
		var username = makeUsername();
		socket.emit('setUsername', username);
		socket.emit('setTopic', topic);
		users[socketId] = {"username" : username};
		if(superusers === 0){
			users[socketId].superuser = true;
			superusers++;
		}
		else{
			users[socketId].superuser = false;
		}
		io.sockets.emit('updateUsers', users);
		console.log(users);
	});
	
    socket.on('send', function (data) {
    	var socketId = socket.id;
    	var userMessage = data.message;
    	var timestamp = data.time;
    	console.log(userMessage.indexOf("/name:"));
    	if(userMessage.indexOf("/help") === 0) {
    		//help
    	} else if(userMessage.indexOf("/name:") === 0) {
    		setNewUsername(socket, userMessage.substring(userMessage.indexOf(":") + 1));
    	} else if(userMessage.indexOf("/super:") === 0){
    		setNewSuperuser(socket, userMessage.substring(userMessage.indexOf(":") + 1));
    	} else if(userMessage.indexOf("/kick:") === 0){
    		//user kicken
    	} else if(userMessage.indexOf("/topic:") === 0){
    		setNewTopic(socket, userMessage.substring(userMessage.indexOf(":") + 1));
    	} else if(userMessage.indexOf("/quit") === 0){
    		//verbindung trennen
    	} else{
    		//normale Nachricht
    		var message = {};
    		message['user'] = socketId;
    		message['message'] = userMessage;
    		message['time'] = timestamp;
    		io.sockets.emit('message', message);
    	}
    });
    
    socket.on('disconnect', function () {
    	var socketId = socket.id;
    	if(users[socketId].superuser === true){
    		superusers--;
    	}
    	delete users[socketId];
    	if(superusers === 0){
    		for(var user in users){
    			users[user].superuser = true;
    			break;
    		}
    	}
    	io.sockets.emit('updateUsers', users);
    });
});

function setNewUsername(socket, name){
	if(contains(users, name)){
		socket.emit('error', 'Username is already taken!');
	}
	else{
		users[socket.id].username = name;
		socket.emit('setUsername', name);
		io.sockets.emit('updateUsers', users);
	}
}

function setNewTopic(socket, name){
	if(!users[socket.id].superuser){
		socket.emit('error', 'You need to be a superuser!');
	}
	else{
		topic = name;
		io.sockets.emit('setTopic', topic);
	}
}

function setNewSuperuser(socket, name){
	if(!users[socket.id].superuser){
		socket.emit('error', 'You need to be a superuser!');
	}
	else if(!contains(users, name)){
		socket.emit('error', 'User does not exist!');
	}
	else{
		user = getUser(users, name);
		if(user.superuser){
			socket.emit('error', 'User is already a superuser!');
		}
		else{
			user.superuser = true;
			superusers++;			
			io.sockets.emit('updateUsers', users);
		}
	}
}

function kickUser(socket, name){
	if(!users[socket.id].superuser){
		socket.emit('error', 'You need to be a superuser!');
	}
	else if(!contains(users, name)){
		socket.emit('error', 'User does not exist!');
	}
	else{
		user = getUser(users, name);
		if(user.superuser){
			socket.emit('error', 'User is already a superuser!');
		}
		else{
			user.superuser = true;
			superusers++;			
			io.sockets.emit('updateUsers', users);
		}
	}
}

//check if username is already taken
function contains(users, name) {
    for (var user in users) {
        if (users[user].username === name) {
            return true;
        }
    }
    return false;
}

function getUser(users, name){
	for (var user in users) {
        if (users[user].username === name) {
            return users[user];
        }
    }
    return false;
}

//generate a username
function makeUsername()
{
	while(true){		
		var username = "";
		var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
		
		for( var i=0; i < 8; i++ ){
			username += possible.charAt(Math.floor(Math.random() * possible.length));
		}
		if(!contains(users, username)){
			return username;
		}
	}
}
