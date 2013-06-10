window.onload = function() {
	var username = "";
	var topic = "";
    
    if (!window.location.origin){
    	window.location.origin = window.location.protocol+"//"+window.location.host;
	};
	var socket = io.connect(window.location.origin);
	
    socket.on('connect', function(){
    	socket.emit('newUser');
    });

    //gets a username from the server on login
    socket.on('setUsername', function(data){
    	username = data;
    	$("#username").html("You are logged in as: " + username);
    });
    
    //gets the current topic
    socket.on('setTopic', function(data){
    	topic = data;
    	$("#topic").html(topic);
    });
    
    socket.on('message', function (data) {
        var chatWindow = $("#chatWindow");
       	var messageString = data.user + " (" + data.time + "): " + data.message + "\n";
        chatWindow.val(chatWindow.val() + messageString);
    });
    
    socket.on('help', function(data){
    	var helpString = "";
    	console.log(data);
    	for(var command in data){
    		helpString += command + " - " + data[command] + "\n";
    	}
    	bootbox.alert(helpString + "\nTEst" + "\ntest2");
    });
    
    socket.on('error', function (data) {
        bootbox.alert(data);
    });
    
    socket.on('updateUsers', function(data){
    	var usersField = $("#users");
    	usersField.val("");
    	if(data.length !== {}){
    		for(var user in data){
    			if(data[user].superuser){
    				usersField.val(usersField.val() + data[user].username + " +\n");
    			}
    			else{
    				usersField.val(usersField.val() + data[user].username + "\n");
    			}
    		}
    	}
    });
    
    var sendBtn = $("#sendBtn").click(function(data){
    	send(socket);
    });
    if(navigator.userAgent.indexOf("Firefox")!=-1){
    	$("#input")[0].oninput =  function(e){
    		if(e.keyCode === 13){
				send(socket);
			}
		};
	}
	else{
		$("#input").keyup(function(e){
			if(e.keyCode === 13){
				send(socket);
			}
		});
	}

    function send(socket){
    	var input = $("#input").val();
    	var currentTime = new Date();
    	var hours = currentTime.getHours();
    	var minutes = currentTime.getMinutes();
    	var timestamp = hours + ":" + minutes;
    	socket.emit('send', { message: input, time: timestamp});
    	$("#input").val("");
    }
};


