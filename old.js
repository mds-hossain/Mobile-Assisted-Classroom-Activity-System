var io = require('socket.io')(443);
var teacherNSP = io.of('/teacher');
var studentNSP = io.of('/student');
var studentID = []; // store online student list studentID["DB12345":true, "DB23456":true]
var rooms = {};
function room(name, status, activityID){
	this.name = name;
	this.status = status;
	this.activityID = activityID;
	this.questionNum = "";
}
teacherNSP.on('connection', function(teacher){
	
	function leaveAllRooms(){
		for (var index in teacher.rooms){
			teacher.leave(teacher.rooms[index]);
		}
		delete teacher.currentRoom;
	}
	
	console.log("Teacher connected");
	
	teacher.on('joinRoom', function(data){
		leaveAllRooms();
		//set teacher's property
		teacher.currentRoom = data.sectionID;
		//joining room
		teacher.join(teacher.currentRoom);
		//initial room status to wait
		rooms[teacher.currentRoom] = new room(teacher.currentRoom, "Wait", "");
		console.log("Teacher Joined Room:" + data.sectionID);
	});
	
	teacher.on('leaveRoom', function(){
		

	});
	//	Get students list when first time open the page
	teacher.on('initialOnlineStudent', function(data){
		var students = [];
		for ( var id in studentNSP.adapter.rooms[data.sectionID]){
			students.push(studentNSP.connected[id].studentID);
		}
		teacher.emit('updateOnlineStudent',students);
	});
	
	//	Change Room Status
	//	data: status, activityID
	teacher.on('changeStatus', function(data){
		rooms[teacher.currentRoom].status = data.status;
		rooms[teacher.currentRoom].activityID = data.activityID;
		studentNSP.to(teacher.currentRoom).emit('redirect',{status: data.status, activityID: data.activityID});
	});
	
	teacher.on('debug', function(data){
		//console.log(studentNSP.adapter.rooms[data.sectionID]);
		console.log(studentNSP.connected);
	});
	//	Teacher pace quiz : Change student side question
	teacher.on('toQuizQuestion', function(data){
		console.log(data.questionNum);
		rooms[teacher.currentRoom].questionNum = data.questionNum;
		
		studentNSP.to(teacher.currentRoom).emit('toQuizQuestion',{questionNum: data.questionNum});
	});
	
	//	Student pace quiz: Timer for quiz
	teacher.on('updateTimer', function(data){
		studentNSP.to(teacher.currentRoom).emit('updateTimer',{time: data.time});
	});
	
	teacher.on('disconnect', function(){
		studentNSP.in(teacher.currentRoom).status = "Wait";
		// if teacher not reconnect after 2 seconds, redirect student to home and delete room
		var timer = setInterval(function(){
			if ( teacherNSP.adapter.rooms.length < 0){
				delete rooms[teacher.currentRoom];
				studentNSP.to(teacher.currentRoom).emit("redirectHome");
			}
			clearInterval(timer);
		}, 2000);
	});
});
studentNSP.on('connection', function(student){
	function leaveAllRooms(){
		for (var index in student.rooms){
			student.leave(student.rooms[index]);
		}
		delete student.currentRoom;
	}
	
	student.on('storeStudentID', function(data){
		student.studentID = data.studentID;
		studentID[data.studentID] = true;
	});
	
	student.on('joinRoom', function(data){
		leaveAllRooms();
		//set student properties
		student.currentRoom = data.sectionID;
		//join room
		student.join(student.currentRoom);
		console.log("student Joined Room:" + student.currentRoom);
		//notify teacher
		teacherNSP.to(student.currentRoom).emit('studentJoin',{studentID: student.studentID});
		//check page to change
		if (student.currentRoom in rooms)
			student.emit('checkRoomStatus', {status: rooms[student.currentRoom].state, activityID: rooms[student.currentRoom].activityID});
		else
			student.emit('redirectHome');
	});
	
	student.on('checkRoomStatus', function(data){
		if ((student.currentRoom in rooms) && rooms[student.currentRoom].status != data.status){
			student.emit('redirect', rooms[student.currentRoom]);
			console.log("roomState:" + JSON.stringify(rooms[student.currentRoom]) + ";studState:"+ data.status);
		}
	});
	student.on('leaveRoom', function(){
		for (var index in student.rooms){
			delete student.currentRoom;
			console.log('Student Leaved room: '+ student.rooms[index]);
			student.leave(student.rooms[index]);
		}
		student.emit('redirectHome');
	});
	
	student.on('sendAnswered', function(data){
		console.log("student Sent");
		console.log(student.currentRoom);
		teacherNSP.to(student.currentRoom).emit("reciveAnswered", {studentID: data.studentID, questionNum: data.questionNum})
	});
	// Teacher paced quiz:
	student.on('moveToCurrentQuestion',function(){
		studentNSP.to(student.currentRoom).emit('toQuizQuestion',{questionNum: rooms[student.currentRoom].questionNum});
	});
	student.on('disconnect', function(){
		console.log("Student:'" + student.studentID + "' Left");
		// if student not connect after 2 seconds, student offline
		delete studentID[student.studentID];
		var timer = setInterval(function(){
			if (!(student.studentID in studentID))
				teacherNSP.to(student.currentRoom).emit("studentLeft", {studentID: student.studentID});
			clearInterval(timer);
		}, 2000);
	});
	
	student.on('debug', function(data){
		console.log(student.rooms);
	});
});

