<?php
/*
Template Name: shop-menu
*/

get_header();
?>	
	<script src="<?php echo content_url() ?>/themes/maraphon/js/jquery.maskedinput.js"></script>
	<style>
			#shop_header_block_1 {
				background-image: url(/wp-content/uploads/maraphon_price.png);
			}
		
			#shop_header_block_2 {
				background-image: url(/wp-content/uploads/price-1500.png);
			}
			
			.shop_example_ref {
				margin-top: -20px;
				padding-left: 18px;
			}
			.shop_menu_success_button {
				margin-top: -62px;
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
        		#shop_block_1 {
	        		height: 720px;
        		}
        		
        		#shop_block_2 {
	        		margin-bottom: 0px;
	        		height: 720px;
        		}
        		.shop_main_block {
	        		height: 1810px;
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
        		.shop_block {
	        		margin-bottom: 0px;
        		}
        		#shop_block_1 {
	        		height: 645px;
        		}
        		
        		#shop_block_2 {
	        		height: 645px;
        		}
        		.shop_main_block {
	        		height: 890px;
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
					$("#shop_header_block_1").css("marginTop", "-131px");
					$("#shop_header_block_2").css("marginTop", "-137px");
					if ($(window).width() < 1279) {
						$("#shop_header_block_1").css("marginLeft", "158px");
						$("#shop_header_block_2").css("marginLeft", "158px");
					} else {
						$("#shop_header_block_1").css("marginLeft", "116px");
						$("#shop_header_block_2").css("marginLeft", "116px");
					}
				});
	</script>		

	<main id="primary" class="site-main" >
	
	<div class="shop_main_block">
		<h1 class="shop_h1">Интернет-магазин maraphon.online</h1>
		
		<?php
		if ( is_user_logged_in() ) {
	 	custom_shop_confirmation_function();
		} else {
		custom_shop_registration_function();
		};
		
		function custom_shop_confirmation_function() {
			echo '
				<script type="text/javascript">
				$(function() {
				   function sendOrderByShop(){
					  var sendOrderValue = this.id;
					    $.ajaxSetup({cache: false});
				        $.ajax({
						    type:"POST",
							url: "/wp-admin/admin-ajax.php",
							data: {action: "sendOrderByShop",
							sendOrderValue,
							},
							success:function(data){
								if (sendOrderValue == "women_menu") {
									$("#shop_content_block_1" + " .shop_menu_success_button").show();
								} else if (sendOrderValue == "men_menu") {
									$("#shop_content_block_2" + " .shop_menu_success_button").show();
								} else if (sendOrderValue == "recipe_book") {
									$("#shop_content_block_3" + " .shop_success_button").show();
								} else if (sendOrderValue == "telegram") {
									$("#shop_content_block_4" + " .shop_success_button").show();
								};
								$("#primary").empty();
								$("#primary").html(data);
							}
						});
							return false;
						}
						$(".buy_button").click(sendOrderByShop);
						});
				</script>
			
			<form id="shop_main_form">
				    <div class="shop_block" id="shop_block_1">
				    	<div class="shop_header_block" id="shop_header_block_1">
				    	
				    	</div>
				    	<div class="shop_content_block" id="shop_content_block_1">
					    	<br>
							<h3>Меню на 30 дней для женщин</h3>
					   		<p>
						       <strong>Что вы получите:</strong><br>
						       - <strong>30 дней</strong> сбалансированного питания<br>
						       - более <strong>100 простых</strong> в приготовлении блюд<br>
						       - <strong>огромное</strong> количество замены продуктов<br>
						       - <strong>инструкцию</strong>, как правильно работать с моим меню, чтобы добиться желаемого результата<br>
						       - все продукты для меню приобретаются в <strong>ближайшем</strong> супермаркете<br>
						       - <strong>удобную</strong> подачу информации в личном кабинете<br>
						       <div class="shop_example_ref"><a href="http://maraphon.online/menu-example" target="_blank"><p style="padding-left: 4px;">Пример меню</p></a></div>
							</p>
								<div class="buy_button" id="women_menu"><p>Купить</p></div>
						</div>
					</div>
		
					<div class="shop_block" id="shop_block_2">
						<div class="shop_header_block" id="shop_header_block_2"></div>
				    	<div class="shop_content_block" id="shop_content_block_2">
						<br>
						<h3>Меню на 30 дней для мужчин</h3>
				   		<p>
					       <strong>Что вы получите:</strong><br>
						   - <strong>30 дней</strong> сбалансированного питания<br>
						   - более <strong>100 простых</strong> в приготовлении блюд<br>
						   - <strong>огромное</strong> количество замены продуктов<br>
						   - <strong>инструкцию</strong>, как правильно работать с моим меню, чтобы добиться желаемого результата<br>
						   - все продукты для меню приобретаются в <strong>ближайшем</strong> супермаркете<br>
						   - <strong>удобную</strong> подачу информации в личном кабинете<br>
						   <div class="shop_example_ref"><a href="http://maraphon.online/menu-example" target="_blank"><p style="padding-left: 4px;">Пример меню</p></a></div>
						</p>
							<div class="buy_button" id="men_menu"><p>Купить</p></div>
						</div>
					</div>
					
			</div>
			</form>						
			';
		};
		
		function custom_shop_registration_function() {
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
		        $_POST['telegram'],
		        $_POST['women_menu'],
		        $_POST['men_menu'],
		        $_POST['recipe_book'],
		        $_POST['workout'],
				); 
				
		        global $username, $password, $email, $telephone, $first_name, $last_name, $telegram, $women_menu, $men_menu, $recipe_book, $workout ;
		        $password 	= 	esc_attr($_POST['password']);
		        $email 		= 	sanitize_email($_POST['email']);
		        $telephone 	= 	sanitize_text_field($_POST['telephone']);
		        $first_name = 	sanitize_text_field($_POST['first_name']);
		        $last_name = 	sanitize_text_field($_POST['last_name']);
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
		        $telegram,
		        $women_menu,
		        $men_menu,
		        $recipe_book,
		        $workout
				);
			}

			function registration_form( $password, $email, $telephone, $first_name, $last_name, $telegram, $women_menu, $men_menu, $recipe_book, $workout ) {
				
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
			    $(document).on("click", "#women_m", function (e) {
		            var $checkbox = $("#women_menu");
		            if (e.target !== $checkbox[0]) {
		            $checkbox.prop("checked", !$checkbox.prop("checked"));
		            }
		            if ($("#women_menu").prop("checked")) {
			        $(".shop_block").removeClass("changebox");
					$("#shop_block_1").addClass("changebox");
					$("#shop-order-table").show();
					$("#shop_content_block_1").css("marginTop", "0px");
					$("#shop_content_block_1").css("marginLeft", "0px");
					$("#shop_header_block_1").css("marginTop", "-136px");
					} else {
					$("#shop_block_1").removeClass("changebox");
					};
					if ($(window).width() < 1279) {
						$("#shop-order-table").css("marginTop", "-1458px");
						$("#shop_header_block_1").css("marginLeft", "153px");
					} else {
						$("#shop-order-table").css("marginTop", "-508px");
						$("#shop_header_block_1").css("marginLeft", "111px");
					}
		        });
		        
				$(document).on("click", "#men_m", function (e) {
		            var $checkbox = $("#men_menu");
		            if (e.target !== $checkbox[0]) {
		            $checkbox.prop("checked", !$checkbox.prop("checked"));
		            }
		            if ($("#men_menu").prop("checked")) {
					$(".shop_block").removeClass("changebox");
					$("#shop_block_2").addClass("changebox");
					$("#shop-order-table").show();
					
					$("#shop_content_block_2").css("marginTop", "0px");
					$("#shop_content_block_2").css("marginLeft", "0px");
					$("#shop_header_block_2").css("marginTop", "-142px");
						
					} else {
					$("#shop_block_2").removeClass("changebox");
					};
					if ($(window).width() < 1279) {
						$("#shop-order-table").css("marginTop", "-628px");
						$("#shop_header_block_2").css("marginLeft", "153px");
					} else {
						$("#shop-order-table").css("marginTop", "-508px");
						$("#shop_header_block_2").css("marginLeft", "111px");
					}
		        });
		        
		        </script>
			    
			    <form action="' . $_SERVER['REQUEST_URI'] . '" method="post" id="shop_main_form">
				    <div class="shop_block" id="shop_block_1">
				    	<div class="shop_header_block" id="shop_header_block_1"></div>
				    	<div class="shop_content_block" id="shop_content_block_1">
					    	<br>
							<h3>Меню на 30 дней для женщин</h3>
					   		<p>
						       <strong>Что вы получите:</strong><br>
						       - <strong>30 дней</strong> сбалансированного питания<br>
						       - более <strong>100 простых</strong> в приготовлении блюд<br>
						       - <strong>огромное</strong> количество замены продуктов<br>
						       - <strong>инструкцию</strong>, как правильно работать с моим меню, чтобы добиться желаемого результата<br>
						       - все продукты для меню приобретаются в <strong>ближайшем</strong> супермаркете<br>
						       - <strong>удобную</strong> подачу информации в личном кабинете<br>
						       <div class="shop_example_ref"><a href="http://maraphon.online/menu-example" target="_blank"><p style="padding-left: 4px;">Пример меню</p></a></div>
							</p>
							<div class="buy_button" id="women_m"><p>Купить</p></div>
							<input class="shop_checkbox" type="checkbox" id="women_menu" name="women_menu" value="women_menu">
						</div>
					</div>
		
					<div class="shop_block" id="shop_block_2">
						<div class="shop_header_block" id="shop_header_block_2"></div>
				    	<div class="shop_content_block" id="shop_content_block_2">
						<br>
						<h3>Меню на 30 дней для мужчин</h3>
				   		<p>
					       <strong>Что вы получите:</strong><br>
						   - <strong>30 дней</strong> сбалансированного питания<br>
						   - более <strong>100 простых</strong> в приготовлении блюд<br>
						   - <strong>огромное</strong> количество замены продуктов<br>
						   - <strong>инструкцию</strong>, как правильно работать с моим меню, чтобы добиться желаемого результата<br>
						   - все продукты для меню приобретаются в <strong>ближайшем</strong> супермаркете<br>
						   - <strong>удобную</strong> подачу информации в личном кабинете<br>
						   <div class="shop_example_ref"><a href="http://maraphon.online/menu-example" target="_blank"><p style="padding-left: 4px;">Пример меню</p></a></div>
						</p>
						<div class="buy_button" id="men_m"><p>Купить</p></div>
						<input class="shop_checkbox" type="checkbox" id="men_menu" name="men_menu" value="men_menu">
						</div>
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

			function shop_validation( $password, $email, $telephone, $first_name, $last_name, $telegram, $women_menu, $men_menu, $recipe_book, $workout )  {
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
			    global $wpdb, $reg_errors, $password, $email, $telephone, $first_name, $last_name, $telegram, $women_menu, $men_menu, $recipe_book, $workout ;
			    if ( count($reg_errors->get_error_messages()) < 1 ) {
			        $userdata_for_registration = array(
			        'user_login'	=> 	$email,
			        'user_email' 	=> 	$email,
			        'user_pass' 	=> 	$password,
			        'telephone' 	=> 	$telephone,
			        'first_name' 	=> 	$first_name,
			        'last_name' 	=> 	$last_name,
			        'men_menu_lk' => $men_menu,
			        'women_menu_lk' => $women_menu,
			        'recipe_book_lk' => $recipe_book,
			        'telegram_lk' => $telegram,
					);
			        
			        $message  = sprintf(__('Здравствуйте, %s'), $first_name) . ",\n\n";
			        $message .= __('спасибо за ваш заказ и регистрацию на maraphon.online. Вы можете войти в личный кабинет, используя эти данные:') . "\n\n";
			        $message .= __('http://maraphon.online/lk') . "\n";
			        $message .= sprintf(__('Имя пользователя: %s'), $email) . "\n";
			        $message .= sprintf(__('Пароль: %s'), $password) . "\n\n";
			        $message .= __('Ваш заказ:') . "\n\n";
			        if (!empty($women_menu)){
				        $message .= __('- женское меню') . "\n";
				        $content = 'Жен. меню';
				        $amount = 1500;
			        };
			        if (!empty($men_menu)){
				        $message .= __('- мужское меню') . "\n";
				        $content = 'Муж. меню';
				        $amount = 1500;
			        };
			        if (!empty($telegram)){
				        $message .= __('- подписка на telegram-канал') . "\n";
			        };
			        if (!empty($recipe_book)){
				        $message .= __('- книга рецептов') . "\n";
			        };
			        if (!empty($workout)){
				        $message .= __('- тренировки в зале') . "\n";
			        };
			        $message .= __('') . "\n";
			        $message .= __('В течение часа (с 09:00 до 00:00 ежедневно) с вами свяжется администратор марафона для уточнения деталей заказа и оплаты. Пожалуйста, ожидайте. ') . "\n\n";
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
			        if (!empty($women_menu)){
				        $message_a .= __('- женское меню') . "\n";
			        };
			        if (!empty($men_menu)){
				        $message_a .= __('- мужское меню') . "\n";
			        };
			        if (!empty($telegram)){
				        $message_a .= __('- подписка на telegram-канал') . "\n";
			        };
			        if (!empty($recipe_book)){
				        $message_a .= __('- книга рецептов') . "\n";
			        };
			        if (!empty($workout)){
				        $message_a .= __('- тренировки в зале') . "\n";
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
						'men_menu' => $men_menu,
						'women_menu' => $women_menu,
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
						
						$wpdb->insert(
						'wpux_orders_menu',
						array(
						'date' => $date_func,	
						'user_email' => $email,
						'telephone' => $telephone,
						'first_name' => $first_name,
						'last_name' => $last_name,
						'content' => $content,
						'credit' => 0,
						'paid' => 0,
						'amount' => $amount,
						'admin_comment' => '',
						'director_comment' => ''
						)
						);
						
					$user = wp_insert_user( $userdata_for_registration );
					
				} //окончание условия reg_errors
			} // окончание функции custom_shop_function()
		
		?>
		
	</div> <!-- shop_main_block -->
	


	</div>
	</main><!-- #main -->

<?php
get_footer();
