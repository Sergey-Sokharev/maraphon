<?php
/*
Template Name: shop
*/

get_header();
?>	
	<script src="<?php echo content_url() ?>/themes/maraphon/js/jquery.maskedinput.js"></script>
	<style>
			.ref_button {
				background-color: #fec300;
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
        		.ref_button {
				color: white;
				font-size: 36px;
				font-family: kelson;
				background-color: #fec300;
				margin-left: 216px;
				border-radius: 3px;
				border: 1px solid;
				border-color: #ccc #ccc #bbb;
				height: 54px;
				width: 238px;
				padding-top: 2px;
				padding-left: 28px;
				margin-top: -10px;
				}
				.ref_button a {
					color: white;
				}
				.ref_button a:hover {
				cursor: pointer;
				color: #252525;
				}
				#desktop_ref_button {
					margin-top: 20px;
				}
				#recipe_book_ref {
					width: 238px;
					margin-left: 216px;
					padding-left: 0px;
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
        		.ref_button {
				color: white;
				font-size: 36px;
				font-family: kelson;
				background-color: #fec300;
				margin-left: 173px;
				border-radius: 3px;
				border: 1px solid;
				border-color: #ccc #ccc #bbb;
				height: 54px;
				width: 238px;
				padding-top: 2px;
				padding-left: 28px;
				margin-top: -10px;
				}
				.ref_button a {
					color: white;
				}
				.ref_button a:hover {
				cursor: pointer;
				color: #252525;
				}
				#desktop_ref_button {
					margin-top: 48px;
				}
				#recipe_book_ref {
					margin-bottom: 5px;
					width: 238px;
					padding-left: 0px;
				}
				#recipe_b {
					height: 54px;
				}
				#ref_button_workout {
					margin-top: 47px;
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
					if ($(window).width() < 1279) {
						$("#shop_header_block_4").css("marginTop", "-120px");
						$("#shop_header_block_4").css("marginLeft", "158px");
					} else {
						$("#shop_header_block_4").css("marginTop", "-120px");
						$("#shop_header_block_4").css("marginLeft", "116px");
						
					}
				});
		</script>		

	<main id="primary" class="site-main" >
	
	<div class="shop_main_block">
		<h1 class="shop_h1">Интернет-магазин maraphon.online</h1>
		
					<div class="shop_block" id="shop_block_1">
				    	<div class="shop_header_block" id="shop_header_block_1">
				    	</div>
				    	<div class="shop_content_block" id="shop_content_block_1">
					    	<br>
							<h3>Записаться на марафон</h3>
							<br>
					   		<p>
						       <strong>Что вы получите:</strong><br>
						       - доступ к меню на <strong>28 дней</strong><br>
						       - более <strong>30 тренировок</strong> для дома в видео формате. Тренировки доступны в любое удобное для вас время<br>
							   - общий чат в WhatsApp с мотивацией и поддержкой 24/7<br>
						       - разбор продуктов в наших супермаркетах<br>
						       - Telegram-канал с библиотекой знаний о питании<br>
						       - <strong>удобную</strong> подачу информации в личном кабинете<br>
							</p>
						<!--	<div class="ref_button" style="background-color: #f27557;"><a href="http://maraphon.online/register/">Записаться</a></div> -->
							<div class="ref_button" style="background-color: #f27557;"><a href="http://maraphon.online/shop/maraphon/">Подробнее</a></div> 
						</div>
					</div>
					
					
					
				    <div class="shop_block" id="shop_block_2">
				    	<div class="shop_header_block" id="shop_header_block_2">
				    	</div>
				    	<div class="shop_content_block" id="shop_content_block_2">
					    	<br>
							<h3>Меню на 30 дней</h3>
							<br>
					   		<p>
						       <strong>Что вы получите:</strong><br>
						       - <strong>30 дней</strong> сбалансированного питания<br>
						       - более <strong>100 простых</strong> в приготовлении блюд<br>
						       - <strong>огромное</strong> количество замены продуктов<br>
						       - <strong>инструкцию</strong>, как правильно работать с моим меню, чтобы добиться желаемого результата<br>
						       - <strong>удобную</strong> подачу информации в личном кабинете<br>
						       - все продукты приобретаются в <strong>ближайшем</strong> супермаркете<br>
							</p>
							<div class="ref_button" style="background-color: #f27557;"><a href="http://maraphon.online/shop/menu/">&nbsp;&nbsp;&nbsp;&nbsp;Купить</a></div>
						</div>
					</div>
		
					<div class="shop_block" id="shop_block_3">
						<div class="shop_header_block" id="shop_header_block_3"></div>
				    	<div class="shop_content_block" id="shop_content_block_3">
						<br>
						<h3>Тренировки онлайн</h3>
						<br>
				   		<p>
					       <strong>Что вы получите:</strong><br>
						    - программу состоящую из трех полноценных тренировок для дома<br>
							- видео-формат формат тренировочного процесса<br>
							- возможность использовать их в удобное для вас время<br>
							- тренировки имеют разные уровни сложности в зависимости от подготовки<br>
							<br>
						</p>
							<div class="ref_button" id="ref_button_workout" style="background-color: #f27557;"><a href="http://maraphon.online/shop/workout/">Подробнее</a></div>
							<!-- <div class="ref_button" id="desktop_ref_button" style="padding-left: 5px;"><p>В процессе</p></div> -->
						</div>
					</div>
					
					<?php
						if ( is_user_logged_in() ) {
					 	custom_main_shop_confirmation_function();
						} else {
						custom_main_shop_registration_function();
						};
					
			function custom_main_shop_confirmation_function() {
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
								if (sendOrderValue == "recipe_book") {
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
					<div class="shop_block" id="shop_block_4">
						<div class="shop_header_block" id="shop_header_block_4"></div>
				    	<div class="shop_content_block" id="shop_content_block_4">
						<br>
						<h3><strong>Сборник рецептов</strong></h3>
						<br>
				   		<p>
					       <strong>Что вы получите:</strong><br>
					       - <strong>каталог</strong> лучших рецептов марафона<br>
					       - более <strong>80 простых</strong> в приготовлении блюд<br>
						   - все продукты приобретаются в <strong>ближайшем</strong> супермаркете<br>
						   - <strong>минимальное</strong> время приготовления рецептов<br>
						   <br>
						</p>
						<div class="shop_example_ref" id="recipe_book_ref"><a href="http://maraphon.online/recipe-book-example" target="_blank"><p>Пример книги</p></a></div>
						<br>
						<div class="buy_button" id="recipe_book"><p>Купить</p></div>
						<div class="shop_success_button"><p>Заказ успешно оформлен</p></div>
						<div class="shop_fail_button"><p>Ошибка отправки заказа,<br>свяжитесь с администратором</p></div>
						</div>
					</div>
					
					</form>
				';
				};
				
				function custom_main_shop_registration_function() {
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
		        $_POST['recipe_book'],
		        $_POST['workout'],
				); 
				
		        global $username, $password, $email, $telephone, $first_name, $last_name, $telegram, $recipe_book, $workout ;
		        $password 	= 	esc_attr($_POST['password']);
		        $email 		= 	sanitize_email($_POST['email']);
		        $telephone 	= 	sanitize_text_field($_POST['telephone']);
		        $first_name = 	sanitize_text_field($_POST['first_name']);
		        $last_name = 	sanitize_text_field($_POST['last_name']);
		        $telegram = 	sanitize_text_field($_POST['telegram']);
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
		        $recipe_book,
		        $workout
				);
			}

			function registration_form( $password, $email, $telephone, $first_name, $last_name, $telegram, $recipe_book, $workout ) {
				
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
		        
				$(document).on("click", "#recipe_b", function (e) {
		            var $checkbox = $("#recipe_book");
		            if (e.target !== $checkbox[0]) {
		            $checkbox.prop("checked", !$checkbox.prop("checked"));
		            }
		            
		            if ($("#recipe_book").prop("checked")) {
						$(".shop_block").removeClass("changebox");
						$("#shop_block_4").addClass("changebox");
						$("#shop-order-table").show();
						$("#shop_content_block_4").css("marginTop", "0px");
						$("#shop_content_block_4").css("marginLeft", "0px");
					} else {
						$("#shop_block_4").removeClass("changebox");
						};
						if ($(window).width() < 1279) {
							$("#shop-order-table").css("marginTop", "2525px");
							$("#shop_header_block_4").css("marginLeft", "153px");
							$("#shop_header_block_4").css("marginTop", "-125px");
						} else {
							$("#shop-order-table").css("marginTop", "790px");
							$("#shop_header_block_4").css("marginLeft", "111px");
							$("#shop_header_block_4").css("marginTop", "-125px");
						}
		        });   
		        
		        </script>
			    
			    	<form action="' . $_SERVER['REQUEST_URI'] . '" method="post" id="shop_main_form">
		
					<div class="shop_block" id="shop_block_4">
						<div class="shop_header_block" id="shop_header_block_4"></div>
				    	<div class="shop_content_block" id="shop_content_block_4">
						<br>
						<h3><strong>Сборник рецептов</strong></h3>
						<br>
				   		<p>
					       <strong>Что вы получите:</strong><br>
					       - <strong>каталог</strong> лучших рецептов марафона<br>
					       - более <strong>80 простых</strong> в приготовлении блюд<br>
						   - все продукты приобретаются в <strong>ближайшем</strong> супермаркете<br>
						   - <strong>минимальное</strong> время приготовления рецептов<br>
						   <br>
						</p>
						<div class="shop_example_ref" id="recipe_book_ref"><a href="http://maraphon.online/recipe-book-example" target="_blank"><p>Пример книги</p></a></div>
						<br>
						<div class="buy_button" id="recipe_b"><p>Купить</p></div>
						<input class="shop_checkbox" type="checkbox" id="recipe_book" name="recipe_book" value="recipe_book">
						<div class="shop_success_button"><p>Заказ успешно оформлен</p></div>
						<div class="shop_fail_button"><p>Ошибка отправки заказа,<br>свяжитесь с администратором</p></div>
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
						'.(isset($_POST['recipe_book']) ? $recipe_book : null).'
						'.(isset($_POST['workout']) ? $workout : null).'
				</div>
				
				</form>  
				 
				</div>
				';
			} 

			function shop_validation( $password, $email, $telephone, $first_name, $last_name, $telegram, $recipe_book, $workout )  {
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
			    global $wpdb, $reg_errors, $password, $email, $telephone, $first_name, $last_name, $telegram, $recipe_book, $workout;
			    if ( count($reg_errors->get_error_messages()) < 1 ) {
			        $userdata_for_registration = array(
			        'user_login'	=> 	$email,
			        'user_email' 	=> 	$email,
			        'user_pass' 	=> 	$password,
			        'telephone' 	=> 	$telephone,
			        'first_name' 	=> 	$first_name,
			        'last_name' 	=> 	$last_name,
			        'recipe_book_lk' => $recipe_book,
			        'telegram_lk' => $telegram,
					);
			        
			        $message  = sprintf(__('Здравствуйте, %s'), $first_name) . ",\n\n";
			        $message .= __('спасибо за ваш заказ и регистрацию на maraphon.online. Вы можете войти в личный кабинет, используя эти данные:') . "\n\n";
			        $message .= __('http://maraphon.online/lk') . "\n";
			        $message .= sprintf(__('Имя пользователя: %s'), $email) . "\n";
			        $message .= sprintf(__('Пароль: %s'), $password) . "\n\n";
			        $message .= __('Ваш заказ:') . "\n\n";
			        if (!empty($telegram)){
				        $message .= __('- подписка на telegram-канал') . "\n";
			        };
			        if (!empty($recipe_book)){
				        $message .= __('- книга рецептов') . "\n";
				        $content = 'Книга рец.';
				        $amount = 500;
			        };
			        if (!empty($workout)){
				        $message .= __('- тренировки в зале') . "\n";
			        };
			        if (!empty($amount)){
				        $message .= __('--------------------------------------') . "\n";
				        $message .= __('Стоимость заказа - 500р.') . "\n";
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
			        if (!empty($telegram)){
				        $message_a .= __('- подписка на telegram-канал') . "\n";
			        };
			        if (!empty($recipe_book)){
				        $message_a .= __('- книга рецептов') . "\n";
			        };
			        if (!empty($workout)){
				        $message_a .= __('- тренировки в зале') . "\n";
			        };
			        if (!empty($amount)){
				        $message_a .= __('--------------------------------------') . "\n";
				        $message_a .= __('Стоимость заказа - 500р.') . "\n";
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
						'telegram' => $telegram,
						'recipe_book' => $recipe_book,
						'workout' => $workout,
						'credit' => 0,
						'paid' => 0,
						'amount' => 500,
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
