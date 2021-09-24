var scripts = document.getElementsByTagName('script');
var lastScript = scripts[scripts.length-1];
var scriptName = lastScript;
var url_op = scriptName.getAttribute('url');
$(function() {

	var chatarea = $("#chat");

	$('#chat .message-center a').on('click', function() {

		var name = $(this).find(".mail-contnet h5").text();
		var img = $(this).find(".user-img img").attr("src");
		var id = $(this).attr("data-user-id");
		var status = $(this).find(".profile-status").attr("data-status");

		if ($(this).hasClass("active")) {
			$(this).toggleClass("active");
			$(".chat-windows #user-chat" + id).hide();
		} else {
			$(this).toggleClass("active");
			if ($(".chat-windows #user-chat" + id).length) {
				$(".chat-windows #user-chat" + id).removeClass("mini-chat").show();
			} else {
				var msg = msg_receive('Isssssssssssssss watched the storm, so beautiful yet terrific.');
				msg += msg_sent('That is very deep indeed!');
				var html = "<div class='user-chat' id='user-chat" + id + "' data-user-id='" + id + "'>";
				html += "<div class='chat-head'><img src='" + img + "' data-user-id='" + id + "'><span class='status " + status + "'></span><span class='name'>" + name + "</span><span class='opts'><i class='material-icons closeit' data-user-id='" + id + "'>clear</i><i class='material-icons mini-chat' data-user-id='" + id + "'>remove</i></span></div>";
				html += "<div class='chat-body'><ul class='chat-list'>" + msg + "</ul></div>";
				html += "<div class='chat-footer'><input type='text' data-user-id='" + id + "' placeholder='Type & Enter' class='form-control'></div>";
				html += "</div>";
				$(".chat-windows").append(html);
			}
		}
	});

	$("body").on('click', ".chat-windows .user-chat .chat-head .closeit", function(e) {
		var id = $(this).attr("data-user-id");
		$(".chat-windows #user-chat" + id).hide();
		$("#chat .message-center .user-info#chat_user_" + id).removeClass("active");
	});

	$("body").on('click', ".chat-windows .user-chat .chat-head img, .chat-windows .user-chat .chat-head .mini-chat", function(e) {
		var id = $(this).attr("data-user-id");
		if (!$(".chat-windows #user-chat" + id).hasClass("mini-chat")) {
			$(".chat-windows #user-chat" + id).addClass("mini-chat");
		} else {
			$(".chat-windows #user-chat" + id).removeClass("mini-chat");
		}
	});

	$("body").on('keypress', ".chat-windows .user-chat .chat-footer input", function(e) {
		if (e.keyCode == 13) {
			var id = $(this).attr("data-user-id");
			var msg = $(this).val();
			msg = msg_sent(msg);
			$(".chat-windows #user-chat" + id + " .chat-body .chat-list").append(msg);
			$(this).val("");
			$(this).focus();
		}
		$(".chat-windows #user-chat" + id + " .chat-body").perfectScrollbar({
			suppressScrollX: true
		});
	});
});

function msg_receive(msg) {
	var d = new Date();
	var h = d.getHours();
	var m = d.getMinutes();
	return "<li class='msg_receive'><div class='chat-content'><div class='box bg-light-info'>" + msg + "</div></div><div class='chat-time'>" + h + ":" + m + "</div></li>";
}

function msg_sent(msg) {
	var d = new Date();
	var h = d.getHours();
	var m = d.getMinutes();
	return "<li class='odd msg_sent'><div class='chat-content'><div class='box bg-light-info'>" + msg + "</div><br></div><div class='chat-time'>" + h + ":" + m + "</div></li>";
}

// *******************************************************************
// Chat Application
// *******************************************************************
$('.searchbar > input').on('keyup', function() {
  var rex = new RegExp($(this).val(), 'i');
	$('.chat-users .chat-user').hide();
	$('.chat-users .chat-user').filter(function() {
		return rex.test($(this).text());
	}).show();
});

