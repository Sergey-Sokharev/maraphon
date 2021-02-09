<?php
/*
Template Name: chat
*/
get_header();
?>	      
<style>
.main_chat_window {
	width: 1200px;
	margin: auto;
	margin-top: 40px;
	border: 1px solid grey;
	border-collapse: collapse;
}	

.main_chat_window tr {
	border: 1px solid grey;
}

.main_chat_window td {
	border: 1px solid grey;
}

.text-input {
	width: 1100px;
}

.chat_window {
	min-height: 600px;
	overflow: auto;
}

.success_send {
	display: none;
	margin: 20px auto 20px auto;
	width: 300px;
	font-size: 18px;
	background-color: #ddf7c8;
	text-align: center;
}
	
	
	
</style>

                       
<div style="height: 800px; background-color: white; padding-top: 70px;">

<?php
$post_id_7 = get_post( 4380 );
$title = $post_id_7->post_title;
$content = $post_id_7->post_content;
echo $title;
echo $content;

?>


<form class="main_chat_form">
<table class="main_chat_window">
	<tr class="chat_window_tr">
		<td colspan="2">
			<div class="chat_window">
			<?php
			global $wpdb;
			
			$result = $wpdb->get_results( 
						"
						SELECT * 
						FROM (
					   	SELECT * FROM wpux_chat ORDER BY time DESC LIMIT 5
						) wpux_chat
						ORDER BY wpux_chat.time ASC
						"	
						); 
						
						if( $result ) {
						    foreach ( $result as $string ) {
							 echo '<p>';
							 echo $string->time.' ';
							 echo $string->first_name.' ';
							 echo $string->last_name.' ';
							 echo $string->message.'</p>';
							 
						};
						};
			
			
			?>	
			</div>
		</td>
	</tr>
	<tr class="input_message_window">
		<td style="width: 1100px;"><input class="text-input" name="input_message" id="input_message" type="text" /></td>
		<td style="width: 100px;"><button id="send_button">Отправить</button></td>
	</tr>
</table>
</form>
<div class="success_send">Сообщение отправлено</div>



<script type="text/javascript">

				$(function() {
				function sendMessageToChat(){
					  $.ajaxSetup({cache: false});
					  var inputMessage = $("#input_message").val();
						jQuery.ajax({
							type:"POST",
							url: "/wp-admin/admin-ajax.php",
							data: {action: "sendMessageToChat",
								inputMessage,
							},
							success:function(data){
							$(".success_send").show();
							setTimeout(function(){$('.success_send').fadeOut('slow')},500);
							$(".chat_window").append(data);
							}
						});
						return false;
					}
				    $("#send_button").click(sendMessageToChat);
				}); 
				

				
				function updateChat(){
					/*  $.ajaxSetup({cache: false});
						jQuery.ajax({
							type:"POST",
							url: "/wp-admin/admin-ajax.php",
							data: {action: "updateChat",
							},
							success:function(data){
							$(".chat_window").append(data);
							}
						});
						return false; */
						$(".chat_window").append("<p>123</p>");
						
				}

				setInterval(updateChat(), 1000); 
				
			/*	$(function() {
				function sendMessageToChat(){
				$(".chat_window").append("<p>123</p>");

					}
				    $("#send_button").click(sendMessageToChat);
				});  */
				
				
				
				
</script>






</div>	
<?php
get_footer();
