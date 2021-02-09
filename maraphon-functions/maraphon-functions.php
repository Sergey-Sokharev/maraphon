<?php
/**
 * Plugin Name: Maraphon Theme Functions
 * Plugin URI: http://maraphon.online
 * Description: Набор функций для реализации личного кабинета темы "Марафон"
 * Author: Сергей Сохарев
 * Version: 1.1
 * Text Domain: maraphon
 * License: free
 * License URI: http://maraphon.online
 */





// ----------- Обработчик кнопки отправить сообщение в чат /chat ----------- 
function sendMessageToChat() {
		global $wpdb;
		$user_message = $_POST['inputMessage'];
		$user_id = 1;
		$time = current_time ("H:i:s");
		$first_name = 'Сергей';
		$last_name = 'Сохарев';
		$like_counter = 10;
		$wpdb->insert(
						'wpux_chat',
						array(
						'user_id' => $user_id,
						'time' => $time,	
						'first_name' => $first_name,
						'last_name' => $last_name,
						'message' => $user_message,
						'like_counter' => $like_counter
						)
						);  
		
		$result = $wpdb->get_results( 
						"
						SELECT *
						FROM wpux_chat
						ORDER BY wpux_chat.time DESC limit 1
						"	
						); 
						
						if( $result ) {
						    foreach ( $result as $string ) {
							 echo '<p>';
							 echo $string->time.' ';
							 echo $string->first_name.' ';
							 echo $string->last_name.' пишет:';
							 echo ' '.$string->message.'</p>';
							 
						};
						};
		die();
		}
add_action('wp_ajax_sendMessageToChat', 'sendMessageToChat');
add_action('wp_ajax_nopriv_sendMessageToChat', 'sendMessageToChat');

function updateChat() {
		global $wpdb;
		$resultUpdate = $wpdb->get_results( 
						"
						SELECT *
						FROM wpux_chat
						ORDER BY wpux_chat.time DESC limit 1
						"	
						); 
						
						if( $resultUpdate ) {
						    foreach ( $result as $string1 ) {
							 echo '<p>';
							 echo $string1->time.' ';
							 echo $string1->first_name.' ';
							 echo $string1->last_name.' пишет:';
							 echo ' '.$string1->message.'</p>';
							 
						};
						};
		die();
		}
add_action('wp_ajax_updateChat', 'updateChat');
add_action('wp_ajax_nopriv_updateChatt', 'updateChat');

 /* Отключение уведомления на почту info@maraphon.online о смене пароля пользователем */ 
 if ( ! function_exists( 'wp_password_change_notification' ) ) { function wp_password_change_notification( $user ) { return; } } 

/* Меняем картинку логотипа WP в админке 
function my_admin_logo() {
   echo '<style type="text/css">#header-logo { background:url('.get_bloginfo('template_directory').'/images/favicon.png) no-repeat 0 0 !important; }</style>';
}
add_action('admin_head', 'my_admin_logo');  */

/* Отключение ревизий всех типов записей */
function my_revisions_to_keep( $revisions ) {
    return 0;
}
add_filter( 'wp_revisions_to_keep', 'my_revisions_to_keep' );
 
/* Меняем картинку логотипа WP на странице входа */
function my_login_logo(){
   echo '<style type="text/css">#login h1 a { background-image: url(http://maraphon.online/wp-admin/images/login-logo.png) !important; }</style>';
}
add_action('login_head', 'my_login_logo');

/* Ставим ссыллку с логотипа на сайт, а не на wordpress.org */
add_filter( 'login_headerurl', create_function('', 'return get_home_url();') );

/* Убираем title в логотипе "сайт работает на wordpress" */
add_filter( 'login_headertitle', create_function('', 'return false;') );

// ----------- Обработчик кнопки купить /shop/ и /shop/menu ----------- 
function sendOrderByShop(){
				global $wpdb;
				    $current_user = wp_get_current_user();
				    $user_id = $current_user->ID;
				    $first_name = $current_user->user_firstname;
				    $last_name = $current_user->user_lastname;
					$telephone = $current_user->telephone;
					$email = $current_user->user_email;
					$date_func = current_time ('Y-m-d',0);
					$order_value = ($_POST['sendOrderValue']);
					
					if ($order_value == 'women_menu') {$women_menu = 'women_menu'; $content = 'Жен. меню'; $amount = 1500; update_user_meta( $user_id, 'women_menu_lk', $women_menu );} else {$women_menu = '';};
					if ($order_value == 'men_menu') {$men_menu = 'men_menu'; $content = 'Муж. меню'; $amount = 1500; update_user_meta( $user_id, 'men_menu_lk', $men_menu );} else {$men_menu = '';};
					if ($order_value == 'recipe_book') {$recipe_book = 'recipe_book'; $content = 'Книга рец.'; $amount = 500; update_user_meta( $user_id, 'recipe_book_lk', $recipe_book );} else {$recipe_book = '';};
					if ($order_value == 'telegram') {$telegram = 'telegram'; $content = 'Телеграм'; $amount = 300; update_user_meta( $user_id, 'telegram_lk', $telegram );} else {$telegram = '';};
	
					$_monthsList = array(
						"1"=>"январь","2"=>"февраль","3"=>"март",
						"4"=>"апрель","5"=>"май", "6"=>"июнь",
						"7"=>"июль","8"=>"август","9"=>"сентябрь",
						"10"=>"октябрь","11"=>"ноябрь","12"=>"декабрь");
						
					$n = current_time("m")+ 1 > 12 ? 1 : current_time("m")+1;
					$next_month = $_monthsList[$n];
					$year = current_time("m") + 1 > 12 ? current_time("Y") +1 : current_time("Y");
					
					$check_recipe_book = $wpdb->get_var( 
						"
						SELECT
						COUNT(*)
						FROM wpux_orders
						WHERE user_id = $user_id
			            AND DATE(date) = '$date_func'
			            AND wpux_orders.recipe_book is not NULL
						"	
					);
					$check_men_menu = $wpdb->get_var( 
						"
						SELECT
						COUNT(*)
						FROM wpux_orders
						WHERE user_id = $user_id
			            AND DATE(date) = '$date_func'
			            AND wpux_orders.men_menu is not NULL
						"	
					);
					$check_women_menu = $wpdb->get_var( 
						"
						SELECT
						COUNT(*)
						FROM wpux_orders
						WHERE user_id = $user_id
			            AND DATE(date) = '$date_func'
			            AND wpux_orders.women_menu is not NULL
						"	
					);
					
					if ($order_value == 'recipe_book' && $check_recipe_book == 1) {$check_recipe_book_buy = 1;};
					if ($order_value == 'men_menu' && $check_men_menu == 1) {$check_men_menu_buy = 1;};
					if ($order_value == 'women_menu' && $check_women_menu == 1) {$check_women_menu_buy = 1;};
						
					if ( ($check_recipe_book_buy == 0 || $check_men_menu_buy == 0 || $check_women_menu_buy == 0) && ($user_id > 0) && (!empty($user_id)) ) {
  
			        $message  = sprintf(__('Здравствуйте, %s'), $first_name) . ",\n\n";
			        $message .= __('спасибо за ваш заказ на maraphon.online!') . "\n\n";

			        $message .= __('Ваш заказ:') . "\n\n";

			        if (!empty($women_menu)){
				        $message .= __(' - женское меню') . "\n";
			        };
			        if (!empty($men_menu)){
				         $message .= __(' - мужское меню') . "\n";
			        };
			        if (!empty($telegram)){
				         $message .= __(' - подписка на 30 дней на Telegram-канал') . "\n";
			        };
			        if (!empty($recipe_book)){
				         $message .= __(' - книга рецептов') . "\n";
				         $recipe_book_thank_you = 'Наш замечательный сборник рецептов вы получаете после оплаты в виде .pdf файлов в Whatsapp';
			        };
			        if (!empty($workout)){
				        $message .= __(' - тренировки в зале') . "\n";
			        };
			        if (!empty($amount)){
				        $message .= __('--------------------------------------') . "\n";
				        $message .= __('Стоимость заказа - '.$amount.'р.') . "\n";
			        };
			        $message .= __('') . "\n";
			        $message .= __('В течение часа (с 09:00 до 00:00 ежедневно) с вами свяжется администратор марафона для уточнения деталей заказа и оплаты. Пожалуйста, ожидайте. ') . "\n\n";
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
			        
			        if (!empty($women_menu)){
				        $message_a .= __(' - женское меню') . "\n";
			        };
			        if (!empty($men_menu)){
				         $message_a .= __(' - мужское меню') . "\n";
			        };
			        if (!empty($telegram)){
				         $message_a .= __(' - подписка на 30 дней на Telegram-канал') . "\n";
			        };
			        if (!empty($recipe_book)){
				         $message_a .= __(' - книга рецептов') . "\n";
			        };
			        if (!empty($workout)){
				        $message_a .= __(' - тренировки в зале') . "\n";
			        };
			        if (!empty($amount)){
				        $message_a .= __('--------------------------------------') . "\n";
				        $message_a .= __('Стоимость заказа - '.$amount.'р.') . "\n";
			        };
			        $message_a .= __('') . "\n";
			        $message_a .= sprintf(__('Написать клиенту в Whatsapp: https://api.whatsapp.com/send?phone=%s'), $phone_whatsapp) . "\n";
			        wp_mail('info@maraphon.online', 'Новый заказ на сайте', $message_a, $headers, $attachments);
			        		
						$wpdb->insert(
						'wpux_orders',
						array(
						'user_id' => $user_id,
						'date' => $date_func,	
						'user_email' => $email,
						'telephone' => $telephone,
						'first_name' => $first_name,
						'last_name' => $last_name,
						'women_menu' => $women_menu,
						'men_menu' => $men_menu,
						'recipe_book' => $recipe_book,
						'telegram' => $telegram,
						'credit' => 0,
						'paid' => 0,
						'amount' => $amount,
						'admin_comment' => '',
						'director_comment' => ''
						)
						);
						
						$wpdb->insert(
						'wpux_orders_menu',
						array(
						'user_id' => $user_id,
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
						
						$check_men_menu_to_buy = $wpdb->get_var(				 //проверка для вывода меню для покупателей мужского меню через таблицу wpux_orders_menu
							"
							SELECT
							COUNT(*)
							FROM wpux_orders_menu menu
							WHERE menu.user_id = $user_id
							AND menu.paid = 1
							AND menu.content LIKE '%Муж%'
						"
						);  
						
						if ($check_men_menu_to_buy > 0) {
							$show_men_menu_tab = 1;
						};
						
						if (is_user_role('administrator', $user_id) || is_user_role('content_1', $user_id)) {
							$show_admin_tab = 1;
						};
										
						if ($show_men_menu_tab = 1 || $show_admin_tab = 1) {
							$thank_you_report_link = 'http://maraphon.online/lk/#tab6';
							} else {
								$thank_you_report_link = 'http://maraphon.online/lk/#tab5';	
							};
						echo'
						<div class="thank_you_page_content">
							<style>
							@media screen and (max-width:1279px){
								.opacity-line {
								    position: absolute;
								    height: 65px;
								    width: 720px;
								    background-color: #717171;
								    display: block !important;
								    margin-top: 90px;
								    z-index: 9;
								}
							}
							@media screen and (min-width:1279px){
								.opacity-line {
							        position: absolute;
							        height: 70px;
							        width: 1280px;
							        background-color: #717171;
							        margin-top: 90px;
							        z-index: 998;
							    }
							}
							</style>
							<h1 class="thank_you_page_h1">Спасибо за Ваш заказ на maraphon.online!</h1>
							<div class="grey_line"></div>
							<p class="thank_you_page_p" id="thank_you_page_admin">Администратор Наталья свяжется с вами в течение часа (с 09:00 до 00:00, МСК+4 Новосибирск)</p>
							<p class="thank_you_page_p">В дальнейшем все вопросы по оплате, предоставлению доступа и работе сайта можно задавать ей.</p>
							<p class="thank_you_page_p"><a href="https://api.whatsapp.com/send?phone=+79095496086" target="_blank" class="thank_you_page_p_wa">Нажмите, чтобы сохранить ее номер в Whatsapp</a></p>
							<br>
							<br>';
							
							if ($recipe_book_thank_you) {
								echo '<p class="thank_you_page_p">'.$recipe_book_thank_you.'</p>';
								echo '<p class="thank_you_page_p">Приятного аппетита!</p>';
							} else {
							echo'
							<p class="thank_you_page_p">Доступ к меню предоставляется на 30 дней. Пожалуйста, не забудьте обновить вашу анкету. <a href="'.$thank_you_report_link.'" target="_blank" class="thank_you_page_p_a">Нажмите для обновления</a></p>
							<p class="thank_you_page_p">Актуальные данные анкеты необходимы для индивидуального подбора меню по вашим параметрам</p>
							';
							};
							echo '<div class="grey_line"></div>
							<h2 class="thank_you_page_h2">Марафон онлайн от Екатерины Войтенко. Красивая фигура - это просто</h2>
						</div>';
							
					};	//конец условия if ($check_next_month_order == 0)	
		die();
		}
add_action('wp_ajax_sendOrderByShop', 'sendOrderByShop');
add_action('wp_ajax_nopriv_sendOrderByShop', 'sendOrderByShop');

// ----------- Обработчик кнопки купить /shop/maraphon ----------- 
function sendOrderByShopMaraphon(){
				global $wpdb;
				    $current_user = wp_get_current_user();
				    $user_id = $current_user->ID;
				    $date_func = current_time ('Y-m-d',0);
				    $email = $current_user->user_email;
				    $telephone = $current_user->telephone;
				    $first_name = $current_user->user_firstname;
				    $last_name = $current_user->user_lastname;
				    $order_maraphon_value = ($_POST['sendOrderMaraphonValue']);
					if ($order_maraphon_value == 'profy_maraphon') {$order_maraphon_text = 'пакет "Профи"'; $amount = 1500;}
						else if ($order_maraphon_value == 'newbie_light_maraphon') {$order_maraphon_text = 'пакет "Новичок Лайт"'; $amount = 1900;}
							else if ($order_maraphon_value == 'newbie_maraphon') {$order_maraphon_text = 'пакет "Новичок"'; $amount = 2500;}
								else if ($order_maraphon_value == 'family_maraphon') {$order_maraphon_text = 'пакет "Семейный"'; $amount = 3400;} 
									else if ($order_maraphon_value == 'vip_maraphon') {$order_maraphon_text = 'пакет "VIP"'; $amount = 5500;};
					$_monthsList = array(
						"1"=>"январь","2"=>"февраль","3"=>"март",
						"4"=>"апрель","5"=>"май", "6"=>"июнь",
						"7"=>"июль","8"=>"август","9"=>"сентябрь",
						"10"=>"октябрь","11"=>"ноябрь","12"=>"декабрь");
					$next_month_confirm = current_time("n") + 1 > 12 ? 1 : current_time("n") + 1;
					$mail_month = $_monthsList[$next_month_confirm];
					if ($next_month_confirm < 10) {$next_month_confirm = '0'.$next_month_confirm;};
					$next_year_confirm = current_time("n") + 1 > 12 ? current_time("Y") + 1 : current_time("Y");
					$maraphon_member_month = $next_month_confirm.'.'.$next_year_confirm;
					$mail_period = $mail_month.' '.$next_year_confirm.'г.';
					
					$check_maraphone_register = $wpdb->get_var( 
						"
						SELECT
						COUNT(*)
						FROM wpux_orders
						WHERE user_id = $user_id
			            AND DATE(date) = '$date_func'
			            AND wpux_orders.maraphon_next_month LIKE '%пакет%'
						"	
						);
						
					if ( ($check_maraphone_register == 0) && ($user_id > 0) && (!empty($user_id)) ) {
  
			        $message  = sprintf(__('Здравствуйте, %s'), $first_name) . ",\n\n";
			        $message .= __('спасибо за ваш заказ на maraphon.online!') . "\n\n";

			        $message .= __('Ваш заказ:') . "\n\n";

			        if (!empty($order_maraphon_text)){
				        $message .= __(' - '.$order_maraphon_text.', марафон на '.$mail_period) . "\n";
			        };
			        if (!empty($amount)){
				        $message .= __('--------------------------------------') . "\n";
				        $message .= __('Стоимость заказа - '.$amount.'р.') . "\n";
			        };
			        $message .= __('') . "\n";
			        $message .= __('В течение часа (с 09:00 до 00:00 ежедневно) с вами свяжется администратор марафона для уточнения деталей заказа и оплаты. Пожалуйста, ожидайте. ') . "\n\n";
			        $message .= sprintf(__('Если у вас возникли какие-то вопросы с оформлением заказа, пожалуйста, свяжитесь с администратором по e-mail: %s'), get_option('admin_email')) . " либо в Whatsapp 8-909-549-60-86\n\n";
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
			        
			        if (!empty($order_maraphon_text)){
				        $message_a .= __(' - '.$order_maraphon_text.', марафон на '.$mail_period) . "\n";
			        };
			        if (!empty($amount)){
				        $message_a .= __('--------------------------------------') . "\n";
				        $message_a .= __('Стоимость заказа - '.$amount.'р.') . "\n";
			        };
			        $message_a .= __('') . "\n";
			        $message_a .= sprintf(__('Написать клиенту в Whatsapp: https://api.whatsapp.com/send?phone=%s'), $phone_whatsapp) . "\n";
			        wp_mail('info@maraphon.online', 'Новый заказ на сайте', $message_a, $headers, $attachments);
			        		
						$wpdb->insert(
							'wpux_orders',
							array(
								'user_id' => $user_id,
								'date' => $date_func,	
								'user_email' => $email,
								'telephone' => $telephone,
								'first_name' => $first_name,
								'last_name' => $last_name,
								'maraphon_next_month' => $order_maraphon_text,
								'maraphon_member_month' => $maraphon_member_month,
								'credit' => 0,
								'paid' => 0,
								'amount' => $amount,
								'curator' => 'Екатерина',
								'admin_comment' => '',
								'director_comment' => ''
							)
						);
						
						if ($order_maraphon_value == 'family_maraphon') {
							$men_menu = 'men_menu';
							$amount = 0;
							update_user_meta( $user_id, 'men_menu_lk', $men_menu );
							$wpdb->insert(
								'wpux_orders',
								array(
									'user_id' => $user_id,
									'date' => $date_func,	
									'user_email' => $email,
									'telephone' => $telephone,
									'first_name' => $first_name,
									'last_name' => $last_name,
									'men_menu' => $men_menu,
									'credit' => 0,
									'paid' => 0,
									'amount' => $amount,
									'admin_comment' => 'Пакет Семейный',
									'director_comment' => 'Пакет Семейный'
								)
							);
						};
						
						if (
							is_user_role('administrator', $current_user->ID) ||
							get_the_author_meta( 'men_menu_lk', $current_user->ID ) == 'men_menu_1600' || 																												
							get_the_author_meta( 'men_menu_lk', $current_user->ID ) == 'men_menu_1800' || 
							get_the_author_meta( 'men_menu_lk', $current_user->ID ) == 'men_menu_2000' || 
							get_the_author_meta( 'men_menu_lk', $current_user->ID ) == 'men_menu_2200' || 
							get_the_author_meta( 'men_menu_lk', $current_user->ID ) == 'men_menu_2500' 
						) {
							$thank_you_report_link = 'http://maraphon.online/lk/#tab6';
							} else {
								$thank_you_report_link = 'http://maraphon.online/lk/#tab5';	
							};
						echo'
						<div class="thank_you_page_content">
							<style>
							@media screen and (max-width:1279px){
								.opacity-line {
								    position: absolute;
								    height: 65px;
								    width: 720px;
								    background-color: #717171;
								    display: block !important;
								    margin-top: 90px;
								    z-index: 9;
								}
							}
							@media screen and (min-width:1279px){
								.opacity-line {
							        position: absolute;
							        height: 70px;
							        width: 1280px;
							        background-color: #717171;
							        margin-top: 90px;
							        z-index: 998;
							    }
							}
							</style>
							<h1 class="thank_you_page_h1">Спасибо за Ваш заказ на maraphon.online!</h1>
							<div class="grey_line"></div>
							<p class="thank_you_page_p" id="thank_you_page_admin">Администратор Наталья свяжется с вами в течение часа (с 09:00 до 00:00, МСК+4 Новосибирск)</p>
							<p class="thank_you_page_p">В дальнейшем все вопросы по оплате, предоставлению доступа и работе сайта можно задавать ей.</p>
							<p class="thank_you_page_p"><a href="https://api.whatsapp.com/send?phone=+79095496086" target="_blank" class="thank_you_page_p_wa">Нажмите, чтобы сохранить ее номер в Whatsapp</a></p>
							<br>
							<br>
							<p class="thank_you_page_p">Оплата марафона до 28 числа. Пожалуйста, не забудьте обновить вашу анкету. <a href="'.$thank_you_report_link.'" target="_blank" class="thank_you_page_p_a">Нажмите для обновления анкеты</a></p>
							<p class="thank_you_page_p">Данные анкеты необходимы для индивидуального подбора меню (и тренировок) по вашим параметрам</p>
							
							<div class="grey_line"></div>
							<h2 class="thank_you_page_h2">Марафон онлайн от Екатерины Войтенко. Красивая фигура - это просто</h2>
						</div>';
				};	//конец условия if ($check_maraphone_register == 0)	
				
		die();
		}
add_action('wp_ajax_sendOrderByShopMaraphon', 'sendOrderByShopMaraphon');
add_action('wp_ajax_nopriv_sendOrderByShopMaraphon', 'sendOrderByShopMaraphon');

// ----------- Обработчик кнопки купить /shop/workout ----------- 
function sendOrderByShopWorkout(){
				global $wpdb;
				    $current_user = wp_get_current_user();
				    $user_id = $current_user->ID;
				    $date_func = current_time ('Y-m-d',0);
				    $email = $current_user->user_email;
				    $telephone = $current_user->telephone;
				    $first_name = $current_user->user_firstname;
				    $last_name = $current_user->user_lastname;
				    $order_workout_value = ($_POST['sendOrderWorkoutValue']);
				    $shop_workout_select_value = ($_POST['shopWorkoutSelect']);
				    
					if ($order_workout_value == 'buy_one_class') {$order_workout_text = 'тренировки, класс '.$shop_workout_select_value.''; $amount = 300;}
						else if ($order_workout_value == 'buy_ten_class') {$order_workout_text = 'тренировки, с 1 по 10 класс'; $amount = 1500;}
							else if ($order_workout_value == 'buy_press_class') {$order_workout_text = 'тренировки, пресс'; $amount = 600;}
								else if ($order_workout_value == 'buy_booty_class') {$order_workout_text = 'тренировки, ягодицы'; $amount = 600;};
								
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
			
					$_monthsList = array(
						"1"=>"январь","2"=>"февраль","3"=>"март",
						"4"=>"апрель","5"=>"май", "6"=>"июнь",
						"7"=>"июль","8"=>"август","9"=>"сентябрь",
						"10"=>"октябрь","11"=>"ноябрь","12"=>"декабрь");
					$next_month_confirm = current_time("n") + 1 > 12 ? 1 : current_time("n") + 1;
					$mail_month = $_monthsList[$next_month_confirm];
					if ($next_month_confirm < 10) {$next_month_confirm = '0'.$next_month_confirm;};
					$next_year_confirm = current_time("n") + 1 > 12 ? current_time("Y") + 1 : current_time("Y");
					$maraphon_member_month = $next_month_confirm.'.'.$next_year_confirm;
					$mail_period = $mail_month.' '.$next_year_confirm.'г.';
				
  
			        $message  = sprintf(__('Здравствуйте, %s'), $first_name) . ",\n\n";
			        $message .= __('спасибо за ваш заказ на maraphon.online!') . "\n\n";

			        $message .= __('Ваш заказ:') . "\n\n";

			        if (!empty($order_workout_text)){
				        $message .= __(' - '.$order_workout_text) . "\n";
			        };
			        if (!empty($amount)){
				        $message .= __('--------------------------------------') . "\n";
				        $message .= __('Стоимость заказа - '.$amount.'р.') . "\n";
			        };
			        $message .= __('') . "\n";
			        $message .= __('В течение часа (с 09:00 до 00:00 ежедневно) с вами свяжется администратор марафона для уточнения деталей заказа и оплаты. Пожалуйста, ожидайте. ') . "\n\n";
			        $message .= sprintf(__('Если у вас возникли какие-то вопросы с оформлением заказа, пожалуйста, свяжитесь с администратором по e-mail: %s'), get_option('admin_email')) . " либо в Whatsapp 8-909-549-60-86\n\n";
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
			        
			        if (!empty($order_workout_text)){
				        $message_a .= __(' - '.$order_workout_text) . "\n";
			        };
			        if (!empty($amount)){
				        $message_a .= __('--------------------------------------') . "\n";
				        $message_a .= __('Стоимость заказа - '.$amount.'р.') . "\n";
			        };
			        $message_a .= __('') . "\n";
			        $message_a .= sprintf(__('Написать клиенту в Whatsapp: https://api.whatsapp.com/send?phone=%s'), $phone_whatsapp) . "\n";
			        wp_mail('info@maraphon.online', 'Новый заказ на сайте', $message_a, $headers, $attachments);
			        
			        if ($order_workout_value == 'buy_one_class') {		
						$wpdb->insert(
							'wpux_orders_workout',
							array(
								'user_id' => $user_id,
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
						} else if ($order_workout_value == 'buy_ten_class') {
							$wpdb->insert(
							'wpux_orders_workout',
							array(
								'user_id' => $user_id,
								'date' => $date_func,
								'telephone' => $telephone,
								'first_name' => $first_name,
								'last_name' => $last_name,
								'content' => $order_workout_text,
								'class_1' => 1,
								'class_2' => 1,
								'class_3' => 1,
								'class_4' => 1,
								'class_5' => 1,
								'class_6' => 1,
								'class_7' => 1,
								'class_8' => 1,
								'class_9' => 1,
								'class_10' => 1,
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
						
						
						if (
							is_user_role('administrator', $current_user->ID) ||
							get_the_author_meta( 'men_menu_lk', $current_user->ID ) == 'men_menu_1600' || 																												
							get_the_author_meta( 'men_menu_lk', $current_user->ID ) == 'men_menu_1800' || 
							get_the_author_meta( 'men_menu_lk', $current_user->ID ) == 'men_menu_2000' || 
							get_the_author_meta( 'men_menu_lk', $current_user->ID ) == 'men_menu_2200' || 
							get_the_author_meta( 'men_menu_lk', $current_user->ID ) == 'men_menu_2500' 
						) {
							$thank_you_report_link = 'http://maraphon.online/lk/#tab6';
							} else {
								$thank_you_report_link = 'http://maraphon.online/lk/#tab5';	
							};
						echo'
						<div class="thank_you_page_content">
							<style>
							@media screen and (max-width:1279px){
								.opacity-line {
								    position: absolute;
								    height: 65px;
								    width: 720px;
								    background-color: #717171;
								    display: block !important;
								    margin-top: 90px;
								    z-index: 9;
								}
							}
							@media screen and (min-width:1279px){
								.opacity-line {
							        position: absolute;
							        height: 70px;
							        width: 1280px;
							        background-color: #717171;
							        margin-top: 90px;
							        z-index: 998;
							    }
							}
							</style>
							<h1 class="thank_you_page_h1">Спасибо за Ваш заказ на maraphon.online!</h1>
							<div class="grey_line"></div>
							<p class="thank_you_page_p" id="thank_you_page_admin">Администратор Наталья свяжется с вами в течение часа (с 09:00 до 00:00, МСК+4 Новосибирск)</p>
							<p class="thank_you_page_p">В дальнейшем все вопросы по оплате, предоставлению доступа и работе сайта можно задавать ей.</p>
							<p class="thank_you_page_p"><a href="https://api.whatsapp.com/send?phone=+79095496086" target="_blank" class="thank_you_page_p_wa">Нажмите, чтобы сохранить ее номер в Whatsapp</a></p>
							<br>
							<br>
							<p class="thank_you_page_p">Тренировки будут доступны в вашем личном кабинете после оплаты.</p>
							<p class="thank_you_page_p">Доступ предоставляется на постоянной основе.</p>
							
							<div class="grey_line"></div>
							<h2 class="thank_you_page_h2">Марафон онлайн от Екатерины Войтенко. Красивая фигура - это просто</h2>
						</div>';
				
		die();
		}
add_action('wp_ajax_sendOrderByShopWorkout', 'sendOrderByShopWorkout');
add_action('wp_ajax_nopriv_sendOrderByShopWorkout', 'sendOrderByShopWorkout');

// ----------- Вывод отчета Результаты участников марафона /director-cabinet#tab3 ----------- //
function chooseResultPeriodForAdmin(){
	$_monthsListPeriod = array(
								"01"=>"январь","02"=>"февраль","03"=>"март",
								"04"=>"апрель","05"=>"май", "06"=>"июнь",
								"07"=>"июль","08"=>"август","09"=>"сентябрь",
								"10"=>"октябрь","11"=>"ноябрь","12"=>"декабрь");	
			
								$period_now_month = $_POST['choose_period_month'];
								$period_now_year = $_POST['choose_period_year'];
								$period_now_ajax = $period_now_month.'.'.$period_now_year;	
								$period_now_month_for_header = $_monthsListPeriod[$period_now_month];
								
								$period_before_month_calc = ($period_now_month - 1);
								if (($period_before_month_calc > 0) && ($period_before_month_calc <= 9)) {
									$period_before_month_ready = "0".$period_before_month_calc; $period_before_year_ready = $period_now_year;
								}; 
								if ($period_before_month_calc > 9) {$period_before_month_ready = $period_before_month_calc; $period_before_year_ready = $period_now_year;};
								if ($period_before_month_calc == 0) {$period_before_month_ready = 12; $period_before_year_ready = $period_now_year - 1;};
								$period_before = $period_before_month_ready.'.'.$period_before_year_ready;
								
				echo '<h2 class="members_h2">Результаты, '.$period_now_month_for_header.' '.$period_now_year.'</h2>';
				echo '<br>';

				echo '<form id="resultFormForAdmin">';
					echo '<table class="monthly_report_table_for_admin">';
						echo '<thead>';
							echo '<tr style="background-color: #f6f6f6;">';
							    echo '<th style="width: 200px !important;">&nbsp;ФИО&nbsp;</th>';
							    echo '<th>&nbsp;<i style="width: 50px; font-size: 36px;" class="fa fa-instagram" aria-hidden="true"></i>&nbsp;</th>';
							    echo '<th style="width: 100px;">&nbsp;Калораж&nbsp;</th>';  
							    echo '<th style="width: 105px;">&nbsp;№&nbsp;<br>&nbsp;марафона&nbsp;</th>';
							    echo '<th style="width: 760px;">&nbsp;Отчет<br>проверен&nbsp;</th>';
							    echo '<th style="width: 50px;">&nbsp;<i class="fa fa-paper-plane-o" aria-hidden="true">&nbsp;</th>';
							echo '</tr>';
						echo '</thead>';
			    
				require_once ABSPATH . 'wp-admin/includes/user.php';
				require_once ABSPATH . 'wp-admin/includes/template.php';
				global $current_user_id_for_inpit, $wpdb;
				wp_get_current_user();	
				$current_user_report = $current_user->ID;
	
				$this_month_report3 = $wpdb->get_results(
						"
						SELECT
						    users.ID AS user_id_check,
                            monthly.date,
						    (select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'first_name' limit 1) as first_name,
						    (select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'last_name' limit 1) as last_name,
						    (select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'wpux_capabilities' limit 1) as role,
						    (select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'telephone' limit 1) as telephone,
						    (select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'maraphon_counter' limit 1) as maraphon_counter,
						    orders.maraphon_member_month,
                            monthly.director_comment
						    FROM wpux_orders orders, wpux_monthly_report monthly, wpux_users users
						    WHERE orders.maraphon_member_month = $period_now_ajax
                            AND orders.user_id = monthly.user_id
                            AND monthly.date =
							(
							SELECT MAX(DATE)
							FROM wpux_monthly_report B
							WHERE monthly.user_id = B.user_id
							)
                            AND orders.user_email = users.user_email
						    AND (orders.paid = '1' OR orders.credit = '1')
						    AND (orders.maraphon_next_month LIKE '%марафон%' OR orders.maraphon_next_month LIKE '%пакет%')
						    ORDER BY last_name
						"
						);	
							if( $this_month_report3 ) {
						    foreach ( $this_month_report3 as $string_report3 ) {
								$current_user_id_for_input = $string_report3->user_id_check;
								$last_date_report = $string_report3->date;
								$last_date_report = strtotime($last_date_report);
								$date_now = current_time("Y-m-d");
								$date_now = strtotime($date_now);
								$delta_date = $date_now - $last_date_report;
								
								if ($delta_date > 60*60*24*13) {
									if ($string_report3->maraphon_counter == '1') {
										$maraphon_counter_for_color = '#fff3cd';
									} else {
										$maraphon_counter_for_color = '#f8d7da';
									};
									if (!empty($string_report3->director_comment)) {
										$director_comment_for_color = '#ddf7c8';
										$maraphon_counter_for_color = '#ddf7c8';
									} else {
										$director_comment_for_color = '#f8d7da';
										};
								} else {
									if (!empty($string_report3->director_comment)) {$maraphon_counter_for_color = '#ddf7c8'; $director_comment_for_color = '#ddf7c8';}
									else if ($string_report3->maraphon_counter == '1') {$maraphon_counter_for_color = '#fff3cd'; $director_comment_for_color = 'white';} //бежевый цвет #fff3cd
										else {$maraphon_counter_for_color = 'white'; $director_comment_for_color = 'white';};
								};
								
								/*if ($delta_date > 1209600) {
									if ($string_report3->maraphon_counter == '1') {
										$maraphon_counter_for_color = '#fff3cd';
									} else {
										$maraphon_counter_for_color = '#f8d7da';
									};
									$director_comment_for_color = '#f8d7da';
								} else {
									if ($string_report3->director_comment == '1') {$maraphon_counter_for_color = '#ddf7c8'; $director_comment_for_color = '#ddf7c8';}
									else if ($string_report3->maraphon_counter == '1') {$maraphon_counter_for_color = '#fff3cd'; $director_comment_for_color = 'white';} //бежевый цвет #fff3cd
										else {$maraphon_counter_for_color = 'white'; $director_comment_for_color = 'white';};
								};*/
								
						        echo '<tr id="results_row_id_'.$current_user_id_for_input.'">';
						        
						        echo '<td style="font-weight: 400; background-color: '.$maraphon_counter_for_color.'">';
								$name = $string_report3->first_name;
								$surname = $string_report3->last_name;
								$fio = $surname.' '.$name;
								//if ($string_report3->maraphon_counter == '1') {$newbie = '(новичок)'; $newbie_color = 'green';}
								echo '<span class="members_results" id="members_results_id_'.$current_user_id_for_input.'" style="cursor: pointer; color: '.$newbie_color.';">'.$fio.' ' .$newbie.'</span>';
								$newbie = ''; $newbie_color = '#404040';
						        echo '</td>'; 
						        
						        echo '<td style="background-color: '.$director_comment_for_color.'">'; 
						        echo '<p class="result_report" id="result_report_id_'.$current_user_id_for_input.'" style="margin-bottom: 0px !important; cursor: pointer"><i style="font-size: 36px;" class="fa fa-instagram" aria-hidden="true"></i></p>';
						        echo '</td>';
						        
						        echo '<td style="background-color: '.$director_comment_for_color.'">';
						        $user_calories = $string_report3->role;
						        $user_calories_value = substr($user_calories, -11, 4);
						        if ($user_calories_value == 'firm' || $user_calories_value == 'a:0:') {
							        echo 'Неподтв.';
						        } else {
								echo $user_calories_value;
								};
								echo '</td>';
						        
						        echo '<td style="background-color: '.$director_comment_for_color.'">'; 
						        echo $string_report3->maraphon_counter;
						        echo '</td>';
						        
						        
								echo '<td style="background-color: '.$director_comment_for_color.'">';
								/*	if ( ($string_report3->director_comment == '0') || ($string_report3->director_comment == '') ) {				        
								        echo '<input type="checkbox" class="result_director_check" id="result_director_check_id_'.$current_user_id_for_input.'" style="transform:scale(1.5); cursor:pointer;" name="result_director_check_id_'.$current_user_id_for_input.'" value="1" >';
								        } else {
									    	echo '<input type="checkbox" class="result_director_check" id="result_director_check_id_'.$current_user_id_for_input.'" style="transform:scale(1.5); cursor:pointer;" checked name="result_director_check_id_'.$current_user_id_for_input.'" value="1"  >';
								}; */
								
						        if ( ($period_now_month >= current_time('m')) && ($period_now_year >= current_time('Y')) ) { //запрет редактирования прошлых периодов 
						        	echo '<input class="text-input" id="result_director_comment" style="width: 100%; vertical-align: middle; height: 26px; background-color: '.$member_color.'; overflow: scroll;" id="director_comment_id_'.$current_user_id_for_input.'" name="director_comment_id_'.$current_user_id_for_input.'" type="text" value="'.$string_report3->director_comment.'" />'; 
						        } else {
							        echo $string_report3->director_comment;
						        };
						        echo '</td>';
						      
						        echo '<td style="background-color: '.$director_comment_for_color.'">';
						        $whatsapp_number = $string_report3->telephone;
						        $phone= str_replace([' ', '(', ')', '-', '_'], '', $whatsapp_number);
								$phone = preg_replace('/^8/', '+7', $phone);
								$phone = preg_replace('/^7/', '+7', $phone);    
						        echo '<a href="https://api.whatsapp.com/send?phone='.$phone.'" target="_blank"><img style="width: 30px; padding-top:5px" src="http://maraphon.online/wp-content/uploads/whatsapp-icon-180×180.png"/></a>';	
						        echo '</td>';
						       
						        echo '</tr>';
						        
						        echo '<tr>';
						        
						        echo '<td style="background-color: #f6f6f6;" colspan="6">';
						        echo '<div class="resultInstForAdmin" id="resultInstForAdmin_'.$current_user_id_for_input.'"></div>';
						        echo '<div class="resultTableForAdmin" id="resultTableForAdmin_'.$current_user_id_for_input.'"></div>';
						        echo '</td>'; 
						        
						        echo '</tr>';
						        
						}
			};	
								echo '</table>';
								
			
		
			echo '<input type="hidden" name="action" value="updateResultPeriodForAdmin"/>';
			echo '<input style="'.$check_flag_button.'" type="submit" id="updateusermembers" class="submit button" value="Записать">';
			echo '<div id="success_form"><p>Данные обновлены</p></div>';					
								
			echo '</form>';
			
			
			
			echo '<script type="text/javascript">';  //Обновление комментария директора по результатам участников
				echo 'jQuery("#resultFormForAdmin").submit(ajaxResultFormForAdmin);'; 
				echo 'function ajaxResultFormForAdmin(){'; 
					echo 'var resultFormForAdminData = jQuery(this).serialize();'; 
					echo 'var choose_period_result_month = $("#choose_period_result_month").val();';
					echo 'var choose_period_result_year = $("#choose_period_result_year").val();';
					echo 'var periodNowResult = (choose_period_result_month + "." + choose_period_result_year);';
					echo 'var resultFormForAdminData = resultFormForAdminData + "&periodNowResultData=" + periodNowResult;'; 
					echo 'jQuery.ajax({'; 
						echo 'type:"POST",'; 
						echo 'url: "/wp-admin/admin-ajax.php",'; 
						echo 'data: resultFormForAdminData,';
						echo 'success:function(data){'; 
						echo '$("#success_form").show();'; 
						echo 'setTimeout(function(){$("#success_form").fadeOut("slow")},1000);';
						echo '}'; 
					echo '});'; 
				echo 'return false;'; 
				echo '}'; 
			echo '</script>'; 	
			
			
			echo '<script type="text/javascript">'; //вывод полной таблицы результатов
			echo '$(function() {';
			    echo 'function showResultTableForAdmin(){';
				  
			      echo 'var idResultMembers = this.id;';
			      echo 'idResultRightMembers = idResultMembers.substr(19);';
				  echo '$.ajaxSetup({cache: false});';
					echo 'jQuery.ajax({';
						echo 'type:"POST",';
						echo 'url: "/wp-admin/admin-ajax.php",';
						echo 'data: {action: "detailedResultForAdmin",';
							  echo 'idResultRightMembers,';
						echo '},';
						echo 'success:function(data){';
						echo 'jQuery("#resultTableForAdmin_" + idResultRightMembers).html(data);';
						echo '$("#results_row_id_" + idResultRightMembers).css("background-color", "#fec300");';
						echo '}';
					echo '});';
					echo 'return false;';
				echo '}';
			    echo '$(".members_results").click(showResultTableForAdmin);';
			echo '});';
			echo '</script>';
			
			echo '<script type="text/javascript">'; //закрытие полной таблицы по крестику
				echo '$(document).on("click", ".close_result_user_for_admin", function(event){';
					echo 'var idResultMembersClose = this.id;';
					echo 'var subidResultMembersClose = idResultMembersClose.substr(31);';
					echo '$("#resultTableForAdmin_" + subidResultMembersClose).empty();';
					echo '$("#results_row_id_" + subidResultMembersClose).css("background-color", "white");';
				echo '});';
			echo '</script>';
			
			echo '<script type="text/javascript">'; //вывод результата участника для Instagram
				echo '$(function() {';
				    echo 'function showResultInstForAdmin(){';
				      echo 'var idInst = this.id;';
				      echo 'var idInstRight = idInst.substr(17);';
				      echo 'var choose_period_month = $("#choose_period_month").val();';
					  echo 'var choose_period_year = $("#choose_period_year").val();';
					  echo 'var periodNowAjaxDaily = (choose_period_month + "." + choose_period_year);';
					  echo '$.ajaxSetup({cache: false});';
						echo 'jQuery.ajax({';
							echo 'type:"POST",';
							echo 'url: "/wp-admin/admin-ajax.php",';
							echo 'data: {action: "resultInstForAdmin",';
								  echo 'idInstRight, periodNowAjaxDaily,';
							echo '},';
							echo 'success:function(data){';
							echo 'jQuery("#resultInstForAdmin_" + idInstRight).html(data);';
							echo '}';
						echo '});';
						echo 'return false;';
					echo '}';
				    echo '$(".result_report").click(showResultInstForAdmin);';
				echo '});';
			echo '</script>';	
			
			echo '<script>';
				echo 'jQuery(function($){';
				echo '$(document).click(function (e){';
					echo 'var div = $(".resultInstForAdmin");';
					echo 'if (!div.is(e.target)';
					    echo '&& div.has(e.target).length === 0) {';
						echo 'div.empty();';
					echo '}';
				echo '});';
				echo '});';  
			echo '</script>';	

			echo '<div style="height: 50px;"></div>';
	die();
}
add_action('wp_ajax_chooseResultPeriodForAdmin', 'chooseResultPeriodForAdmin');
add_action('wp_ajax_nopriv_chooseResultPeriodForAdmin', 'chooseResultPeriodForAdmin');

// ----------- Вывод краткой таблицы для Instagram Результаты участников марафона при клике на календарь /director-cabinet#tab3 ----------- //
function resultInstForAdmin(){
	global $wpdb;
	$current_user_result_inst = $_POST['idInstRight'];
	$current_date_result_start = current_time("Y-m").'-01';
	$current_date_result_finish = current_time("Y-m").'-31';
	$current_date_result_month = current_time("m.Y");
	$user_inst_report = $wpdb->get_results( 
	"
	SELECT 	
		monthly.user_id,
		(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'first_name' limit 1) as first_name,
		(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'last_name' limit 1) as last_name,
		(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'age' limit 1) as age,
		(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'maraphon_counter' limit 1) as maraphon_counter,
		monthly.date,
        monthly.weight,
        monthly.breast,
        monthly.waist,
        monthly.stomach,
        monthly.booty,
        monthly.left_leg,
        monthly.right_leg,
        monthly.calf,
        monthly.arm,
        (select monthly.date from wpux_monthly_report monthly where user_id = users.ID and monthly.date = (
		SELECT MAX(DATE) FROM wpux_monthly_report B WHERE monthly.user_id = B.user_id)) as date_now,
        (select monthly.weight from wpux_monthly_report monthly where user_id = users.ID and monthly.date = (
		SELECT MAX(DATE) FROM wpux_monthly_report B WHERE monthly.user_id = B.user_id)) as weight_now,
		(select monthly.breast from wpux_monthly_report monthly where user_id = users.ID and monthly.date = (
		SELECT MAX(DATE) FROM wpux_monthly_report B WHERE monthly.user_id = B.user_id)) as breast_now,		
		(select monthly.waist from wpux_monthly_report monthly where user_id = users.ID and monthly.date = (
		SELECT MAX(DATE) FROM wpux_monthly_report B WHERE monthly.user_id = B.user_id)) as waist_now,			
		(select monthly.stomach from wpux_monthly_report monthly where user_id = users.ID and monthly.date = (
		SELECT MAX(DATE) FROM wpux_monthly_report B WHERE monthly.user_id = B.user_id)) as stomach_now,
        (select monthly.booty from wpux_monthly_report monthly where user_id = users.ID and monthly.date = (
		SELECT MAX(DATE) FROM wpux_monthly_report B WHERE monthly.user_id = B.user_id)) as booty_now,
        (select monthly.left_leg from wpux_monthly_report monthly where user_id = users.ID and monthly.date = (
		SELECT MAX(DATE) FROM wpux_monthly_report B WHERE monthly.user_id = B.user_id)) as left_leg_now,
        (select monthly.right_leg from wpux_monthly_report monthly where user_id = users.ID and monthly.date = (
		SELECT MAX(DATE) FROM wpux_monthly_report B WHERE monthly.user_id = B.user_id)) as right_leg_now,
        (select monthly.calf from wpux_monthly_report monthly where user_id = users.ID and monthly.date = (
		SELECT MAX(DATE) FROM wpux_monthly_report B WHERE monthly.user_id = B.user_id)) as calf_now,
        (select monthly.arm from wpux_monthly_report monthly where user_id = users.ID and monthly.date = (
		SELECT MAX(DATE) FROM wpux_monthly_report B WHERE monthly.user_id = B.user_id)) as arm_now,
		
		(select orders.paid FROM wpux_orders orders WHERE user_id = users.ID and 
        orders.maraphon_member_month = '$current_date_result_month') as paid,
        (select orders.credit FROM wpux_orders orders WHERE user_id = users.ID and 
        orders.maraphon_member_month = '$current_date_result_month') as credit		
        
		FROM wpux_monthly_report monthly, wpux_users users
		WHERE monthly.user_id = $current_user_result_inst
        AND monthly.user_id = users.ID
        AND monthly.date = (
							SELECT MIN(DATE)
							FROM wpux_monthly_report B
							WHERE monthly.user_id = B.user_id
							)
		"	
		);
		
		echo '<table class="ins_result_table_for_admin">';
			
		if( $user_inst_report ) {
							    foreach ( $user_inst_report as $user_inst_string_report ) {
								    
								    	echo '<tr style="background-color: #f6f6f6;">';
								    		echo '<th colspan="4" style="font-size: 30px">';
								        		echo $user_inst_string_report->first_name;
								        	echo '</th>';
								    	echo '<tr>';
								    	
								    	echo '<tr style="background-color: #f6f6f6;">';
								    	
								    		echo '<th>';
								        		echo '&nbsp;&nbsp;Параметры&nbsp;&nbsp;';
								        	echo '</th>';
								        	
								        	echo '<th>';
								        		echo 'До марафона<br>';
								        		$user_inst_string_report_date = $user_inst_string_report->date;
								        		$user_inst_string_report_date_day = substr($user_inst_string_report_date, -2);
								        		$user_inst_string_report_date_month = substr($user_inst_string_report_date, 5, 2);
								        		$user_inst_string_report_date_year = substr($user_inst_string_report_date, 0, 4);
								        		echo $user_inst_string_report_date_day.'.'.$user_inst_string_report_date_month.'.'.$user_inst_string_report_date_year;
								        	echo '</th>';
								        	
								        	echo '<th>';
								        		$check_paid = $user_inst_string_report->paid;
								        		$check_credit = $user_inst_string_report->credit;
								        		if (current_time("j") > 0 && current_time("j") < 28) {
													if ( ($check_paid == '1' || $check_credit = '1') ) {
													    echo 'После '.($user_inst_string_report->maraphon_counter - 1).' марафона<br>';
													} else if ( ($check_paid == '0' || $check_credit = '0') ) {	
														echo 'После '.$user_inst_string_report->maraphon_counter.' марафона<br>';
													} else {
														echo 'После '.$user_inst_string_report->maraphon_counter.' марафона<br>';
														};
												} else if (current_time("j") >= 28) {
													if ( ($check_paid == '1' || $check_credit = '1') ) {
													    echo 'После '.($user_inst_string_report->maraphon_counter - 1).' марафона<br>';
													} else if ( ($check_paid == '0' || $check_credit = '0') ) {	
														echo 'После '.$user_inst_string_report->maraphon_counter.' марафона<br>';
													};
												};
												$user_inst_string_report_date_now = $user_inst_string_report->date_now;
								        		$user_inst_string_report_date_day_now = substr($user_inst_string_report_date_now, -2);
								        		$user_inst_string_report_date_month_now = substr($user_inst_string_report_date_now, 5, 2);
								        		$user_inst_string_report_date_year_now = substr($user_inst_string_report_date_now, 0, 4);
								        		echo $user_inst_string_report_date_day_now.'.'.$user_inst_string_report_date_month_now.'.'.$user_inst_string_report_date_year_now;
								        	echo '</th>';
								        	
								        	echo '<th>';
								        		echo '&nbsp;Результат&nbsp;';
								        	echo '</th>';
								        	
								    	echo '</tr>';
								        echo '<tr>';
								        	echo '<td>';
								        		echo 'Вес';
								        	echo '</td>';
								        	echo '<td>';
								        		echo $user_inst_string_report->weight.' кг';
								        	echo '</td>';
								        	echo '<td>';
								        		echo $user_inst_string_report->weight_now.' кг';
								        	echo '</td>';
								        	$delta_weight = round($user_inst_string_report->weight_now - $user_inst_string_report->weight, 1);
								        	if ($delta_weight == 0) {$delta_weight_color = 'white'; };
								        	if ($delta_weight > 0) {$delta_weight_color = '#f8d7da'; $delta_weight = '+'.$delta_weight;};
								        	if ($delta_weight < 0) {$delta_weight_color = '#ddf7c8'; };
								        	echo '<td style="background-color: '.$delta_weight_color.'">';
								        		echo $delta_weight.' кг';
								        	echo '</td>';
								        echo '</tr>';
								        echo '<tr>';
								        	echo '<td>';
								        		echo '&nbsp;Объем груди&nbsp;';
								        	echo '</td>';
								        	echo '<td>';
								        		echo $user_inst_string_report->breast.' см';
								        	echo '</td>';
								        	echo '<td>';
								        		echo $user_inst_string_report->breast_now.' см';
								        	echo '</td>';
								        	$delta_breast = round($user_inst_string_report->breast_now - $user_inst_string_report->breast, 1);
								        	if ($delta_breast == 0) {$delta_breast_color = 'white'; };
								        	if ($delta_breast > 0) {$delta_breast_color = '#f8d7da'; $delta_breast = '+'.$delta_breast;};
								        	if ($delta_breast < 0) {$delta_breast_color = '#ddf7c8'; };
								        	echo '<td style="background-color: '.$delta_breast_color.'">';
								        		echo $delta_breast.' см';
								        	echo '</td>';
								        echo '</tr>';
								        echo '<tr>';
								        	echo '<td>';
								        		echo 'Талия';
								        	echo '</td>';
								        	echo '<td>';
								        		echo $user_inst_string_report->waist.' см';
								        	echo '</td>';
								        	echo '<td>';
								        		echo $user_inst_string_report->waist_now.' см';
								        	echo '</td>';
								        	$delta_waist = round($user_inst_string_report->waist_now - $user_inst_string_report->waist, 1);
								        	if ($delta_waist == 0) {$delta_waist_color = 'white'; };
								        	if ($delta_waist > 0) {$delta_waist_color = '#f8d7da'; $delta_waist = '+'.$delta_waist;};
								        	if ($delta_waist < 0) {$delta_waist_color = '#ddf7c8'; };
								        	echo '<td style="background-color: '.$delta_waist_color.'">';
								        		echo $delta_waist.' см';
								        	echo '</td>';
								        echo '</tr>';
								        echo '<tr>';
								        	echo '<td>';
								        		echo 'Живот';
								        	echo '</td>';
								        	echo '<td>';
								        		echo $user_inst_string_report->stomach.' см';
								        	echo '</td>';
								        	echo '<td>';
								        		echo $user_inst_string_report->stomach_now.' см';
								        	echo '</td>';
								        	$delta_stomach = round($user_inst_string_report->stomach_now - $user_inst_string_report->stomach, 1);
								        	if ($delta_stomach == 0) {$delta_stomach_color = 'white'; };
								        	if ($delta_stomach > 0) {$delta_stomach_color = '#f8d7da'; $delta_stomach = '+'.$delta_stomach;};
								        	if ($delta_stomach < 0) {$delta_stomach_color = '#ddf7c8'; };
								        	echo '<td style="background-color: '.$delta_stomach_color.'">';
								        		echo $delta_stomach.' см';
								        	echo '</td>';
								        echo '</tr>';
								        
								         echo '<tr>';
								        	echo '<td>';
								        		echo 'Объем ягодиц';
								        	echo '</td>';
								        	echo '<td>';
								        		echo $user_inst_string_report->booty.' см';
								        	echo '</td>';
								        	echo '<td>';
								        		echo $user_inst_string_report->booty_now.' см';
								        	echo '</td>';
								        	$delta_booty = round($user_inst_string_report->booty_now - $user_inst_string_report->booty, 1);
								        	if ($delta_booty == 0) {$delta_booty_color = 'white'; };
								        	if ($delta_booty > 0) {$delta_booty_color = '#f8d7da'; $delta_booty = '+'.$delta_booty;};
								        	if ($delta_booty < 0) {$delta_booty_color = '#ddf7c8'; };
								        	echo '<td style="background-color: '.$delta_booty_color.'">';
								        		echo $delta_booty.' см';
								        	echo '</td>';
								        echo '</tr>';
								         echo '<tr>';
								        	echo '<td>';
								        		echo 'Левая нога';
								        	echo '</td>';
								        	echo '<td>';
								        		echo $user_inst_string_report->left_leg.' см';
								        	echo '</td>';
								        	echo '<td>';
								        		echo $user_inst_string_report->left_leg_now.' см';
								        	echo '</td>';
								        	$delta_left_leg = round($user_inst_string_report->left_leg_now - $user_inst_string_report->left_leg, 1);
								        	if ($delta_left_leg == 0) {$delta_left_leg_color = 'white'; };
								        	if ($delta_left_leg > 0) {$delta_left_leg_color = '#f8d7da'; $delta_left_leg = '+'.$delta_left_leg;};
								        	if ($delta_left_leg < 0) {$delta_left_leg_color = '#ddf7c8'; };
								        	echo '<td style="background-color: '.$delta_left_leg_color.'">';
								        		echo $delta_left_leg.' см';
								        	echo '</td>';
								        echo '</tr>';
								         echo '<tr>';
								        	echo '<td>';
								        		echo 'Правая нога';
								        	echo '</td>';
								        	echo '<td>';
								        		echo $user_inst_string_report->right_leg.' см';
								        	echo '</td>';
								        	echo '<td>';
								        		echo $user_inst_string_report->right_leg_now.' см';
								        	echo '</td>';
								        	$delta_right_leg = round($user_inst_string_report->right_leg_now - $user_inst_string_report->right_leg, 1);
								        	if ($delta_right_leg == 0) {$delta_right_leg_color = 'white'; };
								        	if ($delta_right_leg > 0) {$delta_right_leg_color = '#f8d7da'; $delta_right_leg = '+'.$delta_right_leg;};
								        	if ($delta_right_leg < 0) {$delta_right_leg_color = '#ddf7c8'; };
								        	echo '<td style="background-color: '.$delta_right_leg_color.'">';
								        		echo $delta_right_leg.' см';
								        	echo '</td>';
								        echo '</tr>';
								         echo '<tr>';
								        	echo '<td>';
								        		echo 'Икра';
								        	echo '</td>';
								        	echo '<td>';
								        		echo $user_inst_string_report->calf.' см';
								        	echo '</td>';
								        	echo '<td>';
								        		echo $user_inst_string_report->calf_now.' см';
								        	echo '</td>';
								        	$delta_calf = round($user_inst_string_report->calf_now - $user_inst_string_report->calf, 1);
								        	if ($delta_calf == 0) {$delta_calf_color = 'white'; };
								        	if ($delta_calf > 0) {$delta_calf_color = '#f8d7da'; $delta_calf = '+'.$delta_calf;};
								        	if ($delta_calf < 0) {$delta_calf_color = '#ddf7c8'; };
								        	echo '<td style="background-color: '.$delta_calf_color.'">';
								        		echo $delta_calf.' см';
								        	echo '</td>';
								        echo '</tr>';
								         echo '<tr>';
								        	echo '<td>';
								        		echo 'Рука';
								        	echo '</td>';
								        	echo '<td>';
								        		echo $user_inst_string_report->arm.' см';
								        	echo '</td>';
								        	echo '<td>';
								        		echo $user_inst_string_report->arm_now.' см';
								        	echo '</td>';
								        	$delta_arm = round($user_inst_string_report->arm_now - $user_inst_string_report->arm, 1);
								        	if ($delta_arm == 0) {$delta_arm_color = 'white'; };
								        	if ($delta_arm > 0) {$delta_arm_color = '#f8d7da'; $delta_arm = '+'.$delta_arm;};
								        	if ($delta_arm < 0) {$delta_arm_color = '#ddf7c8'; };
								        	echo '<td style="background-color: '.$delta_arm_color.'">';
								        		echo $delta_arm.' см';
								        	echo '</td>';
								        echo '</tr>';
					}
				};
		echo '</table>';
		$current_year = current_time("Y");
		echo '<p style="text-align: center; padding-top: 10px; margin-bottom: 5px;" >© '.$current_year.' Марафон Онлайн от Войтенко Екатерины</p>';
	die();
}
add_action('wp_ajax_resultInstForAdmin', 'resultInstForAdmin');
add_action('wp_ajax_nopriv_resultInstForAdmin', 'resultInstForAdmin');


// ----------- Обработчик обновления отчета "Результаты участников марафона" /director-cabinet#tab3 ----------- //
function updateResultPeriodForAdmin(){
					global $wpdb;
					$period_now_result = $_POST['periodNowResultData'];

			        $this_month_report5 = $wpdb->get_results(
						"
						SELECT
						    users.ID AS user_id_check,
                            monthly.date,
                            monthly.report_id,
						    (select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'first_name' limit 1) as first_name,
						    (select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'last_name' limit 1) as last_name,
						    (select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'wpux_capabilities' limit 1) as role,
						    (select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'telephone' limit 1) as telephone,
						    (select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'maraphon_counter' limit 1) as maraphon_counter,
						    orders.maraphon_member_month,
                            monthly.director_comment
						    FROM wpux_orders orders, wpux_monthly_report monthly, wpux_users users
						    WHERE orders.maraphon_member_month = $period_now_result
                            AND orders.user_id = monthly.user_id
                            AND monthly.date =
							(
							SELECT MAX(DATE)
							FROM wpux_monthly_report B
							WHERE monthly.user_id = B.user_id
							)
                            AND orders.user_email = users.user_email
						    AND (orders.paid = '1' OR orders.credit = '1')
						    AND orders.maraphon_next_month LIKE '%марафон%'
						    ORDER BY last_name
						"
						);	
							if( $this_month_report5 ) {
						    foreach ( $this_month_report5 as $string_report5 ) {
								$current_user_id_for_output = $string_report5->user_id_check;
								$current_report_id_for_output = $string_report5->report_id;
							    $data1 = 'director_comment_id_'.$current_user_id_for_output.'';
								$comment_result_director = $_POST[$data1];
								
									$wpdb->update(
									'wpux_monthly_report',
									array( 
									'director_comment' => $comment_result_director
									),
									array(
								
									'report_id' => $current_report_id_for_output
									)
									); 
					
		    				}; //Тело цикла
						}; //Тело первоначального условия		
	die();
}
add_action('wp_ajax_updateResultPeriodForAdmin', 'updateResultPeriodForAdmin');
add_action('wp_ajax_nopriv_updateResultPeriodForAdmin', 'updateResultPeriodForAdminy');

// ----------- Вывод подробной таблицы Результаты участников марафона при клике на фамилию /director-cabinet#tab3 ----------- //
function detailedResultForAdmin(){
	global $wpdb;
	$current_user_result_members = $_POST['idResultRightMembers'];		
	echo '<a class="close_result_user_for_admin" id="close_result_user_for_admin_id_'.$current_user_result_members.'" title="Закрыть"> x</a>';

	echo '<table class="detailed_result_table_for_admin">';

				echo '<tr>';
					echo '<th style="width: 10%">Дата</th>';
					echo '<th style="width: 10%">Вес</th>';
					echo '<th style="width: 10%">Объем груди</th>';
					echo '<th style="width: 10%">Талия</th>';
					echo '<th style="width: 10%">Живот</th>';
					echo '<th style="width: 10%">Объем ягодиц</th>';
					echo '<th style="width: 10%">Нога левая</th>';
					echo '<th style="width: 10%">Нога правая</th>';
					echo '<th style="width: 10%">Икра</th>';
					echo '<th style="width: 10%">Рука</th>';
                echo '</tr>';
                    
							$date_func = current_time ('Y-m-d',0);
							$user_result_weight = 0;
							$user_result_breast = 0;
							$user_result_waist = 0;
							$user_result_stomach = 0;
							$user_result_booty = 0;
							$user_result_left_leg = 0;
							$user_result_right_leg = 0;
							$user_result_calf = 0;
							$user_result_arm = 0;
							$user_result_report = $wpdb->get_results( 
							"
							SELECT *
							FROM wpux_monthly_report
							WHERE user_id = $current_user_result_members
							ORDER BY date
							"
							);
							if( $user_result_report ) {
							    foreach ( $user_result_report as $user_string_report ) {
								        echo '<tr>';
								        
								        echo '<td style="background-color: white">';
								        $user_database_date =  $user_string_report->date;
								        $user_result_day = substr($user_database_date, 8);
								        $user_result_month = substr($user_database_date, 5, 2);
								        $user_result_year = substr($user_database_date, 0, 4);
										$user_database_date = $user_result_day.'.'.$user_result_month.'.'.$user_result_year;
								        echo $user_database_date;
								        echo '</td>';
								        
								        $user_result_weight_now = $user_string_report->weight;
									    $user_result_weight_before = $user_result_weight;
									    $user_report_weight_delta = round($user_result_weight_now - $user_result_weight_before, 1);
								        if ($user_report_weight_delta < 0) {$weight_color = '#ddf7c8';}
								        else if ($user_report_weight_delta > 0 && $user_report_weight_delta < $user_result_weight_now) {$weight_color = '#f8d7da';}
								        else {$weight_color = 'white';};
								        echo '<td style="background-color: '.$weight_color.';">';  
								        if ($user_result_weight == 0 || $user_report_weight_delta == 0) {
									        echo $user_string_report->weight;
								        } else {
									        $user_report_weight_delta = round($user_result_weight_now - $user_result_weight_before, 1);
									        $user_weight_delta_draw = $user_report_weight_delta + $user_weight_delta_draw;
										        if ($user_report_weight_delta <= 0) {
										        	echo '&nbsp;&nbsp;'.$user_result_weight_now.' | '.$user_report_weight_delta;
										        } else if ($user_report_weight_delta > 0) {
											        echo '&nbsp;&nbsp;'.$user_result_weight_now.' | +'.$user_report_weight_delta; 
										        };
								        };
								        $user_result_weight = $user_string_report->weight;
								        echo '</td>';
								        
								        $user_result_breast_now = $user_string_report->breast;
									    $user_result_breast_before = $user_result_breast;
									    $user_report_breast_delta = round($user_result_breast_now - $user_result_breast_before, 1);
									    
								        if ($user_report_breast_delta < 0) {$breast_color = '#ddf7c8';}
								        else if ($user_report_breast_delta > 0 && $user_report_breast_delta < $user_result_breast_now) {$breast_color = '#f8d7da';}
								        else {$breast_color = 'white';};
								        echo '<td style="background-color: '.$breast_color.'">';  
								        if ($user_result_breast == 0 || $user_report_breast_delta == 0) {
									        echo $user_string_report->breast;
								        } else {
									        $user_report_breast_delta = round($user_result_breast_now - $user_result_breast_before, 1);
									        $user_breast_delta_draw = $user_report_breast_delta + $user_breast_delta_draw;
										        if ($user_report_breast_delta <= 0) {
										        	echo '&nbsp;&nbsp;'.$user_result_breast_now.' | '.$user_report_breast_delta;
										        } else if ($user_report_breast_delta > 0) {
											        echo '&nbsp;&nbsp;'.$user_result_breast_now.' | +'.$user_report_breast_delta; 
										        };
								        };
								        $user_result_breast = $user_string_report->breast;
								        echo '</td>'; 
								        
								        $user_result_waist_now = $user_string_report->waist;
									    $user_result_waist_before = $user_result_waist;
									    $user_report_waist_delta = round($user_result_waist_now - $user_result_waist_before, 1);
								        if ($user_report_waist_delta < 0) {$waist_color = '#ddf7c8';}
								        else if ($user_report_waist_delta > 0  && $user_report_waist_delta < $user_result_waist_now) {$waist_color = '#f8d7da';}
								        else {$waist_color = 'white';};
								        echo '<td style="background-color: '.$waist_color.'">';  
								        if ($user_result_waist == 0 || $user_report_waist_delta == 0) {
									        echo $user_string_report->waist;
								        } else {
									        $user_report_waist_delta = round($user_result_waist_now - $user_result_waist_before, 1);
									        $user_waist_delta_draw = $user_report_waist_delta + $user_waist_delta_draw;
										        if ($user_report_waist_delta <= 0) {
										        	echo '&nbsp;&nbsp;'.$user_result_waist_now.' | '.$user_report_waist_delta;
										        } else if ($user_report_waist_delta > 0) {
											        echo '&nbsp;&nbsp;'.$user_result_waist_now.' | +'.$user_report_waist_delta; 
										        };
								        };
								        $user_result_waist = $user_string_report->waist;
								        echo '</td>';
								        
								        $user_result_stomach_now = $user_string_report->stomach;
									    $user_result_stomach_before = $user_result_stomach;
									    $user_report_stomach_delta = round($user_result_stomach_now - $user_result_stomach_before, 1);
								        if ($user_report_stomach_delta < 0) {$stomach_color = '#ddf7c8';}
								        else if ($user_report_stomach_delta > 0 && $user_report_stomach_delta < $user_result_stomach_now) {$stomach_color = '#f8d7da';}
								        else {$stomach_color = 'white';};
								        echo '<td style="background-color: '.$stomach_color.'">';  
								        if ($user_result_stomach == 0 || $user_report_stomach_delta == 0) {
									        echo $user_string_report->stomach;
								        } else {
									        $user_report_stomach_delta = round($user_result_stomach_now - $user_result_stomach_before, 1);
									        $user_stomach_delta_draw = $user_report_stomach_delta + $user_stomach_delta_draw;
										        if ($user_report_stomach_delta <= 0) {
										        	echo '&nbsp;&nbsp;'.$user_result_stomach_now.' | '.$user_report_stomach_delta;
										        } else if ($user_report_stomach_delta > 0) {
											        echo '&nbsp;&nbsp;'.$user_result_stomach_now.' | +'.$user_report_stomach_delta; 
										        };
								        };
								        $user_result_stomach = $user_string_report->stomach;
								        echo '</td>';
								        
								        $user_result_booty_now = $user_string_report->booty;
									    $user_result_booty_before = $user_result_booty;
									    $user_report_booty_delta = round($user_result_booty_now - $user_result_booty_before, 1);
								        if ($user_report_booty_delta < 0) {$booty_color = '#ddf7c8';}
								        else if ($user_report_booty_delta > 0 && $user_report_booty_delta < $user_result_booty_now) {$booty_color = '#f8d7da';}
								        else {$booty_color = 'white';};
								        echo '<td style="background-color: '.$booty_color.'">';  
								        if ($user_result_booty == 0 || $user_report_booty_delta == 0) {
									        echo $user_string_report->booty;
								        } else {
									        $user_report_booty_delta = round($user_result_booty_now - $user_result_booty_before, 1);
									        $user_booty_delta_draw = $user_report_booty_delta + $user_booty_delta_draw;
										        if ($user_report_booty_delta <= 0) {
										        	echo '&nbsp;&nbsp;'.$user_result_booty_now.' | '.$user_report_booty_delta;
										        } else if ($user_report_booty_delta > 0) {
											        echo '&nbsp;&nbsp;'.$user_result_booty_now.' | +'.$user_report_booty_delta; 
										        };
								        };
								        $user_result_booty = $user_string_report->booty;
								        echo '</td>';
								        
								        $user_result_left_leg_now = $user_string_report->left_leg;
									    $user_result_left_leg_before = $user_result_left_leg;
									    $user_report_left_leg_delta = round($user_result_left_leg_now - $user_result_left_leg_before, 1);
								        if ($user_report_left_leg_delta < 0) {$left_leg_color = '#ddf7c8';}
								        else if ($user_report_left_leg_delta > 0 && $user_report_left_leg_delta < $user_result_left_leg_now) {$left_leg_color = '#f8d7da';}
								        else {$left_leg_color = 'white';};
								        echo '<td style="background-color: '.$left_leg_color.'">';  
								        if ($user_result_left_leg == 0 || $user_report_left_leg_delta == 0) {
									        echo $user_string_report->left_leg;
								        } else {
									        $user_report_left_leg_delta = round($user_result_left_leg_now - $user_result_left_leg_before, 1);
									        $user_left_leg_delta_draw = $user_report_left_leg_delta + $user_left_leg_delta_draw;
										        if ($user_report_left_leg_delta <= 0) {
										        	echo '&nbsp;&nbsp;'.$user_result_left_leg_now.' | '.$user_report_left_leg_delta;
										        } else if ($user_report_left_leg_delta > 0) {
											        echo '&nbsp;&nbsp;'.$user_result_left_leg_now.' | +'.$user_report_left_leg_delta; 
										        };
								        };
								        $user_result_left_leg = $user_string_report->left_leg;
								        echo '</td>';
								        
								        $user_result_right_leg_now = $user_string_report->right_leg;
									    $user_result_right_leg_before = $user_result_right_leg;
									    $user_report_right_leg_delta = round($user_result_right_leg_now - $user_result_right_leg_before, 1);
								        if ($user_report_right_leg_delta < 0) {$right_leg_color = '#ddf7c8';}
								        else if ($user_report_right_leg_delta > 0 && $user_report_right_leg_delta < $user_result_right_leg_now) {$right_leg_color = '#f8d7da';}
								        else {$right_leg_color = 'white';};
								        echo '<td style="background-color: '.$right_leg_color.'">';  
								        if ($user_result_right_leg == 0 || $user_report_right_leg_delta == 0) {
									        echo $user_string_report->right_leg;
								        } else {
									        $user_report_right_leg_delta = round($user_result_right_leg_now - $user_result_right_leg_before, 1);
									        $user_right_leg_delta_draw = $user_report_right_leg_delta + $user_right_leg_delta_draw;
										        if ($user_report_right_leg_delta <= 0) {
										        	echo '&nbsp;&nbsp;'.$user_result_right_leg_now.' | '.$user_report_right_leg_delta;
										        } else if ($user_report_right_leg_delta > 0) {
											        echo '&nbsp;&nbsp;'.$user_result_right_leg_now.' | +'.$user_report_right_leg_delta; 
										        };
								        };
								        $user_result_right_leg = $user_string_report->right_leg;
								        echo '</td>';
								        
								        $user_result_calf_now = $user_string_report->calf;
									    $user_result_calf_before = $user_result_calf;
									    $user_report_calf_delta = round($user_result_calf_now - $user_result_calf_before, 1);
								        if ($user_report_calf_delta < 0) {$calf_color = '#ddf7c8';}
								        else if ($user_report_calf_delta > 0 && $user_report_calf_delta < $user_result_calf_now) {$calf_color = '#f8d7da';}
								        else {$calf_color = 'white';};
								        echo '<td style="background-color: '.$calf_color.'">';  
								        if ($user_result_calf == 0 || $user_report_calf_delta == 0) {
									        echo $user_string_report->calf;
								        } else {
									        $user_report_calf_delta = round($user_result_calf_now - $user_result_calf_before, 1);
									        $user_calf_delta_draw = $user_report_calf_delta + $user_calf_delta_draw;
										        if ($user_report_calf_delta <= 0) {
										        	echo '&nbsp;&nbsp;'.$user_result_calf_now.' | '.$user_report_calf_delta;
										        } else if ($user_report_calf_delta > 0) {
											        echo '&nbsp;&nbsp;'.$user_result_calf_now.' | +'.$user_report_calf_delta; 
										        };
								        };
								        $user_result_calf = $user_string_report->calf;
								        echo '</td>';
								        
								        $user_result_arm_now = $user_string_report->arm;
									    $user_result_arm_before = $user_result_arm;
									    $user_report_arm_delta = round($user_result_arm_now - $user_result_arm_before, 1);
								        if ($user_report_arm_delta < 0) {$arm_color = '#ddf7c8';}
								        else if ($user_report_arm_delta > 0 && $user_report_arm_delta < $user_result_arm_now) {$arm_color = '#f8d7da';}
								        else {$arm_color = 'white';};
								        echo '<td style="background-color: '.$arm_color.'">';  
								        if ($user_result_arm == 0 || $user_report_arm_delta == 0) {
									        echo $user_string_report->arm;
								        } else {
									        $user_report_arm_delta = round($user_result_arm_now - $user_result_arm_before, 1);
									        $user_arm_delta_draw = $user_report_arm_delta + $user_arm_delta_draw;
										        if ($user_report_arm_delta <= 0) {
										        	echo '&nbsp;&nbsp;'.$user_result_arm_now.' | '.$user_report_arm_delta;
										        } else if ($user_report_arm_delta > 0) {
											        echo '&nbsp;&nbsp;'.$user_result_arm_now.' | +'.$user_report_arm_delta; 
										        };
								        };
								        $user_result_arm = $user_string_report->arm;
								        echo '</td>';
								        echo '</tr>';								        
								    /*    if (!empty($user_string_report->director_comment)) {
								        echo '<tr>';
									        echo '<td colspan="10">';
									        	echo $user_string_report->director_comment;
									        echo '</td>';
								        echo '</tr>'; 
										};*/
					    		}
							}		 
							
		echo '</table>';
		
	die();
}
add_action('wp_ajax_detailedResultForAdmin', 'detailedResultForAdmin');
add_action('wp_ajax_nopriv_detailedResultForAdmin', 'detailedResultForAdmin');

// ----------- Отправка ежемесячного отчета /lk ----------- //
		function sendMonthlyReport(){
		global $wpdb;
			$current_user = wp_get_current_user();
			$user_id = $current_user->ID;
			$date_func = current_time ('Y-m-d',0);
			$monthly_weight = esc_attr(sanitize_text_field($_POST['monthly_weight']));
			$monthly_breast = esc_attr(sanitize_text_field($_POST['monthly_breast']));
			$monthly_waist = esc_attr(sanitize_text_field($_POST['monthly_waist']));
			$monthly_stomach = esc_attr(sanitize_text_field($_POST['monthly_stomach']));
			$monthly_booty = esc_attr(sanitize_text_field($_POST['monthly_booty']));
			$monthly_left_leg = esc_attr(sanitize_text_field($_POST['monthly_left_leg']));
			$monthly_right_leg = esc_attr(sanitize_text_field($_POST['monthly_right_leg']));
			$monthly_calf = esc_attr(sanitize_text_field($_POST['monthly_calf']));
			$monthly_arm = esc_attr(sanitize_text_field($_POST['monthly_arm']));
			$check_monthly_report = $wpdb->get_var( 
				"
				SELECT
				COUNT(*)
				FROM wpux_monthly_report
				WHERE user_id = $user_id
	            AND DATE(date) = '$date_func'
				"	
				);
				
		if ($check_monthly_report == 0) {
			if($wpdb->insert('wpux_monthly_report',array(
				'user_id' => $user_id,
				'date' => $date_func, 
				'weight' => $monthly_weight,
				'breast' => $monthly_breast,
				'waist' => $monthly_waist,
				'stomach' => $monthly_stomach,
				'booty' => $monthly_booty,
				'left_leg' => $monthly_left_leg,
				'right_leg' => $monthly_right_leg,
				'calf' => $monthly_calf,
				'arm' => $monthly_arm
			))===FALSE){
					echo '<p style="color: red;">Ошибка, отчет не был отправлен. Похоже проблемы с базой данных. Обратитесь к администратору сайта</p>';
				} else {
					echo "Ваши замеры успешно отправлены<br>Обновите страницу, чтобы увидеть результат";
				}
		}
		
		
		
		die();
		}
		add_action('wp_ajax_sendMonthlyReport', 'sendMonthlyReport');
		add_action('wp_ajax_nopriv_sendMonthlyReport', 'sendMonthlyReport');

/* ----------- Отправка заявки на следующий месяц из ежедневного отчета /lk ----------- 
function sendMaraphonNextMonth(){
				global $wpdb;
				    $current_user = wp_get_current_user();
				    $user_id = $current_user->ID;
				    $first_name = $current_user->user_firstname;
				    $last_name = $current_user->user_lastname;
					$telephone = $current_user->telephone;
					$email = $current_user->user_email;
					$date_func = current_time ('Y-m-d',0);
					$check_next_month_order = $wpdb->get_var( 
						"
						SELECT
						COUNT(*)
						FROM wpux_orders
						WHERE user_id = $user_id
			            AND DATE(date) = '$date_func'
						"	
						);
				
					if ($check_next_month_order == 0) {
	
					$_monthsList = array(
						"1"=>"январь","2"=>"февраль","3"=>"март",
						"4"=>"апрель","5"=>"май", "6"=>"июнь",
						"7"=>"июль","8"=>"август","9"=>"сентябрь",
						"10"=>"октябрь","11"=>"ноябрь","12"=>"декабрь");
						
					$n = current_time("m")+ 1 > 12 ? 1 : current_time("m")+1;
					$next_month = $_monthsList[$n];
					$year = current_time("m") + 1 > 12 ? current_time("Y") +1 : current_time("Y");

					$maraphon_next_month = 'марафон на '.$next_month.' '.$year.'г.';
  
			        $message  = sprintf(__('Здравствуйте, %s'), $first_name) . ",\n\n";
			        $message .= __('спасибо за ваш заказ на maraphon.online!') . "\n\n";

			        $message .= __('Ваш заказ:') . "\n\n";
			        if (!empty($maraphon_next_month)){
				        $message .= sprintf(__(' - %s'), $maraphon_next_month) . "\n";
			        };
			        if (!empty($women_menu)){
				        $message .= sprintf(__(' - женское меню %s'), $women_menu) . " ккал\n";
			        };
			        if (!empty($men_menu)){
				        $message .= sprintf(__(' - мужское меню %s'), $men_menu) . " ккал\n";
			        };
			        if (!empty($telegram)){
				        $message .= sprintf(__(' - %s'), $telegram) . "\n";
			        };
			        if (!empty($recipe_book)){
				        $message .= sprintf(__(' - %s'), $recipe_book) . "\n";
			        };
			        if (!empty($workout)){
				        $message .= sprintf(__(' - %s'), $workout) . "\n";
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
			        if (!empty($women_menu)){
				        $message_a .= sprintf(__(' - женское меню %s'), $women_menu) . " ккал\n";
			        };
			        if (!empty($men_menu)){
				        $message_a .= sprintf(__(' - мужское меню %s'), $men_menu) . " ккал\n";
			        };
			        if (!empty($telegram)){
				        $message_a .= sprintf(__(' - %s'), $telegram) . "\n";
			        };
			        if (!empty($recipe_book)){
				        $message_a .= sprintf(__(' - %s'), $recipe_book) . "\n";
			        };
			        if (!empty($workout)){
				        $message_a .= sprintf(__(' - %s'), $workout) . "\n";
			        };
			        $message_a .= __('') . "\n";
			        $message_a .= sprintf(__('Написать клиенту в Whatsapp: https://api.whatsapp.com/send?phone=%s'), $phone_whatsapp) . "\n";
			        wp_mail('info@maraphon.online', 'Новый заказ на сайте', $message_a, $headers, $attachments);
			        		
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
						'paid' => 0,
						'amount' => 0,
						'admin_comment' => '',
						'director_comment' => ''
						)
						); 
					};	//конец условия if ($check_next_month_order == 0)	
		die();
		}
add_action('wp_ajax_sendMaraphonNextMonth', 'sendMaraphonNextMonth');
add_action('wp_ajax_nopriv_sendMaraphonNextMonth', 'sendMaraphonNextMonth'); */

// -----------  Вывод отчета "Ежедневные отчеты участников" для пакета "Новичок" за 2 дня /director-cabinet ----------- // 
function showDailyReportNewbie(){
	echo '<span style="font-size: 24px;">';				
		$_monthsList = array(
		"01"=>"января","02"=>"февраля","03"=>"марта",
		"04"=>"апреля","05"=>"мая", "06"=>"июня",
		"07"=>"июля","08"=>"августа","09"=>"сентября",
		"10"=>"октября","11"=>"ноября","12"=>"декабря");
									
		$day_now = current_time('j');
		$maraphon_member_month = current_time('m.Y');
	
		if ($day_now == 1 || $day_now == 2) {
			$yesterday_month = current_time('m') - 1;
			if ($yesterday_month == 0) {$yesterday_month = '12'; $yesterday_year = current_time('Y') - 1;};
			if ($yesterday_month == 1) {$yesterday_month = '01'; $yesterday_year = current_time('Y');};
			if ($yesterday_month == 2) {$yesterday_month = '02'; $yesterday_year = current_time('Y');};
			if ($yesterday_month == 3) {$yesterday_month = '03'; $yesterday_year = current_time('Y');};
			if ($yesterday_month == 4) {$yesterday_month = '04'; $yesterday_year = current_time('Y');};
			if ($yesterday_month == 5) {$yesterday_month = '05'; $yesterday_year = current_time('Y');};
			if ($yesterday_month == 6) {$yesterday_month = '06'; $yesterday_year = current_time('Y');};
			if ($yesterday_month == 7) {$yesterday_month = '07'; $yesterday_year = current_time('Y');};
			if ($yesterday_month == 8) {$yesterday_month = '08'; $yesterday_year = current_time('Y');};
			if ($yesterday_month == 9) {$yesterday_month = '09'; $yesterday_year = current_time('Y');};
			if ($yesterday_month == 10) {$yesterday_month = '10'; $yesterday_year = current_time('Y');};
			if ($yesterday_month == 11) {$yesterday_month = '11'; $yesterday_year = current_time('Y');};
			$two_days_start = '29';
			$two_days_finish = '30';
			$two_days_start_db = $yesterday_year.'-'.$yesterday_month.'-29';
			$two_days_finish_db = $yesterday_year.'-'.$yesterday_month.'-30';
			$this_month_for_button = $_monthsList[$yesterday_month];						
		} else {
			if ($day_now == 3 || $day_now == 4) {$two_days_start = '1'; $two_days_finish = '2';};
			if ($day_now == 5 || $day_now == 6) {$two_days_start = '3'; $two_days_finish = '4';};
			if ($day_now == 7 || $day_now == 8) {$two_days_start = '5'; $two_days_finish = '6';};
			if ($day_now == 9 || $day_now == 10) {$two_days_start = '7'; $two_days_finish = '8';};
			if ($day_now == 11 || $day_now == 12) {$two_days_start = '09'; $two_days_finish = '10';};
			if ($day_now == 13 || $day_now == 14) {$two_days_start = '11'; $two_days_finish = '12';};
			if ($day_now == 15 || $day_now == 16) {$two_days_start = '13'; $two_days_finish = '14';};
			if ($day_now == 17 || $day_now == 18) {$two_days_start = '15'; $two_days_finish = '16';};
			if ($day_now == 19 || $day_now == 20) {$two_days_start = '17'; $two_days_finish = '18';};
			if ($day_now == 21 || $day_now == 22) {$two_days_start = '19'; $two_days_finish = '20';};
			if ($day_now == 23 || $day_now == 24) {$two_days_start = '21'; $two_days_finish = '22';};
			if ($day_now == 25 || $day_now == 26) {$two_days_start = '23'; $two_days_finish = '24';};
			if ($day_now == 27 || $day_now == 28) {$two_days_start = '25'; $two_days_finish = '26';};
			if ($day_now == 29 || $day_now == 30) {$two_days_start = '27'; $two_days_finish = '28';};	
			$two_days_start_db = current_time('Y-m').'-'.$two_days_start;
			$two_days_finish_db = current_time('Y-m').'-'.$two_days_finish;
			$this_month_for_button = $_monthsList[current_time('m')];
			$yesterday_year = current_time('Y');
		};
			
		echo 'Отчеты "Новичков" с '.$two_days_start.' по '.$two_days_finish.' '.$this_month_for_button.' '.$yesterday_year;
	echo '</span>';
				
	echo '<form id="daily_report_today_form">';
		global $wpdb;
		$current_user = wp_get_current_user();
		$current_user_report = $current_user->ID;
		$today_for_admin = current_time('Y-m-d',0);
		$this_month_report = $wpdb->get_results(
		"
		SELECT
	    u.user_id,
	    u.date,
	    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'first_name' limit 1) as first_name,
	    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'last_name' limit 1) as last_name,
	    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'height' limit 1) as height,
	    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'weight_at_1_maraphon' limit 1) as weight_at_1_maraphon,
	    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'telephone' limit 1) as telephone,
	    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'first_menstruation_day' limit 1) as first_menstruation_day,
        u.comment AS comment,
        orders.director_comment
		FROM wpux_daily_report u, wpux_orders orders
		WHERE u.user_id = orders.user_id
        AND orders.date =
						(
						SELECT MAX(DATE)
						FROM wpux_orders orders2
						WHERE orders.user_id = orders2.user_id
                        AND orders2.maraphon_member_month = '$maraphon_member_month'
                        AND (orders2.maraphon_next_month LIKE '%Новичок%' OR orders.maraphon_next_month LIKE '%Семейный%')
                        AND orders2.curator = 'Екатерина'
						)
		AND DATE(u.date) BETWEEN '$two_days_start_db' AND '$two_days_finish_db'
		AND u.comment = 'Отчет на проверке'
        GROUP BY u.user_id
        ORDER BY last_name
		"
		);	
		if( $this_month_report ) {
		    foreach ( $this_month_report as $string_report ) {
			    $current_user_id_for_input = $string_report->user_id;
			    echo '<div class="table_shadow">';
			    	echo '<table class="daily_report_table_1">';
						echo '<tr>';
						        echo '<td style="width: 25% !important; text-align: center; font-size: 22px;">';
								$name = $string_report->first_name;
								$surname = $string_report->last_name;
								$fio = $surname.' '.$name;
								echo '<a href="http://maraphon.online/wp-admin/user-edit.php?user_id='.$current_user_id_for_input.'&wp_http_referer=%2Fwp-admin%2Fusers.php" target="_blank">'.$fio.'</a>';
						        echo '</td>';
						        
						        echo '<td style="width: 6%; text-align: center; padding-left 5px; padding-top: 5px; font-size: 18px">';
						        echo'<strong>ID '.$current_user_id_for_input.'</strong>';
						        echo '</td>';
						        
						        echo '<td style="width: 9% !important; padding-top: 5px; font-size: 18px;">';
						        echo '<p class="day_result_report" id="day_result_report_id_'.$current_user_id_for_input.'" style="margin-bottom: 0px !important; cursor: pointer"><i style="font-size: 26px;" class="fa fa-trophy" aria-hidden="true"></i></p>';
						        echo '</td>';
						        
						        echo '<td style="width: 9% !important; color: blue; padding-top: 5px; font-size: 18px; font-weight: 200;">';
						        $height = $string_report->height;  
						        echo $height;
						        echo '</td>';
						        
						        echo '<td style="width: 9% !important; color: green; padding-top: 5px; font-size: 18px; font-weight: 200;">';
						        $weight_at_1_maraphon = $string_report->weight_at_1_maraphon;  
						        echo $weight_at_1_maraphon;
						        echo '</td>';
						        
						        echo '<td style="width: 9% !important; color: #fec300; padding-top: 5px; font-size: 18px; font-weight: 200;">';
						        $user_meta = get_userdata($current_user_id_for_input);
								$user_role = substr($user_meta->roles[0], -4, 4);
								echo $user_role;
								echo '</td>';

						        echo '<td style="width: 12% !important; color: red; padding-top: 5px; font-size: 18px; font-weight: 200;">';
						        $first_menstruation_day = $string_report->first_menstruation_day;  
						        echo $first_menstruation_day;
						        echo '</td>';
						        
								echo '<td style="width: 12%">';
						        $whatsapp_number = $string_report->telephone;
						        $phone= str_replace([' ', '(', ')', '-', '_'], '', $whatsapp_number);
								$phone = preg_replace('/^8/', '+7', $phone);
								$phone = preg_replace('/^7/', '+7', $phone);    
						        echo '<a href="https://api.whatsapp.com/send?phone='.$phone.'" target="_blank"><img style="width: 30px; padding-top: 2px; margin-bottom: -8px;" src="http://maraphon.online/wp-content/uploads/whatsapp-icon-180×180.png"/></a>';
						        echo '</td>';
						        
						        echo '</tr>';

						        echo '<tr>';
						        	echo '<td>';
						        		echo 'История участника';
						        	echo '</td>';

						        	echo '<td colspan="7">';
						        		echo '<textarea class="history_textarea" id="history_comment_id_'.$current_user_id_for_input.'" name="history_comment_id_'.$current_user_id_for_input.'" rows="2" cols="1" maxlength="255">'.get_the_author_meta( 'history_comment', $current_user_id_for_input ).'</textarea>';
						        	echo '</td>';
						        echo '</tr>';
						        
						        echo '<tr>';
						        	echo '<td>';
						        		echo 'Комментарий директора';
						        	echo '</td>';
						        	
						        	echo '<td colspan="7">';
						        		echo $string_report->director_comment;
						        	echo '</td>';
						echo '</tr>';
						        
						echo '<tr>';
						        	echo '<td style="background-color: #f6f6f6;" colspan="6">';
						        		echo '<div class="resultDayTableForAdmin" id="resultDayTableForAdmin_'.$current_user_id_for_input.'"></div>';
						        	echo '</td>';
						echo '</tr>';
						        
					echo '</table>'; //конец 1 таблицы
						        
					echo '<table class="daily_report_table_2">';
				        echo '<tr>';
							echo '<th style="width: 4%;">Дата</th>';
							echo '<th style="width: 14%;">&nbsp;Активность&nbsp;</th>';
						    echo '<th style="width: 7%;">&nbsp;Алко.&nbsp;</th>';  
						    echo '<th style="width: 6%;">&nbsp;Мес.&nbsp;</th>';
						    echo '<th style="width: 5%;">&nbsp;Вес&nbsp;</th>';
						    echo '<th style="width: 35%;">Как прошел день</th>';
						    echo '<th style="width: 28%;">&nbsp;Комментарий&nbsp;</th>';
						echo '</tr>';

					$current_month = current_time ('n',0);
					$year_before = current_time('Y');
					$month_before = $current_month - 1;
					if ($month_before == '0') {
						$month_before = 12;
						$year_before = current_time('Y') - 1;
					};
					$current_month_report_start = $year_before.'-'.$month_before.'-28';
					$current_month_report_end = current_time ('Y-m',0).'-31';							
								
					$this_month_report = $wpdb->get_results( 
					"
					SELECT *
					FROM wpux_daily_report daily
					WHERE daily.user_id = $current_user_id_for_input
					AND (DATE(daily.date) BETWEEN '$current_month_report_start' AND '$current_month_report_end')
					ORDER BY daily.date
					"
					);
					if ( $this_month_report ) {
					    foreach ( $this_month_report as $string_report ) {
						    if ($string_report->cheatmeal == '1') {
						        $cheat_fail_color = '#dff1d9';
						        } else if ($string_report->failure == '1') {
							        $cheat_fail_color = '#f8d7da';
							        } else if ($string_report->snack == '1') {
								        $cheat_fail_color = '#fff3cd';
								        } else {
									        $cheat_fail_color = 'white';
							};
								        
							$database_date =  $string_report->date;
							$database_day = substr($database_date, 8);
							$database_month = substr($database_date, 5, 2);
										        
							if ($string_report->alcohol == 'Нет' || $string_report->alcohol == 'нет' || $string_report->alcohol == '-') {
							    $alcohol_color = '#404040';
							} else {
							    $alcohol_color = '#468df9';
							};
										        
							if ($string_report->menstruation == 'Есть') {
							    $menstruation_color = 'red';
							} else {
							    $menstruation_color = '#404040';
							}; 				    
											    
					        echo '<tr class="daily_report_table_2_tr">';
										        
						        echo '<td style="width: 4%; background-color: '.$cheat_fail_color.'">';
							        echo $database_day.'.'.$database_month;
						        echo '</td>';
										        
						        echo '<td style="width: 14%; background-color: '.$cheat_fail_color.'">';
							        echo $string_report->activity;
						        echo '</td>';
										        
						        echo '<td style="color: '.$alcohol_color.'; width: 7%; background-color: '.$cheat_fail_color.'">';
							        echo $string_report->alcohol;
						        echo '</td>';
										        
						        echo '<td style="width: 6%; color: '.$menstruation_color.'; background-color: '.$cheat_fail_color.'">'; 
							        echo $string_report->menstruation;
						        echo '</td>';
										        
							    echo '<td style="width: 5%; background-color: '.$cheat_fail_color.'">'; 
							        echo $string_report->today_weight;
							    echo '</td>';
										        
							    echo '<td style="width: 35%; background-color: '.$cheat_fail_color.'">'; 
							        echo $string_report->task;
							    echo '</td>'; 
										        
							    echo '<td style="width: 28%; background-color: '.$cheat_fail_color.'">'; 
							        echo $string_report->comment;
							    echo '</td>';  
										        
							echo '</tr>';       
						};
					echo '</table>'; //конец 2 таблицы за сегодня   
					};	 	       
								
					echo '<table class="daily_report_table_3">';
						    echo '<tr>';
						        
						        echo '<td class="choose_variant_daily_report">';
							    	echo '<input class="text-input" style="width: 100%; border: 2px solid #fec300; font-size: 16px;" name="admin_answer_comment_for_admin_id_'.$current_user_id_for_input.'" type="text" id="admin_answer_comment_for_admin_id_'.$current_user_id_for_input.'" value="'.$admin_answer_comment_for_admin.'" />';
						        echo '</td>';
						        
						        echo '<td style="width: 22px;">';
						        	echo '
							        <select class="daily_report_comment" name="admin_answer_today_id_'.$current_user_id_for_input.'" id="admin_answer_today_id_'.$current_user_id_for_input.'">
						                    	<option disabled hidden selected>Выбрать ответ</option>
						                    	<option>Умничка)</option>
						                    	<option>Всё хорошо, не переживай)</option>
						                    	<option>ОГОНЬ</option>
						                    	<option>Скоро цикл, так что все хорошо</option>
						                    	<option>Молодец</option>
						                    	<option>ХОРОШО</option>
						                    	<option>ОТЛИЧНО</option>
						                    	<option>Так держать</option>
						                    	<option>Не налегай на вкусняшки</option>
						                    	<option>Все хорошо</option>
						                    	<option>Не критично</option>
						                    	<option>Скорейшего выздоровления</option>
						                    	<option>Стабильность тоже отлично</option>
						                    	<option>Сейчас напишу в Whatsapp</option>
					                    	</select>    
							        ';
						        echo '</td>'; 
						        	        
						    echo '</tr>';
						        
					echo '</table>'; //конец 3 таблицы 
						        
				echo '</div>'; //table_shadow
						        
				echo '<div class="daily_report_yellow_line"></div>';
					};
				};		
				
				echo '<p class="daily_report_admin_answer_submit" >';
					echo '<input type="hidden" name="action" value="updateDailyReportNewbie"/>';
					echo '<input name="updateDailyReportNewbie" type="submit" id="daily_report_admin_answer_newbie_submit" class="submit button" value="Проверить отчеты с '.$two_days_start.' по '.$two_days_finish.' '.$this_month_for_button.'" />';

					echo '</p>';
				echo '</form>';		
				
				echo '<div id="success_form"><p>Данные обновлены</p></div>';		
									
					echo '<script type="text/javascript">';  // обновление отчета для пакета "Новичок" за 2 дня
					echo 'jQuery("#daily_report_today_form").submit(ajaxUpdateDailyReportNewbie);'; 
					echo 'function ajaxUpdateDailyReportNewbie(){'; 
						echo 'var dailyReportNewbie = jQuery(this).serialize();'; 
						echo 'jQuery.ajax({'; 
							echo 'type:"POST",'; 
							echo 'url: "/wp-admin/admin-ajax.php",'; 
							echo 'data: dailyReportNewbie,';
							echo 'success:function(data){'; 
							echo '$("#success_form").show();'; 
							echo 'setTimeout(function(){$("#success_form").fadeOut("slow")},1000);';
							echo '}'; 
						echo '});'; 
					echo 'return false;'; 
					echo '}'; 
					echo '</script>'; 				

				echo '<script type="text/javascript">';  //Подстановка готовых вариантов в поле для ответа
					echo '$(function() {';
						echo 'function selectToInput(){';
							echo 'var selectid = this.id;';
							echo 'var id = selectid.substr(22);';
							echo 'var stringResult = "#" + selectid + " :selected";';
							echo 'var result = $(stringResult).text();';
							echo 'var stringid = "#admin_answer_comment_for_admin_id_" + id;';
							echo '$(stringid).val(result);';
							echo '}';
						echo '$(".daily_report_comment").change(selectToInput);';
					echo '});';
				echo '</script>';
				
				echo '<script type="text/javascript">'; //вывод полной таблицы результатов
					echo '$(function() {';
					    echo 'function showDayResultTableForAdmin(){';
						  
					      echo 'var idResultMembers = this.id;';
					      echo 'idResultRightMembers = idResultMembers.substr(21);';
						  echo '$.ajaxSetup({cache: false});';
							echo 'jQuery.ajax({';
								echo 'type:"POST",';
								echo 'url: "/wp-admin/admin-ajax.php",';
								echo 'data: {action: "detailedResultForAdmin",';
									  echo 'idResultRightMembers,';
								echo '},';
								echo 'success:function(data){';
								echo 'jQuery("#resultDayTableForAdmin_" + idResultRightMembers).html(data);';
								echo '}';
							echo '});';
							echo 'return false;';
						echo '}';
					    echo '$(".day_result_report").click(showDayResultTableForAdmin);';
					echo '});';
					echo '</script>';  
					
					echo '<script>'; //закрытие результатов участников марафона по клику области вне отчета
						echo 'jQuery(function($){';
						echo '$(document).click(function (e){';
							echo 'var div = $(".resultDayTableForAdmin");';
							echo 'if (!div.is(e.target)';
							    echo '&& div.has(e.target).length === 0) {';
								echo 'div.empty();';
							echo '}';
								echo '});';
						echo '});';  
					echo '</script>';
	die();
}
add_action('wp_ajax_showDailyReportNewbie', 'showDailyReportNewbie');
add_action('wp_ajax_nopriv_showDailyReportNewbie', 'showDailyReportNewbie'); // на самом деле не нужна

// ----------- Обновление отчета "Ежедневные отчеты участников" для пакета "Новичок" за 2 дня /director-cabinet ----------- // 
function updateDailyReportNewbie(){
					global $wpdb;
					
					$day_now = current_time('j');
					$maraphon_member_month = current_time('m.Y');

						if ($day_now == 1 || $day_now == 2) {
							$yesterday_month = current_time('m') - 1;
							if ($yesterday_month == 0) {$yesterday_month = '12'; $yesterday_year = current_time('Y') - 1;};
							if ($yesterday_month == 1) {$yesterday_month = '01'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 2) {$yesterday_month = '02'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 3) {$yesterday_month = '03'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 4) {$yesterday_month = '04'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 5) {$yesterday_month = '05'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 6) {$yesterday_month = '06'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 7) {$yesterday_month = '07'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 8) {$yesterday_month = '08'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 9) {$yesterday_month = '09'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 10) {$yesterday_month = '10'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 11) {$yesterday_month = '11'; $yesterday_year = current_time('Y');};
							$two_days_start_db = $yesterday_year.'-'.$yesterday_month.'-28';
							$two_days_finish_db = $yesterday_year.'-'.$yesterday_month.'-30';
							
						} else {
						if ($day_now == 3 || $day_now == 4) {$two_days_start = '1'; $two_days_finish = '2';};
						if ($day_now == 5 || $day_now == 6) {$two_days_start = '3'; $two_days_finish = '4';};
						if ($day_now == 7 || $day_now == 8) {$two_days_start = '5'; $two_days_finish = '6';};
						if ($day_now == 9 || $day_now == 10) {$two_days_start = '7'; $two_days_finish = '8';};
						if ($day_now == 11 || $day_now == 12) {$two_days_start = '09'; $two_days_finish = '10';};
						if ($day_now == 13 || $day_now == 14) {$two_days_start = '11'; $two_days_finish = '12';};
						if ($day_now == 15 || $day_now == 16) {$two_days_start = '13'; $two_days_finish = '14';};
						if ($day_now == 17 || $day_now == 18) {$two_days_start = '15'; $two_days_finish = '16';};
						if ($day_now == 19 || $day_now == 20) {$two_days_start = '17'; $two_days_finish = '18';};
						if ($day_now == 21 || $day_now == 22) {$two_days_start = '19'; $two_days_finish = '20';};
						if ($day_now == 23 || $day_now == 24) {$two_days_start = '21'; $two_days_finish = '22';};
						if ($day_now == 25 || $day_now == 26) {$two_days_start = '23'; $two_days_finish = '24';};
						if ($day_now == 27 || $day_now == 28) {$two_days_start = '25'; $two_days_finish = '26';};
						if ($day_now == 29 || $day_now == 30) {$two_days_start = '27'; $two_days_finish = '28';};	
						$two_days_start_db = current_time('Y-m').'-'.$two_days_start;
						$two_days_finish_db = current_time('Y-m').'-'.$two_days_finish;
						};
					
			        $answer_report_data = $wpdb->get_results(
					"
					SELECT
				    u.user_id,
				    u.date,
				    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'first_name' limit 1) as first_name,
				    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'last_name' limit 1) as last_name,
				    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'height' limit 1) as height,
				    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'weight_at_1_maraphon' limit 1) as weight_at_1_maraphon,
				    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'telephone' limit 1) as telephone,
				    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'first_menstruation_day' limit 1) as first_menstruation_day,
			        u.comment AS comment
					FROM wpux_daily_report u, wpux_orders orders
					WHERE u.user_id = orders.user_id
			        AND orders.date =
									(
									SELECT MAX(DATE)
									FROM wpux_orders orders2
									WHERE orders.user_id = orders2.user_id
			                        AND orders2.maraphon_member_month = '$maraphon_member_month'
			                        AND (orders2.maraphon_next_month LIKE '%Новичок%' OR orders.maraphon_next_month LIKE '%Семейный%')
			                        AND orders2.curator = 'Екатерина'
									)
					AND u.date = '$two_days_start_db'
					AND u.comment = 'Отчет на проверке'
			        ORDER BY last_name
					"
					);	
						if( $answer_report_data ) {
					    	foreach ( $answer_report_data as $string_report_data ) {
							    $current_user_id_for_output = $string_report_data->user_id;
							    $data1 = 'admin_answer_comment_for_admin_id_'.$current_user_id_for_output.'';
								$comment_report_today = $_POST[$data1];
								
								if (!empty($comment_report_today)){
									$wpdb->update(
									'wpux_daily_report',
									array( 
									'comment' => $comment_report_today
									),
									array(
									'user_id' => $current_user_id_for_output,
									'date' => $two_days_start_db
									)
									); 
								};
		    				}; //Тело цикла
						}; //Тело первоначального условия
						
					$answer_report_data1 = $wpdb->get_results(
					"
					SELECT
				    u.user_id,
				    u.date,
				    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'first_name' limit 1) as first_name,
				    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'last_name' limit 1) as last_name,
				    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'height' limit 1) as height,
				    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'weight_at_1_maraphon' limit 1) as weight_at_1_maraphon,
				    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'telephone' limit 1) as telephone,
				    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'first_menstruation_day' limit 1) as first_menstruation_day,
			        u.comment AS comment
					FROM wpux_daily_report u, wpux_orders orders
					WHERE u.user_id = orders.user_id
			        AND orders.date =
									(
									SELECT MAX(DATE)
									FROM wpux_orders orders2
									WHERE orders.user_id = orders2.user_id
			                        AND orders2.maraphon_member_month = '$maraphon_member_month'
			                        AND (orders2.maraphon_next_month LIKE '%Новичок%' OR orders.maraphon_next_month LIKE '%Семейный%')
			                        AND orders2.curator = 'Екатерина'
									)
					AND u.date = '$two_days_finish_db'
					AND u.comment = 'Отчет на проверке'
			        ORDER BY last_name
					"
					);	
						if( $answer_report_data1 ) {
					    	foreach ( $answer_report_data1 as $string_report_data1 ) {
							    $current_user_id_for_output1 = $string_report_data1->user_id;
							    $data2 = 'admin_answer_comment_for_admin_id_'.$current_user_id_for_output1.'';
								$comment_report_today1 = $_POST[$data2];
								$data3 = 'history_comment_id_'.$current_user_id_for_output1;
								$history_comment = $_POST[$data3];
								update_user_meta( $current_user_id_for_output1, 'history_comment', $history_comment );
								
								if (!empty($comment_report_today1)){
									$wpdb->update(
									'wpux_daily_report',
									array( 
									'comment' => $comment_report_today1
									),
									array(
									'user_id' => $current_user_id_for_output1,
									'date' => $two_days_finish_db
									)
									); 
								};
		    				}; //Тело цикла
						}; //Тело первоначального условия		
	die();
}
add_action('wp_ajax_updateDailyReportNewbie', 'updateDailyReportNewbie');
add_action('wp_ajax_nopriv_updateDailyReportNewbie', 'updateDailyReportNewbie');

// -----------  Вывод отчета "Ежедневные отчеты участников" для пакета "Профи" за 4 дня/director-cabinet ----------- // 
function showDailyReportProfy(){
	global $wpdb;
	$curator = $_POST['curator'];
	if ($curator == 'main_curator_profy_report_button') {$curator = 'Екатерина'; $curator_id = 'main_curator';} else
	if ($curator == 'curator_1_profy_report_button') {$curator = 'Наталья'; $curator_id = 'curator_1';} else
	if ($curator == 'curator_2_profy_report_button') {$curator = 'Дмитрий'; $curator_id = 'curator_2';};
	$current_user = wp_get_current_user();
	$user_id = $current_user->ID;
	
		
		$_monthsList = array(
		"01"=>"января","02"=>"февраля","03"=>"марта",
		"04"=>"апреля","05"=>"мая", "06"=>"июня",
		"07"=>"июля","08"=>"августа","09"=>"сентября",
		"10"=>"октября","11"=>"ноября","12"=>"декабря");
								
		$day_now = current_time('j');
		$maraphon_member_month = current_time('m.Y');

		if ($day_now == 1 || $day_now == 2 || $day_now == 3 || $day_now == 4) {
			$yesterday_month = current_time('n') - 1;
			if ($yesterday_month == 0) {$yesterday_month = '12'; $yesterday_year = current_time('Y') - 1;};
			if ($yesterday_month == 1) {$yesterday_month = '01'; $yesterday_year = current_time('Y');};
			if ($yesterday_month == 2) {$yesterday_month = '02'; $yesterday_year = current_time('Y');};
			if ($yesterday_month == 3) {$yesterday_month = '03'; $yesterday_year = current_time('Y');};
			if ($yesterday_month == 4) {$yesterday_month = '04'; $yesterday_year = current_time('Y');};
			if ($yesterday_month == 5) {$yesterday_month = '05'; $yesterday_year = current_time('Y');};
			if ($yesterday_month == 6) {$yesterday_month = '06'; $yesterday_year = current_time('Y');};
			if ($yesterday_month == 7) {$yesterday_month = '07'; $yesterday_year = current_time('Y');};
			if ($yesterday_month == 8) {$yesterday_month = '08'; $yesterday_year = current_time('Y');};
			if ($yesterday_month == 9) {$yesterday_month = '09'; $yesterday_year = current_time('Y');};
			if ($yesterday_month == 10) {$yesterday_month = '10'; $yesterday_year = current_time('Y');};
			if ($yesterday_month == 11) {$yesterday_month = '11'; $yesterday_year = current_time('Y');};
			$four_days_start = '29';
			$four_days_finish = '31';
			$four_days_start_db = $yesterday_year.'-'.$yesterday_month.'-29';
			$four_days_finish_db = $yesterday_year.'-'.$yesterday_month.'-31';
			$this_month_for_button = $_monthsList[$yesterday_month];	
				} else {
					if ($day_now == 5 || $day_now == 6 || $day_now == 7 || $day_now == 8) {$four_days_start = '01'; $four_days_finish = '04';};
					if ($day_now == 9 || $day_now == 10 || $day_now == 11 || $day_now == 12) {$four_days_start = '05'; $four_days_finish = '08';};
					if ($day_now == 13 || $day_now == 14 || $day_now == 15 || $day_now == 16) {$four_days_start = '09'; $four_days_finish = '12';};
					if ($day_now == 17 || $day_now == 18 || $day_now == 19 || $day_now == 20) {$four_days_start = '13'; $four_days_finish = '16';};
					if ($day_now == 21 || $day_now == 22 || $day_now == 23 || $day_now == 24) {$four_days_start = '17'; $four_days_finish = '20';};
					if ($day_now == 25 || $day_now == 26 || $day_now == 27 || $day_now == 28) {$four_days_start = '21'; $four_days_finish = '24';};
					if ($day_now == 29 || $day_now == 30 || $day_now == 31) {$four_days_start = '25'; $four_days_finish = '28';};	
					$four_days_start_db = current_time('Y-m').'-'.$four_days_start;
					$four_days_finish_db = current_time('Y-m').'-'.$four_days_finish;
					$this_month_for_button = $_monthsList[current_time('m')];
					$yesterday_year = current_time('Y');
				};
	
	$profy_month_report = $wpdb->get_results(
		"
		SELECT
	        u.user_id AS user_id_check,
		    u.date AS date,
		    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'first_name' limit 1) as first_name,
		    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'last_name' limit 1) as last_name,
		    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'height' limit 1) as height,
		    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'weight_at_1_maraphon' limit 1) as weight_at_1_maraphon,
		    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'telephone' limit 1) as telephone,
		    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'first_menstruation_day' limit 1) as first_menstruation_day,
            u.comment AS comment,
            orders.director_comment
			FROM wpux_daily_report u, wpux_orders orders
			WHERE u.user_id = orders.user_id
            AND orders.date =
								(
								SELECT MAX(DATE)
								FROM wpux_orders orders2
								WHERE orders.user_id = orders2.user_id
                                AND orders2.maraphon_member_month = '$maraphon_member_month'
                                AND orders2.maraphon_next_month LIKE '%Профи%'
                                AND orders2.curator = '$curator'
								)
            AND DATE(u.date) BETWEEN '$four_days_start_db' AND '$four_days_finish_db'
			AND u.comment = 'Отчет на проверке'
            GROUP BY u.user_id
            ORDER BY last_name
		"
	);
	
	echo '<span style="font-size: 24px;" class="check_curator" id="'.$curator_id.'">Отчеты "Профи" с '.$four_days_start.' по '.$four_days_finish.' '.$this_month_for_button.' '.$yesterday_year.'г. '.'Куратор '.$curator.'</span>';
	echo '<form id="daily_report_today_form">';
	
	if ($profy_month_report) {
		foreach ( $profy_month_report as $profy_month_string_report ) {
			$current_user_id_for_input = $profy_month_string_report->user_id_check;
			echo '<div class="table_shadow">';
			echo '<table class="daily_report_table_1">';
						echo '<tr>';
						        echo '<td style="width: 25% !important; text-align: center; font-size: 22px;">';
								$name = $profy_month_string_report->first_name;
								$surname = $profy_month_string_report->last_name;
								$fio = $surname.' '.$name;
								echo '<a href="http://maraphon.online/wp-admin/user-edit.php?user_id='.$current_user_id_for_input.'&wp_http_referer=%2Fwp-admin%2Fusers.php" target="_blank">'.$fio.'</a>';
						        echo '</td>';
						        
						        echo '<td style="width: 6%; text-align: center; padding-left 5px; padding-top: 5px; font-size: 18px">';
						        echo'<strong>ID '.$current_user_id_for_input.'</strong>';
						        echo '</td>';
						        
						        echo '<td style="width: 9% !important; padding-top: 5px; font-size: 18px;">';
						        echo '<p class="day_result_report" id="day_result_report_id_'.$current_user_id_for_input.'" style="margin-bottom: 0px !important; cursor: pointer"><i style="font-size: 26px;" class="fa fa-trophy" aria-hidden="true"></i></p>';
						        echo '</td>';
						        
						        echo '<td style="width: 9% !important; color: blue; padding-top: 5px; font-size: 18px; font-weight: 200;">';
						        $height = $profy_month_string_report->height;  
						        echo $height;
						        echo '</td>';
						        
						        echo '<td style="width: 9% !important; color: green; padding-top: 5px; font-size: 18px; font-weight: 200;">';
						        $weight_at_1_maraphon = $profy_month_string_report->weight_at_1_maraphon;  
						        echo $weight_at_1_maraphon;
						        echo '</td>';
						        
						        echo '<td style="width: 9% !important; color: #fec300; padding-top: 5px; font-size: 18px; font-weight: 200;">';
						        $user_meta = get_userdata($current_user_id_for_input);
								$user_role = substr($user_meta->roles[0], -4, 4);
								echo $user_role;
								echo '</td>';

						        echo '<td style="width: 12% !important; color: red; padding-top: 5px; font-size: 18px; font-weight: 200;">';
						        $first_menstruation_day = $profy_month_string_report->first_menstruation_day;  
						        echo $first_menstruation_day;
						        echo '</td>';
						        
								echo '<td style="width: 12%">';
						        $whatsapp_number = $profy_month_string_report->telephone;
						        $phone= str_replace([' ', '(', ')', '-', '_'], '', $whatsapp_number);
								$phone = preg_replace('/^8/', '+7', $phone);
								$phone = preg_replace('/^7/', '+7', $phone);    
						        echo '<a href="https://api.whatsapp.com/send?phone='.$phone.'" target="_blank"><img style="width: 30px; padding-top: 2px; margin-bottom: -8px;" src="http://maraphon.online/wp-content/uploads/whatsapp-icon-180×180.png"/></a>';
						        echo '</td>';
						        
						        echo '</tr>';

						        echo '<tr>';
						        	echo '<td>';
						        		echo 'История участника';
						        	echo '</td>';

						        	echo '<td colspan="7">';
						        		echo '<textarea class="history_textarea" id="history_comment_id_'.$current_user_id_for_input.'" name="history_comment_id_'.$current_user_id_for_input.'" rows="2" cols="1" maxlength="255">'.get_the_author_meta( 'history_comment', $current_user_id_for_input ).'</textarea>';
						        	echo '</td>';
						        echo '</tr>';
						        
						        echo '<tr>';
						        	echo '<td>';
						        		echo 'Комментарий директора';
						        	echo '</td>';
						        	
						        	echo '<td colspan="7">';
						        		echo $profy_month_string_report->director_comment;
						        	echo '</td>';
						echo '</tr>';
						        
						echo '<tr>';
						        	echo '<td style="background-color: #f6f6f6;" colspan="6">';
						        		echo '<div class="resultDayTableForAdmin" id="resultDayTableForAdmin_'.$current_user_id_for_input.'"></div>';
						        	echo '</td>';
						echo '</tr>';
						        
			echo '</table>'; //конец 1 таблицы для ежедневных отчетов "Профи"
			
			$year_before = current_time('Y');
			$month_before = current_time('n') - 1;
			if ($month_before == '0') {
				$month_before = 12;
				$year_before = current_time('Y') - 1;
			} else if ($month_before > 0 && $month_before < 10) {
				$month_before = '0'.$month_before;
			};
			
			$current_month_report_start = $year_before.'-'.$month_before.'-29';
			$current_month_report_end = current_time ('Y-m').'-31';
			
			echo '<table class="daily_report_table_2">';
				echo '<tr>';
					echo '<th style="width: 4%;">Дата</th>';
					echo '<th style="width: 14%;">Активность</th>';
				    echo '<th style="width: 7%;">&nbsp;Алко.&nbsp;</th>';  
				    echo '<th style="width: 6%;">&nbsp;Мес.&nbsp;</th>';
				    echo '<th style="width: 5%;">&nbsp;Вес&nbsp;</th>';
				    echo '<th style="width: 35%;">Как прошел день</th>';
				    echo '<th style="width: 28%;">Комментарий</th>';
				echo '</tr>';
			
			$this_month_report = $wpdb->get_results( 
				"
				SELECT *
				FROM wpux_daily_report daily
				WHERE daily.user_id = $current_user_id_for_input
				AND (DATE(daily.date) BETWEEN '$current_month_report_start' AND '$current_month_report_end')
				ORDER BY daily.date
				"
				);
								
				if( $this_month_report ) {
				    foreach ( $this_month_report as $string_report ) {
						if ($string_report->cheatmeal == '1') {
							$cheat_fail_color = '#dff1d9';
								} else if ($string_report->failure == '1') {
								$cheat_fail_color = '#f8d7da';
									} else if ($string_report->snack == '1') {
									$cheat_fail_color = '#fff3cd';
										} else {
										$cheat_fail_color = 'white';
							};
								        
							$database_date =  $string_report->date;
							$database_day = substr($database_date, 8);
							$database_month = substr($database_date, 5, 2);
								        
							if ($string_report->alcohol == 'Нет' || $string_report->alcohol == 'нет' || $string_report->alcohol == '-') {
							    $alcohol_color = '#404040';
								    } else {
								    	$alcohol_color = '#468df9';
							};
								        
							if ($string_report->menstruation == 'Есть') {
							    $menstruation_color = 'red';
							        } else {
								        $menstruation_color = '#404040';
							}; 
									    
									    
							echo '<tr class="daily_report_table_2_tr">';
								        
							echo '<td style="width: 4%; background-color: '.$cheat_fail_color.'">';
							echo $database_day.'.'.$database_month;
							echo '</td>';
								        
							echo '<td style="width: 14%; background-color: '.$cheat_fail_color.'">';
							echo $string_report->activity;
							echo '</td>';
								        
							echo '<td style="color: '.$alcohol_color.'; width: 7%; background-color: '.$cheat_fail_color.'">';
							echo $string_report->alcohol;
							echo '</td>';
								        
							echo '<td style="width: 6%; color: '.$menstruation_color.'; background-color: '.$cheat_fail_color.'">'; 
							echo $string_report->menstruation;
							echo '</td>';
								        
							echo '<td style="width: 5%; background-color: '.$cheat_fail_color.'">'; 
							echo $string_report->today_weight;
							echo '</td>';
								        
							echo '<td style="width: 35%; background-color: '.$cheat_fail_color.'">'; 
							echo $string_report->task;
							echo '</td>'; 
								        
							echo '<td style="width: 28%; background-color: '.$cheat_fail_color.'">'; 
							echo $string_report->comment;
							echo '</td>';  
								        
							echo '</tr>';       
					    };
				echo '</table>'; //конец 2 таблицы для ежедневных отчетов "Профи" 
				};		    				
					    				
				echo '<table class="daily_report_table_3">';

					echo '<tr>';
							        
						echo '<td class="choose_variant_daily_report">';
							echo '<input class="text-input" style="width: 100%; border: 2px solid #fec300; font-size: 16px;" name="admin_answer_comment_for_admin_id_'.$current_user_id_for_input.'" type="text" id="admin_answer_comment_for_admin_id_'.$current_user_id_for_input.'" value="'.$admin_answer_comment_for_admin.'" />';
						echo '</td>';
								        
						echo '<td style="width: 22px;">';
						    echo '
						    <select class="daily_report_comment" name="admin_answer_today_id_'.$current_user_id_for_input.'" id="admin_answer_today_id_'.$current_user_id_for_input.'">
						        <option disabled hidden selected>Выбрать ответ</option>
							    <option>Умничка)</option>
							    <option>Всё хорошо, не переживай)</option>
							    <option>ОГОНЬ</option>
							    <option>Скоро цикл, так что все хорошо</option>
							    <option>Молодец</option>
							    <option>ХОРОШО</option>
							    <option>ОТЛИЧНО</option>
							    <option>Так держать</option>
							    <option>Не налегай на вкусняшки</option>
							    <option>Все хорошо</option>
							    <option>Не критично</option>
							    <option>Скорейшего выздоровления</option>
							    <option>Стабильность тоже отлично</option>
							    <option>Сейчас напишу в Whatsapp</option>
						    </select>    
							';
						echo '</td>'; 
							        	        
					echo '</tr>';
						        
				echo '</table>'; //конец 3 таблицы для ежедневных отчетов "Профи"
						        
				echo '</div>'; //table_shadow
						        
				echo '<div class="daily_report_yellow_line"></div>';
		};
	}; //if ($profy_month_report)
				
	echo '<p class="daily_report_admin_answer_submit" >';
		echo '<input type="hidden" name="action" value="updateDailyReportProfy"/>';
		echo '<input name="updateDailyReportProfy" type="submit" id="daily_report_admin_answer_two_days_submit" class="submit button" value="Проверить отчеты с '.$four_days_start.' по '.$four_days_finish.' '.$this_month_for_button.'" />';
					echo '</p>';
	echo '</form>';		
				
	echo '<div id="success_form"><p>Данные обновлены</p></div>';
	
	echo '<script type="text/javascript">'; //Обработчик кнопки "Проверить"
		echo 'jQuery("#daily_report_today_form").submit(ajaxUpdateDailyReportProfy);'; 
			echo 'function ajaxUpdateDailyReportProfy(){'; 
				echo 'var dailyReportProfy = jQuery(this).serialize();';
				echo 'var check_curator = $(".check_curator").attr("id");';
					echo 'jQuery.ajax({'; 
						echo 'type:"POST",'; 
						echo 'url: "/wp-admin/admin-ajax.php",'; 
						echo 'data: {action: "updateDailyReportProfy", dailyReportProfy, check_curator},';
						echo 'success:function(data){'; 
						echo '$("#success_form").show();';
						//echo '$("#success_form").html(data);';
						echo 'setTimeout(function(){$("#success_form").fadeOut("slow")},1000);';
						echo '}'; 
					echo '});'; 
				echo 'return false;'; 
			echo '}'; 
	echo '</script>'; 											
	
	echo '<script type="text/javascript">'; //Подстановка готовых вариантов в поле для ответа
					echo '$(function() {';
						echo 'function selectToInput(){';
							echo 'var selectid = this.id;';
							echo 'var id = selectid.substr(22);';
							echo 'var stringResult = "#" + selectid + " :selected";';
							echo 'var result = $(stringResult).text();';
							echo 'var stringid = "#admin_answer_comment_for_admin_id_" + id;';
							echo '$(stringid).val(result);';
							echo '}';
						echo '$(".daily_report_comment").change(selectToInput);';
					echo '});';
	echo '</script>';				
					    				
	echo '<script type="text/javascript">'; //Вывод полной таблицы результатов (кубок)
					echo '$(function() {';
					    echo 'function showDayResultTableForAdmin(){';
					      echo 'var idResultMembers = this.id;';
					      echo 'idResultRightMembers = idResultMembers.substr(21);';
						  echo '$.ajaxSetup({cache: false});';
							echo 'jQuery.ajax({';
								echo 'type:"POST",';
								echo 'url: "/wp-admin/admin-ajax.php",';
								echo 'data: {action: "detailedResultForAdmin",';
									  echo 'idResultRightMembers,';
								echo '},';
								echo 'success:function(data){';
								echo 'jQuery("#resultDayTableForAdmin_" + idResultRightMembers).html(data);';
								echo '}';
							echo '});';
							echo 'return false;';
						echo '}';
					    echo '$(".day_result_report").click(showDayResultTableForAdmin);';
					echo '});';
	echo '</script>';  
					
	echo '<script type="text/javascript">'; //закрытие результатов участников марафона по клику области вне отчета
						echo 'jQuery(function($){';
						echo '$(document).click(function (e){';
							echo 'var div = $(".resultDayTableForAdmin");';
							echo 'if (!div.is(e.target)';
							    echo '&& div.has(e.target).length === 0) {';
								echo 'div.empty();';
							echo '}';
								echo '});';
						echo '});';  
	echo '</script>';
								    				
	die();
}
add_action('wp_ajax_showDailyReportProfy', 'showDailyReportProfy');
add_action('wp_ajax_nopriv_showDailyReportProfy', 'showDailyReportProfy');

// ----------- Обновление отчета "Ежедневные отчеты участников" для пакета "Профи" за 4 дня/director-cabinet ----------- // 
function updateDailyReportProfy(){
					global $wpdb;
					$check_curator = $_POST['check_curator'];
					parse_str($_POST[dailyReportProfy], $dailyReportProfy);
					if ($check_curator == 'main_curator') {$curator_db = 'Екатерина';} else
					if ($check_curator == 'curator_1') {$curator_db = 'Наталья';} else
					if ($check_curator == 'curator_2') {$curator_db = 'Дмитрий';};
					$current_user = wp_get_current_user();
					$user_id = $current_user->ID;
					$maraphon_member_month = current_time('m.Y');
					
					$day_now = current_time('j');

						if ($day_now == 1 || $day_now == 2 || $day_now == 3 || $day_now == 4) {
							$profy_month = current_time('m') - 1;
							if ($profy_month == 0) {$profy_month = '12'; $profy_year = current_time('Y') - 1; $profy_days_start = 29; $profy_days_finish = 31;};
							if ($profy_month == 1) {$profy_month = '01'; $profy_year = current_time('Y'); $profy_days_start = 29; $profy_days_finish = 31;};
							if ($profy_month == 2) {$profy_month = '02'; $profy_year = current_time('Y');};
							if ($profy_month == 3) {$profy_month = '03'; $profy_year = current_time('Y');};
							if ($profy_month == 4) {$profy_month = '04'; $profy_year = current_time('Y');};
							if ($profy_month == 5) {$profy_month = '05'; $profy_year = current_time('Y');};
							if ($profy_month == 6) {$profy_month = '06'; $profy_year = current_time('Y');};
							if ($profy_month == 7) {$profy_month = '07'; $profy_year = current_time('Y');};
							if ($profy_month == 8) {$profy_month = '08'; $profy_year = current_time('Y');};
							if ($profy_month == 9) {$profy_month = '09'; $profy_year = current_time('Y');};
							if ($profy_month == 10) {$profy_month = '10'; $profy_year = current_time('Y');};
							if ($profy_month == 11) {$profy_month = '11'; $profy_year = current_time('Y');};
							$profy_days_start_db = $profy_year.'-'.$profy_month.'-29';
							$profy_days_finish_db = $profy_year.'-'.$profy_month.'-31';
							
						} else {
						if ($day_now == 5 || $day_now == 6  || $day_now == 7 || $day_now == 8) {$profy_days_start = '01'; $profy_days_finish = '04';};
						if ($day_now == 9 || $day_now == 10 || $day_now == 11 || $day_now == 12) {$profy_days_start = '05'; $profy_days_finish = '08';};
						if ($day_now == 13 || $day_now == 14 || $day_now == 15 || $day_now == 16) {$profy_days_start = '09'; $profy_days_finish = '12';};
						if ($day_now == 17 || $day_now == 18 || $day_now == 19 || $day_now == 20) {$profy_days_start = '13'; $profy_days_finish = '16';};
						if ($day_now == 21 || $day_now == 22 || $day_now == 23 || $day_now == 24) {$profy_days_start = '17'; $profy_days_finish = '20';};
						if ($day_now == 25 || $day_now == 26 || $day_now == 27 || $day_now == 28) {$profy_days_start = '21'; $profy_days_finish = '24';};
						if ($day_now == 29 || $day_now == 30 || $day_now == 31) {$profy_days_start = '25'; $profy_days_finish = '28';};
						$profy_days_start_db = current_time('Y-m').'-'.$profy_days_start;
						$profy_days_finish_db = current_time('Y-m').'-'.$profy_days_finish;
						};
					
					$profy_days_start_year_month = substr($profy_days_finish_db, 0, 8);
					
					$answer_report_data = $wpdb->get_results(
					"
					SELECT
			        u.user_id AS user_id,
				    u.date AS date,
				    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'first_name' limit 1) as first_name,
				    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'last_name' limit 1) as last_name,
				    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'height' limit 1) as height,
				    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'weight_at_1_maraphon' limit 1) as weight_at_1_maraphon,
				    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'telephone' limit 1) as telephone,
				    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'first_menstruation_day' limit 1) as first_menstruation_day,
		            u.comment AS comment
					FROM wpux_daily_report u, wpux_orders orders
					WHERE u.user_id = orders.user_id
		            AND orders.date =
										(
										SELECT MAX(DATE)
										FROM wpux_orders orders2
										WHERE orders.user_id = orders2.user_id
		                                AND orders2.maraphon_member_month = '$maraphon_member_month'
		                                AND orders2.maraphon_next_month LIKE '%Профи%'
		                                AND orders2.curator = '$curator_db'
										)
		            AND DATE(u.date) BETWEEN '$profy_days_start_db' AND '$profy_days_finish_db'
					AND u.comment = 'Отчет на проверке'
		            ORDER BY last_name
					"
					);	
						if( $answer_report_data ) {
					    	foreach ( $answer_report_data as $string_report_data ) {
							    $current_user_id_for_output = $string_report_data->user_id;
							    $curent_date_profy = $string_report_data->date;
							    $data1 = 'admin_answer_comment_for_admin_id_'.$current_user_id_for_output.'';
								$comment_report_today = $dailyReportProfy[$data1];
								$data2 = 'history_comment_id_'.$current_user_id_for_output;
								$history_comment = $dailyReportProfy[$data2];
								if ( ($history_comment != $history_comment_temp) || ($current_user_id_for_output != $current_user_id_for_output_temp) ) {
									update_user_meta( $current_user_id_for_output, 'history_comment', $history_comment );
									$history_comment_temp = $history_comment;
									$current_user_id_for_output_temp = $current_user_id_for_output;
								};
								//$profy_days_start_loop = $profy_days_start;
								//$profy_days_start_db_loop = $profy_days_start_db;
								
								if (!empty($comment_report_today)){
									$wpdb->update(
										'wpux_daily_report',
										array( 
										'comment' => $comment_report_today
										),
										array(
										'user_id' => $current_user_id_for_output,
										'date' => $curent_date_profy
										)
										);
								}; // if
		    				}; // foreach  
						}; // if     
	die();
}
add_action('wp_ajax_updateDailyReportProfy', 'updateDailyReportProfy');
add_action('wp_ajax_nopriv_updateDailyReportProfy', 'updateDailyReportProfy');

// -----------  Вывод отчета "Ежедневные отчеты участников" для пакета "VIP" за вчера /director-cabinet ----------- // 
function showDailyReportVIP(){

				echo '<span style="font-size: 24px;">';				
				     	$_monthsList = array(
								"01"=>"января","02"=>"февраля","03"=>"марта",
								"04"=>"апреля","05"=>"мая", "06"=>"июня",
								"07"=>"июля","08"=>"августа","09"=>"сентября",
								"10"=>"октября","11"=>"ноября","12"=>"декабря");
						$today_for_daily_report = current_time ('Y-m-d',0); //2020-10-31
						$yesterday = current_time ('d') - 1;
						$maraphon_member_month = current_time('m.Y');
						if ($yesterday < 10) {$yesterday = '0'.$yesterday;};
						if ($yesterday == 0) {
							$yesterday_month = current_time('m') - 1;
							if ($yesterday_month == 0) {$yesterday = '31'; $yesterday_month = '12'; $yesterday_year = current_time('Y') - 1;};
							if ($yesterday_month == 1) {$yesterday = '31'; $yesterday_month = '01'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 2) {$yesterday = '28'; $yesterday_month = '02'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 3) {$yesterday = '31'; $yesterday_month = '03'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 4) {$yesterday = '30'; $yesterday_month = '04'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 5) {$yesterday = '31'; $yesterday_month = '05'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 6) {$yesterday = '30'; $yesterday_month = '06'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 7) {$yesterday = '31'; $yesterday_month = '07'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 8) {$yesterday = '31'; $yesterday_month = '08'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 9) {$yesterday = '30'; $yesterday_month = '09'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 10) {$yesterday = '31'; $yesterday_month = '10'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 11) {$yesterday = '30'; $yesterday_month = '11'; $yesterday_year = current_time('Y');};
						} else {
							$yesterday_month = current_time('m');
							$yesterday_year = current_time('Y');
						};
						$yesterday_for_admin = $yesterday_year.'-'.$yesterday_month.'-'.$yesterday;
						$yesterday_for_header = $yesterday;
						$month_for_header = $_monthsList[$yesterday_month];
						$year_for_header = $yesterday_year;
						echo 'Отчеты "VIP" за вчера, '; echo $yesterday_for_header; echo '&nbsp';echo $month_for_header; echo '&nbsp'; echo $year_for_header;
				echo '</span>';
				
				echo '<form id="daily_report_today_form">';
						global $wpdb;
						$current_user = wp_get_current_user();
						$current_user_report = $current_user->ID;

						$this_month_report = $wpdb->get_results(
						"
						SELECT
				        u.user_id AS user_id_check,
					    u.date AS date,
					    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'first_name' limit 1) as first_name,
					    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'last_name' limit 1) as last_name,
					    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'height' limit 1) as height,
					    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'weight_at_1_maraphon' limit 1) as weight_at_1_maraphon,
					    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'telephone' limit 1) as telephone,
					    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'first_menstruation_day' limit 1) as first_menstruation_day,
			            u.comment AS comment,
			            orders.director_comment
						FROM wpux_daily_report u, wpux_orders orders
						WHERE u.user_id = orders.user_id
			            AND orders.date =
											(
											SELECT MAX(DATE)
											FROM wpux_orders orders2
											WHERE orders.user_id = orders2.user_id
			                                AND orders2.maraphon_member_month = '$maraphon_member_month'
			                                AND orders2.maraphon_next_month LIKE '%VIP%'
			                                AND orders2.curator = 'Екатерина'
											)
			            AND u.date = '$yesterday_for_admin'
						AND u.comment = 'Отчет на проверке'
			            ORDER BY last_name
						"
						);	
						if( $this_month_report ) {
						    foreach ( $this_month_report as $string_report ) {
							    $current_user_id_for_input = $string_report->user_id_check;
							    echo '<div class="table_shadow">';
							    echo '<table class="daily_report_table_1">';
						        echo '<tr>';
						        echo '<td style="width: 25% !important; text-align: center; font-size: 22px;">';
								$name = $string_report->first_name;
								$surname = $string_report->last_name;
								$fio = $surname.' '.$name;
								echo '<a href="http://maraphon.online/wp-admin/user-edit.php?user_id='.$current_user_id_for_input.'&wp_http_referer=%2Fwp-admin%2Fusers.php" target="_blank">'.$fio.'</a>';
						        echo '</td>';
						        
						        echo '<td style="width: 6%; text-align: center; padding-left 5px; padding-top: 5px; font-size: 18px">';
						        echo'<strong>ID '.$current_user_id_for_input.'</strong>';
						        echo '</td>';
						        
						        echo '<td style="width: 9% !important; padding-top: 5px; font-size: 18px;">';
						        echo '<p class="day_result_report" id="day_result_report_id_'.$current_user_id_for_input.'" style="margin-bottom: 0px !important; cursor: pointer"><i style="font-size: 26px;" class="fa fa-trophy" aria-hidden="true"></i></p>';
						        echo '</td>';
						        
						        echo '<td style="width: 9% !important; color: blue; padding-top: 5px; font-size: 18px; font-weight: 200;">';
						        $height = $string_report->height;  
						        echo $height;
						        echo '</td>';
						        
						        echo '<td style="width: 9% !important; color: green; padding-top: 5px; font-size: 18px; font-weight: 200;">';
						        $weight_at_1_maraphon = $string_report->weight_at_1_maraphon;  
						        echo $weight_at_1_maraphon;
						        echo '</td>';
						        
						        echo '<td style="width: 9% !important; color: #fec300; padding-top: 5px; font-size: 18px; font-weight: 200;">';
						        $user_meta = get_userdata($current_user_id_for_input);
								$user_role = substr($user_meta->roles[0], -4, 4);
								echo $user_role;
								echo '</td>';

						        echo '<td style="width: 12% !important; color: red; padding-top: 5px; font-size: 18px; font-weight: 200;">';
						        $first_menstruation_day = $string_report->first_menstruation_day;  
						        echo $first_menstruation_day;
						        echo '</td>';
						        
								echo '<td style="width: 12%">';
						        $whatsapp_number = $string_report->telephone;
						        $phone= str_replace([' ', '(', ')', '-', '_'], '', $whatsapp_number);
								$phone = preg_replace('/^8/', '+7', $phone);
								$phone = preg_replace('/^7/', '+7', $phone);    
						        echo '<a href="https://api.whatsapp.com/send?phone='.$phone.'" target="_blank"><img style="width: 30px; padding-top: 2px; margin-bottom: -8px;" src="http://maraphon.online/wp-content/uploads/whatsapp-icon-180×180.png"/></a>';
						        echo '</td>';
						        
						        echo '</tr>';

						        echo '<tr>';
						        	echo '<td>';
						        		echo 'История участника';
						        	echo '</td>';

						        	echo '<td colspan="7">';
						        		echo '<textarea class="history_textarea" id="history_comment_id_'.$current_user_id_for_input.'" name="history_comment_id_'.$current_user_id_for_input.'" rows="2" cols="1" maxlength="255">'.get_the_author_meta( 'history_comment', $current_user_id_for_input ).'</textarea>';
						        	echo '</td>';
						        echo '</tr>';
						        
						        echo '<tr>';
						        	echo '<td>';
						        		echo 'Комментарий директора';
						        	echo '</td>';
						        	
						        	echo '<td colspan="7">';
						        		echo $string_report->director_comment;
						        	echo '</td>';
						echo '</tr>';
						        
						echo '<tr>';
						        	echo '<td style="background-color: #f6f6f6;" colspan="6">';
						        		echo '<div class="resultDayTableForAdmin" id="resultDayTableForAdmin_'.$current_user_id_for_input.'"></div>';
						        	echo '</td>';
						echo '</tr>';
						        
						        echo '</table>'; //конец 1 таблицы
						        echo '<table class="daily_report_table_2">';
							        echo '<tr>';
										echo '<th style="width: 4%;">Дата</th>';
										echo '<th style="width: 12%;">Активность</th>';
									    echo '<th style="width: 7%;">&nbsp;Алко.&nbsp;</th>';  
									    echo '<th style="width: 7%;">&nbsp;Мес.&nbsp;</th>';
									    echo '<th style="width: 5%;">&nbsp;Вес&nbsp;</th>';
									    echo '<th style="width: 41%;">Как прошел день</th>';
									    echo '<th style="width: 24%;">Комментарий</th>';
									echo '</tr>';

								$current_user_report = $current_user_id_for_input;
								$current_month = current_time ('n',0);
								$year_before = current_time('Y');
								$month_before = $current_month - 1;
								if ($month_before == '0') {
									$month_before = 12;
									$year_before = current_time('Y') - 1;
								};
								
								$current_month_report_start = $year_before.'-'.$month_before.'-28';
								if ((current_time('d') - 1) == '0') {
								$current_month_report_end = $year_before.'-'.$month_before.'-31';	
								} else {	
								$current_month_report_end = current_time ('Y-n',0).'-31';
								};
								
								$this_month_report = $wpdb->get_results( 
								"
								SELECT *
								FROM wpux_daily_report daily
								WHERE daily.user_id = $current_user_report
								AND (DATE(daily.date) BETWEEN '$current_month_report_start' AND '$yesterday_for_admin')
								"
								);
								
								if( $this_month_report ) {
								    foreach ( $this_month_report as $string_report ) {
								        echo '<tr class="daily_report_table_2_tr">';
								        if ($string_report->cheatmeal == '1') {
									        $cheat_fail_color = '#dff1d9';
								        } else if ($string_report->failure == '1') {
									        $cheat_fail_color = '#f8d7da';
								        } else if ($string_report->snack == '1') {
									        $cheat_fail_color = '#fff3cd';
								        } else {
									        $cheat_fail_color = 'white';
								        };
								        echo '<td style="width: 4%; background-color: '.$cheat_fail_color.'">'; 
								        $database_date =  $string_report->date;
								        $database_day = substr($database_date, 8);
								        $database_month = substr($database_date, 5, 2);
								        echo $database_day;
								        echo '.';
								        echo $database_month;
								        echo '</td>';
								        
								        echo '<td style="width: 14%; background-color: '.$cheat_fail_color.'">';   
								        echo $string_report->activity;
								        echo '</td>';
								        
								        if ($string_report->alcohol == 'Нет' || $string_report->alcohol == 'нет' || $string_report->alcohol == '-') {
									        $alcohol_color = '#404040';
								        } else {
									        $alcohol_color = '#468df9';
								        };
								        
								        echo '<td style="width: 7%; color: '.$alcohol_color.'; background-color: '.$cheat_fail_color.'">';   
								        echo $string_report->alcohol;
								        echo '</td>';
								        
								        if ($string_report->menstruation == 'Есть') {
									        $menstruation_color = 'red';
								        } else {
									        $menstruation_color = '#404040';
								        };
								        echo '<td style="width: 6%; color: '.$menstruation_color.'; background-color: '.$cheat_fail_color.'">'; 
								        echo $string_report->menstruation;
								        echo '</td>';
								        
								        echo '<td style="width: 5%; background-color: '.$cheat_fail_color.'">';  
								        echo $string_report->today_weight;
								        echo '</td>';
								        
								        echo '<td style="width: 35%; background-color: '.$cheat_fail_color.'">';  
								        echo $string_report->task;
								        echo '</td>'; 
								        echo '<td style="width: 28%; background-color: '.$cheat_fail_color.'">';
								        echo $string_report->comment;
								        echo '</td>';
								        echo '</tr>';       
					    				}
								}		 	        
								echo '</table>'; //конец 2 таблицы за вчера

								echo '<table class="daily_report_table_3">';
    
						        echo '<tr>';
						        echo '<td class="choose_variant_daily_report">';
							    echo '<input class="text-input" style="width:100%; border: 2px solid #fec300; font-size: 16px;" name="admin_answer_comment_for_admin_id_'.$current_user_id_for_input.'" type="text" id="admin_answer_comment_for_admin_id_'.$current_user_id_for_input.'" value="'.$admin_answer_comment_for_admin.'" />';
						        echo '</td>';
						        echo '<td style="width: 22px;">';
						        echo '
						        <select class="daily_report_comment" name="admin_answer_today_id_'.$current_user_id_for_input.'" id="admin_answer_today_id_'.$current_user_id_for_input.'">
					                    	<option disabled hidden selected>Выбрать ответ</option>
					                    	<option>Умничка)</option>
					                    	<option>Всё хорошо, не переживай)</option>
					                    	<option>ОГОНЬ</option>
					                    	<option>Скоро цикл, так что все хорошо</option>
					                    	<option>Молодец</option>
					                    	<option>ХОРОШО</option>
					                    	<option>ОТЛИЧНО</option>
					                    	<option>Так держать</option>
					                    	<option>Не налегай на вкусняшки</option>
					                    	<option>Все хорошо</option>
					                    	<option>Не критично</option>
					                    	<option>Скорейшего выздоровления</option>
					                    	<option>Стабильность тоже отлично</option>
					                    	<option>Сейчас напишу в Whatsapp</option>
				                    	</select>    
						        ';
						        echo '</td>'; 	        
						        echo '</tr>';
						        echo '</table>'; //конец 3 таблицы
						        echo '</div>';
						        echo '<div class="daily_report_yellow_line"></div>';
						        }
							}		
				
				echo '<p class="daily_report_admin_answer_submit" >';
					echo '<input type="hidden" name="action" value="updateDailyReportVIP"/>';
					echo '<input name="updateDailyReportVIP" type="submit" id="daily_report_admin_answer_today_submit" class="submit button" value="Проверить отчеты за вчера" />';

					echo '</p>';
				echo '</form>';		
				
				echo '<div id="success_form"><p>Данные обновлены</p></div>';		
									
					echo '<script type="text/javascript">'; 
					echo 'jQuery("#daily_report_today_form").submit(ajaxUpdateDailyReportVIP);'; 
					echo 'function ajaxUpdateDailyReportVIP(){'; 
						echo 'var dailyReportVIP = jQuery(this).serialize();'; 
						echo 'jQuery.ajax({'; 
							echo 'type:"POST",'; 
							echo 'url: "/wp-admin/admin-ajax.php",'; 
							echo 'data: dailyReportVIP,';
							echo 'success:function(data){'; 
							echo '$("#success_form").show();'; 
							echo 'setTimeout(function(){$("#success_form").fadeOut("slow")},1000);';
							echo '}'; 
						echo '});'; 
					echo 'return false;'; 
					echo '}'; 
					echo '</script>'; 					
				
				echo '<script type="text/javascript">';  //Подстановка готовых вариантов в поле для ответа
					echo '$(function() {';
						echo 'function selectToInput(){';
							echo 'var selectid = this.id;';
							echo 'var id = selectid.substr(22);';
							echo 'var stringResult = "#" + selectid + " :selected";';
							echo 'var result = $(stringResult).text();';
							echo 'var stringid = "#admin_answer_comment_for_admin_id_" + id;';
							echo '$(stringid).val(result);';
							echo '}';
						echo '$(".daily_report_comment").change(selectToInput);';
					echo '});';
				echo '</script>';
				
				echo '<script type="text/javascript">';  //вывод полной таблицы результатов
					echo '$(function() {';
					    echo 'function showDayResultTableForAdmin(){';
					      echo 'var idResultMembers = this.id;';
					      echo 'idResultRightMembers = idResultMembers.substr(21);';
						  echo '$.ajaxSetup({cache: false});';
							echo 'jQuery.ajax({';
								echo 'type:"POST",';
								echo 'url: "/wp-admin/admin-ajax.php",';
								echo 'data: {action: "detailedResultForAdmin",';
									  echo 'idResultRightMembers,';
								echo '},';
								echo 'success:function(data){';
								echo 'jQuery("#resultDayTableForAdmin_" + idResultRightMembers).html(data);';
								echo '}';
							echo '});';
							echo 'return false;';
						echo '}';
					    echo '$(".day_result_report").click(showDayResultTableForAdmin);';
					echo '});';
					echo '</script>';  
					
				echo '<script>';  //закрытие результатов участников марафона по клику области вне отчета
						echo 'jQuery(function($){';
						echo '$(document).click(function (e){';
							echo 'var div = $(".resultDayTableForAdmin");';
							echo 'if (!div.is(e.target)';
							    echo '&& div.has(e.target).length === 0) {';
								echo 'div.empty();';
							echo '}';
								echo '});';
						echo '});';  
					echo '</script>';
			die();
		}
add_action('wp_ajax_showDailyReportVIP', 'showDailyReportVIP');
add_action('wp_ajax_nopriv_showDailyReportVIP', 'showDailyReportVIP');

// ----------- Обновление отчета "Ежедневные отчеты участников" для пакета "VIP" за вчера /director-cabinet ----------- // 
function updateDailyReportVIP(){
					global $wpdb;
					$today_for_daily_report = current_time ('Y-m-d',0); //2020-10-31
						$yesterday = current_time ('d') - 1;
						$maraphon_member_month = current_time('m.Y');
						if ($yesterday < 10) {$yesterday = '0'.$yesterday;};
						if ($yesterday == 0) {
							$yesterday_month = current_time('m') - 1;
							if ($yesterday_month == 0) {$yesterday = '31'; $yesterday_month = '12'; $yesterday_year = current_time('Y') - 1;};
							if ($yesterday_month == 1) {$yesterday = '31'; $yesterday_month = '01'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 2) {$yesterday = '28'; $yesterday_month = '02'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 3) {$yesterday = '31'; $yesterday_month = '03'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 4) {$yesterday = '30'; $yesterday_month = '04'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 5) {$yesterday = '31'; $yesterday_month = '05'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 6) {$yesterday = '30'; $yesterday_month = '06'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 7) {$yesterday = '31'; $yesterday_month = '07'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 8) {$yesterday = '31'; $yesterday_month = '08'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 9) {$yesterday = '30'; $yesterday_month = '09'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 10) {$yesterday = '31'; $yesterday_month = '10'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 11) {$yesterday = '30'; $yesterday_month = '11'; $yesterday_year = current_time('Y');};
						} else {
							$yesterday_month = current_time('m');
							$yesterday_year = current_time('Y');
						};
					$yesterday_for_admin = $yesterday_year.'-'.$yesterday_month.'-'.$yesterday;
					
			        $answer_report_data = $wpdb->get_results(
					"
					SELECT
				        u.user_id AS user_id_check,
					    u.date AS date,
					    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'first_name' limit 1) as first_name,
					    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'last_name' limit 1) as last_name,
					    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'height' limit 1) as height,
					    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'weight_at_1_maraphon' limit 1) as weight_at_1_maraphon,
					    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'telephone' limit 1) as telephone,
					    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'first_menstruation_day' limit 1) as first_menstruation_day,
			            u.comment AS comment
						FROM wpux_daily_report u, wpux_orders orders
						WHERE u.user_id = orders.user_id
			            AND orders.date =
											(
											SELECT MAX(DATE)
											FROM wpux_orders orders2
											WHERE orders.user_id = orders2.user_id
			                                AND orders2.maraphon_member_month = '$maraphon_member_month'
			                                AND orders2.maraphon_next_month LIKE '%VIP%'
			                                AND orders2.curator = 'Екатерина'
											)
			            AND u.date = '$yesterday_for_admin'
						AND u.comment = 'Отчет на проверке'
			            ORDER BY last_name
					"
					);	
						if( $answer_report_data ) {
					    	foreach ( $answer_report_data as $string_report_data ) {
							    $current_user_id_for_output = $string_report_data->user_id_check;
							    $data1 = 'admin_answer_comment_for_admin_id_'.$current_user_id_for_output.'';
								$comment_report_today = $_POST[$data1];
								$data2 = 'history_comment_id_'.$current_user_id_for_output;
								$history_comment = $_POST[$data2];
								update_user_meta( $current_user_id_for_output, 'history_comment', $history_comment );
								
								if (!empty($comment_report_today)){
									$wpdb->update(
									'wpux_daily_report',
									array( 
									'comment' => $comment_report_today
									),
									array(
									'user_id' => $current_user_id_for_output,
									'date' => $yesterday_for_admin
									)
									); 
								};
		    				}; //Тело цикла
						}; //Тело первоначального условия
	die();
}
add_action('wp_ajax_updateDailyReportVIP', 'updateDailyReportVIP');
add_action('wp_ajax_nopriv_updateDailyReportVIP', 'updateDailyReportVIP');

// ----------- Вывод отчета по участникам, не отправляющим отчеты последние 4 дня /director-cabinet ----------- // 
function showLostMembersReport(){
	global $wpdb;
	$current_month_epic_fail_report_1 = current_time('Y-m');
	$current_month_epic_fail_report_2 = current_time ('m.Y');
	$four_days_ago = current_time('j') - 3;
	$date_from = $current_month_epic_fail_report_1.'-01';
	$date_before = $current_month_epic_fail_report_1.'-'.$four_days_ago;
				
	if (current_time("j") > 3 && current_time("d") < 29) {
		echo '<p class="daily_report_fail_header">Участники, не отправляющие отчеты более 3 дней<p>';
		echo '<div class="table_shadow">';
			echo '<table class="daily_check_report_fail_table">';
			    echo '<tr style="background-color: #f6f6f6;">';
					echo '<th style="width: 20%">ФИО</th>';
		            echo '<th style="width: 4%"><i class="fa fa-calendar-check-o" aria-hidden="true"></i></th>';
					echo '<th style="width: 12%">Дата последнего отчета</th>';
		            echo '<th style="width: 50%">Как прошел день</th>';
		            echo '<th style="width: 10%">Куратор</th>';
			        echo '<th style="width: 6%">&nbsp;<i class="fa fa-paper-plane-o" aria-hidden="true">&nbsp;</th>';
				echo '</tr>';
				
		$this_month_epic_fail_report = $wpdb->get_results(
			"
			SELECT
				daily.date AS daily_date,
			    orders.user_id AS user_id,
				orders.order_id AS order_id,
				(select meta_value from wpux_usermeta where user_id = orders.user_id and meta_key = 'first_name' limit 1) as first_name,
				(select meta_value from wpux_usermeta where user_id = orders.user_id and meta_key = 'last_name' limit 1) as last_name,
				(select meta_value from wpux_usermeta where user_id = orders.user_id and meta_key = 'telephone' limit 1) as telephone,
				orders.maraphon_member_month,
				orders.curator
				FROM wpux_orders orders
							
                LEFT OUTER JOIN wpux_daily_report daily
			    ON (
			    daily.user_id = orders.user_id
			    AND daily.user_id != 1
                AND daily.date LIKE '%$current_month_epic_fail_report_1%')
                           
				WHERE daily.date is null
				
				AND orders.maraphon_member_month = '$current_month_epic_fail_report_2' 
                AND (orders.paid = 1 OR orders.credit = 1)
					     
				ORDER BY last_name
			"
			);
						
		if( $this_month_epic_fail_report ) {
			foreach ( $this_month_epic_fail_report as $string4_report ) {
				$current_user_id = $string4_report->user_id;
			    echo '<tr>';
						        
				    echo '<td>'; //1.ФИО
					    $last_name = $string4_report->last_name;
					    $first_name = $string4_report->first_name;
					    $fio = $last_name.' '.$first_name;
					    echo $fio;
				    echo '</td>';
							        
					echo '<td>'; //2. Отчет
						echo '-';
					echo '</td>';
							        
					echo '<td>'; //3. Дата
						echo '-';
					echo '</td>';
							        
					echo '<td>'; //4. Как прошел день
					    echo 'Отчет в этом месяце не отправлялся';
					echo '</td>';
					
					echo '<td>'; //5. Куратор
					    echo $string4_report->curator;
					echo '</td>';
							        
					echo '<td>';//6.Телефон
					    $whatsapp_number = $string4_report->telephone;
					    $phone= str_replace([' ', '(', ')', '-', '_'], '', $whatsapp_number);
						$phone = preg_replace('/^8/', '+7', $phone);
						$phone = preg_replace('/^7/', '+7', $phone);    
						echo '<a href="https://api.whatsapp.com/send?phone='.$phone.'" target="_blank"><img style="width: 30px; padding-top: 5px;" src="http://maraphon.online/wp-content/uploads/whatsapp-icon-180×180.png"/></a>';	
					echo '</td>';  
						        
				echo '</tr>';
			};
		};
		
		$this_month_fail_report = $wpdb->get_results(
			"
			SELECT
			A.user_id AS user_id_check,
            A.date AS date,
            (select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'first_name' limit 1) as first_name,
			(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'last_name' limit 1) as last_name,
			(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'telephone' limit 1) as telephone,
			A.task AS task,
			orders.curator
			FROM wpux_daily_report A, wpux_users users, wpux_orders orders
			WHERE users.ID = A.user_id 
            AND users.ID = orders.user_id
            AND orders.maraphon_member_month = '$current_month_epic_fail_report_2'
			AND (DATE(A.date) BETWEEN '$date_from' AND '$date_before')
			AND
			A.date =
			(
			SELECT MAX(DATE)
			FROM wpux_daily_report B
			WHERE A.user_id = B.user_id
			AND A.user_id != 1
			)
			GROUP BY last_name
			HAVING (DATE(A.date) BETWEEN '$date_from' AND '$date_before')
			"
		);	
		
		if( $this_month_fail_report ) {
		    foreach ( $this_month_fail_report as $string_report ) {
				$current_user_id = $string_report->user_id_check;
		        echo '<tr>';
						        
					echo '<td>'; //1.ФИО
						$last_name = $string_report->last_name;
						$first_name = $string_report->first_name;
						$fio = $last_name.' '.$first_name;
						echo $fio;
					echo '</td>';
						        
					echo '<td>'; //2. Отчет
					    echo '<p class="members_fail_report" id="members_report_id_'.$current_user_id.'" style="margin-bottom: 0px !important; cursor: pointer"><i class="fa fa-calendar-check-o" aria-hidden="true"></i></p>';
					echo '</td>';
						        
					echo '<td>'; //3. Дата
				  		$last_day_task = $string_report->date;
						$last_day_day = substr($last_day_task, 8, 2);
						$last_day_month = substr($last_day_task, 5, 2);
						$last_day_year = substr($last_day_task, 0, 4);
						$last_day_date = $last_day_day.'.'.$last_day_month.'.'.$last_day_year;
						echo $last_day_date;
			        echo '</td>';
						        
			        echo '<td>'; //4. Как прошел день
			        	echo $string_report->task;
			        echo '</td>';
			        
			        echo '<td>'; //5. Куратор
					    echo $string_report->curator;
					echo '</td>';
					        
			        echo '<td>';//6.Телефон
				        $whatsapp_number = $string_report->telephone;
				        $phone= str_replace([' ', '(', ')', '-', '_'], '', $whatsapp_number);
						$phone = preg_replace('/^8/', '+7', $phone);
						$phone = preg_replace('/^7/', '+7', $phone);    
			        echo '<a href="https://api.whatsapp.com/send?phone='.$phone.'" target="_blank"><img style="width: 30px; padding-top: 5px;" src="http://maraphon.online/wp-content/uploads/whatsapp-icon-180×180.png"/></a>';	
			        echo '</td>';  
						        
				echo '</tr>';
								
				echo '<tr>';
						        
					echo '<td colspan="6">'; 
					echo '<div class="reportTable2ForAdmin" id="reportTable2ForAdmin_'.$current_user_id.'"></div>';
					echo '<div style="background-color: #f6f6f6;" class="formUserForAdmin" id="formUser2ForAdmin_'.$current_user_id.'"></div>';
					echo '</td>'; 
						        
				echo '</tr>';	
			};
		};
			echo '</table>';
		echo '</div>';
		
	echo '<script type="text/javascript">';  //вывод ежедневного отчета у прогульщиков
		echo '$(function() {';
		    echo 'function showDailyFailReportForAdmin(){';
		        echo 'var id = this.id;';
		        echo 'var idRight = id.substr(18);';
		        $this_month_fail = current_time('m');
		        $this_year_fail = current_time('Y');
		        echo 'var choose_period_month = '.$this_month_fail.';';
			    echo 'var choose_period_year = '.$this_year_fail.';';
			    echo 'if (choose_period_month < 10) {choose_period_month = "0" + choose_period_month;};';
			    echo 'var periodNowAjaxDaily = (choose_period_month + "." + choose_period_year);';
			    echo '$.ajaxSetup({cache: false});';
					echo 'jQuery.ajax({';
						echo 'type:"POST",';
						echo 'url: "/wp-admin/admin-ajax.php",';
						echo 'data: {action: "dailyReportForAdmin",';
							  echo 'idRight, periodNowAjaxDaily,';
						echo '},';
						echo 'success:function(data){';
						echo 'jQuery("#reportTable2ForAdmin_" + idRight).html(data);';
						echo '}';
					echo '});';
					echo 'return false;';
				echo '}';
			    echo '$(".members_fail_report").click(showDailyFailReportForAdmin);';
			echo '});';
		echo '</script>';
					
		echo '<script type="text/javascript">';  //закрытие ежедневного отчета прогульщиков
			echo 'jQuery(function($){';
				echo '$(document).click(function (e){';
					echo 'var div = $(".reportTable2ForAdmin");';
					echo 'if (!div.is(e.target)';
					    echo '&& div.has(e.target).length === 0) {';
						echo 'div.empty();';
					echo '}';
				echo '});';
			echo '});';  
		echo '</script>';
		} else {
		echo '<p class="daily_report_fail_header">Нет участников, не отправляющих отчеты<p>';
		};
	die();
}
add_action('wp_ajax_showLostMembersReport', 'showLostMembersReport');
add_action('wp_ajax_nopriv_showLostMembersReport', 'showLostMembersReport');




















// -----------  Вывод отчета "Ежедневные отчеты участников" за 2 дня /director-cabinet ----------- // 
function showDailyReportTwoDays(){
				echo '<span style="font-size: 24px;">';				
				//Выводим данные участников марафона за сегодня
				     	$_monthsList = array(
								"01"=>"января","02"=>"февраля","03"=>"марта",
								"04"=>"апреля","05"=>"мая", "06"=>"июня",
								"07"=>"июля","08"=>"августа","09"=>"сентября",
								"10"=>"октября","11"=>"ноября","12"=>"декабря");
								
						$day_now = current_time('j');
						$maraphon_member_month = current_time('m.Y');
						$maraphon_member_month_before_month = current_time('m') - 1;
						if ($maraphon_member_month_before_month == 0) {
							$maraphon_member_month_before_month = 12; $maraphon_member_month_before_year = current_time('Y') - 1;
						} else {
							$maraphon_member_month_before_year = current_time('Y');
						};
						
						if ($maraphon_member_month_before_month < 10) {
							$maraphon_member_month_before_month = '0'.$maraphon_member_month_before_month;
						};

						$maraphon_member_month_before = $maraphon_member_month_before_month.'.'.$maraphon_member_month_before_year;

						if ($day_now == 1 || $day_now == 2) {
							$yesterday_month = current_time('m') - 1;
							if ($yesterday_month == 0) {$yesterday_month = '12'; $yesterday_year = current_time('Y') - 1;};
							if ($yesterday_month == 1) {$yesterday_month = '01'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 2) {$yesterday_month = '02'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 3) {$yesterday_month = '03'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 4) {$yesterday_month = '04'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 5) {$yesterday_month = '05'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 6) {$yesterday_month = '06'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 7) {$yesterday_month = '07'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 8) {$yesterday_month = '08'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 9) {$yesterday_month = '09'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 10) {$yesterday_month = '10'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 11) {$yesterday_month = '11'; $yesterday_year = current_time('Y');};
							$two_days_start = '29';
							$two_days_finish = '30';
							$two_days_start_db = $yesterday_year.'-'.$yesterday_month.'-29';
							$two_days_finish_db = $yesterday_year.'-'.$yesterday_month.'-30';
							$this_month_for_button = $_monthsList[$yesterday_month];
							
						} else {
						if ($day_now == 3 || $day_now == 4) {$two_days_start = '1'; $two_days_finish = '2';};
						if ($day_now == 5 || $day_now == 6) {$two_days_start = '3'; $two_days_finish = '4';};
						if ($day_now == 7 || $day_now == 8) {$two_days_start = '5'; $two_days_finish = '6';};
						if ($day_now == 9 || $day_now == 10) {$two_days_start = '7'; $two_days_finish = '8';};
						if ($day_now == 11 || $day_now == 12) {$two_days_start = '09'; $two_days_finish = '10';};
						if ($day_now == 13 || $day_now == 14) {$two_days_start = '11'; $two_days_finish = '12';};
						if ($day_now == 15 || $day_now == 16) {$two_days_start = '13'; $two_days_finish = '14';};
						if ($day_now == 17 || $day_now == 18) {$two_days_start = '15'; $two_days_finish = '16';};
						if ($day_now == 19 || $day_now == 20) {$two_days_start = '17'; $two_days_finish = '18';};
						if ($day_now == 21 || $day_now == 22) {$two_days_start = '19'; $two_days_finish = '20';};
						if ($day_now == 23 || $day_now == 24) {$two_days_start = '21'; $two_days_finish = '22';};
						if ($day_now == 25 || $day_now == 26) {$two_days_start = '23'; $two_days_finish = '24';};
						if ($day_now == 27 || $day_now == 28) {$two_days_start = '25'; $two_days_finish = '26';};
						if ($day_now == 29 || $day_now == 30) {$two_days_start = '27'; $two_days_finish = '28';};	
						$two_days_start_db = current_time('Y-m').'-'.$two_days_start;
						$two_days_finish_db = current_time('Y-m').'-'.$two_days_finish;
						$this_month_for_button = $_monthsList[current_time('m')];
						$yesterday_year = current_time('Y');
						//$two_days_finish_end_month_db = current_time('Y-m').'-31';
						};
						echo 'Отчеты с '.$two_days_start.' по '.$two_days_finish.' '.$this_month_for_button.' '.$yesterday_year;
				echo '</span>';
				
				echo '<form id="daily_report_today_form">';
						global $wpdb;
						$current_user = wp_get_current_user();
						$current_user_report = $current_user->ID;
						$today_for_admin = current_time('Y-m-d',0);
						$this_month_report = $wpdb->get_results(
						"
						SELECT
	                    u.user_id AS user_id_check,
					    u.date AS date,
					    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'first_name' limit 1) as first_name,
					    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'last_name' limit 1) as last_name,
					    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'height' limit 1) as height,
					    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'weight_at_1_maraphon' limit 1) as weight_at_1_maraphon,
					    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'telephone' limit 1) as telephone,
					    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'first_menstruation_day' limit 1) as first_menstruation_day,
                        u.comment AS comment,
                        orders.director_comment
						FROM wpux_daily_report u, wpux_orders orders
						WHERE u.user_id = orders.user_id
			            AND orders.date =
											(
											SELECT MAX(DATE)
											FROM wpux_orders orders2
											WHERE orders.user_id = orders2.user_id
			                                AND (orders2.maraphon_member_month = '$maraphon_member_month' OR orders2.maraphon_member_month = '$maraphon_member_month_before')
			                                AND (orders2.maraphon_next_month LIKE '%марафон%' OR orders2.maraphon_next_month LIKE '%пакет%')
											)
						AND DATE(u.date) BETWEEN '$two_days_start_db' AND '$two_days_finish_db'
						AND u.comment = 'Отчет на проверке'
                        GROUP BY u.user_id
                        ORDER BY last_name
						"
						);	
						if( $this_month_report ) {
						    foreach ( $this_month_report as $string_report ) {
							    $current_user_id_for_input = $string_report->user_id_check;
							    echo '<div class="table_shadow">';
							    echo '<table class="daily_report_table_1">';
						        echo '<tr>';
						        
						        echo '<td style="width: 25% !important; text-align: center; font-size: 22px;">';
								$name = $string_report->first_name;
								$surname = $string_report->last_name;
								$fio = $surname.' '.$name;
								echo '<a href="http://maraphon.online/wp-admin/user-edit.php?user_id='.$current_user_id_for_input.'&wp_http_referer=%2Fwp-admin%2Fusers.php" target="_blank">'.$fio.'</a>';
						        echo '</td>';
						        
						        echo '<td style="width: 6%; text-align: center; padding-left 5px; padding-top: 5px; font-size: 18px">';
						        echo'<strong>ID '.$current_user_id_for_input.'</strong>';
						        echo '</td>';
						        
						        echo '<td style="width: 9% !important; padding-top: 5px; font-size: 18px;">';
						        echo '<p class="day_result_report" id="day_result_report_id_'.$current_user_id_for_input.'" style="margin-bottom: 0px !important; cursor: pointer"><i style="font-size: 26px;" class="fa fa-trophy" aria-hidden="true"></i></p>';
						        echo '</td>';
						        
						        echo '<td style="width: 9% !important; color: blue; padding-top: 5px; font-size: 18px; font-weight: 200;">';
						        $height = $string_report->height;  
						        echo $height;
						        echo '</td>';
						        
						        echo '<td style="width: 9% !important; color: green; padding-top: 5px; font-size: 18px; font-weight: 200;">';
						        $weight_at_1_maraphon = $string_report->weight_at_1_maraphon;  
						        echo $weight_at_1_maraphon;
						        echo '</td>';
						        
						        echo '<td style="width: 9% !important; color: #fec300; padding-top: 5px; font-size: 18px; font-weight: 200;">';
						        $user_meta = get_userdata($current_user_id_for_input);
								$user_role = substr($user_meta->roles[0], -4, 4);
								echo $user_role;
								echo '</td>';

						        echo '<td style="width: 12% !important; color: red; padding-top: 5px; font-size: 18px; font-weight: 200;">';
						        $first_menstruation_day = $string_report->first_menstruation_day;  
						        echo $first_menstruation_day;
						        echo '</td>';
						        
								echo '<td style="width: 12%">';
						        $whatsapp_number = $string_report->telephone;
						        $phone= str_replace([' ', '(', ')', '-', '_'], '', $whatsapp_number);
								$phone = preg_replace('/^8/', '+7', $phone);
								$phone = preg_replace('/^7/', '+7', $phone);    
						        echo '<a href="https://api.whatsapp.com/send?phone='.$phone.'" target="_blank"><img style="width: 30px; padding-top: 2px; margin-bottom: -8px;" src="http://maraphon.online/wp-content/uploads/whatsapp-icon-180×180.png"/></a>';
						        echo '</td>';
						        
						        echo '</tr>';

						        echo '<tr>';
						        	echo '<td>';
						        		echo 'История участника';
						        	echo '</td>';

						        	echo '<td colspan="7">';
						        		echo '<textarea class="history_textarea" id="history_comment_id_'.$current_user_id_for_input.'" name="history_comment_id_'.$current_user_id_for_input.'" rows="2" cols="1" maxlength="255">'.get_the_author_meta( 'history_comment', $current_user_id_for_input ).'</textarea>';
						        	echo '</td>';
						        echo '</tr>';
						        
						        echo '<tr>';
						        	echo '<td>';
						        		echo 'Комментарий директора';
						        	echo '</td>';
						        	
						        	echo '<td colspan="7">';
						        		echo $string_report->director_comment;
						        	echo '</td>';
						        echo '</tr>';
						        
						        echo '<tr>';
						        	echo '<td style="background-color: #f6f6f6;" colspan="6">';
						        		echo '<div class="resultDayTableForAdmin" id="resultDayTableForAdmin_'.$current_user_id_for_input.'"></div>';
						        	echo '</td>';
						        echo '</tr>';
						        
						        echo '</table>'; //конец 1 таблицы
						        
						        echo '<table class="daily_report_table_2">';
							        echo '<tr>';
										echo '<th style="width: 4%;">Дата</th>';
										echo '<th style="width: 14%;">Активность</th>';
									    echo '<th style="width: 7%;">&nbsp;Алкоголь&nbsp;</th>';  
									    echo '<th style="width: 6%;">&nbsp;Мес.&nbsp;</th>';
									    echo '<th style="width: 5%;">&nbsp;Вес&nbsp;</th>';
									    echo '<th style="width: 35%;">Как прошел день</th>';
									    echo '<th style="width: 28%;">Комментарий</th>';
									echo '</tr>';

								//Объявляем переменные для SQL запроса
								$current_user_report = $current_user_id_for_input;
								
								$current_month = current_time ('n',0);
								$year_before = current_time('Y');
								$month_before = $current_month - 1;
								if ($month_before == '0') {
									$month_before = 12;
									$year_before = current_time('Y') - 1;
								};
								$current_month_report_start = $year_before.'-'.$month_before.'-29';
								$current_month_report_end = current_time ('Y-m',0).'-31';
								
								$this_month_report = $wpdb->get_results( 
								"
								SELECT *
								FROM wpux_daily_report daily
								WHERE daily.user_id = $current_user_report
								AND (DATE(daily.date) BETWEEN '$current_month_report_start' AND '$current_month_report_end')
								ORDER BY daily.date
								"
								);
								// вытаскиваем из базы данные по ID пользователя и текущему месяцу
								
								if( $this_month_report ) {
								    foreach ( $this_month_report as $string_report ) {
									    if ($string_report->cheatmeal == '1') {
									        $cheat_fail_color = '#dff1d9';
								        } else if ($string_report->failure == '1') {
									        $cheat_fail_color = '#f8d7da';
								        } else if ($string_report->snack == '1') {
									        $cheat_fail_color = '#fff3cd';
								        } else {
									        $cheat_fail_color = 'white';
								        };
								        
								        $database_date =  $string_report->date;
								        $database_day = substr($database_date, 8);
								        $database_month = substr($database_date, 5, 2);
								        
								        if ($string_report->alcohol == 'Нет' || $string_report->alcohol == 'нет' || $string_report->alcohol == '-') {
									        $alcohol_color = '#404040';
								        } else {
									        $alcohol_color = '#468df9';
								        };
								        
								        if ($string_report->menstruation == 'Есть') {
									        $menstruation_color = 'red';
								        } else {
									        $menstruation_color = '#404040';
								        }; 
									    
									    
								       echo '<tr class="daily_report_table_2_tr">';
								        
								        echo '<td style="width: 4%; background-color: '.$cheat_fail_color.'">';
								        echo $database_day.'.'.$database_month;
								        echo '</td>';
								        
								        echo '<td style="width: 14%; background-color: '.$cheat_fail_color.'">';
								        echo $string_report->activity;
								        echo '</td>';
								        
								        echo '<td style="color: '.$alcohol_color.'; width: 7%; background-color: '.$cheat_fail_color.'">';
								        echo $string_report->alcohol;
								        echo '</td>';
								        
								        echo '<td style="width: 6%; color: '.$menstruation_color.'; background-color: '.$cheat_fail_color.'">'; 
								        echo $string_report->menstruation;
								        echo '</td>';
								        
								        echo '<td style="width: 5%; background-color: '.$cheat_fail_color.'">'; 
								        echo $string_report->today_weight;
								        echo '</td>';
								        
								        echo '<td style="width: 35%; background-color: '.$cheat_fail_color.'">'; 
								        echo $string_report->task;
								        echo '</td>'; 
								        
								        echo '<td style="width: 28%; background-color: '.$cheat_fail_color.'">'; 
								        echo $string_report->comment;
								        echo '</td>';  
								        
								        echo '</tr>';       
					    				};
					    				echo '</table>'; //конец 2 таблицы за сегодня   
								};	 	       
								

								echo '<table class="daily_report_table_3">';
								
								
						        echo '<tr>';
						        
						        echo '<td class="choose_variant_daily_report">';
							    echo '<input class="text-input" style="width: 100%; border: 2px solid #fec300; font-size: 16px;" name="admin_answer_comment_for_admin_id_'.$current_user_id_for_input.'" type="text" id="admin_answer_comment_for_admin_id_'.$current_user_id_for_input.'" value="'.$admin_answer_comment_for_admin.'" />';
						        echo '</td>';
						        
						        echo '<td style="width: 22px;">';
						        echo '
						        <select class="daily_report_comment" name="admin_answer_today_id_'.$current_user_id_for_input.'" id="admin_answer_today_id_'.$current_user_id_for_input.'">
					                    	<option disabled hidden selected>Выбрать ответ</option>
					                    	<option>Умничка)</option>
					                    	<option>Всё хорошо, не переживай)</option>
					                    	<option>ОГОНЬ</option>
					                    	<option>Скоро цикл, так что все хорошо</option>
					                    	<option>Молодец</option>
					                    	<option>ХОРОШО</option>
					                    	<option>ОТЛИЧНО</option>
					                    	<option>Так держать</option>
					                    	<option>Не налегай на вкусняшки</option>
					                    	<option>Все хорошо</option>
					                    	<option>Не критично</option>
					                    	<option>Скорейшего выздоровления</option>
					                    	<option>Стабильность тоже отлично</option>
					                    	<option>Сейчас напишу в Whatsapp</option>
					                    	<option>Ответила в Whatsapp</option>
				                    	</select>    
						        ';
						        echo '</td>'; 
						        	        
						        echo '</tr>';
						        
						        echo '</table>'; //конец 3 таблицы 
						        
						        echo '</div>'; //table_shadow
						        
						        echo '<div class="daily_report_yellow_line"></div>';
						        }
							}		
				
				echo '<p class="daily_report_admin_answer_submit" >';
					echo '<input type="hidden" name="action" value="updateDailyReportTwoDays"/>';
					echo '<input name="updateDailyReportTwoDays" type="submit" id="daily_report_admin_answer_two_days_submit" class="submit button" value="Проверить отчеты с '.$two_days_start.' по '.$two_days_finish.' '.$this_month_for_button.'" />';

					echo '</p>';
				echo '</form>';		
				
				echo '<div id="success_form"><p>Данные обновлены</p></div>';		
									
					echo '<script type="text/javascript">'; 
					echo 'jQuery("#daily_report_today_form").submit(ajaxUpdateDailyReportTwoDays);'; 
					echo 'function ajaxUpdateDailyReportTwoDays(){'; 
						echo 'var dailyReportTwoDays = jQuery(this).serialize();'; 
						echo 'jQuery.ajax({'; 
							echo 'type:"POST",'; 
							echo 'url: "/wp-admin/admin-ajax.php",'; 
							echo 'data: dailyReportTwoDays,';
							echo 'success:function(data){'; 
							echo '$("#success_form").show();';
							echo 'setTimeout(function(){$("#success_form").fadeOut("slow")},1000);';
							echo '}'; 
						echo '});'; 
					echo 'return false;'; 
					echo '}'; 
					echo '</script>'; 				
									
				//Подстановка готовых вариантов в поле для ответа
				echo '<script type="text/javascript">'; 
					echo '$(function() {';
						echo 'function selectToInput(){';
							echo 'var selectid = this.id;';
							echo 'var id = selectid.substr(22);';
							echo 'var stringResult = "#" + selectid + " :selected";';
							echo 'var result = $(stringResult).text();';
							echo 'var stringid = "#admin_answer_comment_for_admin_id_" + id;';
							echo '$(stringid).val(result);';
							echo '}';
						echo '$(".daily_report_comment").change(selectToInput);';
					echo '});';
				echo '</script>';
				
				echo '<script type="text/javascript">'; //вывод полной таблицы результатов
					echo '$(function() {';
					    echo 'function showDayResultTableForAdmin(){';
						  
					      echo 'var idResultMembers = this.id;';
					      echo 'idResultRightMembers = idResultMembers.substr(21);';
						  echo '$.ajaxSetup({cache: false});';
							echo 'jQuery.ajax({';
								echo 'type:"POST",';
								echo 'url: "/wp-admin/admin-ajax.php",';
								echo 'data: {action: "detailedResultForAdmin",';
									  echo 'idResultRightMembers,';
								echo '},';
								echo 'success:function(data){';
								echo 'jQuery("#resultDayTableForAdmin_" + idResultRightMembers).html(data);';
								echo '}';
							echo '});';
							echo 'return false;';
						echo '}';
					    echo '$(".day_result_report").click(showDayResultTableForAdmin);';
					echo '});';
					echo '</script>';  
					
					echo '<script>'; //закрытие результатов участников марафона по клику области вне отчета
						echo 'jQuery(function($){';
						echo '$(document).click(function (e){';
							echo 'var div = $(".resultDayTableForAdmin");';
							echo 'if (!div.is(e.target)';
							    echo '&& div.has(e.target).length === 0) {';
								echo 'div.empty();';
							echo '}';
								echo '});';
						echo '});';  
					echo '</script>';
					
				echo '<script type="text/javascript">'; //закрытие полной таблицы по крестику
					echo '$(document).on("click", ".close_result_user_for_admin", function(event){';
						echo 'var idResultMembersClose = this.id;';
						echo 'var subidResultMembersClose = idResultMembersClose.substr(31);';
						echo '$("#resultDayTableForAdmin_" + subidResultMembersClose).empty();';
					echo '});';
				echo '</script>';
	die();
}
add_action('wp_ajax_showDailyReportTwoDays', 'showDailyReportTwoDays');
add_action('wp_ajax_nopriv_showDailyReportTwoDays', 'showDailyReportTwoDays'); // на самом деле не нужна

// ----------- Обновление отчета "Ежедневные отчеты участников" за 2 дня /director-cabinet ----------- // 
function updateDailyReportTwoDays(){
					global $wpdb;
					
					$day_now = current_time('j');

						if ($day_now == 1 || $day_now == 2) {
							$yesterday_month = current_time('m') - 1;
							if ($yesterday_month == 0) {$yesterday_month = '12'; $yesterday_year = current_time('Y') - 1;};
							if ($yesterday_month == 1) {$yesterday_month = '01'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 2) {$yesterday_month = '02'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 3) {$yesterday_month = '03'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 4) {$yesterday_month = '04'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 5) {$yesterday_month = '05'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 6) {$yesterday_month = '06'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 7) {$yesterday_month = '07'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 8) {$yesterday_month = '08'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 9) {$yesterday_month = '09'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 10) {$yesterday_month = '10'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 11) {$yesterday_month = '11'; $yesterday_year = current_time('Y');};
							$two_days_start_db = $yesterday_year.'-'.$yesterday_month.'-29';
							$two_days_finish_db = $yesterday_year.'-'.$yesterday_month.'-30';
							
						} else {
						if ($day_now == 3 || $day_now == 4) {$two_days_start = '1'; $two_days_finish = '2';};
						if ($day_now == 5 || $day_now == 6) {$two_days_start = '3'; $two_days_finish = '4';};
						if ($day_now == 7 || $day_now == 8) {$two_days_start = '5'; $two_days_finish = '6';};
						if ($day_now == 9 || $day_now == 10) {$two_days_start = '7'; $two_days_finish = '8';};
						if ($day_now == 11 || $day_now == 12) {$two_days_start = '09'; $two_days_finish = '10';};
						if ($day_now == 13 || $day_now == 14) {$two_days_start = '11'; $two_days_finish = '12';};
						if ($day_now == 15 || $day_now == 16) {$two_days_start = '13'; $two_days_finish = '14';};
						if ($day_now == 17 || $day_now == 18) {$two_days_start = '15'; $two_days_finish = '16';};
						if ($day_now == 19 || $day_now == 20) {$two_days_start = '17'; $two_days_finish = '18';};
						if ($day_now == 21 || $day_now == 22) {$two_days_start = '19'; $two_days_finish = '20';};
						if ($day_now == 23 || $day_now == 24) {$two_days_start = '21'; $two_days_finish = '22';};
						if ($day_now == 25 || $day_now == 26) {$two_days_start = '23'; $two_days_finish = '24';};
						if ($day_now == 27 || $day_now == 28) {$two_days_start = '25'; $two_days_finish = '26';};
						if ($day_now == 29 || $day_now == 30) {$two_days_start = '27'; $two_days_finish = '28';};	
						$two_days_start_db = current_time('Y-m').'-'.$two_days_start;
						$two_days_finish_db = current_time('Y-m').'-'.$two_days_finish;
						};
					
			        $answer_report_data = $wpdb->get_results(
					"
					SELECT
					u.date AS date,
					u.user_id AS user_id_check,
					(select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'last_name' limit 1) as last_name
					FROM wpux_daily_report u
					WHERE date = '$two_days_start_db'
					AND u.comment = 'Отчет на проверке'
					ORDER BY last_name
					"
					);	
						if( $answer_report_data ) {
					    	foreach ( $answer_report_data as $string_report_data ) {
							    $current_user_id_for_output = $string_report_data->user_id_check;
							    $data1 = 'admin_answer_comment_for_admin_id_'.$current_user_id_for_output.'';
								$comment_report_today = $_POST[$data1];
								
								if (!empty($comment_report_today)){
									$wpdb->update(
									'wpux_daily_report',
									array( 
									'comment' => $comment_report_today
									),
									array(
									'user_id' => $current_user_id_for_output,
									'date' => $two_days_start_db
									)
									); 
								};
		    				}; //Тело цикла
						}; //Тело первоначального условия
						
					$answer_report_data1 = $wpdb->get_results(
					"
					SELECT
					u.date AS date,
					u.user_id AS user_id_check,
					(select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'last_name' limit 1) as last_name
					FROM wpux_daily_report u
					WHERE date = '$two_days_finish_db'
					AND u.comment = 'Отчет на проверке'
					ORDER BY last_name
					"
					);	
						if( $answer_report_data1 ) {
					    	foreach ( $answer_report_data1 as $string_report_data1 ) {
							    $current_user_id_for_output1 = $string_report_data1->user_id_check;
							    $data2 = 'admin_answer_comment_for_admin_id_'.$current_user_id_for_output1.'';
								$comment_report_today1 = $_POST[$data2];
								$data3 = 'history_comment_id_'.$current_user_id_for_output1;
								$history_comment = $_POST[$data3];

								if (!empty($comment_report_today1)){
									$wpdb->update(
									'wpux_daily_report',
									array( 
									'comment' => $comment_report_today1
									),
									array(
									'user_id' => $current_user_id_for_output1,
									'date' => $two_days_finish_db
									)
									); 
								};

								update_user_meta( $current_user_id_for_output1, 'history_comment', $history_comment );
								
		    				}; //Тело цикла
						}; //Тело первоначального условия	
	die();
}
add_action('wp_ajax_updateDailyReportTwoDays', 'updateDailyReportTwoDays');
add_action('wp_ajax_nopriv_updateDailyReportTwoDays', 'updateDailyReportTwoDays');

// -----------  Вывод отчета "Ежедневные отчеты участников" за сегодня /director-cabinet ----------- // 
function showDailyReportToday(){
				echo '<span style="font-size: 24px;">';				
				//Выводим данные участников марафона за сегодня
				     	$_monthsList = array(
								"01"=>"января","02"=>"февраля","03"=>"марта",
								"04"=>"апреля","05"=>"мая", "06"=>"июня",
								"07"=>"июля","08"=>"августа","09"=>"сентября",
								"10"=>"октября","11"=>"ноября","12"=>"декабря");
						$yesterday = current_time ('j',0) - 1;
						$today = current_time ('j',0);
						$month = $_monthsList[current_time("m")];
						$year = current_time ('Y',0);
						echo 'Сегодня, '; echo $today; echo '&nbsp';echo $month; echo '&nbsp'; echo $year;
				echo '</span>';
				
				echo '<form id="daily_report_today_form">';
						global $wpdb;
						$current_user = wp_get_current_user();
						$current_user_report = $current_user->ID;
						$today_for_admin = current_time('Y-m-d',0);
						$this_month_report = $wpdb->get_results(
						"
					    SELECT
					    u.date AS date,
					    u.comment AS comment,
					    u.user_id AS user_id_check,
					    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'first_name' limit 1) as first_name,
					    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'last_name' limit 1) as last_name,
					    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'height' limit 1) as height,
					    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'weight_at_1_maraphon' limit 1) as weight_at_1_maraphon,
					    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'telephone' limit 1) as telephone,
					    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'first_menstruation_day' limit 1) as first_menstruation_day
						FROM wpux_daily_report u
						WHERE date = '$today_for_admin'
						AND u.comment = 'Отчет на проверке'
						ORDER BY last_name
						"
						);	
						if( $this_month_report ) {
						    foreach ( $this_month_report as $string_report ) {
							    $current_user_id_for_input = $string_report->user_id_check;
							    echo '<div class="table_shadow">';
							    echo '<table class="daily_report_table_1">';
						        echo '<tr>';
						        
						        echo '<td style="width: 4%; text-align: center; padding-left 5px; font-size: 14px">';
						        echo'<strong>ID '.$current_user_id_for_input.'</strong>';
						        echo '</td>';
						        
						        echo '<td style="text-align: center; font-size: 26px;">';
								$name = $string_report->first_name;
								$surname = $string_report->last_name;
								$fio = $surname.' '.$name;
								echo '<a href="http://maraphon.online/wp-admin/user-edit.php?user_id='.$current_user_id_for_input.'&wp_http_referer=%2Fwp-admin%2Fusers.php" target="_blank">'.$fio.'</a>';
						        echo '</td>';
						        
						        echo '<td style="width: 9% !important; padding-top: 5px; font-size: 18px;">';
						        echo '<p class="day_result_report" id="day_result_report_id_'.$current_user_id_for_input.'" style="margin-bottom: 0px !important; cursor: pointer"><i style="font-size: 26px;" class="fa fa-trophy" aria-hidden="true"></i></p>';
						        echo '</td>';
						        
						        echo '<td style="width: 9% !important; color: blue; padding-top: 5px; font-size: 18px; font-weight: 200;">';
						        $height = $string_report->height;  
						        echo $height;
						        echo '</td>';
						        
						        echo '<td style="width: 9% !important; color: green; padding-top: 5px; font-size: 18px; font-weight: 200;">';
						        $weight_at_1_maraphon = $string_report->weight_at_1_maraphon;  
						        echo $weight_at_1_maraphon;
						        echo '</td>';
						        
						        echo '<td style="width: 9% !important; color: #fec300; padding-top: 5px; font-size: 18px; font-weight: 200;">';
						        $user_meta = get_userdata($current_user_id_for_input);
								$user_role = substr($user_meta->roles[0], -4, 4);
								echo $user_role;
								echo '</td>';

						        echo '<td style="width: 12% !important; color: red; padding-top: 5px; font-size: 18px; font-weight: 200;">';
						        $first_menstruation_day = $string_report->first_menstruation_day;  
						        echo $first_menstruation_day;
						        echo '</td>';
						        
								echo '<td style="width: 12%">';
						        $whatsapp_number = $string_report->telephone;
						        $phone= str_replace([' ', '(', ')', '-', '_'], '', $whatsapp_number);
								$phone = preg_replace('/^8/', '+7', $phone);
								$phone = preg_replace('/^7/', '+7', $phone);    
						        echo '<a href="https://api.whatsapp.com/send?phone='.$phone.'" target="_blank"><img style="width: 30px; padding-top: 2px; margin-bottom: -8px;" src="http://maraphon.online/wp-content/uploads/whatsapp-icon-180×180.png"/></a>';
						        echo '</td>';
						        
						        echo '</tr>';
						        
						        echo '<tr>';
						        	echo '<td style="background-color: #f6f6f6;" colspan="6">';
						        		echo '<div class="resultDayTableForAdmin" id="resultDayTableForAdmin_'.$current_user_id_for_input.'"></div>';
						        	echo '</td>';
						        echo '</tr>';
						        
						        echo '</table>'; //конец 1 таблицы
						        
						        echo '<table class="daily_report_table_2">';
							        echo '<tr>';
										echo '<th style="width: 4%;">Дата</th>';
										echo '<th style="width: 14%;">Активность</th>';
									    echo '<th style="width: 7%;">&nbsp;Алкоголь&nbsp;</th>';  
									    echo '<th style="width: 6%;">&nbsp;Мес.&nbsp;</th>';
									    echo '<th style="width: 5%;">&nbsp;Вес&nbsp;</th>';
									    echo '<th style="width: 35%;">Как прошел день</th>';
									    echo '<th style="width: 28%;">Комментарий</th>';
									echo '</tr>';

								//Объявляем переменные для SQL запроса
								$current_user_report = $current_user_id_for_input;
								
								$current_month = current_time ('n',0);
								$year_before = current_time('Y');
								$month_before = $current_month - 1;
								if ($month_before == '0') {
									$month_before = 12;
									$year_before = current_time('Y') - 1;
								};
								$current_month_report_start = $year_before.'-'.$month_before.'-28';
								$current_month_report_end = current_time ('Y-n',0).'-31';
								
								$this_month_report = $wpdb->get_results( 
								"
								SELECT *
								FROM wpux_daily_report daily
								WHERE daily.user_id = $current_user_report
								AND (DATE(daily.date) BETWEEN '$current_month_report_start' AND '$current_month_report_end')
								"
								);
								// вытаскиваем из базы данные по ID пользователя и текущему месяцу
								
								if( $this_month_report ) {
								    foreach ( $this_month_report as $string_report ) {
									    if ($string_report->cheatmeal == '1') {
									        $cheat_fail_color = '#dff1d9';
								        } else if ($string_report->failure == '1') {
									        $cheat_fail_color = '#f8d7da';
								        } else if ($string_report->snack == '1') {
									        $cheat_fail_color = '#fff3cd';
								        } else {
									        $cheat_fail_color = 'white';
								        };
								        
								        $database_date =  $string_report->date;
								        $database_day = substr($database_date, 8);
								        $database_month = substr($database_date, 5, 2);
								        
								        if ($string_report->alcohol == 'Нет' || $string_report->alcohol == 'нет' || $string_report->alcohol == '-') {
									        $alcohol_color = '#404040';
								        } else {
									        $alcohol_color = '#468df9';
								        };
								        
								        if ($string_report->menstruation == 'Есть') {
									        $menstruation_color = 'red';
								        } else {
									        $menstruation_color = '#404040';
								        }; 
									    
									    
								       echo '<tr class="daily_report_table_2_tr">';
								        
								        echo '<td style="width: 4%; background-color: '.$cheat_fail_color.'">';
								        echo $database_day.'.'.$database_month;
								        echo '</td>';
								        
								        echo '<td style="width: 14%; background-color: '.$cheat_fail_color.'">';
								        echo $string_report->activity;
								        echo '</td>';
								        
								        echo '<td style="color: '.$alcohol_color.'; width: 7%; background-color: '.$cheat_fail_color.'">';
								        echo $string_report->alcohol;
								        echo '</td>';
								        
								        echo '<td style="width: 6%; color: '.$menstruation_color.'; background-color: '.$cheat_fail_color.'">'; 
								        echo $string_report->menstruation;
								        echo '</td>';
								        
								        echo '<td style="width: 5%; background-color: '.$cheat_fail_color.'">'; 
								        echo $string_report->today_weight;
								        echo '</td>';
								        
								        echo '<td style="width: 35%; background-color: '.$cheat_fail_color.'">'; 
								        echo $string_report->task;
								        echo '</td>'; 
								        
								        echo '<td style="width: 28%; background-color: '.$cheat_fail_color.'">'; 
								        echo $string_report->comment;
								        echo '</td>';  
								        
								        echo '</tr>';       
					    				};
					    				echo '</table>'; //конец 2 таблицы за сегодня   
								};	 	       
								

								echo '<table class="daily_report_table_3">';
								
								
						        echo '<tr>';
						        
						        echo '<td class="choose_variant_daily_report">';
							    echo '<input class="text-input" style="width: 100%; border: 2px solid #fec300; font-size: 16px;" name="admin_answer_comment_for_admin_id_'.$current_user_id_for_input.'" type="text" id="admin_answer_comment_for_admin_id_'.$current_user_id_for_input.'" value="'.$admin_answer_comment_for_admin.'" />';
						        echo '</td>';
						        
						        echo '<td style="width: 22px;">';
						        echo '
						        <select class="daily_report_comment" name="admin_answer_today_id_'.$current_user_id_for_input.'" id="admin_answer_today_id_'.$current_user_id_for_input.'">
					                    	<option disabled hidden selected>Выбрать ответ</option>
					                    	<option>Умничка)</option>
					                    	<option>Всё хорошо, не переживай)</option>
					                    	<option>ОГОНЬ</option>
					                    	<option>Скоро цикл, так что все хорошо</option>
					                    	<option>Молодец</option>
					                    	<option>ХОРОШО</option>
					                    	<option>ОТЛИЧНО</option>
					                    	<option>Так держать</option>
					                    	<option>Не налегай на вкусняшки</option>
					                    	<option>Все хорошо</option>
					                    	<option>Не критично</option>
					                    	<option>Скорейшего выздоровления</option>
					                    	<option>Стабильность тоже отлично</option>
					                    	<option>Сейчас напишу в Whatsapp</option>
					                    	<option>Ответила в Whatsapp</option>
				                    	</select>    
						        ';
						        echo '</td>'; 
						        	        
						        echo '</tr>';
						        
						        echo '</table>'; //конец 3 таблицы 
						        
						        echo '</div>'; //table_shadow
						        
						        echo '<div class="daily_report_yellow_line"></div>';
						        }
							}		
				
				echo '<p class="daily_report_admin_answer_submit" >';
					echo '<input type="hidden" name="action" value="updateDailyReportToday"/>';
					echo '<input name="updateDailyReportToday" type="submit" id="daily_report_admin_answer_today_submit" class="submit button" value="Проверить отчеты за сегодня" />';

					echo '</p>';
				echo '</form>';		
				
				echo '<div id="success_form"><p>Данные обновлены</p></div>';		
									
					echo '<script type="text/javascript">'; 
					echo 'jQuery("#daily_report_today_form").submit(ajaxUpdateDailyReportToday);'; 
					echo 'function ajaxUpdateDailyReportToday(){'; 
						echo 'var dailyReportToday = jQuery(this).serialize();'; 
						echo 'jQuery.ajax({'; 
							echo 'type:"POST",'; 
							echo 'url: "/wp-admin/admin-ajax.php",'; 
							echo 'data: dailyReportToday,';
							echo 'success:function(data){'; 
							echo '$("#success_form").show();'; 
							echo 'setTimeout(function(){$("#success_form").fadeOut("slow")},1000);';
							echo '}'; 
						echo '});'; 
					echo 'return false;'; 
					echo '}'; 
					echo '</script>'; 				
									
				//Подстановка готовых вариантов в поле для ответа
				echo '<script type="text/javascript">'; 
					echo '$(function() {';
						echo 'function selectToInput(){';
							echo 'var selectid = this.id;';
							echo 'var id = selectid.substr(22);';
							echo 'var stringResult = "#" + selectid + " :selected";';
							echo 'var result = $(stringResult).text();';
							echo 'var stringid = "#admin_answer_comment_for_admin_id_" + id;';
							echo '$(stringid).val(result);';
							echo '}';
						echo '$(".daily_report_comment").change(selectToInput);';
					echo '});';
				echo '</script>';
				
				echo '<script type="text/javascript">'; //вывод полной таблицы результатов
					echo '$(function() {';
					    echo 'function showDayResultTableForAdmin(){';
						  
					      echo 'var idResultMembers = this.id;';
					      echo 'idResultRightMembers = idResultMembers.substr(21);';
						  echo '$.ajaxSetup({cache: false});';
							echo 'jQuery.ajax({';
								echo 'type:"POST",';
								echo 'url: "/wp-admin/admin-ajax.php",';
								echo 'data: {action: "detailedResultForAdmin",';
									  echo 'idResultRightMembers,';
								echo '},';
								echo 'success:function(data){';
								echo 'jQuery("#resultDayTableForAdmin_" + idResultRightMembers).html(data);';
								echo '}';
							echo '});';
							echo 'return false;';
						echo '}';
					    echo '$(".day_result_report").click(showDayResultTableForAdmin);';
					echo '});';
					echo '</script>';  
					
					echo '<script>'; //закрытие результатов участников марафона по клику области вне отчета
						echo 'jQuery(function($){';
						echo '$(document).click(function (e){';
							echo 'var div = $(".resultDayTableForAdmin");';
							echo 'if (!div.is(e.target)';
							    echo '&& div.has(e.target).length === 0) {';
								echo 'div.empty();';
							echo '}';
								echo '});';
						echo '});';  
					echo '</script>';
					
				echo '<script type="text/javascript">'; //закрытие полной таблицы по крестику
					echo '$(document).on("click", ".close_result_user_for_admin", function(event){';
						echo 'var idResultMembersClose = this.id;';
						echo 'var subidResultMembersClose = idResultMembersClose.substr(31);';
						echo '$("#resultDayTableForAdmin_" + subidResultMembersClose).empty();';
					echo '});';
				echo '</script>';
	die();
}
add_action('wp_ajax_showDailyReportToday', 'showDailyReportToday');
add_action('wp_ajax_nopriv_showDailyReportToday', 'showDailyReportToday'); // на самом деле не нужна 

// ----------- Обновление отчета "Ежедневные отчеты участников" за сегодня /director-cabinet ----------- // 
function updateDailyReportToday(){
					global $wpdb;
			        $today = current_time('Y-m-d',0);
			        //376 - WHERE date = '$today'
			        $answer_report_data = $wpdb->get_results(
					"
					SELECT
					u.date AS date,
					u.user_id AS user_id_check,
					(select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'last_name' limit 1) as last_name
					FROM wpux_daily_report u
					WHERE date = '$today'
					AND u.comment = 'Отчет на проверке'
					ORDER BY last_name
					"
					);	
						if( $answer_report_data ) {
					    	foreach ( $answer_report_data as $string_report_data ) {
							    $current_user_id_for_output = $string_report_data->user_id_check;
							    $data1 = 'admin_answer_comment_for_admin_id_'.$current_user_id_for_output.'';
								$comment_report_today = $_POST[$data1];
								
								
								if (!empty($comment_report_today)){
									$wpdb->update(
									'wpux_daily_report',
									array( 
									'comment' => $comment_report_today
									),
									array(
									'user_id' => $current_user_id_for_output,
									'date' => $today
									)
									); 
								};
		    				}; //Тело цикла
						}; //Тело первоначального условия		
	die();
}
add_action('wp_ajax_updateDailyReportToday', 'updateDailyReportToday');
add_action('wp_ajax_nopriv_updateDailyReportToday', 'updateDailyReportToday');

// -----------  Вывод отчета "Ежедневные отчеты участников" за вчера /director-cabinet ----------- // 
function showDailyReportYesterday(){

				echo '<span style="font-size: 24px;">';				
				//Выводим данные участников марафона за вчерашний день
				     	$_monthsList = array(
								"01"=>"января","02"=>"февраля","03"=>"марта",
								"04"=>"апреля","05"=>"мая", "06"=>"июня",
								"07"=>"июля","08"=>"августа","09"=>"сентября",
								"10"=>"октября","11"=>"ноября","12"=>"декабря");
						$today_for_daily_report = current_time ('Y-m-d',0); //2020-10-31
						$yesterday = current_time ('d') - 1;
						if ($yesterday < 10) {$yesterday = '0'.$yesterday;};
						if ($yesterday == 0) {
							$yesterday_month = current_time('m') - 1;
							if ($yesterday_month == 0) {$yesterday = '31'; $yesterday_month = '12'; $yesterday_year = current_time('Y') - 1;};
							if ($yesterday_month == 1) {$yesterday = '31'; $yesterday_month = '01'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 2) {$yesterday = '28'; $yesterday_month = '02'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 3) {$yesterday = '31'; $yesterday_month = '03'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 4) {$yesterday = '30'; $yesterday_month = '04'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 5) {$yesterday = '31'; $yesterday_month = '05'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 6) {$yesterday = '30'; $yesterday_month = '06'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 7) {$yesterday = '31'; $yesterday_month = '07'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 8) {$yesterday = '31'; $yesterday_month = '08'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 9) {$yesterday = '30'; $yesterday_month = '09'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 10) {$yesterday = '31'; $yesterday_month = '10'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 11) {$yesterday = '30'; $yesterday_month = '11'; $yesterday_year = current_time('Y');};
						} else {
							$yesterday_month = current_time('m');
							$yesterday_year = current_time('Y');
						};
						$yesterday_for_admin = $yesterday_year.'-'.$yesterday_month.'-'.$yesterday;
						$yesterday_for_header = $yesterday;
						$month_for_header = $_monthsList[$yesterday_month];
						$year_for_header = $yesterday_year;
						echo 'Вчера, '; echo $yesterday_for_header; echo '&nbsp';echo $month_for_header; echo '&nbsp'; echo $year_for_header;
				echo '</span>';
				
				echo '<form id="daily_report_today_form">';
						//Таблица результатов за вчера
						global $wpdb;
						$current_user = wp_get_current_user();
						$current_user_report = $current_user->ID;

						$this_month_report = $wpdb->get_results(
						"
					    SELECT
					    u.date AS date,
					    u.comment AS comment,
					    u.user_id AS user_id_check,
					    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'first_name' limit 1) as first_name,
					    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'last_name' limit 1) as last_name,
					    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'height' limit 1) as height,
					    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'weight_at_1_maraphon' limit 1) as weight_at_1_maraphon,
					    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'telephone' limit 1) as telephone,
					    (select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'first_menstruation_day' limit 1) as first_menstruation_day
						FROM wpux_daily_report u
						WHERE date = '$yesterday_for_admin'
						AND u.comment = 'Отчет на проверке'
						ORDER BY last_name
						"
						);	
						if( $this_month_report ) {
						    foreach ( $this_month_report as $string_report ) {
							    $current_user_id_for_input = $string_report->user_id_check;
							    echo '<div class="table_shadow">';
							    echo '<table class="daily_report_table_1">';
						        echo '<tr>';
						        
						        echo '<td style="width: 4%; text-align: center; padding-left 5px; font-size: 14px">';
						        echo'<strong>ID '.$current_user_id_for_input.'</strong>';
						        echo '</td>';
						        
						        echo '<td style="text-align: center; font-size: 26px;">';
								$name = $string_report->first_name;
								$surname = $string_report->last_name;
								$fio = $surname.' '.$name;
								echo '<a href="http://maraphon.online/wp-admin/user-edit.php?user_id='.$current_user_id_for_input.'&wp_http_referer=%2Fwp-admin%2Fusers.php" target="_blank">'.$fio.'</a>';
						        echo '</td>';
						        
						        echo '<td style="width: 9% !important; padding-top: 5px; font-size: 18px;">';
						        echo '<p class="day_result_report" id="day_result_report_id_'.$current_user_id_for_input.'" style="margin-bottom: 0px !important; cursor: pointer"><i style="font-size: 26px;" class="fa fa-trophy" aria-hidden="true"></i></p>';
						        echo '</td>';
						        
						        echo '<td style="width: 9% !important; color: blue; padding-top: 5px; font-size: 18px; font-weight: 200;">';
						        $height = $string_report->height;  
						        echo $height;
						        echo '</td>';
						        
						        echo '<td style="width: 9% !important; color: green; padding-top: 5px; font-size: 18px; font-weight: 200;">';
						        $weight_at_1_maraphon = $string_report->weight_at_1_maraphon;  
						        echo $weight_at_1_maraphon;
						        echo '</td>';
						        
						        echo '<td style="width: 9% !important; color: #fec300; padding-top: 5px; font-size: 18px; font-weight: 200;">';
						        $user_meta = get_userdata($current_user_id_for_input);
								$user_role = substr($user_meta->roles[0], -4, 4);
								echo $user_role;
								echo '</td>';

						        echo '<td style="width: 12% !important; color: red; padding-top: 5px; font-size: 18px; font-weight: 200;">';
						        $first_menstruation_day = $string_report->first_menstruation_day;  
						        echo $first_menstruation_day;
						        echo '</td>';
								echo '<td style="width: 12%">';
						        $whatsapp_number = $string_report->telephone;
						        $phone= str_replace([' ', '(', ')', '-', '_'], '', $whatsapp_number);
								$phone = preg_replace('/^8/', '+7', $phone);
								$phone = preg_replace('/^7/', '+7', $phone);    
						        echo '<a href="https://api.whatsapp.com/send?phone='.$phone.'" target="_blank"><img style="width: 30px; padding-top: 2px; margin-bottom: -8px;" src="http://maraphon.online/wp-content/uploads/whatsapp-icon-180×180.png"/></a>';
						        echo '</td>';
						        echo '</tr>';
						        
						        echo '<tr>';
						        	echo '<td style="background-color: #f6f6f6;" colspan="6">';
						        		echo '<div class="resultDayTableForAdmin" id="resultDayTableForAdmin_'.$current_user_id_for_input.'"></div>';
						        	echo '</td>';
						        echo '</tr>';
						        
						        echo '</table>'; //конец 1 таблицы
						        echo '<table class="daily_report_table_2">';
							        echo '<tr>';
										echo '<th style="width: 4%;">Дата</th>';
										echo '<th style="width: 12%;">Активность</th>';
									    echo '<th style="width: 7%;">&nbsp;Алкоголь&nbsp;</th>';  
									    echo '<th style="width: 7%;">&nbsp;Мес.&nbsp;</th>';
									    echo '<th style="width: 5%;">&nbsp;Вес&nbsp;</th>';
									    echo '<th style="width: 41%;">Как прошел день</th>';
									    echo '<th style="width: 24%;">Комментарий</th>';
									echo '</tr>';

								//Объявляем переменные для SQL запроса
								$current_user_report = $current_user_id_for_input;
								$current_month = current_time ('n',0);
								$year_before = current_time('Y');
								$month_before = $current_month - 1;
								if ($month_before == '0') {
									$month_before = 12;
									$year_before = current_time('Y') - 1;
								};
								
								$current_month_report_start = $year_before.'-'.$month_before.'-28';
								if ((current_time('d') - 1) == '0') {
								$current_month_report_end = $year_before.'-'.$month_before.'-31';	
								} else {	
								$current_month_report_end = current_time ('Y-n',0).'-31';
								};
								/*$current_month_report = current_time ('Y-n',0);
								$date_from = $current_month_report.'-01';
								$date_before = $current_month_report.'-31';*/
								$this_month_report = $wpdb->get_results( 
								"
								SELECT *
								FROM wpux_daily_report daily
								WHERE daily.user_id = $current_user_report
								AND (DATE(daily.date) BETWEEN '$current_month_report_start' AND '$yesterday_for_admin')
								"
								);
								// вытаскиваем из базы данные по ID пользователя и текущему месяцу
								
								if( $this_month_report ) {
								    foreach ( $this_month_report as $string_report ) {
								        echo '<tr class="daily_report_table_2_tr">';
								        if ($string_report->cheatmeal == '1') {
									        $cheat_fail_color = '#dff1d9';
								        } else if ($string_report->failure == '1') {
									        $cheat_fail_color = '#f8d7da';
								        } else if ($string_report->snack == '1') {
									        $cheat_fail_color = '#fff3cd';
								        } else {
									        $cheat_fail_color = 'white';
								        };
								        echo '<td style="width: 4%; background-color: '.$cheat_fail_color.'">'; 
								        $database_date =  $string_report->date;
								        $database_day = substr($database_date, 8);
								        $database_month = substr($database_date, 5, 2);
								        echo $database_day;
								        echo '.';
								        echo $database_month;
								        echo '</td>';
								        
								        echo '<td style="width: 14%; background-color: '.$cheat_fail_color.'">';   
								        echo $string_report->activity;
								        echo '</td>';
								        
								        if ($string_report->alcohol == 'Нет' || $string_report->alcohol == 'нет' || $string_report->alcohol == '-') {
									        $alcohol_color = '#404040';
								        } else {
									        $alcohol_color = '#468df9';
								        };
								        
								        echo '<td style="width: 7%; color: '.$alcohol_color.'; background-color: '.$cheat_fail_color.'">';   
								        echo $string_report->alcohol;
								        echo '</td>';
								        
								        if ($string_report->menstruation == 'Есть') {
									        $menstruation_color = 'red';
								        } else {
									        $menstruation_color = '#404040';
								        };
								        echo '<td style="width: 6%; color: '.$menstruation_color.'; background-color: '.$cheat_fail_color.'">'; 
								        echo $string_report->menstruation;
								        echo '</td>';
								        
								        echo '<td style="width: 5%; background-color: '.$cheat_fail_color.'">';  
								        echo $string_report->today_weight;
								        echo '</td>';
								        
								        echo '<td style="width: 35%; background-color: '.$cheat_fail_color.'">';  
								        echo $string_report->task;
								        echo '</td>'; 
								        echo '<td style="width: 28%; background-color: '.$cheat_fail_color.'">';
								        echo $string_report->comment;
								        echo '</td>';
								        echo '</tr>';       
					    				}
								}		 	        
								echo '</table>'; //конец 2 таблицы за вчера

								echo '<table class="daily_report_table_3">';
    
						        echo '<tr>';
						        echo '<td class="choose_variant_daily_report">';
							    echo '<input class="text-input" style="width:100%; border: 2px solid #fec300; font-size: 16px;" name="admin_answer_comment_for_admin_id_'.$current_user_id_for_input.'" type="text" id="admin_answer_comment_for_admin_id_'.$current_user_id_for_input.'" value="'.$admin_answer_comment_for_admin.'" />';
						        echo '</td>';
						        echo '<td style="width: 22px;">';
						        echo '
						        <select class="daily_report_comment" name="admin_answer_today_id_'.$current_user_id_for_input.'" id="admin_answer_today_id_'.$current_user_id_for_input.'">
					                    	<option disabled hidden selected>Выбрать ответ</option>
					                    	<option>Умничка)</option>
					                    	<option>Всё хорошо, не переживай)</option>
					                    	<option>ОГОНЬ</option>
					                    	<option>Скоро цикл, так что все хорошо</option>
					                    	<option>Молодец</option>
					                    	<option>ХОРОШО</option>
					                    	<option>ОТЛИЧНО</option>
					                    	<option>Так держать</option>
					                    	<option>Не налегай на вкусняшки</option>
					                    	<option>Все хорошо</option>
					                    	<option>Не критично</option>
					                    	<option>Скорейшего выздоровления</option>
					                    	<option>Стабильность тоже отлично</option>
					                    	<option>Сейчас напишу в Whatsapp</option>
					                    	<option>Ответила в Whatsapp</option>
				                    	</select>    
						        ';
						        echo '</td>'; 	        
						        echo '</tr>';
						        echo '</table>'; //конец 3 таблицы
						        echo '</div>';
						        echo '<div class="daily_report_yellow_line"></div>';
						        }
							}		
				
				echo '<p class="daily_report_admin_answer_submit" >';
					echo '<input type="hidden" name="action" value="updateDailyReportYesterday"/>';
					echo '<input name="updateDailyReportYesterday" type="submit" id="daily_report_admin_answer_today_submit" class="submit button" value="Проверить отчеты за вчера" />';

					echo '</p>';
				echo '</form>';		
				
				echo '<div id="success_form"><p>Данные обновлены</p></div>';		
									
					echo '<script type="text/javascript">'; 
					echo 'jQuery("#daily_report_today_form").submit(ajaxUpdateDailyReportYesterday);'; 
					echo 'function ajaxUpdateDailyReportYesterday(){'; 
						echo 'var dailyReportYesterday = jQuery(this).serialize();'; 
						echo 'jQuery.ajax({'; 
							echo 'type:"POST",'; 
							echo 'url: "/wp-admin/admin-ajax.php",'; 
							echo 'data: dailyReportYesterday,';
							echo 'success:function(data){'; 
							echo '$("#success_form").show();'; 
							echo 'setTimeout(function(){$("#success_form").fadeOut("slow")},1000);';
							echo '}'; 
						echo '});'; 
					echo 'return false;'; 
					echo '}'; 
					echo '</script>'; 				
													
				//Подстановка готовых вариантов в поле для ответа
				echo '<script type="text/javascript">'; 
					echo '$(function() {';
						echo 'function selectToInput(){';
							echo 'var selectid = this.id;';
							echo 'var id = selectid.substr(22);';
							echo 'var stringResult = "#" + selectid + " :selected";';
							echo 'var result = $(stringResult).text();';
							echo 'var stringid = "#admin_answer_comment_for_admin_id_" + id;';
							echo '$(stringid).val(result);';
							echo '}';
						echo '$(".daily_report_comment").change(selectToInput);';
					echo '});';
				echo '</script>';
				
				echo '<script type="text/javascript">'; //вывод полной таблицы результатов
					echo '$(function() {';
					    echo 'function showDayResultTableForAdmin(){';
					      echo 'var idResultMembers = this.id;';
					      echo 'idResultRightMembers = idResultMembers.substr(21);';
						  echo '$.ajaxSetup({cache: false});';
							echo 'jQuery.ajax({';
								echo 'type:"POST",';
								echo 'url: "/wp-admin/admin-ajax.php",';
								echo 'data: {action: "detailedResultForAdmin",';
									  echo 'idResultRightMembers,';
								echo '},';
								echo 'success:function(data){';
								echo 'jQuery("#resultDayTableForAdmin_" + idResultRightMembers).html(data);';
								echo '}';
							echo '});';
							echo 'return false;';
						echo '}';
					    echo '$(".day_result_report").click(showDayResultTableForAdmin);';
					echo '});';
					echo '</script>';  
					
				echo '<script>'; //закрытие результатов участников марафона по клику области вне отчета
						echo 'jQuery(function($){';
						echo '$(document).click(function (e){';
							echo 'var div = $(".resultDayTableForAdmin");';
							echo 'if (!div.is(e.target)';
							    echo '&& div.has(e.target).length === 0) {';
								echo 'div.empty();';
							echo '}';
								echo '});';
						echo '});';  
					echo '</script>';
					
				echo '<script type="text/javascript">'; //закрытие полной таблицы по крестику
						echo '$(document).on("click", ".close_result_user_for_admin", function(event){';
							echo 'var idResultMembersClose = this.id;';
							echo 'var subidResultMembersClose = idResultMembersClose.substr(31);';
							echo '$("#resultDayTableForAdmin_" + subidResultMembersClose).empty();';
						echo '});';
					echo '</script>';
			die();
		}
add_action('wp_ajax_showDailyReportYesterday', 'showDailyReportYesterday');
add_action('wp_ajax_nopriv_showDailyReportYesterday', 'showDailyReportYesterday');

// ----------- Обновление отчета "Ежедневные отчеты участников" за вчера /director-cabinet ----------- // 
function updateDailyReportYesterday(){
					global $wpdb;
					$today_for_daily_report = current_time ('Y-m-d',0); //2020-10-31
						$yesterday = current_time ('d') - 1;
						if ($yesterday < 10) {$yesterday = '0'.$yesterday;};
						if ($yesterday == 0) {
							$yesterday_month = current_time('m') - 1;
							if ($yesterday_month == 0) {$yesterday = '31'; $yesterday_month = '12'; $yesterday_year = current_time('Y') - 1;};
							if ($yesterday_month == 1) {$yesterday = '31'; $yesterday_month = '01'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 2) {$yesterday = '28'; $yesterday_month = '02'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 3) {$yesterday = '31'; $yesterday_month = '03'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 4) {$yesterday = '30'; $yesterday_month = '04'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 5) {$yesterday = '31'; $yesterday_month = '05'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 6) {$yesterday = '30'; $yesterday_month = '06'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 7) {$yesterday = '31'; $yesterday_month = '07'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 8) {$yesterday = '31'; $yesterday_month = '08'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 9) {$yesterday = '30'; $yesterday_month = '09'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 10) {$yesterday = '31'; $yesterday_month = '10'; $yesterday_year = current_time('Y');};
							if ($yesterday_month == 11) {$yesterday = '30'; $yesterday_month = '11'; $yesterday_year = current_time('Y');};
						} else {
							$yesterday_month = current_time('m');
							$yesterday_year = current_time('Y');
						};
					$yesterday_for_admin = $yesterday_year.'-'.$yesterday_month.'-'.$yesterday;
					
			        $answer_report_data = $wpdb->get_results(
					"
					SELECT
					u.date AS date,
					u.user_id AS user_id_check,
					(select meta_value from wpux_usermeta where user_id = u.user_id and meta_key = 'last_name' limit 1) as last_name
					FROM wpux_daily_report u
					WHERE date = '$yesterday_for_admin'
					AND u.comment = 'Отчет на проверке'
					ORDER BY last_name
					"
					);	
						if( $answer_report_data ) {
					    	foreach ( $answer_report_data as $string_report_data ) {
							    $current_user_id_for_output = $string_report_data->user_id_check;
							    $data1 = 'admin_answer_comment_for_admin_id_'.$current_user_id_for_output.'';
								$comment_report_today = $_POST[$data1];
								
								
								if (!empty($comment_report_today)){
									$wpdb->update(
									'wpux_daily_report',
									array( 
									'comment' => $comment_report_today
									),
									array(
									'user_id' => $current_user_id_for_output,
									'date' => $yesterday_for_admin
									)
									); 
								};
		    				}; //Тело цикла
						}; //Тело первоначального условия
	die();
}
add_action('wp_ajax_updateDailyReportYesterday', 'updateDailyReportYesterday');
add_action('wp_ajax_nopriv_updateDailyReportYesterday', 'updateDailyReportYesterday');

// -----------  Вывод отчета "Участники" /director-cabinet ----------- // 
function choosePeriodForAdmin(){
					$choose_members_by_type = $_POST['choose_members_by_type'];
					$choose_period_month = $_POST['choose_period_month'];
					$choose_period_year = $_POST['choose_period_year'];
					$check_period_members_month_and_year = $choose_period_month.'.'.$choose_period_year;
					
	
				if ($choose_members_by_type == 'maraphon_order') {  //начало условия при выборе участников марафона
	
					$_monthsListPeriod = array(
								"01"=>"январь","02"=>"февраль","03"=>"март",
								"04"=>"апрель","05"=>"май", "06"=>"июнь",
								"07"=>"июль","08"=>"август","09"=>"сентябрь",
								"10"=>"октябрь","11"=>"ноябрь","12"=>"декабрь");	
			
								$period_now_month = $_POST['choose_period_month'];
								$period_now_year = $_POST['choose_period_year'];
								$period_now_ajax = $period_now_month.'.'.$period_now_year;	
								$period_now_month_for_header = $_monthsListPeriod[$period_now_month];
								
								$period_before_month_calc = ($period_now_month - 1);
								if (($period_before_month_calc > 0) && ($period_before_month_calc <= 9)) {
									$period_before_month_ready = "0".$period_before_month_calc; $period_before_year_ready = $period_now_year;
								}; 
								if ($period_before_month_calc > 9) {$period_before_month_ready = $period_before_month_calc; $period_before_year_ready = $period_now_year;};
								if ($period_before_month_calc == 0) {$period_before_month_ready = 12; $period_before_year_ready = $period_now_year - 1;};
								$period_before = $period_before_month_ready.'.'.$period_before_year_ready;
								
								
				echo '<h2 class="members_h2">Участники марафона, '.$period_now_month_for_header.' '.$period_now_year.'</h2>';
				echo '<br>';
				
				//Запрет на изменение прошедших периодов 
				$check_month_members_role = current_time('m');
				$check_year_members_role = current_time('Y');
				$check_date_members_role = $check_month_members_role.'.'.$check_year_members_role;
				
				if ( 
				   ($choose_period_month == $check_month_members_role && $choose_period_year == $check_year_members_role) ||
				   ($choose_period_month > $check_month_members_role && $choose_period_year == $check_year_members_role && current_time("d") > 28) ||
				   ($choose_period_month < $check_month_members_role && $choose_period_year > $check_year_members_role && current_time("d") > 28) 
				   ) {
					$check_flag_member_role = '';
				
				} else {
					$check_flag_member_role = 'display:none;';
				};
				
				if ( ($choose_period_month >= $check_month_members_role && $choose_period_year >= $check_year_members_role) || ($choose_period_month < $check_month_members_role && $choose_period_year > $check_year_members_role)) {
					$check_flag_button = '';
				} else {
					$check_flag_button = 'display:none;';
				};

				
				echo '<form id="membersRoleForAdmin">';

					echo '<input type="hidden" name="action" value="updateMembersRoleAfterAjax"/>';
					echo '<input style="'.$check_flag_button.'; position: absolute; margin-left: 885px; margin-top: -60px;" type="submit" id="updateusermembers" class="submit button members_mobile_hide" value="Записать">';
					echo '<table class="daily_report_table_for_members"  id="fixed_top_string">';
					echo '<thead>';
				echo '<tr style="background-color: #f6f6f6;">';
					
				    echo '<th style="width: 12%">&nbsp;ФИО&nbsp;</th>';
				    echo '<th style="width: 5%;"><i class="fa fa-calendar-check-o" aria-hidden="true"></i></th>'; 
				    echo '<th style="width: 5%;"><i class="fa fa-trophy" aria-hidden="true"></i></th>';  
				    echo '<th style="width: 4%">&nbsp;Воз&nbsp;<br>&nbsp;раст&nbsp;</th>';
				    echo '<th>&nbsp;Рост&nbsp;</th>';
				    echo '<th>&nbsp;Вес&nbsp;</th>';
				    echo '<th>&nbsp;ГВ&nbsp;</th>';
				    echo '<th>&nbsp;Акт.&nbsp;</th>';
				    echo '<th class="members_mobile_hide" style="width: 7%">Расчет<br>(база)</th>';
				    echo '<th style="width: 7%">Расчет<br>(-15%)</th>';
				    echo '<th class="members_mobile_hide" style="width: 5%;">Роль<br>до&nbsp;</th>';
				    echo '<th class="members_mobile_hide" style="width: 5%;">&nbsp;Класс&nbsp;<br>&nbsp;до&nbsp;</th>';
				    echo '<th style="'.$check_flag_member_role.'">&nbsp;Роль&nbsp;</th>';
				    echo '<th style="width: 2%; '.$check_flag_member_role.'">&nbsp;Класс&nbsp;</th>';
				    echo '<th class="members_mobile_hide" style="width: 2%;">&nbsp;Кура&nbsp<br>&nbspтор&nbsp;</th>';
				    echo '<th class="members_mobile_hide" style="width: 28%">&nbsp;Комментарий директора&nbsp;</th>';
				    echo '<th style="width: 3%;">&nbsp;<i class="fa fa-paper-plane-o" aria-hidden="true">&nbsp;</th>';
				   
			    echo '</tr>';
			    echo '</thead>';
			    
				require_once ABSPATH . 'wp-admin/includes/user.php';
				require_once ABSPATH . 'wp-admin/includes/template.php';
				global $current_user_id_for_inpit, $wpdb;
				wp_get_current_user();	
				$current_user_report = $current_user->ID;

				$this_month_report2 = $wpdb->get_results(
						"
						SELECT
						    orders.date AS order_date,
						    users.ID AS user_id_check,
						    orders.order_id AS order_id,
						    orders.user_id,
						    (select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'first_name' limit 1) as first_name,
						    (select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'last_name' limit 1) as last_name,
						    (select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'telephone' limit 1) as telephone,
						    (select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'age' limit 1) as age,
						    (select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'height' limit 1) as height,
						    (select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'weight-at-start' limit 1) as weight_at_start,
						    (select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'breastfeed' limit 1) as breastfeed,
						    (select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'daily-activity' limit 1) as daily_activity,
						    (select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'kcal_with_active' limit 1) as kcal_with_active,
						    (select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'maraphon_counter' limit 1) as maraphon_counter,
						    orders2.kcal_now as kcal_before,
						    orders2.class_now as class_before,
						    orders.kcal_now,
						    orders.class_now,
						    orders.maraphon_next_month,
						    (select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'wpux_capabilities' limit 1) as role_color,
						    (select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'workout_class' limit 1) as workout_class,
						    orders.maraphon_member_month,
						    orders.credit,
						    orders.paid,
						    orders.curator,
						    orders.director_comment
						    FROM wpux_orders orders
						    
						    LEFT JOIN wpux_orders orders2
						    ON (
						    orders2.user_id = orders.user_id and orders2.maraphon_member_month = '$period_before')
						
						    LEFT JOIN wpux_users users
						    ON (
						    orders.user_email = users.user_email)
						    
						    WHERE orders.maraphon_member_month = '$period_now_ajax'
						    AND (orders.paid = '1' OR orders.credit = '1')
						    AND (orders.maraphon_next_month LIKE '%марафон%' OR orders.maraphon_next_month LIKE '%пакет%')
						    ORDER BY last_name
						"
						);	
							if( $this_month_report2 ) {
						    foreach ( $this_month_report2 as $string_report2 ) {
								$current_user_id_for_input = $string_report2->user_id_check;
								
								
								if ($string_report2->maraphon_next_month == 'пакет "Профи"') {$sticker = 'sticker-pro.png';}
								else if ($string_report2->maraphon_next_month == 'пакет "Новичок"') {$sticker = 'sticker-new.png';}
								else if ($string_report2->maraphon_next_month == 'пакет "Новичок Лайт"') {$sticker = 'sticker-new-light.png';}
								else if ($string_report2->maraphon_next_month == 'пакет "Семейный"') {$sticker = 'sticker-new.png';}
								else if ($string_report2->maraphon_next_month == 'пакет "VIP"') {$sticker = 'sticker-vip.png';}
								else if ($string_report2->maraphon_counter == '1') {$maraphon_counter_for_color_member = '#fff3cd'; $sticker = 'sticker-new.png';}
								else {$maraphon_counter_for_color_member = 'white'; $sticker = 'sticker-pro.png';};
								
						        echo '<tr id="members_row_id_'.$current_user_id_for_input.'">';
						        
						        //echo '<td style="font-weight: 400; background-color: '.$maraphon_counter_for_color_member.'">';
						        echo '<td style="font-weight: 400;">';
								$name = $string_report2->first_name;
								$surname = $string_report2->last_name;
								$fio = $surname.' '.$name;
								echo '<span class="members" id="members_id_'.$current_user_id_for_input.'" style="cursor: pointer">'.$fio.'</span>';
						        echo '</td>'; 
						        
						        echo '<td>'; 
						        echo '<img class="members_report" id="members_report_id_'.$current_user_id_for_input.'" src="http://maraphon.online/wp-content/uploads/'.$sticker.'" style="cursor: pointer; width: 30px; margin-top:5px; margin-bottom: -3px; padding-left: 2px; padding-right: 2px;">';
						        echo '</td>';
						        
						        echo '<td>'; 
						        echo '<p class="result_admin_report" id="result_admin_report_id_'.$current_user_id_for_input.'" style="margin-bottom: 0px !important; cursor: pointer"><i class="fa fa-trophy" aria-hidden="true"></i></p>';
						        echo '</td>';
						        
						        echo '<td>'; 
						        echo $string_report2->age;
						        echo '</td>';
						        
						        echo '<td>'; 
						      
						        echo $string_report2->height;
						        echo '</td>';
						        
						        echo '<td>'; 
						        echo ($string_report2->weight_at_start + 0);
						        echo '</td>';
						        
						        if ($string_report2->breastfeed == 'Да') {
							        $breastfeed_color = '#ddf7c8';
							    } else {
								    $breastfeed_color = 'white';
							    };
						        
						        echo '<td style="background-color: '.$breastfeed_color.'">&nbsp;'; 
						        echo $string_report2->breastfeed;
						        echo '&nbsp;</td>';
						        
						        echo '<td>'; 
						        echo $string_report2->daily_activity;
						        echo '</td>';
						        
						        $kcal_with_active_base = 0;
						        $kcal_with_active = 0;
						        $weight_user =  ($string_report2->weight_at_start + 0);
								$height_user =  $string_report2->height;;
								$age_user =  $string_report2->age;
								$daily_activity_user =  $string_report2->daily_activity;			
								if (($weight_user > 0) && ($height_user > 0) && ($age_user > 0) && ($daily_activity_user > 0)) {
								    $imt = round( $weight_user/($height_user * $height_user * 0.0001) );
									if ($imt<26) {$pk=0;}
									if ($imt>=26 && $imt<30) {$pk=0.05;}
									if ($imt>=30 && $imt<35) {$pk=0.1;} 
									if ($imt>=35 && $imt<40) {$pk=0.15;} 
									if ($imt>=40) {$pk=0.2;}		
									$kcal_without_active = round((655 + (9.6 * $weight_user)+(1.8 * $height_user)-(4.7 * $age_user)) - (655 + (9.6 * $weight_user)+(1.8 * $height_user)-(4.7 * $age_user)) * $pk);
									$kcal_with_active_base = round($kcal_without_active * $daily_activity_user);
									$kcal_with_active = round($kcal_without_active * $daily_activity_user * 0.85);
								} else {
										$weight_user = 0;
										$weight_user = 0;
										$weight_user = 0;
										$daily_activity_user = 0;
										$kcal_without_active = 0;
										$kcal_with_active_base = 0;
										}	
						        
						        echo '<td class="members_mobile_hide">'; 
						        echo $kcal_with_active_base;
						        echo '</td>';
						        
						        echo '<td>'; 
						        echo $kcal_with_active;
						        echo '</td>';
						        
						        echo '<td class="members_mobile_hide">'; 
						        echo $string_report2->kcal_before;
						        echo '</td>';
						        
						        echo '<td class="members_mobile_hide">'; 
						        echo $string_report2->class_before;
						        echo '</td>';
						        
						        $role_color_value = $string_report2->role_color;
						        if ($role_color_value == 'a:1:{s:10:"notconfirm";b:1;}') {
							        $role_color = 'white';
							    } else {
								    $role_color = '#ddf7c8';
							    };
						        
						        echo '<td style="'.$check_flag_member_role.'">'; 
						        if ( ($period_now_month >= current_time('m')) && ($period_now_year == current_time('Y')) || $period_now_year > current_time('Y')) { //запрет редактирования прошлых периодов
							        $userrole = get_userdata( $current_user_id_for_input );
							        echo '<select style="width: 145px; height: 26px; background-color: '.$role_color.';" name="current_role_id_'.$current_user_id_for_input.'">';
									wp_dropdown_roles($userrole->roles[0]);
									echo '</select>'; 
								} else {
									if ($string_report2->kcal_now == 'firm') {
										echo 'Неподтвержденный';
									} else {
										echo $string_report2->kcal_now;
									};
								};
						        echo '</td>';
						        
						        
						        $workout_value = $string_report2->workout_class;
						        if ($workout_value == 'Нет' || $workout_value == '') {
							        $workout_color = 'white';
							    } else {
								    $workout_color = '#ddf7c8';
							    };
						        
						        echo '<td style="'.$check_flag_member_role.'">';
						        if ($string_report2->maraphon_next_month == 'пакет "Новичок Лайт"') {
							        	echo '-';
						        } else if ( ($period_now_month >= current_time('m')) && ($period_now_year == current_time('Y')) || $period_now_year > current_time('Y')) { //запрет редактирования прошлых периодов
									    if ($workout_value == '1') { $selected1 = 'selected="selected"'; };
										if ($workout_value == '2') { $selected2 = 'selected="selected"'; };
										if ($workout_value == '3') { $selected3 = 'selected="selected"'; };
										if ($workout_value == '4') { $selected4 = 'selected="selected"'; };
										if ($workout_value == '5') { $selected5 = 'selected="selected"'; };
										if ($workout_value == '6') { $selected6 = 'selected="selected"'; };
										if ($workout_value == '7') { $selected7 = 'selected="selected"'; };
										if ($workout_value == '8') { $selected8 = 'selected="selected"'; };
										if ($workout_value == '9') { $selected9 = 'selected="selected"'; };
										if ($workout_value == '10') { $selected10 = 'selected="selected"'; };
										if ($workout_value == 'Зал') { $selectedGym = 'selected="selected"'; };
										if ($workout_value == 'Нет' || $workout_value == '') { $selectedNo = 'selected="selected"'; };
								        echo '<select style="height: 26px; background-color: '.$workout_color.';" name="workout_class_id_'.$current_user_id_for_input.'">'; 
										echo '<option '.$selected1.' value="1">1</option>'; 
										echo '<option '.$selected2.' value="2">2</option>'; 
										echo '<option '.$selected3.' value="3">3</option>'; 
										echo '<option '.$selected4.' value="4">4</option>'; 
										echo '<option '.$selected5.' value="5">5</option>'; 
										echo '<option '.$selected6.' value="6">6</option>'; 
										echo '<option '.$selected7.' value="7">7</option>'; 
										echo '<option '.$selected8.' value="8">8</option>'; 
										echo '<option '.$selected9.' value="9">9</option>'; 
										echo '<option '.$selected10.' value="10">10</option>'; 
										echo '<option '.$selectedGym.' value="Зал">Зал</option>'; 
										echo '<option '.$selectedNo.' value="Нет">Нет</option>'; 
										echo '</select>'; 
								        $selected1 = '';
								        $selected2 = '';
								        $selected3 = '';
								        $selected4 = '';
								        $selected5 = '';
										$selected6 = '';
								        $selected7 = '';
								        $selected8 = '';
								        $selected9 = '';
								        $selected10 = '';
								        $selectedGym = '';
								        $selectedNo = '';
						        } else {
							        echo $string_report2->class_now;
						        };
						        
						      /*  if (($role_color_value == 'a:1:{s:10:"notconfirm";b:1;}') || ($workout_value == 'Нет')) {
							        $member_color = 'white';
						        } else {
							        $member_color = '#ddf7c8';
						        };  */
						        echo '</td>'; 
						        
						        if ($string_report2->director_comment) {
							        $member_color = '#ddf7c8';
						        } else {
							        $member_color = 'white';
						        };
						        
						        $curator_value = $string_report2->curator; 
						        //echo '<td class="members_mobile_hide" style="'.$check_flag_member_role.'">';
						        echo '<td class="members_mobile_hide">';
						        if ( ($period_now_month >= current_time('m')) && ($period_now_year == current_time('Y')) || $period_now_year > current_time('Y')) { //запрет редактирования прошлых периодов
							    	 if ($curator_value == 'Екатерина' || $curator_value == '') { $selected_cur_1 = 'selected="selected"'; $curator_color = '#ddf7c8';};
									 if ($curator_value == 'Наталья') { $selected_cur_2 = 'selected="selected"'; $curator_color = '#fec5f0';};
									 if ($curator_value == 'Дмитрий') { $selected_cur_3 = 'selected="selected"'; $curator_color = '#99c1ff';};
									 echo '<select style="height: 26px; background-color: '.$curator_color.';" name="curator_id_'.$current_user_id_for_input.'">'; 
										echo '<option '.$selected_cur_1.' value="Екатерина">Е</option>'; 
										echo '<option '.$selected_cur_2.' value="Наталья">Н</option>'; 
										echo '<option '.$selected_cur_3.' value="Дмитрий">Д</option>'; 
									 echo '</select>';
									 $selected_cur_1 = '';
								     $selected_cur_2 = '';
								     $selected_cur_3 = '';
							    };
						        echo '</td>';
						        
						        echo '<td class="members_mobile_hide">';
						        if ( ($period_now_month >= current_time('m')) && ($period_now_year == current_time('Y')) || $period_now_year > current_time('Y')) { //запрет редактирования прошлых периодов 
						        	echo '<input class="text-input" style="width: 100%; vertical-align: middle; height: 26px; background-color: '.$member_color.'; overflow: scroll;" name="director_comment_id_'.$current_user_id_for_input.'" type="text" value="'.$string_report2->director_comment.'" />'; 
						        } else {
							        echo $string_report2->director_comment;
						        };
						        echo '</td>';
						      
						        echo '<td>';
						        $whatsapp_number = $string_report2->telephone;
						        $phone= str_replace([' ', '(', ')', '-', '_'], '', $whatsapp_number);
								$phone = preg_replace('/^8/', '+7', $phone);
								$phone = preg_replace('/^7/', '+7', $phone);    
						        echo '<a href="https://api.whatsapp.com/send?phone='.$phone.'" target="_blank"><img style="width: 30px; padding-top:5px" src="http://maraphon.online/wp-content/uploads/whatsapp-icon-180×180.png"/></a>';	
						        echo '</td>';
						       
						        echo '</tr>';
						       
						        echo '<tr>';
						        
						        echo '<td colspan="17">'; 
						        echo '<div class="reportTableForAdmin" id="reportTableForAdmin_'.$current_user_id_for_input.'"></div>';
						        echo '<div style="background-color: #f6f6f6;" class="resultReportForAdmin" id="resultReportForAdmin_'.$current_user_id_for_input.'"></div>';
						        echo '<div style="background-color: #f6f6f6;" class="formUserForAdmin" id="formUserForAdmin_'.$current_user_id_for_input.'"></div>';
						        echo '</td>'; 
						        
						        echo '</tr>';
							}
							}
		echo '<table style="opacity: 0; font-size: 5px">';
		echo '<tr><td>Hidden</td></td>';
		echo '</table>';					
							
		echo '<div id="success_form"><p style="padding-top: 10px; margin: 0;">Данные обновлены</p></div>';
		
		echo '<input type="hidden" name="action" value="updateMembersRoleAfterAjax"/>';
		echo '<input style="'.$check_flag_button.'" type="submit" id="updateusermembers" class="submit button" value="Записать">';
		echo '</div>';
		
	echo '</form>';  
	
	echo '<script type="text/javascript">'; 
		echo 'jQuery("#membersRoleForAdmin").submit(ajaxMemberRole);'; 
		echo 'function ajaxMemberRole(){'; 
			echo 'var memberRolesData = jQuery(this).serialize();'; 
			echo 'var choose_period_month = $("#choose_period_month").val();';
			echo 'var choose_period_year = $("#choose_period_year").val();';
			echo 'var periodNowAjax = (choose_period_month + "." + choose_period_year);';
			echo 'var memberRolesData = memberRolesData + "&periodNowAjaxData=" + periodNowAjax;'; 
			echo 'jQuery.ajax({'; 
				echo 'type:"POST",'; 
				echo 'url: "/wp-admin/admin-ajax.php",'; 
				echo 'data: memberRolesData,';
				echo 'success:function(data){'; 
				echo '$("#success_form").show();'; 
				echo 'setTimeout(function(){$("#success_form").fadeOut("slow")},1000);';
				echo '}'; 
			echo '});'; 
		echo 'return false;'; 
		echo '}'; 
		echo '</script>'; 	
													
	echo '<script type="text/javascript">';
	echo '$(function() {';
	    echo 'function showFormUserForAdmin(){';
		  
	      echo 'var idMembers = this.id;';
	      echo 'idRightMembers = idMembers.substr(11);';
		  echo '$.ajaxSetup({cache: false});';
			echo 'jQuery.ajax({';
				echo 'type:"POST",';
				echo 'url: "/wp-admin/admin-ajax.php",';
				echo 'data: {action: "formUserForAdmin",';
					  echo 'idRightMembers,';
				echo '},';
				echo 'success:function(data){';
				echo 'jQuery("#formUserForAdmin_" + idRightMembers).html(data);';
				echo '$("#members_row_id_" + idRightMembers).css("background-color", "#fec300");';
				echo '}';
			echo '});';
			echo 'return false;';
		echo '}';
	    echo '$(".members").click(showFormUserForAdmin);';
	echo '});';
	echo '</script>';
						
	echo '<script type="text/javascript">';
		echo '$(function() {';
		    echo 'function showDailyReportForAdmin(){';
		      echo 'var id = this.id;';
		      echo 'var idRight = id.substr(18);';
		      echo 'var choose_period_month = $("#choose_period_month").val();';
			  echo 'var choose_period_year = $("#choose_period_year").val();';
			  echo 'var periodNowAjaxDaily = (choose_period_month + "." + choose_period_year);';
			  echo '$.ajaxSetup({cache: false});';
				echo 'jQuery.ajax({';
					echo 'type:"POST",';
					echo 'url: "/wp-admin/admin-ajax.php",';
					echo 'data: {action: "dailyReportForAdmin",';
						  echo 'idRight, periodNowAjaxDaily,';
					echo '},';
					echo 'success:function(data){';
					echo 'jQuery("#reportTableForAdmin_" + idRight).html(data);';
					echo '}';
				echo '});';
				echo 'return false;';
			echo '}';
		    echo '$(".members_report").click(showDailyReportForAdmin);';
		echo '});';
	echo '</script>';
	
	echo '<script type="text/javascript">'; //вывод результатов участников марафона во всплывающем окне
		echo '$(function() {';
		    echo 'function showResultReportForAdmin(){';
		      echo 'var idResult = this.id;';
		      echo 'var idResultRightMembers = idResult.substr(23);';
			  echo '$.ajaxSetup({cache: false});';
				echo 'jQuery.ajax({';
					echo 'type:"POST",';
					echo 'url: "/wp-admin/admin-ajax.php",';
					echo 'data: {action: "detailedResultForAdmin",';
						  echo 'idResultRightMembers,';
					echo '},';
					echo 'success:function(data){';
					echo 'jQuery("#resultReportForAdmin_" + idResultRightMembers).html(data);';
					echo '}';
				echo '});';
				echo 'return false;';
			echo '}';
		    echo '$(".result_admin_report").click(showResultReportForAdmin);';
		echo '});';
	echo '</script>';
	
	echo '<script>'; //закрытие результатов участников марафона по клику области вне отчета
	echo 'jQuery(function($){';
	echo '$(document).click(function (e){';
		echo 'var div = $(".resultReportForAdmin");';
		echo 'if (!div.is(e.target)';
		    echo '&& div.has(e.target).length === 0) {';
			echo 'div.empty();';
		echo '}';
			echo '});';
	echo '});';  
	echo '</script>';
									
	echo '<script type="text/javascript">'; //закрытие анкеты пользователя по крестику
	echo '$(document).on("click", ".close_form_user_for_admin", function(event){';
		echo 'var idMembersClose = this.id;';
		echo 'var subidMembersClose = idMembersClose.substr(29);';
		echo '$("#formUserForAdmin_" + subidMembersClose).empty();';
		echo '$("#members_row_id_" + subidMembersClose).css("background-color", "white");';
	echo '});';
	echo '</script>';					
			
	echo '<script>'; //закрытие ежедневного отчета по клику области вне отчета
	echo 'jQuery(function($){';
	echo '$(document).click(function (e){';
		echo 'var div = $(".reportTableForAdmin");';
		echo 'if (!div.is(e.target)';
		    echo '&& div.has(e.target).length === 0) {';
			echo 'div.empty();';
		echo '}';
			echo '});';
	echo '});';  
	echo '</script>';		
						
	echo '<div style="clear: both;"></div>';
	
	} else if ($choose_members_by_type == 'menu_order_new') {  //начало условия при выборе покупателей меню НОВЫЙ
		$_monthsListPeriod = array(
								"01"=>"январь","02"=>"февраль","03"=>"март",
								"04"=>"апрель","05"=>"май", "06"=>"июнь",
								"07"=>"июль","08"=>"август","09"=>"сентябрь",
								"10"=>"октябрь","11"=>"ноябрь","12"=>"декабрь");	
								$period_now_month = $_POST['choose_period_month'];
								$period_now_year = $_POST['choose_period_year'];
								
								$period_now_month_before = $period_now_month - 1;
								if ($period_now_month_before == 0) {
									$period_now_month_before = 12; $period_now_year_before = $period_now_year - 1;
								} else {
									$period_now_year_before = $period_now_year;
								}
								
								$before_date_from = $period_now_year_before.'-'.$period_now_month_before.'-01';
								$before_date_before = $period_now_year_before.'-'.$period_now_month_before.'-31';
								
								$date_from = $period_now_year.'-'.$period_now_month.'-01';
								$date_before = $period_now_year.'-'.$period_now_month.'-31';
								$period_now_ajax = $period_now_month.'.'.$period_now_year;	
								$period_now_month_for_header = $_monthsListPeriod[$period_now_month];
								
								$period_before_month_calc = ($period_now_month - 1);
								if (($period_before_month_calc > 0) && ($period_before_month_calc <= 9)) {
									$period_before_month_ready = "0".$period_before_month_calc; $period_before_year_ready = $period_now_year;
								}; 
								if ($period_before_month_calc > 9) {$period_before_month_ready = $period_before_month_calc; $period_before_year_ready = $period_now_year;};
								if ($period_before_month_calc == 0) {$period_before_month_ready = 12; $period_before_year_ready = $period_now_year - 1;};
								$period_before = $period_before_month_ready.'.'.$period_before_year_ready;
								

				echo '<h2 class="members_h2">Покупатели меню, '.$period_now_month_for_header.' '.$period_now_year.'</h2>';
				echo '<br>';
				
				echo '<form id="membersMenuNewForAdmin">';
					echo '<input type="hidden" name="action" value="updateMenuNewRoleAfterAjax"/>';
					echo '<input style="position: absolute; margin-left: 885px; margin-top: -60px;" type="submit" id="updateusermembers" class="submit button members_mobile_hide" value="Записать">';
					echo '<table class="daily_report_table_for_members"  id="fixed_top_string">';
					echo '<thead>';
				echo '<tr style="background-color: #f6f6f6;">';
				    echo '<th style="width: 12%">&nbsp;ФИО&nbsp;</th>'; 
				    echo '<th style="width: 4%">&nbsp;Воз&nbsp;<br>&nbsp;раст&nbsp;</th>';
				    echo '<th>&nbsp;Рост&nbsp;</th>';
				    echo '<th>&nbsp;Вес&nbsp;</th>';
				    echo '<th>&nbsp;ГВ&nbsp;</th>';
				    echo '<th>&nbsp;Актив&nbsp;<br>&nbsp;ность&nbsp;</th>';
				    echo '<th class="members_mobile_hide" style="width: 7%">Расчет<br>(база)</th>';
				    echo '<th style="width: 7%">Расчет<br>(-15%)</th>';
				    echo '<th style="width: 5%;">&nbsp;Меню&nbsp;<br>&nbsp;до&nbsp;</th>';
				    echo '<th style="width: 7%">&nbsp;М / Ж&nbsp;</th>';
				    echo '<th style="width: 15%">&nbsp;Меню&nbsp;</th>';
				    echo '<th class="members_mobile_hide" style="width: 28%">&nbsp;Комментарий директора&nbsp;</th>';
				    echo '<th style="width: 3%;">&nbsp;<i class="fa fa-paper-plane-o" aria-hidden="true">&nbsp;</th>';
				   
			    echo '</tr>';
			    echo '</thead>';

			    global $current_user_id_for_inpit, $wpdb;
				wp_get_current_user();	
				$current_user_report = $current_user->ID;
				$this_month_report2 = $wpdb->get_results(
						"
						SELECT 
						orders_menu.date AS order_date,
						orders_menu.order_id AS order_id,
						users.ID AS user_id_check,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'telephone' limit 1) as telephone,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'first_name' limit 1) as first_name,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'last_name' limit 1) as last_name,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'men_menu_age' limit 1) as men_menu_age,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'men_menu_height' limit 1) as men_menu_height,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'men_menu_weight_at_start' limit 1) as men_menu_weight_at_start,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'men_menu_daily_activity' limit 1) as men_menu_daily_activity,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'women_menu_age' limit 1) as women_menu_age,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'women_menu_height' limit 1) as women_menu_height,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'women_menu_weight_at_start' limit 1) as women_menu_weight_at_start,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'women_menu_breastfeed' limit 1) as women_menu_breastfeed,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'women_menu_daily_activity' limit 1) as women_menu_daily_activity,
						orders_menu.content,
						orders_menu.kcal,
						(select 
	                        orders_menu.kcal
	                        FROM wpux_orders_menu orders_menu
	                        WHERE (DATE(orders_menu.date) BETWEEN '$before_date_from' AND '$before_date_before')
	                        AND (orders_menu.paid = 1 OR orders_menu.credit = 1)
							AND orders_menu.user_email = users.user_email
                        ) as kcal_before,
						orders_menu.credit,
						orders_menu.paid,
						orders_menu.amount,
						orders_menu.director_comment
						FROM wpux_orders_menu orders_menu, wpux_users users
						WHERE (DATE(orders_menu.date) BETWEEN '$date_from' AND '$date_before')
						AND (orders_menu.paid = 1 OR orders_menu.credit = 1)
						AND orders_menu.user_email = users.user_email 
						ORDER BY orders_menu.order_id DESC
						"
						);	
							if( $this_month_report2 ) {
						    foreach ( $this_month_report2 as $string_report2 ) {
								$current_menu_order_id_for_input = $string_report2->order_id;
								$current_user_id_for_input = $string_report2->user_id_check;
						        echo '<tr id="members_row_id_'.$current_menu_order_id_for_input.'">';
						        
						        echo '<td style="font-weight: 400;">';
								$name = $string_report2->first_name;
								$surname = $string_report2->last_name;
								$fio = $surname.' '.$name;
								echo '<span class="members" id="members_id_'.$current_user_id_for_input.'" style="cursor: pointer">'.$fio.'</span>';
						        echo '</td>'; 
						        
						        echo '<td>';
						        if (substr($string_report2->content, 0, 2) == 'М') {
							        echo $string_report2->men_menu_age;
						        } else if (substr($string_report2->content, 0, 2) == 'Ж') {
							        echo $string_report2->women_menu_age;
							    };
						        echo '</td>';
						        
						        echo '<td>'; 
						        if (substr($string_report2->content, 0, 2) == 'М') {
							        echo $string_report2->men_menu_height;
						        } else if (substr($string_report2->content, 0, 2) == 'Ж') {
							        echo $string_report2->women_menu_height;
							    };
						        echo '</td>';
						        
						        echo '<td>'; 
						        if (substr($string_report2->content, 0, 2) == 'М') {
							        echo $string_report2->men_menu_weight_at_start + 0;
						        } else if (substr($string_report2->content, 0, 2) == 'Ж') {
							        echo $string_report2->women_menu_weight_at_start + 0;
							    };
						        echo '</td>';
						        
						        if ($string_report2->women_menu_breastfeed == 'Да' && substr($string_report2->content, 0, 2) == 'Ж') {
							        $breastfeed_color = '#ddf7c8';
							    } else {
								    $breastfeed_color = 'white';
							    };
						        
						        echo '<td style="background-color: '.$breastfeed_color.'">&nbsp;'; 
						         if (substr($string_report2->content, 0, 2) == 'М') {
							        echo '-';
						        } else if (substr($string_report2->content, 0, 2) == 'Ж') {
							        echo $string_report2->women_menu_breastfeed;
							    };
						        echo '&nbsp;</td>';
						        
						        echo '<td>'; 
						        if (substr($string_report2->content, 0, 2) == 'М') {
							        echo $string_report2->men_menu_daily_activity;
						        } else if (substr($string_report2->content, 0, 2) == 'Ж') {
							        echo $string_report2->women_menu_daily_activity;
							    };
						        echo '</td>';
						        
						        $kcal_with_active_base = 0;
						        $kcal_with_active = 0;
						        if  (substr($string_report2->content, 0, 2) == 'М') {
							    	$weight_user =  ($string_report2->men_menu_weight_at_start + 0);
									$height_user =  $string_report2->men_menu_height;;
									$age_user =  $string_report2->men_menu_age;
									$daily_activity_user =  $string_report2->men_menu_daily_activity;
									if (($weight_user > 0) && ($height_user > 0) && ($age_user > 0) && ($daily_activity_user > 0)) {
								    $imt = round( $weight_user/($height_user * $height_user * 0.0001) );
								    if ($imt<26) {$pk=0;}
									if ($imt>=26 && $imt<30) {$pk=0.05;}
									if ($imt>=30 && $imt<35) {$pk=0.1;} 
									if ($imt>=35 && $imt<40) {$pk=0.15;} 
									if ($imt>=40) {$pk=0.2;}
									$kcal_without_active = round((65 + (13.7 * $weight_user) + (5 * $height_user) - (6.8 * $age_user)) - ( 65 + (13.7 * $weight_user) + (5 * $height_user)-(6.8 * $age_user)) * pk);
									$kcal_with_active_base = round($kcal_without_active * $daily_activity_user);
									$kcal_with_active = round($kcal_without_active * $daily_activity_user * 0.85);
								} else {
										$weight_user = 0;
										$weight_user = 0;
										$weight_user = 0;
										$daily_activity_user = 0;
										$kcal_without_active = 0;
										$kcal_with_active_base = 0;	
										};
						        } else if (substr($string_report2->content, 0, 2) == 'Ж') {
							    	$weight_user =  ($string_report2->women_menu_weight_at_start + 0);
									$height_user =  $string_report2->women_menu_height;;
									$age_user =  $string_report2->women_menu_age;
									$daily_activity_user =  $string_report2->women_menu_daily_activity;
									if (($weight_user > 0) && ($height_user > 0) && ($age_user > 0) && ($daily_activity_user > 0)) {
								    $imt = round( $weight_user/($height_user * $height_user * 0.0001) );
									if ($imt<26) {$pk=0;}
									if ($imt>=26 && $imt<30) {$pk=0.05;}
									if ($imt>=30 && $imt<35) {$pk=0.1;} 
									if ($imt>=35 && $imt<40) {$pk=0.15;} 
									if ($imt>=40) {$pk=0.2;}		
									$kcal_without_active = round((655 + (9.6 * $weight_user)+(1.8 * $height_user)-(4.7 * $age_user)) - (655 + (9.6 * $weight_user)+(1.8 * $height_user)-(4.7 * $age_user)) * $pk);
									$kcal_with_active_base = round($kcal_without_active * $daily_activity_user);
									$kcal_with_active = round($kcal_without_active * $daily_activity_user * 0.85);
								} else {
										$weight_user = 0;
										$weight_user = 0;
										$weight_user = 0;
										$daily_activity_user = 0;
										$kcal_without_active = 0;
										$kcal_with_active_base = 0;
										};		
							    };
						        
						        echo '<td class="members_mobile_hide">'; 
						        echo $kcal_with_active_base;
						        echo '</td>';
						        
						        echo '<td>'; 
						        echo $kcal_with_active;
						        echo '</td>';
						        
						        echo '<td>'; 
						       if (substr($string_report2->content, 0, 2) == 'М' && substr($string_report2->kcal_before, 0, 1) == 'm') {
							        echo substr($string_report2->kcal_before, -4);
						        } else if (substr($string_report2->content, 0, 2) == 'Ж' && substr($string_report2->kcal_before, 0, 1) == 'w') {
							        echo substr($string_report2->kcal_before, -4);
							    }; 
						        
						        
						        
						        
						        echo '</td>';
						        
						        echo '<td>'; 
						        if (substr($string_report2->content, 0, 2) == 'М') {
							        echo 'Муж.';
						        } else if (substr($string_report2->content, 0, 2) == 'Ж') {
							        echo 'Жен.';
							    };
						        echo '</td>';
						        
						        echo '<td>'; //7.  М/Ж
						        if  (substr($string_report2->content, 0, 2) == 'М') {
							        $men_menu_value = $string_report2->kcal;
							        if ($men_menu_value == 'men_menu_1600') { $men_menu_selected1 = 'selected="selected"'; $men_menu_color = '#fec300';};
							        if ($men_menu_value == 'men_menu_1800') { $men_menu_selected2 = 'selected="selected"'; $men_menu_color = '#fec300';};
						      		if ($men_menu_value == 'men_menu_2000') { $men_menu_selected3 = 'selected="selected"'; $men_menu_color = '#fec300';};
									if ($men_menu_value == 'men_menu_2200') { $men_menu_selected4 = 'selected="selected"'; $men_menu_color = '#fec300';};
									if ($men_menu_value == 'men_menu_2500') { $men_menu_selected5 = 'selected="selected"'; $men_menu_color = '#fec300';};
									if ($men_menu_value == 'Нет' || $men_menu_value == '' || $men_menu_value == 'men_menu') { $men_menu_selectedNo = 'selected="selected"'; $men_menu_color = 'white';};
									echo '<select style="height: 26px; width: 100%; text-align-last: center; background-color: '.$men_menu_color.'" name="men_menu_id_'.$current_menu_order_id_for_input.'">';
									    echo '<option '.$men_menu_selectedNo.' value="Нет">Нет</option>';
									    echo '<option '.$men_menu_selected1.' value="men_menu_1600">Муж. 1600</option>';
									    echo '<option '.$men_menu_selected2.' value="men_menu_1800">Муж. 1800</option>';  
										echo '<option '.$men_menu_selected3.' value="men_menu_2000">Муж. 2000</option>'; 
										echo '<option '.$men_menu_selected4.' value="men_menu_2200">Муж. 2200</option>'; 
										echo '<option '.$men_menu_selected5.' value="men_menu_2500">Муж. 2500</option>';
									echo '</select>';
									$men_menu_selectedNo = '';
									$men_menu_selected1 = '';
								    $men_menu_selected2 = '';
								    $men_menu_selected3 = '';
								    $men_menu_selected4 = '';
								    $men_menu_selected5 = '';
						        } else if (substr($string_report2->content, 0, 2) == 'Ж') {
									$women_menu_value = $string_report2->kcal;
									if ($women_menu_value == 'women_menu_1200') { $women_menu_selected1 = 'selected="selected"'; $women_menu_color = '#fec300';};
									if ($women_menu_value == 'women_menu_1400') { $women_menu_selected2 = 'selected="selected"'; $women_menu_color = '#fec300';};
									if ($women_menu_value == 'women_menu_1600') { $women_menu_selected3 = 'selected="selected"'; $women_menu_color = '#fec300';};
									if ($women_menu_value == 'women_menu_1800') { $women_menu_selected4 = 'selected="selected"'; $women_menu_color = '#fec300';};
									if ($women_menu_value == 'women_menu_2000') { $women_menu_selected5 = 'selected="selected"'; $women_menu_color = '#fec300';};
									if ($women_menu_value == 'women_menu_2200') { $women_menu_selected6 = 'selected="selected"'; $women_menu_color = '#fec300';};
									if ($women_menu_value == 'Нет' || $women_menu_value == '' || $women_menu_value == 'women_menu') { $women_menu_selectedNo = 'selected="selected"'; $women_menu_color = 'white';};
									echo '<select style="height: 26px; width: 100%; text-align-last: center; background-color: '.$women_menu_color.'" name="women_menu_id_'.$current_menu_order_id_for_input.'">';
										echo '<option '.$women_menu_selectedNo.' value="Нет">Нет</option>'; 
										echo '<option '.$women_menu_selected1.' value="women_menu_1200">Жен. 1200</option>';
										echo '<option '.$women_menu_selected2.' value="women_menu_1400">Жен. 1400</option>'; 
										echo '<option '.$women_menu_selected3.' value="women_menu_1600">Жен. 1600</option>'; 
										echo '<option '.$women_menu_selected4.' value="women_menu_1800">Жен. 1800</option>'; 
										echo '<option '.$women_menu_selected5.' value="women_menu_2000">Жен. 2000</option>'; 
										echo '<option '.$women_menu_selected6.' value="women_menu_2200">Жен. 2200</option>';
									echo '</select>'; 
									$women_menu_selected1 = '';
								    $women_menu_selected2 = '';
								    $women_menu_selected3 = '';
								    $women_menu_selected4 = '';
								    $women_menu_selected5 = ''; 
								    $women_menu_selected6 = '';
								    $women_menu_selectedNo = '';  
							    };
						   
								echo '</td>';
						        					        
						        echo '<td class="members_mobile_hide">';
						        if ( (($period_now_month >= current_time('m')) && ($period_now_year >= current_time('Y'))) || ($period_now_year >= current_time('Y')) ) { //запрет редактирования прошлых периодов 
						        	echo '<input class="text-input" style="width: 100%; vertical-align: middle; height: 26px; background-color: '.$member_color.'; overflow: scroll;" name="director_menu_comment_id_'.$current_menu_order_id_for_input.'" type="text" value="'.$string_report2->director_comment.'" />'; 
						        } else {
							        echo $string_report2->director_comment;
						        };
						      
						        echo '<td>';
						        $whatsapp_number = $string_report2->telephone;
						        $phone= str_replace([' ', '(', ')', '-', '_'], '', $whatsapp_number);
								$phone = preg_replace('/^8/', '+7', $phone);
								$phone = preg_replace('/^7/', '+7', $phone);    
						        echo '<a href="https://api.whatsapp.com/send?phone='.$phone.'" target="_blank"><img style="width: 30px; padding-top:5px" src="http://maraphon.online/wp-content/uploads/whatsapp-icon-180×180.png"/></a>';	
						        echo '</td>';
						       
						        echo '</tr>';
						       
						        echo '<tr>';
						        
						        echo '<td colspan="16">'; 
						        echo '<div style="background-color: #f6f6f6;" class="formUserForAdmin" id="formUserForAdmin_'.$current_user_id_for_input.'"></div>';
						        echo '</td>'; 
						        
						        echo '</tr>';
							}
							}
		echo '<table style="opacity: 0; font-size: 5px">';
		echo '<tr><td>Hidden</td></td>';
		echo '</table>';					
							
		echo '<div id="success_form"><p style="padding-top: 10px; margin: 0;">Данные обновлены</p></div>';
		
		echo '<input type="hidden" name="action" value="updateMenuNewRoleAfterAjax"/>';
		echo '<input style="'.$check_flag_button.'" type="submit" id="updateusermembers" class="submit button" value="Записать">';
		echo '</div>';
		
	echo '</form>';  
	
	echo '<script type="text/javascript">'; 
		echo 'jQuery("#membersMenuNewForAdmin").submit(ajaxMenuNewRole);'; 
		echo 'function ajaxMenuNewRole(){'; 
			echo 'var memberMenuNewData = jQuery(this).serialize();'; 
			echo 'var choose_period_month = $("#choose_period_month").val();';
			echo 'var choose_period_year = $("#choose_period_year").val();';
			echo 'var periodNowAjaxMenu = (choose_period_month + "." + choose_period_year);';
			echo 'var memberMenuNewData = memberMenuNewData + "&periodNowAjaxData=" + periodNowAjaxMenu;'; 
			echo 'jQuery.ajax({'; 
				echo 'type:"POST",'; 
				echo 'url: "/wp-admin/admin-ajax.php",'; 
				echo 'data: memberMenuNewData,';
				echo 'success:function(data){'; 
				echo '$("#success_form").show();'; 
				//echo '$("#success_form").html(data);'; 
				echo 'setTimeout(function(){$("#success_form").fadeOut("slow")},1000);';
				echo '}'; 
			echo '});'; 
		echo 'return false;'; 
		echo '}'; 
		echo '</script>'; 	
													
	echo '<script type="text/javascript">';
	echo '$(function() {';
	    echo 'function showFormUserForAdmin(){';
	      echo 'var idMembers = this.id;';
	      echo 'idRightMembers = idMembers.substr(11);';
		  echo '$.ajaxSetup({cache: false});';
			echo 'jQuery.ajax({';
				echo 'type:"POST",';
				echo 'url: "/wp-admin/admin-ajax.php",';
				echo 'data: {action: "formMenuUserForAdmin",';
					  echo 'idRightMembers,';
				echo '},';
				echo 'success:function(data){';
				echo 'jQuery("#formUserForAdmin_" + idRightMembers).html(data);';
				echo '$("#members_row_id_" + idRightMembers).css("background-color", "#fec300");';
				echo '}';
			echo '});';
			echo 'return false;';
		echo '}';
	    echo '$(".members").click(showFormUserForAdmin);';
	echo '});';
	echo '</script>';
									
	echo '<script type="text/javascript">'; //закрытие анкеты пользователя по крестику
	echo '$(document).on("click", ".close_form_user_for_admin", function(event){';
		echo 'var idMembersClose = this.id;';
		echo 'var subidMembersClose = idMembersClose.substr(29);';
		echo '$("#formUserForAdmin_" + subidMembersClose).empty();';
		echo '$("#members_row_id_" + subidMembersClose).css("background-color", "white");';
	echo '});';
	echo '</script>';					

		
	
	} else if ($choose_members_by_type == 'menu_order') {  //начало условия при выборе покупателей меню
		$_monthsListPeriod = array(
								"01"=>"январь","02"=>"февраль","03"=>"март",
								"04"=>"апрель","05"=>"май", "06"=>"июнь",
								"07"=>"июль","08"=>"август","09"=>"сентябрь",
								"10"=>"октябрь","11"=>"ноябрь","12"=>"декабрь");	
								$period_now_month = $_POST['choose_period_month'];
								$period_now_year = $_POST['choose_period_year'];
								$date_from = $period_now_year.'-'.$period_now_month.'-01';
								$date_before = $period_now_year.'-'.$period_now_month.'-31';
								$period_now_ajax = $period_now_month.'.'.$period_now_year;	
								$period_now_month_for_header = $_monthsListPeriod[$period_now_month];
								
								$period_before_month_calc = ($period_now_month - 1);
								if (($period_before_month_calc > 0) && ($period_before_month_calc <= 9)) {
									$period_before_month_ready = "0".$period_before_month_calc; $period_before_year_ready = $period_now_year;
								}; 
								if ($period_before_month_calc > 9) {$period_before_month_ready = $period_before_month_calc; $period_before_year_ready = $period_now_year;};
								if ($period_before_month_calc == 0) {$period_before_month_ready = 12; $period_before_year_ready = $period_now_year - 1;};
								$period_before = $period_before_month_ready.'.'.$period_before_year_ready;
								

				echo '<h2 class="members_h2">Покупатели меню, '.$period_now_month_for_header.' '.$period_now_year.'</h2>';
				echo '<br>';
				
				//Запрет на изменение прошедших периодов 
				$check_month_members_role = current_time('m');
				$check_year_members_role = current_time('Y');
				$check_date_members_role = $check_month_members_role.'.'.$check_year_members_role;
				if ( ($period_now_ajax < $check_date_members_role) || ( ($period_now_ajax > $check_date_members_role) && (current_time('d') < 29) ) ) {
					$check_flag_member_role = 'display:none;';
				} else {
					$check_flag_member_role = '';
				};
				
				if ( ($period_now_ajax < $check_date_members_role) ) {
					$check_flag_button = 'display:none;';
				} else {
					$check_flag_button = '';
				};
	
				
				echo '<form id="membersMenuForAdmin">';
					echo '<input type="hidden" name="action" value="updateMenuRoleAfterAjax"/>';
					echo '<input style="'.$check_flag_button.'; position: absolute; margin-left: 885px; margin-top: -60px;" type="submit" id="updateusermembers" class="submit button members_mobile_hide" value="Записать">';
					echo '<table class="daily_report_table_for_members"  id="fixed_top_string">';
					echo '<thead>';
				echo '<tr style="background-color: #f6f6f6;">';
					
				    echo '<th style="width: 12%">&nbsp;ФИО&nbsp;</th>'; 
				    echo '<th style="width: 4%">&nbsp;Воз&nbsp;<br>&nbsp;раст&nbsp;</th>';
				    echo '<th>&nbsp;Рост&nbsp;</th>';
				    echo '<th>&nbsp;Вес&nbsp;</th>';
				    echo '<th>&nbsp;ГВ&nbsp;</th>';
				    echo '<th>&nbsp;Актив&nbsp;<br>&nbsp;ность&nbsp;</th>';
				    echo '<th class="members_mobile_hide" style="width: 7%">Расчет<br>(база)</th>';
				    echo '<th style="width: 7%">Расчет<br>(-15%)</th>';
				    echo '<th style="width: 5%;">&nbsp;Меню&nbsp;<br>&nbsp;до&nbsp;</th>';
				    echo '<th style="width: 7%">&nbsp;М / Ж&nbsp;</th>';
				    //echo '<th style="'.$check_flag_member_role.'">&nbsp;Меню&nbsp;</th>';
				    echo '<th style="width: 15%">&nbsp;Меню&nbsp;</th>';
				    echo '<th class="members_mobile_hide" style="width: 28%">&nbsp;Комментарий директора&nbsp;</th>';
				    echo '<th style="width: 3%;">&nbsp;<i class="fa fa-paper-plane-o" aria-hidden="true">&nbsp;</th>';
				   
			    echo '</tr>';
			    echo '</thead>';
			    
			    require_once ABSPATH . 'wp-admin/includes/user.php';
				require_once ABSPATH . 'wp-admin/includes/template.php';
			    global $current_user_id_for_inpit, $wpdb;
				wp_get_current_user();	
				$current_user_report = $current_user->ID;
				$this_month_report2 = $wpdb->get_results(
						"
						SELECT 
						orders.date AS order_date,
						orders.order_id AS order_id,
						users.ID AS user_id_check,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'telephone' limit 1) as telephone,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'first_name' limit 1) as first_name,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'last_name' limit 1) as last_name,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'men_menu_age' limit 1) as men_menu_age,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'men_menu_height' limit 1) as men_menu_height,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'men_menu_weight_at_start' limit 1) as men_menu_weight_at_start,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'men_menu_daily_activity' limit 1) as men_menu_daily_activity,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'women_menu_age' limit 1) as women_menu_age,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'women_menu_height' limit 1) as women_menu_height,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'women_menu_weight_at_start' limit 1) as women_menu_weight_at_start,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'women_menu_breastfeed' limit 1) as women_menu_breastfeed,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'women_menu_daily_activity' limit 1) as women_menu_daily_activity,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'men_menu_lk' limit 1) as men_menu_lk,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'women_menu_lk' limit 1) as women_menu_lk,
						orders.women_menu,
						orders.men_menu,
						orders.credit,
						orders.paid,
						orders.amount,
						orders.director_comment
						FROM wpux_orders orders, wpux_users users
						WHERE (DATE(orders.date) BETWEEN '$date_from' AND '$date_before')
						AND (orders.paid = 1 OR orders.credit = 1)
						AND (orders.men_menu != '' OR orders.women_menu != '')
						AND orders.user_email = users.user_email 
						ORDER BY orders.order_id DESC
						"
						);	
							if( $this_month_report2 ) {
						    foreach ( $this_month_report2 as $string_report2 ) {
								$current_menu_order_id_for_input = $string_report2->order_id;
								$current_user_id_for_input = $string_report2->user_id_check;
						        echo '<tr id="members_row_id_'.$current_menu_order_id_for_input.'">';
						        
						        echo '<td style="font-weight: 400;">';
								$name = $string_report2->first_name;
								$surname = $string_report2->last_name;
								$fio = $surname.' '.$name;
								echo '<span class="members" id="members_id_'.$current_user_id_for_input.'" style="cursor: pointer">'.$fio.'</span>';
						        echo '</td>'; 
						        
						        echo '<td>';
						        if  (!empty($string_report2->men_menu)) {
							    	echo $string_report2->men_menu_age;
						        } else if (!empty($string_report2->women_menu)) {
							    	echo $string_report2->women_menu_age;
							    };
						        echo '</td>';
						        
						        echo '<td>'; 
								if  (!empty($string_report2->men_menu)) {
							    	echo $string_report2->men_menu_height;
						        } else if (!empty($string_report2->women_menu)) {
							    	echo $string_report2->women_menu_height;
							    };
						        echo '</td>';
						        
						        echo '<td>'; 
						        if  (!empty($string_report2->men_menu)) {
							    	echo ($string_report2->men_menu_weight_at_start + 0);
						        } else if (!empty($string_report2->women_menu)) {
							    	echo $string_report2->women_menu_weight_at_start;
							    };
						        echo '</td>';
						        
						        if ($string_report2->women_menu_breastfeed == 'Да') {
							        $breastfeed_color = '#ddf7c8';
							    } else {
								    $breastfeed_color = 'white';
							    };
						        
						        echo '<td style="background-color: '.$breastfeed_color.'">&nbsp;'; 
						        if  (!empty($string_report2->men_menu)) {
							    	echo '-';
						        } else if (!empty($string_report2->women_menu)) {
							    	echo $string_report2->women_menu_breastfeed;
							    };
						        echo '&nbsp;</td>';
						        
						        echo '<td>'; 
						        if  (!empty($string_report2->men_menu)) {
							    	echo $string_report2->men_menu_daily_activity;
						        } else if (!empty($string_report2->women_menu)) {
							    	echo $string_report2->women_menu_daily_activity;
							    };
						        echo '</td>';
						        
						        $kcal_with_active_base = 0;
						        $kcal_with_active = 0;
						        if  (!empty($string_report2->men_menu)) {
							    	$weight_user =  ($string_report2->men_menu_weight_at_start + 0);
									$height_user =  $string_report2->men_menu_height;;
									$age_user =  $string_report2->men_menu_age;
									$daily_activity_user =  $string_report2->men_menu_daily_activity;
									if (($weight_user > 0) && ($height_user > 0) && ($age_user > 0) && ($daily_activity_user > 0)) {
								    $imt = round( $weight_user/($height_user * $height_user * 0.0001) );
								    if ($imt<26) {$pk=0;}
									if ($imt>=26 && $imt<30) {$pk=0.05;}
									if ($imt>=30 && $imt<35) {$pk=0.1;} 
									if ($imt>=35 && $imt<40) {$pk=0.15;} 
									if ($imt>=40) {$pk=0.2;}
									$kcal_without_active = round((65 + (13.7 * $weight_user) + (5 * $height_user) - (6.8 * $age_user)) - ( 65 + (13.7 * $weight_user) + (5 * $height_user)-(6.8 * $age_user)) * pk);
									$kcal_with_active_base = round($kcal_without_active * $daily_activity_user);
									$kcal_with_active = round($kcal_without_active * $daily_activity_user * 0.85);
								} else {
										$weight_user = 0;
										$weight_user = 0;
										$weight_user = 0;
										$daily_activity_user = 0;
										$kcal_without_active = 0;
										$kcal_with_active_base = 0;	
										};
						        } else if (!empty($string_report2->women_menu)) {
							    	$weight_user =  ($string_report2->women_menu_weight_at_start + 0);
									$height_user =  $string_report2->women_menu_height;;
									$age_user =  $string_report2->women_menu_age;
									$daily_activity_user =  $string_report2->women_menu_daily_activity;
									if (($weight_user > 0) && ($height_user > 0) && ($age_user > 0) && ($daily_activity_user > 0)) {
								    $imt = round( $weight_user/($height_user * $height_user * 0.0001) );
									if ($imt<26) {$pk=0;}
									if ($imt>=26 && $imt<30) {$pk=0.05;}
									if ($imt>=30 && $imt<35) {$pk=0.1;} 
									if ($imt>=35 && $imt<40) {$pk=0.15;} 
									if ($imt>=40) {$pk=0.2;}		
									$kcal_without_active = round((655 + (9.6 * $weight_user)+(1.8 * $height_user)-(4.7 * $age_user)) - (655 + (9.6 * $weight_user)+(1.8 * $height_user)-(4.7 * $age_user)) * $pk);
									$kcal_with_active_base = round($kcal_without_active * $daily_activity_user);
									$kcal_with_active = round($kcal_without_active * $daily_activity_user * 0.85);
								} else {
										$weight_user = 0;
										$weight_user = 0;
										$weight_user = 0;
										$daily_activity_user = 0;
										$kcal_without_active = 0;
										$kcal_with_active_base = 0;
										};		
							    };
						        
						        echo '<td class="members_mobile_hide">'; 
						        echo $kcal_with_active_base;
						        echo '</td>';
						        
						        echo '<td>'; 
						        echo $kcal_with_active;
						        echo '</td>';
						        
						        echo '<td>'; 
						        echo '-';
						        echo '</td>';
						        
						        echo '<td>'; 
						        if  (!empty($string_report2->men_menu)) {
							    	echo 'Муж.';
						        } else if (!empty($string_report2->women_menu)) {
							    	echo 'Жен.';
							    };
						        echo '</td>';
						        
						        echo '<td>'; //7.  М/Ж
						        if  (!empty($string_report2->men_menu)) {
							        $men_menu_value = $string_report2->men_menu_lk;
							        if ($men_menu_value == 'men_menu_1600') { $men_menu_selected1 = 'selected="selected"'; $men_menu_color = '#fec300';};
							        if ($men_menu_value == 'men_menu_1800') { $men_menu_selected2 = 'selected="selected"'; $men_menu_color = '#fec300';};
						      		if ($men_menu_value == 'men_menu_2000') { $men_menu_selected3 = 'selected="selected"'; $men_menu_color = '#fec300';};
									if ($men_menu_value == 'men_menu_2200') { $men_menu_selected4 = 'selected="selected"'; $men_menu_color = '#fec300';};
									if ($men_menu_value == 'men_menu_2500') { $men_menu_selected5 = 'selected="selected"'; $men_menu_color = '#fec300';};
									if ($men_menu_value == 'Нет' || $men_menu_value == '' || $men_menu_value == 'men_menu') { $men_menu_selectedNo = 'selected="selected"'; $men_menu_color = 'white';};
									echo '<select style="height: 26px; width: 100%; text-align-last: center; background-color: '.$men_menu_color.'" name="men_menu_id_'.$current_menu_order_id_for_input.'">';
									    echo '<option '.$men_menu_selectedNo.' value="Нет">Нет</option>';
									    echo '<option '.$men_menu_selected1.' value="men_menu_1600">Муж. 1600</option>';
									    echo '<option '.$men_menu_selected2.' value="men_menu_1800">Муж. 1800</option>';  
										echo '<option '.$men_menu_selected3.' value="men_menu_2000">Муж. 2000</option>'; 
										echo '<option '.$men_menu_selected4.' value="men_menu_2200">Муж. 2200</option>'; 
										echo '<option '.$men_menu_selected5.' value="men_menu_2500">Муж. 2500</option>';
									echo '</select>';
									$men_menu_selectedNo = '';
									$men_menu_selected1 = '';
								    $men_menu_selected2 = '';
								    $men_menu_selected3 = '';
								    $men_menu_selected4 = '';
								    $men_menu_selected5 = '';
						        } else if (!empty($string_report2->women_menu)) {
									$women_menu_value = $string_report2->women_menu_lk;
									if ($women_menu_value == 'women_menu_1200') { $women_menu_selected1 = 'selected="selected"'; $women_menu_color = '#fec300';};
									if ($women_menu_value == 'women_menu_1400') { $women_menu_selected2 = 'selected="selected"'; $women_menu_color = '#fec300';};
									if ($women_menu_value == 'women_menu_1600') { $women_menu_selected3 = 'selected="selected"'; $women_menu_color = '#fec300';};
									if ($women_menu_value == 'women_menu_1800') { $women_menu_selected4 = 'selected="selected"'; $women_menu_color = '#fec300';};
									if ($women_menu_value == 'women_menu_2000') { $women_menu_selected5 = 'selected="selected"'; $women_menu_color = '#fec300';};
									if ($women_menu_value == 'women_menu_2200') { $women_menu_selected6 = 'selected="selected"'; $women_menu_color = '#fec300';};
									if ($women_menu_value == 'Нет' || $women_menu_value == '' || $women_menu_value == 'women_menu') { $women_menu_selectedNo = 'selected="selected"'; $women_menu_color = 'white';};
									echo '<select style="height: 26px; width: 100%; text-align-last: center; background-color: '.$women_menu_color.'" name="women_menu_id_'.$current_menu_order_id_for_input.'">';
										echo '<option '.$women_menu_selectedNo.' value="Нет">Нет</option>'; 
										echo '<option '.$women_menu_selected1.' value="women_menu_1200">Жен. 1200</option>';
										echo '<option '.$women_menu_selected2.' value="women_menu_1400">Жен. 1400</option>'; 
										echo '<option '.$women_menu_selected3.' value="women_menu_1600">Жен. 1600</option>'; 
										echo '<option '.$women_menu_selected4.' value="women_menu_1800">Жен. 1800</option>'; 
										echo '<option '.$women_menu_selected5.' value="women_menu_2000">Жен. 2000</option>'; 
										echo '<option '.$women_menu_selected6.' value="women_menu_2200">Жен. 2200</option>';
									echo '</select>'; 
									$women_menu_selected1 = '';
								    $women_menu_selected2 = '';
								    $women_menu_selected3 = '';
								    $women_menu_selected4 = '';
								    $women_menu_selected5 = ''; 
								    $women_menu_selected6 = '';
								    $women_menu_selectedNo = '';  
							    };
						   
								echo '</td>';
						        					        
						        echo '<td class="members_mobile_hide">';
						        if ( (($period_now_month >= current_time('m')) && ($period_now_year >= current_time('Y'))) || ($period_now_year >= current_time('Y')) ) { //запрет редактирования прошлых периодов 
						        	echo '<input class="text-input" style="width: 100%; vertical-align: middle; height: 26px; background-color: '.$member_color.'; overflow: scroll;" name="director_menu_comment_id_'.$current_menu_order_id_for_input.'" type="text" value="'.$string_report2->director_comment.'" />'; 
						        } else {
							        echo $string_report2->director_comment;
						        };
						      
						        echo '<td>';
						        $whatsapp_number = $string_report2->telephone;
						        $phone= str_replace([' ', '(', ')', '-', '_'], '', $whatsapp_number);
								$phone = preg_replace('/^8/', '+7', $phone);
								$phone = preg_replace('/^7/', '+7', $phone);    
						        echo '<a href="https://api.whatsapp.com/send?phone='.$phone.'" target="_blank"><img style="width: 30px; padding-top:5px" src="http://maraphon.online/wp-content/uploads/whatsapp-icon-180×180.png"/></a>';	
						        echo '</td>';
						       
						        echo '</tr>';
						       
						        echo '<tr>';
						        
						        echo '<td colspan="16">'; 
						        echo '<div style="background-color: #f6f6f6;" class="formUserForAdmin" id="formUserForAdmin_'.$current_user_id_for_input.'"></div>';
						        echo '</td>'; 
						        
						        echo '</tr>';
							}
							}
		echo '<table style="opacity: 0; font-size: 5px">';
		echo '<tr><td>Hidden</td></td>';
		echo '</table>';					
							
		echo '<div id="success_form"><p style="padding-top: 10px; margin: 0;">Данные обновлены</p></div>';
		
		echo '<input type="hidden" name="action" value="updateMenuRoleAfterAjax"/>';
		echo '<input style="'.$check_flag_button.'" type="submit" id="updateusermembers" class="submit button" value="Записать">';
		echo '</div>';
		
	echo '</form>';  
	
	echo '<script type="text/javascript">'; 
		echo 'jQuery("#membersMenuForAdmin").submit(ajaxMenuRole);'; 
		echo 'function ajaxMenuRole(){'; 
			echo 'var memberMenuData = jQuery(this).serialize();'; 
			echo 'var choose_period_month = $("#choose_period_month").val();';
			echo 'var choose_period_year = $("#choose_period_year").val();';
			echo 'var periodNowAjaxMenu = (choose_period_month + "." + choose_period_year);';
			echo 'var memberMenuData = memberMenuData + "&periodNowAjaxData=" + periodNowAjaxMenu;'; 
			echo 'jQuery.ajax({'; 
				echo 'type:"POST",'; 
				echo 'url: "/wp-admin/admin-ajax.php",'; 
				echo 'data: memberMenuData,';
				echo 'success:function(data){'; 
				echo '$("#success_form").show();'; 
				echo 'setTimeout(function(){$("#success_form").fadeOut("slow")},1000);';
				echo '}'; 
			echo '});'; 
		echo 'return false;'; 
		echo '}'; 
		echo '</script>'; 	
													
	echo '<script type="text/javascript">';
	echo '$(function() {';
	    echo 'function showFormUserForAdmin(){';
	      echo 'var idMembers = this.id;';
	      echo 'idRightMembers = idMembers.substr(11);';
		  echo '$.ajaxSetup({cache: false});';
			echo 'jQuery.ajax({';
				echo 'type:"POST",';
				echo 'url: "/wp-admin/admin-ajax.php",';
				echo 'data: {action: "formMenuUserForAdmin",';
					  echo 'idRightMembers,';
				echo '},';
				echo 'success:function(data){';
				echo 'jQuery("#formUserForAdmin_" + idRightMembers).html(data);';
				echo '$("#members_row_id_" + idRightMembers).css("background-color", "#fec300");';
				echo '}';
			echo '});';
			echo 'return false;';
		echo '}';
	    echo '$(".members").click(showFormUserForAdmin);';
	echo '});';
	echo '</script>';
									
	echo '<script type="text/javascript">'; //закрытие анкеты пользователя по крестику
	echo '$(document).on("click", ".close_form_user_for_admin", function(event){';
		echo 'var idMembersClose = this.id;';
		echo 'var subidMembersClose = idMembersClose.substr(29);';
		echo '$("#formUserForAdmin_" + subidMembersClose).empty();';
		echo '$("#members_row_id_" + subidMembersClose).css("background-color", "white");';
	echo '});';
	echo '</script>';					
				
						
	echo '<div style="clear: both;"></div>';
	};	//окончание условия при выборе покупателей меню			
					
	die();
}
add_action('wp_ajax_choosePeriodForAdmin', 'choosePeriodForAdmin');
add_action('wp_ajax_nopriv_choosePeriodForAdmin', 'choosePeriodForAdmin');

// ----------- Обновление отчета "Участники" при выборе меню НОВЫЙ /director-cabinet ----------- // 

function updateMenuNewRoleAfterAjax(){
		global $wpdb, $current_user, $wp_roles;
		$period_now_ajax = $_POST['periodNowAjaxData'];
		$date_from = substr($period_now_ajax, -4).'-'.substr($period_now_ajax, 0, 2).'-01';
		$date_before = substr($period_now_ajax, -4).'-'.substr($period_now_ajax, 0, 2).'-31';

		$this_month_menu = $wpdb->get_results(
						"
						SELECT 
						orders_menu.date AS order_date,
						orders_menu.order_id AS order_id,
						users.ID AS user_id_check,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'telephone' limit 1) as telephone,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'first_name' limit 1) as first_name,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'last_name' limit 1) as last_name,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'men_menu_age' limit 1) as men_menu_age,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'men_menu_height' limit 1) as men_menu_height,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'men_menu_weight_at_start' limit 1) as men_menu_weight_at_start,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'men_menu_daily_activity' limit 1) as men_menu_daily_activity,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'women_menu_age' limit 1) as women_menu_age,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'women_menu_height' limit 1) as women_menu_height,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'women_menu_weight_at_start' limit 1) as women_menu_weight_at_start,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'women_menu_breastfeed' limit 1) as women_menu_breastfeed,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'women_menu_daily_activity' limit 1) as women_menu_daily_activity,
						orders_menu.content,
						orders_menu.kcal,
						orders_menu.credit,
						orders_menu.paid,
						orders_menu.amount,
						orders_menu.director_comment
						FROM wpux_orders_menu orders_menu, wpux_users users
						WHERE (DATE(orders_menu.date) BETWEEN '$date_from' AND '$date_before')
						AND (orders_menu.paid = 1 OR orders_menu.credit = 1)
						AND orders_menu.content != ''
						AND orders_menu.user_email = users.user_email 
						ORDER BY orders_menu.order_id DESC
						"
						);	
						
						if( $this_month_menu ) {
					    	foreach ( $this_month_menu as $string_report_data ) {
						    	
						    	$current_user_id_for_output = $string_report_data->user_id_check;
						    	$current_order_id_for_output = $string_report_data->order_id;

								$dataMenu1 = 'director_menu_comment_id_'.$current_order_id_for_output.'';
								$director_menu_comment = sanitize_text_field($_POST[$dataMenu1]);
								
								if (substr($string_report_data->content, 0, 2) == 'М') {
							    	$dataMenMenu = 'men_menu_id_'.$current_order_id_for_output.'';
									$current_men_menu = $_POST[$dataMenMenu];
									
									$wpdb->update(
										'wpux_orders_menu',
										array(
										'kcal' => $current_men_menu,
										'director_comment' => $director_menu_comment
										),
										array(
										'order_id' => $current_order_id_for_output
										)
										);

								} else if (substr($string_report_data->content, 0, 2) == 'Ж') {
							    	$dataWomenMenu = 'women_menu_id_'.$current_order_id_for_output.'';
									$current_women_menu = $_POST[$dataWomenMenu];
									
									$wpdb->update(
										'wpux_orders_menu',
										array(
										'kcal' => $current_women_menu,
										'director_comment' => $director_menu_comment
										),
										array(
										'order_id' => $current_order_id_for_output
										)
										);

								};  
							
		    				}; //Тело цикла
						}; //Тело первоначального условия	
							
		die();
		}
		add_action('wp_ajax_updateMenuNewRoleAfterAjax', 'updateMenuNewRoleAfterAjax');
		add_action('wp_ajax_nopriv_updateMenuNewRoleAfterAjax', 'updateMenuNewRoleAfterAjax');


// ----------- Обновление отчета "Участники" при выборе марафона /director-cabinet ----------- // 

function updateMembersRoleAfterAjax(){
		global $wpdb, $current_user, $wp_roles;
		$period_now_ajax = $_POST['periodNowAjaxData'];

		$this_month_role = $wpdb->get_results(
						"
						SELECT
						    orders.date AS order_date,
						    users.ID AS user_id_check,
						    orders.order_id AS order_id,
						    orders.user_id,
						    (select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'first_name' limit 1) as first_name,
						    (select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'last_name' limit 1) as last_name,
						    (select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'telephone' limit 1) as telephone,
						    (select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'age' limit 1) as age,
						    (select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'height' limit 1) as height,
						    (select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'weight-at-start' limit 1) as weight_at_start,
						    (select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'breastfeed' limit 1) as breastfeed,
						    (select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'daily-activity' limit 1) as daily_activity,
						    (select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'kcal_with_active' limit 1) as kcal_with_active,
						    (select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'maraphon_counter' limit 1) as maraphon_counter,
						    orders.kcal_now,
						    orders.class_now,
						    (select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'wpux_capabilities' limit 1) as role_color,
						    (select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'workout_class' limit 1) as workout_class,
						    orders.maraphon_member_month,
						    orders.credit,
						    orders.paid,
						    orders.curator,
						    orders.director_comment
						    FROM wpux_orders orders
						
						    LEFT JOIN wpux_users users
						    ON (
						    orders.user_email = users.user_email)
						    
						    WHERE orders.maraphon_member_month = '$period_now_ajax'
						    AND (orders.paid = '1' OR orders.credit = '1')
						    AND (orders.maraphon_next_month LIKE '%марафон%' OR orders.maraphon_next_month LIKE '%пакет%')
						    ORDER BY last_name
						"
						);	
						
						if( $this_month_role ) {
					    	foreach ( $this_month_role as $string_report_data ) {
						    	$current_user_id_for_output = $string_report_data->user_id_check;
						    	$current_order_id_for_output = $string_report_data->order_id;
								
								$dataRole1 = 'current_role_id_'.$current_user_id_for_output.'';
								$current_role = $_POST[$dataRole1];
								
						    	$dataRole2 = 'workout_class_id_'.$current_user_id_for_output.'';
								$workout_class = sanitize_text_field($_POST[$dataRole2]);
						    	
						    	$dataRole3 = 'curator_id_'.$current_user_id_for_output.'';
								$curator = sanitize_text_field($_POST[$dataRole3]);
						    	
								$dataRole4 = 'director_comment_id_'.$current_user_id_for_output.'';
								$director_comment = sanitize_text_field($_POST[$dataRole4]);
								
								$user_meta=get_userdata($current_user_id_for_output);
								$user_role = substr($user_meta->roles[0], -4, 4);
				
								$wpUser = get_userdata( $current_user_id_for_output );
						        $wpUser->set_role( $current_role );  
								
								if (isset($_POST[$dataRole2])){
									update_user_meta( $current_user_id_for_output, 'workout_class', $workout_class );
								};
								
								$wpdb->update(
									'wpux_orders',
									array( 
									'curator' => $curator
									),
									array(
									'order_id' => $current_order_id_for_output
									)
									);	
															
								$wpdb->update(
									'wpux_orders',
									array( 
									'director_comment' => $director_comment
									),
									array(
									'order_id' => $current_order_id_for_output
									)
									);	
								
								if ( (current_time('j') < 28) && ($user_role !== 'firm') ) {
									$wpdb->update(
										'wpux_orders',
											array( 
											'kcal_now' => $user_role
											),
											array(
											'order_id' => $current_order_id_for_output
											)
									);	
								};
								
								if ( (current_time('j') < 28) && ($user_role !== 'firm') ) {	
									$wpdb->update(
										'wpux_orders',
											array( 
											'class_now' => $workout_class
											),
											array(
											'order_id' => $current_order_id_for_output
											)
									);	
								};
		    				} //Тело цикла
						} //Тело первоначального условия	
							
		die();
		}
		add_action('wp_ajax_updateMembersRoleAfterAjax', 'updateMembersRoleAfterAjax');
		add_action('wp_ajax_nopriv_updateMembersRoleAfterAjax', 'updateMembersRoleAfterAjax');

// ----------- Обновление отчета "Участники" при выборе меню /director-cabinet ----------- // 

function updateMenuRoleAfterAjax(){
		global $wpdb, $current_user, $wp_roles;
		$period_now_ajax = $_POST['periodNowAjaxData'];
		$date_from = substr($period_now_ajax, -4).'-'.substr($period_now_ajax, 0, 2).'-01';
		$date_before = substr($period_now_ajax, -4).'-'.substr($period_now_ajax, 0, 2).'-31';

		$this_month_menu = $wpdb->get_results(
						"
						SELECT 
							orders.date AS order_date,
							orders.order_id AS order_id,
							users.ID AS user_id_check,
							(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'telephone' limit 1) as telephone,
							(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'first_name' limit 1) as first_name,
							(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'last_name' limit 1) as last_name,
							(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'men_menu_age' limit 1) as men_menu_age,
							(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'men_menu_height' limit 1) as men_menu_height,
							(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'men_menu_weight_at_start' limit 1) as men_menu_weight_at_start,
							(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'men_menu_daily_activity' limit 1) as men_menu_daily_activity,
							(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'women_menu_age' limit 1) as women_menu_age,
							(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'women_menu_height' limit 1) as women_menu_height,
							(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'women_menu_weight_at_start' limit 1) as women_menu_weight_at_start,
							(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'women_menu_breastfeed' limit 1) as women_menu_breastfeed,
							(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'women_menu_daily_activity' limit 1) as women_menu_daily_activity,
							(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'men_menu_lk' limit 1) as men_menu_lk,
							(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'women_menu_lk' limit 1) as women_menu_lk,
							orders.women_menu,
							orders.men_menu,
							orders.time,
							orders.credit,
							orders.paid,
							orders.amount,
							orders.director_comment
							FROM wpux_orders orders, wpux_users users
							WHERE (DATE(orders.date) BETWEEN '$date_from' AND '$date_before')
							AND (orders.paid = 1 OR orders.credit = 1)
							AND (orders.men_menu != '' OR orders.women_menu != '')
							AND orders.user_email = users.user_email 
							ORDER BY orders.order_id DESC
						"
						);	
						
						if( $this_month_menu ) {
					    	foreach ( $this_month_menu as $string_report_data ) {
						    	$current_user_id_for_output = $string_report_data->user_id_check;
						    	$current_order_id_for_output = $string_report_data->order_id;
						    	$user_time = $string_report_data->time;
								$time_access = time() + (60*60*24*30); 
								$dataMenu4 = 'director_menu_comment_id_'.$current_order_id_for_output.'';
								$director_menu_comment = sanitize_text_field($_POST[$dataMenu4]);
								
								if  (!empty($string_report_data->men_menu)) {
							    	$dataMenMenu = 'men_menu_id_'.$current_order_id_for_output.'';
									$current_men_menu = $_POST[$dataMenMenu];
									
									if ($current_men_menu == 'Нет') {
									update_user_meta( $current_user_id_for_output, 'men_menu_lk', 'Нет' );
									$wpdb->update(
										'wpux_orders',
										array( 
										'time' => 0,
										'director_comment' => $director_menu_comment
										),
										array(
										'order_id' => $current_order_id_for_output
										)
										);
									} else if ($user_time == 0) {
										update_user_meta( $current_user_id_for_output, 'men_menu_lk', $current_men_menu );
										$wpdb->update(
										'wpux_orders',
										array( 
										'time' => $time_access,
										'director_comment' => $director_menu_comment
										),
										array(
										'order_id' => $current_order_id_for_output
										)
										);
									} else {
										update_user_meta( $current_user_id_for_output, 'men_menu_lk', $current_men_menu );
										$wpdb->update(
										'wpux_orders',
										array( 
										'director_comment' => $director_menu_comment
										),
										array(
										'order_id' => $current_order_id_for_output
										)
										);
									}

								} else if (!empty($string_report_data->women_menu)) {
							    	$dataWomenMenu = 'women_menu_id_'.$current_order_id_for_output.'';
									$current_women_menu = $_POST[$dataWomenMenu];
									
								if ($current_women_menu == 'Нет') {
									update_user_meta( $current_user_id_for_output, 'women_menu_lk', 'Нет' );
									$wpdb->update(
										'wpux_orders',
										array( 
										'time' => 0,
										'director_comment' => $director_menu_comment
										),
										array(
										'order_id' => $current_order_id_for_output
										)
										);
									} else if ($user_time == 0) {
										update_user_meta( $current_user_id_for_output, 'women_menu_lk', $current_women_menu );
										$wpdb->update(
										'wpux_orders',
										array( 
										'time' => $time_access,
										'director_comment' => $director_menu_comment
										),
										array(
										'order_id' => $current_order_id_for_output
										)
										);
									} else {
										update_user_meta( $current_user_id_for_output, 'women_menu_lk', $current_women_menu );
										$wpdb->update(
										'wpux_orders',
										array( 
										'director_comment' => $director_menu_comment
										),
										array(
										'order_id' => $current_order_id_for_output
										)
										);
									}
								};
								
								$current_order_id_for_output = 0;
								$current_user_id_for_output = 0;
								$current_women_menu = '';
								$current_men_menu = '';
								$director_menu_comment = '';
							
		    				} //Тело цикла
						} //Тело первоначального условия	
							
		die();
		}
		add_action('wp_ajax_updateMenuRoleAfterAjax', 'updateMenuRoleAfterAjax');
		add_action('wp_ajax_nopriv_updateMenuRoleAfterAjax', 'updateMenuRoleAfterAjax');

// ----------- Вывод ежедневного отчета в отчете "Участники" /director-cabinet ----------- // 
function dailyReportForAdmin(){

						global $wpdb, $current_user_report, $current_month_report, $change_color;

						$maraphon_member_month_year = $_POST['periodNowAjaxDaily'];
						$maraphon_month = substr($maraphon_member_month_year, 0, 2);
						
						$maraphon_year = substr($maraphon_member_month_year, 3, 4);
						
						if (($maraphon_month - 1) == 0) {
							$maraphon_month_from = 12; $maraphon_year_from = $maraphon_year - 1;
						} else {
							$maraphon_month_from = ($maraphon_month - 1); $maraphon_year_from = $maraphon_year;
						};
						
						if ($maraphon_month_from < 10) {
							$maraphon_month_from = '0'.$maraphon_month_from;
						};
						
						$maraphon_month_before = $maraphon_month;
						$maraphon_year_before = $maraphon_year;
						
						$date_from = $maraphon_year_from.'-'.$maraphon_month_from.'-28';
						$date_before = $maraphon_year_before.'-'.$maraphon_month_before.'-31';
						
						echo '<table class="daily_report_table_for_admin">';
							$current_user_report = $_POST['idRight'];
							
							echo '<tr>';
									echo '<th colspan="2" style="width: 20%">';
									    echo 'История участника';
									echo '</th>';
									echo '<th colspan="5">';
										$history_comment = get_the_author_meta( 'history_comment', $current_user_report );
									    echo $history_comment;
									echo '</th>';
							echo '</tr>';
							
							echo '<tr>';
							    echo '<th>&nbsp;День&nbsp;</th>';
							    echo '<th>&nbsp;Активность&nbsp;</th>';
							    echo '<th>&nbsp;Алко.&nbsp;</th>';  
							    echo '<th>&nbsp;Мес.&nbsp;</th>';
							    echo '<th>&nbsp;Вес&nbsp;</th>';
							    echo '<th>Как прошел день</th>';
							    echo '<th>&nbsp;Комментарий&nbsp;</th>'; 
							echo '</tr>';
								
								$current_month_report = current_time ('n',0);
								$this_month_report1 = $wpdb->get_results( 
								"
								SELECT
								daily.user_id,
	                            daily.date,
	                            daily.activity,
	                            daily.alcohol,
	                            daily.cheatmeal,
	                            daily.failure,
	                            daily.snack,
	                            daily.task,
	                            daily.menstruation,
	                            daily.today_weight,
	                            daily.comment,
								orders.maraphon_member_month
								FROM wpux_orders orders, wpux_users users, wpux_daily_report daily
								WHERE (orders.paid = 1 OR orders.credit = 1)
	                            AND daily.user_id = $current_user_report 
	                       		AND (DATE(daily.date) BETWEEN '$date_from' AND '$date_before')
	                       		AND daily.user_id = users.ID
	                            AND orders.maraphon_member_month = $maraphon_member_month_year
							    AND orders.user_email = users.user_email
								AND (orders.maraphon_next_month LIKE '%марафон%' OR orders.maraphon_next_month LIKE '%пакет%')
								ORDER BY daily.date ASC
								"	
								);
								// вытаскиваем из базы данные по ID пользователя и текущему месяцу
								$_monthsListRus = array(
										"01"=>"января","02"=>"февраля","03"=>"марта",
										"04"=>"апреля","05"=>"мая", "06"=>"июня",
										"07"=>"июля","08"=>"августа","09"=>"сентября",
										"10"=>"октября","11"=>"ноября","12"=>"декабря");
								
								if( $this_month_report1 ) {
								    foreach ( $this_month_report1 as $string_report ) {

								        echo '<tr>';
								        
								        if ($string_report->cheatmeal == '1') {
									        $cheat_fail_color = '#dff1d9';
								        } else if ($string_report->failure == '1') {
									        $cheat_fail_color = '#f8d7da';
								        } else if ($string_report->snack == '1') {
									        $cheat_fail_color = '#fff3cd';
								        } else {
									        $cheat_fail_color = 'white';
								        };
								        							        
								        if ($string_report->alcohol == 'Нет' || $string_report->alcohol == 'нет' || $string_report->alcohol == '-') {
									        $alcohol_color = '#404040';
								        } else {
									        $alcohol_color = '#468df9';
								        };
								        
								        if ($string_report->menstruation == 'Есть') {
									        $menstruation_color = 'red';
								        } else {
									        $menstruation_color = '#404040';
								        }; 
								        
								        
								        
								        echo '<td style="background-color: '.$cheat_fail_color.'">';
								        $database_date =  $string_report->date;
								        $database_day = substr($database_date, 8);
								        $database_month = substr($database_date, 5, 2);
										$database_month_rus = $_monthsListRus[$database_month];
								        echo $database_day;
								        echo '</td>';
								        echo '<td style="background-color: '.$cheat_fail_color.'">'; 
								        echo $string_report->activity;
								        echo '</td>';
								        echo '<td style="background-color: '.$cheat_fail_color.'; color: '.$alcohol_color.'">';
								        echo $string_report->alcohol;
								        echo '</td>';
								        echo '<td style="background-color: '.$cheat_fail_color.'; color: '.$menstruation_color.'">'; 
								        echo $string_report->menstruation;
								        echo '</td>';
								        echo '<td style="background-color: '.$cheat_fail_color.'">';  
								        echo $string_report->today_weight;
								        echo '</td>';
										//Меняем цвет последнего комментария
								        $change_color = '#fec300';
								        if ($string_report->comment == 'Отчет на проверке') {
									        $change_color = 'white';
								        } else {
									        $change_color = '#fec300';
								        }
										
										echo '<td style="background-color: '.$cheat_fail_color.'">'; 
								        echo $string_report->task;
								        echo '</td>'; 
										
								        echo '<td style="background-color:'.$change_color.'">'; 
								        echo $string_report->comment; 
								        echo '</td>';
								       
					    				}
								}		 
					echo '</table>';		
die();
}
add_action('wp_ajax_dailyReportForAdmin', 'dailyReportForAdmin');
add_action('wp_ajax_nopriv_dailyReportForAdmin', 'dailyReportForAdmin');

// ----------- Вывод краткой анкеты для обработки покупателей меню в отчете "Участники" /director-cabinet ----------- // 
function formMenuUserForAdmin(){
			$current_user_report_members = $_POST['idRightMembers'];
						
			echo '<a class="close_form_user_for_admin" id="close_form_user_for_admin_id_'.$current_user_report_members.'" title="Закрыть"> x</a>';			
			
			echo '<div>';
			echo '<table class="formUserForAdmin_table" style="float: left; margin-top: 15px;">';
				echo '<tr>';
					echo '<th></th>';
					echo '<td class="formUserForAdmin_table_header"><i class="fa fa-mars" aria-hidden="true"></i>&nbsp;&nbsp;Параметры для мужского меню</td>';
				echo '</tr>';
				
				echo '<tr>';					
					echo '<th style="width: 230px">Есть ли проблемы со здоровьем?</th>';
					echo '<td><div class="formUserForAdmin_means">'.get_the_author_meta( 'men_menu_health_problems', $current_user_report_members ).'</div></td>';
				echo '</tr>';
				
				echo '<tr>';					
					echo '<th style="width: 230px">Какие диеты у вас были до сегодняшнего дня?</th>';
					echo '<td><div class="formUserForAdmin_means">'.get_the_author_meta( 'men_menu_diet', $current_user_report_members ).'</div></td>';
				echo '</tr>';
				
				echo '<tr>';					
					echo '<th>Физическая активность, тренировки?</th>';
					echo '<td><div class="formUserForAdmin_means">'.get_the_author_meta( 'men_menu_workout', $current_user_report_members ).'</div></td>';
				echo '</tr>';
				
				echo '<tr>';					
					echo '<th>Какой результат хотите достичь?</th>';
					echo '<td><div class="formUserForAdmin_means">'.get_the_author_meta( 'men_menu_what_result', $current_user_report_members ).'</div></td>';
				echo '</tr>';
				
			echo '</table>';   
			
			echo '<table class="formUserForAdmin_table" id="formUserForAdmin_food_workout" style="margin-top: 15px;">';
				echo '<tr>';
					echo '<td colspan="2" class="formUserForAdmin_table_header"><i class="fa fa-venus" aria-hidden="true"></i>&nbsp;&nbsp;Параметры для женского меню</td>';
				echo '</tr>';
				
				echo '<tr>';
					echo '<th style="width: 200px">Есть ли проблемы со здоровьем?</th>';
					echo '<td><div class="formUserForAdmin_means">'.get_the_author_meta( 'women_menu_health_problems', $current_user_report_members ).'</div></td>';
				echo '</tr>';
				
				echo '<tr>';					
					echo '<th style="width: 230px">Какие диеты у вас были до сегодняшнего дня?</th>';
					echo '<td><div class="formUserForAdmin_means">'.get_the_author_meta( 'women_menu_diet', $current_user_report_members ).'</div></td>';
				echo '</tr>';
				
				echo '<tr>';					
					echo '<th>Физическая активность, тренировки?</th>';
					echo '<td><div class="formUserForAdmin_means">'.get_the_author_meta( 'women_menu_workout', $current_user_report_members ).'</div></td>';
				echo '</tr>';
				
				echo '<tr>';
					echo '<th>Какой результат хотите достичь?</th>';
					echo '<td><div class="formUserForAdmin_means">'.get_the_author_meta( 'women_menu_what_result', $current_user_report_members ).'</div></td>';
				echo '</tr>';
			echo '</table>';    
			
			echo '<div style="clear: both !important"></div>';
			echo '</div>';	
			
die();
}
add_action('wp_ajax_formMenuUserForAdmin', 'formMenuUserForAdmin');
add_action('wp_ajax_nopriv_formMenuUserForAdmin', 'formMenuUserForAdmin');       

// ----------- Вывод полной анкеты участника в отчете "Участники" /director-cabinet ----------- // 
function formUserForAdmin(){
			global $wpdb;
			$current_user_report_members = $_POST['idRightMembers'];
			$full_report_members = $wpdb->get_results( 
			"
			SELECT 	
			monthly.user_id,
	        monthly.date,
			(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'first_name' limit 1) as first_name,
			(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'last_name' limit 1) as last_name,
	        monthly.weight,
	        monthly.breast,
	        monthly.waist,
	        monthly.stomach,
	        monthly.booty,
	        monthly.left_leg,
	        monthly.right_leg,
	        monthly.calf,
	        monthly.arm
	        FROM wpux_monthly_report monthly, wpux_users users
			WHERE monthly.user_id = '$current_user_report_members'
	        AND monthly.user_id = users.ID
	        ORDER BY monthly.date DESC limit 1
	        "
	        );
	        if( $full_report_members ) {
				foreach ( $full_report_members as $string_full_report ) {
				$full_report_date = $string_full_report->date;
				$full_report_date_day = substr($full_report_date, -2);
				$full_report_date_month = substr($full_report_date, 5, 2);
				$full_report_date_year = substr($full_report_date, 0, 4);
				$full_report_date = $full_report_date_day.'.'.$full_report_date_month.'.'.$full_report_date_year;
				
				$full_report_weight = $string_full_report->weight;
				$full_report_breast = $string_full_report->breast;
				$full_report_waist = $string_full_report->waist;
				$full_report_stomach = $string_full_report->stomach;
				$full_report_booty = $string_full_report->booty;
				$full_report_left_leg = $string_full_report->left_leg;
				$full_report_right_leg = $string_full_report->right_leg;
				$full_report_calf = $string_full_report->calf;
				$full_report_arm = $string_full_report->arm;	
				};
			};
	        
	        
	        
						
			echo '<a class="close_form_user_for_admin" id="close_form_user_for_admin_id_'.$current_user_report_members.'" title="Закрыть"> x</a>';
			
			echo '<div>';
				
			echo '<table class="formUserForAdmin_table" style="float: left; margin-top: 15px;">';
				echo '<tr>
						<th><strong>ID '.get_the_author_meta( 'ID', $current_user_report_members ).'</strong></th>
						<td class="formUserForAdmin_table_header"><i class="fa fa-venus"></i>&nbsp;&nbsp;&nbsp;Женская физиология</td>
					 </tr>';
				
				echo '<tr>';
					echo '<th>Роды, когда?</th>';
					echo '<td><div class="formUserForAdmin_means">'.get_the_author_meta( 'pregnant', $current_user_report_members ).'</div></td>';
				echo '</tr>';
				
				echo '<tr>';
					echo '<th>Первый день месячных</th>';
					echo '<td><div class="formUserForAdmin_means">'.get_the_author_meta( 'first_menstruation_day', $current_user_report_members ).'</div></td>';
				echo '</tr>';
				
				echo '<tr>';
					echo '<th style="width: 230px">Вес на 1 марафон</th>';
					echo '<td><div class="formUserForAdmin_means">'.get_the_author_meta( 'weight_at_1_maraphon', $current_user_report_members ).'</div></td>';
				echo '</tr>';
				
				echo '<tr>';
					echo '<th>Желаемый вес</th>';
					echo '<td><div class="formUserForAdmin_means">'.get_the_author_meta( 'dream-weight', $current_user_report_members ).'</div></td>';
				echo '</tr>';
			echo '</table>';    
			
			
			
			echo '<table class="formUserForAdmin_table" id="formUserForAdmin_parameters">';
				echo '<tr>';
					if ($full_report_date) {
					echo '<td colspan="4" class="formUserForAdmin_table_header"><i class="fa fa-check-square-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Замеры от '.$full_report_date.' (вес '.$full_report_weight.' кг)</td>';
					} else {
					echo '<td colspan="4" class="formUserForAdmin_table_header"><i class="fa fa-check-square-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Замеры не внесены</td>';	
					};
					
					
				echo '</tr>';
				
				echo '<tr>';					
					echo '<th style="width: 190px">Объем груди</th>';
					echo '<td style="width: 249px"><div class="formUserForAdmin_means" style="width: 96px; text-align: center;">'.round($full_report_breast, 1).'</div></td>';
					echo '<th style="width: 120px">Нога левая</th>';
					echo '<td><div class="formUserForAdmin_means" style="text-align: center;">'.round($full_report_left_leg, 1).'</div></td>';
				echo '</tr>';
				
				echo '<tr>';					
					echo '<th>Талия</th>';
					echo '<td><div class="formUserForAdmin_means" style="width: 96px; text-align: center;">'.round($full_report_waist, 1).'</div></td>';
					echo '<th style="width: 120px">Нога правая</th>';
					echo '<td><div class="formUserForAdmin_means"  style="text-align: center;">'.round($full_report_right_leg, 1).'</div></td>';
				echo '</tr>';
				
				echo '<tr>';		
					echo '<th>Живот</th>';
					echo '<td><div class="formUserForAdmin_means" style="width: 96px; text-align: center;">'.round($full_report_stomach, 1).'</div></td>';
					echo '<th style="width: 120px">Рука</th>';
					echo '<td><div class="formUserForAdmin_means" style="text-align: center;">'.round($full_report_arm, 1).'</div></td>';
				echo '</tr>';
				
				echo '<tr>';
					echo '<th>Объем ягодиц</th>';
					echo '<td><div class="formUserForAdmin_means" style="width: 96px; text-align: center;">'.round($full_report_booty, 1).'</div></td>';
					echo '<th style="width: 120px">Икра</th>';
					echo '<td><div class="formUserForAdmin_means" style="text-align: center;">'.round($full_report_calf, 1).'</div></td>';
				echo '</tr>';
			echo '</table>'; 
			echo '</div>';	
			
			echo '<div>';
			echo '<table class="formUserForAdmin_table" style="margin-top: -15px;">';
				echo '<tr>';
					echo '<th></th>';
					echo '<td class="formUserForAdmin_table_header"><i class="fa fa-thermometer-half" aria-hidden="true"></i>&nbsp;&nbsp;Здоровье</td>';
				echo '</tr>';
				
				echo '<tr>';					
					echo '<th style="width: 230px">Гормональная система</th>';
					echo '<td><div class="formUserForAdmin_means">'.get_the_author_meta( 'hormonal-background', $current_user_report_members ).'</div></td>';
				echo '</tr>';
				
				echo '<tr>';					
					echo '<th>Волосы</th>';
					echo '<td><div class="formUserForAdmin_means">'.get_the_author_meta( 'hair-problems', $current_user_report_members ).'</div></td>';
				echo '</tr>';
				
				echo '<tr>';			
					echo '<th>Кишечник</th>';
					echo '<td><div class="formUserForAdmin_means">'.get_the_author_meta( 'intestin_problems', $current_user_report_members ).'</div></td>';
				echo '</tr>';
				
				echo '<tr>';				
					echo '<th>Суставы, травмы</th>';
					echo '<td><div class="formUserForAdmin_means">'.get_the_author_meta( 'joint_problems', $current_user_report_members ).'</div></td>';
				echo '</tr>';
				
				echo '<tr>';				
					echo '<th>Диастаз</th>';
					echo '<td><div class="formUserForAdmin_means">'.get_the_author_meta( 'diastaz', $current_user_report_members ).'</div></td>';
				echo '</tr>';
				
				echo '<tr>';				
					echo '<th>Щитовидная железа</th>';
					echo '<td><div class="formUserForAdmin_means">'.get_the_author_meta( 'thyroid', $current_user_report_members ).'</div></td>';
				echo '</tr>';
				
				echo '<tr>';
					echo '<th>Лекарства</th>';
					echo '<td><div class="formUserForAdmin_means">'.get_the_author_meta( 'medicines', $current_user_report_members ).'</div></td>';
				echo '</tr>';
				
				echo '<tr>';					
					echo '<th>Противозачаточные</th>';
					echo '<td><div class="formUserForAdmin_means">'.get_the_author_meta( 'contraceptive', $current_user_report_members ).'</div></td>';
				echo '</tr>';
			echo '</table>';   
			
			echo '<table class="formUserForAdmin_table" id="formUserForAdmin_food_workout" style="margin-top: -15px;">';
				echo '<tr>';
					echo '<td colspan="2" class="formUserForAdmin_table_header"><i class="fa fa-trophy" aria-hidden="true"></i>&nbsp;&nbsp;Питание и тренировки</td>';
				echo '</tr>';
				
				echo '<tr>';
					echo '<th style="width: 200px">Витамины</th>';
					echo '<td><div class="formUserForAdmin_means">'.get_the_author_meta( 'vitamins', $current_user_report_members ).'</div></td>';
				echo '</tr>';
				
				echo '<tr>';
					echo '<th>Меню на день</th>';
					echo '<td><div class="formUserForAdmin_means">'.get_the_author_meta( 'day_menu', $current_user_report_members ).'</div></td>';
				echo '</tr>';
				
				echo '<tr>';					
					echo '<th>Пищевая аллергия</th>';
					echo '<td><div class="formUserForAdmin_means">'.get_the_author_meta( 'bad_food_for_you', $current_user_report_members ).'</div></td>';
				echo '</tr>';
				
				echo '<tr>';					
					echo '<th>Молочные продукты</th>';
					echo '<td><div class="formUserForAdmin_means">'.get_the_author_meta( 'milk_food', $current_user_report_members ).'</div></td>';				
				echo '</tr>';
				
				echo '<tr>';					
					echo '<th>Диеты до марафона</th>';
					echo '<td><div class="formUserForAdmin_means">'.get_the_author_meta( 'diet', $current_user_report_members ).'</div></td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Кардиотренажер</th>';
					echo '<td><div class="formUserForAdmin_means">'.get_the_author_meta( 'cardio', $current_user_report_members ).'</div></td>';
				echo '</tr>';
				
				echo '<tr>';
					echo '<th>Опыт тренировок</th>';
					echo '<td><div class="formUserForAdmin_means">'.get_the_author_meta( 'workout_experience', $current_user_report_members ).'</div></td>';
				echo '</tr>';
				
				echo '<tr>';
					echo '<th>Спорт последний раз</th>';
					echo '<td><div class="formUserForAdmin_means">'.get_the_author_meta( 'sport_last_time', $current_user_report_members ).'</div></td>';
				echo '</tr>';
				
				if (get_the_author_meta( 'date_report_create', $current_user_report_members )) {
				echo '<tr>';
					echo '<th>Заполнение анкеты</th>';
					echo '<td><div class="formUserForAdmin_means">Cоздание: '.get_the_author_meta( 'date_report_create', $current_user_report_members ).', обновление: '.get_the_author_meta( 'date_report_fill', $current_user_report_members ).'.</div></td>';
				echo '</tr>';
				};
			echo '</table>';    
			
			echo '<div style="clear: both !important"></div>';
			echo '</div>';	
			
die();
}
add_action('wp_ajax_formUserForAdmin', 'formUserForAdmin');
add_action('wp_ajax_nopriv_formUserForAdmin', 'formUserForAdmin');    

// ----------- Отправка ежедневного отчета /lk ----------- //
		function sendDailyReport(){
		
		global $wpdb;
			$current_user = wp_get_current_user();
			$user_id = $current_user->ID;
			$date_func = current_time ('Y-m-d',0);
			$activity_report = esc_attr(sanitize_text_field($_POST['activity_report']));
			$alcohol_report = esc_attr(sanitize_text_field($_POST['alcohol_report']));
			$snack = esc_attr($_POST['snack']);
			$cheatmeal = esc_attr($_POST['cheatmeal']);
			$failure = esc_attr($_POST['failure']);
			$task = esc_attr(sanitize_text_field($_POST['task_report']));
			$menstruation_report = esc_attr( $_POST['menstruation_report'] );
			$today_weight_report = esc_attr(sanitize_text_field($_POST['today_weight_report']));
			$today_weight_report = preg_replace('/-/', '', $today_weight_report);
		
			$check_daily_report = $wpdb->get_var( 
				"
				SELECT
				COUNT(*)
				FROM wpux_daily_report
				WHERE user_id = $user_id
	            AND DATE(date) = '$date_func'
				"	
				);
		if ( ($check_daily_report == 0) && ($user_id > 0) && (!empty($user_id)) ) {
			if($wpdb->insert('wpux_daily_report',array(
				'user_id' => $user_id,
				'date' => $date_func, 
				'activity' => $activity_report,
				'alcohol' => $alcohol_report,
				'snack' => $snack,
				'cheatmeal' => $cheatmeal,
				'failure' => $failure,
				'task' => $task,
				'menstruation' => $menstruation_report,
				'today_weight' => $today_weight_report,
				'comment' => 'Отчет на проверке'
			))===FALSE){
					echo '<div id="fail_daily_report_weight" style="margin-top: 40px; padding-top: 10px; font-size: 32px; width: 80%;"><p style="color: red;">Ошибка, отчет не был отправлен. Похоже проблемы с базой данных. Обратитесь к администратору сайта</p></div>';
				} else {
					echo '<table class="daily_report_table_for_user" id="daily_report_table_for_user_desktop">
						
							<tr>
							    <th>&nbsp;День&nbsp;</th>
							    <th>&nbsp;Активность&nbsp;</th>
							    <th>&nbsp;Алкоголь&nbsp;</th>  
							    <th>&nbsp;Месяч&nbsp;<br>ные&nbsp;</th>
							    <th>&nbsp;Вес&nbsp;</th>
							    <th>Как прошел ваш день</th>
							    <th>Комментарий по отчету</th>
						    </tr>';

								$current_user_report = $current_user->ID;
								$current_month = current_time ('n',0);
								$year_before = current_time('Y');
								$month_before = $current_month - 1;
								$notrowspan = 0;
								if ($month_before == '0') {
									$month_before = 12;
									$year_before = current_time('Y') - 1;
								};
								
								$current_month_report_start = $year_before.'-'.$month_before.'-28';
								$current_month_report_end = current_time ('Y-n',0).'-31';
								
								$this_month_report = $wpdb->get_results( 
								"
								SELECT *
								FROM wpux_daily_report
								WHERE user_id = $current_user_report
								AND (DATE(date) BETWEEN '$current_month_report_start' AND '$current_month_report_end')
								ORDER BY date
								"
								);
								$_monthsListRus = array(
										"01"=>"января","02"=>"февраля","03"=>"марта",
										"04"=>"апреля","05"=>"мая", "06"=>"июня",
										"07"=>"июля","08"=>"августа","09"=>"сентября",
										"10"=>"октября","11"=>"ноября","12"=>"декабря");
								if( $this_month_report ) {
								    foreach ( $this_month_report as $string_report ) {
								        echo '<tr>';
								        if ($string_report->cheatmeal == '1') {
									        $cheat_fail_color = '#dff1d9';
								        } else if ($string_report->failure == '1') {
									        $cheat_fail_color = '#f8d7da';
								        } else if ($string_report->snack == '1') {
									        $cheat_fail_color = '#fff3cd';
								        } else {
									        $cheat_fail_color = 'white';
								        };
								        echo '<td style="background-color: '.$cheat_fail_color.'">';
								        $database_date =  $string_report->date;
								        $database_day = substr($database_date, 8);
								        $database_month = substr($database_date, 5, 2);
										$database_month_rus = $_monthsListRus[$database_month];
								        echo $database_day;
								        echo '</td>';
								        echo '<td style="background-color: '.$cheat_fail_color.'">';
								        echo $string_report->activity;
								        echo '</td>';
								        if ($string_report->alcohol == 'Нет' || $string_report->alcohol == 'нет' || $string_report->alcohol == '-') {
									        $alcohol_color = '#404040';
								        } else {
									        $alcohol_color = '#468df9';
								        };
								        echo '<td style="background-color: '.$cheat_fail_color.'; color: '.$alcohol_color.'">'; 
								        echo $string_report->alcohol;
								        echo '</td>'; 
								        if ($string_report->menstruation == 'Есть') {
									        $menstruation_color = 'red';
								        } else {
									        $menstruation_color = '#404040';
								        };
								        echo '<td style="color: '.$menstruation_color.'; background-color: '.$cheat_fail_color.'">'; 
								        echo $string_report->menstruation;
								        echo '</td>';
								        echo '<td style="background-color: '.$cheat_fail_color.'">';  
								        echo $string_report->today_weight;
								        echo '</td>';
										//Меняем цвет последнего комментария
								        $change_color = '#fec300';
								        if ($string_report->comment == 'Отчет на проверке') {
									        $change_color = 'white';
								        } else {
									        $change_color = '#fec300';
								        }
								        echo '<td style="background-color: '.$cheat_fail_color.'">';  
								        echo '&nbsp;'.$string_report->task.'&nbsp';
								        echo '</td>';
								        
								        echo '<td style="background-color:'.$change_color.'">';
									        	echo $string_report->comment;
										echo '</td>';
										echo '</tr>';
					    			};
								};
						echo '</table>';
					if (current_time('m-d') == '12-31') {
					echo '<div id="success_daily_report">Мои хорошие, я поздравляю вас с новым 2021 годом и давайте сегодня отдохнем от отчетов :)<br> С наступающим! </div>';
					} else {
					echo '<div id="success_daily_report">Отчет отправлен на проверку. В течение 2 дней (для новичков) и 4 дней (для профи) я проверю отчет и оставлю комментарий.<br> В случае необходимости я свяжусь с вами в Whatsapp.</div>';
					};
				}
		} else {
			echo '<div id="fail_daily_report_weight" style="margin-top: 40px; padding-top: 10px; font-size: 32px; width: 80%;"><p style="color: red;">Отчет не был отправлен. У вас плохое соединение с интернетом либо вы не зашли на сайт</p></div>';
		};
		die();
		}
		add_action('wp_ajax_sendDailyReport', 'sendDailyReport');
		add_action('wp_ajax_nopriv_sendDailyReport', 'sendDailyReport');

// ----------- Открытие формы для редактирования отчета при нажатии на кнопку /lk ----------- 
function showDailyReportFormEdit(){
					global $wpdb;
					$current_user_edit = wp_get_current_user();
					$user_id_edit = $current_user_edit->ID;
					if (current_time("j") == 1) {
						$readonly_edit = '';
					} else {
						$readonly_edit = 'readonly';
					}
					$this_month_report_edit = $wpdb->get_results( 
								"
								SELECT *
								FROM wpux_daily_report daily
								WHERE user_id = $user_id_edit
								AND daily.date =
								(
								SELECT MAX(DATE)
								FROM wpux_daily_report B
								WHERE daily.user_id = B.user_id
								)
								"
								);
								
					if( $this_month_report_edit ) {
								    foreach ( $this_month_report_edit as $string_report_edit ) {
									$date_edit = $string_report_edit->date;
									$day_edit = substr($date_edit, -2);
									$month_edit = substr($date_edit, 5, 2);
									$year_edit = substr($date_edit, 0, 4);
									$today_weight_edit = $string_report_edit->today_weight;
									$menstruation_edit = $string_report_edit->menstruation;
									$activity_edit = $string_report_edit->activity;
									$alcohol_edit = $string_report_edit->alcohol;
									$snack_edit = $string_report_edit->snack;
									$cheatmeal_edit =  $string_report_edit->cheatmeal;
									$failure_edit = $string_report_edit->failure;
									$task_edit = $string_report_edit->task;
									}
							};
								echo '<form type="post" action="" style="display: block" id="dailyReportFormEdit">
								<div class="confirm_form_block">   
									<table class="daily_report_confirmation" id="edit_table">
									<h1 id="daily_report_for_user_h1">Отредактируйте ваши данные: </h1>';
								echo '
								<tr>
									<th colspan="2" class="date_report_label"><label for="date_report">Дата отчета</label></th>
									<th></th>
								</tr>
								
								<tr>
									<td>
					                   <input class="text-input" id="date_report" name="date_report_day" type="number" step="1" value="'.$day_edit.'" />
					                </td>
					                <td>
					                	<input class="text-input" '.$readonly_edit.' id="date_report" name="date_report_month" type="number" step="1" value="'.$month_edit.'" />
					                </td>
					                 <td>
					                 	<input class="text-input" readonly id="date_report" name="date_report_year" type="number" step="1" value="'.$year_edit.'" />
					                </td>
								</tr>
								</table>
								
								<table class="daily_report_confirmation">
								
								<tr> 
									<th colspan="2" class="weight_th"><label for="today_weight_report">Вес сегодня утром, кг</label></th>
									<th><label style="text-align: left;" for="menstruation_report" id="label_today_weight_report">Месячные сегодня</label></th>
								</tr>
		
								<tr>
				                    <td>
					                   <input class="text-input" id="today_weight_report" name="today_weight_report" type="number" step="0.001" value="'.$today_weight_edit.'" />
					                </td>
					                <td class="mobile_report_fix"></td>
					                <td>
						                <select  id="menstruation_report" class="select-width" style = "background-color: #fafafa; border: 1px solid red" name="menstruation_report">';
						                		if ($menstruation_edit == 'Нет') {
							                		echo '<option class="select-width" selected value = "Нет">Нет</option>
													<option class="select-width" value = "Есть">Есть</option>';
						                		} else if ($menstruation_edit == 'Есть'){
							                		echo '<option class="select-width" value = "Нет">Нет</option>
													<option class="select-width" selected value = "Есть">Есть</option>';
						                		};		
					                echo '</select>    

					                </td>
								</tr>
								
								<tr> 
									<th colspan="3"><label for="activity_report">Активность вчера</label></th>
								</tr>
								<tr> 
				                    <td colspan="3"><input class="text-input" name="activity_report" type="text" value="'.$activity_edit.'" /></td>
								</tr>

								<tr> 
									<th colspan="3"><label for="alcohol_report">Алкоголь вчера</label></th>
								</tr>
								
								</table>
								
								<table class="daily_report_confirmation" style="border: 1px solid #cbcbcb; border-radius: 3px; margin-top: -23px;">
								
								<tr class="daily_report_alcohol_checkbox">';
									if ($alcohol_edit == 'Нет') {
										echo '<td><input style="height: 15px; width: 15px !important;" type="checkbox" id="alcohol_yes_edit" name="alcohol_yes" value="1"></td>
									<td><input style="height: 15px; width: 15px !important;" type="checkbox" checked id="alcohol_no_edit" name="alcohol_no" value="1"></td>';
									} else {
										echo '<td><input style="height: 15px; width: 15px !important;" type="checkbox" checked id="alcohol_yes_edit" name="alcohol_yes" value="1"></td>
									<td><input style="height: 15px; width: 15px !important;" type="checkbox" id="alcohol_no_edit" name="alcohol_no" value="1"></td>';
									};
									
								echo '<td></td>
								</tr>
								
								<tr style="height: 40px;">
									<th style="width: 50%; color: #468df9;"><label for="alcohol_yes" id="alcohol_yes_label">Да</label></th>
									<th style="width: 50%; color: #468df9;"><label for="alcohol_no" id="alcohol_no_label">Нет</label></th>
									<th style="width: 50%;"></th>
								</tr> 
								
								<tr class="alcohol_type" style="opacity: 100%">
				                    <td colspan="3"><input class="text-input" class="alcohol_type" style="opacity: 100%" id="alcohol_report_edit" name="alcohol_report" type="text" value="'.$alcohol_edit.'" /></td>
								</tr>
								
								</table>';
								
								echo "<script src='http://maraphon.online/wp-content/themes/maraphon/js/jquery-1.9.1.min.js'></script>
								<script>
									$('.daily_report_alcohol_checkbox input:checkbox').click(function(){
									  if ($(this).is(':checked')) {
									     $('.daily_report_alcohol_checkbox input:checkbox').not(this).prop('checked', false);
									  }
									});

									$('#alcohol_yes_edit').click(function(){
									  if ($(this).is(':checked')) {
									     $('#alcohol_report_edit').val('');
									     $('#alcohol_report_edit').attr('placeholder', 'Какой алкоголь был вчера и сколько?');
									  } else {
										 $('#alcohol_report_edit').val('');
									     $('#alcohol_report_edit').attr('placeholder', ''); 
									  }
									});
									
									
									$('#alcohol_no_edit').click(function(){
									  if ($(this).is(':checked')) {
									     $('#alcohol_report_edit').val('Нет');
									  } else {
										 $('#alcohol_report_edit').val('');
									     $('#alcohol_report_edit').attr('placeholder', '');  
									  }
									});    
								</script>";
								
								if ($snack_edit == 1) {$checked_snack = 'checked';};
								if ($cheatmeal_edit == 1) {$checked_cheatmeal = 'checked';};
								if ($failure_edit == 1) {$checked_failure = 'checked';};
								
								echo '<table class="daily_report_confirmation" style="margin-top: -20px;">
								<tr class="daily_report_checkbox">
									<td><input style="height: 15px; width: 15px !important; margin-left: 45%;" type="checkbox" '.$checked_snack.' id="snack" name="snack" value="1"></td>
									<td><input style="height: 15px; width: 15px !important; margin-left: 42%;" type="checkbox" '.$checked_cheatmeal.' id="cheatmeal" name="cheatmeal" value="1"></td>
				                    <td><input style="height: 15px; width: 15px !important; margin-left: 46%;" type="checkbox" '.$checked_failure.' id="failure" name="failure" value="1"></td>
								</tr>  
								
								<script>
									$(".daily_report_checkbox input:checkbox").click(function(){
									  if ($(this).is(":checked")) {
									     $(".daily_report_checkbox input:checkbox").not(this).prop("checked", false);
									  }
									});
								</script>
								
								<tr style="height: 40px;">
									<th style="text-align: center; width: 45%; color: #fec300;"><label for="snack" id="snack_label">Перекус<br>раз в неделю</label></th>
									<th style="text-align: center; width: 50%; color: green;"><label for="cheatmeal" id="cheatmeal_label">Читмил</label></th>
									<th style="text-align: center; width: 50%; color: red;"><label for="failure" id="failure_label">Срыв</label></th>
								</tr>  
									
								<tr>
									<th colspan="3"><label for="task_report">Как прошел ваш день вчера?</label></th>
								</tr>
									
								<tr>
									<td colspan="3"><textarea class="select-width" id="what_your_day_edit" name="task_report" rows="5" cols="1" maxlength="255">'.$task_edit.'</textarea></td>	
								</tr>
								
								<tr>
									<td colspan="3">
										<p id="typeCharsEdit">Введено символов: '.round((strlen($task_edit)/2), 0).'/255</p>
									</td>
								</tr>
								
								<script type="text/javascript"> 
								 function limitCharsEdit(myObjectEdit, max, typeChars, leftChars){
								 $(myObjectEdit).keyup(function(){
								 var count = $(this).val().length;
								 $(typeChars).text("Введено символов: " + count + "/255");
								  });
								 }
								 
								 $(document).ready(function(){
								 var myObject = "#what_your_day_edit";
								 var max = 254; 
								 var typeChars = "#typeCharsEdit";
								 limitChars(myObject, max, typeChars);
								});
								</script>
							</table>
							
							<p class="daily_report_submit" >
							<input type="hidden" name="action" value="editDailyReport"/>
							<input type="submit" id="daily_report_submit" class="submit button" value="Исправить отчет">
							</p>
							<p style="text-align: center; margin-top: -20px;">Нажимая на кнопку, вы даете согласие на обработку своих персональных данных и соглашаетесь с <a href="http://maraphon.online/privacy-policy/" target="_blank">политикой конфиденциальности</a></p>
						</div>
						<div class="clearfloat"></div>
					</form>';
					
					echo'
					
					<script type="text/javascript">

					jQuery("#dailyReportFormEdit").submit(ajaxSubmitEdit);
					
					function ajaxSubmitEdit(){
					var dailyReportFormEdit = jQuery(this).serialize();
					var time = new Date;
					var day_now_edit = time.getDate();
					var month_now_edit = time.getMonth() + 1;
					var date_report_day_edit = $("input[name=\"date_report_day\"]").val();
					var date_report_month_edit = $("input[name=\"date_report_month\"]").val();
					var activity_report_edit = $("input[name=\"activity_report\"]").val();
					var alcohol_yes_edit = $("#alcohol_yes_edit").is(":checked");
					var alcohol_no_edit = $("#alcohol_no_edit").is(":checked");
					var alcohol_report_edit = $("input[name=\"alcohol_report\"]").val();
					var task_report_edit = $("textarea[name=\"task_report\"]").val();
					var menstruation_report_edit = $("select[name=\"menstruation_report\"]").val();
					var today_weight_report_edit = $("input[name=\"today_weight_report\"]").val();
					
					if ( (date_report_day_edit > day_now_edit) || ((date_report_day_edit > day_now_edit) && (date_report_month_edit < month_now_edit)) ) {
						$("#fail_daily_report_date").show();
						setTimeout(function(){$("#fail_daily_report_date").fadeOut("slow")},1000);
					} else if ( (today_weight_report_edit > 200) || (today_weight_report_edit == "0,0") || (today_weight_report_edit == "0.0") || (today_weight_report_edit < 0)) {
						$("#fail_daily_report_weight").show();
						setTimeout(function(){$("#fail_daily_report_weight").fadeOut("slow")},1000);
					} else if ( ( (alcohol_yes_edit == false) && (alcohol_no_edit == false) ) || ( (alcohol_yes_edit == true) && (alcohol_report_edit == "") ) ) {
						$("#fail_daily_report_alcohol").show();
						setTimeout(function(){$("#fail_daily_report_alcohol").fadeOut("slow")},1000);
					} else 	{
							$.ajaxSetup({cache: false});
						if ( activity_report_edit && task_report_edit && menstruation_report_edit && today_weight_report_edit ) {
						$.ajax({
									type:"POST",
									url: "/wp-admin/admin-ajax.php",
									data: dailyReportFormEdit,
									success:function(data){
									$("#dailyReportFormEdit").remove();
									$("#daily_report_text_block_edit").remove();
									$(".daily_report_table_for_user_div").empty();
									$(".daily_report_table_for_user_div").html(data);
									$("#lk_edit_daily_report").hide();
									}
							});
							} else
							{
							$("#daily_report_submit").disabled;
							$("#fail_daily_report").show();
							setTimeout(function(){$("#fail_daily_report").fadeOut("slow")},1000);
							return false;
							}
					};
						
					return false;
					}
	
						
					
					
					</script>

					';
		die();
		}
add_action('wp_ajax_showDailyReportFormEdit', 'showDailyReportFormEdit');
add_action('wp_ajax_nopriv_showDailyReportFormEdit', 'showDailyReportFormEdit');

// ----------- Отправка исправленного ежедневного отчета /lk ----------- //
		function editDailyReport(){
		global $wpdb;
			$current_user = wp_get_current_user();
			$user_id = $current_user->ID;
			$date_edit_day = esc_attr($_POST['date_report_day']);
			if ($date_edit_day < 10) {
				$date_edit_day = substr($date_edit_day, -1);
				$date_edit_day = '0'.$date_edit_day;
			};
			$date_edit_month = esc_attr($_POST['date_report_month']);
			$date_edit_year = esc_attr($_POST['date_report_year']);
			$date_edit = $date_edit_year.'-'.$date_edit_month.'-'.$date_edit_day.'';
			$activity_report = esc_attr(sanitize_text_field($_POST['activity_report']));
			$alcohol_report = esc_attr(sanitize_text_field($_POST['alcohol_report']));
			$snack = esc_attr($_POST['snack']);
			$cheatmeal = esc_attr($_POST['cheatmeal']);
			$failure = esc_attr($_POST['failure']);
			$task = esc_attr(sanitize_text_field($_POST['task_report']));
			$menstruation_report = esc_attr( $_POST['menstruation_report'] );
			$today_weight_report = esc_attr(sanitize_text_field($_POST['today_weight_report']));
			$today_weight_report = preg_replace('/-/', '', $today_weight_report);
			
			$last_report_id = $wpdb->get_var(
				"
				SELECT daily.report_id
								FROM wpux_daily_report daily
								WHERE user_id = $user_id
								AND daily.date =
								(
								SELECT MAX(DATE)
								FROM wpux_daily_report B
								WHERE daily.user_id = B.user_id
								)
				"
				);
			
			$check_daily_report = $wpdb->get_var( 
				"
				SELECT
				COUNT(*)
				FROM wpux_daily_report
				WHERE user_id = $user_id
	            AND DATE(date) = '$date_func'
				"	
				);
				
		if ( ($check_daily_report == 0) && ($user_id > 0) && (!empty($user_id)) ) {
			if($wpdb->update('wpux_daily_report',array(
				'user_id' => $user_id,
				'date' => $date_edit,
				'activity' => $activity_report,
				'alcohol' => $alcohol_report,
				'snack' => $snack,
				'cheatmeal' => $cheatmeal,
				'failure' => $failure,
				'task' => $task,
				'menstruation' => $menstruation_report,
				'today_weight' => $today_weight_report,
				'comment' => 'Отчет на проверке'
			),
			array(
				'report_id' => $last_report_id
			)
			
			
			)===FALSE){
					echo '<div id="fail_daily_report_weight" style="margin-top: 40px; padding-top: 10px; font-size: 32px; width: 80%;"><p style="color: red;">Ошибка, отчет не был отправлен. Похоже проблемы с базой данных. Обратитесь к администратору сайта</p></div>';
				} else {
					echo '<table class="daily_report_table_for_user" id="daily_report_table_for_user_desktop">
						
							<tr>
							    <th>&nbsp;День&nbsp;</th>
							    <th>&nbsp;Активность&nbsp;</th>
							    <th>&nbsp;Алкоголь&nbsp;</th>  
							    <th>&nbsp;Месяч&nbsp;<br>ные&nbsp;</th>
							    <th>&nbsp;Вес&nbsp;</th>
							    <th>Как прошел ваш день</th>
							    <th>Комментарий по отчету</th>
						    </tr>';

								$current_user_report = $current_user->ID;
								$current_month = current_time ('n',0);
								$year_before = current_time('Y');
								$month_before = $current_month - 1;
								$notrowspan = 0;
								if ($month_before == '0') {
									$month_before = 12;
									$year_before = current_time('Y') - 1;
								};
								
								$current_month_report_start = $year_before.'-'.$month_before.'-28';
								$current_month_report_end = current_time ('Y-n',0).'-31';
								
								$this_month_report = $wpdb->get_results( 
								"
								SELECT *
								FROM wpux_daily_report
								WHERE user_id = $current_user_report
								AND (DATE(date) BETWEEN '$current_month_report_start' AND '$current_month_report_end')
								ORDER BY date
								"
								);
								$_monthsListRus = array(
										"01"=>"января","02"=>"февраля","03"=>"марта",
										"04"=>"апреля","05"=>"мая", "06"=>"июня",
										"07"=>"июля","08"=>"августа","09"=>"сентября",
										"10"=>"октября","11"=>"ноября","12"=>"декабря");
								if( $this_month_report ) {
								    foreach ( $this_month_report as $string_report ) {
								        echo '<tr>';
								        if ($string_report->cheatmeal == '1') {
									        $cheat_fail_color = '#dff1d9';
								        } else if ($string_report->failure == '1') {
									        $cheat_fail_color = '#f8d7da';
								        } else if ($string_report->snack == '1') {
									        $cheat_fail_color = '#fff3cd';
								        } else {
									        $cheat_fail_color = 'white';
								        };
								        echo '<td style="background-color: '.$cheat_fail_color.'">';
								        $database_date =  $string_report->date;
								        $database_day = substr($database_date, 8);
								        $database_month = substr($database_date, 5, 2);
										$database_month_rus = $_monthsListRus[$database_month];
								        echo $database_day;
								        echo '</td>';
								        echo '<td style="background-color: '.$cheat_fail_color.'">';
								        echo $string_report->activity;
								        echo '</td>';
								        if ($string_report->alcohol == 'Нет' || $string_report->alcohol == 'нет' || $string_report->alcohol == '-') {
									        $alcohol_color = '#404040';
								        } else {
									        $alcohol_color = '#468df9';
								        };
								        echo '<td style="background-color: '.$cheat_fail_color.'; color: '.$alcohol_color.'">'; 
								        echo $string_report->alcohol;
								        echo '</td>'; 
								        if ($string_report->menstruation == 'Есть') {
									        $menstruation_color = 'red';
								        } else {
									        $menstruation_color = '#404040';
								        };
								        echo '<td style="color: '.$menstruation_color.'; background-color: '.$cheat_fail_color.'">'; 
								        echo $string_report->menstruation;
								        echo '</td>';
								        echo '<td style="background-color: '.$cheat_fail_color.'">';  
								        echo $string_report->today_weight;
								        echo '</td>';
										//Меняем цвет последнего комментария
								        $change_color = '#fec300';
								        if ($string_report->comment == 'Отчет на проверке') {
									        $change_color = 'white';
								        } else {
									        $change_color = '#fec300';
								        }
								        echo '<td style="background-color: '.$cheat_fail_color.'">';  
								        echo '&nbsp;'.$string_report->task.'&nbsp';
								        echo '</td>';
								        
								        echo '<td rowspan="1" style="background-color:'.$change_color.'">';
									        echo $string_report->comment;
										echo '</td>';
										echo '</tr>';
					    			};
								};
						echo '</table>';
					if (current_time('m-d') == '12-31') {
					echo '<div id="success_daily_report">Мои хорошие, я поздравляю вас с наступающим новым годом и давайте сегодня отдохнем от отчетов :)<br> Я получила отчет и обязательно его проверю, но не в этом году. С наступающим! </div>';
					} else {
					echo '<div id="success_daily_report">Отчет исправлен и отправлен на проверку.</div>';
					};
				}
		} else {
			echo '<div id="fail_daily_report_weight" style="margin-top: 40px; padding-top: 10px; font-size: 32px; width: 80%;"><p style="color: red;">Отчет не был отправлен. У вас плохое соединение с интернетом либо вы не зашли на сайт</p></div>';
		}; 
		die();
		}
		add_action('wp_ajax_editDailyReport', 'editDailyReport');
		add_action('wp_ajax_nopriv_editDailyReport', 'editDailyReport');

// ----------- Обновление анкеты пользователя /lk#tab4 ----------- //
		function updateUserForm(){
		global $wpdb, $current_user, $wp_roles, $kcal_with_active;
		wp_get_current_user();
		
	if ( !empty( $_POST['email'] ) )
	    wp_update_user( array ('ID' => $current_user->ID, 'user_email' => esc_attr( $_POST['email'] )));
    if ( !empty( $_POST['first-name'] ) )
        update_user_meta( $current_user->ID, 'first_name', esc_attr( $_POST['first-name'] ) );
    if ( !empty( $_POST['last-name'] ) )
        update_user_meta($current_user->ID, 'last_name', esc_attr( $_POST['last-name'] ) );
    if ( !empty( $_POST['what_you_know'] ) )
        update_user_meta( $current_user->ID, 'what_you_know', esc_attr( $_POST['what_you_know'] ) );
    if ( !empty( $_POST['telephone'] ) )
        update_user_meta( $current_user->ID, 'telephone', esc_attr( $_POST['telephone'] ) );
    if ( !empty( $_POST['town'] ) )
        update_user_meta( $current_user->ID, 'town', esc_attr( $_POST['town'] ) );    
    if ( !empty( $_POST['age'] ) )
        update_user_meta( $current_user->ID, 'age', esc_attr( $_POST['age'] ) );
    if ( !empty( $_POST['height'] ) )
        update_user_meta( $current_user->ID, 'height', esc_attr( $_POST['height'] ) );
    if ( !empty( $_POST['first_menstruation_day'] ) )
        update_user_meta( $current_user->ID, 'first_menstruation_day', esc_attr( $_POST['first_menstruation_day'] ) );  
    if ( !empty( $_POST['breastfeed'] ) )
        update_user_meta( $current_user->ID, 'breastfeed', esc_attr( $_POST['breastfeed'] ) );  
    if ( !empty( $_POST['pregnant'] ) )
        update_user_meta( $current_user->ID, 'pregnant', esc_attr( $_POST['pregnant'] ) ); 
    if ( !empty( $_POST['weight_at_1_maraphon'] ) )
        update_user_meta( $current_user->ID, 'weight_at_1_maraphon', esc_attr( $_POST['weight_at_1_maraphon'] ) );    
    if ( !empty( $_POST['weight-at-start'] ) )
        update_user_meta( $current_user->ID, 'weight-at-start', esc_attr( $_POST['weight-at-start'] ) );  
    if ( !empty( $_POST['dream-weight'] ) )
        update_user_meta( $current_user->ID, 'dream-weight', esc_attr( $_POST['dream-weight'] ) );  
    if ( !empty( $_POST['daily-activity'] ) )
    	update_user_meta( $current_user->ID, 'daily-activity', esc_attr( $_POST['daily-activity'] ) ); 
    if ( !empty( $_POST['hormonal-background'] ) )
        update_user_meta( $current_user->ID, 'hormonal-background', esc_attr( $_POST['hormonal-background'] ) );
    if ( !empty( $_POST['hair-problems'] ) )
        update_user_meta( $current_user->ID, 'hair-problems', esc_attr( $_POST['hair-problems'] ) );
    if ( !empty( $_POST['intestin_problems'] ) )
        update_user_meta( $current_user->ID, 'intestin_problems', esc_attr( $_POST['intestin_problems'] ) );
	if ( !empty( $_POST['joint_problems'] ) )
        update_user_meta( $current_user->ID, 'joint_problems', esc_attr( $_POST['joint_problems'] ) );
	if ( !empty( $_POST['medicines'] ) )
        update_user_meta( $current_user->ID, 'medicines', esc_attr( $_POST['medicines'] ) );
	if ( !empty( $_POST['contraceptive'] ) )
        update_user_meta( $current_user->ID, 'contraceptive', esc_attr( $_POST['contraceptive'] ) );
    if ( !empty( $_POST['vitamins'] ) )
        update_user_meta( $current_user->ID, 'vitamins', esc_attr( $_POST['vitamins'] ) );
    if ( !empty( $_POST['day_menu'] ) )
        update_user_meta( $current_user->ID, 'day_menu', esc_attr( $_POST['day_menu'] ) );
    if ( !empty( $_POST['bad_food_for_you'] ) )
        update_user_meta( $current_user->ID, 'bad_food_for_you', esc_attr( $_POST['bad_food_for_you'] ) );
	if ( !empty( $_POST['milk_food'] ) )
        update_user_meta( $current_user->ID, 'milk_food', esc_attr( $_POST['milk_food'] ) );
	if ( !empty( $_POST['thyroid'] ) )
        update_user_meta( $current_user->ID, 'thyroid', esc_attr( $_POST['thyroid'] ) );
	if ( !empty( $_POST['diastaz'] ) )
        update_user_meta( $current_user->ID, 'diastaz', esc_attr( $_POST['diastaz'] ) );     
     if ( !empty( $_POST['cardio'] ) )
        update_user_meta( $current_user->ID, 'cardio', esc_attr( $_POST['cardio'] ) );
    if ( !empty( $_POST['diet'] ) )
        update_user_meta( $current_user->ID, 'diet', esc_attr( $_POST['diet'] ) );  
    if ( !empty( $_POST['workout_experience'] ) )
        update_user_meta( $current_user->ID, 'workout_experience', esc_attr( $_POST['workout_experience'] ) );
	if ( !empty( $_POST['sport_last_time'] ) )
        update_user_meta( $current_user->ID, 'sport_last_time', esc_attr( $_POST['sport_last_time'] ) );
    if ( !empty( $_POST['men_menu_age'] ) )
        update_user_meta( $current_user->ID, 'men_menu_age', esc_attr( $_POST['men_menu_age'] ) );
    if ( !empty( $_POST['men_menu_height'] ) )
        update_user_meta( $current_user->ID, 'men_menu_height', esc_attr( $_POST['men_menu_height'] ) );
    if ( !empty( $_POST['men_menu_weight_at_start'] ) )
        update_user_meta( $current_user->ID, 'men_menu_weight_at_start', esc_attr( $_POST['men_menu_weight_at_start'] ) );
    if ( !empty( $_POST['men_menu_daily_activity'] ) )
        update_user_meta( $current_user->ID, 'men_menu_daily_activity', esc_attr( $_POST['men_menu_daily_activity'] ) );
    if ( !empty( $_POST['men_menu_health_problems'] ) )
        update_user_meta( $current_user->ID, 'men_menu_health_problems', esc_attr( $_POST['men_menu_health_problems'] ) );
    if ( !empty( $_POST['men_menu_diet'] ) )
        update_user_meta( $current_user->ID, 'men_menu_diet', esc_attr( $_POST['men_menu_diet'] ) );
    if ( !empty( $_POST['men_menu_workout'] ) )
        update_user_meta( $current_user->ID, 'men_menu_workout', esc_attr( $_POST['men_menu_workout'] ) );
    if ( !empty( $_POST['men_menu_what_result'] ) )
        update_user_meta( $current_user->ID, 'men_menu_what_result', esc_attr( $_POST['men_menu_what_result'] ) );
    if ( !empty( $_POST['women_menu_age'] ) )
        update_user_meta( $current_user->ID, 'women_menu_age', esc_attr( $_POST['women_menu_age'] ) );
    if ( !empty( $_POST['women_menu_height'] ) )
        update_user_meta( $current_user->ID, 'women_menu_height', esc_attr( $_POST['women_menu_height'] ) );
    if ( !empty( $_POST['women_menu_weight_at_start'] ) )
        update_user_meta( $current_user->ID, 'women_menu_weight_at_start', esc_attr( $_POST['women_menu_weight_at_start'] ) );
    if ( !empty( $_POST['women_menu_breastfeed'] ) )
        update_user_meta( $current_user->ID, 'women_menu_breastfeed', esc_attr( $_POST['women_menu_breastfeed'] ) );
    if ( !empty( $_POST['women_menu_daily_activity'] ) )
        update_user_meta( $current_user->ID, 'women_menu_daily_activity', esc_attr( $_POST['women_menu_daily_activity'] ) );
    if ( !empty( $_POST['women_menu_health_problems'] ) )
        update_user_meta( $current_user->ID, 'women_menu_health_problems', esc_attr( $_POST['women_menu_health_problems'] ) );
    if ( !empty( $_POST['women_menu_diet'] ) )
        update_user_meta( $current_user->ID, 'women_menu_diet', esc_attr( $_POST['women_menu_diet'] ) );
    if ( !empty( $_POST['women_menu_workout'] ) )
        update_user_meta( $current_user->ID, 'women_menu_workout', esc_attr( $_POST['women_menu_workout'] ) );
    if ( !empty( $_POST['women_menu_what_result'] ) )
        update_user_meta( $current_user->ID, 'women_menu_what_result', esc_attr( $_POST['women_menu_what_result'] ) );
    if ( empty( get_the_author_meta( 'date_report_create', $current_user->ID ) ) )
        update_user_meta( $current_user->ID, 'date_report_create', current_time('d.m.Y H:i:s') );    
  		update_user_meta( $current_user->ID, 'date_report_fill', current_time('d.m.Y H:i:s') );
		die();
		}
		add_action('wp_ajax_updateUserForm', 'updateUserForm');
		add_action('wp_ajax_nopriv_updateUserForm', 'updateUserForm'); // на самом деле не нужна

// ----------- Отчет по заказам и оплатам с выбором периода /paid ----------- //
function choosePeriodByFunc(){
		global $wpdb;
		$choose_period_by_type = $_POST['choose_period_by_type'];
		$choose_period_by_date_month_ajax = $_POST['choose_period_by_date_month'];
		$choose_period_by_date_year = $_POST['choose_period_by_date_year'];
		$check_period_by_date_month_and_year = $choose_period_by_date_month_ajax.'.'.$choose_period_by_date_year;
		
		$check_paid_past_month = current_time('m'); //блокировка редактирования прошлых периодов
		$check_paid_past_year = current_time('Y');
		$check_paid_past = $check_paid_past_month.'.'.$check_paid_past_year;
		
		if ( ($choose_period_by_date_year == $check_paid_past_year) && ($choose_period_by_date_month_ajax < $check_paid_past_month) ) {
			$check_paid_past_flag = 'display: none';
		} else if ( ($choose_period_by_date_year < $check_paid_past_year)  ) {
			$check_paid_past_flag = 'display: none';
		} else {
			$check_paid_past_flag = '';
		};
	
		if ($choose_period_by_type == 'date_order') {  //начало условия при выборе даты заказа
		
		$date_from = $choose_period_by_date_year.'-'.$choose_period_by_date_month_ajax.'-01';
		$date_before = $choose_period_by_date_year.'-'.$choose_period_by_date_month_ajax.'-31';
			
		$_monthsListPeriod = array(
								"01"=>"январь","02"=>"февраль","03"=>"март",
								"04"=>"апрель","05"=>"май", "06"=>"июнь",
								"07"=>"июль","08"=>"август","09"=>"сентябрь",
								"10"=>"октябрь","11"=>"ноябрь","12"=>"декабрь");	
								
								$choose_period_by_date_month = $_monthsListPeriod[$choose_period_by_date_month_ajax];
								$period_by_date = $choose_period_by_date_month.' '.$choose_period_by_date_year;
								$ordersByDateSum = 0;
								$ordersByDateCount = 0;
								
		echo '<h2 class="paid_by_date_h2">Заказы марафона за '.$period_by_date.'</h2>';
		echo '<br>';
		
		global $wpdb;
					echo '<form id="formOrdersByDate">';
							echo '<input type="hidden" name="action" value="formOrdersByDateUpdate"/>';
							echo '<input style="position: absolute; margin-left: 885px; margin-top: -66px; '.$check_paid_past_flag.'" type="submit" id="updateuser" class="submit button members_mobile_hide" value="Записать">';
					echo '<table class="paid_table_for_admin">';
						echo '<tr style="background-color: #f6f6f6;">';
							echo '<th>&nbsp;№&nbsp;</th>';
							echo '<th class="members_mobile_hide">Дата</th>';
							echo '<th class="members_mobile_hide">&nbsp;ID&nbsp;</th>';
							echo '<th>&nbsp;ФИО&nbsp;</th>';
							echo '<th class="members_mobile_hide">Город</th>';
							echo '<th>Заказ</th>';
							echo '<th style="width: 5%">&nbsp;<i class="fa fa-file-pdf-o" aria-hidden="true"></i>&nbsp;</th>';
							echo '<th>№<br>&nbsp;марафона&nbsp;</th>';
							echo '<th>Месяц<br>&nbsp;марафона&nbsp;</th>';
							echo '<th style="width: 35px;">&nbsp;<div style="height:25px; width: 25px; margin-bottom: -15px; margin-top: -15px; margin-left: 5px;"><image style="" src="http://maraphon.online/wp-content/uploads/timeismoney.png" alt="Отсрочка"></image></div>&nbsp;</th>';
							echo '<th style="width: 35px;">&nbsp;<i class="fa fa-rub" aria-hidden="true"></i>&nbsp;</th>';
							echo '<th style="width: 70px;">&nbsp;Сумма&nbsp;</th>';
							echo '<th class="members_mobile_hide" style="width: 300px;">&nbsp;Комментарий администратора&nbsp;</th>';
							echo '<th style="width: 35px;">&nbsp;<i class="fa fa-paper-plane-o" aria-hidden="true">&nbsp;</th>'; 
						echo '</tr>';
			    
				$current_user_report = $current_user->ID;
				$this_month_report_by_date = $wpdb->get_results(
						"
						SELECT 
						orders.date AS order_date,
						orders.order_id AS order_id,
						users.ID AS user_id_check,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'telephone' limit 1) as telephone,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'first_name' limit 1) as first_name,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'last_name' limit 1) as last_name,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'maraphon_counter' limit 1) as maraphon_counter,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'town' limit 1) as town,
						orders.maraphon_next_month,
						orders.women_menu,
						orders.men_menu,
						orders.telegram,
						orders.recipe_book,
						orders.pdf,
						orders.workout,
						orders.credit,
						orders.paid,
						orders.amount,
						orders.maraphon_member_month,
						orders.admin_comment
						FROM wpux_orders orders, wpux_users users
						WHERE (DATE(orders.date) BETWEEN '$date_from' AND '$date_before')
						AND orders.maraphon_next_month != ''
						AND orders.user_email = users.user_email 
						ORDER BY orders.order_id DESC
						"
						);	
				if( $this_month_report_by_date ) {
						    foreach ( $this_month_report_by_date as $string_report_by_date ) {
								$current_user_id_for_input = $string_report_by_date->user_id_check;
								$current_order_id_for_input = $string_report_by_date->order_id;
								
						        echo '<tr class="row_form_orders_by_date" id="row_form_orders_by_date_'.$current_order_id_for_input.'">';
						        
						        echo '<td>'; //1.Номер заказа
						        echo $string_report_by_date->order_id;
						        echo '</td>';
						        
						        echo '<td class="members_mobile_hide">'; //2.Дата заказа
						        $full_date = $string_report_by_date->order_date;
						        $day_date = substr($full_date, 8, 2);
						        $month_date = substr($full_date, 5, 2);
						        $year_date = substr($full_date, 0, 4);
						        $right_date = '&nbsp;'.$day_date.'.'.$month_date.'.'.$year_date.'&nbsp;';
						        echo ' '.$right_date.' ';
						        echo '</td>';
						        
						        echo '<td class="members_mobile_hide">';  //3.ID
						        echo $current_user_id_for_input;
						        echo '</td>'; 
						        
						        echo '<td>'; //4.ФИО
								$name = $string_report_by_date->first_name;
								$surname = $string_report_by_date->last_name;
								$fio = $surname.' '.$name;
								echo '<a href="http://maraphon.online/wp-admin/user-edit.php?user_id='.$current_user_id_for_input.'&wp_http_referer=%2Fwp-admin%2Fusers.php" target="_blank">'.$fio.'</a>';
						        echo '</td>'; 
						        
						        echo '<td class="members_mobile_hide">'; //.5Город
						        	echo '&nbsp;'.$string_report_by_date->town.'&nbsp;';
						        echo '</td>';
						        
						        echo '<td>'; //6.Заказ
							        if ( !empty($string_report_by_date->maraphon_next_month) ) {
								    	echo " - ".$string_report_by_date->maraphon_next_month."<br>";    
							        };
							        if ( !empty($string_report_by_date->women_menu) ) {
								    	echo " - женское меню<br>";    
							        };
							        if ( !empty($string_report_by_date->men_menu) ) {
								    	echo " - мужское меню<br>";    
							        };
							        if ( !empty($string_report_by_date->telegram) ) {
								    	echo " - подписка на Telegram<br>";    
							        };
							        if ( !empty($string_report_by_date->recipe_book) ) {
								    	echo " - книга рецептов<br>";    
							        };
							        if ( !empty($string_report_by_date->workout) ) {
								    	echo " - тренировки в зале<br>";    
							        };
						        echo '</td>';
						        
						        echo '<td>'; //7. PDF
						        		$pdf_menu_value = $string_report_by_date->pdf;
						      		    if ($pdf_menu_value == 'men_menu_pdf') { $pdf_menu_selected1 = 'selected="selected"'; $pdf_menu_color = '#ddf7c8';};
										if ($pdf_menu_value == 'women_menu_pdf') { $pdf_menu_selected2 = 'selected="selected"'; $pdf_menu_color = '#ddf7c8';};
										if ($pdf_menu_value == 'both_menu_pdf') { $pdf_menu_selected3 = 'selected="selected"'; $pdf_menu_color = '#ddf7c8';};
										if ($pdf_menu_value == 'Нет' || $pdf_menu_value == '') { $pdf_menu_selectedNo = 'selected="selected"'; $pdf_menu_color = 'white';};
								        echo '<select style="height: 26px; width: 68px; background-color: '.$pdf_menu_color.'" name="pdf_menu_id_'.$current_order_id_for_input.'" id="pdf_menu_id_'.$current_order_id_for_input.'">'; 
									        echo '<option '.$pdf_menu_selectedNo.' value="Нет">Нет</option>';
									        echo '<option '.$pdf_menu_selected1.' value="men_menu_pdf">Муж. меню</option>'; 
											echo '<option '.$pdf_menu_selected2.' value="women_menu_pdf">Жен. меню</option>'; 
											echo '<option '.$pdf_menu_selected3.' value="both_menu_pdf">Оба меню</option>'; 
										echo '</select>'; 
								        $pdf_menu_selected1 = '';
								        $pdf_menu_selected2 = '';
								        $pdf_menu_selected3 = '';
								        $pdf_menu_selectedNo = '';
						        echo '</td>';
						        						        
								echo '<td>'; //8.Номер марафона
								if ( !empty($string_report_by_date->maraphon_next_month) && ($string_report_by_date->maraphon_counter !== 0) ) {								
									echo '<input style="width: 50px; height: 26px;" readonly class="maraphon-counter" id="maraphon_counter_id_'.$current_order_id_for_input.'" name="maraphon_counter_id_'.$current_order_id_for_input.'" type="number" value="'.$string_report_by_date->maraphon_counter.'" />';
								} else {
									echo '-';
								};
						        echo '</td>';
						        
						        $maraphon_next_month_color = $string_report_by_date->maraphon_member_month;
						        $maraphon_next_month_color = substr($maraphon_next_month_color, 0, 2);
						        if  ( ($maraphon_next_month_color == '00') || ($maraphon_next_month_color == '') || ($maraphon_next_month_color == '.2') || ($maraphon_next_month_color == 'Н') ){
							        $maraphon_next_month_color_value = 'white';
						        } else {
							        $maraphon_next_month_color_value = '#ddf7c8';
						        };
						        
						        echo '<td style="width: 115px; height: 26px;">'; //8.Месяц марафона
							        if ( !empty($string_report_by_date->maraphon_next_month) ) {
								    
								    $maraphon_member_month_by_month = $string_report_by_date->maraphon_member_month;
								    $maraphon_member_month_by_month = substr($maraphon_member_month_by_month, 0, 2);
									$current_year = current_time('Y');
									if ($maraphon_member_month_by_month == '') { $selected00 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '01') { $selected01 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '02') { $selected02 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '03') { $selected03 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '04') { $selected04 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '05') { $selected05 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '06') { $selected06 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '07') { $selected07 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '08') { $selected08 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '09') { $selected09 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '10') { $selected010 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '11') { $selected011 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '12') { $selected012 = 'selected="selected"'; };

							        echo '<select style="height: 26px; width: 115px; background-color: '.$maraphon_next_month_color_value.'" name="maraphon_member_month_id_'.$current_order_id_for_input.'">';
								        echo '<option '.$selected00.' value="">Не выбран</option>';
										echo '<option '.$selected01.' value="01.'.$current_year.'">Январь</option>'; 
										echo '<option '.$selected02.' value="02.'.$current_year.'">Февраль</option>'; 
										echo '<option '.$selected03.' value="03.'.$current_year.'">Март</option>'; 
										echo '<option '.$selected04.' value="04.'.$current_year.'">Апрель</option>'; 
										echo '<option '.$selected05.' value="05.'.$current_year.'">Май</option>'; 
										echo '<option '.$selected06.' value="06.'.$current_year.'">Июнь</option>'; 
										echo '<option '.$selected07.' value="07.'.$current_year.'">Июль</option>'; 
										echo '<option '.$selected08.' value="08.'.$current_year.'">Август</option>'; 
										echo '<option '.$selected09.' value="09.'.$current_year.'">Сентябрь</option>'; 
										echo '<option '.$selected010.' value="10.'.$current_year.'">Октябрь</option>'; 
										echo '<option '.$selected011.' value="11.'.$current_year.'">Ноябрь</option>';
										echo '<option '.$selected012.' value="12.'.$current_year.'">Декабрь</option>';  
									echo '</select>'; 
									
									if ($maraphon_member_month_by_month == '') { $selected00 = ''; };
									if ($maraphon_member_month_by_month == '01') { $selected01 = ''; };
									if ($maraphon_member_month_by_month == '02') { $selected02 = ''; };
									if ($maraphon_member_month_by_month == '03') { $selected03 = ''; };
									if ($maraphon_member_month_by_month == '04') { $selected04 = ''; };
									if ($maraphon_member_month_by_month == '05') { $selected05 = ''; };
									if ($maraphon_member_month_by_month == '06') { $selected06 = ''; };
									if ($maraphon_member_month_by_month == '07') { $selected07 = ''; };
									if ($maraphon_member_month_by_month == '08') { $selected08 = ''; };
									if ($maraphon_member_month_by_month == '09') { $selected09 = ''; };
									if ($maraphon_member_month_by_month == '10') { $selected010 = ''; };
									if ($maraphon_member_month_by_month == '11') { $selected011 = ''; };
									if ($maraphon_member_month_by_month == '12') { $selected012 = ''; };
							        } else {
										echo '-';
									};
						        echo '</td>';
						        
								
						        
						        echo '<td>'; //9.  Отсрочка 
							      	if ( ($string_report_by_date->credit == '0') || ($string_report_by_date->credit == '') ) {				        
							        echo '<input type="checkbox" class="credit_counter" id="credit_id_'.$current_order_id_for_input.'" style="transform:scale(1.5); cursor:pointer;" name="credit_id_'.$current_order_id_for_input.'" value="1" >';
							        }	else {
								    echo '<input type="checkbox" class="credit_counter" id="credit_id_'.$current_order_id_for_input.'" style="transform:scale(1.5); cursor:pointer;" checked name="credit_id_'.$current_order_id_for_input.'" value="1"  >';
							        }
						        echo '</td>';
						        
						        echo '<td>'; //10.  Оплата
						        	$ordersByDateCount = $ordersByDateCount + 1;  
							      	if ($string_report_by_date->paid == '0') {				        
							        echo '<input type="checkbox" class="paid_counter" id="paidid_id_'.$current_order_id_for_input.'" style="transform:scale(1.5); cursor:pointer;" name="paid_id_'.$current_order_id_for_input.'" value="1" >';
							        }	else {
								    echo '<input type="checkbox" class="paid_counter" id="paidid_id_'.$current_order_id_for_input.'" style="transform:scale(1.5); cursor:pointer;" checked name="paid_id_'.$current_order_id_for_input.'" value="1"  >';
							        }
						        echo '</td>';
						         
						        if  ($string_report_by_date->paid == '1' || $string_report_by_date->credit == '1') {
							        $amount_color = '#ddf7c8';
						        } else {
							        $amount_color = 'white';
						        }
						        						        
						        echo '<td>'; //12.Сумма
						          $ordersByDateSum = $ordersByDateSum + $string_report_by_date->amount;
							      echo '<input style="width:70px; height: 26px; background-color: '.$amount_color.';" class="text-input" name="amount_id_'.$current_order_id_for_input.'" type="number" id="amount_id" value="'.$string_report_by_date->amount.'" />';
						        echo '</td>';
						        
						        if ( ($string_report_by_date->paid == '1' || $string_report_by_date->credit == '1') && ($maraphon_next_month_color !== '00') ) {
							        $whatsapp_color = '#ddf7c8';
						        } else {
							        $whatsapp_color = 'white';
						        };
						        
						        echo '<td class="members_mobile_hide">'; //13.Комментарий администратора
							      echo '<input style="width: 300px; height: 26px; background-color: '.$whatsapp_color.';" class="text-input" name="admin_comment_id_'.$current_order_id_for_input.'" type="text" id="admin_comment_id" value="'.$string_report_by_date->admin_comment.'" />';
						        echo '</td>';
						        
						        echo '<td>';//14.Телефон
							        $whatsapp_number = $string_report_by_date->telephone;
							        $phone= str_replace([' ', '(', ')', '-', '_'], '', $whatsapp_number);
									$phone = preg_replace('/^8/', '+7', $phone);
									$phone = preg_replace('/^7/', '+7', $phone);    
							        echo '<a href="https://api.whatsapp.com/send?phone='.$phone.'" target="_blank"><img style="width: 30px; padding-top: 5px;" src="http://maraphon.online/wp-content/uploads/whatsapp-icon-180×180.png"/></a>';	
						        echo '</td>';  

						        echo '</tr>';
							}
							}			
		echo '</table>';
		
						echo '<table class="paid_date_result_table">';
								echo '<tr>'; 
										
								echo '<td style="opacity: 0; width: 50px;">';
									echo '<input style="width:50px;" name="choose_period_by_date_month" type="number" value="'.$choose_period_by_date_month_ajax.'" />';
								echo '</td>';
										
								echo '<td style="opacity: 0; width: 50px;">';
									echo '<input style="width:50px;" name="choose_period_by_date_year" type="number" value="'.$choose_period_by_date_year.'" />';
								echo '</td>';
								
								echo '<td style="border: 3px solid black; width: 250px; text-align: center; padding-top: 3px;">';
									echo 'Количество заказов: '.$ordersByDateCount;
								echo '</td>';
								
								echo '<td style="border: 3px solid black; width: 198px; text-align: center; padding-top: 3px;">';
									echo 'Сумма: '.$ordersByDateSum.' р.';
								echo '</td>';
								
								echo '</tr>';
						echo '</table>';
						
		echo '<div id="success_form">Данные обновлены</div>';
		
		echo '<input type="hidden" name="action" value="formOrdersByDateUpdate"/>';
		echo '<input style="margin-bottom: 40px; '.$check_paid_past_flag.'" type="submit" id="updateuser" class="submit button paid_button" value="Записать">';
	echo '</form>'; 
		
	// Разблокировка счетчика марафона по двойному клику //
	echo '<script type="text/javascript">'; 
	echo '$(function() {';
		    echo 'function maraphonCounter(){';
		      echo 'var maraphonRemoveid = this.id;';
		      echo 'var maraphonRemoveidID = "#" + maraphonRemoveid;';
		      echo '$(maraphonRemoveidID).removeAttr("readonly");';
			echo '}';
		    echo '$(".maraphon-counter").dblclick(maraphonCounter);';
		echo '});';
	echo '</script>';
		
	// Отключение возможности поставить и отсрочку и оплату, увеличение на 1
	echo '
		<script>
			$(".row_form_orders_by_date input:checkbox").click(function(){
				var idRow = this.id;
				var idRowRight = idRow.substr(10);
				var maraphon_counter_id = "#maraphon_counter_id_" + idRowRight;
				var maraphon_counter_value = $(maraphon_counter_id).val();
				var rowVar = "#row_form_orders_by_date_" + idRowRight + " input:checkbox";
				if ($(this).is(":checked")) {
					if (!$(rowVar).not(this).prop("checked")) {
						$(maraphon_counter_id).val(parseInt(maraphon_counter_value) + 1);
						} else {
							$(rowVar).not(this).prop("checked", false);
						}            	
					} else {
						$(maraphon_counter_id).val(maraphon_counter_value - 1);
				};
			});
		</script>	
	'; 
	
	
	echo '<script type="text/javascript">';
	echo 'jQuery("#formOrdersByDate").submit(ajaxFormOrdersByDate);';
		echo 'function ajaxFormOrdersByDate(){';
			echo 'var formOrdersByDate = jQuery(this).serialize();';
			echo '$.ajaxSetup({cache: false});';
				echo 'jQuery.ajax({';
				echo 'type:"POST",';
				echo 'url: "/wp-admin/admin-ajax.php",';
				echo 'data: formOrdersByDate,';
					echo 'success:function(data){';
					echo '$("#success_form").show();';
					echo 'setTimeout(function(){$("#success_form").fadeOut("slow")},1000);';
					echo '}';
				echo '});';
			echo 'return false;';
		echo '}';
	echo '</script>';
			
		} else if ($choose_period_by_type == 'period_order') {    //начало условия при выборе период участия
	
		$date_period_sql = $choose_period_by_date_month_ajax.'.'.$choose_period_by_date_year;
		$ordersByDateCount = 0;
		$ordersByDateSum = 0;
		$_monthsListPeriod = array(
								"01"=>"январь","02"=>"февраль","03"=>"март",
								"04"=>"апрель","05"=>"май", "06"=>"июнь",
								"07"=>"июль","08"=>"август","09"=>"сентябрь",
								"10"=>"октябрь","11"=>"ноябрь","12"=>"декабрь");	
								
								$choose_period_by_date_month = $_monthsListPeriod[$choose_period_by_date_month_ajax];
								$period_by_date = $choose_period_by_date_month.' '.$choose_period_by_date_year;
								$ordersByPeriodCount = 0;
								$ordersByPeriodSum = 0;
								$natalieMoneyCount = 20000;
								
		echo '<h2 class="h2_paid_header">Подтвержденные заказы и оплаты за '.$period_by_date.'</h2>';
		echo '<br>';
		
		global $wpdb;
					echo '<form id="formOrdersByPeriod">';  
					echo '<table class="paid_table_for_admin">';
						echo '<tr style="background-color: #f6f6f6;">';
							echo '<th>&nbsp;№&nbsp;</th>';
							echo '<th class="members_mobile_hide">Дата</th>';
							echo '<th class="members_mobile_hide">&nbsp;ID&nbsp;</th>';
							echo '<th>&nbsp;ФИО&nbsp;</th>';
							echo '<th class="members_mobile_hide">Город</th>';
							echo '<th>Заказ</th>';
							echo '<th style="width: 5%">&nbsp;<i class="fa fa-file-pdf-o" aria-hidden="true"></i>&nbsp;</th>';  
							echo '<th>№<br>&nbsp;марафона&nbsp;</th>';
							echo '<th>Месяц<br>&nbsp;марафона&nbsp;</th>';
							echo '<th style="width: 35px;">&nbsp;<div style="height:25px; width: 25px; margin-bottom: -15px; margin-top: -15px; margin-left: 5px;"><image style="" src="http://maraphon.online/wp-content/uploads/timeismoney.png" alt="Отсрочка"></image></div>&nbsp;</th>';
							echo '<th style="width: 35px;">&nbsp;<i class="fa fa-rub" aria-hidden="true"></i>&nbsp;</th>';
							echo '<th style="width: 70px;">&nbsp;Сумма&nbsp;</th>';
							echo '<th class="members_mobile_hide" style="width: 300px;">&nbsp;Комментарий администратора&nbsp;</th>';
							echo '<th style="width: 32px;">&nbsp;<i class="fa fa-paper-plane-o" aria-hidden="true">&nbsp;</th>'; 
						echo '</tr>';
			    
				$current_user_report = $current_user->ID;
				$this_month_report_by_period = $wpdb->get_results(
						"
						SELECT 
						orders.date AS order_date,
						orders.order_id AS order_id,
						users.ID AS user_id_check,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'telephone' limit 1) as telephone,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'first_name' limit 1) as first_name,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'last_name' limit 1) as last_name,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'maraphon_counter' limit 1) as maraphon_counter,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'town' limit 1) as town,
						orders.maraphon_next_month,
						orders.women_menu,
						orders.men_menu,
						orders.telegram,
						orders.recipe_book,
						orders.pdf,
						orders.workout,
						orders.credit,
						orders.paid,
						orders.amount,
						orders.maraphon_member_month,
						orders.admin_comment
						FROM wpux_orders orders, wpux_users users
						WHERE orders.maraphon_member_month = $date_period_sql
						AND orders.user_email = users.user_email 
						ORDER BY last_name
						"
						);	
						if( $this_month_report_by_period ) {
						    foreach ( $this_month_report_by_period as $string_report_by_period ) {
								$current_user_id_for_input = $string_report_by_period->user_id_check;
								$current_order_id_for_input = $string_report_by_period->order_id;
								
						        echo '<tr class="row_form_orders_by_date" id="row_form_orders_by_date_'.$current_order_id_for_input.'">';
						        
						        echo '<td>'; //1.Номер заказа (период)
						        echo $string_report_by_period->order_id;
						        echo '</td>';
						        
						        echo '<td class="members_mobile_hide">'; //2.Дата заказа (период)
						        $full_date = $string_report_by_period->order_date;
						        $day_date = substr($full_date, 8, 2);
						        $month_date = substr($full_date, 5, 2);
						        $year_date = substr($full_date, 0, 4);
						        $right_date = '&nbsp;'.$day_date.'.'.$month_date.'.'.$year_date.'&nbsp;';
						        echo ' '.$right_date.' ';
						        echo '</td>';
						        
						        echo '<td class="members_mobile_hide">';  //3.ID (период)
						        echo $current_user_id_for_input;
						        echo '</td>'; 
						        
						        echo '<td>'; //4.ФИО (период)
								$name = $string_report_by_period->first_name;
								$surname = $string_report_by_period->last_name;
								$fio = $surname.' '.$name;
								echo '<a href="http://maraphon.online/wp-admin/user-edit.php?user_id='.$current_user_id_for_input.'&wp_http_referer=%2Fwp-admin%2Fusers.php" target="_blank">'.$fio.'</a>';
						        echo '</td>'; 
						        
						        echo '<td class="members_mobile_hide">'; //.5Город (период)
						        	echo '&nbsp;'.$string_report_by_period->town.'&nbsp;';
						        echo '</td>';
						        
						        echo '<td>'; //6.Заказ (период)
							        if ( !empty($string_report_by_period->maraphon_next_month) ) {
								    	echo " - ".$string_report_by_period->maraphon_next_month."<br>";    
							        };
							        if ( !empty($string_report_by_period->women_menu) ) {
								    	echo " - женское меню ".$string_report_by_period->women_menu." ккал<br>";    
							        };
							        if ( !empty($string_report_by_period->men_menu) ) {
								    	echo " - мужское меню ".$string_report_by_period->men_menu." ккал<br>";    
							        };
							        if ( !empty($string_report_by_period->telegram) ) {
								    	echo " - ".$string_report_by_period->telegram."<br>";    
							        };
							        if ( !empty($string_report_by_period->recipe_book) ) {
								    	echo " - ".$string_report_by_period->recipe_book."<br>";    
							        };
							        if ( !empty($string_report_by_period->workout) ) {
								    	echo " - ".$string_report_by_period->workout."<br>";    
							        };
						        echo '</td>';
						        
						        echo '<td>'; //7. PDF
						        		$pdf_menu_value = $string_report_by_period->pdf;
						      		    if ($pdf_menu_value == 'men_menu_pdf') { $pdf_menu_selected1 = 'selected="selected"'; $pdf_menu_color = '#ddf7c8';};
										if ($pdf_menu_value == 'women_menu_pdf') { $pdf_menu_selected2 = 'selected="selected"'; $pdf_menu_color = '#ddf7c8';};
										if ($pdf_menu_value == 'both_menu_pdf') { $pdf_menu_selected3 = 'selected="selected"'; $pdf_menu_color = '#ddf7c8';};
										if ($pdf_menu_value == 'Нет' || $pdf_menu_value == '') { $pdf_menu_selectedNo = 'selected="selected"'; $pdf_menu_color = 'white';};
								        echo '<select style="height: 26px; width: 68px; background-color: '.$pdf_menu_color.'" name="pdf_menu_id_'.$current_order_id_for_input.'">'; 
									        echo '<option '.$pdf_menu_selectedNo.' value="Нет">Нет</option>';
									        echo '<option '.$pdf_menu_selected1.' value="men_menu_pdf">Муж. меню</option>'; 
											echo '<option '.$pdf_menu_selected2.' value="women_menu_pdf">Жен. меню</option>'; 
											echo '<option '.$pdf_menu_selected3.' value="both_menu_pdf">Оба меню</option>'; 
										echo '</select>'; 
								        $pdf_menu_selected1 = '';
								        $pdf_menu_selected2 = '';
								        $pdf_menu_selected3 = '';
								        $pdf_menu_selectedNo = '';
						        echo '</td>';
						        
								echo '<td>'; //8.Номер марафона (период)
								if ( !empty($string_report_by_period->maraphon_next_month) && ($string_report_by_period->maraphon_counter !== 0) ) {								
									echo '<input style="width: 50px; height: 26px;" readonly class="maraphon-counter" id="maraphon_counter_id_'.$current_order_id_for_input.'" name="maraphon_counter_id_'.$current_order_id_for_input.'" type="number" value="'.$string_report_by_period->maraphon_counter.'" />';
								} else {
									echo '-';
								};
						        echo '</td>';
						        
						        $maraphon_next_month_color_value = '#ddf7c8';
						        
						        echo '<td style="width: 115px; height: 26px;">'; //9.Месяц марафона (период)
							        if ( !empty($string_report_by_period->maraphon_next_month) ) {
								    
								    $maraphon_member_month_by_month = $string_report_by_period->maraphon_member_month;
								    $maraphon_member_month_by_month = substr($maraphon_member_month_by_month, 0, 2);
									$current_year = current_time('Y');
									if ($maraphon_member_month_by_month == '') { $selected00 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '01') { $selected01 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '02') { $selected02 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '03') { $selected03 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '04') { $selected04 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '05') { $selected05 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '06') { $selected06 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '07') { $selected07 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '08') { $selected08 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '09') { $selected09 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '10') { $selected010 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '11') { $selected011 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '12') { $selected012 = 'selected="selected"'; };

							        echo '<select style="height: 26px; width: 115px; background-color: '.$maraphon_next_month_color_value.'" name="maraphon_member_month_id_'.$current_order_id_for_input.'">';
								        echo '<option '.$selected00.' value="">Не выбран</option>';
										echo '<option '.$selected01.' value="01.'.$current_year.'">Январь</option>'; 
										echo '<option '.$selected02.' value="02.'.$current_year.'">Февраль</option>'; 
										echo '<option '.$selected03.' value="03.'.$current_year.'">Март</option>'; 
										echo '<option '.$selected04.' value="04.'.$current_year.'">Апрель</option>'; 
										echo '<option '.$selected05.' value="05.'.$current_year.'">Май</option>'; 
										echo '<option '.$selected06.' value="06.'.$current_year.'">Июнь</option>'; 
										echo '<option '.$selected07.' value="07.'.$current_year.'">Июль</option>'; 
										echo '<option '.$selected08.' value="08.'.$current_year.'">Август</option>'; 
										echo '<option '.$selected09.' value="09.'.$current_year.'">Сентябрь</option>'; 
										echo '<option '.$selected010.' value="10.'.$current_year.'">Октябрь</option>'; 
										echo '<option '.$selected011.' value="11.'.$current_year.'">Ноябрь</option>';
										echo '<option '.$selected012.' value="12.'.$current_year.'">Декабрь</option>';  
									echo '</select>'; 
									
									if ($maraphon_member_month_by_month == '') { $selected00 = ''; };
									if ($maraphon_member_month_by_month == '01') { $selected01 = ''; };
									if ($maraphon_member_month_by_month == '02') { $selected02 = ''; };
									if ($maraphon_member_month_by_month == '03') { $selected03 = ''; };
									if ($maraphon_member_month_by_month == '04') { $selected04 = ''; };
									if ($maraphon_member_month_by_month == '05') { $selected05 = ''; };
									if ($maraphon_member_month_by_month == '06') { $selected06 = ''; };
									if ($maraphon_member_month_by_month == '07') { $selected07 = ''; };
									if ($maraphon_member_month_by_month == '08') { $selected08 = ''; };
									if ($maraphon_member_month_by_month == '09') { $selected09 = ''; };
									if ($maraphon_member_month_by_month == '10') { $selected010 = ''; };
									if ($maraphon_member_month_by_month == '11') { $selected011 = ''; };
									if ($maraphon_member_month_by_month == '12') { $selected012 = ''; };
							        } else {
										echo '-';
									};
						        echo '</td>';
						        
						        
								
								echo '<td>'; //10. Отсрочка (период)
							      	if ( ($string_report_by_period->credit == '0') || ($string_report_by_period->credit == '') ) {				        
							        echo '<input type="checkbox" class="credit_counter" id="credit_id_'.$current_order_id_for_input.'" style="transform:scale(1.5); cursor:pointer;" name="credit_id_'.$current_order_id_for_input.'" value="1" >';
							        }	else {
								    echo '<input type="checkbox" class="credit_counter" id="credit_id_'.$current_order_id_for_input.'" style="transform:scale(1.5); cursor:pointer;" checked name="credit_id_'.$current_order_id_for_input.'" value="1"  >';
							        }
						        echo '</td>';

						        echo '<td>'; //11. Оплата (период) 
						        	$ordersByDateCount = $ordersByDateCount + 1;
							      	if ($string_report_by_period->paid == '0') {				        
							        echo '<input type="checkbox" class="paid_counter" id="paidid_id_'.$current_order_id_for_input.'" style="transform:scale(1.5); cursor:pointer;" name="paid_id_'.$current_order_id_for_input.'" value="1" >';
							        }	else {
								    echo '<input type="checkbox" class="paid_counter" id="paidid_id_'.$current_order_id_for_input.'" style="transform:scale(1.5); cursor:pointer;" checked name="paid_id_'.$current_order_id_for_input.'" value="1"  >';
								    $ordersByPeriodCount = $ordersByPeriodCount + 1;
								    $ordersByPeriodSum = $ordersByPeriodSum + $string_report_by_period->amount;
										    if ($string_report_by_period->maraphon_counter == 1) {
											$natalieMoneyCount = $natalieMoneyCount + 150;    
										    };
										   
							        	};
						        echo '</td>';
						         
						        if  ($string_report_by_period->paid == '1' || $string_report_by_period->credit == '1') {
							        $amount_color = '#ddf7c8';
						        } else {
							        $amount_color = 'white';
						        }
						        
						        $ordersByDateSum = $ordersByDateSum + $string_report_by_period->amount;
						        echo '<td>'; //12. Сумма (период)
							      echo '<input style="width:70px; height: 26px; background-color: '.$amount_color.';" class="text-input" name="amount_id_'.$current_order_id_for_input.'" type="number" id="amount_id" value="'.$string_report_by_period->amount.'" />';
						        echo '</td>';
						        
						        if ( ($string_report_by_period->paid == '1' || $string_report_by_period->credit == '1') && ($maraphon_next_month_color !== '00') ) {
							        $whatsapp_color = '#ddf7c8';
						        } else {
							        $whatsapp_color = 'white';
						        };
						        
						        echo '<td class="members_mobile_hide">'; //13.Комментарий администратора (период)
							      echo '<input style="width: 300px; height: 26px; background-color: '.$whatsapp_color.';" class="text-input" name="admin_comment_id_'.$current_order_id_for_input.'" type="text" id="admin_comment_id" value="'.$string_report_by_period->admin_comment.'" />';
						        echo '</td>';
						        
						        echo '<td>';//14.Телефон (период)
							        $whatsapp_number = $string_report_by_period->telephone;
							        $phone= str_replace([' ', '(', ')', '-', '_'], '', $whatsapp_number);
									$phone = preg_replace('/^8/', '+7', $phone);
									$phone = preg_replace('/^7/', '+7', $phone);    
							        echo '<a href="https://api.whatsapp.com/send?phone='.$phone.'" target="_blank"><img style="width: 30px; padding-top: 5px;" src="http://maraphon.online/wp-content/uploads/whatsapp-icon-180×180.png"/></a>';	
						        echo '</td>';  

						        echo '</tr>';
							}
							}			
		echo '</table>';
		
						echo '<table class="paid_paid_result_table">';
								echo '<tr>'; 
										
								echo '<td style="opacity: 0; width: 50px;">';
									echo '<input style="width:50px;" name="choose_period_by_date_month" type="number" value="'.$choose_period_by_date_month_ajax.'" />';
								echo '</td>';
										
								echo '<td style="opacity: 0; width: 50px;">';
									echo '<input style="width:50px;" name="choose_period_by_date_year" type="number" value="'.$choose_period_by_date_year.'" />';
								echo '</td>';
								
								echo '<td style="border: 3px solid black; width: 180px; text-align: center; padding-top: 3px;">';
									echo 'Зарплата: '.($ordersByPeriodSum*0.2).' р.';
								echo '</td>';
								
								echo '<td style="border: 3px solid black; width: 194px; text-align: center; padding-top: 3px;">';
									echo 'Всего заказов: '.$ordersByDateCount;
								echo '</td>';
								
								echo '<td style="border: 3px solid black; width: 180px; text-align: center; padding-top: 3px;">';
									echo 'Сумма: '.$ordersByDateSum.' р.';
								echo '</td>';
								
								echo '<td style="border: 3px solid black; width: 240px; text-align: center; padding-top: 3px;">';
									echo 'Оплаченные заказы: '.$ordersByPeriodCount;
								echo '</td>';
								
								echo '<td style="border: 3px solid black; width: 329px; text-align: center; padding-top: 3px;">';
									echo 'Оплачено, сумма: '.$ordersByPeriodSum.' р.';
								echo '</td>';
								
								echo '</tr>';
						echo '</table>';
						
		echo '<div id="success_form">Данные обновлены</div>';
		echo '<input type="hidden" name="action" value="formOrdersByPeriodUpdate"/>';
		echo '<input style="margin-bottom: 40px; '.$check_paid_past_flag.'" type="submit" id="updateuser" class="submit button paid_button" value="Записать">';
	echo '</form>'; 
	
	// Разблокировка счетчика марафона по двойному клику  (период)
	echo '<script type="text/javascript">'; 
	echo '$(function() {';
		    echo 'function maraphonCounter(){';
		      echo 'var maraphonRemoveid = this.id;';
		      echo 'var maraphonRemoveidID = "#" + maraphonRemoveid;';
		      echo '$(maraphonRemoveidID).removeAttr("readonly");';
			echo '}';
		    echo '$(".maraphon-counter").dblclick(maraphonCounter);';
		echo '});';
	echo '</script>';
	
	// Отключение возможности поставить и отсрочку и оплату, увеличение на 1
	echo '
		<script>
			$(".row_form_orders_by_date input:checkbox").click(function(){
				var idRow = this.id;
				var idRowRight = idRow.substr(10);
				var maraphon_counter_id = "#maraphon_counter_id_" + idRowRight;
				var maraphon_counter_value = $(maraphon_counter_id).val();
				var rowVar = "#row_form_orders_by_date_" + idRowRight + " input:checkbox";
				if ($(this).is(":checked")) {
					if (!$(rowVar).not(this).prop("checked")) {
						$(maraphon_counter_id).val(parseInt(maraphon_counter_value) + 1);
						} else {
							$(rowVar).not(this).prop("checked", false);
						}            	
					} else {
						$(maraphon_counter_id).val(maraphon_counter_value - 1);
				};
			});
		</script>	
	'; 
	
	echo '<script type="text/javascript">';
	echo 'jQuery("#formOrdersByPeriod").submit(ajaxFormOrdersByPeriod);';
		echo 'function ajaxFormOrdersByPeriod(){';
			echo 'var formOrdersByPeriod = jQuery(this).serialize();';
			echo '$.ajaxSetup({cache: false});';
				echo 'jQuery.ajax({';
				echo 'type:"POST",';
				echo 'url: "/wp-admin/admin-ajax.php",';
				echo 'data: formOrdersByPeriod,';
					echo 'success:function(data){';
					echo '$("#success_form").show();';
					echo 'setTimeout(function(){$("#success_form").fadeOut("slow")},1000);';
					echo '}';
				echo '});';
			echo 'return false;';
		echo '}';
	echo '</script>';
	
		} else if ($choose_period_by_type == 'nomoney_order') {    															//начало условия при выборе неоплаченные заказы
		$date_period_sql = $choose_period_by_date_month_ajax.'.'.$choose_period_by_date_year;
		$ordersByDateCount = 0;
		$ordersByDateSum = 0;
		$_monthsListPeriod = array(
								"01"=>"январь","02"=>"февраль","03"=>"март",
								"04"=>"апрель","05"=>"май", "06"=>"июнь",
								"07"=>"июль","08"=>"август","09"=>"сентябрь",
								"10"=>"октябрь","11"=>"ноябрь","12"=>"декабрь");	
	
								$choose_period_by_date_month = $_monthsListPeriod[$choose_period_by_date_month_ajax];
								$period_by_date = $choose_period_by_date_month.' '.$choose_period_by_date_year;
								$ordersByPeriodCount = 0;
								$ordersByPeriodSum = 0;		
								
					    
				$current_user_report = $current_user->ID;
				$this_month_report_by_period = $wpdb->get_results(
						"
						SELECT 
						orders.date AS order_date,
						orders.order_id AS order_id,
						users.ID AS user_id_check,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'telephone' limit 1) as telephone,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'first_name' limit 1) as first_name,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'last_name' limit 1) as last_name,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'maraphon_counter' limit 1) as maraphon_counter,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'town' limit 1) as town,
						orders.maraphon_next_month,
						orders.women_menu,
						orders.men_menu,
						orders.telegram,
						orders.recipe_book,
						orders.pdf,
						orders.workout,
						orders.credit,
						orders.paid,
						orders.amount,
						orders.maraphon_member_month,
						orders.admin_comment
						FROM wpux_orders orders, wpux_users users
						WHERE orders.maraphon_member_month = $date_period_sql
						AND orders.user_email = users.user_email
						AND (orders.credit = '0' OR orders.credit = '')
						AND (orders.paid = '0' OR orders.paid = '')
						ORDER BY last_name
						"
						);	
						if( $this_month_report_by_period ) {
							
							echo '<h2 style="padding-left: 10px; margin-top: -110px;">Неоплаченные заказы на '.$period_by_date.'</h2>';
		echo '<br>';
		
		global $wpdb;
					echo '<form id="formOrdersByNoMoney">';  
					echo '<table class="daily_report_table_for_user" style="width: 1260px; margin-left: 10px; font-family: kelson; font-size: 18px;">';
						echo '<tr>';
							echo '<th>&nbsp;№&nbsp;</th>';
							echo '<th>Дата</th>';
							echo '<th>&nbsp;ID&nbsp;</th>';
							echo '<th>&nbsp;ФИО&nbsp;</th>';
							echo '<th>Город</th>';
							echo '<th>Заказ</th>';
							echo '<th style="width: 5%">&nbsp;<i class="fa fa-file-pdf-o" aria-hidden="true"></i>&nbsp;</th>';  
							echo '<th>№<br>&nbsp;марафона&nbsp;</th>';
							echo '<th>Месяц<br>&nbsp;марафона&nbsp;</th>';
							echo '<th style="width: 35px;">&nbsp;<div style="height:25px; width: 25px; margin-bottom: -15px; margin-top: -15px; margin-left: 5px;"><image style="" src="http://maraphon.online/wp-content/uploads/timeismoney.png" alt="Отсрочка"></image></div>&nbsp;</th>';
							echo '<th style="width: 35px;">&nbsp;<i class="fa fa-rub" aria-hidden="true"></i>&nbsp;</th>';
							echo '<th style="width: 70px;">&nbsp;Сумма&nbsp;</th>';
							echo '<th style="width: 300px;">&nbsp;Комментарий администратора&nbsp;</th>';
							echo '<th style="width: 32px;">&nbsp;<i class="fa fa-paper-plane-o" aria-hidden="true">&nbsp;</th>'; 
						echo '</tr>';

							
						    foreach ( $this_month_report_by_period as $string_report_by_period ) {
								$current_user_id_for_input = $string_report_by_period->user_id_check;
								$current_order_id_for_input = $string_report_by_period->order_id;
								
						        echo '<tr class="row_form_orders_by_date" id="row_form_orders_by_date_'.$current_order_id_for_input.'">';
						        
						        echo '<td>'; //1.Номер заказа (неоплаченные заказы)
						        echo $string_report_by_period->order_id;
						        echo '</td>';
						        
						        echo '<td>'; //2.Дата заказа (неоплаченные заказы)
						        $full_date = $string_report_by_period->order_date;
						        $day_date = substr($full_date, 8, 2);
						        $month_date = substr($full_date, 5, 2);
						        $year_date = substr($full_date, 0, 4);
						        $right_date = '&nbsp;'.$day_date.'.'.$month_date.'.'.$year_date.'&nbsp;';
						        echo ' '.$right_date.' ';
						        echo '</td>';
						        
						        echo '<td>';  //3.ID (неоплаченные заказы)
						        echo $current_user_id_for_input;
						        echo '</td>'; 
						        
						        echo '<td>'; //4.ФИО (неоплаченные заказы)
								$name = $string_report_by_period->first_name;
								$surname = $string_report_by_period->last_name;
								$fio = $surname.' '.$name;
								echo '<a href="http://maraphon.online/wp-admin/user-edit.php?user_id='.$current_user_id_for_input.'&wp_http_referer=%2Fwp-admin%2Fusers.php" target="_blank">'.$fio.'</a>';
						        echo '</td>'; 
						        
						        echo '<td>'; //.5Город (неоплаченные заказы)
						        	echo '&nbsp;'.$string_report_by_period->town.'&nbsp;';
						        echo '</td>';
						        
						        echo '<td>'; //6.Заказ (неоплаченные заказы)
							        if ( !empty($string_report_by_period->maraphon_next_month) ) {
								    	echo " - ".$string_report_by_period->maraphon_next_month."<br>";    
							        };
							        if ( !empty($string_report_by_period->women_menu) ) {
								    	echo " - женское меню ".$string_report_by_period->women_menu." ккал<br>";    
							        };
							        if ( !empty($string_report_by_period->men_menu) ) {
								    	echo " - мужское меню ".$string_report_by_period->men_menu." ккал<br>";    
							        };
							        if ( !empty($string_report_by_period->telegram) ) {
								    	echo " - ".$string_report_by_period->telegram."<br>";    
							        };
							        if ( !empty($string_report_by_period->recipe_book) ) {
								    	echo " - ".$string_report_by_period->recipe_book."<br>";    
							        };
							        if ( !empty($string_report_by_period->workout) ) {
								    	echo " - ".$string_report_by_period->workout."<br>";    
							        };
						        echo '</td>';
						        
						        echo '<td>'; //7. PDF
						        		$pdf_menu_value = $string_report_by_period->pdf;
						      		    if ($pdf_menu_value == 'men_menu_pdf') { $pdf_menu_selected1 = 'selected="selected"'; $pdf_menu_color = '#ddf7c8';};
										if ($pdf_menu_value == 'women_menu_pdf') { $pdf_menu_selected2 = 'selected="selected"'; $pdf_menu_color = '#ddf7c8';};
										if ($pdf_menu_value == 'both_menu_pdf') { $pdf_menu_selected3 = 'selected="selected"'; $pdf_menu_color = '#ddf7c8';};
										if ($pdf_menu_value == 'Нет' || $pdf_menu_value == '') { $pdf_menu_selectedNo = 'selected="selected"'; $pdf_menu_color = 'white';};
								        echo '<select style="height: 26px; width: 68px; background-color: '.$pdf_menu_color.'" name="pdf_menu_id_'.$current_order_id_for_input.'">'; 
									        echo '<option '.$pdf_menu_selectedNo.' value="Нет">Нет</option>';
									        echo '<option '.$pdf_menu_selected1.' value="men_menu_pdf">Муж. меню</option>'; 
											echo '<option '.$pdf_menu_selected2.' value="women_menu_pdf">Жен. меню</option>'; 
											echo '<option '.$pdf_menu_selected3.' value="both_menu_pdf">Оба меню</option>'; 
										echo '</select>'; 
								        $pdf_menu_selected1 = '';
								        $pdf_menu_selected2 = '';
								        $pdf_menu_selected3 = '';
								        $pdf_menu_selectedNo = '';
						        echo '</td>';
						        
								echo '<td>'; //8.Номер марафона (неоплаченные заказы)
								if ( !empty($string_report_by_period->maraphon_next_month) && ($string_report_by_period->maraphon_counter !== 0) ) {								
									echo '<input style="width: 50px; height: 26px;" readonly class="maraphon-counter" id="maraphon_counter_id_'.$current_order_id_for_input.'" name="maraphon_counter_id_'.$current_order_id_for_input.'" type="number" value="'.$string_report_by_period->maraphon_counter.'" />';
								} else {
									echo '-';
								};
						        echo '</td>';
						        
						        $maraphon_next_month_color = $string_report_by_period->maraphon_member_month;
						        $maraphon_next_month_color = substr($maraphon_next_month_color, 0, 2);
						        if  ( ($maraphon_next_month_color == '00') || ($maraphon_next_month_color == '') || ($maraphon_next_month_color == '.2') || ($maraphon_next_month_color == 'Н') ){
							        $maraphon_next_month_color_value = 'white';
						        } else {
							        $maraphon_next_month_color_value = '#ddf7c8';
						        };
						        
						        echo '<td style="width: 115px; height: 26px;">'; //9.Месяц марафона (неоплаченные заказы)
							        if ( !empty($string_report_by_period->maraphon_next_month) ) {
								    
								    $maraphon_member_month_by_month = $string_report_by_period->maraphon_member_month;
								    $maraphon_member_month_by_month = substr($maraphon_member_month_by_month, 0, 2);
									$current_year = current_time('Y');
									if ($maraphon_member_month_by_month == '') { $selected00 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '01') { $selected01 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '02') { $selected02 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '03') { $selected03 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '04') { $selected04 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '05') { $selected05 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '06') { $selected06 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '07') { $selected07 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '08') { $selected08 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '09') { $selected09 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '10') { $selected010 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '11') { $selected011 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '12') { $selected012 = 'selected="selected"'; };

							        echo '<select style="height: 26px; width: 115px; background-color: '.$maraphon_next_month_color_value.'" name="maraphon_member_month_id_'.$current_order_id_for_input.'">';
								        echo '<option '.$selected00.' value="">Не выбран</option>';
										echo '<option '.$selected01.' value="01.'.$current_year.'">Январь</option>'; 
										echo '<option '.$selected02.' value="02.'.$current_year.'">Февраль</option>'; 
										echo '<option '.$selected03.' value="03.'.$current_year.'">Март</option>'; 
										echo '<option '.$selected04.' value="04.'.$current_year.'">Апрель</option>'; 
										echo '<option '.$selected05.' value="05.'.$current_year.'">Май</option>'; 
										echo '<option '.$selected06.' value="06.'.$current_year.'">Июнь</option>'; 
										echo '<option '.$selected07.' value="07.'.$current_year.'">Июль</option>'; 
										echo '<option '.$selected08.' value="08.'.$current_year.'">Август</option>'; 
										echo '<option '.$selected09.' value="09.'.$current_year.'">Сентябрь</option>'; 
										echo '<option '.$selected010.' value="10.'.$current_year.'">Октябрь</option>'; 
										echo '<option '.$selected011.' value="11.'.$current_year.'">Ноябрь</option>';
										echo '<option '.$selected012.' value="12.'.$current_year.'">Декабрь</option>';  
									echo '</select>'; 
									
									if ($maraphon_member_month_by_month == '') { $selected00 = ''; };
									if ($maraphon_member_month_by_month == '01') { $selected01 = ''; };
									if ($maraphon_member_month_by_month == '02') { $selected02 = ''; };
									if ($maraphon_member_month_by_month == '03') { $selected03 = ''; };
									if ($maraphon_member_month_by_month == '04') { $selected04 = ''; };
									if ($maraphon_member_month_by_month == '05') { $selected05 = ''; };
									if ($maraphon_member_month_by_month == '06') { $selected06 = ''; };
									if ($maraphon_member_month_by_month == '07') { $selected07 = ''; };
									if ($maraphon_member_month_by_month == '08') { $selected08 = ''; };
									if ($maraphon_member_month_by_month == '09') { $selected09 = ''; };
									if ($maraphon_member_month_by_month == '10') { $selected010 = ''; };
									if ($maraphon_member_month_by_month == '11') { $selected011 = ''; };
									if ($maraphon_member_month_by_month == '12') { $selected012 = ''; };
							        } else {
										echo '-';
									};
						        echo '</td>';
						        
								echo '<td>'; //10. Отсрочка (неоплаченные заказы)
							      	if ( ($string_report_by_period->credit == '0') || ($string_report_by_period->credit == '') ) {				        
							        echo '<input type="checkbox" class="credit_counter" id="credit_id_'.$current_order_id_for_input.'" style="transform:scale(1.5); cursor:pointer;" name="credit_id_'.$current_order_id_for_input.'" value="1" >';
							        }	else {
								    echo '<input type="checkbox" class="credit_counter" id="credit_id_'.$current_order_id_for_input.'" style="transform:scale(1.5); cursor:pointer;" checked name="credit_id_'.$current_order_id_for_input.'" value="1"  >';
							        }
						        echo '</td>';

						        echo '<td>'; //11. Оплата (неоплаченные заказы) 
						        	$ordersByDateCount = $ordersByDateCount + 1;
							      	if ($string_report_by_period->paid == '0') {				        
							        echo '<input type="checkbox" class="paid_counter" id="paidid_id_'.$current_order_id_for_input.'" style="transform:scale(1.5); cursor:pointer;" name="paid_id_'.$current_order_id_for_input.'" value="1" >';
							        }	else {
								    echo '<input type="checkbox" class="paid_counter" id="paidid_id_'.$current_order_id_for_input.'" style="transform:scale(1.5); cursor:pointer;" checked name="paid_id_'.$current_order_id_for_input.'" value="1"  >';
								    $ordersByPeriodCount = $ordersByPeriodCount + 1;
								    $ordersByPeriodSum = $ordersByPeriodSum + $string_report_by_period->amount;
										    if ($string_report_by_period->maraphon_counter == 1) {
											$natalieMoneyCount = $natalieMoneyCount + 150;    
										    };
										   
							        	};
						        echo '</td>';
						         
						        /*if  ($string_report_by_period->paid == '0') {
							        $amount_color = 'white';
						        } else {
							        $amount_color = '#ddf7c8';
						        }*/
						        
						        $amount_color = 'white';
						        
						        $ordersByDateSum = $ordersByDateSum + $string_report_by_period->amount;
						        echo '<td>'; //12. Сумма (неоплаченные заказы)
							      echo '<input style="width:70px; height: 26px; background-color: '.$amount_color.';" class="text-input" name="amount_id_'.$current_order_id_for_input.'" type="number" id="amount_id" value="'.$string_report_by_period->amount.'" />';
						        echo '</td>';
						        
						        /*if ( ($string_report_by_period->paid == '1') && ($maraphon_next_month_color !== '00') ) {
							        $whatsapp_color = '#ddf7c8';
						        } else {
							        $whatsapp_color = 'white';
						        };*/
						        
						        $whatsapp_color = 'white';
						        
						        echo '<td>'; //13.Комментарий администратора (неоплаченные заказы)
							      echo '<input style="width: 300px; height: 26px; background-color: '.$whatsapp_color.';" class="text-input" name="admin_comment_id_'.$current_order_id_for_input.'" type="text" id="admin_comment_id" value="'.$string_report_by_period->admin_comment.'" />';
						        echo '</td>';
						        
						        echo '<td>';//14.Телефон (неоплаченные заказы)
							        $whatsapp_number = $string_report_by_period->telephone;
							        $phone= str_replace([' ', '(', ')', '-', '_'], '', $whatsapp_number);
									$phone = preg_replace('/^8/', '+7', $phone);
									$phone = preg_replace('/^7/', '+7', $phone);    
							        echo '<a href="https://api.whatsapp.com/send?phone='.$phone.'" target="_blank"><img style="width: 30px; padding-top: 5px;" src="http://maraphon.online/wp-content/uploads/whatsapp-icon-180×180.png"/></a>';	
						        echo '</td>';  

						        echo '</tr>';
							}
							echo '</table>';
							echo '<table style="border-collapse: collapse; width: 636px; font-family: kelson; font-size: 20px; margin-left: 634px; margin-top: -30px;">';
								echo '<tr>'; 
										
								echo '<td style="opacity: 0; width: 50px;">';
									echo '<input style="width:50px;" name="choose_period_by_date_month" type="number" value="'.$choose_period_by_date_month_ajax.'" />';
								echo '</td>';
										
								echo '<td style="opacity: 0; width: 50px;">';
									echo '<input style="width:50px;" name="choose_period_by_date_year" type="number" value="'.$choose_period_by_date_year.'" />';
								echo '</td>';
								
								echo '<td style="border: 3px solid black; width: 330px; text-align: center; padding-top: 3px;">';
									echo 'Всего неоплаченных заказов: '.$ordersByDateCount;
								echo '</td>';
								
								echo '<td style="border: 3px solid black; width: 200px; text-align: center; padding-top: 3px;">';
									echo 'Сумма: '.$ordersByDateSum.' р.';
								echo '</td>';
								
								echo '</tr>';
						echo '</table>';
						
		echo '<div id="success_form">Данные обновлены</div>';
 		echo '<input type="hidden" name="action" value="formOrdersByNoMoneyUpdate"/>';
		echo '<input style="margin-left: 1098px; margin-bottom: 45px; '.$check_paid_past_flag.'" type="submit" id="updateuser" class="submit button" value="Записать">';
	echo '</form>'; 

					} else {
						echo '<h2 style="font-size: 26px; margin-top: -30px; padding-bottom: 30px; text-align: center;">Нет неоплаченных заказов на '.$period_by_date.'</h2>';
					};				
	
	// Разблокировка счетчика марафона по двойному клику  (неоплаченные заказы)
	echo '<script type="text/javascript">'; 
	echo '$(function() {';
		    echo 'function maraphonCounter(){';
		      echo 'var maraphonRemoveid = this.id;';
		      echo 'var maraphonRemoveidID = "#" + maraphonRemoveid;';
		      echo '$(maraphonRemoveidID).removeAttr("readonly");';
			echo '}';
		    echo '$(".maraphon-counter").dblclick(maraphonCounter);';
		echo '});';
	echo '</script>';
	
	// Отключение возможности поставить и отсрочку и оплату, увеличение на 1
	echo '
		<script>
			$(".row_form_orders_by_date input:checkbox").click(function(){
				var idRow = this.id;
				var idRowRight = idRow.substr(10);
				var maraphon_counter_id = "#maraphon_counter_id_" + idRowRight;
				var maraphon_counter_value = $(maraphon_counter_id).val();
				var rowVar = "#row_form_orders_by_date_" + idRowRight + " input:checkbox";
				if ($(this).is(":checked")) {
					if (!$(rowVar).not(this).prop("checked")) {
						$(maraphon_counter_id).val(parseInt(maraphon_counter_value) + 1);
						} else {
							$(rowVar).not(this).prop("checked", false);
						}            	
					} else {
						$(maraphon_counter_id).val(maraphon_counter_value - 1);
				};
			});
		</script>	
	'; 
	
	// Обновление отчета по неоплаченные заказы
	echo '<script type="text/javascript">';
		echo 'jQuery("#formOrdersByNoMoney").submit(ajaxFormOrdersByCredit);';
			echo 'function ajaxFormOrdersByCredit(){';
				echo 'var formOrdersByNoMoney = jQuery(this).serialize();';
				echo '$.ajaxSetup({cache: false});';
					echo 'jQuery.ajax({';
					echo 'type:"POST",';
					echo 'url: "/wp-admin/admin-ajax.php",';
					echo 'data: formOrdersByNoMoney,';
						echo 'success:function(data){';
						echo '$("#success_form").show();';
						echo 'setTimeout(function(){$("#success_form").fadeOut("slow")},1000);';
						echo '}';
				echo '});';
			echo 'return false;';
		echo '}';
	echo '</script>';
		
		} else if ($choose_period_by_type == 'credit_order') {  //выбор условия по отсрочке
		$date_period_sql = $choose_period_by_date_month_ajax.'.'.$choose_period_by_date_year;
		$ordersByDateCount = 0;
		$ordersByDateSum = 0;
		$_monthsListPeriod = array(
								"01"=>"январь","02"=>"февраль","03"=>"март",
								"04"=>"апрель","05"=>"май", "06"=>"июнь",
								"07"=>"июль","08"=>"август","09"=>"сентябрь",
								"10"=>"октябрь","11"=>"ноябрь","12"=>"декабрь");	
	
								$choose_period_by_date_month = $_monthsListPeriod[$choose_period_by_date_month_ajax];
								$period_by_date = $choose_period_by_date_month.' '.$choose_period_by_date_year;
								$ordersByPeriodCount = 0;
								$ordersByPeriodSum = 0;		
											    
				$current_user_report = $current_user->ID;
				$this_month_report_by_period = $wpdb->get_results(
						"
						SELECT 
						orders.date AS order_date,
						orders.order_id AS order_id,
						users.ID AS user_id_check,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'telephone' limit 1) as telephone,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'first_name' limit 1) as first_name,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'last_name' limit 1) as last_name,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'maraphon_counter' limit 1) as maraphon_counter,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'town' limit 1) as town,
						orders.maraphon_next_month,
						orders.women_menu,
						orders.men_menu,
						orders.telegram,
						orders.recipe_book,
						orders.pdf,
						orders.workout,
						orders.credit,
						orders.paid,
						orders.amount,
						orders.maraphon_member_month,
						orders.admin_comment
						FROM wpux_orders orders, wpux_users users
						WHERE orders.maraphon_member_month = $date_period_sql
						AND orders.user_email = users.user_email
						AND orders.credit = '1'
						ORDER BY last_name
						"
						);	
						if( $this_month_report_by_period ) {
							
							echo '<h2 style="padding-left: 10px; margin-top: -110px;">Заказы в отсрочку на '.$period_by_date.'</h2>';
							echo '<br>';
		
							global $wpdb;
							echo '<form id="formOrdersByCredit">';  
								echo '<table class="daily_report_table_for_user" style="width: 1260px; margin-left: 10px; font-family: kelson; font-size: 18px;">';
									echo '<tr>';
										echo '<th>&nbsp;№&nbsp;</th>';
										echo '<th>Дата</th>';
										echo '<th>&nbsp;ID&nbsp;</th>';
										echo '<th>&nbsp;ФИО&nbsp;</th>';
										echo '<th>Город</th>';
										echo '<th>Заказ</th>';
										echo '<th style="width: 5%">&nbsp;<i class="fa fa-file-pdf-o" aria-hidden="true"></i>&nbsp;</th>';  
										echo '<th>№<br>&nbsp;марафона&nbsp;</th>';
										echo '<th>Месяц<br>&nbsp;марафона&nbsp;</th>';
										echo '<th style="width: 35px;">&nbsp;<div style="height:25px; width: 25px; margin-bottom: -15px; margin-top: -15px; margin-left: 5px;"><image style="" src="http://maraphon.online/wp-content/uploads/timeismoney.png" alt="Отсрочка"></image></div>&nbsp;</th>';
										echo '<th style="width: 35px;">&nbsp;<i class="fa fa-rub" aria-hidden="true"></i>&nbsp;</th>';
										echo '<th style="width: 70px;">&nbsp;Сумма&nbsp;</th>';
										echo '<th style="width: 300px;">&nbsp;Комментарий администратора&nbsp;</th>';
										echo '<th style="width: 32px;">&nbsp;<i class="fa fa-paper-plane-o" aria-hidden="true">&nbsp;</th>'; 
									echo '</tr>';
							
						    foreach ( $this_month_report_by_period as $string_report_by_period ) {
								$current_user_id_for_input = $string_report_by_period->user_id_check;
								$current_order_id_for_input = $string_report_by_period->order_id;
		
						        echo '<tr class="row_form_orders_by_date" id="row_form_orders_by_date_'.$current_order_id_for_input.'">';
						        
						        echo '<td>'; //1.Номер заказа (отсрочка)
						        echo $string_report_by_period->order_id;
						        echo '</td>';
						        
						        echo '<td>'; //2.Дата заказа (период)
						        $full_date = $string_report_by_period->order_date;
						        $day_date = substr($full_date, 8, 2);
						        $month_date = substr($full_date, 5, 2);
						        $year_date = substr($full_date, 0, 4);
						        $right_date = '&nbsp;'.$day_date.'.'.$month_date.'.'.$year_date.'&nbsp;';
						        echo ' '.$right_date.' ';
						        echo '</td>';
						        
						        echo '<td>';  //3.ID (отсрочка)
						        echo $current_user_id_for_input;
						        echo '</td>'; 
						        
						        echo '<td>'; //4.ФИО (отсрочка)
								$name = $string_report_by_period->first_name;
								$surname = $string_report_by_period->last_name;
								$fio = $surname.' '.$name;
								echo '<a href="http://maraphon.online/wp-admin/user-edit.php?user_id='.$current_user_id_for_input.'&wp_http_referer=%2Fwp-admin%2Fusers.php" target="_blank">'.$fio.'</a>';
						        echo '</td>'; 
						        
						        echo '<td>'; //.5Город (отсрочка)
						        	echo '&nbsp;'.$string_report_by_period->town.'&nbsp;';
						        echo '</td>';
						        
						        echo '<td>'; //6.Заказ (отсрочка)
							        if ( !empty($string_report_by_period->maraphon_next_month) ) {
								    	echo " - ".$string_report_by_period->maraphon_next_month."<br>";    
							        };
							        if ( !empty($string_report_by_period->women_menu) ) {
								    	echo " - женское меню ".$string_report_by_period->women_menu." ккал<br>";    
							        };
							        if ( !empty($string_report_by_period->men_menu) ) {
								    	echo " - мужское меню ".$string_report_by_period->men_menu." ккал<br>";    
							        };
							        if ( !empty($string_report_by_period->telegram) ) {
								    	echo " - ".$string_report_by_period->telegram."<br>";    
							        };
							        if ( !empty($string_report_by_period->recipe_book) ) {
								    	echo " - ".$string_report_by_period->recipe_book."<br>";    
							        };
							        if ( !empty($string_report_by_period->workout) ) {
								    	echo " - ".$string_report_by_period->workout."<br>";    
							        };
						        echo '</td>';
						        
						        echo '<td>'; //7. PDF (отсрочка)
						        		$pdf_menu_value = $string_report_by_period->pdf;
						      		    if ($pdf_menu_value == 'men_menu_pdf') { $pdf_menu_selected1 = 'selected="selected"'; $pdf_menu_color = '#ddf7c8';};
										if ($pdf_menu_value == 'women_menu_pdf') { $pdf_menu_selected2 = 'selected="selected"'; $pdf_menu_color = '#ddf7c8';};
										if ($pdf_menu_value == 'both_menu_pdf') { $pdf_menu_selected3 = 'selected="selected"'; $pdf_menu_color = '#ddf7c8';};
										if ($pdf_menu_value == 'Нет' || $pdf_menu_value == '') { $pdf_menu_selectedNo = 'selected="selected"'; $pdf_menu_color = 'white';};
								        echo '<select style="height: 26px; width: 68px; background-color: '.$pdf_menu_color.'" name="pdf_menu_id_'.$current_order_id_for_input.'">'; 
									        echo '<option '.$pdf_menu_selectedNo.' value="Нет">Нет</option>';
									        echo '<option '.$pdf_menu_selected1.' value="men_menu_pdf">Муж. меню</option>'; 
											echo '<option '.$pdf_menu_selected2.' value="women_menu_pdf">Жен. меню</option>'; 
											echo '<option '.$pdf_menu_selected3.' value="both_menu_pdf">Оба меню</option>'; 
										echo '</select>'; 
								        $pdf_menu_selected1 = '';
								        $pdf_menu_selected2 = '';
								        $pdf_menu_selected3 = '';
								        $pdf_menu_selectedNo = '';
						        echo '</td>';
						        
								echo '<td>'; //8.Номер марафона (отсрочка)
								if ( !empty($string_report_by_period->maraphon_next_month) && ($string_report_by_period->maraphon_counter !== 0) ) {								
									echo '<input style="width: 50px; height: 26px;" readonly class="maraphon-counter" id="maraphon_counter_id_'.$current_order_id_for_input.'" name="maraphon_counter_id_'.$current_order_id_for_input.'" type="number" value="'.$string_report_by_period->maraphon_counter.'" />';
								} else {
									echo '-';
								};
						        echo '</td>';
						        
						        $maraphon_next_month_color = $string_report_by_date->maraphon_member_month;
						        $maraphon_next_month_color = substr($maraphon_next_month_color, 0, 2);
						        if  ( ($maraphon_next_month_color == '00') || ($maraphon_next_month_color == '') || ($maraphon_next_month_color == '.2') || ($maraphon_next_month_color == 'Н') ){
							        $maraphon_next_month_color_value = 'white';
						        } else {
							        $maraphon_next_month_color_value = '#ddf7c8';
						        };
						        
						        echo '<td style="width: 115px; height: 26px;">'; //9.Месяц марафона (отсрочка)
							        if ( !empty($string_report_by_period->maraphon_next_month) ) {
								    
								    $maraphon_member_month_by_month = $string_report_by_period->maraphon_member_month;
								    $maraphon_member_month_by_month = substr($maraphon_member_month_by_month, 0, 2);
									$current_year = current_time('Y');
									if ($maraphon_member_month_by_month == '') { $selected00 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '01') { $selected01 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '02') { $selected02 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '03') { $selected03 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '04') { $selected04 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '05') { $selected05 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '06') { $selected06 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '07') { $selected07 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '08') { $selected08 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '09') { $selected09 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '10') { $selected010 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '11') { $selected011 = 'selected="selected"'; };
									if ($maraphon_member_month_by_month == '12') { $selected012 = 'selected="selected"'; };

							        echo '<select style="height: 26px; width: 115px; background-color: '.$maraphon_next_month_color_value.'" name="maraphon_member_month_id_'.$current_order_id_for_input.'">';
								        echo '<option '.$selected00.' value="">Не выбран</option>';
										echo '<option '.$selected01.' value="01.'.$current_year.'">Январь</option>'; 
										echo '<option '.$selected02.' value="02.'.$current_year.'">Февраль</option>'; 
										echo '<option '.$selected03.' value="03.'.$current_year.'">Март</option>'; 
										echo '<option '.$selected04.' value="04.'.$current_year.'">Апрель</option>'; 
										echo '<option '.$selected05.' value="05.'.$current_year.'">Май</option>'; 
										echo '<option '.$selected06.' value="06.'.$current_year.'">Июнь</option>'; 
										echo '<option '.$selected07.' value="07.'.$current_year.'">Июль</option>'; 
										echo '<option '.$selected08.' value="08.'.$current_year.'">Август</option>'; 
										echo '<option '.$selected09.' value="09.'.$current_year.'">Сентябрь</option>'; 
										echo '<option '.$selected010.' value="10.'.$current_year.'">Октябрь</option>'; 
										echo '<option '.$selected011.' value="11.'.$current_year.'">Ноябрь</option>';
										echo '<option '.$selected012.' value="12.'.$current_year.'">Декабрь</option>';  
									echo '</select>'; 
									
									if ($maraphon_member_month_by_month == '') { $selected00 = ''; };
									if ($maraphon_member_month_by_month == '01') { $selected01 = ''; };
									if ($maraphon_member_month_by_month == '02') { $selected02 = ''; };
									if ($maraphon_member_month_by_month == '03') { $selected03 = ''; };
									if ($maraphon_member_month_by_month == '04') { $selected04 = ''; };
									if ($maraphon_member_month_by_month == '05') { $selected05 = ''; };
									if ($maraphon_member_month_by_month == '06') { $selected06 = ''; };
									if ($maraphon_member_month_by_month == '07') { $selected07 = ''; };
									if ($maraphon_member_month_by_month == '08') { $selected08 = ''; };
									if ($maraphon_member_month_by_month == '09') { $selected09 = ''; };
									if ($maraphon_member_month_by_month == '10') { $selected010 = ''; };
									if ($maraphon_member_month_by_month == '11') { $selected011 = ''; };
									if ($maraphon_member_month_by_month == '12') { $selected012 = ''; };
							        } else {
										echo '-';
									};
						        echo '</td>';
						        
								echo '<td>'; //10. Отсрочка (отсрочка)
							      	if ( ($string_report_by_period->credit == '0') || ($string_report_by_period->credit == '') ) {				        
							        echo '<input type="checkbox" class="credit_counter" id="credit_id_'.$current_order_id_for_input.'" style="transform:scale(1.5); cursor:pointer;" name="credit_id_'.$current_order_id_for_input.'" value="1" >';
							        }	else {
								    echo '<input type="checkbox" class="credit_counter" id="credit_id_'.$current_order_id_for_input.'" style="transform:scale(1.5); cursor:pointer;" checked name="credit_id_'.$current_order_id_for_input.'" value="1"  >';
							        }
						        echo '</td>';

						        echo '<td>'; //11. Оплата (отсрочка) 
						        	$ordersByDateCount = $ordersByDateCount + 1;
							      	if ($string_report_by_period->paid == '0') {				        
							        echo '<input type="checkbox" class="paid_counter" id="paidid_id_'.$current_order_id_for_input.'" style="transform:scale(1.5); cursor:pointer;" name="paid_id_'.$current_order_id_for_input.'" value="1" >';
							        }	else {
								    echo '<input type="checkbox" class="paid_counter" id="paidid_id_'.$current_order_id_for_input.'" style="transform:scale(1.5); cursor:pointer;" checked name="paid_id_'.$current_order_id_for_input.'" value="1"  >';
								    $ordersByPeriodCount = $ordersByPeriodCount + 1;
								    $ordersByPeriodSum = $ordersByPeriodSum + $string_report_by_period->amount;
										    if ($string_report_by_period->maraphon_counter == 1) {
											$natalieMoneyCount = $natalieMoneyCount + 150;    
										    };
										   
							        	};
						        echo '</td>';
						        
						        $ordersByDateSum = $ordersByDateSum + $string_report_by_period->amount;
						        echo '<td>'; //12. Сумма (отсрочка)
							      echo '<input style="width:70px; height: 26px; background-color: white;" class="text-input" name="amount_id_'.$current_order_id_for_input.'" type="number" id="amount_id" value="'.$string_report_by_period->amount.'" />';
						        echo '</td>';
						        
						        echo '<td>'; //13.Комментарий администратора (отсрочка)
							      echo '<input style="width: 300px; height: 26px; background-color: white;" class="text-input" name="admin_comment_id_'.$current_order_id_for_input.'" type="text" id="admin_comment_id" value="'.$string_report_by_period->admin_comment.'" />';
						        echo '</td>';
						        
						        echo '<td>';//14.Телефон (отсрочка)
							        $whatsapp_number = $string_report_by_period->telephone;
							        $phone= str_replace([' ', '(', ')', '-', '_'], '', $whatsapp_number);
									$phone = preg_replace('/^8/', '+7', $phone);
									$phone = preg_replace('/^7/', '+7', $phone);    
							        echo '<a href="https://api.whatsapp.com/send?phone='.$phone.'" target="_blank"><img style="width: 30px; padding-top: 5px;" src="http://maraphon.online/wp-content/uploads/whatsapp-icon-180×180.png"/></a>';	
						        echo '</td>';  

						        echo '</tr>';
							}
							echo '</table>';
							
							echo '<table style="border-collapse: collapse; width: 606px; font-family: kelson; font-size: 20px; margin-left: 664px; margin-top: -30px;">';
								echo '<tr>'; 
										
								echo '<td style="opacity: 0; width: 50px;">';
									echo '<input style="width:50px;" name="choose_period_by_date_month" type="number" value="'.$choose_period_by_date_month_ajax.'" />';
								echo '</td>';
										
								echo '<td style="opacity: 0; width: 50px;">';
									echo '<input style="width:50px;" name="choose_period_by_date_year" type="number" value="'.$choose_period_by_date_year.'" />';
								echo '</td>';
								
								echo '<td style="border: 3px solid black; width: 300px; text-align: center; padding-top: 3px;">';
									echo 'Всего заказов в отсрочку: '.$ordersByDateCount;
								echo '</td>';
								
								echo '<td style="border: 3px solid black; width: 200px; text-align: center; padding-top: 3px;">';
									echo 'Сумма: '.$ordersByDateSum.' р.';
								echo '</td>';
								
								echo '</tr>';
							echo '</table>';
						
			echo '<div id="success_form">Данные обновлены</div>';
	 		echo '<input type="hidden" name="action" value="formOrdersByCreditUpdate"/>';
			echo '<input style="margin-left: 1098px; margin-bottom: 45px; '.$check_paid_past_flag.'" type="submit" id="updateuser" class="submit button" value="Записать">';
		echo '</form>'; 	
							} else {
								echo '<h2 style="font-size: 26px; margin-top: -30px; padding-bottom: 30px; text-align: center;">Нет заказов в отсрочку на '.$period_by_date.'</h2>';
							};		
	
	// Разблокировка счетчика марафона по двойному клику  (отсрочка)
	echo '<script type="text/javascript">'; 
	echo '$(function() {';
		    echo 'function maraphonCounter(){';
		      echo 'var maraphonRemoveid = this.id;';
		      echo 'var maraphonRemoveidID = "#" + maraphonRemoveid;';
		      echo '$(maraphonRemoveidID).removeAttr("readonly");';
			echo '}';
		    echo '$(".maraphon-counter").dblclick(maraphonCounter);';
		echo '});';
	echo '</script>';
	
	// Отключение возможности поставить и отсрочку и оплату, увеличение на 1
	echo '
		<script>
			$(".row_form_orders_by_date input:checkbox").click(function(){
				var idRow = this.id;
				var idRowRight = idRow.substr(10);
				var maraphon_counter_id = "#maraphon_counter_id_" + idRowRight;
				var maraphon_counter_value = $(maraphon_counter_id).val();
				var rowVar = "#row_form_orders_by_date_" + idRowRight + " input:checkbox";
				if ($(this).is(":checked")) {
					if (!$(rowVar).not(this).prop("checked")) {
						$(maraphon_counter_id).val(parseInt(maraphon_counter_value) + 1);
						} else {
							$(rowVar).not(this).prop("checked", false);
						}            	
					} else {
						$(maraphon_counter_id).val(maraphon_counter_value - 1);
				};
			});
		</script>	
	'; 
	
	// Обновление отчета по отсрочке	
	echo '<script type="text/javascript">';
		echo 'jQuery("#formOrdersByCredit").submit(ajaxFormOrdersByCredit);';
			echo 'function ajaxFormOrdersByCredit(){';
				echo 'var formOrdersByCredit = jQuery(this).serialize();';
				echo '$.ajaxSetup({cache: false});';
					echo 'jQuery.ajax({';
					echo 'type:"POST",';
					echo 'url: "/wp-admin/admin-ajax.php",';
					echo 'data: formOrdersByCredit,';
						echo 'success:function(data){';
						echo '$("#success_form").show();';
						echo 'setTimeout(function(){$("#success_form").fadeOut("slow")},1000);';
						echo '}';
				echo '});';
			echo 'return false;';
		echo '}';
	echo '</script>';
		
		
		} else if ($choose_period_by_type == 'menu_order') {  //начало условия при выборе продажи меню
		
		$date_from = $choose_period_by_date_year.'-'.$choose_period_by_date_month_ajax.'-01';
		$date_before = $choose_period_by_date_year.'-'.$choose_period_by_date_month_ajax.'-31';
			
		$_monthsListPeriod = array(
								"01"=>"январь","02"=>"февраль","03"=>"март",
								"04"=>"апрель","05"=>"май", "06"=>"июнь",
								"07"=>"июль","08"=>"август","09"=>"сентябрь",
								"10"=>"октябрь","11"=>"ноябрь","12"=>"декабрь");	
								
								$choose_period_by_date_month = $_monthsListPeriod[$choose_period_by_date_month_ajax];
								$period_by_date = $choose_period_by_date_month.' '.$choose_period_by_date_year;
								$ordersByDateCount = 0;
								$ordersByDateSum = 0;
								$ordersByMenuCount = 0;
								$ordersByMenuSum = 0;
								$ordersByMenMenuCount = 0;
								$ordersByMenMenuSum = 0;
								
		echo '<h2 class="paid_by_date_h2">Продажи за '.$period_by_date.'</h2>';
		echo '<br>';
		
		global $wpdb;
					echo '<form id="formOrdersByMenu">';
							echo '<input type="hidden" name="action" value="formOrdersByMenuUpdate"/>';
							echo '<input style="position: absolute; margin-left: 885px; margin-top: -66px; '.$check_paid_past_flag.'" type="submit" id="updateuser" class="submit button members_mobile_hide" value="Записать">';
					echo '<table class="paid_table_for_admin">';
						echo '<tr style="background-color: #f6f6f6;">';
							echo '<th>&nbsp;№&nbsp;</th>';
							echo '<th style="width: 8%">Дата</th>';
							echo '<th>&nbsp;ID&nbsp;</th>';
							echo '<th>&nbsp;ФИО&nbsp;</th>';
							echo '<th style="width: 16%">Заказ</th>';
							echo '<th style="width: 12%">Доступ до</th>';
							echo '<th style="width: 5%">&nbsp;<i class="fa fa-file-pdf-o" aria-hidden="true"></i>&nbsp;</th>';
							echo '<th style="width: 35px;">&nbsp;<div style="height:25px; width: 25px; margin-bottom: -15px; margin-top: -15px; margin-left: 5px;"><image style="" src="http://maraphon.online/wp-content/uploads/timeismoney.png" alt="Отсрочка"></image></div>&nbsp;</th>';
							echo '<th style="width: 35px;">&nbsp;<i class="fa fa-rub" aria-hidden="true"></i>&nbsp;</th>';
							echo '<th style="width: 70px;">&nbsp;Сумма&nbsp;</th>';
							echo '<th class="members_mobile_hide" style="width: 300px;">&nbsp;Комментарий администратора&nbsp;</th>';
							echo '<th style="width: 35px;">&nbsp;<i class="fa fa-paper-plane-o" aria-hidden="true">&nbsp;</th>'; 
						echo '</tr>';
			    
				$current_user_report = $current_user->ID;
				$this_month_report_by_date = $wpdb->get_results(
						"
						SELECT 
						orders.date AS order_date,
						orders.order_id AS order_id,
						users.ID AS user_id_check,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'telephone' limit 1) as telephone,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'first_name' limit 1) as first_name,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'last_name' limit 1) as last_name,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'men_menu_lk' limit 1) as men_menu_lk,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'women_menu_lk' limit 1) as women_menu_lk,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'recipe_book_lk' limit 1) as recipe_book_lk,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'telegram_lk' limit 1) as telegram_lk,
						orders.maraphon_next_month,
						orders.women_menu,
						orders.men_menu,
						orders.telegram,
						orders.recipe_book,
						orders.pdf,
						orders.workout,
						orders.time,
						orders.credit,
						orders.paid,
						orders.amount,
						orders.maraphon_member_month,
						orders.admin_comment
						FROM wpux_orders orders, wpux_users users
						WHERE (DATE(orders.date) BETWEEN '$date_from' AND '$date_before')
						AND (orders.men_menu != '' OR orders.women_menu != '' OR orders.recipe_book != '' OR orders.telegram != '')
						AND orders.user_email = users.user_email 
						ORDER BY orders.order_id DESC
						"
						);	
				if( $this_month_report_by_date ) {
						    foreach ( $this_month_report_by_date as $string_report_by_date ) {
								$current_user_id_for_input = $string_report_by_date->user_id_check;
								$current_order_id_for_input = $string_report_by_date->order_id;
								
						        echo '<tr class="row_form_orders_by_date" id="row_form_orders_by_date_'.$current_order_id_for_input.'">';
						        
						        echo '<td>'; //1.Номер заказа (продажи)
						        echo $string_report_by_date->order_id;
						        echo '</td>';
						        
						        echo '<td>'; //2.Дата заказа (продажи)
						        $full_date = $string_report_by_date->order_date;
						        $day_date = substr($full_date, 8, 2);
						        $month_date = substr($full_date, 5, 2);
						        $year_date = substr($full_date, 0, 4);
						        $right_date = '&nbsp;'.$day_date.'.'.$month_date.'.'.$year_date.'&nbsp;';
						        echo ' '.$right_date.' ';
						        echo '</td>';
						        
						        echo '<td>';  //3.ID (продажи)
						        echo $current_user_id_for_input;
						        echo '</td>'; 
						        
						        echo '<td>'; //4.ФИО (продажи)
								$name = $string_report_by_date->first_name;
								$surname = $string_report_by_date->last_name;
								$fio = $surname.' '.$name;
								echo '<a href="http://maraphon.online/wp-admin/user-edit.php?user_id='.$current_user_id_for_input.'&wp_http_referer=%2Fwp-admin%2Fusers.php" target="_blank">'.$fio.'</a>';
						        echo '</td>'; 
						        
						        echo '<td>'; //5.Заказ (продажи)
							        if ( !empty($string_report_by_date->maraphon_next_month) ) {
								    	echo " - ".$string_report_by_date->maraphon_next_month."<br>";    
							        };
							        if ( !empty($string_report_by_date->women_menu) ) {
								    	echo " - женское меню<br>";    
							        };
							        if ( !empty($string_report_by_date->men_menu) ) {
								    	echo " - мужское меню<br>";    
							        };
							        if ( !empty($string_report_by_date->telegram) ) {
								    	echo " - подписка на Telegram<br>";    
							        };
							        if ( !empty($string_report_by_date->recipe_book) ) {
								    	echo " - книга рецептов<br>";    
							        };
							        if ( !empty($string_report_by_date->workout) ) {
								    	echo " - тренировки в зале<br>";    
							        };
						        echo '</td>';
						        
						        echo '<td>'; //6. Доступ до (продажи)
						        	if (!empty($string_report_by_date->recipe_book) || !empty($string_report_by_date->telegram)){
							        	echo '-';
						        	} else if ($string_report_by_date->time == '0') {
							        	echo 'Доступ закрыт';
						        	} else {
									$access_time = $string_report_by_date->time + 60*60*7;
									echo date('d.m.Y H:i:s',$access_time);
									};
						        echo '</td>';
						        
						        echo '<td>'; //6. PDF (продажи)
						        		$pdf_menu_value = $string_report_by_date->pdf;
						      		    if ($pdf_menu_value == 'men_menu_pdf') { $pdf_menu_selected1 = 'selected="selected"'; $pdf_menu_color = '#ddf7c8';};
										if ($pdf_menu_value == 'women_menu_pdf') { $pdf_menu_selected2 = 'selected="selected"'; $pdf_menu_color = '#ddf7c8';};
										if ($pdf_menu_value == 'both_menu_pdf') { $pdf_menu_selected3 = 'selected="selected"'; $pdf_menu_color = '#ddf7c8';};
										if ($pdf_menu_value == 'Нет' || $pdf_menu_value == '') { $pdf_menu_selectedNo = 'selected="selected"'; $pdf_menu_color = 'white';};
								        echo '<select style="height: 26px; width: 68px; background-color: '.$pdf_menu_color.'" name="pdf_menu_id_'.$current_order_id_for_input.'">'; 
									        echo '<option '.$pdf_menu_selectedNo.' value="Нет">Нет</option>';
									        echo '<option '.$pdf_menu_selected1.' value="men_menu_pdf">Муж. меню</option>'; 
											echo '<option '.$pdf_menu_selected2.' value="women_menu_pdf">Жен. меню</option>'; 
											echo '<option '.$pdf_menu_selected3.' value="both_menu_pdf">Оба меню</option>'; 
										echo '</select>'; 
								        $pdf_menu_selected1 = '';
								        $pdf_menu_selected2 = '';
								        $pdf_menu_selected3 = '';
								        $pdf_menu_selectedNo = '';
						        echo '</td>';   
						        
						        echo '<td>'; //7.  Отсрочка  (продажи)
							      	if ( ($string_report_by_date->credit == '0') || ($string_report_by_date->credit == '') ) {				        
							        echo '<input type="checkbox" class="credit_counter" id="credit_id_'.$current_order_id_for_input.'" style="transform:scale(1.5); cursor:pointer;" name="credit_id_'.$current_order_id_for_input.'" value="1" >';
							        }	else {
								    echo '<input type="checkbox" class="credit_counter" id="credit_id_'.$current_order_id_for_input.'" style="transform:scale(1.5); cursor:pointer;" checked name="credit_id_'.$current_order_id_for_input.'" value="1"  >';
							        }
						        echo '</td>';
						        
						        echo '<td>'; //8.  Оплата (продажи)
						        	$ordersByDateCount = $ordersByDateCount + 1;  
							      	if ($string_report_by_date->paid == '0') {				        
							        echo '<input type="checkbox" class="paid_counter" id="paidid_id_'.$current_order_id_for_input.'" style="transform:scale(1.5); cursor:pointer;" name="paid_id_'.$current_order_id_for_input.'" value="1" >';
							        }	else {
								    echo '<input type="checkbox" class="paid_counter" id="paidid_id_'.$current_order_id_for_input.'" style="transform:scale(1.5); cursor:pointer;" checked name="paid_id_'.$current_order_id_for_input.'" value="1"  >';
								    $ordersByMenuCount = $ordersByMenuCount + 1;
								    $ordersByMenuSum = $ordersByMenuSum + $string_report_by_date->amount;
								    if ( !empty($string_report_by_date->men_menu) ) {
									    $ordersByMenMenuSum = $ordersByMenMenuSum + $string_report_by_date->amount;
									    };

							        }
						        echo '</td>';
						         
						        if  ($string_report_by_date->paid == '1' || $string_report_by_date->credit == '1') {
							        $amount_color = '#ddf7c8';
						        } else {
							        $amount_color = 'white';
						        }
						        
						        $ordersByDateSum = $ordersByDateSum + $string_report_by_period->amount;						        
						        echo '<td>'; //9.Сумма (продажи)
						          $ordersByDateSum = $ordersByDateSum + $string_report_by_date->amount;
							      echo '<input style="width:70px; height: 26px; background-color: '.$amount_color.';" class="text-input" name="amount_id_'.$current_order_id_for_input.'" type="number" id="amount_id" value="'.$string_report_by_date->amount.'" />';
						        echo '</td>';
						        
						        if ( ($string_report_by_date->paid == '1' || $string_report_by_date->credit == '1') && ($maraphon_next_month_color !== '00') ) {
							        $whatsapp_color = '#ddf7c8';
						        } else {
							        $whatsapp_color = 'white';
						        };
						        
						        echo '<td class="members_mobile_hide">'; //10.Комментарий администратора (продажи)
							      echo '<input style="width: 300px; height: 26px; background-color: '.$whatsapp_color.';" class="text-input" name="admin_comment_id_'.$current_order_id_for_input.'" type="text" id="admin_comment_id" value="'.$string_report_by_date->admin_comment.'" />';
						        echo '</td>';
						        
						        echo '<td>';//11.Телефон (продажи)
							        $whatsapp_number = $string_report_by_date->telephone;
							        $phone= str_replace([' ', '(', ')', '-', '_'], '', $whatsapp_number);
									$phone = preg_replace('/^8/', '+7', $phone);
									$phone = preg_replace('/^7/', '+7', $phone);    
							        echo '<a href="https://api.whatsapp.com/send?phone='.$phone.'" target="_blank"><img style="width: 30px; padding-top: 5px;" src="http://maraphon.online/wp-content/uploads/whatsapp-icon-180×180.png"/></a>';	
						        echo '</td>';  

						        echo '</tr>';
							}
							}			
		echo '</table>';
		
						echo '<table class="paid_paid_result_table">';
								echo '<tr>'; 
										
								echo '<td style="opacity: 0; width: 50px;">';
									echo '<input style="width:50px;" name="choose_period_by_date_month" type="number" value="'.$choose_period_by_date_month_ajax.'" />';
								echo '</td>';
										
								echo '<td style="opacity: 0; width: 50px;">';
									echo '<input style="width:50px;" name="choose_period_by_date_year" type="number" value="'.$choose_period_by_date_year.'" />';
								echo '</td>';
								
								$natalieMoneyCount = $ordersByMenuSum * 0.2;
								
								echo '<td style="border: 3px solid black; width: 180px; text-align: center; padding-top: 3px;">';
									echo 'Наталья: '.$natalieMoneyCount.' р.';
									echo '<br>Дмитрий:  '.$ordersByMenMenuSum * 0.8.' р.';
								echo '</td>';
								
								echo '<td style="border: 3px solid black; width: 194px; text-align: center; padding-top: 3px;">';
									echo 'Всего заказов: '.$ordersByDateCount;
								echo '</td>';
								
								echo '<td style="border: 3px solid black; width: 180px; text-align: center; padding-top: 3px;">';
									echo 'Сумма: '.$ordersByDateSum.' р.';
								echo '</td>';
								
								echo '<td style="border: 3px solid black; width: 240px; text-align: center; padding-top: 3px;">';
									echo 'Оплаченные заказы: '.$ordersByMenuCount;
								echo '</td>';
								
								echo '<td style="border: 3px solid black; width: 329px; text-align: center; padding-top: 3px;">';
									echo 'Оплачено, сумма: '.$ordersByMenuSum.' р.';
								echo '</td>';
								
								echo '</tr>';
						echo '</table>';

						
		echo '<div id="success_form">Данные обновлены</div>';
		
		echo '<input type="hidden" name="action" value="formOrdersByMenuUpdate"/>';
		echo '<input style="margin-bottom: 40px;"'.$check_paid_past_flag.'" type="submit" id="updateuser" class="submit button paid_button" value="Записать">';
	echo '</form>'; 
		
	// Отключение возможности поставить и отсрочку и оплату, увеличение на 1
	echo '
		<script>
			$(".row_form_orders_by_date input:checkbox").click(function(){
				var idRow = this.id;
				var idRowRight = idRow.substr(10);
				var maraphon_counter_id = "#maraphon_counter_id_" + idRowRight;
				var maraphon_counter_value = $(maraphon_counter_id).val();
				var rowVar = "#row_form_orders_by_date_" + idRowRight + " input:checkbox";
				if ($(this).is(":checked")) {
					if (!$(rowVar).not(this).prop("checked")) {
						
						} else {
							$(rowVar).not(this).prop("checked", false);
						}            	
					} else {
						
				};
			});
		</script>	
	'; 
	
	
	echo '<script type="text/javascript">';
	echo 'jQuery("#formOrdersByMenu").submit(ajaxFormOrdersByMenu);';
		echo 'function ajaxFormOrdersByMenu(){';
			echo 'var formOrdersByMenu = jQuery(this).serialize();';
			echo '$.ajaxSetup({cache: false});';
				echo 'jQuery.ajax({';
				echo 'type:"POST",';
				echo 'url: "/wp-admin/admin-ajax.php",';
				echo 'data: formOrdersByMenu,';
					echo 'success:function(data){';
					echo '$("#success_form").show();';
					echo 'setTimeout(function(){$("#success_form").fadeOut("slow")},1000);';
					echo '}';
				echo '});';
			echo 'return false;';
		echo '}';
	echo '</script>';	
		
		} else if ($choose_period_by_type == 'lost_order') {  																//начало условия при выборе "Потерявшиеся клиенты"
			
		$lost_by_maraphone_period = $choose_period_by_date_month_ajax.'.'.$choose_period_by_date_year;
		$lost_next_month = $choose_period_by_date_month_ajax + 1 > 12 ? '1' : $choose_period_by_date_month_ajax + 1;
		$lost_next_month = $lost_next_month < 10 ? '0'.$lost_next_month : $lost_next_month;
		$lost_next_year = $choose_period_by_date_month_ajax + 1 > 12 ? $choose_period_by_date_year + 1 : $choose_period_by_date_year;
		$lost_by_maraphone_period_next = $lost_next_month.'.'.$lost_next_year;
		$lost_by_date = $choose_period_by_date_year.'-'.$choose_period_by_date_month_ajax.'-01';
			
		$_monthsListPeriod = array(
								"01"=>"январь","02"=>"февраль","03"=>"март",
								"04"=>"апрель","05"=>"май", "06"=>"июнь",
								"07"=>"июль","08"=>"август","09"=>"сентябрь",
								"10"=>"октябрь","11"=>"ноябрь","12"=>"декабрь");	
								
								$choose_period_by_date_month = $_monthsListPeriod[$choose_period_by_date_month_ajax];
								$period_by_date = $choose_period_by_date_month.' '.$choose_period_by_date_year;
								
		echo '<h2 class="paid_by_date_h2">Потерянные клиенты, '.$period_by_date.'</h2>';
		echo '<br>';
		
		global $wpdb;
					echo '<form id="formOrdersByLost">';
							echo '<input type="hidden" name="action" value="formOrdersByLostUpdate"/>';
							echo '<input style="position: absolute; margin-left: 885px; margin-top: -66px; '.$check_paid_past_flag.'" type="submit" id="updateuser" class="submit button members_mobile_hide" value="Записать">';
					echo '<table class="paid_table_for_admin">';
						echo '<tr style="background-color: #f6f6f6;">';
							echo '<th>&nbsp;№&nbsp;</th>';
							//echo '<th>&nbsp;ID&nbsp;</th>';
							echo '<th>&nbsp;ФИО&nbsp;</th>';
							echo '<th>Дата последнего заказа</th>';
							echo '<th>Последний заказ</th>';
							echo '<th>Последний марафон</th>';
							echo '<th class="members_mobile_hide" style="width: 300px;">&nbsp;Комментарий администратора&nbsp;</th>';
							echo '<th style="width: 35px;">&nbsp;<i class="fa fa-paper-plane-o" aria-hidden="true">&nbsp;</th>'; 
						echo '</tr>';
			    
				$current_user_report = $current_user->ID;
				$lost_number = 1;
				$this_month_report_by_date = $wpdb->get_results(
						"
						SELECT 
								orders.order_id AS order_id,
						        users.ID AS user_id,
						        (select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'first_name' limit 1) as first_name,
						        (select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'last_name' limit 1) as last_name,
						        
						        (select orders.date from wpux_orders orders where user_id = users.ID and orders.date = (
								SELECT MAX(DATE) FROM wpux_orders B WHERE orders.user_id = B.user_id)) as last_order_date,
						        
						        (select orders.maraphon_next_month from wpux_orders orders 
						         where user_id = users.ID and orders.date = (
								SELECT MAX(DATE) FROM wpux_orders B WHERE orders.user_id = B.user_id)) as last_maraphone_order,
						        
						        (select orders.women_menu from wpux_orders orders 
						         where user_id = users.ID and orders.date = (
								SELECT MAX(DATE) FROM wpux_orders B WHERE orders.user_id = B.user_id)) as last_women_menu_order,
						        
						        (select orders.men_menu from wpux_orders orders 
						         where user_id = users.ID and orders.date = (
								SELECT MAX(DATE) FROM wpux_orders B WHERE orders.user_id = B.user_id)) as last_men_menu_order,
						        
						        (select orders.recipe_book from wpux_orders orders 
						         where user_id = users.ID and orders.date = (
								SELECT MAX(DATE) FROM wpux_orders B WHERE orders.user_id = B.user_id)) as last_recipe_book_order,
						        
						        (select orders.maraphon_member_month from wpux_orders orders 
						         where user_id = users.ID and orders.maraphon_member_month = (
								SELECT MAX(maraphon_member_month) FROM wpux_orders B WHERE orders.user_id = B.user_id)) as last_maraphone,
						        
						        orders.admin_comment,
						    	(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'telephone' limit 1) as telephone
						    
						    FROM wpux_users users, wpux_orders orders
							WHERE orders.user_email = users.user_email
						    AND 
						    NOT EXISTS ( 
						    SELECT orders.maraphon_member_month 
						    FROM wpux_orders orders 
						    WHERE orders.user_id = users.ID 
						    AND (orders.maraphon_member_month = '$lost_by_maraphone_period' OR orders.maraphon_member_month = '$lost_by_maraphone_period_next' OR orders.date > '$lost_by_date')
						    )
						    GROUP BY users.ID
						    ORDER BY last_maraphone DESC
						"
						);	
						if( $this_month_report_by_date ) {
						    foreach ( $this_month_report_by_date as $string_report_by_date ) {
								$current_user_id_for_input = $string_report_by_date->user_id;
								$current_order_id_for_input = $string_report_by_date->order_id;
								
						        echo '<tr class="row_form_orders_by_date" id="row_form_orders_by_date_'.$current_order_id_for_input.'">';
								
								echo '<td>';  //1.№
						        echo $lost_number;
						        $lost_number = $lost_number + 1;
						        echo '</td>';
								
						       /* echo '<td class="members_mobile_hide">';  //2.ID
						        echo $current_user_id_for_input;
						        echo '</td>';  */
						        
						        echo '<td>'; //3.ФИО
								$name = $string_report_by_date->first_name;
								$surname = $string_report_by_date->last_name;
								$fio = $surname.' '.$name;
								echo '<a href="http://maraphon.online/wp-admin/user-edit.php?user_id='.$current_user_id_for_input.'&wp_http_referer=%2Fwp-admin%2Fusers.php" target="_blank">'.$fio.'</a>';
						        echo '</td>';
						        
						        echo '<td>'; //4.Дата последнего заказа
						        $full_date = $string_report_by_date->last_order_date;
						        $day_date = substr($full_date, 8, 2);
						        $month_date = substr($full_date, 5, 2);
						        $year_date = substr($full_date, 0, 4);
						        $right_date = '&nbsp;'.$day_date.'.'.$month_date.'.'.$year_date.'&nbsp;';
						        echo ' '.$right_date.' ';
						        echo '</td>';
						        
						        echo '<td>'; //5.Последний заказ
							        if ( !empty($string_report_by_date->last_maraphone_order) ) {
								    	echo " - ".$string_report_by_date->last_maraphone_order."<br>";    
							        };
							        if ( !empty($string_report_by_date->last_women_menu_order) ) {
								    	echo " - женское меню<br>";    
							        };
							        if ( !empty($string_report_by_date->last_men_menu_order) ) {
								    	echo " - мужское меню<br>";    
							        };
							        if ( !empty($string_report_by_date->last_telegram_order) ) {
								    	echo " - подписка на Telegram<br>";    
							        };
							        if ( !empty($string_report_by_date->last_recipe_book_order) ) {
								    	echo " - книга рецептов<br>";    
							        };
							        if ( !empty($string_report_by_date->last_workout_order) ) {
								    	echo " - тренировки в зале<br>";    
							        };
						        echo '</td>';
						        						        
								echo '<td>'; //6.Последний марафон
								if ( !empty($string_report_by_date->last_maraphone) ) {								
									echo $string_report_by_date->last_maraphone;
								} else {
									echo '-';
								};
						        echo '</td>';
						        						        
						        echo '<td class="members_mobile_hide">'; //7.Комментарий администратора
							      echo '<input style="width: 300px; height: 26px; background-color: '.$whatsapp_color.';" class="text-input" name="admin_comment_id_'.$current_order_id_for_input.'" type="text" id="admin_comment_id" value="'.$string_report_by_date->admin_comment.'" />';
						        echo '</td>';
						        
						        echo '<td>';//8.Телефон
							        $whatsapp_number = $string_report_by_date->telephone;
							        $phone= str_replace([' ', '(', ')', '-', '_'], '', $whatsapp_number);
									$phone = preg_replace('/^8/', '+7', $phone);
									$phone = preg_replace('/^7/', '+7', $phone);    
							        echo '<a href="https://api.whatsapp.com/send?phone='.$phone.'" target="_blank"><img style="width: 30px; padding-top: 5px;" src="http://maraphon.online/wp-content/uploads/whatsapp-icon-180×180.png"/></a>';	
						        echo '</td>';  

						        echo '</tr>';
							};
							};			
		echo '</table>';
		
								echo '<input style="width:50px; position: absolute; opacity: 0; margin-left: 100px;" name="choose_period_by_date_month" type="number" value="'.$choose_period_by_date_month_ajax.'" />';
								echo '<input style="width:50px; position: absolute; opacity: 0; margin-left: 100px;" name="choose_period_by_date_year" type="number" value="'.$choose_period_by_date_year.'" />';

				echo '<div id="success_form">Данные обновлены</div>';
		
		echo '<input type="hidden" name="action" value="formOrdersByLostUpdate"/>';
		echo '<input style="margin-bottom: 40px;"'.$check_paid_past_flag.'" type="submit" id="updateuser" class="submit button paid_button" value="Записать">';
	echo '</form>'; 
	
	echo '<script type="text/javascript">';
	echo 'jQuery("#formOrdersByLost").submit(ajaxformOrdersByLost);';
		echo 'function ajaxformOrdersByLost(){';
			echo 'var formOrdersByLost = jQuery(this).serialize();';
			echo '$.ajaxSetup({cache: false});';
				echo 'jQuery.ajax({';
				echo 'type:"POST",';
				echo 'url: "/wp-admin/admin-ajax.php",';
				echo 'data: formOrdersByLost,';
					echo 'success:function(data){';
					echo '$("#success_form").show();';
					echo 'setTimeout(function(){$("#success_form").fadeOut("slow")},1000);';
					echo '}';
				echo '});';
			echo 'return false;';
		echo '}';
	echo '</script>';	
	
	} else if ($choose_period_by_type == 'workout_order') {  															//начало условия при выборе "Продажи тренировок"
		$workout_order_period_start = $choose_period_by_date_year.'-'.$choose_period_by_date_month_ajax.'-01';
		$workout_order_period_finish = $choose_period_by_date_year.'-'.$choose_period_by_date_month_ajax.'-31';
			
		$_monthsListPeriod = array(
								"01"=>"январь","02"=>"февраль","03"=>"март",
								"04"=>"апрель","05"=>"май", "06"=>"июнь",
								"07"=>"июль","08"=>"август","09"=>"сентябрь",
								"10"=>"октябрь","11"=>"ноябрь","12"=>"декабрь");	
								
								$choose_period_by_date_month = $_monthsListPeriod[$choose_period_by_date_month_ajax];
								$period_by_date = $choose_period_by_date_month.' '.$choose_period_by_date_year;
								
		echo '<h2 class="paid_by_date_h2">Продажи тренировок, '.$period_by_date.'</h2>';
		echo '<br>';
		
		global $wpdb;
			$current_user = wp_get_current_user();
			$user_id = $current_user->ID;
			$ordersByWorkoutCount = 0;
			$ordersByWorkoutSum = 0;
			$ordersByWorkoutPaidCount = 0;
			$ordersByWorkoutPaidSum = 0;
			$workout_order_array = $wpdb->get_results( 
			"
			SELECT * 
			FROM wpux_orders_workout orders_workout
			WHERE (DATE(orders_workout.date) BETWEEN '$workout_order_period_start' AND '$workout_order_period_finish')
			ORDER BY orders_workout.order_id DESC
	        "
	        );
	        if( $workout_order_array ) {
					echo '<form id="formOrdersByWorkout">';
							echo '<input type="hidden" name="action" value="formOrdersByWorkoutUpdate"/>';
							echo '<input style="position: absolute; margin-left: 885px; margin-top: -66px; '.$check_paid_past_flag.'" type="submit" id="updateuser" class="submit button members_mobile_hide" value="Записать">';
							
					echo '<table class="paid_table_for_admin">';
						echo '<tr style="background-color: #f6f6f6;">';
							echo '<th>&nbsp;№&nbsp;</th>';
							echo '<th>Дата</th>';
							echo '<th>&nbsp;ID&nbsp;</th>';
							echo '<th>&nbsp;ФИО&nbsp;</th>';
							echo '<th>&nbsp;Заказ&nbsp;</th>';
							echo '<th class="members_mobile_hide">&nbsp;&nbsp;1&nbsp;&nbsp;</th>';
				        	echo '<th class="members_mobile_hide">&nbsp;&nbsp;2&nbsp;&nbsp;</th>';
				        	echo '<th class="members_mobile_hide">&nbsp;&nbsp;3&nbsp;&nbsp;</th>';
				        	echo '<th class="members_mobile_hide">&nbsp;&nbsp;4&nbsp;&nbsp;</th>';
				        	echo '<th class="members_mobile_hide">&nbsp;&nbsp;5&nbsp;&nbsp;</th>';
				        	echo '<th class="members_mobile_hide">&nbsp;&nbsp;6&nbsp;&nbsp;</th>';
				        	echo '<th class="members_mobile_hide">&nbsp;&nbsp;7&nbsp;&nbsp;</th>';
				        	echo '<th class="members_mobile_hide">&nbsp;&nbsp;8&nbsp;&nbsp;</th>';
				        	echo '<th class="members_mobile_hide">&nbsp;&nbsp;9&nbsp;&nbsp;</th>';
				        	echo '<th class="members_mobile_hide" style="padding: 0 2px 0 2px;">&nbsp;10&nbsp;</th>';
				        	echo '<th style="padding: 0 10px 0 10px;"><i class="fa fa-rub" aria-hidden="true"></i></th>';
							echo '<th>&nbsp;Сумма&nbsp;</th>';
							echo '<th class="members_mobile_hide" style="width: 300px;">&nbsp;Комментарий администратора&nbsp;</th>';
							echo '<th style="width: 35px;">&nbsp;<i class="fa fa-paper-plane-o" aria-hidden="true">&nbsp;</th>'; 
						echo '</tr>';
			    foreach ( $workout_order_array as $string_orders_workout ) {
					echo '<tr>';
						echo '<td>';
							$current_order_id = $string_orders_workout->order_id;
							echo $current_order_id;
							$ordersByWorkoutCount = $ordersByWorkoutCount + 1;
						echo '</td>';
						echo '<td>';
							 $full_date = $string_orders_workout->date;
						     $day_date = substr($full_date, 8, 2);
						     $month_date = substr($full_date, 5, 2);
						     $year_date = substr($full_date, 0, 4);
						     $right_date = '&nbsp;'.$day_date.'.'.$month_date.'.'.$year_date.'&nbsp;';
						     echo ' '.$right_date.' ';
						echo '</td>';
						echo '<td>';
							$current_user_id = $string_orders_workout->user_id;
							echo $current_user_id;
						echo '</td>';
						echo '<td>';
							$name = $string_orders_workout->first_name;
							$surname = $string_orders_workout->last_name;
							$fio = $surname.' '.$name;
							echo '<a href="http://maraphon.online/wp-admin/user-edit.php?user_id='.$current_user_id.'&wp_http_referer=%2Fwp-admin%2Fusers.php" target="_blank">'.$fio.'</a>';
						echo '</td>';
						echo '<td>';
							echo $string_orders_workout->content;
						echo '</td>';
						
								$check_what_workout_already_bought_by_user = $wpdb->get_results(
								"
								SELECT
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
								FROM wpux_orders_workout orders_workout
					            WHERE orders_workout.user_id = $current_user_id
					            AND orders_workout.paid = 1
								"	
								);
								
								if ($check_what_workout_already_bought_by_user) {
									foreach ($check_what_workout_already_bought_by_user as $already_bought_workout_string) {
										if ($already_bought_workout_string->class_1) {$already_class_1 = 1;};
										if ($already_bought_workout_string->class_2) {$already_class_2 = 1;};
										if ($already_bought_workout_string->class_3) {$already_class_3 = 1;};
										if ($already_bought_workout_string->class_4) {$already_class_4 = 1;};
										if ($already_bought_workout_string->class_5) {$already_class_5 = 1;};
										if ($already_bought_workout_string->class_6) {$already_class_6 = 1;};
										if ($already_bought_workout_string->class_7) {$already_class_7 = 1;};
										if ($already_bought_workout_string->class_8) {$already_class_8 = 1;};
										if ($already_bought_workout_string->class_9) {$already_class_9 = 1;};
										if ($already_bought_workout_string->class_10) {$already_class_10 = 1;};
									};
								};
						
						echo '<td class="members_mobile_hide">';
							if ($string_orders_workout->class_1 == 1) {
								echo '<input type="checkbox" class="paid_counter" style="transform: scale(1.5);cursor: pointer;" checked></i>';	
							} else if ($already_class_1 == 1) {
								echo '<div style="padding-top: 5px"></div>';
								echo '<i class="fa fa-check-square-o" aria-hidden="true"></i>';
							};
						echo '</td>';
						echo '<td class="members_mobile_hide">';
							if ($string_orders_workout->class_2 == 1) {
								echo '<input type="checkbox" class="paid_counter" style="transform: scale(1.5);cursor: pointer;" checked></i>';	
							} else if ($already_class_2 == 1) {
								echo '<div style="padding-top: 5px"></div>';
								echo '<i class="fa fa-check-square-o" aria-hidden="true"></i>';
							};
						echo '</td>';
						echo '<td class="members_mobile_hide">';
							if ($string_orders_workout->class_3 == 1) {
								echo '<input type="checkbox" class="paid_counter" style="transform: scale(1.5);cursor: pointer;" checked></i>';	
							} else if ($already_class_3 == 1) {
								echo '<div style="padding-top: 5px"></div>';
								echo '<i class="fa fa-check-square-o" aria-hidden="true"></i>';
							};
						echo '</td>';
						echo '<td class="members_mobile_hide">';
							if ($string_orders_workout->class_4 == 1) {
								echo '<input type="checkbox" class="paid_counter" style="transform: scale(1.5);cursor: pointer;" checked></i>';	
							} else if ($already_class_4 == 1) {
								echo '<div style="padding-top: 5px"></div>';
								echo '<i class="fa fa-check-square-o" aria-hidden="true"></i>';
							};
						echo '</td>';
						echo '<td class="members_mobile_hide">';
							if ($string_orders_workout->class_5 == 1) {
								echo '<input type="checkbox" class="paid_counter" style="transform: scale(1.5);cursor: pointer;" checked></i>';	
							} else if ($already_class_5 == 1) {
								echo '<div style="padding-top: 5px"></div>';
								echo '<i class="fa fa-check-square-o" aria-hidden="true"></i>';
							};
						echo '</td>';
						echo '<td class="members_mobile_hide">';
							if ($string_orders_workout->class_6 == 1) {
								echo '<input type="checkbox" class="paid_counter" style="transform: scale(1.5);cursor: pointer;" checked></i>';	
							} else if ($already_class_6 == 1) {
								echo '<div style="padding-top: 5px"></div>';
								echo '<i class="fa fa-check-square-o" aria-hidden="true"></i>';
							};
						echo '</td>';
						echo '<td class="members_mobile_hide">';
							if ($string_orders_workout->class_7 == 1) {
								echo '<input type="checkbox" class="paid_counter" style="transform: scale(1.5);cursor: pointer;" checked></i>';	
							} else if ($already_class_7 == 1) {
								echo '<div style="padding-top: 5px"></div>';
								echo '<i class="fa fa-check-square-o" aria-hidden="true"></i>';
							};
						echo '</td>';
						echo '<td class="members_mobile_hide">';
							if ($string_orders_workout->class_8 == 1) {
								echo '<input type="checkbox" class="paid_counter" style="transform: scale(1.5);cursor: pointer;" checked></i>';	
							} else if ($already_class_8 == 1) {
								echo '<div style="padding-top: 5px"></div>';
								echo '<i class="fa fa-check-square-o" aria-hidden="true"></i>';
							};
						echo '</td>';
						echo '<td class="members_mobile_hide">';
							if ($string_orders_workout->class_9 == 1) {
								echo '<input type="checkbox" class="paid_counter" style="transform: scale(1.5);cursor: pointer;" checked></i>';	
							} else if ($already_class_9 == 1) {
								echo '<div style="padding-top: 5px"></div>';
								echo '<i class="fa fa-check-square-o" aria-hidden="true"></i>';
							};
						echo '</td>';
						echo '<td class="members_mobile_hide">';
							if ($string_orders_workout->class_10 == 1) {
								echo '<input type="checkbox" class="paid_counter" style="transform: scale(1.5);cursor: pointer;" checked></i>';	
							} else if ($already_class_10 == 1) {
								echo '<div style="padding-top: 5px"></div>';
								echo '<i class="fa fa-check-square-o" aria-hidden="true"></i>';
							};
						
						$already_class_1 = 0;
						$already_class_2 = 0;
						$already_class_3 = 0;
						$already_class_4 = 0;
						$already_class_5 = 0;
						$already_class_6 = 0;
						$already_class_7 = 0;
						$already_class_8 = 0;
						$already_class_9 = 0;
						$already_class_10 = 0;
						
						echo '</td>';
						echo '<td style="background-color: #fec300;">';
							if ($string_orders_workout->paid == '0') {				        
							echo '<input type="checkbox" class="paid_counter" id="paid_id_'.$current_order_id.'" style="transform:scale(1.5); cursor:pointer;" name="paid_id_'.$current_order_id.'" value="1" >';
							} else {
							echo '<input type="checkbox" class="paid_counter" id="paid_id_'.$current_order_id.'" style="transform:scale(1.5); cursor:pointer;" checked name="paid_id_'.$current_order_id.'" value="1"  >';
							$ordersByWorkoutPaidCount = $ordersByWorkoutPaidCount + 1;
							$ordersByWorkoutPaidSum = $ordersByWorkoutPaidSum + $string_orders_workout->amount;
							};
						echo '</td>';
						echo '<td>';
							echo '<input style="width:70px; height: 26px; background-color: '.$amount_color.';" class="text-input" name="amount_id_'.$current_order_id.'" type="number" id="amount_id" value="'.$string_orders_workout->amount.'" />';
						$ordersByWorkoutSum = $ordersByWorkoutSum + $string_orders_workout->amount;
						echo '</td>';
						 echo '<td class="members_mobile_hide">'; //7.Комментарий администратора
							      echo '<input style="width: 300px; height: 26px; background-color: '.$whatsapp_color.';" class="text-input" name="admin_comment_id_'.$current_order_id.'" type="text" id="admin_comment_id" value="'.$string_orders_workout->admin_comment.'" />';
						        echo '</td>';
						echo '<td>';
						$whatsapp_number = $string_orders_workout->telephone;
				        $phone= str_replace([' ', '(', ')', '-', '_'], '', $whatsapp_number);
						$phone = preg_replace('/^8/', '+7', $phone);
						$phone = preg_replace('/^7/', '+7', $phone);    
				        echo '<a href="https://api.whatsapp.com/send?phone='.$phone.'" target="_blank"><img style="width: 30px; padding-top: 5px;" src="http://maraphon.online/wp-content/uploads/whatsapp-icon-180×180.png"/></a>';	
						echo '</td>';
					
					echo '</tr>';
	
				};
				echo '</table>';
				
				echo '<table class="paid_paid_result_table">';
								echo '<tr>'; 
										
								echo '<td style="opacity: 0; width: 50px;">';
									echo '<input style="width:50px;" name="choose_period_by_date_month" type="number" value="'.$choose_period_by_date_month_ajax.'" />';
								echo '</td>';
										
								echo '<td style="opacity: 0; width: 50px;">';
									echo '<input style="width:50px;" name="choose_period_by_date_year" type="number" value="'.$choose_period_by_date_year.'" />';
								echo '</td>';
								
								$natalieMoneyCount = $ordersByWorkoutPaidSum * 0.2;
								
								echo '<td style="border: 3px solid black; width: 180px; text-align: center; padding-top: 3px;">';
									echo 'Зарплата: '.$natalieMoneyCount.' р.';
								echo '</td>';
								
								echo '<td style="border: 3px solid black; width: 194px; text-align: center; padding-top: 3px;">';
									echo 'Всего заказов: '.$ordersByWorkoutCount;
								echo '</td>';
								
								echo '<td style="border: 3px solid black; width: 180px; text-align: center; padding-top: 3px;">';
									echo 'Сумма: '.$ordersByWorkoutSum.' р.';
								echo '</td>';
								
								echo '<td style="border: 3px solid black; width: 240px; text-align: center; padding-top: 3px;">';
									echo 'Оплаченные заказы: '.$ordersByWorkoutPaidCount;
								echo '</td>';
								
								echo '<td style="border: 3px solid black; width: 329px; text-align: center; padding-top: 3px;">';
									echo 'Оплачено, сумма: '.$ordersByWorkoutPaidSum.' р.';
								echo '</td>';
								
								echo '</tr>';
				echo '</table>';

			};
			
			
						
			echo '<input style="width:50px; position: absolute; opacity: 0; margin-left: 100px;" name="choose_period_by_date_month" type="number" value="'.$choose_period_by_date_month_ajax.'" />';
			echo '<input style="width:50px; position: absolute; opacity: 0; margin-left: 100px;" name="choose_period_by_date_year" type="number" value="'.$choose_period_by_date_year.'" />';

			echo '<div id="success_form">Данные обновлены</div>';
		
			echo '<input type="hidden" name="action" value="formOrdersByWorkoutUpdate"/>';
			echo '<input style="margin-bottom: 40px;"'.$check_paid_past_flag.'" type="submit" id="updateuser" class="submit button paid_button" value="Записать">';
			echo '</form>'; 
			
			echo '<script type="text/javascript">';
			echo 'jQuery("#formOrdersByWorkout").submit(ajaxformOrdersByWorkout);';
				echo 'function ajaxformOrdersByWorkout(){';
					echo 'var formOrdersByWorkout = jQuery(this).serialize();';
					echo '$.ajaxSetup({cache: false});';
						echo 'jQuery.ajax({';
						echo 'type:"POST",';
						echo 'url: "/wp-admin/admin-ajax.php",';
						echo 'data: formOrdersByWorkout,';
							echo 'success:function(data){';
							echo '$("#success_form").show();';
							echo 'setTimeout(function(){$("#success_form").fadeOut("slow")},1000);';
							echo '}';
						echo '});';
					echo 'return false;';
				echo '}';
			echo '</script>';
		} else if ($choose_period_by_type == 'menu_order_new') {  														//начало условия при выборе "Продажи меню новый"
			$menu_order_period_start = $choose_period_by_date_year.'-'.$choose_period_by_date_month_ajax.'-01';
			$menu_order_period_finish = $choose_period_by_date_year.'-'.$choose_period_by_date_month_ajax.'-31';
			
			$_monthsListPeriod = array(
					"01"=>"январь","02"=>"февраль","03"=>"март",
					"04"=>"апрель","05"=>"май", "06"=>"июнь",
					"07"=>"июль","08"=>"август","09"=>"сентябрь",
					"10"=>"октябрь","11"=>"ноябрь","12"=>"декабрь");	
								
					$choose_period_by_date_month = $_monthsListPeriod[$choose_period_by_date_month_ajax];
					$period_by_date = $choose_period_by_date_month.' '.$choose_period_by_date_year;
								
			echo '<h2 class="paid_by_date_h2">Продажи меню, '.$period_by_date.'</h2>';
			echo '<br>';
		
			global $wpdb;
			$current_user = wp_get_current_user();
			$user_id = $current_user->ID;
			$ordersByMenuCount = 0;
			$ordersByMenuSum = 0;
			$ordersByMenuPaidCount = 0;
			$ordersByMenuPaidSum = 0;
			$menu_order_array = $wpdb->get_results( 
				"
				SELECT * 
				FROM wpux_orders_menu orders_menu
				WHERE (DATE(orders_menu.date) BETWEEN '$menu_order_period_start' AND '$menu_order_period_finish')
				ORDER BY orders_menu.order_id DESC
		        "
	        );
	        
	        if( $menu_order_array ) {
				echo '<form id="formOrdersByMenuNew">';
					echo '<input type="hidden" name="action" value="formOrdersByMenuNewUpdate"/>';
					echo '<input style="position: absolute; margin-left: 885px; margin-top: -66px;" type="submit" id="updateuser" class="submit button members_mobile_hide" value="Записать">';
							
					echo '<table class="paid_table_for_admin">';
						echo '<tr style="background-color: #f6f6f6;">';
							echo '<th>&nbsp;№&nbsp;</th>';
							echo '<th>Дата</th>';
							echo '<th>&nbsp;ID&nbsp;</th>';
							echo '<th>&nbsp;ФИО&nbsp;</th>';
							echo '<th>&nbsp;Заказ&nbsp;</th>';
							echo '<th class="members_mobile_hide">&nbsp;&nbsp;1&nbsp;&nbsp;</th>';
				        	echo '<th class="members_mobile_hide">&nbsp;&nbsp;2&nbsp;&nbsp;</th>';
				        	echo '<th class="members_mobile_hide">&nbsp;&nbsp;3&nbsp;&nbsp;</th>';
				        	echo '<th class="members_mobile_hide">&nbsp;&nbsp;4&nbsp;&nbsp;</th>';
				        	echo '<th class="members_mobile_hide">&nbsp;&nbsp;5&nbsp;&nbsp;</th>';
				        	echo '<th class="members_mobile_hide">&nbsp;&nbsp;6&nbsp;&nbsp;</th>';
				        	echo '<th class="members_mobile_hide">&nbsp;&nbsp;7&nbsp;&nbsp;</th>';
				        	echo '<th class="members_mobile_hide">&nbsp;&nbsp;8&nbsp;&nbsp;</th>';
				        	echo '<th class="members_mobile_hide">&nbsp;&nbsp;9&nbsp;&nbsp;</th>';
				        	echo '<th class="members_mobile_hide" style="padding: 0 2px 0 2px;">&nbsp;10&nbsp;</th>';
				        	echo '<th class="members_mobile_hide" style="padding: 0 2px 0 2px;">&nbsp;11&nbsp;</th>';
				        	echo '<th class="members_mobile_hide" style="padding: 0 2px 0 2px;">&nbsp;12&nbsp;</th>';
				        	echo '<th class="members_mobile_hide">&nbsp;Last&nbsp;</th>';
				        	echo '<th class="members_mobile_hide">&nbsp;Вег.&nbsp;</th>';
				        	echo '<th class="members_mobile_hide">&nbsp;Без&nbsp;<br>&nbsp;лакт.&nbsp;</th>';
				        	echo '<th style="padding: 0 10px 0 10px;"><i class="fa fa-rub" aria-hidden="true"></i></th>';
							echo '<th>&nbsp;Сумма&nbsp;</th>';
							echo '<th class="members_mobile_hide" style="width: 300px;">&nbsp;Комментарий<br>администратора&nbsp;</th>';
							echo '<th style="width: 35px;">&nbsp;<i class="fa fa-paper-plane-o" aria-hidden="true">&nbsp;</th>'; 
						echo '</tr>';
				
				foreach ( $menu_order_array as $string_orders_menu ) {
					echo '<tr>';
						echo '<td>';
							$current_order_id = $string_orders_menu->order_id;
							echo $current_order_id;
							$ordersByMenuCount = $ordersByMenuCount + 1;
						echo '</td>';
						echo '<td>';
							 $full_date = $string_orders_menu->date;
						     $day_date = substr($full_date, 8, 2);
						     $month_date = substr($full_date, 5, 2);
						     $year_date = substr($full_date, 0, 4);
						     $right_date = '&nbsp;'.$day_date.'.'.$month_date.'.'.$year_date.'&nbsp;';
						     echo ' '.$right_date.' ';
						echo '</td>';
						echo '<td>';
							$current_user_id = $string_orders_menu->user_id;
							echo $current_user_id;
						echo '</td>';
						echo '<td style="padding: 0 2px 0 2px;">';
							$name = $string_orders_menu->first_name;
							$surname = $string_orders_menu->last_name;
							$fio = $surname.' '.$name;
							echo '<a href="http://maraphon.online/wp-admin/user-edit.php?user_id='.$current_user_id.'&wp_http_referer=%2Fwp-admin%2Fusers.php" target="_blank">'.$fio.'</a>';
						echo '</td>';
						echo '<td style="padding: 0 2px 0 2px;">';
							$content_menu = $string_orders_menu->content;
							echo $content_menu;
						echo '</td>';
						
						$content_menu_check = substr($content_menu, 0, 2);
						if ($content_menu_check == 'М') {
							$check_what_menu_already_bought_by_user = $wpdb->get_results(
								"
								SELECT
							    orders_menu.m_1,
							    orders_menu.m_2,
							    orders_menu.m_3,
							    orders_menu.m_4,
							    orders_menu.m_5,
							    orders_menu.m_6,
							    orders_menu.m_7,
							    orders_menu.m_8,
							    orders_menu.m_9,
							    orders_menu.m_10,
							    orders_menu.m_11,
							    orders_menu.m_12,
							    orders_menu.last,
							    orders_menu.vegan,
							    orders_menu.wo_lact
								FROM wpux_orders_menu orders_menu
							    WHERE orders_menu.user_id = $current_user_id
							    AND orders_menu.content LIKE '%Муж%'
							    AND orders_menu.paid = 1
								"	
							);
						} else if ($content_menu_check == 'Ж') {
							$check_what_menu_already_bought_by_user = $wpdb->get_results(
								"
								SELECT
							    orders_menu.m_1,
							    orders_menu.m_2,
							    orders_menu.m_3,
							    orders_menu.m_4,
							    orders_menu.m_5,
							    orders_menu.m_6,
							    orders_menu.m_7,
							    orders_menu.m_8,
							    orders_menu.m_9,
							    orders_menu.m_10,
							    orders_menu.m_11,
							    orders_menu.m_12,
							    orders_menu.last,
							    orders_menu.vegan,
							    orders_menu.wo_lact
								FROM wpux_orders_menu orders_menu
							    WHERE orders_menu.user_id = $current_user_id
							    AND orders_menu.content LIKE '%Жен%'
							    AND orders_menu.paid = 1
								"	
							);
						};
							
						if ($check_what_menu_already_bought_by_user) {
							foreach ($check_what_menu_already_bought_by_user as $already_bought_menu_string) {
								if ($already_bought_menu_string->m_1) {$already_m_1 = 1;};
								if ($already_bought_menu_string->m_2) {$already_m_2 = 1;};
								if ($already_bought_menu_string->m_3) {$already_m_3 = 1;};
								if ($already_bought_menu_string->m_4) {$already_m_4 = 1;};
								if ($already_bought_menu_string->m_5) {$already_m_5 = 1;};
								if ($already_bought_menu_string->m_6) {$already_m_6 = 1;};
								if ($already_bought_menu_string->m_7) {$already_m_7 = 1;};
								if ($already_bought_menu_string->m_8) {$already_m_8 = 1;};
								if ($already_bought_menu_string->m_9) {$already_m_9 = 1;};
								if ($already_bought_menu_string->m_10) {$already_m_10 = 1;};
								if ($already_bought_menu_string->m_11) {$already_m_11 = 1;};
								if ($already_bought_menu_string->m_12) {$already_m_12 = 1;};
								if ($already_bought_menu_string->last) {$already_last = 1;};
								if ($already_bought_menu_string->vegan) {$already_vegan = 1;};
								if ($already_bought_menu_string->wo_lact) {$already_wo_lact = 1;};
							};
						};
						
						echo '<td class="members_mobile_hide">';
							if ($string_orders_menu->m_1 == 1) {
								echo '<input type="checkbox" class="paid_counter" id="m_1_id_'.$current_order_id.'" name="m_1_id_'.$current_order_id.'" style="transform: scale(1.5);cursor: pointer;" checked value="1"></i>';	
							} else if ($already_m_1 == 1) {
								echo '<div style="padding-top: 5px"></div>';
								echo '<i class="fa fa-check-square-o" aria-hidden="true"></i>';
							} else {
								echo '<input type="checkbox" class="paid_counter" id="m_1_id_'.$current_order_id.'" name="m_1_id_'.$current_order_id.'" style="transform: scale(1.5);cursor: pointer;" value="1"></i>';	
							};
						echo '</td>';
						
						echo '<td class="members_mobile_hide">';
							if ($string_orders_menu->m_2 == 1) {
								echo '<input type="checkbox" class="paid_counter" id="m_2_id_'.$current_order_id.'" name="m_2_id_'.$current_order_id.'" style="transform: scale(1.5);cursor: pointer;" checked value="1"></i>';	
							} else if ($already_m_2 == 1) {
								echo '<div style="padding-top: 5px"></div>';
								echo '<i class="fa fa-check-square-o" aria-hidden="true"></i>';
							} else {
								echo '<input type="checkbox" class="paid_counter" id="m_2_id_'.$current_order_id.'" name="m_2_id_'.$current_order_id.'" style="transform: scale(1.5);cursor: pointer;" value="1"></i>';	
							};
						echo '</td>';
						
						echo '<td class="members_mobile_hide">';
							if ($string_orders_menu->m_3 == 1) {
								echo '<input type="checkbox" class="paid_counter" id="m_3_id_'.$current_order_id.'" name="m_3_id_'.$current_order_id.'" style="transform: scale(1.5);cursor: pointer;" checked value="1"></i>';	
							} else if ($already_m_3 == 1) {
								echo '<div style="padding-top: 5px"></div>';
								echo '<i class="fa fa-check-square-o" aria-hidden="true"></i>';
							} else {
								echo '<input type="checkbox" class="paid_counter" id="m_3_id_'.$current_order_id.'" name="m_3_id_'.$current_order_id.'" style="transform: scale(1.5);cursor: pointer;" value="1"></i>';	
							};
						echo '</td>';
						
						echo '<td class="members_mobile_hide">';
							if ($string_orders_menu->m_4 == 1) {
								echo '<input type="checkbox" class="paid_counter" id="m_4_id_'.$current_order_id.'" name="m_4_id_'.$current_order_id.'" style="transform: scale(1.5);cursor: pointer;" checked value="1"></i>';	
							} else if ($already_m_4 == 1) {
								echo '<div style="padding-top: 5px"></div>';
								echo '<i class="fa fa-check-square-o" aria-hidden="true"></i>';
							} else {
								echo '<input type="checkbox" class="paid_counter" id="m_4_id_'.$current_order_id.'" name="m_4_id_'.$current_order_id.'" style="transform: scale(1.5);cursor: pointer;" value="1"></i>';	
							};
						echo '</td>';
						
						echo '<td class="members_mobile_hide">';
							if ($string_orders_menu->m_5 == 1) {
								echo '<input type="checkbox" class="paid_counter" id="m_5_id_'.$current_order_id.'" name="m_5_id_'.$current_order_id.'" style="transform: scale(1.5);cursor: pointer;" checked value="1"></i>';	
							} else if ($already_m_5 == 1) {
								echo '<div style="padding-top: 5px"></div>';
								echo '<i class="fa fa-check-square-o" aria-hidden="true"></i>';
							} else {
								echo '<input type="checkbox" class="paid_counter" id="m_5_id_'.$current_order_id.'" name="m_5_id_'.$current_order_id.'" style="transform: scale(1.5);cursor: pointer;" value="1"></i>';	
							};
						echo '</td>';
						
						echo '<td class="members_mobile_hide">';
							if ($string_orders_menu->m_6 == 1) {
								echo '<input type="checkbox" class="paid_counter" id="m_6_id_'.$current_order_id.'" name="m_6_id_'.$current_order_id.'" style="transform: scale(1.5);cursor: pointer;" checked value="1"></i>';	
							} else if ($already_m_6 == 1) {
								echo '<div style="padding-top: 5px"></div>';
								echo '<i class="fa fa-check-square-o" aria-hidden="true"></i>';
							} else {
								echo '<input type="checkbox" class="paid_counter" id="m_6_id_'.$current_order_id.'" name="m_6_id_'.$current_order_id.'" style="transform: scale(1.5);cursor: pointer;" value="1"></i>';	
							};
						echo '</td>';
						
						echo '<td class="members_mobile_hide">';
							if ($string_orders_menu->m_7 == 1) {
								echo '<input type="checkbox" class="paid_counter" id="m_7_id_'.$current_order_id.'" name="m_7_id_'.$current_order_id.'" style="transform: scale(1.5);cursor: pointer;" checked value="1"></i>';	
							} else if ($already_m_7 == 1) {
								echo '<div style="padding-top: 5px"></div>';
								echo '<i class="fa fa-check-square-o" aria-hidden="true"></i>';
							} else {
								echo '<input type="checkbox" class="paid_counter" id="m_7_id_'.$current_order_id.'" name="m_7_id_'.$current_order_id.'" style="transform: scale(1.5);cursor: pointer;" value="1"></i>';	
							};
						echo '</td>';
						
						echo '<td class="members_mobile_hide">';
							if ($string_orders_menu->m_8 == 1) {
								echo '<input type="checkbox" class="paid_counter" id="m_8_id_'.$current_order_id.'" name="m_8_id_'.$current_order_id.'" style="transform: scale(1.5);cursor: pointer;" checked value="1"></i>';	
							} else if ($already_m_8 == 1) {
								echo '<div style="padding-top: 5px"></div>';
								echo '<i class="fa fa-check-square-o" aria-hidden="true"></i>';
							} else {
								echo '<input type="checkbox" class="paid_counter" id="m_8_id_'.$current_order_id.'" name="m_8_id_'.$current_order_id.'" style="transform: scale(1.5);cursor: pointer;" value="1"></i>';	
							};
						echo '</td>';
						
						echo '<td class="members_mobile_hide">';
							if ($string_orders_menu->m_9 == 1) {
								echo '<input type="checkbox" class="paid_counter" id="m_9_id_'.$current_order_id.'" name="m_9_id_'.$current_order_id.'" style="transform: scale(1.5);cursor: pointer;" checked value="1"></i>';	
							} else if ($already_m_9 == 1) {
								echo '<div style="padding-top: 5px"></div>';
								echo '<i class="fa fa-check-square-o" aria-hidden="true"></i>';
							} else {
								echo '<input type="checkbox" class="paid_counter" id="m_9_id_'.$current_order_id.'" name="m_9_id_'.$current_order_id.'" style="transform: scale(1.5);cursor: pointer;" value="1"></i>';	
							};
						echo '</td>';
						
						echo '<td class="members_mobile_hide">';
							if ($string_orders_menu->m_10 == 1) {
								echo '<input type="checkbox" class="paid_counter" id="m_10_id_'.$current_order_id.'" name="m_10_id_'.$current_order_id.'" style="transform: scale(1.5);cursor: pointer;" checked value="1"></i>';	
							} else if ($already_m_10 == 1) {
								echo '<div style="padding-top: 5px"></div>';
								echo '<i class="fa fa-check-square-o" aria-hidden="true"></i>';
							} else {
								echo '<input type="checkbox" class="paid_counter" id="m_10_id_'.$current_order_id.'" name="m_10_id_'.$current_order_id.'" style="transform: scale(1.5);cursor: pointer;" value="1"></i>';	
							};
						echo '</td>';
						
						echo '<td class="members_mobile_hide">';
							if ($string_orders_menu->m_11 == 1) {
								echo '<input type="checkbox" class="paid_counter" id="m_11_id_'.$current_order_id.'" name="m_11_id_'.$current_order_id.'" style="transform: scale(1.5);cursor: pointer;" checked value="1"></i>';	
							} else if ($already_m_11 == 1) {
								echo '<div style="padding-top: 5px"></div>';
								echo '<i class="fa fa-check-square-o" aria-hidden="true"></i>';
							} else {
								echo '<input type="checkbox" class="paid_counter" id="m_11_id_'.$current_order_id.'" name="m_11_id_'.$current_order_id.'" style="transform: scale(1.5);cursor: pointer;" value="1"></i>';	
							};
						echo '</td>';
						
						echo '<td class="members_mobile_hide">';
							if ($string_orders_menu->m_12 == 1) {
								echo '<input type="checkbox" class="paid_counter" id="m_12_id_'.$current_order_id.'" name="m_12_id_'.$current_order_id.'" style="transform: scale(1.5);cursor: pointer;" checked value="1"></i>';	
							} else if ($already_m_12 == 1) {
								echo '<div style="padding-top: 5px"></div>';
								echo '<i class="fa fa-check-square-o" aria-hidden="true"></i>';
							} else {
								echo '<input type="checkbox" class="paid_counter" id="m_12_id_'.$current_order_id.'" name="m_12_id_'.$current_order_id.'" style="transform: scale(1.5);cursor: pointer;" value="1"></i>';	
							};
						echo '</td>';
						
						echo '<td class="members_mobile_hide">';
							if ($string_orders_menu->last == 1) {
								echo '<input type="checkbox" class="paid_counter" id="last_id_'.$current_order_id.'" name="last_id_'.$current_order_id.'" style="transform: scale(1.5);cursor: pointer;" checked value="1"></i>';	
							} else if ($already_last == 1) {
								echo '<div style="padding-top: 5px"></div>';
								echo '<i class="fa fa-check-square-o" aria-hidden="true"></i>';
							} else {
								echo '<input type="checkbox" class="paid_counter" id="last_id_'.$current_order_id.'" name="last_id_'.$current_order_id.'" style="transform: scale(1.5);cursor: pointer;" value="1"></i>';	
							};
						echo '</td>';
						
						echo '<td class="members_mobile_hide">';
							if ($string_orders_menu->vegan == 1) {
								echo '<input type="checkbox" class="paid_counter" id="vegan_id_'.$current_order_id.'" name="vegan_id_'.$current_order_id.'" style="transform: scale(1.5);cursor: pointer;" checked value="1"></i>';	
							} else if ($already_vegan == 1) {
								echo '<div style="padding-top: 5px"></div>';
								echo '<i class="fa fa-check-square-o" aria-hidden="true"></i>';
							} else {
								echo '<input type="checkbox" class="paid_counter" id="vegan_id_'.$current_order_id.'" name="vegan_id_'.$current_order_id.'" style="transform: scale(1.5);cursor: pointer;" value="1"></i>';	
							};
						echo '</td>';
						
						echo '<td class="members_mobile_hide">';
							if ($string_orders_menu->wo_lact == 1) {
								echo '<input type="checkbox" class="paid_counter" id="wo_lact_id_'.$current_order_id.'" name="wo_lact_id_'.$current_order_id.'" style="transform: scale(1.5);cursor: pointer;" checked value="1"></i>';	
							} else if ($already_wo_lact == 1) {
								echo '<div style="padding-top: 5px"></div>';
								echo '<i class="fa fa-check-square-o" aria-hidden="true"></i>';
							} else {
								echo '<input type="checkbox" class="paid_counter" id="wo_lact_id_'.$current_order_id.'" name="wo_lact_id_'.$current_order_id.'" style="transform: scale(1.5);cursor: pointer;" value="1"></i>';	
							};
						echo '</td>';

						$already_m_1 = 0;
						$already_m_2 = 0;
						$already_m_3 = 0;
						$already_m_4 = 0;
						$already_m_5 = 0;
						$already_m_6 = 0;
						$already_m_7 = 0;
						$already_m_8 = 0;
						$already_m_9 = 0;
						$already_m_10 = 0;
						$already_m_11 = 0;
						$already_m_12 = 0;
						$already_last = 0;
						$already_vegan = 0;
						$already_wo_lact = 0;
						
						echo '<td style="background-color: #fec300;">';
							if ($string_orders_menu->paid == '0') {				        
							echo '<input type="checkbox" class="paid_counter" id="paid_id_'.$current_order_id.'" style="transform:scale(1.5); cursor:pointer;" name="paid_id_'.$current_order_id.'" value="1" >';
							} else {
							echo '<input type="checkbox" class="paid_counter" id="paid_id_'.$current_order_id.'" style="transform:scale(1.5); cursor:pointer;" checked name="paid_id_'.$current_order_id.'" value="1"  >';
							$ordersByMenuPaidCount = $ordersByMenuPaidCount + 1;
							$ordersByMenuPaidSum = $ordersByMenuPaidSum + $string_orders_menu->amount;
							};
						echo '</td>';
						
						echo '<td>';
							echo '<input style="width:70px; height: 26px; background-color: '.$amount_color.';" class="text-input" name="amount_id_'.$current_order_id.'" type="number" id="amount_id" value="'.$string_orders_menu->amount.'" />';
						$ordersByMenuSum = $ordersByMenuSum + $string_orders_menu->amount;
						echo '</td>';
						 echo '<td class="members_mobile_hide">'; //7.Комментарий администратора
							      echo '<input style="width: 100%; height: 26px; background-color: '.$whatsapp_color.';" class="text-input" name="admin_comment_id_'.$current_order_id.'" type="text" id="admin_comment_id" value="'.$string_orders_menu->admin_comment.'" />';
						        echo '</td>';
						echo '<td>';
						$whatsapp_number = $string_orders_menu->telephone;
				        $phone= str_replace([' ', '(', ')', '-', '_'], '', $whatsapp_number);
						$phone = preg_replace('/^8/', '+7', $phone);
						$phone = preg_replace('/^7/', '+7', $phone);    
				        echo '<a href="https://api.whatsapp.com/send?phone='.$phone.'" target="_blank"><img style="width: 30px; padding-top: 5px;" src="http://maraphon.online/wp-content/uploads/whatsapp-icon-180×180.png"/></a>';	
						echo '</td>';
						
						echo '</tr>';						
				}; //if( $menu_order_array )
						
			echo '</table>';
					
					echo '<table class="paid_paid_result_table">';
								echo '<tr>'; 
										
								echo '<td style="opacity: 0; width: 50px;">';
									echo '<input style="width:50px;" name="choose_period_by_date_month" type="number" value="'.$choose_period_by_date_month_ajax.'" />';
								echo '</td>';
										
								echo '<td style="opacity: 0; width: 50px;">';
									echo '<input style="width:50px;" name="choose_period_by_date_year" type="number" value="'.$choose_period_by_date_year.'" />';
								echo '</td>';
								
								$natalieMoneyCount = $ordersByMenuPaidSum * 0.2;
								$dmitriyMoneyCount = $ordersByMenuPaidSum * 0.5;
								
								echo '<td style="border: 3px solid black; width: 180px; text-align: center; padding-top: 3px;">';
									echo 'Наталья: '.$natalieMoneyCount.' р.<br>';
									echo 'Дмитрий: '.$dmitriyMoneyCount.' р.';
								echo '</td>';
								
								echo '<td style="border: 3px solid black; width: 194px; text-align: center; padding-top: 3px;">';
									echo 'Всего заказов: '.$ordersByMenuCount;
								echo '</td>';
								
								echo '<td style="border: 3px solid black; width: 180px; text-align: center; padding-top: 3px;">';
									echo 'Сумма: '.$ordersByMenuSum.' р.';
								echo '</td>';
								
								echo '<td style="border: 3px solid black; width: 240px; text-align: center; padding-top: 3px;">';
									echo 'Оплаченные заказы: '.$ordersByMenuPaidCount;
								echo '</td>';
								
								echo '<td style="border: 3px solid black; width: 329px; text-align: center; padding-top: 3px;">';
									echo 'Оплачено, сумма: '.$ordersByMenuPaidSum.' р.';
								echo '</td>';
								
								echo '</tr>';
					echo '</table>';
					
					echo '<input style="width:50px; position: absolute; opacity: 0; margin-left: 100px;" name="choose_period_by_date_month" type="number" value="'.$choose_period_by_date_month_ajax.'" />';
					echo '<input style="width:50px; position: absolute; opacity: 0; margin-left: 100px;" name="choose_period_by_date_year" type="number" value="'.$choose_period_by_date_year.'" />';
		
					echo '<div id="success_form">Данные обновлены</div>';
				
					echo '<input type="hidden" name="action" value="formOrdersByMenuNewUpdate"/>';
					echo '<input style="margin-bottom: 40px;" type="submit" id="updateuser" class="submit button paid_button" value="Записать">';
				echo '</form>'; 
				
				echo '<script type="text/javascript">';
				echo 'jQuery("#formOrdersByMenuNew").submit(ajaxformOrdersByMenuNew);';
					echo 'function ajaxformOrdersByMenuNew(){';
						echo 'var formOrdersByMenuNew = jQuery(this).serialize();';
						echo '$.ajaxSetup({cache: false});';
							echo 'jQuery.ajax({';
							echo 'type:"POST",';
							echo 'url: "/wp-admin/admin-ajax.php",';
							echo 'data: formOrdersByMenuNew,';
								echo 'success:function(data){';
								echo '$("#success_form").show();';
								echo 'setTimeout(function(){$("#success_form").fadeOut("slow")},1000);';
								echo '}';
							echo '});';
						echo 'return false;';
					echo '}';
				echo '</script>';
				
	        };													
		};
		die();
	}
		add_action('wp_ajax_choosePeriodByFunc', 'choosePeriodByFunc');
		add_action('wp_ajax_nopriv_choosePeriodByFunc', 'choosePeriodByFunc');
		
// ----------- Обработчик отчета по заказам и оплатам в ветке выбора по продаже меню новый ----------- //
function formOrdersByMenuNewUpdate(){ 
	
		global $wpdb;
		$choose_period_by_menu_month_update = $_POST['choose_period_by_date_month'];
		$choose_period_by_menu_year_update = $_POST['choose_period_by_date_year'];
		$menu_order_period_start = $choose_period_by_menu_year_update.'-'.$choose_period_by_menu_month_update.'-01';
		$menu_order_period_finish = $choose_period_by_menu_year_update.'-'.$choose_period_by_menu_month_update.'-31';
		
		$this_month_report_by_menu_new_update = $wpdb->get_results(
			"
			SELECT * 
			FROM wpux_orders_menu orders_menu
			WHERE (DATE(orders_menu.date) BETWEEN '$menu_order_period_start' AND '$menu_order_period_finish')
			ORDER BY orders_menu.date DESC
			"
			);						
			if( $this_month_report_by_menu_new_update ) {
				foreach ( $this_month_report_by_menu_new_update as $string_report_data_menu ) {
			    	$current_user_id_for_output = $string_report_data_menu->user_id;
					$current_order_id_for_output = $string_report_data_menu->order_id;
					
					$m_1_data = 'm_1_id_'.$current_order_id_for_output;
					$m_1 = $_POST[$m_1_data];
					$m_2_data = 'm_2_id_'.$current_order_id_for_output;
					$m_2 = $_POST[$m_2_data];
					$m_3_data = 'm_3_id_'.$current_order_id_for_output;
					$m_3 = $_POST[$m_3_data];
					$m_4_data = 'm_4_id_'.$current_order_id_for_output;
					$m_4 = $_POST[$m_4_data];
					$m_5_data = 'm_5_id_'.$current_order_id_for_output;
					$m_5 = $_POST[$m_5_data];
					$m_6_data = 'm_6_id_'.$current_order_id_for_output;
					$m_6 = $_POST[$m_6_data];
					$m_7_data = 'm_7_id_'.$current_order_id_for_output;
					$m_7 = $_POST[$m_7_data];
					$m_8_data = 'm_8_id_'.$current_order_id_for_output;
					$m_8 = $_POST[$m_8_data];
					$m_9_data = 'm_9_id_'.$current_order_id_for_output;
					$m_9 = $_POST[$m_9_data];
					$m_10_data = 'm_10_id_'.$current_order_id_for_output;
					$m_10 = $_POST[$m_10_data];
					$m_11_data = 'm_11_id_'.$current_order_id_for_output;
					$m_11 = $_POST[$m_11_data];
					$m_12_data = 'm_12_id_'.$current_order_id_for_output;
					$m_12 = $_POST[$m_12_data];
					$last_data = 'last_id_'.$current_order_id_for_output;
					$last = $_POST[$last_data];
					$vegan_data = 'vegan_id_'.$current_order_id_for_output;
					$vegan = $_POST[$vegan_data];
					$wo_lact_data = 'wo_lact_id_'.$current_order_id_for_output;
					$wo_lact = $_POST[$wo_lact_data];
					
					$data1 = 'paid_id_'.$current_order_id_for_output;							
					$boolean_type = (!empty($_POST[$data1])) ? (int) $_POST[$data1] : 0;	
					
					$data2 = 'amount_id_'.$current_order_id_for_output.'';
					$amount = $_POST[$data2];
						
					$data3 = 'admin_comment_id_'.$current_order_id_for_output;
					$admin_comment = sanitize_text_field($_POST[$data3]);
							
					$wpdb->update(
						'wpux_orders_menu',
						array(
						'm_1' => $m_1,
						'm_2' => $m_2,
						'm_3' => $m_3,
						'm_4' => $m_4,
						'm_5' => $m_5,
						'm_6' => $m_6,
						'm_7' => $m_7,
						'm_8' => $m_8,
						'm_9' => $m_9,
						'm_10' => $m_10,
						'm_11' => $m_11,
						'm_12' => $m_12,
						'last' => $last,
						'vegan' => $vegan,
						'wo_lact' => $wo_lact,
						'admin_comment' => $admin_comment,
						'paid' => $boolean_type,
						'amount' => $amount
						),
						array(
						'order_id' => $current_order_id_for_output
						)
						);	
										
		    	} //Тело цикла
			} //Тело первоначального условия		
die();
}
		add_action('wp_ajax_formOrdersByMenuNewUpdate', 'formOrdersByMenuNewUpdate');
		add_action('wp_ajax_nopriv_formOrdersByMenuNewUpdate', 'formOrdersByMenuNewUpdate'); 

// ----------- Обработчик отчета по заказам и оплатам в ветке выбора по продаже тренировок ----------- //
function formOrdersByWorkoutUpdate(){ 
	
		global $wpdb;
		$choose_period_by_workout_month_update = $_POST['choose_period_by_date_month'];
		$choose_period_by_workout_year_update = $_POST['choose_period_by_date_year'];
		$workout_order_period_start = $choose_period_by_workout_year_update.'-'.$choose_period_by_workout_month_update.'-01';
		$workout_order_period_finish = $choose_period_by_workout_year_update.'-'.$choose_period_by_workout_month_update.'-31';
		
		$this_month_report_by_workout_update = $wpdb->get_results(
			"
			SELECT * 
			FROM wpux_orders_workout orders_workout
			WHERE (DATE(orders_workout.date) BETWEEN '$workout_order_period_start' AND '$workout_order_period_finish')
			ORDER BY orders_workout.date DESC
			"
			);						
			if( $this_month_report_by_workout_update ) {
				foreach ( $this_month_report_by_workout_update as $string_report_data_workout ) {
			    	$current_user_id_for_output = $string_report_data_workout->user_id;
					$current_order_id_for_output = $string_report_data_workout->order_id;
					
					$data1 = 'paid_id_'.$current_order_id_for_output.'';							
					$boolean_type = (!empty($_POST[$data1])) ? (int) $_POST[$data1] : 0;	
					
					$data2 = 'amount_id_'.$current_order_id_for_output.'';
					$amount = $_POST[$data2];
						
					$data3 = 'admin_comment_id_'.$current_order_id_for_output;
					$admin_comment = sanitize_text_field($_POST[$data3]);
							
					$wpdb->update(
						'wpux_orders_workout',
						array( 
						'admin_comment' => $admin_comment,
						'paid' => $boolean_type,
						'amount' => $amount
						),
						array(
						'order_id' => $current_order_id_for_output
						)
						);	
										
		    	} //Тело цикла
			} //Тело первоначального условия		
die();
}
		add_action('wp_ajax_formOrdersByWorkoutUpdate', 'formOrdersByWorkoutUpdate');
		add_action('wp_ajax_nopriv_formOrdersByWorkoutUpdate', 'formOrdersByWorkoutUpdate'); 
		
// ----------- Обработчик отчета по заказам и оплатам в ветке выбора по потерянным клиентам ----------- //
function formOrdersByLostUpdate(){ 
	
		global $wpdb;
		$choose_period_by_lost_month_update = $_POST['choose_period_by_date_month'];
		$choose_period_by_lost_year_update = $_POST['choose_period_by_date_year'];
		
		$lost_by_maraphone_period_update = $choose_period_by_lost_month_update.'.'.$choose_period_by_lost_year_update;
		$lost_next_month_update = $choose_period_by_lost_month_update + 1 > 12 ? '1' : $choose_period_by_lost_month_update + 1;
		$lost_next_month_update = $lost_next_month_update < 10 ? '0'.$lost_next_month_update : $lost_next_month_update;
		$lost_next_year_update = $choose_period_by_lost_month_update + 1 > 12 ? $choose_period_by_lost_year_update + 1 : $choose_period_by_lost_year_update;
		$lost_by_maraphone_period_next_update = $lost_next_month_update.'.'.$lost_next_year_update;
		$lost_by_date_update = $choose_period_by_lost_year_update.'-'.$choose_period_by_lost_month_update.'-01';
		
		$this_month_report_by_lost_update = $wpdb->get_results(
						"
						SELECT 
								orders.order_id AS order_id,
						        users.ID AS user_id,
						        (select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'first_name' limit 1) as first_name,
						        (select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'last_name' limit 1) as last_name,
						        
						        (select orders.date from wpux_orders orders where user_id = users.ID and orders.date = (
								SELECT MAX(DATE) FROM wpux_orders B WHERE orders.user_id = B.user_id)) as last_order_date,
						        
						        (select orders.maraphon_next_month from wpux_orders orders 
						         where user_id = users.ID and orders.date = (
								SELECT MAX(DATE) FROM wpux_orders B WHERE orders.user_id = B.user_id)) as last_maraphone_order,
						        
						        (select orders.women_menu from wpux_orders orders 
						         where user_id = users.ID and orders.date = (
								SELECT MAX(DATE) FROM wpux_orders B WHERE orders.user_id = B.user_id)) as last_women_menu_order,
						        
						        (select orders.men_menu from wpux_orders orders 
						         where user_id = users.ID and orders.date = (
								SELECT MAX(DATE) FROM wpux_orders B WHERE orders.user_id = B.user_id)) as last_men_menu_order,
						        
						        (select orders.recipe_book from wpux_orders orders 
						         where user_id = users.ID and orders.date = (
								SELECT MAX(DATE) FROM wpux_orders B WHERE orders.user_id = B.user_id)) as last_recipe_book_order,
						        
						        (select orders.maraphon_member_month from wpux_orders orders 
						         where user_id = users.ID and orders.maraphon_member_month = (
								SELECT MAX(maraphon_member_month) FROM wpux_orders B WHERE orders.user_id = B.user_id)) as last_maraphone,
						        
						        orders.admin_comment,
						    	(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'telephone' limit 1) as telephone
						    
						    FROM wpux_users users, wpux_orders orders
							WHERE orders.user_email = users.user_email
						    AND 
						    NOT EXISTS ( 
						    SELECT orders.maraphon_member_month 
						    FROM wpux_orders orders 
						    WHERE orders.user_id = users.ID 
						    AND (orders.maraphon_member_month = '$lost_by_maraphone_period_update' OR orders.maraphon_member_month = '$lost_by_maraphone_period_next_update' OR orders.date > '$lost_by_date_update')
						    )
						    GROUP BY users.ID
						    ORDER BY last_maraphone DESC
						"
						);	
						
						if( $this_month_report_by_lost_update ) {
					    	foreach ( $this_month_report_by_lost_update as $string_report_data_lost ) {
						    	$current_user_id_for_output = $string_report_data_lost->user_id;
							    $current_order_id_for_output = $string_report_data_lost->order_id;
								
								$data1 = 'admin_comment_id_'.$current_order_id_for_output;
								$admin_comment = sanitize_text_field($_POST[$data1]);
								
								$wpdb->update(
									'wpux_orders',
									array( 
									'admin_comment' => $admin_comment
									),
									array(
									'order_id' => $current_order_id_for_output
									)
									);	
										
		    				} //Тело цикла
						} //Тело первоначального условия		 
die();
}
		add_action('wp_ajax_formOrdersByLostUpdate', 'formOrdersByLostUpdate');
		add_action('wp_ajax_nopriv_formOrdersByLostUpdate', 'formOrdersByLostUpdate'); 
 
// ----------- Обработчик отчета по заказам и оплатам в ветке выбора по продаже меню /date - Заказы ----------- //
function formOrdersByMenuUpdate(){ 
	
		global $wpdb;
		$choose_period_by_menu_month_update = $_POST['choose_period_by_date_month'];
		$choose_period_by_menu_year_update = $_POST['choose_period_by_date_year'];
		echo $choose_period_by_menu_year_update;
		
		$date_from = $choose_period_by_menu_year_update.'-'.$choose_period_by_menu_month_update.'-01';
		$date_before = $choose_period_by_menu_year_update.'-'.$choose_period_by_menu_month_update.'-31';
		
		$this_month_report_by_menu_update = $wpdb->get_results(
						"
						SELECT 
						orders.date AS order_date,
						orders.order_id AS order_id,
						users.ID AS user_id_check,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'telephone' limit 1) as telephone,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'first_name' limit 1) as first_name,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'last_name' limit 1) as last_name,
						orders.maraphon_next_month,
						orders.women_menu,
						orders.men_menu,
						orders.telegram,
						orders.recipe_book,
						orders.pdf,
						orders.workout,
						orders.credit,
						orders.paid,
						orders.amount,
						orders.maraphon_member_month,
						orders.admin_comment
						FROM wpux_orders orders, wpux_users users
						WHERE (DATE(orders.date) BETWEEN '$date_from' AND '$date_before')
						AND (orders.men_menu != '' OR orders.women_menu != '' OR orders.recipe_book != '' OR orders.telegram != '')
						AND orders.user_email = users.user_email 
						ORDER BY orders.order_id DESC
						"
						);	
						
						if( $this_month_report_by_menu_update ) {
					    	foreach ( $this_month_report_by_menu_update as $string_report_data ) {
						    	$current_user_id_for_output = $string_report_data->user_id_check;
							    $current_order_id_for_output = $string_report_data->order_id;
								
								$data0 = 'pdf_menu_id_'.$current_order_id_for_output.'';
								$pdf = $_POST[$data0];
								
								$data1 = 'credit_id_'.$current_order_id_for_output.'';
								$credit = $_POST[$data1];
								
								$data2 = 'paid_id_'.$current_order_id_for_output.'';
								$paid = $_POST[$data2];
								
								$data3 = 'amount_id_'.$current_order_id_for_output.'';
								$amount = $_POST[$data3];
								
								$data4 = 'admin_comment_id_'.$current_order_id_for_output.'';
								$admin_comment = sanitize_text_field($_POST[$data4]);
								
								$boolean_type_credit = (!empty($_POST[$data1])) ? (int) $_POST[$data1] : 0;
								$boolean_type = (!empty($_POST[$data2])) ? (int) $_POST[$data2] : 0;
								
								$wpdb->update(
									'wpux_orders',
									array( 
									'pdf' => $pdf,
									'credit' => $boolean_type_credit,
									'paid' => $boolean_type,
									'amount' => $amount,
									'admin_comment' => $admin_comment,
									'user_id' => $current_user_id_for_output
									),
									array(
									'order_id' => $current_order_id_for_output
									)
									);	
										
		    				} //Тело цикла
						} //Тело первоначального условия		
die();
}
		add_action('wp_ajax_formOrdersByMenuUpdate', 'formOrdersByMenuUpdate');
		add_action('wp_ajax_nopriv_formOrdersByMenuUpdate', 'formOrdersByMenuUpdate'); 


// ----------- Обработчик отчета по заказам и оплатам в ветке выбора по отсрочке заказа /paid-Оплаты ----------- //
function formOrdersByCreditUpdate(){ 
		global $wpdb;
		$choose_period_by_period_month_update = $_POST['choose_period_by_date_month'];
		$choose_period_by_period_year_update = $_POST['choose_period_by_date_year'];
		
		
		$date_period_sql_update = $choose_period_by_period_month_update.'.'.$choose_period_by_period_year_update;
		
		$this_month_report_by_period_update = $wpdb->get_results(
						"
						SELECT 
						orders.date AS order_date,
						orders.order_id AS order_id,
						users.ID AS user_id_check,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'first_name' limit 1) as first_name,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'last_name' limit 1) as last_name,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'maraphon_counter' limit 1) as maraphon_counter,
						orders.maraphon_member_month,
						orders.maraphon_next_month,
						orders.pdf,
						orders.credit,
						orders.paid,
						orders.amount,
						orders.admin_comment
						FROM wpux_orders orders, wpux_users users
						WHERE orders.maraphon_member_month = $date_period_sql_update
						AND orders.user_email = users.user_email
						AND orders.credit = '1'
						ORDER BY orders.order_id
						"
						);	

						if( $this_month_report_by_period_update ) {
					    	foreach ( $this_month_report_by_period_update as $string_report_data ) {
						    	$current_user_id_for_output = $string_report_data->user_id_check;
							    $current_order_id_for_output = $string_report_data->order_id;
							    
							    $data1 = 'maraphon_counter_id_'.$current_order_id_for_output.'';
								$maraphon_counter = $_POST[$data1];
								
								$data2 = 'maraphon_member_month_id_'.$current_order_id_for_output.'';
								$maraphon_member_month = $_POST[$data2];
								if ($maraphon_member_month == '') {
									$maraphon_member_month = '';
								} else {
								$maraphon_member_month = substr($maraphon_member_month, 0, 2);
								if (($maraphon_member_month + 1) < current_time('n')) {
									$next_year = current_time('Y') + 1;
									$maraphon_member_month = $maraphon_member_month.'.'.$next_year;
								} else {
									$this_year = current_time('Y');
									$maraphon_member_month = $maraphon_member_month.'.'.$this_year;
								}
								};
								
							/*	$data6 = 'men_menu_id_'.$current_order_id_for_output.'';
								$men_menu = $_POST[$data6]; */
								
								$data7 = 'credit_id_'.$current_order_id_for_output.'';
								$credit = $_POST[$data7];
								
								$data3 = 'paid_id_'.$current_order_id_for_output.'';
								$paid = $_POST[$data3];
								
								$data4 = 'amount_id_'.$current_order_id_for_output.'';
								$amount = $_POST[$data4];
								
								$data5 = 'admin_comment_id_'.$current_order_id_for_output.'';
								$admin_comment = sanitize_text_field($_POST[$data5]);
								
								$data8 = 'pdf_menu_id_'.$current_order_id_for_output.'';
								$pdf = $_POST[$data8];

								if (isset($_POST[$data1])){
									update_user_meta( $current_user_id_for_output, 'maraphon_counter', $maraphon_counter );
								};
								
								$boolean_type = (!empty($_POST[$data3])) ? (int) $_POST[$data3] : 0;
								$boolean_type_credit = (!empty($_POST[$data7])) ? (int) $_POST[$data7] : 0;
								
								$wpdb->update(
									'wpux_orders',
									array( 
									'pdf' => $pdf,
									'maraphon_member_month' => $maraphon_member_month,
									'credit' => $boolean_type_credit,
									'paid' => $boolean_type,
									'amount' => $amount,
									'admin_comment' => $admin_comment,
									'user_id' => $current_user_id_for_output
									),
									array(
									'order_id' => $current_order_id_for_output
									)
									);
						
		    				} //Тело цикла
						} //Тело первоначального условия

				die();
		}
		add_action('wp_ajax_formOrdersByCreditUpdate', 'formOrdersByCreditUpdate');
		add_action('wp_ajax_nopriv_formOrdersByCreditUpdate', 'formOrdersByCreditUpdate'); 

// ----------- Обработчик отчета по заказам и оплатам в ветке выбора по неоплаченным заказам /paid-Оплаты ----------- //
function formOrdersByNoMoneyUpdate(){ 
		global $wpdb;
		$choose_period_by_period_month_update = $_POST['choose_period_by_date_month'];
		$choose_period_by_period_year_update = $_POST['choose_period_by_date_year'];
		
		
		$date_period_sql_update = $choose_period_by_period_month_update.'.'.$choose_period_by_period_year_update;
		
		$this_month_report_by_period_update = $wpdb->get_results(
						"
						SELECT 
						orders.date AS order_date,
						orders.order_id AS order_id,
						users.ID AS user_id_check,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'first_name' limit 1) as first_name,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'last_name' limit 1) as last_name,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'maraphon_counter' limit 1) as maraphon_counter,
						orders.maraphon_member_month,
						orders.maraphon_next_month,
						orders.pdf,
						orders.credit,
						orders.paid,
						orders.amount,
						orders.admin_comment
						FROM wpux_orders orders, wpux_users users
						WHERE orders.maraphon_member_month = $date_period_sql_update
						AND orders.user_email = users.user_email
						AND (orders.credit = '0' OR orders.credit = '')
						AND (orders.paid = '0' OR orders.paid = '')
						ORDER BY orders.order_id
						"
						);	

						if( $this_month_report_by_period_update ) {
					    	foreach ( $this_month_report_by_period_update as $string_report_data ) {
						    	$current_user_id_for_output = $string_report_data->user_id_check;
							    $current_order_id_for_output = $string_report_data->order_id;
							    
							    $data1 = 'maraphon_counter_id_'.$current_order_id_for_output.'';
								$maraphon_counter = $_POST[$data1];
								
								$data2 = 'maraphon_member_month_id_'.$current_order_id_for_output.'';
								$maraphon_member_month = $_POST[$data2];
								if ($maraphon_member_month == '') {
									$maraphon_member_month = '';
								} else {
								$maraphon_member_month = substr($maraphon_member_month, 0, 2);
								if (($maraphon_member_month + 1) < current_time('n')) {
									$next_year = current_time('Y') + 1;
									$maraphon_member_month = $maraphon_member_month.'.'.$next_year;
								} else {
									$this_year = current_time('Y');
									$maraphon_member_month = $maraphon_member_month.'.'.$this_year;
								}
								};
								
							/*	$data6 = 'men_menu_id_'.$current_order_id_for_output.'';
								$men_menu = $_POST[$data6]; */
								
								$data7 = 'credit_id_'.$current_order_id_for_output.'';
								$credit = $_POST[$data7];
								
								$data3 = 'paid_id_'.$current_order_id_for_output.'';
								$paid = $_POST[$data3];
								
								$data4 = 'amount_id_'.$current_order_id_for_output.'';
								$amount = $_POST[$data4];
								
								$data5 = 'admin_comment_id_'.$current_order_id_for_output.'';
								$admin_comment = sanitize_text_field($_POST[$data5]);
								
								$data8 = 'pdf_menu_id_'.$current_order_id_for_output.'';
								$pdf = $_POST[$data8];

								if (isset($_POST[$data1])){
									update_user_meta( $current_user_id_for_output, 'maraphon_counter', $maraphon_counter );
								}; 
								
							/*	if (isset($_POST[$data6])){
									update_user_meta( $current_user_id_for_output, 'men_menu_lk', $men_menu );
								}; */
								
								$boolean_type = (!empty($_POST[$data3])) ? (int) $_POST[$data3] : 0;
								$boolean_type_credit = (!empty($_POST[$data7])) ? (int) $_POST[$data7] : 0;
								
								$wpdb->update(
									'wpux_orders',
									array( 
									'pdf' => $pdf,
									'maraphon_member_month' => $maraphon_member_month,
									'credit' => $boolean_type_credit,
									'paid' => $boolean_type,
									'amount' => $amount,
									'admin_comment' => $admin_comment,
									'user_id' => $current_user_id_for_output
									),
									array(
									'order_id' => $current_order_id_for_output
									)
									);
						
		    				} //Тело цикла
						} //Тело первоначального условия

				die();
		}
		add_action('wp_ajax_formOrdersByNoMoneyUpdate', 'formOrdersByNoMoneyUpdate');
		add_action('wp_ajax_nopriv_formOrdersByNoMoneyUpdate', 'formOrdersByNoMoneyUpdate'); 

// ----------- Обработчик отчета по заказам и оплатам в ветке выбора по периоду заказа /paid-Оплаты ----------- //
function formOrdersByPeriodUpdate(){ 
		global $wpdb;
		$choose_period_by_period_month_update = $_POST['choose_period_by_date_month'];
		$choose_period_by_period_year_update = $_POST['choose_period_by_date_year'];
		
		
		$date_period_sql_update = $choose_period_by_period_month_update.'.'.$choose_period_by_period_year_update;
		
		$this_month_report_by_period_update = $wpdb->get_results(
						"
						SELECT 
						orders.date AS order_date,
						orders.order_id AS order_id,
						users.ID AS user_id_check,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'first_name' limit 1) as first_name,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'last_name' limit 1) as last_name,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'maraphon_counter' limit 1) as maraphon_counter,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'men_menu_lk' limit 1) as men_menu_lk,
						orders.maraphon_member_month,
						orders.maraphon_next_month,
						orders.credit,
						orders.paid,
						orders.amount,
						orders.admin_comment
						FROM wpux_orders orders, wpux_users users
						WHERE orders.maraphon_member_month = $date_period_sql_update
						AND orders.user_email = users.user_email 
						ORDER BY orders.order_id
						"
						);	

						if( $this_month_report_by_period_update ) {
					    	foreach ( $this_month_report_by_period_update as $string_report_data ) {
						    	$current_user_id_for_output = $string_report_data->user_id_check;
							    $current_order_id_for_output = $string_report_data->order_id;
							    
							    $data1 = 'maraphon_counter_id_'.$current_order_id_for_output.'';
								$maraphon_counter = $_POST[$data1];
								
								$data2 = 'maraphon_member_month_id_'.$current_order_id_for_output.'';
								$maraphon_member_month = $_POST[$data2];
								if ($maraphon_member_month == '') {
									$maraphon_member_month = '';
								} else {
								$maraphon_member_month = substr($maraphon_member_month, 0, 2);
								if (($maraphon_member_month + 1) < current_time('n')) {
									$next_year = current_time('Y') + 1;
									$maraphon_member_month = $maraphon_member_month.'.'.$next_year;
								} else {
									$this_year = current_time('Y');
									$maraphon_member_month = $maraphon_member_month.'.'.$this_year;
								}
								};
								
							/*	$data6 = 'men_menu_id_'.$current_order_id_for_output.'';
								$men_menu = $_POST[$data6]; */
								
								$data7 = 'credit_id_'.$current_order_id_for_output.'';
								$credit = $_POST[$data7];
								
								$data3 = 'paid_id_'.$current_order_id_for_output.'';
								$paid = $_POST[$data3];
								
								$data4 = 'amount_id_'.$current_order_id_for_output.'';
								$amount = $_POST[$data4];
								
								$data5 = 'admin_comment_id_'.$current_order_id_for_output.'';
								$admin_comment = sanitize_text_field($_POST[$data5]);
								
								$data8 = 'pdf_menu_id_'.$current_order_id_for_output.'';
								$pdf = $_POST[$data8];

								if (isset($_POST[$data1])){
									update_user_meta( $current_user_id_for_output, 'maraphon_counter', $maraphon_counter );
								}; 
								
								$boolean_type = (!empty($_POST[$data3])) ? (int) $_POST[$data3] : 0;
								$boolean_type_credit = (!empty($_POST[$data7])) ? (int) $_POST[$data7] : 0;
								
								$wpdb->update(
									'wpux_orders',
									array( 
									'pdf' => $pdf,
									'maraphon_member_month' => $maraphon_member_month,
									'credit' => $boolean_type_credit,
									'paid' => $boolean_type,
									'amount' => $amount,
									'admin_comment' => $admin_comment,
									'user_id' => $current_user_id_for_output
									),
									array(
									'order_id' => $current_order_id_for_output
									)
									);
																	
		    				} //Тело цикла
						} //Тело первоначального условия

				die();
		}
		add_action('wp_ajax_formOrdersByPeriodUpdate', 'formOrdersByPeriodUpdate');
		add_action('wp_ajax_nopriv_formOrdersByPeriodUpdate', 'formOrdersByPeriodUpdate'); 

// ----------- Обработчик отчета по заказам и оплатам в ветке выбора по дате заказа /date - Заказы ----------- //
function formOrdersByDateUpdate(){ 
	
		global $wpdb;
		$choose_period_by_date_month_update = $_POST['choose_period_by_date_month'];
		$choose_period_by_date_year_update = $_POST['choose_period_by_date_year'];
		
		$date_from = $choose_period_by_date_year_update.'-'.$choose_period_by_date_month_update.'-01';
		$date_before = $choose_period_by_date_year_update.'-'.$choose_period_by_date_month_update.'-31';
		
		$this_month_report_by_date_update = $wpdb->get_results(
						"
						SELECT 
						orders.date AS order_date,
						orders.order_id AS order_id,
						users.ID AS user_id_check,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'first_name' limit 1) as first_name,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'last_name' limit 1) as last_name,
						(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'maraphon_counter' limit 1) as maraphon_counter,
						orders.maraphon_member_month,
						orders.maraphon_next_month,
						orders.pdf,
						orders.credit,
						orders.paid,
						orders.amount,
						orders.admin_comment
						FROM wpux_orders orders, wpux_users users
						WHERE (DATE(orders.date) BETWEEN '$date_from' AND '$date_before')
						AND orders.maraphon_next_month != ''
						AND orders.user_email = users.user_email 
						ORDER BY orders.order_id
						"
						);	
						
						if( $this_month_report_by_date_update ) {
					    	foreach ( $this_month_report_by_date_update as $string_report_data ) {
						    	$current_user_id_for_output = $string_report_data->user_id_check;
							    $current_order_id_for_output = $string_report_data->order_id;
							    
							    $data1 = 'maraphon_counter_id_'.$current_order_id_for_output.'';
								$maraphon_counter = $_POST[$data1];
								
								$data2 = 'maraphon_member_month_id_'.$current_order_id_for_output.'';
								$maraphon_member_month = $_POST[$data2];
								if ($maraphon_member_month == '') {
									$maraphon_member_month = '';
								} else {
								$maraphon_member_month = substr($maraphon_member_month, 0, 2);
								if (($maraphon_member_month + 1) < current_time('n')) {
									$next_year = current_time('Y') + 1;
									$maraphon_member_month = $maraphon_member_month.'.'.$next_year;
								} else {
									$this_year = current_time('Y');
									$maraphon_member_month = $maraphon_member_month.'.'.$this_year;
								}
								};
								
							/*	$data6 = 'men_menu_id_'.$current_order_id_for_output.'';
								$men_menu = $_POST[$data6]; */
								
								$data7 = 'credit_id_'.$current_order_id_for_output.'';
								$credit = $_POST[$data7];
								
								$data3 = 'paid_id_'.$current_order_id_for_output.'';
								$paid = $_POST[$data3];
								
								$data4 = 'amount_id_'.$current_order_id_for_output.'';
								$amount = $_POST[$data4];
								
								$data5 = 'admin_comment_id_'.$current_order_id_for_output.'';
								$admin_comment = sanitize_text_field($_POST[$data5]);
								
								$data8 = 'pdf_menu_id_'.$current_order_id_for_output.'';
								$pdf = $_POST[$data8];

								if (isset($_POST[$data1])){
									update_user_meta( $current_user_id_for_output, 'maraphon_counter', $maraphon_counter );
								}; 
								
							/*	if (isset($_POST[$data6])){
									update_user_meta( $current_user_id_for_output, 'men_menu_lk', $men_menu );
								};  */
								
								$boolean_type = (!empty($_POST[$data3])) ? (int) $_POST[$data3] : 0;
								$boolean_type_credit = (!empty($_POST[$data7])) ? (int) $_POST[$data7] : 0;
								
								$wpdb->update(
									'wpux_orders',
									array( 
									'pdf' => $pdf,
									'maraphon_member_month' => $maraphon_member_month,
									'credit' => $boolean_type_credit,
									'paid' => $boolean_type,
									'amount' => $amount,
									'admin_comment' => $admin_comment,
									'user_id' => $current_user_id_for_output
									),
									array(
									'order_id' => $current_order_id_for_output
									)
									);
										
		    				} //Тело цикла
						} //Тело первоначального условия		
die();
}
		add_action('wp_ajax_formOrdersByDateUpdate', 'formOrdersByDateUpdate');
		add_action('wp_ajax_nopriv_formOrdersByDateUpdate', 'formOrdersByDateUpdate'); 
		
// ----------- Отчет по настройкам меню ----------- //
function chooseSettingsByType(){
		global $wpdb;
		$choose_settings_by_type = $_POST['choose_settings_by_type'];
		$_monthsList = array(
			"1"=>"Январь","2"=>"Февраль","3"=>"Март",
			"4"=>"Апрель","5"=>"Май", "6"=>"Июнь",
			"7"=>"Июль","8"=>"Август","9"=>"Сентябрь",
			"10"=>"Октябрь","11"=>"Ноябрь","12"=>"Декабрь");
			$month = $_monthsList[current_time("n")];
		echo '<h2 class="paid_by_date_h2">Ссылки на файлы меню для покупателей</h2>';
		echo '<br>';

		if ($choose_settings_by_type == 'menu_settings') {  												//начало условия при выборе настроек меню
			
			
			$menu_list_array = $wpdb->get_results(
						"
						SELECT 
						*
						FROM wpux_menu_list
						"
						);	

						if( $menu_list_array ) {
							echo '<form id="formSettingsByMenu">';
							echo '<input type="hidden" name="action" value="chooseSettingsByMenuUpdate"/>';
							echo '<input style="position: absolute; margin-left: 885px; margin-top: -66px;" type="submit" id="updateuser" class="submit button members_mobile_hide" value="Записать">';
										
								echo '<table class="paid_table_for_admin">';
									echo '<tr style="background-color: #f6f6f6;">';
										echo '<th style="width: 2%">&nbsp;№&nbsp;</th>';
										echo '<th style="width: 8%">&nbsp;Мужское/женское&nbsp;</th>';
										echo '<th style="width: 8%">&nbsp;Калораж&nbsp;</th>';
										echo '<th style="width: 60%">&nbsp;Полный путь к файлу&nbsp;</th>';
										echo '<th>&nbsp;Комментарий администратора&nbsp;</th>';
									echo '</tr>';
							
							$menu_month_check = 0;
					    	foreach ( $menu_list_array as $menu_string ) {
						    	
						    	
						    	if ($menu_month_check != $menu_string->month) {
							    	echo '<tr style="background-color: #f6f6f6;">';
							    	echo '<td colspan="5">';
							    		echo $_monthsList[$menu_string->month];
							    	echo '</td>';
							    	echo '</tr>';
							    	echo '<tr>';
							    		echo '<td>';
							    			$menu_id = $menu_string->menu_id;
							    			echo $menu_id;
							    		echo '</td>';
							    		echo '<td>';
							    			echo $menu_string->type;
							    		echo '</td>';
							    		echo '<td>';
							    			echo $menu_string->kcal;
							    		echo '</td>';
							    		echo '<td>';
							    			echo '<input style="width: 100%; height: 28px; background-color: '.$whatsapp_color.'; vertical-align: bottom;" class="text-input" name="url_id_'.$menu_id.'" type="text" id="url_id" value="'.$menu_string->url.'" />';
							    		echo '</td>';
							    		echo '<td>';
							    			echo '<input style="width: 100%; height: 28px; background-color: '.$whatsapp_color.'; vertical-align: bottom;" class="text-input" name="admin_comment_id_'.$menu_id.'" type="text" id="admin_comment_id" value="'.$menu_string->admin_comment.'" />';
							    		echo '</td>';
							    	echo '</tr>';
						    	} else {
							    	echo '<tr>';
							    		echo '<td>';
							    			$menu_id = $menu_string->menu_id;
							    			echo $menu_id;
							    		echo '</td>';
							    		echo '<td>';
							    			echo $menu_string->type;
							    		echo '</td>';
							    		echo '<td>';
							    			echo $menu_string->kcal;
							    		echo '</td>';
							    		echo '<td>';
							    			echo '<input style="width: 100%; height: 28px; background-color: '.$whatsapp_color.'; vertical-align: bottom;" class="text-input" name="url_id_'.$menu_id.'" type="text" id="url_id" value="'.$menu_string->url.'" />';
							    		echo '</td>';
							    		echo '<td>';
							    			echo '<input style="width: 100%; height: 28px; background-color: '.$whatsapp_color.'; vertical-align: bottom;" class="text-input" name="admin_comment_id_'.$menu_id.'" type="text" id="admin_comment_id" value="'.$menu_string->admin_comment.'" />';
							    		echo '</td>';
							    	echo '</tr>';
						    	}
								$menu_month_check = $menu_string->month;
							};	
								echo '</table>';
								echo '<div id="success_form">Данные обновлены</div>';
							
								echo '<input type="hidden" name="action" value="formMenuSettingsUpdate"/>';
								echo '<input style="margin-bottom: 40px;" type="submit" id="updateuser" class="submit button paid_button" value="Записать">';
							echo '</form>'; 
			
			echo '<script type="text/javascript">';
			echo 'jQuery("#formSettingsByMenu").submit(ajaxformSettingsByMenu);';
				echo 'function ajaxformSettingsByMenu(){';
					echo 'var formSettingsByMenu = jQuery(this).serialize();';
					echo '$.ajaxSetup({cache: false});';
						echo 'jQuery.ajax({';
						echo 'type:"POST",';
						echo 'url: "/wp-admin/admin-ajax.php",';
						echo 'data: formSettingsByMenu,';
							echo 'success:function(data){';
							echo '$("#success_form").show();';
							//echo '$("#success_form").html(data);';
							echo 'setTimeout(function(){$("#success_form").fadeOut("slow")},1000);';
							echo '}';
						echo '});';
					echo 'return false;';
				echo '}';
			echo '</script>';
			};
		};																								//конец условия при выборе настроек меню
		
die();
}
		add_action('wp_ajax_chooseSettingsByType', 'chooseSettingsByType');
		add_action('wp_ajax_nopriv_chooseSettingsByType', 'chooseSettingsByType');

// ----------- Обработчик настроек меню ----------- //
function formMenuSettingsUpdate(){ 
		global $wpdb;
		$menu_list_array_update = $wpdb->get_results(
			"
			SELECT 
			*
			FROM wpux_menu_list
			"
		);

		if( $menu_list_array_update ) {
			foreach ( $menu_list_array_update as $menu_string_update ) {
				$current_menu_id = $menu_string_update->menu_id;
								
				$data1 = 'url_id_'.$current_menu_id.'';
				$url = sanitize_text_field($_POST[$data1]);
								
				$data2 = 'admin_comment_id_'.$current_menu_id.'';
				$admin_comment = $_POST[$data2];
								
				$wpdb->update(
					'wpux_menu_list',
						array( 
						'url' => $url,
						'admin_comment' => $admin_comment
						),
						array(
						'menu_id' => $current_menu_id
						)
						);
				};
		};
		
						/*	$wpdb->insert(
									'wpux_menu_list',
									array(
									'month' => 3,	
									'type' => 'Мужское',
									'kcal' => 1600,
									'url' => '',
									'admin_comment' => ''
									)
									);  */
		
		
		die();
}
		add_action('wp_ajax_formMenuSettingsUpdate', 'formMenuSettingsUpdate');
		add_action('wp_ajax_nopriv_formMenuSettingsUpdate', 'formMenuSettingsUpdate'); 


// ----------- Создание типа записи "Тренировки" ----------- //
add_action( 'init', 'true_register_post_type_init' ); // Использовать функцию только внутри хука init
 
function true_register_post_type_init() {
	$labels = array(
		'name' => 'Тренировки',
		'singular_name' => 'Тренировка', // админ панель Добавить->Функцию
		'add_new' => 'Добавить новую',
		'add_new_item' => 'Добавить новую тренировку', // заголовок тега <title>
		'edit_item' => 'Редактировать тренировку',
		'new_item' => 'Новая тренировка',
		'all_items' => 'Все тренировки',
		'view_item' => 'Просмотр тренировки на сайте',
		'search_items' => 'Искать тренировки',
		'not_found' =>  'Тренировок не найдено.',
		'not_found_in_trash' => 'В корзине нет тренировок.',
		'menu_name' => 'Тренировки' // ссылка в меню в админке
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'show_ui' => true, // показывать интерфейс в админке
		'has_archive' => true, 
		'menu_icon' => 'dashicons-universal-access',
		//'menu_icon' => get_stylesheet_directory_uri() .'/img/function_icon.png', // иконка в меню
		'menu_position' => 4, // порядок в меню
		'supports' => array( 'title', 'editor', 'comments', 'author', 'thumbnail')
	);
	register_post_type('workout', $args);
}

// ----------- Создание таксономии "Классы" в записях "Тренировки" ----------- //
function add_new_taxonomies() {	
	register_taxonomy('classes',
		array('workout'),
		array(
			'hierarchical' => true,
			// true - по типу рубрик, false - по типу меток, 
			// по умолчанию - false 
			'labels' => array(
				'name' => 'Классы',
				'singular_name' => 'Класс',
				'search_items' =>  'Найти класс',
				//'popular_items' => 'Популярные платформы',
				'all_items' => 'Все классы',
				'parent_item' => null,
				'parent_item_colon' => null,
				'edit_item' => 'Редактировать класс', 
				'update_item' => 'Обновить класс',
				'add_new_item' => 'Добавить новый класс',
				'new_item_name' => 'Название нового класса',
				'separate_items_with_commas' => 'Разделяйте классы запятыми',
				'add_or_remove_items' => 'Добавить или удалить класс',
				'choose_from_most_used' => 'Выбрать из наиболее часто используемых классов', 
				'menu_name' => 'Классы'
			),
			'public' => true, 
			// каждый может использовать таксономию, либо
			//только администраторы, по умолчанию - true 
			'show_in_nav_menus' => true,
			// добавить на страницу создания меню 
			'show_ui' => true,
			// добавить интерфейс создания и редактирования
			'show_tagcloud' => true,
			// нужно ли разрешить облако тегов для этой таксономии 
			'update_count_callback' => '_update_post_term_count',
			// callback-функция для обновления счетчика $object_type 
			'query_var' => true,
			// разрешено ли использование query_var, также можно 
			//указать строку, которая будет использоваться в качестве 
			//него, по умолчанию - имя таксономии
			'rewrite' => array(
			// настройки URL пермалинков
				'slug' => 'workout', // ярлык
				'hierarchical' => true // разрешить вложенность
			),
		)
	);
}
add_action( 'init', 'add_new_taxonomies', 0 ); 

// ----------- Создание типа записи "Wikipedia" ----------- //
add_action( 'init', 'true_register_wiki_type_init' ); // Использовать функцию только внутри хука init
 
function true_register_wiki_type_init() {
	$labels = array(
		'name' => 'Wikipedia',
		'singular_name' => 'Страница Wiki', // админ панель Добавить->Функцию
		'add_new' => 'Добавить новую страницу Wiki',
		'add_new_item' => 'Добавить новую страницу Wiki', // заголовок тега <title>
		'edit_item' => 'Редактировать страницу Wiki',
		'new_item' => 'Новая страница Wiki',
		'all_items' => 'Все страницы Wiki',
		'view_item' => 'Просмотр страницы Wiki на сайте',
		'search_items' => 'Искать страницы Wiki',
		'not_found' =>  'Страниц Wiki не найдено.',
		'not_found_in_trash' => 'В корзине нет страниц Wiki.',
		'menu_name' => 'Wikipedia' // ссылка в меню в админке
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'show_ui' => true, // показывать интерфейс в админке
		'has_archive' => true, 
		'menu_icon' => 'dashicons-admin-site-alt3',
		//'menu_icon' => get_stylesheet_directory_uri() .'/img/function_icon.png', // иконка в меню
		'menu_position' => 5, // порядок в меню
		'supports' => array( 'title', 'editor', 'comments', 'author', 'thumbnail')
	);
	register_post_type('wikipedia', $args);
}

// ----------- Создание типа записи "Инструкция к меню" ----------- //
add_action( 'init', 'true_register_manual_type_init' ); // Использовать функцию только внутри хука init
 
function true_register_manual_type_init() {
	$labels = array(
		'name' => 'Инструкции',
		'singular_name' => 'Инструкции', // админ панель Добавить->Функцию
		'add_new' => 'Добавить новую',
		'add_new_item' => 'Добавить новую', // заголовок тега <title>
		'edit_item' => 'Редактировать инструкцию',
		'new_item' => 'Новая страница инструкции',
		'all_items' => 'Все инструкции',
		'view_item' => 'Просмотр инструкций на сайте',
		'search_items' => 'Искать инструкции',
		'not_found' =>  'Инструкций не найдено.',
		'not_found_in_trash' => 'В корзине нет инструкций.',
		'menu_name' => 'Инструкции' // ссылка в меню в админке
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'show_ui' => true, // показывать интерфейс в админке
		'has_archive' => true, 
		'menu_icon' => 'dashicons-analytics',
		//'menu_icon' => get_stylesheet_directory_uri() .'/img/function_icon.png', // иконка в меню
		'menu_position' => 6, // порядок в меню
		'supports' => array( 'title', 'editor', 'comments', 'author', 'thumbnail')
	);
	register_post_type('manual', $args);
}

// ----------- Создание типа записи "Разбор продуктов" ----------- //
add_action( 'init', 'true_register_razbor_type_init' ); // Использовать функцию только внутри хука init
 
function true_register_razbor_type_init() {
	$labels = array(
		'name' => 'Разбор продуктов',
		'singular_name' => 'Страница разбора', // админ панель Добавить->Функцию
		'add_new' => 'Добавить новую',
		'add_new_item' => 'Добавить новую', // заголовок тега <title>
		'edit_item' => 'Редактировать страницу разбора продуктов',
		'new_item' => 'Новая страница разбора продуктов',
		'all_items' => 'Все страницы разбора продуктов',
		'view_item' => 'Просмотр страницы разбора продуктов на сайте',
		'search_items' => 'Искать страницы разбора продуктов',
		'not_found' =>  'Страниц разбора продуктов не найдено.',
		'not_found_in_trash' => 'В корзине нет страниц разбора продуктов.',
		'menu_name' => 'Разбор прод.' // ссылка в меню в админке
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'show_ui' => true, // показывать интерфейс в админке
		'has_archive' => true, 
		'menu_icon' => 'dashicons-cart',
		//'menu_icon' => get_stylesheet_directory_uri() .'/img/function_icon.png', // иконка в меню
		'menu_position' => 7, // порядок в меню
		'supports' => array( 'title', 'editor', 'comments', 'author', 'thumbnail')
	);
	register_post_type('razbor', $args);
}

// ----------- Создание таксономии "Подразделы" в записях "Разбор продуктов" ----------- //
function add_subsection_taxonomies() {	
	register_taxonomy('subsection',
		array('razbor'),
		array(
			'hierarchical' => true,
			// true - по типу рубрик, false - по типу меток, 
			// по умолчанию - false 
			'labels' => array(
				'name' => 'Подразделы',
				'singular_name' => 'Подразделы',
				'search_items' =>  'Найти подразделы',
				//'popular_items' => 'Популярные платформы',
				'all_items' => 'Все подразделы',
				'parent_item' => null,
				'parent_item_colon' => null,
				'edit_item' => 'Редактировать подраздел', 
				'update_item' => 'Обновить подраздел',
				'add_new_item' => 'Добавить новый подраздел',
				'new_item_name' => 'Название нового подраздел',
				'separate_items_with_commas' => 'Разделяйте подразделы запятыми',
				'add_or_remove_items' => 'Добавить или удалить подраздел',
				'choose_from_most_used' => 'Выбрать из наиболее часто используемых подразделов', 
				'menu_name' => 'Подразделы'
			),
			'public' => true, 
			// каждый может использовать таксономию, либо
			//только администраторы, по умолчанию - true 
			'show_in_nav_menus' => true,
			// добавить на страницу создания меню 
			'show_ui' => true,
			// добавить интерфейс создания и редактирования
			'show_tagcloud' => true,
			// нужно ли разрешить облако тегов для этой таксономии 
			'update_count_callback' => '_update_post_term_count',
			// callback-функция для обновления счетчика $object_type 
			'query_var' => true,
			// разрешено ли использование query_var, также можно 
			//указать строку, которая будет использоваться в качестве 
			//него, по умолчанию - имя таксономии
			'rewrite' => array(
			// настройки URL пермалинков
				'slug' => 'razbor', // ярлык
				'hierarchical' => true // разрешить вложенность
			),
		)
	);
}
add_action( 'init', 'add_subsection_taxonomies', 0 ); 

// ----------- Создание типа записи "Разбор продуктов" ----------- //
add_action( 'init', 'my_blog_type_init' ); // Использовать функцию только внутри хука init
 
function my_blog_type_init() {
	$labels = array(
		'name' => 'Блог',
		'singular_name' => 'Страница блога', // админ панель Добавить->Функцию
		'add_new' => 'Добавить новую страницу блога',
		'add_new_item' => 'Добавить новую страницу блога', // заголовок тега <title>
		'edit_item' => 'Редактировать страницу блога',
		'new_item' => 'Новая страница блога',
		'all_items' => 'Все страницы блога',
		'view_item' => 'Просмотр страницы блога на сайте',
		'search_items' => 'Искать страницы блога',
		'not_found' =>  'Страниц блога не найдено.',
		'not_found_in_trash' => 'В корзине нет страниц блога.',
		'menu_name' => 'Блог' // ссылка в меню в админке
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'show_ui' => true, // показывать интерфейс в админке
		'has_archive' => true, 
		'menu_icon' => 'dashicons-twitter',
		//'menu_icon' => get_stylesheet_directory_uri() .'/img/function_icon.png', // иконка в меню
		'menu_position' => 8, // порядок в меню
		'supports' => array( 'title', 'editor', 'comments', 'author', 'thumbnail')
	);
	register_post_type('blog', $args);
}


/* ----------- Создание таксономии "Ярлыки" в записях "Wikipedia" ----------- //
function add_new_taxonomies_wiki() {	
	register_taxonomy('category',
		array('wikipedia'),
		array(
			'hierarchical' => true,
			// true - по типу рубрик, false - по типу меток, 
			// по умолчанию - false 
			'labels' => array(
				'name' => 'Категории страниц Wiki',
				'singular_name' => 'Категория страницы Wiki',
				'search_items' =>  'Найти категорию страницы Wiki',
				//'popular_items' => 'Популярные платформы',
				'all_items' => 'Все категории',
				'parent_item' => null,
				'parent_item_colon' => null,
				'edit_item' => 'Редактировать категорию', 
				'update_item' => 'Обновить категорию',
				'add_new_item' => 'Добавить новую категорию',
				'new_item_name' => 'Название новой категории',
				'separate_items_with_commas' => 'Разделяйте категории запятыми',
				'add_or_remove_items' => 'Добавить или удалить категорию',
				'choose_from_most_used' => 'Выбрать из наиболее часто используемых категорий', 
				'menu_name' => 'Категории'
			),
			'public' => true, 
			// каждый может использовать таксономию, либо
			//только администраторы, по умолчанию - true 
			'show_in_nav_menus' => true,
			// добавить на страницу создания меню 
			'show_ui' => true,
			// добавить интерфейс создания и редактирования
			'show_tagcloud' => true,
			// нужно ли разрешить облако тегов для этой таксономии 
			'update_count_callback' => '_update_post_term_count',
			// callback-функция для обновления счетчика $object_type 
			'query_var' => true,
			// разрешено ли использование query_var, также можно 
			//указать строку, которая будет использоваться в качестве 
			//него, по умолчанию - имя таксономии
			'rewrite' => array(
			// настройки URL пермалинков
				'slug' => 'wikipedia', // ярлык
				'hierarchical' => true // разрешить вложенность
 
			),
		)
	);
}
add_action( 'init', 'add_new_taxonomies_wiki', 0 ); */
