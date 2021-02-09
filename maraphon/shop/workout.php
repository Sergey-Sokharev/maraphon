<?php
/*
Template Name: shop-workout
*/

get_header();
?>	
	<script src="<?php echo content_url() ?>/themes/maraphon/js/jquery.maskedinput.js"></script>
	<style>
			#shop_header_block_1 {
				background-image: url(/wp-content/uploads/workout_price.png);
			}
		
			#shop_header_block_2 {
				background-image: url(/wp-content/uploads/maraphon_price.png);
			}
			#shop_header_block_3 {
				background-image: url(/wp-content/uploads/maraphon_price.png);
			}
		
			#shop_header_block_4 {
				background-image: url(/wp-content/uploads/workout_price.png);
			}
			.shop_menu_success_button {
				margin-top: -65px;
			}
			
			@media screen and (max-width:1279px){
				.opacity-line {
				position: absolute;
				height: 65px;
				width: 720px;
				background-color: #d5d5d5;
				margin-top: 90px;
				opacity: 0.57;
				display: block;
        		}
        		.shop_main_block {
	        		height: 3800px;
        		}
        		.shop_block {
	        		height: 840px !important;
        		}
        		.shop_block p {
	        		margin-bottom: 0px;
        		}
        		#shop_block_2 {
	        		margin-bottom: 0px;
        		}    		
        		#shop_block_3 {
	        		margin-top: 110px;
	        		height: 769px !important;
        		}
        		#shop_block_4 {
					height: 739px !important;
        		}
        		#shop_header_block_1 {
					margin-top: -137px;
					height: 298px;
				}
        		#shop_header_block_2 {
					margin-top: -131px;
				}
        		
        		#shop_header_block_3 {
					margin-top: -131px;
				}
			
				#shop_header_block_4 {
					margin-top: -137px;
					height: 298px;
				}
        		.shop_workout_select {
	        		width: 238px;
	        		font-size: 32px;
					margin-left: 215px;
					margin-top: 15px;
					margin-bottom: 30px;
					height: 46px;
        		}
        		.shop_example_ref {
	        		margin-left: 170px;
	        		width: 330px;
	        		height: 50px;
	        		padding-top: 2px;
	        		margin-top: 40px;
        		}
        		.shop_example_ref a p {
	        		padding-left: 14px;
        		}
        		#shop_example_ref_first {
	        		margin-top: -15px;
        		}
        		#shop_example_ref_last {
	        		margin-top: 10px;
        		}

			}	
			@media screen and (min-width:1279px){  
				.opacity-line {
				position: absolute;
				height: 70px;
				width: 1280px;
				background-color: #d5d5d5;
				margin-top: 90px;
        		}
        		.shop_main_block {
	        		height: 1793px;
        		}
        		.shop_block {
	        		margin-bottom: 0px;
	        		height: 745px !important;
        		}
        		.shop_block p {
	        		margin-bottom: 0px;
        		}
        		#shop_block_3 {
	        		margin-top: 110px;
	        		height: 688px !important;
        		}
        		#shop_block_4 {
	        		margin-top: 110px;
	        		height: 688px !important;
        		}
        		#shop_header_block_1 {
					margin-top: -137px;
					height: 298px;
				}
				#shop_header_block_2 {
					margin-top: -131px;
				}
        		#shop_header_block_3 {
					margin-top: -131px;
				}
				#shop_header_block_4 {
					margin-top: -137px;
					height: 298px;
				}
				.shop_workout_select {
	        		width: 200px;
	        		font-size: 20px;
					margin-left: 192px;
					margin-top: 15px;
					margin-bottom: 30px;
        		}
        		.shop_example_ref {
	        		margin-left: 127px;
	        		width: 330px;
	        		height: 50px;
	        		padding-top: 2px;
	        		margin-top: 28px;
        		}
        		.shop_example_ref a p {
	        		padding-left: 8px;
        		}
        		#shop_example_ref_first {
	        		margin-top: -15px;
        		}
        		#shop_example_ref_last {
	        		margin-top: 28px;
        		}
        		
			}	
	</style>
	
	<script type="text/javascript">
        //закрытие оформления заказа по крестику
				$(document).on("click", "#close_shop_order_table", function(event){
					$("#shop-order-table").hide();
					$(".shop_block").removeClass("changebox");
					var $checkbox = $('.shop_checkbox');
					$checkbox.prop('checked', 0);
					$(".shop_content_block").css("marginTop", "5px");
					$(".shop_content_block").css("marginLeft", "5px");
					$("#shop_header_block_1").css("marginTop", "-137px");
					$("#shop_header_block_2").css("marginTop", "-131px");
					$("#shop_header_block_3").css("marginTop", "-131px");
					$("#shop_header_block_4").css("marginTop", "-137px");
					if ($(window).width() < 1279) {
						$("#shop_header_block_1").css("marginLeft", "158px");
						$("#shop_header_block_2").css("marginLeft", "158px");
						$("#shop_header_block_3").css("marginLeft", "158px");
						$("#shop_header_block_4").css("marginLeft", "158px");
					} else {
						$("#shop_header_block_1").css("marginLeft", "116px");
						$("#shop_header_block_2").css("marginLeft", "116px");
						$("#shop_header_block_3").css("marginLeft", "116px");
						$("#shop_header_block_4").css("marginLeft", "116px");
					}
				});
		</script>		

	<main id="primary" class="site-main" >
	
	<div class="shop_main_block">
		<h1 class="shop_h1">Интернет-магазин maraphon.online</h1>
		
		<?php
		if ( is_user_logged_in() ) {
	 	custom_shop_workout_confirmation_function();
		} else {
		custom_shop_workout_registration_function();
		};
		
		function custom_shop_workout_confirmation_function() {
			echo '
				<script type="text/javascript">
				$(function() {
				   function sendOrderByShopWorkout(){
					  var sendOrderWorkoutValue = this.id;
					  var shopWorkoutSelect = $("#shop_workout_select").val();
					  console.log(sendOrderWorkoutValue);
		
					  
					    $.ajaxSetup({cache: false});
				        $.ajax({
						    type:"POST",
							url: "/wp-admin/admin-ajax.php",
							data: {action: "sendOrderByShopWorkout",
							sendOrderWorkoutValue, shopWorkoutSelect,
							},
							success:function(data){
								if (sendOrderWorkoutValue == "buy_one_class") {
									$("#shop_content_block_1" + " .shop_menu_success_button").show();
								} else if (sendOrderWorkoutValue == "buy_ten_class") {
									$("#shop_content_block_2" + " .shop_menu_success_button").show();
								} else if (sendOrderWorkoutValue == "buy_press_class") {
									$("#shop_content_block_3" + " .shop_menu_success_button").show();
								} else if (sendOrderWorkoutValue == "buy_booty_class") {
									$("#shop_content_block_4" + " .shop_menu_success_button").show();
								};
								$("#primary").empty();
								$("#primary").html(data);
							}
						});
							return false;
						}
						$(".buy_button").click(sendOrderByShopWorkout);
						});
				</script>';
			
			global $wpdb;
			$current_user = wp_get_current_user();
			$user_id = $current_user->ID;
			
			$check_what_workout_already_bought = $wpdb->get_results(
			"
			SELECT
			orders_workout.order_id,
            orders_workout.first_name,
            orders_workout.last_name,
            orders_workout.user_id,
            orders_workout.class_1,
            orders_workout.class_2,
            orders_workout.class_3,
            orders_workout.class_4,
            orders_workout.class_5,
            orders_workout.class_6,
            orders_workout.class_7,
            orders_workout.class_8,
            orders_workout.class_9,
            orders_workout.class_10
			FROM wpux_users users, wpux_orders_workout orders_workout
			WHERE users.ID = orders_workout.user_id
            AND orders_workout.user_id = $user_id
            AND orders_workout.paid = 1
            ORDER BY orders_workout.order_id DESC
			"	
			);
			
			if ($check_what_workout_already_bought) {
				foreach($check_what_workout_already_bought as $check_workout_string) {
					if ($check_workout_string->class_1) {$disabled_workout_choice_1 = 'disabled';};
					if ($check_workout_string->class_2) {$disabled_workout_choice_2 = 'disabled';};
					if ($check_workout_string->class_3) {$disabled_workout_choice_3 = 'disabled';};
					if ($check_workout_string->class_4) {$disabled_workout_choice_4 = 'disabled';};
					if ($check_workout_string->class_5) {$disabled_workout_choice_5 = 'disabled';};
					if ($check_workout_string->class_6) {$disabled_workout_choice_6 = 'disabled';};
					if ($check_workout_string->class_7) {$disabled_workout_choice_7 = 'disabled';};
					if ($check_workout_string->class_8) {$disabled_workout_choice_8 = 'disabled';};
					if ($check_workout_string->class_9) {$disabled_workout_choice_9 = 'disabled';};
					if ($check_workout_string->class_10) {$disabled_workout_choice_10 = 'disabled';};
				}
			};
				
			
			echo '<form id="shop_main_form">';
					echo '
				    <div class="shop_block" id="shop_block_1">
				    	<div class="shop_header_block" id="shop_header_block_1">
				    	</div>
				    	<div class="shop_content_block" id="shop_content_block_1">
					    	<br>
							<h3>Выберите класс тренировок</h3>
				   		<p>
					       <strong>Что вы получите:</strong><br>
						    - 1 тренировочный класс, который состоит из 3 полноценных тренировок<br>
							- все тренировки в видеоформате с подробным обьяснением техники выполнения упражнения<br>
							- вы занимаетесь в любое удобное для вас время, так как все тренировки в записи<br>
							- тренировки имеют разные уровни сложности:<br>
							&nbsp;&nbsp;&nbsp;▪️ 1, 2 - легкий уровень<br>
							&nbsp;&nbsp;&nbsp;▪️ 3, 4, 5, 6 - средний уровень<br>
							&nbsp;&nbsp;&nbsp;▪️ 7, 8, 9, 10 - высокий уровень<br>
						</p>
					       <select class="shop_workout_select" id="shop_workout_select">
						       <option value = "1" '.$disabled_workout_choice_1.'> 1 класс</option>
						       <option value = "2" '.$disabled_workout_choice_2.'>2 класс</option>
						       <option value = "3" '.$disabled_workout_choice_3.' style="background-color: green;">3 класс</option>
						       <option value = "4" '.$disabled_workout_choice_4.' disabled>4 класс</option>
						       <option value = "5" '.$disabled_workout_choice_5.'>5 класс</option>
						       <option value = "6" '.$disabled_workout_choice_6.'>6 класс</option>
						       <option value = "7" '.$disabled_workout_choice_7.' disabled>7 класс</option>
						       <option value = "8" '.$disabled_workout_choice_8.' disabled>8 класс</option>
						       <option value = "9" '.$disabled_workout_choice_9.' disabled>9 класс</option>
						       <option value = "10" '.$disabled_workout_choice_10.' disabled>10 класс</option>
					       </select>
					       <div class="shop_example_ref" id="shop_example_ref_first"><a href="http://maraphon.online/workout-example" target="_blank"><p>Пример тренировок</p></a></div>	
						   <br>
						   <div class="buy_button" id="buy_one_class"><p>Купить</p></div>
						   <div class="shop_menu_success_button"><p>Заказ успешно оформлен</p></div>
						</div>
					</div>';
					
					echo '
					<div class="shop_block" id="shop_block_2">
						<div class="shop_header_block" id="shop_header_block_2"></div>
				    	<div class="shop_content_block" id="shop_content_block_2">
						<br>
						<h3>10 классов тренировок</h3>
					   		<p>
						       <strong>Что вы получите:</strong><br>
						        - 10 тренировочных классов сразу, каждый из которых состоит из 3 полноценных тренировок<br>
								- все тренировки в видеоформате с подробным обьяснением техники выполнения упражнения<br>
								- вы занимаетесь в любое удобное для вас время, так как все тренировки в записи<br>
								- тренировки имеют разные уровни сложности:<br>
								&nbsp;&nbsp;&nbsp;▪️ 1, 2 - легкий уровень<br>
								&nbsp;&nbsp;&nbsp;▪️ 3, 4, 5, 6 - средний уровень<br>
								&nbsp;&nbsp;&nbsp;▪️ 7, 8, 9, 10 - высокий уровень<br>
								<br>
							</p>
							<div class="shop_example_ref"><a href="http://maraphon.online/workout-example" target="_blank"><p>Пример тренировок</p></a></div>
						<br>
						   <div class="buy_button" id="buy_ten_class" style="background-color: #9d9d9d; cursor: default; pointer-events: none;"><p>Купить</p></div>
						   <div class="shop_menu_success_button"><p>Заказ успешно оформлен</p></div>
						</div>
					</div>';
					
					echo '
					<div class="shop_block" id="shop_block_3">
						<div class="shop_header_block" id="shop_header_block_3"></div>
				    	<div class="shop_content_block" id="shop_content_block_3">
						<br>
						<h3>Класс "Пресс"</h3>
				   		<p>
					       <strong>Что вы получите:</strong><br>
						    - тренировочный класс акцентированный на проработку мышц пресса<br>
							- класс состоит из 3 полноценных тренировок, которые приведут ваши мышцы в тонус, а при сочетании с правильным питанием более рельефным<br>
							Уровень сложности:<br>
							▪️ Легкий<br>
							✅ Средний<br>
							▪️ Сложный<br>    
						</p>
						<div class="shop_example_ref"><a href="http://maraphon.online/workout-example" target="_blank"><p>Пример тренировок</p></a></div>
						<br>
						   <div class="buy_button" id="buy_press_class" style="background-color: #9d9d9d; cursor: default; pointer-events: none;"><p>Купить</p></div>
						   <div class="shop_menu_success_button"><p>Заказ успешно оформлен</p></div>
						</div>
					</div>';
					
					echo '
					<div class="shop_block" id="shop_block_4">
						<div class="shop_header_block" id="shop_header_block_4"></div>
				    	<div class="shop_content_block" id="shop_content_block_4">
						<br>
						<h3>Класс "Ягодицы"</h3>
				   		<p>
					       <strong>Что вы получите:</strong><br>
						    - тренировочный класс акцентированный на проработку ягодиц<br>
							- класс состоит из 3 полноценных тренировок, которые сделают ваши ягодицы максимально окуглыми и подтянутыми<br>
							Уровень сложности:<br>
							▪️ Легкий<br>
							✅ Средний<br>
							▪️ Сложный<br>
						</p>
						<div class="shop_example_ref" id="shop_example_ref_last"><a href="http://maraphon.online/workout-example" target="_blank"><p>Пример тренировок</p></a></div>
						<br>
						   <div class="buy_button" id="buy_booty_class" style="background-color: #9d9d9d; cursor: default; pointer-events: none;"><p>Купить</p></div>
						   <div class="shop_menu_success_button"><p>Заказ успешно оформлен</p></div>
						</div>
					</div>';
			echo '		
			</div>
			</form>						
				';
		};
		
		function custom_shop_workout_registration_function() {
			$_monthsList = array(
						"1"=>"январь","2"=>"февраль","3"=>"март",
						"4"=>"апрель","5"=>"май", "6"=>"июнь",
						"7"=>"июль","8"=>"август","9"=>"сентябрь",
						"10"=>"октябрь","11"=>"ноябрь","12"=>"декабрь");
			$n = current_time("m")+ 1 > 12 ? 1 : current_time("m")+1;
			$next_month = $_monthsList[$n];
			$year = current_time("m") + 1 > 12 ? current_time("Y") +1 : current_time("Y");	
		    if (isset($_POST['submit'])) {
		        shop_validation(
		        $_POST['password'],
		        $_POST['email'],
		        $_POST['telephone'],
		        $_POST['first_name'],
		        $_POST['last_name'],
		        $_POST['shop_workout_select'],
		        $_POST['buy_one_class'],
		        $_POST['buy_ten_class'],
		        $_POST['buy_press_class'],
		        $_POST['buy_booty_class'],
				); 
				
		        global $username, $password, $email, $telephone, $first_name, $last_name, $shop_workout_select_value, $buy_one_class, $buy_ten_class, $buy_press_class, $buy_booty_class;
		        $password 	= 	esc_attr($_POST['password']);
		        $email 		= 	sanitize_email($_POST['email']);
		        $telephone 	= 	sanitize_text_field($_POST['telephone']);
		        $first_name = 	sanitize_text_field($_POST['first_name']);
		        $last_name = 	sanitize_text_field($_POST['last_name']);
		        $shop_workout_select_value = sanitize_text_field($_POST['shop_workout_select']);
		        $buy_one_class = 	sanitize_text_field($_POST['buy_one_class']);
		        $buy_ten_class = 	sanitize_text_field($_POST['buy_ten_class']);
		        $buy_press_class = 	sanitize_text_field($_POST['buy_press_class']);
		        $buy_booty_class = 	sanitize_text_field($_POST['buy_booty_class']);
		       
		        complete_registration(
		        $username,
		        $password,
		        $email,
		        $telephone,
		        $first_name,
		        $last_name,
		        $shop_workout_select_value,
		        $buy_one_class,
		        $buy_ten_class,
		        $buy_press_class,
		        $buy_booty_class
				);
		    }
		
		    registration_form(
		        $password,
		        $email,
		        $telephone,
		        $first_name,
		        $last_name,
		        $shop_workout_select_value,
		        $buy_one_class,
		        $buy_ten_class,
		        $buy_press_class,
		        $buy_booty_class
				);
			}

			function registration_form( $password, $email, $telephone, $first_name, $last_name, $shop_workout_select_value, $buy_one_class, $buy_ten_class, $buy_press_class, $buy_booty_class ) {
				
				$_monthsList = array(
						"1"=>"январь","2"=>"февраль","3"=>"март",
						"4"=>"апрель","5"=>"май", "6"=>"июнь",
						"7"=>"июль","8"=>"август","9"=>"сентябрь",
						"10"=>"октябрь","11"=>"ноябрь","12"=>"декабрь");
						
				$_monthsListPadezh = array(
						"1"=>"января","2"=>"февраля","3"=>"марта",
						"4"=>"апреля","5"=>"мая", "6"=>"июня",
						"7"=>"июля","8"=>"августа","9"=>"сентября",
						"10"=>"октября","11"=>"ноября","12"=>"декабря");
						
						$n = current_time("m")+ 1 > 12 ? 1 : current_time("m")+1;
						$this_month_padezh = $_monthsListPadezh[current_time("m")];
						$next_month = $_monthsList[$n];
						$next_month_padezh = $_monthsListPadezh[$n];
						$nn = current_time("m")+ 2 > 12 ? 1 : current_time("m")+2;
						$next_year = current_time("m") + 2 > 12 ? current_time("Y") +1 : current_time("Y");
						$nnext_month = $_monthsList[$nn];
						$year = current_time("m") + 1 > 12 ? current_time("Y") +1 : current_time("Y");
						
			    echo '
			    <script type="text/javascript">
			    $(document).on("click", "#buy_one_class_button", function (e) {
		            var $checkbox = $("#buy_one_class");
		            if (e.target !== $checkbox[0]) {
		            $checkbox.prop("checked", !$checkbox.prop("checked"));
		            }
		            if ($("#buy_one_class").prop("checked")) {
			        $(".shop_block").removeClass("changebox");
					$("#shop_block_1").addClass("changebox");
					$("#shop-order-table").show();
					$("#shop_content_block_1").css("marginTop", "0px");
					$("#shop_content_block_1").css("marginLeft", "0px");
					$("#shop_header_block_1").css("marginTop", "-142px");
					} else {
					$("#shop_block_1").removeClass("changebox");
					};
					if ($(window).width() < 1279) {
						$("#shop-order-table").css("marginTop", "123px");
						$("#shop_header_block_1").css("marginLeft", "153px");
					} else {
						$("#shop-order-table").css("marginTop", "116px");
						$("#shop_header_block_1").css("marginLeft", "111px");
					}
		        });
		        
				$(document).on("click", "#buy_ten_class_button", function (e) {
		            var $checkbox = $("#buy_ten_class");
		            if (e.target !== $checkbox[0]) {
		            $checkbox.prop("checked", !$checkbox.prop("checked"));
		            }
		            if ($("#buy_ten_class").prop("checked")) {
					$(".shop_block").removeClass("changebox");
					$("#shop_block_2").addClass("changebox");
					$("#shop-order-table").show();
					$("#shop_content_block_2").css("marginTop", "0px");
					$("#shop_content_block_2").css("marginLeft", "0px");
					$("#shop_header_block_2").css("marginTop", "-136px");
					} else {
					$("#shop_block_2").removeClass("changebox");
					};
					if ($(window).width() < 1279) {
						$("#shop-order-table").css("marginTop", "1075px");
						$("#shop_header_block_2").css("marginLeft", "153px");
					} else {
						$("#shop-order-table").css("marginTop", "116px");
						$("#shop_header_block_2").css("marginLeft", "111px");
					}
		        });
		        
		        $(document).on("click", "#buy_press_class_button", function (e) {
		            var $checkbox = $("#buy_press_class");
		            if (e.target !== $checkbox[0]) {
		            $checkbox.prop("checked", !$checkbox.prop("checked"));
		            }
		            if ($("#buy_press_class").prop("checked")) {
					$(".shop_block").removeClass("changebox");
					$("#shop_block_3").addClass("changebox");
					$("#shop-order-table").show();
					$("#shop_content_block_3").css("marginTop", "0px");
					$("#shop_content_block_3").css("marginLeft", "0px");
					$("#shop_header_block_3").css("marginTop", "-136px");
					} else {
					$("#shop_block_3").removeClass("changebox");
					};
					if ($(window).width() < 1279) {
						$("#shop-order-table").css("marginTop", "2025px");
						$("#shop_header_block_3").css("marginLeft", "153px");
					} else {
						$("#shop-order-table").css("marginTop", "820px");
						$("#shop_header_block_3").css("marginLeft", "111px");
					}	
		        });
		        
		        $(document).on("click", "#buy_booty_class_button", function (e) {
		            var $checkbox = $("#buy_booty_class");
		            if (e.target !== $checkbox[0]) {
		            $checkbox.prop("checked", !$checkbox.prop("checked"));
		            }
		            if ($("#buy_booty_class").prop("checked")) {
					$(".shop_block").removeClass("changebox");
					$("#shop_block_4").addClass("changebox");
					$("#shop-order-table").show();
					$("#shop_content_block_4").css("marginTop", "0px");
					$("#shop_content_block_4").css("marginLeft", "0px");
					$("#shop_header_block_4").css("marginTop", "-142px");
					} else {
					$("#shop_block_4").removeClass("changebox");
					};
					if ($(window).width() < 1279) {
						$("#shop-order-table").css("marginTop", "2915px");
						$("#shop_header_block_4").css("marginLeft", "153px");
					} else {
						$("#shop-order-table").css("marginTop", "820px");
						$("#shop_header_block_4").css("marginLeft", "111px");
					}	
		        });
		        </script>
			    
			    <form action="' . $_SERVER['REQUEST_URI'] . '" method="post" id="shop_main_form">
				    <div class="shop_block" id="shop_block_1">
				    	<div class="shop_header_block" id="shop_header_block_1">
				    	</div>
				    	<div class="shop_content_block" id="shop_content_block_1">
					    	<br>
							<h3>Выберите класс тренировок</h3>
				   		<p>
					       <strong>Что вы получите:</strong><br>
						    - 1 тренировочный класс, который состоит из 3 полноценных тренировок<br>
							- все тренировки в видеоформате с подробным обьяснением техники выполнения упражнения<br>
							- вы занимаетесь в любое удобное для вас время, так как все тренировки в записи<br>
							- тренировки имеют разные уровни сложности:<br>
							&nbsp;&nbsp;&nbsp;▪️ 1, 2 - легкий уровень<br>
							&nbsp;&nbsp;&nbsp;▪️ 3, 4, 5, 6 - средний уровень<br>
							&nbsp;&nbsp;&nbsp;▪️ 7, 8, 9, 10 - высокий уровень<br>
						</p>
					       <select class="shop_workout_select" id="shop_workout_select" name="shop_workout_select">
						       <option selected="selected" value="1"> 1 класс</option>
						       <option value = "2">2 класс</option>
						       <option value = "3" disabled>3 класс</option>
						       <option value = "4" disabled>4 класс</option>
						       <option value = "5">5 класс</option>
						       <option value = "6">6 класс</option>
						       <option value = "7" disabled>7 класс</option>
						       <option value = "8" disabled>8 класс</option>
						       <option value = "9" disabled>9 класс</option>
						       <option value = "10" disabled>10 класс</option>
					       </select>
					       <div class="shop_example_ref" id="shop_example_ref_first"><a href="http://maraphon.online/workout-example" target="_blank"><p>Пример тренировок</p></a></div>	
						   <br>
						   <div class="buy_button" id="buy_one_class_button"><p>Купить</p></div>
						   <input class="shop_checkbox" type="checkbox" id="buy_one_class" name="buy_one_class" value="buy_one_class">
						   <div class="shop_menu_success_button"><p>Заказ успешно оформлен</p></div>
						</div>
					</div>
					
					<div class="shop_block" id="shop_block_2">
						<div class="shop_header_block" id="shop_header_block_2"></div>
				    	<div class="shop_content_block" id="shop_content_block_2">
						<br>
						<h3>10 классов тренировок</h3>
					   		<p>
						       <strong>Что вы получите:</strong><br>
						        - 10 тренировочных классов сразу, каждый из которых состоит из 3 полноценных тренировок<br>
								- все тренировки в видеоформате с подробным обьяснением техники выполнения упражнения<br>
								- вы занимаетесь в любое удобное для вас время, так как все тренировки в записи<br>
								- тренировки имеют разные уровни сложности:<br>
								&nbsp;&nbsp;&nbsp;▪️ 1, 2 - легкий уровень<br>
								&nbsp;&nbsp;&nbsp;▪️ 3, 4, 5, 6 - средний уровень<br>
								&nbsp;&nbsp;&nbsp;▪️ 7, 8, 9, 10 - высокий уровень<br>
								<br>
							</p>
							<div class="shop_example_ref"><a href="http://maraphon.online/workout-example" target="_blank"><p>Пример тренировок</p></a></div>
						<br>
						   <div class="buy_button" id="buy_ten_class_button" style="background-color: #9d9d9d; cursor: default; pointer-events: none;"><p>Купить</p></div>
						   <input class="shop_checkbox" type="checkbox" id="buy_ten_class" name="buy_ten_class" value="buy_ten_class">
						   <div class="shop_menu_success_button"><p>Заказ успешно оформлен</p></div>
						</div>
					</div>';
					
					echo '
					<div class="shop_block" id="shop_block_3">
						<div class="shop_header_block" id="shop_header_block_3"></div>
				    	<div class="shop_content_block" id="shop_content_block_3">
						<br>
						<h3>Класс "Пресс"</h3>
				   		<p>
					       <strong>Что вы получите:</strong><br>
						    - тренировочный класс акцентированный на проработку мышц пресса<br>
							- класс состоит из 3 полноценных тренировок, которые приведут ваши мышцы в тонус, а при сочетании с правильным питанием более рельефным<br>
							Уровень сложности:<br>
							▪️ Легкий<br>
							✅ Средний<br>
							▪️ Сложный<br>       
						</p>
						<div class="shop_example_ref"><a href="http://maraphon.online/workout-example" target="_blank"><p>Пример тренировок</p></a></div>
						<br>
						   <div class="buy_button" id="buy_press_class_button" style="background-color: #9d9d9d; cursor: default; pointer-events: none;"><p>Купить</p></div>
						   <input class="shop_checkbox" type="checkbox" id="buy_press_class" name="buy_press_class" value="buy_press_class">
						   <div class="shop_menu_success_button"><p>Заказ успешно оформлен</p></div>
						</div>
					</div>
					
					<div class="shop_block" id="shop_block_4">
						<div class="shop_header_block" id="shop_header_block_4"></div>
				    	<div class="shop_content_block" id="shop_content_block_4">
						<br>
						<h3>Класс "Ягодицы"</h3>
				   		<p>
					       <strong>Что вы получите:</strong><br>
						    - тренировочный класс акцентированный на проработку ягодиц<br>
							- класс состоит из 3 полноценных тренировок, которые сделают ваши ягодицы максимально окуглыми и подтянутыми<br>
							Уровень сложности:<br>
							▪️ Легкий<br>
							✅ Средний<br>
							▪️ Сложный<br>
						</p>
						<div class="shop_example_ref" id="shop_example_ref_last"><a href="http://maraphon.online/workout-example" target="_blank"><p>Пример тренировок</p></a></div>
						<br>
						   <div class="buy_button" id="buy_booty_class_button" style="background-color: #9d9d9d; cursor: default; pointer-events: none;"><p>Купить</p></div>
						   <input class="shop_checkbox" type="checkbox" id="buy_booty_class" name="buy_booty_class" value="buy_booty_class">
						   <div class="shop_menu_success_button"><p>Заказ успешно оформлен</p></div>
						</div>
					</div>							
				';
						
				echo '

					    <table class="register-main-table" id="shop-order-table" style="background-image: url();" >
						
						<tr style="height: 15px;">
							<td>
							<a class="close_result_user_for_admin" id="close_shop_order_table" title="Закрыть"> x</a>
							</td>
						</tr
						
						<tr>
						<td colspan="2"><p style="font-size: 20px; text-align: center">Для оформления заказа необходима регистрация<br>Пожалуйста, заполните короткую анкету</p></td>
						</tr>
						
						<tr>
						<th><label style="font-size: 36px;"><strong>Оформление заказа</strong></label></th>
						</tr>
						
						<tr>
						<th><label for="email">E-mail<strong> * </strong></label></th>
						<td><input type="text" name="email" value="' . (isset($_POST['email']) ? $email : null) . '"></td>
						</tr>
						
						<tr>
						<th><label for="password">Пароль<strong> * </strong><br></label><label style="font-size:14px;">(не менее 6 символов)</label></th>
						<td><input type="password" name="password" value="' . (isset($_POST['password']) ? $password : null) . '"></td>
						</tr>
		
						<script>
						    $(document).ready(function() {
						    $("#phone").mask("8-999-999-99-99");
						  });
						</script>
						
						<tr>
						<th><label for="telephone">Телефон<strong> * </strong></label></th>
						<td><input type="text" name="telephone" id="phone" value="' . (isset($_POST['telephone']) ? $telephone : null) . '"></td>
						</tr>
						
						<tr>
						<th><label for="first_name">Имя</label></th>
						<td><input type="text" name="first_name" value="' . (isset($_POST['first_name']) ? $first_name : null) . '"></td>
						</tr>
						
						<tr>
						<th><label for="last_name">Фамилия</label></th>
						<td><input type="text" name="last_name" value="' . (isset($_POST['last_name']) ? $last_name : null) . '"></td>
						</tr>
							
						<tr>
						<td><input type="submit" id="register_main_form_buy_button" name="submit" value="Отправить"/><td>
						</tr>
						
						<tr>
						<td>
						<p class="register_confidentional">Нажимая на кнопку, вы даете согласие на обработку своих персональных данных и соглашаетесь с <a href="http://maraphon.online/privacy-policy/" target="_blank">политикой конфиденциальности</a></p>
						</td>
						<td>
						</td>
						</tr>
						
						
						</table>
						';
				echo '	    				
				<div class="registration_table_bottom"></div>
				
				<div style="display:none">
						'.(isset($_POST['telegram']) ? $telegram : null).'
						'.(isset($_POST['men_menu']) ? $men_menu : null).'
						'.(isset($_POST['women_menu']) ? $women_menu : null).'
						'.(isset($_POST['recipe_book']) ? $recipe_book : null).'
						'.(isset($_POST['workout']) ? $workout : null).'
				</div>
				
				</form>  
				 
				</div>
				';
			} 

			function shop_validation( $password, $email, $telephone, $first_name, $last_name, $shop_workout_select_value, $buy_one_class, $buy_ten_class, $buy_press_class, $buy_booty_class )  {
			    global $reg_errors;
			    $reg_errors = new WP_Error;
			    $email = trim($email);
			
			    if ( empty( $password ) || empty( $email ) || empty( $telephone) || empty( $first_name) || empty( $last_name) ) {
			        $reg_errors->add('field', 'заполните обязательные поля');
			    }
				
			    if ( strlen( $password ) < 6 ) {
			        $reg_errors->add('password', 'пароль не может быть менее 6 символов');
			    }
						        
			    if ( !is_email( $email ) ) {
			        $reg_errors->add('email_invalid', 'адрес e-mail введено некорректно');
			    }
			
			    if ( email_exists( $email ) ) {
			        $reg_errors->add('email', 'адрес e-mail уже используется');
			    }
			    
			     if ( strlen( $telephone ) < 6 ) {
			        $reg_errors->add('telephone', 'номер телефона не может быть менее 6 символов');
			    }
			 
			    if ( is_wp_error( $reg_errors ) ) {
					echo '<div class="reg_error_div">';
			        foreach ( $reg_errors->get_error_messages() as $error ) {
			            echo '<div class="reg_error_message_1">';
			            echo '<strong>Ошибка</strong>: ';
			            echo $error . '<br/>';
			            echo '</div>';
			        }
			        echo '</div>';
			    }
			} 

			function complete_registration() {
			    global $wpdb, $reg_errors, $password, $email, $telephone, $first_name, $last_name, $shop_workout_select_value, $buy_one_class, $buy_ten_class, $buy_press_class, $buy_booty_class;
			    if ( count($reg_errors->get_error_messages()) < 1 ) {
			        $userdata_for_registration = array(
			        'user_login'	=> 	$email,
			        'user_email' 	=> 	$email,
			        'user_pass' 	=> 	$password,
			        'telephone' 	=> 	$telephone,
			        'first_name' 	=> 	$first_name,
			        'last_name' 	=> 	$last_name,
					);
					
					$date_func = current_time ('Y-m-d',0);
					
					if ($buy_one_class) {$order_workout_text = 'тренировки, класс '.$shop_workout_select_value.''; $amount = 300;}
						else if ($buy_ten_class) {$order_workout_text = 'тренировки, с 1 по 10 класс'; $amount = 1500;}
							else if ($buy_press_class) {$order_workout_text = 'тренировки, пресс'; $amount = 600;}
								else if ($buy_booty_class) {$order_workout_text = 'тренировки, ягодицы'; $amount = 600;};
								
					$class_1 = 0; $class_2 = 0; $class_3 = 0; $class_4 = 0; $class_5 = 0; $class_6 = 0; $class_7 = 0; $class_8 = 0; $class_9 = 0; $class_10 = 0;
					
					if ($shop_workout_select_value) {
						if ($shop_workout_select_value == '1') {$class_1 = 1;};
						if ($shop_workout_select_value == '2') {$class_2 = 1;};
						if ($shop_workout_select_value == '3') {$class_3 = 1;};
						if ($shop_workout_select_value == '4') {$class_4 = 1;};
						if ($shop_workout_select_value == '5') {$class_5 = 1;};
						if ($shop_workout_select_value == '6') {$class_6 = 1;};
						if ($shop_workout_select_value == '7') {$class_7 = 1;};
						if ($shop_workout_select_value == '8') {$class_8 = 1;};
						if ($shop_workout_select_value == '9') {$class_9 = 1;};
						if ($shop_workout_select_value == '10') {$class_10 = 1;};
					};
			        
			        $message  = sprintf(__('Здравствуйте, %s'), $first_name) . ",\n\n";
			        $message .= __('спасибо за ваш заказ и регистрацию на maraphon.online. Вы можете войти в личный кабинет, используя эти данные:') . "\n\n";
			        $message .= __('http://maraphon.online/lk') . "\n";
			        $message .= sprintf(__('Имя пользователя: %s'), $email) . "\n";
			        $message .= sprintf(__('Пароль: %s'), $password) . "\n\n";
			        $message .= __('Ваш заказ:') . "\n\n";
			        if (!empty($buy_one_class)){
				        $message .= __('- тренировки, класс '.$shop_workout_select.'') . "\n";
			        };
			        if (!empty($buy_ten_class)){
				        $message .= __('- тренировки с 1 по 10 класс') . "\n";
			        };
			        if (!empty($buy_press_class)){
				        $message .= __('- тренировки с акцентом на пресс') . "\n";
			        };
			        if (!empty($buy_booty_class)){
				        $message .= __('- тренировки с акцентом на ягодицы') . "\n";
			        };
			        $message .= __('') . "\n";
			        $message .= __('В течение часа (с 08:00 до 00:00 ежедневно) с вами свяжется администратор марафона для уточнения деталей заказа и оплаты. Пожалуйста, ожидайте. ') . "\n\n";
			        $message .= sprintf(__('Если у вас возникли какие-то вопросы с регистрацией или входом, пожалуйста, свяжитесь с администратором по e-mail: %s'), get_option('admin_email')) . " либо по телефону 8-909-549-60-86\n\n";
			        $message .= __('----------------------------------------') . "\n";
			        $message .= __('Maraphon Online от Екатерины Войтенко. Красивая фигура - это просто!');
			        wp_mail($email, 'Спасибо за ваш заказ', $message, $headers, $attachments);
			
			
					$phone= str_replace([' ', '(', ')', '-', '_'], '', $telephone);
					$phone_whatsapp = preg_replace('/^8/', '+7', $phone);
					$phone_mail = preg_replace('/^7/', '8', $phone);                    
			        $message_a .= sprintf(__('Имя: %s'), $first_name) . " ";
			        $message_a .= sprintf(__('%s'), $last_name) . "\n";
			        $message_a .= sprintf(__('Телефон: %s'), $phone_mail) . "\n";
			        $message_a .= sprintf(__('Почта: %s'), $email) . "\n\n";
			        $message_a .= __('Заказ:') . "\n\n";
			        if (!empty($buy_one_class)){
				        $message_a .= __('- тренировки, класс '.$shop_workout_select.'') . "\n";
			        };
			        if (!empty($buy_ten_class)){
				        $message_a .= __('- тренировки с 1 по 10 класс') . "\n";
			        };
			        if (!empty($buy_press_class)){
				        $message_a .= __('- тренировки с акцентом на пресс') . "\n";
			        };
			        if (!empty($buy_booty_class)){
				        $message_a .= __('- тренировки с акцентом на ягодицы') . "\n";
			        };
			        $message_a .= __('') . "\n";
			        $message_a .= sprintf(__('Написать клиенту в Whatsapp: https://api.whatsapp.com/send?phone=%s'), $phone_whatsapp) . "\n";
			        wp_mail('info@maraphon.online', 'Новый заказ с регистрацией на сайте', $message_a, $headers, $attachments);
			        		
						
					if ($buy_one_class == 'buy_one_class') {		
						$wpdb->insert(
							'wpux_orders_workout',
							array(
								'date' => $date_func,
								'telephone' => $telephone,
								'first_name' => $first_name,
								'last_name' => $last_name,
								'content' => $order_workout_text,
								'class_1' => $class_1,
								'class_2' => $class_2,
								'class_3' => $class_3,
								'class_4' => $class_4,
								'class_5' => $class_5,
								'class_6' => $class_6,
								'class_7' => $class_7,
								'class_8' => $class_8,
								'class_9' => $class_9,
								'class_10' => $class_10,
								'paid' => 0,
								'amount' => $amount,
								'admin_comment' => ''
							)
						);
						} else {
							$wpdb->insert(
							'wpux_orders_workout',
							array(
								'user_id' => $user_id,
								'date' => $date_func,
								'telephone' => $telephone,
								'first_name' => $first_name,
								'last_name' => $last_name,
								'content' => $order_workout_text,
								'paid' => 0,
								'amount' => $amount,
								'admin_comment' => ''
							)
						);
						};
						
					$user = wp_insert_user( $userdata_for_registration );
					
				} //окончание условия reg_errors
			} // окончание функции custom_shop_function()
		
		?>
		
	</div> <!-- shop_main_block -->
	


	</div>
	</main><!-- #main -->

<?php
get_footer();
