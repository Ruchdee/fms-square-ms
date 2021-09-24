var scripts = document.getElementsByTagName('script');
var lastScript = scripts[scripts.length-1];
var scriptName = lastScript;
var url = scriptName.getAttribute('url');

$(document).ready(function(){
    show_notify_red_dot();
    count_unread_message();
    notify_last4_chat();
})
//show notify red dot
function show_notify_red_dot(){
	var from_user_id = $('.start_chat').data('user-id');
	$.ajax({
		url:url,
		method:"post",
		data:{
			show_notify_red_dot:1
		},
		success:function(data){
			$('.notify').html(data);
		}
	})
}

  //count unread message
function count_unread_message(){
	$.ajax({
		url:url,
		method:"post",
		data:{
			count_unread_message:1,
		},
		success:function(data){
			$('#count_unread_message').html(data);
		}
	})
}

//notify chat
function notify_last4_chat(){
	$.ajax({
		url:url,
		method:"post",
		data:{
			notify_last4_chat:1,
		},
		success:function(data){
			$('#message_last4').html(data);
		}
	})
}