$('.app-chat .chat-users').on('click','.chat-user', function(event) {
	if ($(this).hasClass('.active')) {
		return false;
	} else {
		var findChat = $(this).attr('data-user-id');
		var personName = $(this).find('.message-title').text();
		var personImage = $(this).find('img').attr('src');
		var hideTheNonSelectedContent = $(this).parents('.chat-application').find('.chat-not-selected').hide().siblings('.chatting-box').show();
		var showChatInnerContent = $(this).parents('.chat-application').find('.chat-container .chat-box-inner-part').show();
		//show chat box and send chat
		var chatbox = '<ul class="chat-list chat chathistory"  id="chat_history_'+findChat+'" data-user-id="'+findChat+'">';
            chatbox += fetch_chat_history(findChat);
			chatbox += '</ul>';
		var message_box = '<div class="input-field mt-0 mb-0">';
			message_box +='<input id="'+findChat+'" placeholder="พิมพ์และกด Enter" name="send_message" class="message-type-box form-control border-0" type="text">';
			message_box += '</div>'
		$('#show_chat_box').html(chatbox);
		$('#show_message_box').html(message_box);
		update_read_message(findChat);
		$('#show_chat_box').html(chatbox);
		if (window.innerWidth <= 767) {
		  $('.chat-container .current-chat-user-name .name').html(personName.split(' ')[0]);
		} else if (window.innerWidth > 767) {
		  $('.chat-container .current-chat-user-name .name').html(personName);
		}
		$('.chat-container .current-chat-user-name img').attr('src', personImage);
		$('.chat').removeClass('active-chat');
		$('.user-chat-box .chat-user').removeClass('active');
		//$('.chat-container .chat-box-inner-part').css('height', '100%');
		$(this).addClass('active');
		$('.chat[data-user-id ="'+findChat+'"]').addClass('active-chat');
	}
	if ($(this).parents('.user-chat-box').hasClass('user-list-box-show')) {
	  $(this).parents('.user-chat-box').removeClass('user-list-box-show');
	}
	$('.chat-meta-user').addClass('chat-active');
	//$('.chat-container').css('height', 'calc(100vh - 158px)');
	$('.chat-send-message-footer').addClass('chat-active');
	
});

////////////////////////////////////////////////////////////////////////////////////////////////
$(document).ready(function(){
	get_current_chat_user();
	show_notify_red_dot();
	notify_last4_chat();
	update_chat_history();
	count_unread_message();
	//set if search box on focus pause interval
	window.app = {
		timerRef: null,
		timerStart: function() {
			this.timerRef = setInterval(function() {        
				count_unread_message()
				get_current_chat_user();
				update_chat_history();
				show_notify_red_dot();
				notify_last4_chat();
			}, 1000);
		},
		timerStop:function(){
			clearInterval(this.timerRef);
		},
		search_box_focus: function() {
			$('#search_box').focusin(function(event) {
			this.timerStop();
			console.log('focus');
			}.bind(this));
		},
		search_box_blur: function() {
			$('#search_box').focusout(function(event) {
			this.timerStart();
			console.log('blur');
			}.bind(this));
		},
		start: function() {
			this.timerStart();
			this.search_box_focus();
			this.search_box_blur();
		}

	};

	window.app.start();
});


//get current user (Side user)
function get_current_chat_user(){
	$.ajax({
		url:url_op,
		method:"POST",
		data:{
			get_current_user:1
		},
		success:function(data){
			$('.chat-users').html(data);
		}
	})
}

//auto scroll
function auto_scroll(){
	$(".chat-box").scrollTop($(".chat-box")[0].scrollHeight);
}

//Enter to send message
$(document).on('keydown','.message-type-box', function(event){
	if(event.key == 'Enter'){

		var to_user_id = $(this).attr('id');
		var chatvalue= $(this).val();
		
		if(chatvalue == ""){
			return
			}
		//ajax send data
		$.ajax({
			url:url_op,
			method:"POST",
			data:{
				"action": "p",
				"to_user_id":to_user_id,
				"msg_text":chatvalue
			},
		//IF Send success show message and set message_box to blank
				success: function(data){
				$('#chat_history_'+to_user_id).html(data);
				auto_scroll();
				$('.message-type-box').val('');
			   
			}
			
		})
	
	}
});

//เรียกข้อมูล chat history
function  fetch_chat_history(to_user_id){
		$.ajax({
			url:url_op,
			method:"POST",
			data:{
				get_chat_history:1,
				to_user_id:to_user_id
			},
			success: function(data){
				$('#chat_history_'+$.escapeSelector(to_user_id)).html(data);
				auto_scroll();
			}
		})

}

//update chat history
function update_chat_history(){
		$('.chathistory').each(function(){
			var to_user_id = $(this).data('user-id');
			fetch_chat_history(to_user_id);

		});
}

//show notify red dot
function show_notify_red_dot(){
	$.ajax({
		url:url_op,
		method:"post",
		data:{
			show_notify_red_dot:1,
		},
		success:function(data){
			$('.notify').html(data);
		}
	})
}

  //count unread message
function count_unread_message(){
	$.ajax({
		url:url_op,
		method:"post",
		data:{
			count_unread_message:1,
		},
		success:function(data){
			$('#count_unread_message').html(data);
		}
	})
}
//update read message
function update_read_message(from_user_id){
	$.ajax({
		url:url_op,
		method:"post",
		data:{
			update_read_message:1,
			from_user_id:from_user_id
		},
		success:function(data){
			
		}
	})
}

//notify chat
function notify_last4_chat(){
	$.ajax({
		url:url_op,
		method:"post",
		data:{
			notify_last4_chat:1,
		},
		success:function(data){
			$('#message_last4').html(data);
		}
	})
}
