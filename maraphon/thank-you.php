<?php
/*
Template Name: thank-you
*/
get_header();
	global $wpdb;
	$current_user = wp_get_current_user();
	$user_id = $current_user->ID;
	
	/*$update_family_men_menu = $wpdb->get_var( 
		"
		SELECT 
		COUNT(*)
		FROM wpux_orders orders
		WHERE orders.user_id = $user_id
		AND orders.maraphon_next_month LIKE '%Семейный%'
		ORDER BY orders.date DESC limit 1
		"	
		);
	if ($update_family_men_menu == 1 && get_the_author_meta( 'men_menu_lk', $user_id ) != 'men_menu') {
		$men_menu = 'men_menu';
		update_user_meta( $user_id, 'men_menu_lk', $men_menu );
	}; */
	
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
?>
	<div class="thank_you_page_content">
		
		<h1 class="thank_you_page_h1">Спасибо за Ваш заказ на maraphon.online!</h1>
		<div class="grey_line"></div>
		<p class="thank_you_page_p" id="thank_you_page_admin">Администратор Наталья свяжется с вами в течение часа (с 09:00 до 00:00, МСК+4 Новосибирск)</p>
		<p class="thank_you_page_p">В дальнейшем все вопросы по оплате, предоставлению доступа и работе сайта можно задавать ей.</p>
		<p class="thank_you_page_p"><a href="https://api.whatsapp.com/send?phone=+79095496086" target="_blank" class="thank_you_page_p_wa">Нажмите, чтобы сохранить ее номер в Whatsapp</a></p>
		<br>
		<br>
		<p class="thank_you_page_p">После приобретения меню или марафона, вы можете сразу заполнить анкету. <a href="<?php echo $thank_you_report_link; ?>" target="_blank" class="thank_you_page_p_a">Нажмите для заполнения анкеты</a></p>
		<p class="thank_you_page_p">Данные анкеты необходимы для индивидуального подбора меню (и тренировок) по вашим параметрам</p>
		
		<div class="grey_line"></div>
		<h2 class="thank_you_page_h2">Марафон онлайн от Екатерины Войтенко. Красивая фигура - это просто</h2>
	</div>
			
	</main><!-- #main -->
	
<?php
get_footer();
