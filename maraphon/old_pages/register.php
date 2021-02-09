<?php
/*
Template Name: register
*/


get_header();
?>	
	<script src="<?php echo content_url() ?>/themes/maraphon/js/jquery.maskedinput.js"></script>
	<style>
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
			}	
			@media screen and (min-width:1279px){  
				.opacity-line {
				position: absolute;
				height: 70px;
				width: 1280px;
				background-color: #d5d5d5;
				margin-top: 90px;
        		}
			}
			
	</style>

	<main id="primary" class="site-main" >
		<script>
		$("#maraphon_next,#telegram,#recipe_book,#workout").prop('checked',false);
		
		$(document).on('click', '.register-sale-block-2', function (e) {
            var $checkbox = $(':checkbox', this);
            if (e.target !== $checkbox[0]) {
            $checkbox.prop('checked', !$checkbox.prop('checked'));
            
            }
            if ($('#maraphon_next').prop('checked')) {
			$(".register-sale-block-2").addClass("changebox");	
			} else {
			$(".register-sale-block-2").removeClass("changebox");
			}
        });
        
        $(document).ready(function(){
		$(".women_menu,.men_menu").on('change', function() {
		if(
		$("#women_menu_1").prop('checked') ||
		$("#women_menu_2").prop('checked') ||
		$("#women_menu_3").prop('checked') ||
		$("#women_menu_4").prop('checked') ||
		$("#women_menu_5").prop('checked') ||
		$("#men_menu_1").prop('checked') ||
		$("#men_menu_2").prop('checked') ||
		$("#men_menu_3").prop('checked') ||
		$("#men_menu_4").prop('checked') ||
		$("#men_menu_5").prop('checked')
		){
		$(".register-sale-block-4").addClass("changebox");
		} else {
        $(".register-sale-block-4").removeClass("changebox");
    	}
		});
		});	
		
		$(document).on('click', '.register-sale-block-5', function (e) {
            var $checkbox = $(':checkbox', this);
            if (e.target !== $checkbox[0]) {
            $checkbox.prop('checked', !$checkbox.prop('checked'));
            }
            if ($('#telegram').prop('checked')) {
			$(".register-sale-block-5").addClass("changebox");	
			} else {
			$(".register-sale-block-5").removeClass("changebox");
			}
        });
        
        $(document).on('click', '.register-sale-block-6', function (e) {
            var $checkbox = $(':checkbox', this);
            if (e.target !== $checkbox[0]) {
            $checkbox.prop('checked', !$checkbox.prop('checked'));
            
            }
            if ($('#recipe_book').prop('checked')) {
			$(".register-sale-block-6").addClass("changebox");	
			} else {
			$(".register-sale-block-6").removeClass("changebox");
			}
        });
        
         $(document).on('click', '.register-sale-block-8', function (e) {
            var $checkbox = $(':checkbox', this);
            if (e.target !== $checkbox[0]) {
            $checkbox.prop('checked', !$checkbox.prop('checked'));
            
            }
            if ($('#workout').prop('checked')) {
			$(".register-sale-block-8").addClass("changebox");	
			} else {
			$(".register-sale-block-8").removeClass("changebox");
			}
        });
		</script>

		<div class="register-main">
        <h1>СТРОЙНОЕ ТЕЛО И ПРАВИЛЬНЫЕ ПРИВЫЧКИ</h1>
     
 <?php   
				global $check_orders;
				$current_user = wp_get_current_user();
				$user_id = $current_user->ID;
				$user_email = $current_user->user_email;
				$check_orders_this_month = $wpdb->get_results(
						"
						SELECT
						orders.date,
						orders.user_id,
						orders.maraphon_next_month
						FROM wpux_orders orders
						WHERE orders.user_email = '$user_email'
						AND orders.maraphon_next_month LIKE '%марафон%'
						ORDER BY orders.date DESC
						LIMIT 1
						"
						);	
				foreach ( $check_orders_this_month as $string ) {
			        	
			        	$check_orders_array = $string->date;	
			    };
			    
			    $check_orders = substr($check_orders_array, 5, 2);

	if ( is_user_logged_in() ) {
	 	custom_confirmation_function();
	} else {
		custom_registration_function();	
	}; 
		
			//--------------------- Начало условия is_user_logged_in() ------------------------//
			function custom_confirmation_function() {
			$_monthsList = array(
						"1"=>"январь","2"=>"февраль","3"=>"март",
						"4"=>"апрель","5"=>"май", "6"=>"июнь",
						"7"=>"июль","8"=>"август","9"=>"сентябрь",
						"10"=>"октябрь","11"=>"ноябрь","12"=>"декабрь");
			$n = current_time("m")+ 1 > 12 ? 1 : current_time("m")+1;
			$next_month = $_monthsList[$n];
			$year = current_time("m") + 1 > 12 ? current_time("Y") +1 : current_time("Y");	
				
		    if (isset($_POST['submit'])) {
		        confirmation_validation(
		        $_POST['maraphon_next_month'],
		        $_POST['telegram'],
		        $_POST['women_menu'],
		        $_POST['men_menu'],
		        $_POST['recipe_book'],
		        $_POST['workout'],
				); 
				
		        global $maraphon_next_month, $telegram, $women_menu, $men_menu, $recipe_book, $workout ;
		        $maraphon_next_month = 	'марафон на '.$next_month.' '.$year.'г.';
		        $telegram = 	sanitize_text_field($_POST['telegram']);
		        $women_menu = 	sanitize_text_field($_POST['women_menu']);
		        $men_menu = 	sanitize_text_field($_POST['men_menu']);
		        $recipe_book = 	sanitize_text_field($_POST['recipe_book']);
		        $workout = 	sanitize_text_field($_POST['workout']);
		       
		        complete_confirmation(
		        $maraphon_next_month,
		        $telegram,
		        $women_menu,
		        $men_menu,
		        $recipe_book,
		        $workout
				);
		    }
		
		    confirmation_form(
		        $maraphon_next_month,
		        $telegram,
		        $women_menu,
		        $men_menu,
		        $recipe_book,
		        $workout
				);
			}

			function confirmation_form( $maraphon_next_month, $telegram, $women_menu, $men_menu, $recipe_book, $workout ) {
				
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
						$nn = current_time("m")+ 2 > 13 ? 2 : current_time("m")+2;
						$nnext_month = $_monthsList[$nn];
						$year = current_time("m") + 1 > 12 ? current_time("Y") +1 : current_time("Y");
						
			    echo '
			    <form action="' . $_SERVER['REQUEST_URI'] . '" method="post" id="register_main_form">
				    <div class="register-sale-block">
				    
				    	<div class="register-sale-block-1">
				    		<h3>О МАРАФОНЕ</h3>';
				    		//echo '<h3>Старт 29 '.$this_month_padezh.'';
				    		echo '<h3>Старт 3 или 9 января';
				    		echo'<br>
					    		Длительность 30 дней
					    		<br>
					    		Что вас ждет:
					    	</h3>
					    	<p>	
					    	    - доступ к меню на 30 дней<br>
					    		- возможность получить доступ к меню на 30 дней для ваших мужчин<br>
					    		- более 30 тренировок для дома в видео формате. Тренировки доступны в любое удобное для вас время<br>
					    		- общий чат в WhatsApp с мотивацией и поддержкой 24/7<br>
					    		- работа с психологом<br>
					    		- разбор более 300 вопросов на тему фитнеса и здорового образа жизни<br>
					    	</p>
					    	<h3>
					    		Поговорим о:
					    	</h3>
					    	<p>
					    		- витаминах и добавках<br>
					    		- кишечнике и проблемах, связанных с ним<br>
					    		- сахаре и сахарозаменителях<br>
					    		- красоте и молодости<br>
					    		- здоровье волос<br>
				    		</p>
				    		
				    		<h3 class="register_white_border_h3">
				    			Это только небольшой список тем, которые мы разберем на марафоне!
				    		</h3>
						</div>
						';
						
						//Отключаем регистрацию на марафон 29 числа каждого месяца, +0 оставил для теста в верстке
						if ((current_time("j") + 0) > 31) {
							echo '
								<div class="register-sale-block-2">				
							            <h3 class="register_cost_h3">СТОИМОСТЬ МАРАФОНА<br>1500 РУБЛЕЙ</h3>
										<p class="register_maraphon_phrase_1">
							    			Присоединяйся к нашей дружной команде!
							    		</p>
							    </div> 
					   
							</div>
							
							<div class="registration_closed">
								<h1>Регистрация на '.$next_month.' '.$year.' закрыта</h1>
								<p>Регистрация на '.$nnext_month.' '.$next_year.' открывается 1 '.$next_month_padezh.'</p>
							</div>
							
							';
						} else { //регистрация открыта до 29 числа
							echo '
								<div class="register-sale-block-2">				
							            <h3 class="register_cost_h3">СТОИМОСТЬ МАРАФОНА<br>1500 РУБЛЕЙ</h3>
										<p class="register_maraphon_phrase_1">
							    			Присоединяйся к нашей дружной команде!
							    		</p>
								</div> 
					   
							</div>
							';
						global $check_orders;
		
						    if ( $check_orders == current_time("m") ) {
							    echo '<p class="confirmation_maraphon_phrase_2" style="font-size: 20px;">Оплату за марафон следующего месяца необходимо внести до 27 числа</p>';
							    echo'<input type="submit" style="background-color: #ddf7c8" disabled id="desktop_confirmation_button" name="submit" value="Заявка успешно отправлена"/>';
								echo '</div>';
						    } else {
							    echo '<p class="confirmation_maraphon_phrase_2" style="font-size: 20px;">Для участия в следующем марафоне просто нажмите кнопку "Отправить заявку".</p>';
							    echo '<input type="submit" id="desktop_confirmation_button" name="submit" value="Отправить заявку"/>';
							    echo '<p class="register_confidentional_confirm">Нажимая на кнопку, вы даете согласие на обработку своих персональных данных и соглашаетесь с <a href="http://maraphon.online/privacy-policy/" target="_blank">политикой конфиденциальности</a></p>';
							    echo '</div>';
									
						    };

						};
			 
				echo '
				 <div style="display:none">
						'.(isset($_POST['maraphon_next_month']) ? $maraphon_next_month : null).'
						'.(isset($_POST['telegram']) ? $telegram : null).'
						'.(isset($_POST['women_menu']) ? $women_menu : null).'
						'.(isset($_POST['men_menu']) ? $men_menu : null).'
						'.(isset($_POST['recipe_book']) ? $recipe_book : null).'
						'.(isset($_POST['workout']) ? $workout : null).'
				</div>
				
				</form>
				
				<div class="registration_table_bottom"></div>
				
				';
			} 

			function confirmation_validation( $maraphon_next_month, $telegram, $women_menu, $men_menu, $recipe_book, $workout )  {
			    global $reg_errors;
			    $reg_errors = new WP_Error;
			
							 
			    if ( is_wp_error( $reg_errors ) ) {
			        foreach ( $reg_errors->get_error_messages() as $error ) {
			            echo '<div class="reg_error_message">';
			            echo '<strong>Ошибка</strong>: ';
			            echo $error . '<br/>';
			            echo '</div>';
			        } 
			    } 
			} 

			function complete_confirmation() {
			    global $wpdb, $reg_errors, $maraphon_next_month, $telegram, $women_menu, $men_menu, $recipe_book, $workout ;
			    if ( count($reg_errors->get_error_messages()) < 1 ) {
				    
				    $current_user = wp_get_current_user();
				    $user_id = $current_user->ID;
				    $first_name = $current_user->user_firstname;
				    $last_name = $current_user->user_lastname;
					$telephone = $current_user->telephone;
					$next_month_confirm = current_time("m")+ 1 > 12 ? 1 : current_time("m")+1;
					$next_year_confirm = current_time("m") + 1 > 12 ? current_time("Y") +1 : current_time("Y");
					$maraphon_member_month = $next_month_confirm.'.'.$next_year_confirm;	
					$email = $current_user->user_email;
					$date_func = current_time ('Y-m-d',0);
					
					$check_maraphone_register = $wpdb->get_var( 
						"
						SELECT
						COUNT(*)
						FROM wpux_orders
						WHERE user_id = $user_id
			            AND DATE(date) = '$date_func'
			            AND wpux_orders.maraphon_next_month LIKE '%марафон%'
						"	
						);
						
						
					if ( ($check_maraphone_register == 0) && ($user_id > 0) && (!empty($user_id)) ) {
  
			        $message  = sprintf(__('Здравствуйте, %s'), $first_name) . ",\n\n";
			        $message .= __('спасибо за ваш заказ на maraphon.online!') . "\n\n";

			        $message .= __('Ваш заказ:') . "\n\n";
			        if (!empty($maraphon_next_month)){
				        $message .= sprintf(__(' - %s'), $maraphon_next_month) . "\n";
			        };
			        $message .= __('') . "\n";
			        $message .= __('В течение часа (с 08:00 до 00:00 ежедневно) с вами свяжется администратор марафона для уточнения деталей заказа и оплаты. Пожалуйста, ожидайте. ') . "\n\n";
			        $message .= sprintf(__('Если у вас возникли какие-то вопросы с оформлением заказа, пожалуйста, свяжитесь с администратором по e-mail: %s'), get_option('admin_email')) . " либо по телефону 8-909-549-60-86\n\n";
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
			        if (!empty($maraphon_next_month)){
				        $message_a .= sprintf(__(' - %s'), $maraphon_next_month) . "\n";
			        };
			        $message_a .= __('') . "\n";
			        $message_a .= sprintf(__('Написать клиенту в Whatsapp: https://api.whatsapp.com/send?phone=%s'), $phone_whatsapp) . "\n";
			        wp_mail('info@maraphon.online', 'Новый заказ на сайте', $message_a, $headers, $attachments);
			        		
						if (empty(get_the_author_meta( 'maraphon_counter', $user_id ))){
								update_user_meta( $user_id, 'maraphon_counter', '0' );
						};
						
						$wpdb->insert(
						'wpux_orders',
						array(
						'user_id' => $user_id,
						'date' => $date_func,	
						'user_email' => $email,
						'telephone' => $telephone,
						'first_name' => $first_name,
						'last_name' => $last_name,
						'maraphon_next_month' => $maraphon_next_month,
						'maraphon_member_month' => $maraphon_member_month,
						'women_menu' => $women_menu,
						'men_menu' => $men_menu,
						'telegram' => $telegram,
						'recipe_book' => $recipe_book,
						'workout' => $workout,
						'paid' => 0,
						'amount' => 0,
						'admin_comment' => '',
						'director_comment' => ''
						)
						); 
						echo '<div class="success_confirm_message">';
			            echo '<strong>Заявка успешно отправлена</strong> ';
			            echo '</div>';
			            };
				}
			} // окончание функции custom_confirmation_function()

			
			
			//--------------------- Начало условия else is_user_logged_in() ------------------------//
			function custom_registration_function() {
			$_monthsList = array(
						"1"=>"январь","2"=>"февраль","3"=>"март",
						"4"=>"апрель","5"=>"май", "6"=>"июнь",
						"7"=>"июль","8"=>"август","9"=>"сентябрь",
						"10"=>"октябрь","11"=>"ноябрь","12"=>"декабрь");
			$n = current_time("m")+ 1 > 12 ? 1 : current_time("m")+1;
			$next_month = $_monthsList[$n];
			$year = current_time("m") + 1 > 12 ? current_time("Y") +1 : current_time("Y");	
		    if (isset($_POST['submit'])) {
		        registration_validation(
		        $_POST['password'],
		        $_POST['email'],
		        $_POST['telephone'],
		        $_POST['first_name'],
		        $_POST['last_name'],
		        $_POST['maraphon_next_month'],
		        $_POST['telegram'],
		        $_POST['women_menu'],
		        $_POST['men_menu'],
		        $_POST['recipe_book'],
		        $_POST['workout'],
				); 
				
		        global $username, $password, $email, $telephone, $first_name, $last_name, $maraphon_next_month, $telegram, $women_menu, $men_menu, $recipe_book, $workout ;
		        $password 	= 	esc_attr($_POST['password']);
		        $email 		= 	sanitize_email($_POST['email']);
		        $telephone 	= 	sanitize_text_field($_POST['telephone']);
		        $first_name = 	sanitize_text_field($_POST['first_name']);
		        $last_name = 	sanitize_text_field($_POST['last_name']);
		        $maraphon_next_month = 	'марафон на '.$next_month.' '.$year.'г.';
		        $telegram = 	sanitize_text_field($_POST['telegram']);
		        $women_menu = 	sanitize_text_field($_POST['women_menu']);
		        $men_menu = 	sanitize_text_field($_POST['men_menu']);
		        $recipe_book = 	sanitize_text_field($_POST['recipe_book']);
		        $workout = 	sanitize_text_field($_POST['workout']);
		       
		        complete_registration(
		        $username,
		        $password,
		        $email,
		        $telephone,
		        $first_name,
		        $last_name,
		        $maraphon_next_month,
		        $telegram,
		        $women_menu,
		        $men_menu,
		        $recipe_book,
		        $workout
				);
		    }
		
		    registration_form(
		        $password,
		        $email,
		        $telephone,
		        $first_name,
		        $last_name,
		        $maraphon_next_month,
		        $telegram,
		        $women_menu,
		        $men_menu,
		        $recipe_book,
		        $workout
				);
			}

			function registration_form( $password, $email, $telephone, $first_name, $last_name, $maraphon_next_month, $telegram, $women_menu, $men_menu, $recipe_book, $workout ) {
				
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
						$nn = current_time("m")+ 2 > 13 ? 2 : current_time("m")+2;
						$next_year = current_time("m") + 2 > 12 ? current_time("Y") +1 : current_time("Y");
						$nnext_month = $_monthsList[$nn];
						$year = current_time("m") + 1 > 12 ? current_time("Y") +1 : current_time("Y");
						
			    echo '
			    <form action="' . $_SERVER['REQUEST_URI'] . '" method="post" id="register_main_form">
				    <div class="register-sale-block">
				    
				    	<div class="register-sale-block-1">
				    		<h3>О МАРАФОНЕ</h3>';
				    		//echo '<h3>Старт 29 '.$this_month_padezh.'';
				    		echo '<h3>Старт 3 или 9 января';
				    		echo'<br>
					    		Длительность 30 дней
					    		<br>
					    		Что вас ждет:
					    	</h3>
					    	<p>	
					    	    - доступ к меню на 30 дней<br>
					    		- возможность получить доступ к меню на 30 дней для ваших мужчин<br>
					    		- более 30 тренировок для дома в видео формате. Тренировки доступны в любое удобное для вас время<br>
					    		- общий чат в WhatsApp с мотивацией и поддержкой 24/7<br>
					    		- работа с психологом<br>
					    		- разбор более 300 вопросов на тему фитнеса и здорового образа жизни<br>
					    	</p>
					    	<h3>
					    		Поговорим о:
					    	</h3>
					    	<p>
					    		- витаминах и добавках<br>
					    		- кишечнике и проблемах, связанных с ним<br>
					    		- сахаре и сахарозаменителях<br>
					    		- красоте и молодости<br>
					    		- здоровье волос<br>
				    		</p>
				    		
				    		<h3 class="register_white_border_h3">
				    			Это только небольшой список тем, которые мы разберем на марафоне!
				    		</h3>
						</div>
						';
						
						//Отключаем регистрацию на марафон 29 числа каждого месяца, +0 оставил для теста в верстке
						if ((current_time("j") + 0) > 31) {
							echo '
								<div class="register-sale-block-2">				
							            <h3 class="register_cost_h3">СТОИМОСТЬ МАРАФОНА<br>1500 РУБЛЕЙ</h3>
										<p class="register_maraphon_phrase_1">
							    			Присоединяйся к нашей дружной команде!
							    		</p>
							    </div> 
					   
							</div>
							
							<div class="registration_closed">
								<h1>Регистрация на '.$next_month.' '.$year.' закрыта</h1>
								<p>Регистрация на '.$nnext_month.' '.$next_year.' открывается 1 '.$next_month_padezh.'</p>
							</div>
							
							';
						} else { //регистрация открыта до 29 числа
							echo '
								<div class="register-sale-block-2">				
							            <h3 class="register_cost_h3">СТОИМОСТЬ МАРАФОНА<br>1500 РУБЛЕЙ</h3>
										<p class="register_maraphon_phrase_1">
							    			Присоединяйся к нашей дружной команде!
							    		</p>
									    <p class="register_maraphone_phrase_3">
									    	Для удобного использования сайта maraphon.online необходима регистрация. Пожалуйста, заполните короткую форму и нажмите кнопку "Зарегистрироваться". 
										</p>
							    </div> 
					   
							</div> 
					    
					    <table class="register-main-table" >
						
						<tr style="height: 15px;">
						</tr
						
						<tr>
						<th><label style="font-size: 36px;"><strong>Регистрация</strong></label></th>
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
						<td><input type="text" maxlength="15" name="first_name" value="' . (isset($_POST['first_name']) ? $first_name : null) . '"></td>
						</tr>
						
						<tr>
						<th><label for="last_name">Фамилия</label></th>
						<td><input type="text" maxlength="20" name="last_name" value="' . (isset($_POST['last_name']) ? $last_name : null) . '"></td>
						</tr>
							
						<tr>
						<td><input type="submit" id="register_main_form_buy_button" name="submit" value="Зарегистрироваться"/><td>
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

						};
				
				echo '	    				
				<div class="registration_table_bottom"></div>
				
				<div style="display:none">
						'.(isset($_POST['maraphon_next_month']) ? $maraphon_next_month : null).'
						'.(isset($_POST['telegram']) ? $telegram : null).'
						'.(isset($_POST['women_menu']) ? $women_menu : null).'
						'.(isset($_POST['men_menu']) ? $men_menu : null).'
						'.(isset($_POST['recipe_book']) ? $recipe_book : null).'
						'.(isset($_POST['workout']) ? $workout : null).'
				</div>
				
				</form>  
				 
				</div>
				';
			} 

			function registration_validation( $password, $email, $telephone, $first_name, $last_name, $maraphon_next_month, $telegram, $women_menu, $men_menu, $recipe_book, $workout )  {
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
			    global $wpdb, $reg_errors, $password, $email, $telephone, $first_name, $last_name, $maraphon_next_month, $telegram, $women_menu, $men_menu, $recipe_book, $workout ;
			    if ( count($reg_errors->get_error_messages()) < 1 ) {
			        $userdata_for_registration = array(
			        'user_login'	=> 	$email,
			        'user_email' 	=> 	$email,
			        'user_pass' 	=> 	$password,
			        'telephone' 	=> 	$telephone,
			        'first_name' 	=> 	$first_name,
			        'last_name' 	=> 	$last_name,
			        'maraphon_counter' => 0,
			        'workout_class' => 'Нет',
					);
					
					$next_month_reg = current_time("m")+ 1 > 12 ? 1 : current_time("m")+1;
					$next_year_reg = current_time("m") + 1 > 12 ? current_time("Y") +1 : current_time("Y");
					$maraphon_member_month = $next_month_reg.'.'.$next_year_reg;
			        
			        $message  = sprintf(__('Здравствуйте, %s'), $first_name) . ",\n\n";
			        $message .= __('спасибо за ваш заказ и регистрацию на maraphon.online. Вы можете войти в личный кабинет, используя эти данные:') . "\n\n";
			        $message .= __('http://maraphon.online/lk') . "\n";
			        $message .= sprintf(__('Имя пользователя: %s'), $email) . "\n";
			        $message .= sprintf(__('Пароль: %s'), $password) . "\n\n";
			        $message .= __('Ваш заказ:') . "\n\n";
			        if (!empty($maraphon_next_month)){
				        $message .= sprintf(__(' - %s'), $maraphon_next_month) . "\n";
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
			        if (!empty($maraphon_next_month)){
				        $message_a .= sprintf(__(' - %s'), $maraphon_next_month) . "\n";
			        };
			        $message_a .= __('') . "\n";
			        $message_a .= sprintf(__('Написать клиенту в Whatsapp: https://api.whatsapp.com/send?phone=%s'), $phone_whatsapp) . "\n";
			        wp_mail('info@maraphon.online', 'Новый заказ с регистрацией на сайте', $message_a, $headers, $attachments);
			        		
						
						$date_func = current_time ('Y.m.d',0);
						$wpdb->insert(
						'wpux_orders',
						array( 
						'date' => $date_func,	
						'user_email' => $email,
						'telephone' => $telephone,
						'first_name' => $first_name,
						'last_name' => $last_name,
						'maraphon_next_month' => $maraphon_next_month,
						'maraphon_member_month' => $maraphon_member_month,
						'women_menu' => $women_menu,
						'men_menu' => $men_menu,
						'telegram' => $telegram,
						'recipe_book' => $recipe_book,
						'workout' => $workout,
						'credit' => 0,
						'paid' => 0,
						'amount' => 1500,
						'admin_comment' => '',
						'director_comment' => ''
						)
						); 
						
					$user = wp_insert_user( $userdata_for_registration );
					
				} //окончание условия reg_errors
			} // окончание функции custom_registrationation_function()
			
			
//Окончание условия else is_user_logged_in()
?>			
	
<script>
$('#group_menu_men input:checkbox').click(function(){
	
	if ($(this).is(':checked')) {
		 $('#group_menu_men input:checkbox').not(this).prop('checked', false);
	}
});
    
$('#group_menu_women input:checkbox').click(function(){
	if ($(this).is(':checked')) {
		 $('#group_menu_women input:checkbox').not(this).prop('checked', false);
	}
});
</script>		

	</div>	
	</div>
	</main><!-- #main -->

<?php
get_footer();
