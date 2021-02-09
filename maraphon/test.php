<?php
/*
Template Name: test
*/
	//get_header();
?>



<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta name="description" content="Марафон онлайн Екатерины Войтенко. Красота и здоровье в твоих руках. 28 дней онлайн с профессиональным фитнес тренером. Присоединяйся!" />
	<meta name="keywords" content="марафон онлайн Екатерины Войтенко, Екатерина Войтенко марафон, марафон стройности, красота и здоровье +в твоих руках, онлайн марафон +Войтенко, комфортное похудение, твое идеальное тело в надежных руках, твое идеальное тело, хочу похудеть, как быстро похудеть, как лучше похудеть, как лучше худеть, правильно похудение, сайт Войтенко, сайт марафон онлайн, сайт maraphon online, сайт marathon online" />
	<!-- <link rel="stylesheet" href="http://maraphon.online/wp-content/themes/maraphon/style.css" type="text/css"/> -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <script src="<?php echo content_url() ?>/themes/maraphon/js/jquery-1.9.1.min.js"></script> -->
	<script src="https://use.fontawesome.com/5852179b3a.js"></script> 
	<link rel="apple-touch-icon" href="/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon.png">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>

	<!-- Yandex.Metrika counter -->
	<script type="text/javascript" >
   	(function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   	m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   	(window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   	ym(68040997, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   	});
	</script>
	<noscript><div><img src="https://mc.yandex.ru/watch/68040997" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
	<!-- /Yandex.Metrika counter -->
	
	<!--LiveInternet counter--><script>
	new Image().src = "https://counter.yadro.ru/hit?r"+
	escape(document.referrer)+((typeof(screen)=="undefined")?"":
	";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
	screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
	";h"+escape(document.title.substring(0,150))+
	";"+Math.random();</script><!--/LiveInternet-->

    <script type="text/javascript">
	/*    //запрет ctrl + a, ctrl + c, ctrl + u
		document.ondragstart = test;
		document.onselectstart = test;
		//document.oncontextmenu = test;
		function test() {
		return false;
		}
		document.oncontextmenu;
		function catchControlKeys(event){
		var code=event.keyCode ? event.keyCode : event.which ? event.which : null;
		if (event.ctrlKey){
		// Ctrl+U
		if (code == 117) return false;
		if (code == 85) return false;
		// Ctrl+C
		if (code == 99) return false;
		if (code == 67) return false;
		// Ctrl+A
		if (code == 97) return false;
		if (code == 65) return false;
		}
		}  */
	</script>
	
</head>

<script>
                (function(){
                    if (typeof(window.orientation) !== 'undefined')
                    {
                        function getDeviceWidth()
                    {
                        var deviceWidth = window.orientation == 0 ? window.screen.width : window.screen.height;
                        if (navigator.userAgent.indexOf('Android') >= 0 && window.devicePixelRatio)
                            deviceWidth = deviceWidth / window.devicePixelRatio;
                        return deviceWidth;
                    }

                    var deviceWidth = getDeviceWidth();
                    var maxWidth = 900;

                    if (deviceWidth < maxWidth)
                    {
                    if (window.orientation == 0 || window.orientation == 180)
                        document.write('<meta name="viewport" content="width=device-width">');
                    else
                        document.write('<meta name="viewport" content="width=device-height">');
                    }
                    else
                        document.write('<meta name="viewport" content="width=' + maxWidth + '">');
                    }
                 })();
            </script>

<body onkeypress="return catchControlKeys(event)" <?php body_class(); ?>>

<?php 
	wp_body_open();
	global $wpdb, $user_id, $check_any_workout_to_buy, $check_women_menu_to_buy, $check_men_menu_to_buy, $show_women_menu_tab, $show_men_menu_tab, $show_workout_tab;
	$current_user = wp_get_current_user();
	$user_id = $current_user->ID;
	
	$check_any_workout_to_buy = $wpdb->get_var(				 //проверка для вывода тренировок для покупателей тренировок через таблицу wpux_orders_workout
		"
		SELECT
		COUNT(*)
		FROM wpux_orders_workout workout
		WHERE workout.user_id = $user_id
		AND workout.paid = 1
	"
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
	
	$check_women_menu_to_buy = $wpdb->get_var(				 //проверка для вывода меню для покупателей женского меню через таблицу wpux_orders_menu
		"
		SELECT
		COUNT(*)
		FROM wpux_orders_menu menu
		WHERE menu.user_id = $user_id
		AND menu.paid = 1
		AND menu.content LIKE '%Жен%'
	"
	);
	
		if (is_user_role('administrator', $user_id) || is_user_role('content_1', $user_id)) {
			$show_admin_tab = 1;
		};
					
		if (is_user_role('maraphon_1200', $user_id) || is_user_role('maraphon_1400', $user_id) || is_user_role('maraphon_1600', $user_id) || is_user_role('maraphon_1800', $user_id) || is_user_role('maraphon_2000', $user_id) || is_user_role('maraphon_2200', $user_id) || is_user_role('maraphon_2500', $user_id)) {
			$show_maraphon_tab = 1;
		};
		
		if ($check_women_menu_to_buy > 0) {
			$show_women_menu_tab = 1;
		};
		
		if ($check_men_menu_to_buy > 0) {
			$show_men_menu_tab = 1;
		};
		
		if ($check_any_workout_to_buy > 0) {
			$show_workout_tab = 1;
		};

?>
<div id="page" class="site page">
	<header id="masthead" class="site-header">

	<a href="https://instagram.com/voitenko_catsss" target="_blank" class="instagram_logo"><img src="<?php echo content_url() ?>/uploads/instagram-icon-60x60-1.png"/></a>
        <a href="https://api.whatsapp.com/send?phone=79528986463" target="_blank" class="whatsapp_logo"><img src="<?php echo content_url() ?>/uploads/whatsapp-icon-60x60-1.png"/></a>	
       	<a href="/"><img class="logo" src="<?php echo content_url() ?>/uploads/logo-png-125x160-1.png"></a>
	
	<?php
	
	if (!is_user_logged_in()) {	
		echo '<a href="/wp-login.php?" class="lk">&nbsp;&nbsp;Войти&nbsp;&nbsp;</a>';
	} else if ( $show_admin_tab == 1 || $show_maraphon_tab == 1 ) {
		echo '<a href="/lk" class="lk">&nbsp;&nbsp;'.wp_get_current_user()->first_name ."\n".wp_get_current_user()->last_name.'&nbsp;&nbsp;</a>';
	} else if ($show_men_menu_tab == 1) {
		echo '<a href="/lk#tab6" class="lk">&nbsp;&nbsp;'.wp_get_current_user()->first_name ."\n".wp_get_current_user()->last_name.'&nbsp;&nbsp;</a>';
	} else if ($show_women_menu_tab == 1 || $show_workout_tab == 1) {
		echo '<a href="/lk#tab5" class="lk">&nbsp;&nbsp;'.wp_get_current_user()->first_name ."\n".wp_get_current_user()->last_name.'&nbsp;&nbsp;</a>';
	} else if (is_user_logged_in()) {
		echo '<a href="/lk#tab5" class="lk">&nbsp;&nbsp;'.wp_get_current_user()->first_name ."\n".wp_get_current_user()->last_name.'&nbsp;&nbsp;</a>';
	};
	?>
   
    <div class="opacity-line"></div>

    <div class="nav">
        <span id="trigger" class="trigger">
          <i></i>
          <i></i>
          <i></i>
        </span>
        
      <ul id="menu" class="menu">
	    <li class="first_level show_menu"><a href="/shop/"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ИНТЕРНЕТ-МАГАЗИН</a></li>
	    <?php									//построение выпадающего меню моб. версии. Меняется кол-во пунктов и их порядок
		if ($show_admin_tab == 1) { 
		echo '<li class="first_level show_menu" id="mobile_menu_workout"><a href="/lk#tab4"><i class="fa fa-rocket" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОИ ТРЕНИРОВКИ</a></li>';	
		echo '<li class="first_level show_menu" id="mobile_menu_men_menu"><a href="/lk#tab3"><i class="fa fa-file-text" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МУЖСКОЕ МЕНЮ</a></li>';
		echo '<li class="first_level show_menu" id="mobile_menu_women_menu"><a href="/lk#tab2"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ЖЕНСКОЕ МЕНЮ</a></li>';
		echo '<li class="first_level show_menu" id="mobile_menu_razbor_produktov"><a href="/razbor-produktov/"><i class="fa fa-balance-scale" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;РАЗБОР ПРОДУКТОВ</a></li>';	
		echo '<li class="first_level show_menu" id="mobile_menu_report"><a href="/lk/"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ЕЖЕДНЕВНЫЙ ОТЧЕТ</a></li>';
		echo '<li class="first_level show_menu"><a href="/director-cabinet/"><i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;УПРАВЛЕНИЕ МАРАФОНОМ</a></li>';
		echo '<li class="first_level show_menu"><a id="second_menu_level">&nbsp;&nbsp;&nbsp;ДАЛЕЕ&nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a></li>';	
		echo '<li class="second_level hide_menu"><a id="first_menu_level"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;НАЗАД</a></li>';
		echo '<li class="second_level hide_menu"><a href="/manual-home/"><i class="fa fa-graduation-cap" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ПРАВИЛА МАРАФОНА</a></li>';
		echo '<li class="second_level hide_menu"><a href="/kbju/"><i class="fa fa-calculator" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;СЧЕТЧИК КАЛОРИЙ</a></li>';
		echo '<li class="second_level hide_menu"><a href="/lk#tab6"><i class="fa fa-address-card-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОЯ АНКЕТА</a></li>';
		echo '<li class="second_level hide_menu"><a href="/lk#tab5"><i class="fa fa-trophy" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОИ ЗАМЕРЫ</a></li>';
		echo '<li class="second_level hide_menu"><a href="/feedback/"><i class="fa fa-comments-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ОТЗЫВЫ</a></li>';
		echo '<li class="second_level hide_menu"><a href="/blog/"><i class="fa fa-ravelry" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;БЛОГ</a></li>';
		echo '<li class="second_level hide_menu"><a href="'.wp_logout_url('/').'"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ВЫХОД</a></li>';
		} else 
		if ($show_maraphon_tab == 1 && $show_men_menu_tab == 1 && $show_admin_tab != 1) {
		echo '<li class="first_level show_menu" id="mobile_menu_workout"><a href="/lk#tab4"><i class="fa fa-rocket" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОИ ТРЕНИРОВКИ</a></li>';	
		echo '<li class="first_level show_menu" id="mobile_menu_men_menu"><a href="/lk#tab3"><i class="fa fa-file-text" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МУЖСКОЕ МЕНЮ</a></li>';
		echo '<li class="first_level show_menu" id="mobile_menu_women_menu"><a href="/lk#tab2"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ЖЕНСКОЕ МЕНЮ</a></li>';
		echo '<li class="first_level show_menu" id="mobile_menu_razbor_produktov"><a href="/razbor-produktov/"><i class="fa fa-balance-scale" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;РАЗБОР ПРОДУКТОВ</a></li>';	
		echo '<li class="first_level show_menu" id="mobile_menu_report"><a href="/lk/"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ЕЖЕДНЕВНЫЙ ОТЧЕТ</a></li>';
		echo '<li class="first_level show_menu"><a id="second_menu_level">&nbsp;&nbsp;&nbsp;ДАЛЕЕ&nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a></li>';	
		echo '<li class="second_level hide_menu"><a id="first_menu_level"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;НАЗАД</a></li>';
		echo '<li class="second_level hide_menu"><a href="/lk#tab6"><i class="fa fa-address-card-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОЯ АНКЕТА</a></li>';
		echo '<li class="second_level hide_menu"><a href="/lk#tab5"><i class="fa fa-trophy" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОИ ЗАМЕРЫ</a></li>';
		echo '<li class="second_level hide_menu"><a href="/feedback/"><i class="fa fa-comments-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ОТЗЫВЫ</a></li>';
		echo '<li class="second_level hide_menu"><a href="/blog/"><i class="fa fa-ravelry" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;БЛОГ</a></li>';
		echo '<li class="second_level hide_menu"><a href="'.wp_logout_url('/').'"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ВЫХОД</a></li>';	
		} else
		if ($show_maraphon_tab == 1 && $show_admin_tab != 1) {
		echo '<li class="first_level show_menu" id="mobile_menu_workout"><a href="/lk#tab3"><i class="fa fa-rocket" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОИ ТРЕНИРОВКИ</a></li>';	
		echo '<li class="first_level show_menu" id="mobile_menu_women_menu"><a href="/lk#tab2"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ЖЕНСКОЕ МЕНЮ</a></li>';
		echo '<li class="first_level show_menu" id="mobile_menu_razbor_produktov"><a href="/razbor-produktov/"><i class="fa fa-balance-scale" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;РАЗБОР ПРОДУКТОВ</a></li>';	
		echo '<li class="first_level show_menu" id="mobile_menu_report"><a href="/lk/"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ЕЖЕДНЕВНЫЙ ОТЧЕТ</a></li>';
		echo '<li class="first_level show_menu"><a id="second_menu_level">&nbsp;&nbsp;&nbsp;ДАЛЕЕ&nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a></li>';	
		echo '<li class="second_level hide_menu"><a id="first_menu_level"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;НАЗАД</a></li>';
		echo '<li class="second_level hide_menu"><a href="/lk#tab5"><i class="fa fa-address-card-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОЯ АНКЕТА</a></li>';
		echo '<li class="second_level hide_menu"><a href="/lk#tab4"><i class="fa fa-trophy" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОИ ЗАМЕРЫ</a></li>';
		echo '<li class="second_level hide_menu"><a href="/feedback/"><i class="fa fa-comments-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ОТЗЫВЫ</a></li>';
		echo '<li class="second_level hide_menu"><a href="/blog/"><i class="fa fa-ravelry" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;БЛОГ</a></li>';
		echo '<li class="second_level hide_menu"><a href="'.wp_logout_url('/').'"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ВЫХОД</a></li>';	
		} else 
		if ($show_women_menu_tab == 1 && $show_men_menu_tab == 1 && $show_workout_tab == 1 && $show_admin_tab != 1) {
		echo '<li class="first_level show_menu"><a href="/lk#tab6"><i class="fa fa-address-card-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОЯ АНКЕТА</a></li>';
		echo '<li class="first_level show_menu"><a href="/lk#tab5"><i class="fa fa-trophy" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОИ ЗАМЕРЫ</a></li>';
		echo '<li class="first_level show_menu" id="mobile_menu_workout"><a href="/lk#tab4"><i class="fa fa-rocket" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОИ ТРЕНИРОВКИ</a></li>';
		echo '<li class="first_level show_menu" id="mobile_menu_men_menu"><a href="/lk#tab3"><i class="fa fa-file-text" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МУЖСКОЕ МЕНЮ</a></li>';	
		echo '<li class="first_level show_menu" id="mobile_menu_women_menu"><a href="/lk#tab2"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ЖЕНСКОЕ МЕНЮ</a></li>';
		echo '<li class="first_level show_menu"><a href="'.wp_logout_url('/').'"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ВЫХОД</a></li>';		
		} else 
		if ($show_women_menu_tab == 1 && $show_men_menu_tab == 1 && empty($show_workout_tab)) {
		echo '<li class="first_level show_menu"><a href="/lk#tab6"><i class="fa fa-address-card-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОЯ АНКЕТА</a></li>';
		echo '<li class="first_level show_menu"><a href="/lk#tab5"><i class="fa fa-trophy" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОИ ЗАМЕРЫ</a></li>';
		echo '<li class="first_level show_menu" id="mobile_menu_workout"><a href="/workout-example"><i class="fa fa-rocket" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ПРИМЕР ТРЕНИРОВОК</a></li>';
		echo '<li class="first_level show_menu" id="mobile_menu_men_menu"><a href="/lk#tab3"><i class="fa fa-file-text" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МУЖСКОЕ МЕНЮ</a></li>';	
		echo '<li class="first_level show_menu" id="mobile_menu_women_menu"><a href="/lk#tab2"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ЖЕНСКОЕ МЕНЮ</a></li>';
		echo '<li class="first_level show_menu"><a href="'.wp_logout_url('/').'"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ВЫХОД</a></li>';		
		} else 
		if ($show_women_menu_tab == 1 && empty($show_men_menu_tab) && empty($show_workout_tab)) {
		echo '<li class="first_level show_menu"><a href="/lk#tab5"><i class="fa fa-address-card-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОЯ АНКЕТА</a></li>';
		echo '<li class="first_level show_menu"><a href="/lk#tab4"><i class="fa fa-trophy" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОИ ЗАМЕРЫ</a></li>';
		echo '<li class="first_level show_menu" id="mobile_menu_workout"><a href="/workout-example"><i class="fa fa-rocket" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ПРИМЕР ТРЕНИРОВОК</a></li>';	
		echo '<li class="first_level show_menu" id="mobile_menu_women_menu"><a href="/lk#tab2"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ЖЕНСКОЕ МЕНЮ</a></li>';
		echo '<li class="first_level show_menu"><a href="'.wp_logout_url('/').'"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ВЫХОД</a></li>';		
		} else 
		if (empty($show_women_menu_tab) && $show_men_menu_tab == 1 && empty($show_workout_tab)) {
		echo '<li class="first_level show_menu"><a href="/lk#tab6"><i class="fa fa-address-card-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОЯ АНКЕТА</a></li>';
		echo '<li class="first_level show_menu"><a href="/lk#tab5"><i class="fa fa-trophy" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОИ ЗАМЕРЫ</a></li>';
		echo '<li class="first_level show_menu" id="mobile_menu_workout"><a href="/workout-example"><i class="fa fa-rocket" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ПРИМЕР ТРЕНИРОВОК</a></li>';	
		echo '<li class="first_level show_menu" id="mobile_menu_men_menu"><a href="/lk#tab3"><i class="fa fa-file-text" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МУЖСКОЕ МЕНЮ</a></li>';
		echo '<li class="first_level show_menu"><a href="'.wp_logout_url('/').'"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ВЫХОД</a></li>';		
		} else 
		if (empty($show_women_menu_tab) && $show_men_menu_tab == 1 && $show_workout_tab == 1) {
		echo '<li class="first_level show_menu"><a href="/lk#tab6"><i class="fa fa-address-card-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОЯ АНКЕТА</a></li>';
		echo '<li class="first_level show_menu"><a href="/lk#tab5"><i class="fa fa-trophy" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОИ ЗАМЕРЫ</a></li>';
		echo '<li class="first_level show_menu" id="mobile_menu_workout"><a href="/lk#tab4"><i class="fa fa-rocket" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОИ ТРЕНИРОВКИ</a></li>';	
		echo '<li class="first_level show_menu" id="mobile_menu_men_menu"><a href="/lk#tab3"><i class="fa fa-file-text" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МУЖСКОЕ МЕНЮ</a></li>';
		echo '<li class="first_level show_menu"><a href="'.wp_logout_url('/').'"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ВЫХОД</a></li>';		
		} else 
		if ($show_women_menu_tab == 1 && empty($show_men_menu_tab) && $show_workout_tab == 1) {
		echo '<li class="first_level show_menu"><a href="/lk#tab5"><i class="fa fa-address-card-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОЯ АНКЕТА</a></li>';
		echo '<li class="first_level show_menu"><a href="/lk#tab4"><i class="fa fa-trophy" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОИ ЗАМЕРЫ</a></li>';
		echo '<li class="first_level show_menu" id="mobile_menu_workout"><a href="/lk#tab3"><i class="fa fa-rocket" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОИ ТРЕНИРОВКИ</a></li>';	
		echo '<li class="first_level show_menu" id="mobile_menu_women_menu"><a href="/lk#tab2"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ЖЕНСКОЕ МЕНЮ</a></li>';
		echo '<li class="first_level show_menu"><a href="'.wp_logout_url('/').'"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ВЫХОД</a></li>';		
		} else 
		if (empty($show_women_menu_tab) && empty($show_men_menu_tab) && $show_workout_tab == 1) {
		echo '<li class="first_level show_menu"><a href="/lk#tab5"><i class="fa fa-address-card-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОЯ АНКЕТА</a></li>';
		echo '<li class="first_level show_menu"><a href="/lk#tab4"><i class="fa fa-trophy" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОИ ЗАМЕРЫ</a></li>';
		echo '<li class="first_level show_menu" id="mobile_menu_workout"><a href="/lk#tab3"><i class="fa fa-rocket" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОИ ТРЕНИРОВКИ</a></li>';	
		echo '<li class="first_level show_menu" id="mobile_menu_women_menu"><a href="/menu-example"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ПРИМЕР МЕНЮ</a></li>';
		echo '<li class="first_level show_menu"><a href="'.wp_logout_url('/').'"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ВЫХОД</a></li>';		
		} else 
		if (empty($show_women_menu_tab) && $show_men_menu_tab == 1 && empty($show_workout_tab)) {
		echo '<li class="first_level show_menu"><a href="/lk#tab6"><i class="fa fa-address-card-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОЯ АНКЕТА</a></li>';
		echo '<li class="first_level show_menu"><a href="/lk#tab5"><i class="fa fa-trophy" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОИ ЗАМЕРЫ</a></li>';
		echo '<li class="first_level show_menu" id="mobile_menu_workout"><a href="/workout-example"><i class="fa fa-rocket" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ПРИМЕР ТРЕНИРОВОК</a></li>';	
		echo '<li class="first_level show_menu" id="mobile_menu_men_menu"><a href="/lk#tab3"><i class="fa fa-file-text" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МУЖСКОЕ МЕНЮ</a></li>';
		echo '<li class="first_level show_menu"><a href="'.wp_logout_url('/').'"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ВЫХОД</a></li>';		
		} else 
		if (empty($show_women_menu_tab) && empty($show_men_menu_tab) && $show_workout_tab == 1) {
		echo '<li class="first_level show_menu"><a href="/lk#tab5"><i class="fa fa-address-card-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОЯ АНКЕТА</a></li>';
		echo '<li class="first_level show_menu"><a href="/lk#tab4"><i class="fa fa-trophy" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОИ ЗАМЕРЫ</a></li>';
		echo '<li class="first_level show_menu" id="mobile_menu_workout"><a href="/lk#tab3"><i class="fa fa-rocket" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОИ ТРЕНИРОВКИ</a></li>';	
		echo '<li class="first_level show_menu" id="mobile_menu_women_menu"><a href="/menu-example"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ПРИМЕР МЕНЮ</a></li>';
		echo '<li class="first_level show_menu"><a href="'.wp_logout_url('/').'"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ВЫХОД</a></li>';		
		} else 
		if (is_user_logged_in()) {
		echo '<li class="first_level show_menu"><a href="/lk#tab6"><i class="fa fa-address-card-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОЯ АНКЕТА</a></li>';
		echo '<li class="first_level show_menu"><a href="/lk#tab5"><i class="fa fa-trophy" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОИ ЗАМЕРЫ</a></li>';
		echo '<li class="first_level show_menu" id="mobile_menu_workout"><a href="/workout-example"><i class="fa fa-rocket" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ПРИМЕР ТРЕНИРОВОК</a></li>';
		echo '<li class="first_level show_menu" id="mobile_menu_women_menu"><a href="/menu-example"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ПРИМЕР МЕНЮ</a></li>';
		echo '<li class="first_level show_menu"><a href="'.wp_logout_url('/').'"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ВЫХОД</a></li>';	
		} else 
		{
		echo '<li class="first_level show_menu"><a href="/wp-admin/"><i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ВОЙТИ</a></li>';
		echo '<li class="first_level show_menu" id="mobile_menu_workout"><a href="/workout-example"><i class="fa fa-rocket" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ПРИМЕР ТРЕНИРОВОК</a></li>';
		echo '<li class="first_level show_menu" id="mobile_menu_women_menu"><a href="/menu-example"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ПРИМЕР МЕНЮ</a></li>';
		echo '<li class="first_level show_menu"><a href="/counter/"><i class="fa fa-calculator" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;СЧЕТЧИК КАЛОРИЙ</a></li>';
		echo '<li class="first_level show_menu"><a href="/feedback/"><i class="fa fa-comments-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ОТЗЫВЫ</a></li>';
		};
		?>
		</ul>
    </div>
		
    <div class="nav-desktop">
      <ul class="menu-desktop">
	      	<?php
            if ( is_user_logged_in() && ( (is_user_role('maraphon_1200', $user->ID) || is_user_role('maraphon_1400', $user->ID) || is_user_role('maraphon_1600', $user->ID) || is_user_role('maraphon_1800', $user->ID) || is_user_role('maraphon_2000', $user->ID) || is_user_role('maraphon_2200', $user->ID) || is_user_role('maraphon_2500', $user->ID) || is_user_role('administrator', $user->ID)) ) ){
	        	echo '<li><a href="/lk#tab2">МОЕ МЕНЮ</a></li>';   
            } else {
	            echo '<li><a href="/menu-example/">ПРИМЕР МЕНЮ</a></li>';
            };
            
            if (
	            (is_user_logged_in()) 
	            &&
	            (
	            $show_men_menu_tab == 1 || 
				is_user_role('administrator', $user->ID)
				)
            ) {
            	echo '<li><a href="/lk#tab4">МОИ ТРЕНИРОВКИ</a></li>'; 
            } else if ( is_user_logged_in() && ( (is_user_role('maraphon_1200', $user->ID) || is_user_role('maraphon_1400', $user->ID) || is_user_role('maraphon_1600', $user->ID) || is_user_role('maraphon_1800', $user->ID) || is_user_role('maraphon_2000', $user->ID) || is_user_role('maraphon_2200', $user->ID) || is_user_role('maraphon_2500', $user->ID) || $check_any_workout_to_buy > 0) ) ){
	        	echo '<li><a href="/lk#tab3">МОИ ТРЕНИРОВКИ</a></li>';   
            } else {
	            echo '<li><a href="/workout-example/">ПРИМЕР ТРЕНИРОВОК</a></li>';
            };

            if ( is_user_logged_in() && is_user_role('administrator', $user->ID) )  {
	        	echo '<li><a href="/blog/">БЛОГ</a></li>';   
            } else {
	            echo '<li><a href="/counter/">СЧЕТЧИК КАЛОРИЙ</a></li>';
            };
            
   	        echo '<li><a href="/shop/">МАГАЗИН</a></li>';   
			?>
        </ul>
    </div>
      
      <script type="text/javascript">
        document.getElementById("trigger").onclick = function() {open()};
          function open(){document.getElementById("menu").classList.toggle("show");
		  $(".second_level").filter(".show_menu").removeClass("show_menu");
		  $(".second_level").addClass("hide_menu");
		  $(".first_level").filter(".hide_menu").removeClass("hide_menu");
		  $(".first_level").addClass("show_menu");     
          }   

		$(function() {
		  function showSecondMenuLevel(){
			$(".first_level").filter(".show_menu").removeClass("show_menu");
			$(".first_level").addClass("hide_menu");
			$(".second_level").filter(".hide_menu").removeClass("hide_menu");
			$(".second_level").addClass("show_menu");
		}
			$("#second_menu_level").click(showSecondMenuLevel);
		});
						    
		$(function() {
		function showFirstMenuLevel(){
			$(".second_level").filter(".show_menu").removeClass("show_menu");
			$(".second_level").addClass("hide_menu");
			$(".first_level").filter(".hide_menu").removeClass("hide_menu");
			$(".first_level").addClass("show_menu");
		}
		$("#first_menu_level").click(showFirstMenuLevel);
		});
		</script>
    </header><!-- #masthead -->


















































	<div class="account-main">
		<div class="account-main-banner">
<?php 
	global $wpdb;
	$current_user = wp_get_current_user();
	$user_id = $current_user->ID;
		if ( is_user_logged_in() ) {
			echo 
			    '<style>
			        .logout_1 {display: block};
			    </style>';
			$logout_display = 'style="display:block;"';
		} else {
			echo 
				'<style>
					.logout_1 {display: none};
				</style>';
			$logout_display = 'style="display:none;"';
		};
?>
				<a href="https://maraphon.online/wp-login.php?action=lostpassword" class="logout_1" >Изменить пароль</a>	
				<a href="<?php echo wp_logout_url('/') ?>" class="logout_2" <?php echo $logout_display ?>>Выход</a>
				
		        <div class="maraphon_day">
			        <span>
			        <?php
				    $_monthsList = array(
					"1"=>"январе","2"=>"феврале","3"=>"марте",
					"4"=>"апреле","5"=>"мае", "6"=>"июне",
					"7"=>"июле","8"=>"августе","9"=>"сентябре",
					"10"=>"октябре","11"=>"ноябре","12"=>"декабре");
					$_monthsListThis = array(
					"1"=>"января","2"=>"февраля","3"=>"марта",
					"4"=>"апреля","5"=>"мая", "6"=>"июня",
					"7"=>"июля","8"=>"августа","9"=>"сентября",
					"10"=>"октября","11"=>"ноября","12"=>"декабря");
					$n = current_time("m") + 1 > 12 ? 1 : current_time("m") + 1;
					$next_month = $_monthsList[$n];
					$p = current_time("m") + 1 > 12 ? 1 : current_time("m") + 1;
					$next_month_january = $_monthsListThis[$p];
					$m = current_time("n");
					$this_month = $_monthsListThis[$m];
				    if ((current_time("j") + 0) >= 29) {
						echo 'Марафон окончен,<br>до встречи в '.$next_month.'!';
					} else if ((current_time("j")) < 3 && (current_time("m") == 01)) {
						echo 'С новым 2022 годом! Стартуем 3 января';
					} else {
						echo 'Сегодня '.current_time ('j',0).' день марафона '.$this_month.'';
					}; 
				    ?>
			        </span>
		        </div>
		        
				<img class="account-main-banner-image" style="object-fit: cover; object-position: 20% 50%;" src="<?php echo content_url() ?>/uploads/lk-banner-5-1280x320-1.jpg">
				<p class="account-main-banner-header">Личный кабинет</p>
				<p class="account-main-banner-header-text">Красота и здоровье в твоих руках</p>
					
		        <div id="admin_url_block">
			        <?php
				    if ( is_user_role('administrator', $user_id) ) {
			       	echo '<a href="/director-cabinet/" class="daily_report" >Кабинет директора</a>';
				       	} else if ( is_user_role('content_1', $user_id) ) {
					       	echo '<a class="daily_report" >-</a>';
				       	};
			       	?>
			       	<br>
			       	<a href="http://maraphon.online/kbju/" target="_blank" class="member_report" >Калькулятор</a>
				   	<br>
				   	<a href="http://maraphon.online/wp-admin/users.php" target="_blank" class="member_report" >Wordpress</a>
				   	<br>
			        <a href="<?php echo wp_logout_url('/') ?>" >Выход</a>
		        </div>
		
				<div id="admin_url_block_opacity" style="display: none"></div>
		    	</div>
		    	
		    	<?php if ( !is_user_logged_in() ) :									//блокировка контента для неавторизованных
	                        $enter_link_message = '
	                        <div style="height: 700px; background-color: white">
								<p style="text-align: center; padding-top: 250px; font-size: 28px;">
									<a class="lk_enter_a" href="http://maraphon.online/wp-login.php?">Войдите</a> чтобы просматривать профиль
								</p>
							</div>
	                        ';
	                        _e($enter_link_message, 'profile'); 
					   else : 
			    ?> 		
				
		<?php 					
		//Объявляем базовые переменные
		$lk_maraphon_buy_div_flag = 'display:none';
		$lk_menu_buy_div_flag = 'display:none';
		$lk_table_men_menu_flag = 'display:none';
		$lk_table_women_menu_flag = 'display:none';
		
		$maraphon_counter = get_user_meta ( $user_id, 'maraphon_counter', true);
		
		$check_women_menu_to_order = $wpdb->get_var(				 //проверка для вывода меню для покупателей, заказавших женское меню
		"
		SELECT
		COUNT(*)
		FROM wpux_orders_menu menu
		WHERE menu.user_id = $user_id
		AND menu.content LIKE '%Жен%'
		"
		);
		
		$check_men_menu_to_order = $wpdb->get_var(				 //проверка для вывода меню для покупателей, заказавших мужское меню
		"
		SELECT
		COUNT(*)
		FROM wpux_orders_menu menu
		WHERE menu.user_id = $user_id
		AND menu.content LIKE '%Муж%'
		"
		);
		
		if ($maraphon_counter === '0' || $maraphon_counter > 0) {
			$lk_maraphon_buy_div_flag = 'display:block';
		};
		
		if ($show_women_menu_tab != 1 && $show_men_menu_tab != 1) {
			$lk_maraphon_buy_div_flag = 'display:block';
		}
		
		if ($check_women_menu_to_order > 0) {
			$lk_menu_buy_div_flag = 'display:block';
			$lk_table_women_menu_flag = 'display:block';
		};
		
		if ($check_men_menu_to_order > 0) {
			$lk_menu_buy_div_flag = 'display:block';
			$lk_table_men_menu_flag = 'display:block';
		};
		
		if (is_user_role('administrator', $user_id) || is_user_role('content_1', $user_id)) {
			$lk_maraphon_buy_div_flag = 'display:block';
			$lk_menu_buy_div_flag = 'display:block';
			$lk_table_men_menu_flag = 'display:block';
			$lk_table_women_menu_flag = 'display:block';
		};
					
		if (is_user_role('maraphon_1200', $user_id) || is_user_role('maraphon_1400', $user_id) || is_user_role('maraphon_1600', $user_id) || is_user_role('maraphon_1800', $user_id) || is_user_role('maraphon_2000', $user_id) || is_user_role('maraphon_2200', $user_id) || is_user_role('maraphon_2500', $user_id)) {
			$lk_maraphon_buy_div_flag = 'display:block';
		};
										
		if ( $show_admin_tab == 1 || ($show_maraphon_tab == 1 && $show_men_menu_tab == 1) ) { //все 6 вкладок видят администраторы и участники марафона с мужским меню
		echo '<div class="account-navigation">
					<ul id="drag" class="tabs">
			            <li id="account-report" class="hide-button" ><a title="" class="btn1" href="#tab1"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ЕЖЕД. ОТЧЕТ</a></li>
			            <li id="account-menu" class="hide-button" ><a title="" class="btn1" href="#tab2" style="margin-left: -3px;"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ЖЕН. МЕНЮ</a></li>
			            <li id="account-men-menu" class="hide-button" ><a title="" class="btn1" href="#tab3" style="margin-left: -2px;"><i class="fa fa-file-text" aria-hidden="true"></i>&nbsp;&nbsp;МУЖ. МЕНЮ</a></li>
			            <li id="account-workout" class="hide-button" ><a title="" class="btn1" href="#tab4" style="margin-left: -2px;"><i class="fa fa-rocket" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОИ ТРЕНИРОВКИ</a></li>
						<li id="account-result" class="hide-button" ><a title="" class="btn1" href="#tab5" style="margin-left: -2px;"><i class="fa fa-trophy" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОИ ЗАМЕРЫ</a></li>
			            <li id="account-form" class="hide-button" ><a title="" class="btn1" href="#tab6" style="margin-left: -2px;"><i class="fa fa-address-card-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ЛИЧНЫЕ ДАННЫЕ</a></li>  
		            </ul>
			  </div>';
		
		echo '<style>
						#account-menu {display: block !important}
						#account-men-menu {display: block !important}
						#account-workout {display: block !important}
					    #account-form {display: block !important}
					    #account-result {display: block !important}
					    #admin_url_block {display: block !important}
					    #admin_url_block_opacity {display: block !important}
						.logout_1 {display: none !important}
						.logout_2 {display: none !important}
		      </style>';	  
		} else if ( $show_maraphon_tab == 1 ) { // участники марафона видят 5 вкладок
		echo '<div class="account-navigation">
					<ul id="drag" class="tabs">
			            <li id="account-report" class="hide-button" ><a title="" class="btn1" href="#tab1"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ЕЖЕДНЕВНЫЙ ОТЧЕТ</a></li>
			            <li id="account-menu" class="hide-button" ><a title="" class="btn1" href="#tab2"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОЕ МЕНЮ</a></li>
			            <li id="account-workout" class="hide-button" ><a title="" class="btn1" href="#tab3"><i class="fa fa-rocket" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОИ ТРЕНИРОВКИ</a></li>
						<li id="account-result" class="hide-button" ><a title="" class="btn1" href="#tab4"><i class="fa fa-trophy" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОИ ЗАМЕРЫ</a></li>
						<li id="account-form" class="hide-button" ><a title="" class="btn1" href="#tab5"><i class="fa fa-address-card-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ЛИЧНЫЕ ДАННЫЕ</a></li>  
		            </ul>
			  </div>';
		echo '<style>
						#account-menu {display: block !important}
						#account-workout {display: block !important}
						#account-result {display: block !important}
					    #account-form {display: block !important}
		      </style>';
		} else if ( $show_women_menu_tab == 1 && $show_men_menu_tab == 1 && $show_workout_tab == 1) {
		echo '<div class="account-navigation">
					<ul id="drag" class="tabs">
			            <li id="account-menu" class="hide-button" ><a title="" class="btn1" href="#tab2"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ЖЕНСКОЕ МЕНЮ</a></li>
			            <li id="account-men-menu" class="hide-button" ><a title="" class="btn1" href="#tab3"><i class="fa fa-file-text" aria-hidden="true"></i>&nbsp;&nbsp;МУЖСКОЕ МЕНЮ</a></li>
			            <li id="account-workout" class="hide-button" ><a title="" class="btn1" href="#tab4"><i class="fa fa-rocket" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОИ ТРЕНИРОВКИ</a></li>
						<li id="account-result" class="hide-button" ><a title="" class="btn1" href="#tab5"><i class="fa fa-trophy" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОИ ЗАМЕРЫ</a></li>
						<li id="account-form" class="hide-button" ><a title="" class="btn1" href="#tab6"><i class="fa fa-address-card-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ЛИЧНЫЕ ДАННЫЕ</a></li> 
			        </ul>
			  </div>';
		echo '<style>	
						#account-menu {display: block !important}
						#account-men-menu {display: block !important}
						#account-workout {display: block !important}
						#account-result {display: block !important}
					    #account-form {display: block !important}
		      </style>';
		} else if ( $show_women_menu_tab == 1 && $show_men_menu_tab == 1 && empty($show_workout_tab) ) {
		echo '<div class="account-navigation">
					<ul id="drag" class="tabs">
						<li id="account-menu" class="hide-button" ><a title="" class="btn1" href="#tab2"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ЖЕНСКОЕ МЕНЮ</a></li>
			            <li id="account-men-menu" class="hide-button" ><a title="" class="btn1" href="#tab3"><i class="fa fa-file-text" aria-hidden="true"></i>&nbsp;&nbsp;МУЖСКОЕ МЕНЮ</a></li>
						<li id="account-result" class="hide-button" ><a title="" class="btn1" href="#tab5"><i class="fa fa-trophy" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОИ ЗАМЕРЫ</a></li>
			            <li id="account-form" class="hide-button" ><a title="" class="btn1" href="#tab6"><i class="fa fa-address-card-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ЛИЧНЫЕ ДАННЫЕ</a></li>
			        </ul>
			  </div>';
		echo '<style>
						#account-menu {display: block !important}
						#account-men-menu {display: block !important}
						#account-result {display: block !important}
					    #account-form {display: block !important}
		      </style>';
		} else if ( $show_women_menu_tab == 1 && empty($show_men_menu_tab) && empty($show_workout_tab) ) {
		echo '<div class="account-navigation">
					<ul id="drag" class="tabs">
						<li id="account-menu" class="hide-button" ><a title="" class="btn1" href="#tab2"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ЖЕНСКОЕ МЕНЮ</a></li>
						<li id="account-result" class="hide-button" ><a title="" class="btn1" href="#tab4"><i class="fa fa-trophy" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОИ ЗАМЕРЫ</a></li>
			            <li id="account-form" class="hide-button" ><a title="" class="btn1" href="#tab5"><i class="fa fa-address-card-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ЛИЧНЫЕ ДАННЫЕ</a></li>
			        </ul>
			  </div>';
		echo '<style>
						#account-menu {display: block !important}
						#account-result {display: block !important}
					    #account-form {display: block !important}
		      </style>';
		} else if ( empty($show_women_menu_tab) && $show_men_menu_tab == 1 && empty($show_workout_tab) ) {
		echo '<div class="account-navigation">
					<ul id="drag" class="tabs">
						<li id="account-men-menu" class="hide-button" ><a title="" class="btn1" href="#tab3"><i class="fa fa-file-text" aria-hidden="true"></i>&nbsp;&nbsp;МУЖСКОЕ МЕНЮ</a></li>
						<li id="account-result" class="hide-button" ><a title="" class="btn1" href="#tab5"><i class="fa fa-trophy" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОИ ЗАМЕРЫ</a></li>
			            <li id="account-form" class="hide-button" ><a title="" class="btn1" href="#tab6"><i class="fa fa-address-card-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ЛИЧНЫЕ ДАННЫЕ</a></li>
			        </ul>
			  </div>';
		echo '<style>
						#account-men-menu {display: block !important}
						#account-result {display: block !important}
					    #account-form {display: block !important}
		      </style>';		
		} else if ( empty($show_women_menu_tab) && $show_men_menu_tab == 1 && $show_workout_tab == 1 ) {
		echo '<div class="account-navigation">
					<ul id="drag" class="tabs">
						<li id="account-men-menu" class="hide-button" ><a title="" class="btn1" href="#tab3"><i class="fa fa-file-text" aria-hidden="true"></i>&nbsp;&nbsp;МУЖСКОЕ МЕНЮ</a></li>
						<li id="account-workout" class="hide-button" ><a title="" class="btn1" href="#tab4"><i class="fa fa-rocket" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОИ ТРЕНИРОВКИ</a></li>
						<li id="account-result" class="hide-button" ><a title="" class="btn1" href="#tab5"><i class="fa fa-trophy" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОИ ЗАМЕРЫ</a></li>
			            <li id="account-form" class="hide-button" ><a title="" class="btn1" href="#tab6"><i class="fa fa-address-card-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ЛИЧНЫЕ ДАННЫЕ</a></li>
			        </ul>
			  </div>';
		echo '<style>
						#account-men-menu {display: block !important}
						#account-workout {display: block !important}
						#account-result {display: block !important}
					    #account-form {display: block !important}
		      </style>';
		} else if ( $show_women_menu_tab == 1 && empty($show_men_menu_tab) && $show_workout_tab == 1 ) {
		echo '<div class="account-navigation">
					<ul id="drag" class="tabs">
						<li id="account-menu" class="hide-button" ><a title="" class="btn1" href="#tab2"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ЖЕНСКОЕ МЕНЮ</a></li>
						<li id="account-workout" class="hide-button" ><a title="" class="btn1" href="#tab3"><i class="fa fa-rocket" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОИ ТРЕНИРОВКИ</a></li>
						<li id="account-result" class="hide-button" ><a title="" class="btn1" href="#tab4"><i class="fa fa-trophy" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОИ ЗАМЕРЫ</a></li>
			            <li id="account-form" class="hide-button" ><a title="" class="btn1" href="#tab5"><i class="fa fa-address-card-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ЛИЧНЫЕ ДАННЫЕ</a></li>
			        </ul>
			  </div>';
		echo '<style>
						#account-menu {display: block !important}
						#account-workout {display: block !important}
						#account-result {display: block !important}
					    #account-form {display: block !important}
		      </style>';		
		} else if ( empty($show_women_menu_tab) && empty($show_men_menu_tab) && $show_workout_tab == 1 ) {
		echo '<div class="account-navigation">
					<ul id="drag" class="tabs">
						<li id="account-workout" class="hide-button" ><a title="" class="btn1" href="#tab3"><i class="fa fa-rocket" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОИ ТРЕНИРОВКИ</a></li>
						<li id="account-result" class="hide-button" ><a title="" class="btn1" href="#tab4"><i class="fa fa-trophy" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОИ ЗАМЕРЫ</a></li>
			            <li id="account-form" class="hide-button" ><a title="" class="btn1" href="#tab5"><i class="fa fa-address-card-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ЛИЧНЫЕ ДАННЫЕ</a></li>
			        </ul>
			  </div>';
		echo '<style>
						#account-workout {display: block !important}
						#account-result {display: block !important}
					    #account-form {display: block !important}
		      </style>';
		} else {
		echo '<div class="account-navigation">
					<ul id="drag" class="tabs">
						<li id="account-result" class="hide-button" ><a title="" class="btn1" href="#tab4"><i class="fa fa-trophy" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОИ ЗАМЕРЫ</a></li>
			            <li id="account-form" class="hide-button" ><a title="" class="btn1" href="#tab5"><i class="fa fa-address-card-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ЛИЧНЫЕ ДАННЫЕ</a></li>
			        </ul>
			  </div>';
		echo '<style>
						#account-result {display: block !important}
					    #account-form {display: block !important}
		      </style>';
		}
		
		;
		?>
		        
		<script>
		    $(function() {
		        $('.tabs li').click(function(event){
			        event.preventDefault();
			        $('.tabs li').removeClass('active');
			        $(this).addClass('active');
			        //$('.tab-content').fadeOut();
			        $('.tab-content').hide();
			        var activeTab = $(this).find('a').attr('href');
			        //$(activeTab).fadeIn();
			        $(activeTab).show();
		        });
		        var hash = window.location.hash;
		        hash ?  $("a[href='"+hash+"']").click()  : $('.tabs li:first').click() 
			});
		</script>
			
		<div class="lk-content">
			<?php					
			if ( is_user_role('notconfirm', $user_id) ) {
			echo '
			 	<div class="lk_hello_page">
				 	<p>Здравствуйте!</p>
				 	<p>Для начала работы с сайтом воспользуйтесь кнопкой меню ( <img src="/wp-content/uploads/button_menu_example.jpg" style="width: 50px; height: 42px;"> ) в правом верхнем углу</p>
				 	<div class="grey_line" style="width: 600px; margin-left: 35px;"></div>
				 	<p>Красивая фигура - это просто</p>
			 	</div>
			 	<script>
			 		var hash = location.hash;
			 		hash = hash.substr(0, 4);
			 		if ($(window).width() > 1279 || hash == "#tab") {
				 		$(".lk_hello_page").remove();
				 	};
			 	</script>
			';
			};
			?>
					
		    <div id="tab1" class="tab-content"> <!-- ЕЖЕДНЕВНЫЙ ОТЧЕТ -->     
			    <h1 class="mobile-lk-header" id="daily_report_mobile_header"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Ежедневный отчет</h1>
			    <br>
			    <?php
			    global $check_orders;						
						
							$user_email = $current_user->user_email;
							$check_orders_this_month = $wpdb->get_results(
									"
									SELECT
									orders.date,
									orders.user_id,
									orders.credit,
									orders.paid,
									orders.maraphon_next_month,
									orders.maraphon_member_month
									FROM wpux_orders orders
									WHERE orders.user_email = '$user_email'
									AND (orders.maraphon_next_month LIKE '%марафон%' OR orders.maraphon_next_month LIKE '%пакет%')
									ORDER BY orders.date DESC
									LIMIT 1
									"
									);	
							foreach ( $check_orders_this_month as $string ) {
						        	$check_orders_array = $string->date;
						        	$check_orders_period_array = $string->maraphon_member_month;
						        	$check_paid = $string->paid;
						        	$check_credit = $string->credit;
						        	$check_packet = $string->maraphon_next_month;	
						    };
						    
						    $check_orders = substr($check_orders_array, 5, 2);
						    $check_orders_period_month = substr($check_orders_period_array, 0, 2);
						    $check_orders_period_year = substr($check_orders_period_array, -4);
							$check_orders_period_next_month = current_time('n') + 1;
				    
							if ( ($check_orders == current_time("m")) && ($check_paid == '1' || $check_credit == '1') && ($check_orders_period_month == $check_orders_period_next_month) ) {
							    echo '<p class="success_lk_paid">Вы участвуете в марафоне в '.$next_month.'</p>';
							    $check_maraphon_counter = -1;
							} else if ( ($check_orders == current_time("m")) && ($check_paid == '0' || $check_credit = '0')  && ($check_orders_period_month == $check_orders_period_next_month) ) {	
								echo '<button disabled id="send_maraphon_next_month" class="sended_maraphon_next_month">Заявка успешно отправлена. Ожидаем оплату.</button>';
								$check_maraphon_counter = 0;
							} else {
								echo '<button id="send_maraphon_next_month" class="send_maraphon_next_month">
								<a href="http://maraphon.online/shop/maraphon/" target="_blank">Отправить заявку на участие в '.$next_month.'</a>
								</button>';
								$check_maraphon_counter = 0;
							};
				?>                    
                    
					<span id="daily_report_header">				
					<?php	//Выводим текущий месяц и год
					     	$_monthsList = array(
							"1"=>"Январь","2"=>"Февраль","3"=>"Март",
							"4"=>"Апрель","5"=>"Май", "6"=>"Июнь",
							"7"=>"Июль","8"=>"Август","9"=>"Сентябрь",
							"10"=>"Октябрь","11"=>"Ноябрь","12"=>"Декабрь");
							$month = $_monthsList[current_time("n")];
							$year = current_time ('Y',0);
							echo $month.' '.$year;
					?>	 
					</span>
					
		            <div class="daily_report_table_for_user_div">
			        <?php
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
								FROM wpux_daily_report
								WHERE user_id = $user_id
								AND (DATE(date) BETWEEN '$current_month_report_start' AND '$current_month_report_end')
								ORDER BY date
							"
						);
								
						$table_encode = json_decode(json_encode($this_month_report), true);
						$last = count($table_encode);
						$rowSpanStart = 0;
						$rowSpanEnd = -1;

						echo '<table class="daily_report_table_for_user" id="daily_report_table_for_user_desktop">
							<tr>
							    <th>&nbsp;День&nbsp;</th>
							    <th>&nbsp;Активность&nbsp;</th>
							    <th>&nbsp;Алко.&nbsp;</th>  
							    <th>&nbsp;Мес.&nbsp;</th>
							    <th>&nbsp;Вес&nbsp;</th>
							    <th>Как прошел ваш день</th>
							    <th>Комментарий по отчету</th>
						    </tr>';	
  
						for ($i = 0; $i < count($table_encode); $i++) {
						    if ($i >= $rowSpanEnd) {
						        $current = $table_encode[$i]['comment'];
						        $rowSpanStart = $i;
						        $rowSpanEnd = $i + 1;
						        $before = 0; // check if it's range
						        if ($check_packet == 'пакет "Профи"') {															//вывод комментария для "Профи"
							        if ($i + 1 < $last && $current == $table_encode[$i + 1]['comment']) {
								        $rowSpanEnd += 1;
								        $before = 1;    
								    };
								    if ($before == 1 && $i + 2 < $last && $current == $table_encode[$i + 2]['comment']) {
								        $rowSpanEnd += 1;
								        $before = 2;    
								    };
						    	    if ($before == 2 && $i + 3 < $last && $current == $table_encode[$i + 3]['comment']) {
									    $rowSpanEnd += 1;
									    $before = 3;    
									};
								/*	if ($before == 3 && $i + 4 < $last && $current == $table_encode[$i + 4]['comment']) {
									    $rowSpanEnd += 1;    
									}; */
									} else if ($check_packet == 'пакет "Новичок"' || $check_packet == 'пакет "Семейный"') {     //вывод комментария для "Новичок" или "Семейный"
									    if ($i + 1 < $last && $current == $table_encode[$i + 1]['comment']) {
									        $rowSpanEnd += 1; 
									   	}; 
									} else if ($check_packet == 'пакет "VIP"') {												//вывод комментария для "VIP"
										    	$j = 0;	                   								
											};
									};  
									
									if ($table_encode[$i]["cheatmeal"] == '1') {
										    $cheat_fail_color = '#dff1d9';
									        } else if ($table_encode[$i]["failure"] == '1') {
										        $cheat_fail_color = '#f8d7da';
									        } else if ($table_encode[$i]["snack"] == '1') {
										        $cheat_fail_color = '#fff3cd';
									        } else {
										        $cheat_fail_color = 'white';
									        };
									if ($table_encode[$i]["alcohol"] == 'Нет' || $table_encode[$i]["alcohol"] == 'нет' || $table_encode[$i]["alcohol"] == '-') {
									        $alcohol_color = '#404040';
								        	} else {
									        $alcohol_color = '#468df9';
								        	};
									if ($table_encode[$i]["menstruation"] == 'Есть') {
										    $menstruation_color = 'red';
									        } else {
										        $menstruation_color = '#404040';
										    };
									if ($table_encode[$i]["comment"] == 'Отчет на проверке') {
										        $change_color = 'white';
									        } else {
										        $change_color = '#fec300';
									        };
									echo '<tr>
										    <td style="background-color: '.$cheat_fail_color.'">'.substr($table_encode[$i]["date"], 8).'</td>
											<td style="background-color: '.$cheat_fail_color.'">'.$table_encode[$i]["activity"].'</td>
											<td style="background-color: '.$cheat_fail_color.'; color:'.$alcohol_color.';">'.$table_encode[$i]["alcohol"].'</td>
											<td style="background-color: '.$cheat_fail_color.'; color:'.$menstruation_color.';">'.$table_encode[$i]["menstruation"].'</td>
											<td style="background-color: '.$cheat_fail_color.'">&nbsp;'.$table_encode[$i]["today_weight"].'&nbsp;</td>
											<td style="background-color: '.$cheat_fail_color.'">'.$table_encode[$i]["task"].'</td>
									';
									if ($i == $rowSpanStart && ($rowSpanEnd - $rowSpanStart > 0)) {
										$size = $rowSpanEnd - $rowSpanStart;
										echo '<td rowspan="'.$size.'" style="background-color: '.$change_color.';">'.$table_encode[$i]['comment'].'</td>';
										    } else if ($i == $rowSpanStart && ($rowSpanEnd - $rowSpanStart == 1)) {
											    	echo '<td style="background-color: '.$change_color.';">'.$table_encode[$i]['comment'].'</td>';
										        	};
									echo '</tr>';
									$database_day = substr($table_encode[$i]["date"], 8);
									$database_month = substr($table_encode[$i]["date"], 5, 2);
						}; //  цикл for
						echo '</table>';					
					?>
			 		</div>
						
					 <script type="text/javascript">
						$(function() {
						   function showDailyReportFormEdit(){
							  $.ajaxSetup({cache: false});
								$.ajax({
									type:"POST",
									url: "/wp-admin/admin-ajax.php",
									data: {action: "showDailyReportFormEdit"
									},
									success:function(data){
									$(".dailyReportFormDiv").html(data);
									$("#daily_report_text_block_edit").show();
									$("#lk_edit_daily_report").hide();
									}
								});
								return false;
							}
						    $("#lk_edit_daily_report").click(showDailyReportFormEdit);
						});
					</script>
			 			
					<?php 
						$current_day_report = current_time ('d',0);
						$current_month_report = current_time ('m',0);
						if ( 
							($current_day_report <= $database_day) && ($current_month_report == $database_month)
						   ) 
						   { //если сегодня ежедневный отчет отправлен
							$form_report_flag = 'none';
							$edit_button_report_flag = 'block';
						} else {
							$form_report_flag = 'block';
							$edit_button_report_flag = 'none';
						};
					?>
					
					<button id="lk_edit_daily_report" class="edit_button" style="display:<?php echo $edit_button_report_flag; ?>">Редактировать последний отчет</button>
					
					<div class="dailyReportFormDiv">
					<form type="post" action="" style="display:<?php echo $form_report_flag; ?>" id="dailyReportForm">
						<div class="confirm_form_block">   
							<table class="daily_report_confirmation">
							<h1 id="daily_report_for_user_h1">Введите Ваши данные: </h1>
							
								<tr> 
									<th colspan="2" class="weight_th"><label for="today_weight_report">Вес сегодня утром, кг</label></th>
								
									<th><label style="text-align: left;" for="menstruation_report" id="label_today_weight_report">Месячные сегодня</label></th>
								</tr>
		
								<tr>
				                    <td>
					                   <input class="text-input" id="today_weight_report" name="today_weight_report" type="number" step="0.001" />
					                </td>
					                <td class="mobile_report_fix"></td>
					                <td>
						                <select  id="menstruation_report" class="select-width" style = "background-color: #fafafa; border: 1px solid red" name="menstruation_report">
												<option class="select-width" selected value = "Нет">Нет</option>
						                    	<option class="select-width" value = "Есть">Есть</option>
					                    </select>    

					                </td>
								</tr>
								
								<tr> 
									<th colspan="3"><label for="activity_report">Активность вчера</label></th>
								</tr>
								<tr> 
				                    <td colspan="3"><input class="text-input" name="activity_report" type="text" /></td>
								</tr>

								<tr> 
									<th colspan="3"><label for="alcohol_report">Алкоголь вчера</label></th>
								</tr>
								
								</table>
								
								<table class="daily_report_confirmation" style="border: 1px solid #cbcbcb; border-radius: 3px; margin-top: -23px;">
								
								<tr class="daily_report_alcohol_checkbox"> 
									<td><input style="height: 15px; width: 15px !important;" type="checkbox" id="alcohol_yes" name="alcohol_yes" value="1"></td>
									<td><input style="height: 15px; width: 15px !important;" type="checkbox" id="alcohol_no" name="alcohol_no" value="1"></td>
									<td></td>
								</tr>
								
								<tr style="height: 40px;">
									<th style="width: 50%; color: #468df9;"><label for="alcohol_yes" id="alcohol_yes_label">Да</label></th>
									<th style="width: 50%; color: #468df9;"><label for="alcohol_no" id="alcohol_no_label">Нет</label></th>
									<th style="width: 50%;"></th>
								</tr> 
								
								<tr class="alcohol_type" style="opacity: 100%">
				                    <td colspan="3"><input class="text-input" class="alcohol_type" style="opacity: 100%" id="alcohol_report" name="alcohol_report" type="text" /></td>
								</tr>
								
								</table>
								
								<script>
									$('.daily_report_alcohol_checkbox input:checkbox').click(function(){
									  if ($(this).is(':checked')) {
									     $('.daily_report_alcohol_checkbox input:checkbox').not(this).prop('checked', false);
									  }
									});

									$('#alcohol_yes').click(function(){
									  if ($(this).is(':checked')) {
									     $('#alcohol_report').val('');
									     $('#alcohol_report').attr("placeholder", "Какой алкоголь был вчера и сколько?");
									  } else {
										 $('#alcohol_report').val('');
									     $('#alcohol_report').attr("placeholder", ""); 
									  }
									});	
									
									$('#alcohol_no').click(function(){
									  if ($(this).is(':checked')) {
									     $('#alcohol_report').val('Нет');
									  } else {
										 $('#alcohol_report').val('');
									     $('#alcohol_report').attr("placeholder", "");  
									  }
									});    
								</script>
								
								<table class="daily_report_confirmation" style="margin-top: -20px;">
								<tr class="daily_report_checkbox">
									<td><input style="height: 15px; width: 15px !important; margin-left: 45%;" type="checkbox" id="snack" name="snack" value="1"></td>
									<td><input style="height: 15px; width: 15px !important; margin-left: 42%;" type="checkbox" id="cheatmeal" name="cheatmeal" value="1"></td>
				                    <td><input style="height: 15px; width: 15px !important; margin-left: 46%;" type="checkbox" id="failure" name="failure" value="1"></td>
								</tr>  
								
								<script>
									$('.daily_report_checkbox input:checkbox').click(function(){
									  if ($(this).is(':checked')) {
									     $('.daily_report_checkbox input:checkbox').not(this).prop('checked', false);
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
									<td colspan="3"><textarea class="select-width" id="what_your_day" name="task_report" rows="5" cols="1" maxlength="255"></textarea></td>	
								</tr>
								
								<tr>
									<td colspan="3">
										<p id="typeChars">Введено символов: 0/255</p>
									</td>
								</tr>
								
								<script type="text/javascript">
								 // считает кол-во символов в поле "Как прошел день"
								 function limitChars(myObject, max, typeChars, leftChars){
								 $(myObject).keyup(function(){
								 var count = $(this).val().length;
								 $(typeChars).text('Введено символов: ' + count + '/255');
								  });
								 }
								 
								 $(document).ready(function(){
								 var myObject = '#what_your_day';
								 var max = 254; 
								 var typeChars = '#typeChars';
								 limitChars(myObject, max, typeChars);
								});
								</script>
								
							</table>
							
							<p class="daily_report_submit" >
							<input type="hidden" name="action" value="sendDailyReport"/>
							<input type="submit" id="daily_report_submit" class="submit button" value="Отправить отчет">
							</p>
						
							<p style="text-align: center; margin-top: -20px;">Нажимая на кнопку, вы даете согласие на обработку своих персональных данных и соглашаетесь с <a href="http://maraphon.online/privacy-policy/" target="_blank">политикой конфиденциальности</a></p>
						</div>
						<div class="clearfloat"></div>
					</form>
					</div>
								
					<div id="fail_daily_report" style="display: none;"><p>Ошибка, заполните все поля</p></div>
					<div id="fail_daily_report_alcohol" style="display: none;"><p>Ошибка, вы не указали алкоголь вчера</p></div>
					<div id="fail_daily_report_weight" style="display: none;"><p>Ошибка, укажите вес в кг</p></div>
					<div id="fail_daily_report_date" style="display: none;"><p>Ошибка, мы еще не научились смотреть в будущее. Укажите корректную дату.</p></div>
					
					<script type="text/javascript">
		
					jQuery('#dailyReportForm').submit(ajaxSubmit);
					function ajaxSubmit(){
					$('[type="submit"]').prop('disabled', true);
					
					setTimeout(function() {
					$('[type="submit"]').prop('disabled', false);
					}, 1000); // 1 second
					var dailyReportForm = jQuery(this).serialize();
					var time = new Date;
					var day = time.getDate();
					if (day < 10) day = '0' + day;
					var activity_report = $('input[name="activity_report"]').val();
					var alcohol_yes = $('#alcohol_yes').is(":checked");
					var alcohol_no = $('#alcohol_no').is(":checked");
					var alcohol_report = $('input[name="alcohol_report"]').val();
					var task_report = $('textarea[name="task_report"]').val();
					var menstruation_report = $('select[name="menstruation_report"]').val();
					var today_weight_report = $('input[name="today_weight_report"]').val();
					if ( (today_weight_report > 200) || (today_weight_report == '0,0') || (today_weight_report == '0.0') || (today_weight_report < 0)) {
						$("#fail_daily_report_weight").show();
						setTimeout(function(){$('#fail_daily_report_weight').fadeOut('slow')},1000);
					} else if ( ( (alcohol_yes == false) && (alcohol_no == false) ) || ( (alcohol_yes == true) && (alcohol_report == '') ) ) {
						$("#fail_daily_report_alcohol").show();
						setTimeout(function(){$('#fail_daily_report_alcohol').fadeOut('slow')},1000);
					}
					  else 	{
							$.ajaxSetup({cache: false});
						if ( activity_report && task_report && menstruation_report && today_weight_report ) {	
							$.ajax({
									type:"POST",
									url: "/wp-admin/admin-ajax.php",
									data: dailyReportForm,
									success:function(data){
									$('#dailyReportForm').remove();
									$('.daily_report_text_block').remove();
									$("#fail_daily_report").hide();
									$('.daily_report_table_for_user_div').empty();
									$('.daily_report_table_for_user_div').html(data);
									$("#lk_edit_daily_report").show();
									}
							});
						} else
							{
							$('#daily_report_submit').disabled;
							$("#fail_daily_report").show();
							setTimeout(function(){$('#fail_daily_report').fadeOut('slow')},1000);
							return false;
							}
					};
						
					return false;
					}
					</script>
				
					<br/>
					<div class="daily_report_text_block" style="display:<?php echo $form_report_flag; ?>">
						<p>При заполнении отчета соблюдаем три простых правила:</p>
						<p>1. Пунктуальность - отчет нужно заполнять <strong>каждый</strong> день (c 00:00 до 23:59 текущего дня, (МСК+04:00) Новосибирск). Проснулись, умылись, встали на весы - отправили отчет.</p>
						<p>2. Честность - <strong>вносите данные как есть</strong>, нет смысла делать этот отчет «красивым», внося недостоверную информацию. Этим вы вводите в заблуждение в первую очередь себя. Если у вас сегодня нет возможности взвеситься - ставьте 0</p>
						<p>3. Краткость - <strong>пишите кратко</strong>, нет необходимости уточнять, какие конкретно упражнения вы делали в зале и сколько сортов крафтового пива попробовали вчера. «Бег 3км», «Вино 200гр» вполне достаточно.<br>Pаздел "Как прошел ваш день вчера?" - исключение, здесь в 4-5 предложениях опишите ваш день.
						</p>
					<br>
					</div>
					<div id="daily_report_text_block_edit" style="display: none">
						<p>При редактировании отчета соблюдаем важные правила:</p>
						<p>1. Если вы поздно отправили отчет за текущий день (после 00:00 (МСК+04:00) Новосибирск) - вам необходимо в поле "Дата отчета" поставить предыдущее число и нажать "Исправить отчет".</p>
						<p>2. Для редактирования доступен только последний отправленный отчет. В нем вы можете исправить любые строки.</p>
						<p>3. Старайтесь отправлять отчеты вовремя и не пользоваться этой функцией.</p>
						</p>
					<br>
					</div>
 
		    </div> <!-- ЕЖЕДНЕВНЫЙ ОТЧЕТ -->
            
            <div id="tab2" class="tab-content">
	        <?php  //----- ЖЕНСКОЕ МЕНЮ --------//
		        if ( $show_admin_tab == 1 || $show_men_menu_tab == 1 ) {
					echo '<h1 class="mobile-lk-header"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Женское меню</h1> ';
				} else {
					echo '<h1 class="mobile-lk-header"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Мое меню</h1> ';
				};
			echo '<br>';
			if (current_time("d") < 29) { 
			$menu_month = $_monthsListThis[current_time("n")];	
			} else {
				$menu_month_count = current_time("n") + 1 > 12 ? 1 : current_time("n") + 1;
				$menu_month = $_monthsListThis[$menu_month_count];
			};
			?>
			
			<div class="menu_contain_block">
	            <?php 		        
				if ($show_admin_tab == 1) {
			    echo do_shortcode("[pt_view id=1f3df10kd5]");
			 	} else if (is_user_role('notconfirm', $user_id)) {
				 	echo '
								<div class="menu_buyer_header">
									<h1>Благодарим вас за правильный выбор в сторону красоты и здоровья</h1>
									<h1>с maraphon.online</h1>
									<p>Меню ниже доступны вам для скачивания</p>
									<p>Меню представлены в формате .pdf и для вашего удобства сжаты в zip-архив</p>
								</div>
							';
					echo '<div class="grey_line"></div>';
				 	$women_menu_show_array = $wpdb->get_results(
										"
											SELECT 
											*
										    FROM wpux_orders_menu menu
										    WHERE menu.user_id = $user_id
										    AND menu.paid = 1
										    AND menu.content LIKE '%Жен%'
										"	
										);
									if ($women_menu_show_array) {
										foreach ($women_menu_show_array as $string) {
											$women_menu_kcal = substr($string->kcal, -4);
											if ($string->m_1) {$women_menu_month = '№1'; $women_menu_month_db = 1;};
											if ($string->m_2) {$women_menu_month = '№2'; $women_menu_month_db = 2;};
											if ($string->m_3) {$women_menu_month = '№3'; $women_menu_month_db = 3;};
											if ($string->m_4) {$women_menu_month = '№4'; $women_menu_month_db = 4;};
											if ($string->m_5) {$women_menu_month = '№5'; $women_menu_month_db = 5;};
											if ($string->m_6) {$women_menu_month = '№6'; $women_menu_month_db = 6;};
											if ($string->m_7) {$women_menu_month = '№7'; $women_menu_month_db = 7;};
											if ($string->m_8) {$women_menu_month = '№8'; $women_menu_month_db = 8;};
											if ($string->m_9) {$women_menu_month = '№9'; $women_menu_month_db = 9;};
											if ($string->m_10) {$women_menu_month = '№10'; $women_menu_month_db = 10;};
											if ($string->m_11) {$women_menu_month = '№11'; $women_menu_month_db = 11;};
											if ($string->m_12) {$women_menu_month = '№12'; $women_menu_month_db = 12;};
											if ($string->last) {$women_menu_month = 'для участника марафона'; $women_menu_month_db = 'last';};
											if ($string->vegan) {$women_menu_month = 'веганское'; $women_menu_month_db = 'vegan';};
											if ($string->wo_lact) {$women_menu_month = 'безлактозное'; $women_menu_month_db = 'wo_lact';};
													
											$women_menu_link = $wpdb->get_var(				 //вывод ссылки на меню из таблицы wpux_menu_list
											"
												SELECT
												menu_list.url
												FROM wpux_menu_list menu_list
												WHERE menu_list.month = '$women_menu_month_db'
												AND menu_list.type = 'Женское'
												AND menu_list.kcal = '$women_menu_kcal'
											"
											);
											echo '<div class="zip_link">';
												if ($women_menu_link) {
													echo '<a href="'.$women_menu_link.'"><p class="zip_link_txt"><img src="/wp-content/uploads/zip-icon.jpg" class="zip_link_img" alt="zip-архив" />Женское меню '.$women_menu_month.'</p></a>';
													} else {
														echo '<a class="zip_link_txt">Не указана ссылка на женское меню '.$women_menu_month.'</a><br>';
												};
											echo '</div>';
										};
									};
			 	} else 
			 		if (is_user_role('maraphon_1200', $user_id)) {
				 		echo do_shortcode("[pt_view id=4a2c3b2k7s]");
			 			} else 
			 			if (is_user_role('maraphon_1400', $user_id)) {
			 				echo do_shortcode("[pt_view id=fa3c3ebb3e]");
			 				'<style>#account-menu {display: block !important; border-right: none}</style>';
						 	} else 
						 	if (is_user_role('maraphon_1600', $user_id)) {
								echo do_shortcode("[pt_view id=0dc5b35dzp]");
								'<style>#account-menu {display: block !important; border-right: none}</style>';
								} else 
								if (is_user_role('maraphon_1800', $user_id)) {
									echo do_shortcode("[pt_view id=1fb7a1b9cm]");	
									'<style>#account-menu {display: block !important; border-right: none}</style>';
									} else 
									if (is_user_role('maraphon_2000', $user_id)) {
										echo do_shortcode("[pt_view id=8177c855zs]");
										'<style>#account-menu {display: block !important; border-right: none}</style>';
										} else 
										if (is_user_role('maraphon_2200', $user_id)) {
											echo do_shortcode("[pt_view id=1138b8b4n2]");
											'<style>#account-menu {display: block !important; border-right: none}</style>';
											} else 
											if (is_user_role('maraphon_2500', $user_id)) {
												echo do_shortcode("[pt_view id=40e0466uhk]");
												'<style>#account-menu {display: block !important; border-right: none}</style>';};
				?>
				</div>
			</div> <!-- ЖЕНСКОЕ МЕНЮ -->
			
			<?php //----- МУЖСКОЕ МЕНЮ --------//
			if ( $show_admin_tab == 1 || $show_men_menu_tab	== 1) {																	              
				echo '<div id="tab3" class="tab-content">
						<h1 class="mobile-lk-header"><i class="fa fa-file-text" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Мужское меню</h1>
						<br>
						<div class="menu_contain_block">';
						if ($show_admin_tab == 1) {
						    echo do_shortcode("[pt_view id=c46f3cctn5]");
						    
						} else if (is_user_role('notconfirm', $user_id) && $show_men_menu_tab == 1) {
							echo '
								<div class="menu_buyer_header">
									<h1>Благодарим вас за правильный выбор в сторону красоты и здоровья</h1>
									<h1>с maraphon.online</h1>
									<p>Меню ниже доступны вам для скачивания</p>
									<p>Меню представлены в формате .pdf и для вашего удобства сжаты в zip-архив</p>
								</div>
							';
							echo '<div class="grey_line"></div>';
							$men_menu_show_array = $wpdb->get_results(
								"
									SELECT 
									*
								    FROM wpux_orders_menu menu
								    WHERE menu.user_id = $user_id
								    AND menu.paid = 1
								    AND menu.content LIKE '%Муж%'
								"	
							);
							if ($men_menu_show_array) {
								foreach ($men_menu_show_array as $string) {
									$men_menu_kcal = substr($string->kcal, -4);
									if ($string->m_1) {$men_menu_month = '№1'; $men_menu_month_db = 1;};
									if ($string->m_2) {$men_menu_month = '№2'; $men_menu_month_db = 2;};
									if ($string->m_3) {$men_menu_month = '№3'; $men_menu_month_db = 3;};
									if ($string->m_4) {$men_menu_month = '№4'; $men_menu_month_db = 4;};
									if ($string->m_5) {$men_menu_month = '№5'; $men_menu_month_db = 5;};
									if ($string->m_6) {$men_menu_month = '№6'; $men_menu_month_db = 6;};
									if ($string->m_7) {$men_menu_month = '№7'; $men_menu_month_db = 7;};
									if ($string->m_8) {$men_menu_month = '№8'; $men_menu_month_db = 8;};
									if ($string->m_9) {$men_menu_month = '№9'; $men_menu_month_db = 9;};
									if ($string->m_10) {$men_menu_month = '№10'; $men_menu_month_db = 10;};
									if ($string->m_11) {$men_menu_month = '№11'; $men_menu_month_db = 11;};
									if ($string->m_12) {$men_menu_month = '№12'; $men_menu_month_db = 12;};
									if ($string->last) {$men_menu_month = 'для участника марафона'; $men_menu_month_db = 'last';};
									if ($string->vegan) {$men_menu_month = 'веганское'; $men_menu_month_db = 'vegan';};
									if ($string->wo_lact) {$men_menu_month = 'безлактозное'; $men_menu_month_db = 'wo_lact';};
						
									$men_menu_link = $wpdb->get_var(				 //вывод ссылки на меню из таблицы wpux_menu_list
									"
										SELECT
										menu_list.url
										FROM wpux_menu_list menu_list
										WHERE menu_list.month = '$men_menu_month_db'
										AND menu_list.type = 'Мужское'
										AND menu_list.kcal = '$men_menu_kcal'
									"
									);
									
									echo '<div class="zip_link">';
										if ($men_menu_link) {
											echo '<a href="'.$men_menu_link.'"><p class="zip_link_txt"><img src="/wp-content/uploads/zip-icon.jpg" class="zip_link_img" alt="zip-архив" />Мужское меню '.$men_menu_month.'</p></a>';
											} else {
												echo '<a class="zip_link_txt">Не указана ссылка на мужское меню '.$men_menu_month.'</a><br>';
										};
									echo '</div>';
								};
							};
						} else if (is_user_logged_in() && (is_user_role('maraphon_1200', $user_id) || is_user_role('maraphon_1400', $user_id) || is_user_role('maraphon_1600', $user_id) || is_user_role('maraphon_1800', $user_id) || is_user_role('maraphon_2000', $user_id) || is_user_role('maraphon_2200', $user_id) || is_user_role('maraphon_2500', $user_id) )) {
							
							$men_menu_show_array = $wpdb->get_results(
								"
									SELECT 
									*
								    FROM wpux_orders_menu menu
								    WHERE menu.user_id = $user_id
								    AND menu.paid = 1
								    AND menu.content LIKE '%Муж%'
								    ORDER BY menu.date DESC limit 1
								"	
							);
							if ($men_menu_show_array) {
								foreach ($men_menu_show_array as $string) {
									$check_kcal_men_menu = $string->kcal;
									if ($string->m_1) {$men_menu_month = '№1'; $men_menu_month_db = 1;};
									if ($string->m_2) {$men_menu_month = '№2'; $men_menu_month_db = 2;};
									if ($string->m_3) {$men_menu_month = '№3'; $men_menu_month_db = 3;};
									if ($string->m_4) {$men_menu_month = '№4'; $men_menu_month_db = 4;};
									if ($string->m_5) {$men_menu_month = '№5'; $men_menu_month_db = 5;};
									if ($string->m_6) {$men_menu_month = '№6'; $men_menu_month_db = 6;};
									if ($string->m_7) {$men_menu_month = '№7'; $men_menu_month_db = 7;};
									if ($string->m_8) {$men_menu_month = '№8'; $men_menu_month_db = 8;};
									if ($string->m_9) {$men_menu_month = '№9'; $men_menu_month_db = 9;};
									if ($string->m_10) {$men_menu_month = '№10'; $men_menu_month_db = 10;};
									if ($string->m_11) {$men_menu_month = '№11'; $men_menu_month_db = 11;};
									if ($string->m_12) {$men_menu_month = '№12'; $men_menu_month_db = 12;};
								};
							};
							
							$check_men_menu_month = current_time('n');
							$check_men_menu_month_after = current_time('n') + 1;
							if ($check_men_menu_month_after == 13) {$check_men_menu_month_after = 1;};
							if ($check_men_menu_month == $men_menu_month_db || ($check_men_menu_month_after == $men_menu_month_db && current_time('d') > 28)) {
								$access_men_menu = 1;
							} else {
								$access_men_menu = 0;
							};
							
							if ( $check_kcal_men_menu == 'men_menu_1800' && $access_men_menu == 1 ) {
										echo do_shortcode("[pt_view id=7b3a932wgj]");
										} else if ( $check_kcal_men_menu == 'men_menu_2000' && $access_men_menu == 1 ) {
											echo do_shortcode("[pt_view id=45f8e99nuq]");
											} else if ( $check_kcal_men_menu == 'men_menu_2200' && $access_men_menu == 1 ) {
												echo do_shortcode("[pt_view id=b0f7c54u9z]");
												} else if ( $check_kcal_men_menu == 'men_menu_2500' && $access_men_menu == 1 ) {
													echo do_shortcode("[pt_view id=aa0007de0i]");
														} else {
														echo '
															<div class="menu_buyer_header">
																<h1>Благодарим вас за правильный выбор в сторону красоты и здоровья</h1>
																<h1>с maraphon.online</h1>
																<p>Меню ниже доступны вам для скачивания</p>
																<p>Меню представлены в формате .pdf и для вашего удобства сжаты в zip-архив</p>
															</div>
														';
														echo '<div class="grey_line"></div>';
														$men_menu_check_array = $wpdb->get_results(
															"
																SELECT 
																*
															    FROM wpux_orders_menu menu
															    WHERE menu.user_id = $user_id
															    AND menu.paid = 1
															    AND menu.content LIKE '%Муж%'
															"	
														);
														if ($men_menu_check_array) {
															foreach ($men_menu_check_array as $string) {
																$men_menu_kcal = substr($string->kcal, -4);
																if ($string->m_1) {$men_menu_month = '№1'; $men_menu_month_db = 1;};
																if ($string->m_2) {$men_menu_month = '№2'; $men_menu_month_db = 2;};
																if ($string->m_3) {$men_menu_month = '№3'; $men_menu_month_db = 3;};
																if ($string->m_4) {$men_menu_month = '№4'; $men_menu_month_db = 4;};
																if ($string->m_5) {$men_menu_month = '№5'; $men_menu_month_db = 5;};
																if ($string->m_6) {$men_menu_month = '№6'; $men_menu_month_db = 6;};
																if ($string->m_7) {$men_menu_month = '№7'; $men_menu_month_db = 7;};
																if ($string->m_8) {$men_menu_month = '№8'; $men_menu_month_db = 8;};
																if ($string->m_9) {$men_menu_month = '№9'; $men_menu_month_db = 9;};
																if ($string->m_10) {$men_menu_month = '№10'; $men_menu_month_db = 10;};
																if ($string->m_11) {$men_menu_month = '№11'; $men_menu_month_db = 11;};
																if ($string->m_12) {$men_menu_month = '№12'; $men_menu_month_db = 12;};
																if ($string->last) {$men_menu_month = 'для участника марафона'; $men_menu_month_db = 'last';};
																if ($string->vegan) {$men_menu_month = 'веганское'; $men_menu_month_db = 'vegan';};
																if ($string->wo_lact) {$men_menu_month = 'безлактозное'; $men_menu_month_db = 'wo_lact';};
													
																$men_menu_link = $wpdb->get_var(				 //вывод ссылки на меню из таблицы wpux_menu_list
																"
																	SELECT
																	menu_list.url
																	FROM wpux_menu_list menu_list
																	WHERE menu_list.month = '$men_menu_month_db'
																	AND menu_list.type = 'Мужское'
																	AND menu_list.kcal = '$men_menu_kcal'
																"
																);
																echo '<div class="zip_link">';
																	if ($men_menu_link) {
																		echo '<a href="'.$men_menu_link.'"><p class="zip_link_txt"><img src="/wp-content/uploads/zip-icon.jpg" class="zip_link_img" alt="zip-архив" />Мужское меню '.$men_menu_month.'</p></a>';
																		} else {
																			echo '<a class="zip_link_txt">Не указана ссылка на мужское меню '.$men_menu_month.'</a><br>';
																	};
																echo '</div>';
															};
														};
							};
						};
				echo '</div>';
			echo '</div>';	
			};
			//----- МУЖСКОЕ МЕНЮ ------//		  
			?>						
			
			<?php //----- ТРЕНИРОВКИ --------//
			if ( $show_admin_tab == 1 || $show_men_menu_tab	== 1) {	
				echo '<div id="tab4" class="tab-content">';
				} else {
					echo '<div id="tab3" class="tab-content">';
			};
			?>
		    <h1 class="mobile-lk-header"><i class="fa fa-rocket" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Мои тренировки</h1>
		    <br>
		        <div class="menu_contain_block">
	            <?php 
				$member_workout_class = get_user_meta ( $user_id, 'workout_class', true);
				$show_workout_for_maraphon_member = 1;
				
				if (is_user_role('administrator', $user_id) || is_user_role('content_1', $user_id)) {			//вывод тренировок для участников марафона через пользовательское поле workout_class 
					echo do_shortcode("[pt_view id=c0574777np]");
				} else if ($member_workout_class == '1') {
					echo do_shortcode("[pt_view id=35fd664gyv]");
				} else if ($member_workout_class == '2') {
			    	echo do_shortcode("[pt_view id=69a055e95g]");
			 	} else if ($member_workout_class == '3') {
			    	echo do_shortcode("[pt_view id=ce08cb3q68]");
			 	} else if ($member_workout_class == '4') {
			    	echo do_shortcode("[pt_view id=7e7db45t1p]");
			 	} else if ($member_workout_class == '5') {
			    	echo do_shortcode("[pt_view id=3e7ed7fcy6]");
			 	} else if ($member_workout_class == '6') {
			    	echo do_shortcode("[pt_view id=4725345xq4]");
			 	} else if ($member_workout_class == '7') {
			    	echo do_shortcode("[pt_view id=96819b87pq]");
			 	} else if ($member_workout_class == '8') {
			    	echo do_shortcode("[pt_view id=48ec99bdxe]");
			 	} else if ($member_workout_class == '9') {
			    	echo do_shortcode("[pt_view id=973f5d54gi]");
			 	} else if ($member_workout_class == '10') {
			    	echo do_shortcode("[pt_view id=f0bd275z8h]");
			 	} else {
				 	$show_workout_for_maraphon_member = 0;
			 	};
			 	
			 	if ($check_any_workout_to_buy > 0) {
				 	$show_workout_for_workout_buyers = 1;
					$workout_show_array = $wpdb->get_results(
					"
						SELECT 
						workout.class_1,
					    workout.class_2,
					    workout.class_3,
					    workout.class_4,
					    workout.class_5,
					    workout.class_6,
					    workout.class_7,
					    workout.class_8,
					    workout.class_9,
					    workout.class_10
					    FROM wpux_orders_workout workout
					    WHERE workout.user_id = $user_id
					    AND workout.paid = 1
					"	
					);
					
					if ($workout_show_array) {
						foreach ($workout_show_array as $string) {
							if ($string->class_1) {$class_1 = '35fd664gyv';};
							if ($string->class_2) {$class_2 = '69a055e95g';};
							if ($string->class_3) {$class_3 = 'ce08cb3q68';};
							if ($string->class_4) {$class_4 = '7e7db45t1p';};
							if ($string->class_5) {$class_5 = '3e7ed7fcy6';};
							if ($string->class_6) {$class_6 = '4725345xq4';};
							if ($string->class_7) {$class_7 = '96819b87pq';};
							if ($string->class_8) {$class_8 = '48ec99bdxe';};
							if ($string->class_9) {$class_9 = '973f5d54gi';};
							if ($string->class_10) {$class_10 = 'f0bd275z8h';};
						};
					};
					
					if ($member_workout_class != '1') {echo do_shortcode('[pt_view id='.$class_1.']');};
					if ($member_workout_class != '2') {echo do_shortcode('[pt_view id='.$class_2.']');};
					if ($member_workout_class != '3') {echo do_shortcode('[pt_view id='.$class_3.']');};
					if ($member_workout_class != '4') {echo do_shortcode('[pt_view id='.$class_4.']');};
					if ($member_workout_class != '5') {echo do_shortcode('[pt_view id='.$class_5.']');};
					if ($member_workout_class != '6') {echo do_shortcode('[pt_view id='.$class_6.']');};
					if ($member_workout_class != '7') {echo do_shortcode('[pt_view id='.$class_7.']');};
					if ($member_workout_class != '8') {echo do_shortcode('[pt_view id='.$class_8.']');};
					if ($member_workout_class != '9') {echo do_shortcode('[pt_view id='.$class_9.']');};
					if ($member_workout_class != '10') {echo do_shortcode('[pt_view id='.$class_10.']');};	
			 	} else {
				 	$show_workout_for_workout_buyers = 0;
				};
				
				if ($show_workout_for_maraphon_member == 0 && $show_workout_for_workout_buyers == 0) {
				 	echo '
				 	<div style="text-align: center; font-size: 28px; height: 500px;">
				 		<p style="padding-top: 80px;">Раздел тренировки недоступен для выбранного вами пакета</p>
				 		<p>Вы можете приобрести тренировки в магазине либо выбрать пакет выше уровнем</p>
				 		<button class="membersReportButton"><p style="margin: 0; padding-top: 2px;"><a href="http://maraphon.online/shop">Перейти в магазин</a></p></button>
				 	</div>';
				 };
				?>
		        </div>		        
		    </div> <!-- ТРЕНИРОВКИ -->
	        
	        <?php //----- ЗАМЕРЫ --------//
			if ( $show_admin_tab == 1 || $show_men_menu_tab	== 1) {	
				echo '<div id="tab5" class="tab-content" style="margin-bottom: -24px;">';
			} else {
				echo '<div id="tab4" class="tab-content" style="margin-bottom: -24px;">';
			};
			?>
            <h1 class="mobile-lk-header"><i class="fa fa-trophy" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Мои замеры</h1>
            <div style="height: 45px;"></div>
			
			<?php
			$current_date_result_user_start = current_time("Y-m").'-01';
			$current_date_result_user_finish = current_time("Y-m").'-31';	
			$current_user_inst_report = $wpdb->get_results( 
			"
			SELECT 
				(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'first_name' limit 1) as first_name,
				(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'last_name' limit 1) as last_name,
				(select meta_value from wpux_usermeta where user_id = users.ID and meta_key = 'maraphon_counter' limit 1) as maraphon_counter,
				(select orders.paid FROM wpux_orders orders WHERE user_id = users.ID and 
		        (DATE(orders.date) BETWEEN '$current_date_result_start' AND '$current_date_result_finish')) as paid,
		        (select orders.credit FROM wpux_orders orders WHERE user_id = users.ID and 
		        (DATE(orders.date) BETWEEN '$current_date_result_start' AND '$current_date_result_finish')) as credit
		        FROM wpux_users users
				WHERE users.user_id = $user_id	  
			"
			);
			?> 
		
			<p class="mobile_user_maraphon_count">Мой результат после 
				<?php 
					
					$maraphon_counter = get_the_author_meta('maraphon_counter', $user_id);
					if ($maraphon_counter) {
					$maraphon_counter = $maraphon_counter + $check_maraphon_counter;
					echo $maraphon_counter;
					} else {
						echo '-';
					};
				?>
				марафона</p>
			
			<button class="user_motnhly_report_button">Моя таблица</button>
		
			<script>
				$('.user_motnhly_report_button').click(function(){
					if ($(".user_motnhly_report_button").text() == 'Моя таблица') {
					$(".user_motnhly_report_button").text('Посмотреть результат');
					$(".mobile_user_maraphon_count").text('Моя таблица после <?php /*the_author_meta( 'maraphon_counter', $current_user->ID );*/ echo $maraphon_counter; ?> марафона');
				    $('.lk-table-measuring-report').show();
				    $('.user_result_draw').hide();}
				    else {
					$(".user_motnhly_report_button").text('Моя таблица');
					$(".mobile_user_maraphon_count").text('Мой результат после <?php /*the_author_meta( 'maraphon_counter', $current_user->ID );*/ echo $maraphon_counter; ?> марафона');
					$('.lk-table-measuring-report').hide();
				    $('.user_result_draw').show();   
				    }
				})
			</script>
		
		<table class="lk-table-measuring-report">
				<tr>
					<th style="width: 10%">Дата</th>
					<th style="width: 10%">Вес</th>
                    <th style="width: 10%">Объем груди</th>
                    <th style="width: 10%">Талия</th>
                    <th style="width: 10%">Живот</th>
                    <th style="width: 10%">Объем ягодиц</th>
                    <th style="width: 10%">Нога левая</th>
                    <th style="width: 10%">Нога правая</th>
                    <th style="width: 10%">Икра</th>
                    <th style="width: 10%">Рука</th>
                </tr>
                    
               <?php		
							$current_user = wp_get_current_user();
							$user_id = $current_user->ID;
							$date_func = current_time ('Y-m-d',0);
							$user_result_weight = 0;
							$user_weight_delta_draw = 0;
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
							WHERE user_id = $user_id
							ORDER BY date
							"
							);
							if( $user_result_report ) {
							    foreach ( $user_result_report as $user_string_report ) {
								        echo '<tr>';
								        
								        echo '<td>';
								        $user_database_date =  $user_string_report->date;
								        $user_result_day = substr($user_database_date, 8);
								        $user_result_month = substr($user_database_date, 5, 2);
								        $user_result_year = substr($user_database_date, 0, 4);
										$user_database_date = $user_result_day.'.'.$user_result_month.'.'.$user_result_year;
								        echo '&nbsp;'.$user_database_date.'&nbsp;';
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
								        else if ( ($user_report_waist_delta > 0)  && ($user_report_waist_delta < $user_result_waist_now) ) {$waist_color = '#f8d7da';}
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
								        /*if (!empty($user_string_report->director_comment)) {  //отображение комментария директора в таблице результатов участника
								        echo '<tr>';
									        echo '<td colspan="10">';
									        	echo $user_string_report->director_comment;
									        echo '</td>';
								        echo '</tr>';
										};*/
					    		}
							}		 
						?> 	
		</table> 
		
		<table class="user_result_draw">
			<tr>
				<td style="width: 16.5%;"></td>
				<td style="width: 16.5%;"></td>
				<td style="width: 33%;"></td>
				<td style="width: 16.5%;"></td>
				<td style="width: 16.5%;"></td>
			</tr>
			<tr>
				<td><div class="user_result_draw_round">
					<?php
					if ($user_arm_delta_draw == '' || $user_arm_delta_draw == 0) {echo '0';} else
					if ($user_arm_delta_draw > 0) {echo '+'.$user_arm_delta_draw;} else {echo $user_arm_delta_draw;}; 
					?> см</div></td>
				<td>Рука</td>	  
				<td></td>
				<td>Объем груди</td>
				<td><div class="user_result_draw_round">
					<?php
					if ($user_breast_delta_draw == '' || $user_breast_delta_draw == 0) {echo '0';} else
					if ($user_breast_delta_draw > 0) {echo '+'.$user_breast_delta_draw;} else {echo $user_breast_delta_draw;}; 
					?> см</div></td>
			</tr>
			<tr>
				<td><div class="user_result_draw_round">
					<?php 
					if ($user_waist_delta_draw == '' || $user_waist_delta_draw == 0) {echo '0';} else
					if ($user_waist_delta_draw > 0) {echo '+'.$user_waist_delta_draw;} else {echo $user_waist_delta_draw;};
					?> см</div></td>
				<td>Талия</td>	  
				<td></td>
				<td>Живот</td>
				<td><div class="user_result_draw_round">
					<?php
					if ($user_stomach_delta_draw == '' || $user_stomach_delta_draw == 0) {echo '0';} else
					if ($user_stomach_delta_draw > 0) {echo '+'.$user_stomach_delta_draw;} else {echo $user_stomach_delta_draw;}; 
					?> см</div></td>
			</tr>
			<tr>
				<td><div class="user_result_draw_round">
					<?php
					if ($user_booty_delta_draw == '' || $user_booty_delta_draw == 0) {echo '0';} else
					if ($user_booty_delta_draw > 0) {echo '+'.$user_booty_delta_draw;} else {echo $user_booty_delta_draw;}; 
					?> см</div></td>
				<td>Объем ягодиц</td>	  
				<td></td>
				<td>Нога левая</td>
				<td><div class="user_result_draw_round">
					<?php
					if ($user_left_leg_delta_draw == '' || $user_left_leg_delta_draw == 0) {echo '0';} else
					if ($user_left_leg_delta_draw > 0) {echo '+'.$user_left_leg_delta_draw;} else {echo $user_left_leg_delta_draw;}; 
					?> см</div></td>
			</tr>
			<tr>
				<td><div class="user_result_draw_round">
					<?php
					if ($user_right_leg_delta_draw == '' || $user_right_leg_delta_draw == 0) {echo '0';} else
					if ($user_right_leg_delta_draw > 0) {echo '+'.$user_right_leg_delta_draw;} else {echo $user_right_leg_delta_draw;}; 
					?> см</div></td>
				<td>Нога правая</td>
				<td rowspan="2" ><div style="margin-left: 37%;" class="user_result_draw_round"><strong>
					<?php
					if ($user_weight_delta_draw == '' || $user_weight_delta_draw == 0) {echo '0';} else
					if ($user_weight_delta_draw > 0) {echo '+'.round($user_weight_delta_draw, 1);} else {echo round($user_weight_delta_draw, 1);};

					?> кг</strong></div></td>
				<td>Икра</td>
				<td><div class="user_result_draw_round">
					<?php
					if ($user_calf_delta_draw == '' || $user_calf_delta_draw == 0) {echo '0';} else
					if ($user_calf_delta_draw > 0) {echo '+'.$user_calf_delta_draw;} else {echo $user_calf_delta_draw;};
					?> см</div></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</table>
					<?php 			
						$current_day_report = current_time ('d.m.Y',0);
						if ($current_day_report == $user_database_date) {
							$form_monthly_report_flag = 'none';
						} else {
							$form_monthly_report_flag = 'block';
						};
					?>
		
		<form type="post" action="" style="display:<?php echo $form_monthly_report_flag; ?>" id="monthlyReportForm">
						<div class="confirm_form_block">   
							<table class="daily_report_confirmation" >
							<h1 id="daily_report_for_user_h1">Введите Ваши данные: </h1>
								<tr> 
									<th><label for="">Вес, кг</label></th>
								</tr>
								
								<tr>
					                <td><input class="text-input" name="monthly_weight" type="number" step="0.001" /></td>
								</tr>
								
								<tr> 
									<th><label for="monthly_breast">Объем груди, см</label></th>
								</tr>
								
								<tr> 
				                    <td><input class="text-input" name="monthly_breast" type="number" step="0.1" /></td>
								</tr>
								
								<tr> 
									<th><label for="monthly_waist">Талия, см</label></th>
								</tr>
								<tr> 
				                    <td><input class="text-input" name="monthly_waist" type="number" step="0.1" /></td>
								</tr>
								
								<tr> 
									<th><label for="monthly_stomach">Живот, см</label></th>
								</tr>
								<tr> 
				                    <td><input class="text-input" name="monthly_stomach" type="number" step="0.1" /></td>
								</tr>
								
								<tr> 
									<th><label for="monthly_booty">Объем ягодиц, см</label></th>
								</tr>
								<tr> 
				                    <td><input class="text-input" name="monthly_booty" type="number" step="0.1" /></td>
								</tr>
								
								<tr> 
									<th><label for="monthly_left_leg">Нога левая, см</label></th>
								</tr>
								<tr> 
				                    <td><input class="text-input" name="monthly_left_leg" type="number" step="0.1" /></td>
								</tr>
								
								<tr> 
									<th><label for="monthly_right_leg">Нога правая, см</label></th>
								</tr>
								<tr> 
				                    <td><input class="text-input" name="monthly_right_leg" type="number" step="0.1" /></td>
								</tr>
								
								<tr> 
									<th><label for="monthly_calf">Икра, см</label></th>
								</tr>
								<tr> 
				                    <td><input class="text-input" name="monthly_calf" type="number" step="0.1" /></td>
								</tr>
								
								<tr> 
									<th><label for="monthly_arm">Рука, см</label></th>
								</tr>
								
								<tr> 
				                    <td><input class="text-input" name="monthly_arm" type="number" step="0.1" /></td>
								</tr>							
							</table>
							
						<p class="daily_report_submit" >
							<input type="hidden" name="action" value="sendMonthlyReport"/>
							<input type="submit" id="monthly_report_submit" class="submit button" value="Отправить замеры">
							</p>
							<p style="text-align: center; margin-top: -20px;">Нажимая на кнопку, вы даете согласие на обработку своих персональных данных и соглашаетесь с <a href="http://maraphon.online/privacy-policy/" target="_blank">политикой конфиденциальности</a></p>
						</div>
						<div class="clearfloat"></div>
		</form>
		
					<div id="fail_monthly_report" style="display: none;"><p>Ошибка, заполните все поля</p></div>
					<div id="fail_monthly_report_weight" style="display: none;"><p>Ошибка, укажите вес в кг</p></div>
					<div id="success_monthly_report"></div>
					<div style="height: 20px;"></div>
		
		<div class="monthly_report_text_block" style="display:<?php echo $form_monthly_report_flag; ?>">
						<p>При заполнении отчета соблюдаем три простых правила:</p>
						<p>1. Пунктуальность - отчет нужно заполнять перед стартом марафона (<strong>28 число</strong>), в середине месяца (<strong>15 число</strong>) и в конце марафона (<strong>28 число</strong>). Исключение - дни месячных. В этом случае замеры производим на следующий день после окончания цикла.</p>
						
						<p>2. Честность - <strong>вносите данные как есть</strong>, нет смысла делать этот отчет «красивым», внося недостоверную информацию. Этим вы вводите в заблуждение в первую очередь себя.</p>
						<p>3. Разумность - <strong>записывайте измерения с максимальной точностью до 0,1кг и 0,1см</strong>, нет необходимости отбирать у мужчин штангенциркуль или искать атомные весы. Точность до микрометра и милиграмма нам не нужна.</p>
						<a class="mobile_manual" style ="color: #fec300; margin-left: 250px;" href="javascript:void(0)" onclick="document.getElementById('parent_popup_click1').style.display='block';">Фотоинструкция здесь</a>
						<div id="parent_popup_click1">
						<div id="popup_click1">
						<image src="http://maraphon.online/wp-content/uploads/size_2.jpg">
						<a class="close" title="Закрыть" onclick="document.getElementById('parent_popup_click1').style.display='none';"> x</a>
						</div>
						</div>
						
						<style>
							#parent_popup, #parent_popup_click1 {
							    display: none;
							    position: absolute;
							    z-index: 99999;
							    top: 100px;
							    right: 0;
							    bottom: 0;
							    left: 0px;
							}
							
							#popup, #popup_click1 { 
								background: #fff;
							    max-width: 600px;
							    width:80%;
							    margin: 10% auto;
							    padding: 5px 20px 13px 20px;
							    border: 1px solid #ddd;
							    position: relative;
							    -webkit-box-shadow: 0px 0px 20px #000;
							    -moz-box-shadow: 0px 0px 20px #000;
							    box-shadow: 0px 0px 20px #000;
							    -webkit-border-radius: 6px;
							    -moz-border-radius: 6px;
							    border-radius: 6px;
							}
						 
							.close {
							    background-color: white;
							    color: black;
							    border: 2px solid #ccc;
							    height: 24px;
							    position: absolute;
							    line-height: 18px;
							    right: -24px;
							    cursor: pointer;
							    text-align: center;
							    text-decoration: none;
							    font-size: 14px;
							    font-family: helvetica, arial;
							    top: -24px;
							    width: 24px;
							    -webkit-border-radius: 15px;
							    -moz-border-radius: 15px;
							    -ms-border-radius: 15px;
							    -o-border-radius: 15px;
							    border-radius: 15px;
							    -moz-box-shadow: 1px 1px 3px #000;
							    -webkit-box-shadow: 1px 1px 3px #000;
							    box-shadow: 1px 1px 3px #000;
						}
							.close:hover {
							    color: #d5d5d5;
						}
						
							#popup_click1 {
							    background: #fff;
							    max-width: 600px;}
				</style>
		</div>
					
					<script type="text/javascript">
					jQuery('#monthlyReportForm').submit(ajaxSubmit);
					function ajaxSubmit(){
					$('[type="submit"]').prop('disabled', true);
					setTimeout(function() {
					$('[type="submit"]').prop('disabled', false);
					}, 1000); // 1 second
					var monthlyReportForm = jQuery(this).serialize();
					var time = new Date;
					var day = time.getDate();
					if (day < 10) day = '0' + day;
					var month = time.getMonth() + 1;
					if (month < 10) month = '0' + month;
					var year = time.getFullYear();					
					var monthly_date = day + '.' + month + '.' + year;
					var monthly_weight = $('input[name="monthly_weight"]').val();
					var monthly_breast = $('input[name="monthly_breast"]').val();
					var monthly_waist = $('input[name="monthly_waist"]').val();
					var monthly_stomach = $('input[name="monthly_stomach"]').val();
					var monthly_booty = $('input[name="monthly_booty"]').val();
					var monthly_left_leg = $('input[name="monthly_left_leg"]').val();
					var monthly_right_leg = $('input[name="monthly_right_leg"]').val();
					var monthly_calf = $('input[name="monthly_calf"]').val();
					var monthly_arm = $('input[name="monthly_arm"]').val();
					if ( (monthly_weight > 200) || (monthly_weight == '0') || (monthly_weight == '0,0') || (monthly_weight == '0.0') || (monthly_weight < 0)) {
						$("#fail_monthly_report_weight").show();
						setTimeout(function(){$('#fail_monthly_report_weight').fadeOut('slow')},1000);
					} else {
							$.ajaxSetup({cache: false});
						if ( monthly_weight && monthly_breast && monthly_waist && monthly_stomach && monthly_booty && monthly_left_leg && monthly_right_leg && monthly_calf && monthly_arm) {	
							$.ajax({
									type:"POST",
									url: "/wp-admin/admin-ajax.php",
									data: monthlyReportForm,
									success:function(data){
									$('#monthlyReportForm').remove();
									$('.monthly_report_text_block').remove();
									$('.lk-table-measuring-report').append("<tr><td>"+monthly_date+"</td><td>"+monthly_weight+"</td><td>"+monthly_breast+"</td><td>"+monthly_waist+"</td><td>"+monthly_stomach+"</td><td>"+monthly_booty+"</td><td>"+monthly_left_leg+"</td><td>"+monthly_right_leg+"</td><td>"+monthly_calf+"</td><td>"+monthly_arm+"</td></tr>");
									$("#success_monthly_report").html(data);
									$("#fail_monthly_report").hide();
									}
							});
						} else
							{
							$('#monthly_report_submit').disabled;
							$("#fail_monthly_report").show();
							setTimeout(function(){$('#fail_monthly_report').fadeOut('slow')},1000);
							return false;
							}
					};
						
					return false;
					} 
					</script>
			</div> <!-- ЗАМЕРЫ -->
			
			            
            <?php //----- ЛИЧНЫЕ ДАННЫЕ --------//
			if ( $show_admin_tab == 1 || $show_men_menu_tab	== 1) {	
				echo '<div id="tab6" class="tab-content">';
			} else {
				echo '<div id="tab5" class="tab-content">';
			};
			?>
			<h1 class="mobile-lk-header"><i class="fa fa-address-card-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Личные данные</h1>
			<br>
			
				<form type="post" action="" id="userForm">
			<div class="lk-maraphon-buy" style="<?php echo $lk_maraphon_buy_div_flag ?>">
					
	                <table class="lk-table-header">
					 
                       <tr>
                           <td><h1><i class="fa fa-envelope-open-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Контакты</h1></td>
                           <td><h1><i class="fa fa-bar-chart" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Параметры</h1></td>
                           <td><h1><i class="fa fa-venus"></i></i>&nbsp;&nbsp;&nbsp;Женская физиология</h1></td>
                       </tr>
                        
                    </table>
                                           
                    <h1 class="mobile-form-header"><i class="fa fa-envelope-open-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Контакты</h1>
                    
                    <table class="lk-table-contacts">
                    
                    <tr class="form-username">
                        <th><label for="first-name">Имя</label></th>
                        <td><input class="text-input" name="first-name" type="text" id="first-name" value="<?php the_author_meta( 'first_name', $user_id ); ?>" /></td>
                    </tr>
                    
                    <tr class="form-username">
                        <th><label for="last-name">Фамилия</label></th>
                        <td><input class="text-input" name="last-name" type="text" id="last-name" value="<?php the_author_meta( 'last_name', $user_id ); ?>" /></td>
                    </tr>
                    
                    <tr class="form-telephone">
                        <th><label for="telephone">Телефон</label></th>
                        <td><input class="text-input" name="telephone" type="text" id="telephone" value="<?php the_author_meta( 'telephone', $user_id ); ?>" /></td>
                    </tr>
                    
                    <tr class="form-email">
                        <th><label for="email">E-mail</label></th>
                        <td><input class="text-input" readonly name="email" type="text" id="email" value="<?php the_author_meta( 'user_email', $user_id ); ?>" /></td>
                    </tr>
                    
                    <tr class="form-town">
                        <th><label for="town">Город (нас. пункт)</label></th>
                        <td><input class="text-input" name="town" type="text" id="town" value="<?php the_author_meta( 'town', $user_id ); ?>" /></td>
                    </tr>

                    <tr class="form-textarea">
                        <th><label for="what_you_know">Откуда узнали о марафоне?</label></th>
                        <td><textarea name="what_you_know" id="what_you_know" rows="5" cols="1"><?php the_author_meta( 'what_you_know', $user_id ); ?></textarea></td>
                    </tr>
</table>
					
					
					
                  <h1 class="mobile-form-header"><i class="fa fa-bar-chart" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Параметры</h1>

                  <table class="lk-table-parameters">
				  	
                    <tr class="form-age">
                        <th><label for="age">Возраст, полных лет</label></th>
                        <td><input class="text-input" name="age" type="number" id="age" value="<?php the_author_meta( 'age', $user_id ); ?>" /></td>
                    </tr>              
                    
                    <tr class="form-height">
                        <th><label for="height">Рост, до 1см</label></th>
                        <td><input class="text-input" name="height" type="number" id="height" value="<?php the_author_meta( 'height', $user_id ); ?>" /></td>
                    </tr>
                    
                     <tr class="form-weight-at-start">
                        <th><label for="weight-at-start">Текущий вес, до 0,1кг</label></th>
                        <td><input class="text-input" name="weight-at-start" type="number" id="weight-at-start" step="0.1" value="<?php the_author_meta( 'weight-at-start', $user_id ); ?>" /></td>
                    </tr>
                    
                    <tr id="daily-activity-row">
                    	<th><label for="daily-activity">Выберите Вашу активность</label></th>                                     
                        <td>
	                    <?php 
	                       	$daily_activity_value = get_user_meta( $user_id, 'daily-activity', true);
	                       		if (empty($daily_activity_value)) { $selected_c1 = 'selected="selected"'; };
						        if ($daily_activity_value == '1.25') { $selected_c2 = 'selected="selected"'; };
								if ($daily_activity_value == '1.3') { $selected_c3 = 'selected="selected"'; };
								if ($daily_activity_value == '1.35') { $selected_c4 = 'selected="selected"'; };
								if ($daily_activity_value == '1.375') { $selected_c5 = 'selected="selected"'; };
								if ($daily_activity_value == '1.4') { $selected_c6 = 'selected="selected"'; };
								if ($daily_activity_value == '1.45') { $selected_c7 = 'selected="selected"'; };

						        echo '<select name="daily-activity" class="select-width" style = "background-color: #fafafa" id="daily-activity">';
						        	echo '<option '.$selected_c1.' class="select-width" disabled hidden>Ваша активность?</option>';
			                    	echo '<option '.$selected_c2.' class="select-width" value="1.25">Нет активности (офисная/сидячая работа, езда на транспорте) либо прогулки не менее часа</option>';
									echo '<option '.$selected_c3.' class="select-width" value="1.3">2-3 тренировки в неделю низкой интенсивности  (танцы, пилатес, домашние тренировки, бассейн)</option>';
									echo '<option '.$selected_c4.' class="select-width" value="1.35">2-3 тренировки в неделю средней интенсивности, фитнес, силовые, групповые интенсивные</option>';
									echo '<option '.$selected_c5.' class="select-width" value="1.375">Стабильно интенсивные от 3-х тренировок (50 мин) в неделю/силовые/фитнес</option>';
									echo '<option '.$selected_c6.' class="select-width" value="1.4">4-5 тренировки в неделю высокой интенсивности</option>';
									echo '<option '.$selected_c7.' class="select-width" value="1.45">5 и более интенсивных тренировок в неделю</option>';
								echo '</select>'; 
	                    ?>    
                        </td>
                    </tr>
                    		  	
				  	<tr class="form-age">
                        <th><label for="weight_at_1_maraphon">Вес на момент начала участия в 1 марафоне</label></th>
                        <td><input class="text-input" name="weight_at_1_maraphon" type="number" id="weight_at_1_maraphon" step="0.1" value="<?php the_author_meta( 'weight_at_1_maraphon', $user_id ); ?>" /></td>
                    </tr> 
                    
                    <tr class="form-dream-weight">
                        <th><label for="dream-weight">Желаемый вес, кг</label></th>
                        <td><input class="text-input" name="dream-weight" type="text" id="dream-weight" step="0.1" value="<?php the_author_meta( 'dream-weight', $user_id ); ?>" /></td>
                    </tr>
                        
                    <tr id="daily-activity-confirm-row" style="display: none;">
                        <th><label for="daily-activity">Коэф. активности</label></th>
                        <td><input class="text-input" name="daily-activity" type="number" id="daily-activity" disabled value="<?php the_author_meta( 'daily-activity', $user_id ); ?>" /></td>

                    </tr>
                                
		    </table> 
		    	
		   <h1 class="mobile-form-header"><i class="fa fa-venus"></i>&nbsp;&nbsp;&nbsp;Женская физиология</h1>
			    <table class="lk-table-measuring">
                
                <tr class="form-pregnant">
                        <th><label for="pregnant">Роды, когда?</label></th>
                        <td><input class="text-input" name="pregnant" type="text" id="pregnant" value="<?php the_author_meta( 'pregnant', $user_id ); ?>" /></td>
                </tr>
                
                <tr class="form-breastfeed">
                        <th><label for="breastfeed">Грудное вскармливание на сегодня</label></th>
                        <td>
                        <?php 
	                       		$breastfeed_value = get_user_meta ( $user_id, 'breastfeed', true);
	                       		if (empty($breastfeed_value)) { $selected_b1 = 'selected="selected"'; };
						        if ($breastfeed_value == 'Да') { $selected_b2 = 'selected="selected"'; };
								if ($breastfeed_value == 'Нет') { $selected_b3 = 'selected="selected"'; };
						        echo '<select name="breastfeed" id="breastfeed">';
						        echo '<option '.$selected_b1.' disabled hidden value="">Да/Нет?</option>'; 
								echo '<option '.$selected_b2.' value="Да">Да</option>'; 
								echo '<option '.$selected_b3.' value="Нет">Нет</option>'; 
								echo '</select>'; 
	                    ?>    
                        </td>
                    </tr>
                    
                    <tr class="form-first-menstruation-day">
	                <th><label for="first_menstruation_day">Первый день месячных, число</label></th>
	                <td><input class="text-input" name="first_menstruation_day" type="text" id="first_menstruation_day" value="<?php the_author_meta( 'first_menstruation_day', $user_id ); ?>" /></td>
                	</tr>
                    
                    <tr class="form-textarea">
			                <th><label for="contraceptive">Принимаете ли противозачаточные?</label></th>
			                <td><textarea name="contraceptive" id="contraceptive" rows="5" cols="1"><?php the_author_meta( 'contraceptive', $user_id ); ?></textarea></td>
					</tr>
			
                     
			
					<table class="lk-table-header lk-table-header-block-2">
                       <tr>
                           <td><h1><i class="fa fa-thermometer-half" aria-hidden="true"></i>&nbsp;&nbsp;Здоровье</h1></td>
                           <td><h1><i class="fa fa-cutlery" aria-hidden="true"></i>&nbsp;&nbsp;Питание</h1></td>
                           <td><h1><i class="fa fa-rocket" aria-hidden="true"></i>&nbsp;&nbsp;Тренировки</h1></td>
                       </tr>
                    </table>
                    
					<h1 class="mobile-form-header"><i class="fa fa-thermometer-half" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Здоровье</h1>
					<table class="lk-table-health">
	
					<tr class="form-textarea">
						<th><label for="hormonal-background">Есть ли проблемы, связанные с гормональной системой?</label></th>
						<td><textarea name="hormonal-background" id="hormonal-background" rows="5" cols="1"><?php the_author_meta( 'hormonal-background', $user_id ); ?></textarea></td>
					</tr>

		            <tr class="form-textarea">
		                <th><label for="hair-problems">Есть ли проблемы с волосами? Какие?</label></th>
			            <td><textarea name="hair-problems" id="hair-problems" rows="5" cols="1"><?php the_author_meta( 'hair-problems', $user_id ); ?></textarea></td>
		            </tr>
		
		            <tr class="form-textarea">
					    <th><label for="intestin_problems">Есть ли проблемы с кишечником?</label></th>
					    <td><textarea name="intestin_problems" id="intestin_problems" rows="5" cols="1"><?php the_author_meta( 'intestin_problems', $user_id ); ?></textarea></td>
		            </tr>
		            
		            <tr class="form-textarea">
					    <th><label for="joint_problems">Есть ли проблемы с суставами? Травма?</label></th>
					    <td><textarea name="joint_problems" id="joint_problems" rows="5" cols="1"><?php the_author_meta( 'joint_problems', $user_id ); ?></textarea></td>
		            </tr>
		            
		            <tr class="form-textarea">
					    <th><label for="diastaz">Есть ли диастаз (расхождение передней мышцы живота после беременности) ?</label></th>
					    <td><textarea name="diastaz" id="diastaz" rows="5" cols="1"><?php the_author_meta( 'diastaz', $user_id ); ?></textarea></td>
		            </tr>
		
					<tr class="form-textarea">
					    <th><label for="thyroid">Есть ли проблемы с щитовидной железой?</label></th>
					    <td><textarea name="thyroid" id="thyroid" rows="5" cols="1"><?php the_author_meta( 'thyroid', $user_id ); ?></textarea></td>
		            </tr>

        			</table>
					
					<h1 class="mobile-form-header"><i class="fa fa-cutlery" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Питание</h1>
					<table class="lk-table-food">
	
						<tr class="form-textarea">
							<th><label for="vitamins">Принимаете ли витамины? Какие?</label></th>
							<td><textarea name="vitamins" id="vitamins" rows="5" cols="1"><?php the_author_meta( 'vitamins', $user_id ); ?></textarea></td>
						</tr>
							
						<tr class="form-textarea">
			                <th><label for="medicines">Принимаете ли лекарства на постоянной основе?</label></th>
			                <td><textarea name="medicines" id="medicines" rows="5" cols="1"><?php the_author_meta( 'medicines', $user_id ); ?></textarea></td>
            			</tr>

						<tr class="form-textarea">
			                <th><label for="day_menu">Опишите свое меню за день</label></th>
			                <td><textarea name="day_menu" id="day_menu" rows="5" cols="1"><?php the_author_meta( 'day_menu', $user_id ); ?></textarea></td>
            			</tr>

						<tr class="form-textarea">
			                <th><label for="bad_food_for_you">Есть ли пищевая аллергия или непереносимость?</label></th>
			                <td><textarea name="bad_food_for_you" id="bad_food_for_you" rows="5" cols="1"><?php the_author_meta( 'bad_food_for_you', $user_id ); ?></textarea></td>
            			</tr>
            
						<tr class="form-textarea">
			                <th><label for="milk_food">Как относитесь к молочным продуктам?</label></th>
			                <td><textarea name="milk_food" id="milk_food" rows="5" cols="1"><?php the_author_meta( 'milk_food', $user_id ); ?></textarea></td>
            			</tr>
        			</table>
					
					<h1 class="mobile-form-header"><i class="fa fa-rocket" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Тренировки</h1>
					<table class="lk-table-workout">
	
	
						<tr class="form-textarea">
			                <th><label for="diet">Какие диеты у вас были до сегодняшнего дня?</label></th>
			                <td><textarea name="diet" id="diet" rows="5" cols="1"><?php the_author_meta( 'diet', $user_id ); ?></textarea></td>
            			</tr>
            
						<tr class="form-textarea">
							<th><label for="cardio">Есть ли дома кардиотренажер?</label></th>
							<td><textarea name="cardio" id="cardio" rows="5" cols="1"><?php the_author_meta( 'cardio', $user_id ); ?></textarea></td>
						</tr>

						<tr class="form-textarea">
			                <th><label for="workout_experience">Опыт тренировок</label></th>
			                <td><textarea name="workout_experience" id="workout_experience" rows="5" cols="1"><?php the_author_meta( 'workout_experience', $user_id ); ?></textarea></td>
            			</tr>
            
						<tr class="form-textarea">
			                <th><label for="sport_last_time">Когда занимались спортом последний раз?</label></th>
			                <td><textarea name="sport_last_time" id="sport_last_time" rows="5" cols="1"><?php the_author_meta( 'sport_last_time', $user_id ); ?></textarea></td>
            			</tr>
			
						<tr class="form-textarea">
							<th></th>
							<td><div class="lk_form_hidden_block"></div></td>
						</tr>
			
						<tr class="form-textarea">
							<th></th>
							<td><div class="lk_form_hidden_block"></div></td>
						</tr>
        			</table>
        	</div>
        	
        	<div class="lk-menu-buy" style="<?php echo $lk_menu_buy_div_flag ?>">		
					<?php
						
						echo '
						
						<table class="lk-table-men" style="'.$lk_table_men_menu_flag.'">
							<tr>
								<td colspan="3"><div style="border-top: 2px solid #fec300; height: 30px;"></div></td>
							</tr>
							
							<tr>
								<td colspan="3"><h1><i class="fa fa-mars" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Параметры для покупки мужского меню</h1></td>
							</tr>';
					?>
			
							<tr class="form-age">
		                        <th><label for="men_menu_age">Возраст мужчины, полных лет</label></th>
		                        <td><input class="text-input" name="men_menu_age" type="number" id="men_menu_age" style="width: 100%;" value="<?php the_author_meta( "men_menu_age", $user_id ) ?>" /></td>
		     
		                    </tr>              
		                    
		                    <tr class="form-height">
		                        <th><label for="men_menu_height">Рост мужчины, до 1см</label></th>
		                        <td><input class="text-input" name="men_menu_height" type="number" id="men_menu_height" style="width: 100%;" value="<?php the_author_meta( "men_menu_height", $user_id ) ?>" /></td>
		                 
		                    </tr>
		                    
		                     <tr class="form-weight-at-start">
		                        <th><label for="men_menu_weight_at_start">Текущий вес мужчины, до 0,1кг</label></th>
		                        <td><input class="text-input" name="men_menu_weight_at_start" type="number" id="men_menu_weight_at_start" step="0.1" style="width: 100%;" value="<?php the_author_meta( "men_menu_weight_at_start", $user_id ) ?>" /></td>			
		                    </tr>
                    
		                    <tr id="daily-activity-row">
		                    	<th><label for="men_menu_daily_activity">Выберите активность мужчины</label></th>                                     
		                        <td>
			            <?php    
			                       	$men_menu_daily_activity_value = get_user_meta( $user_id, 'men_menu_daily_activity', true);
			                       		if (empty($men_menu_daily_activity_value)) { $selected_x1 = 'selected="selected"'; };
								        if ($men_menu_daily_activity_value == '1.25') { $selected_x2 = 'selected="selected"'; };
										if ($men_menu_daily_activity_value == '1.3') { $selected_x3 = 'selected="selected"'; };
										if ($men_menu_daily_activity_value == '1.35') { $selected_x4 = 'selected="selected"'; };
										if ($men_menu_daily_activity_value == '1.375') { $selected_x5 = 'selected="selected"'; };
										if ($men_menu_daily_activity_value == '1.4') { $selected_x6 = 'selected="selected"'; };
										if ($men_menu_daily_activity_value == '1.45') { $selected_x7 = 'selected="selected"'; };
		
								        echo '<select name="men_menu_daily_activity" style="background-color: #fafafa; width: 100%;" id="men_menu_daily_activity">';
								        	echo '<option '.$selected_x1.' class="select-width" disabled hidden>Активность?</option>';
					                    	echo '<option '.$selected_x2.' class="select-width" value="1.25">Нет активности (офисная/сидячая работа, езда на транспорте) либо прогулки не менее часа</option>';
											echo '<option '.$selected_x3.' class="select-width" value="1.3">2-3 тренировки в неделю низкой интенсивности  (танцы, пилатес, домашние тренировки, бассейн)</option>';
											echo '<option '.$selected_x4.' class="select-width" value="1.35">2-3 тренировки в неделю средней интенсивности, фитнес, силовые, групповые интенсивные</option>';
											echo '<option '.$selected_x5.' class="select-width" value="1.375">Стабильно интенсивные от 3-х тренировок (50 мин) в неделю/силовые/фитнес</option>';
											echo '<option '.$selected_x6.' class="select-width" value="1.4">4-5 тренировки в неделю высокой интенсивности</option>';
											echo '<option '.$selected_x7.' class="select-width" value="1.45">5 и более интенсивных тренировок в неделю</option>';
										echo '</select>'; 
			                       
		                    echo '</td>
		                    </tr>
		                ';
		                ?>    
		                    <tr class="form-textarea">
					                <th><label for="men_menu_health_problems">Есть ли проблемы со здоровьем?</label></th>
					                <td><textarea name="men_menu_health_problems" id="men_menu_health_problems" rows="5" cols="1"><?php the_author_meta( 'men_menu_health_problems', $user_id ) ?></textarea></td>
		            		</tr>
		            		
		            		<tr class="form-textarea">
					                <th><label for="men_menu_diet">Какие диеты у вас были до сегодняшнего дня?</label></th>
					                <td><textarea name="men_menu_diet" id="men_menu_diet" rows="5" cols="1"><?php the_author_meta( 'men_menu_diet', $user_id ) ?></textarea></td>
		            		</tr>
		            		
		            		<tr class="form-textarea">
					                <th><label for="men_menu_workout">Есть ли физическая активность, тренировки? Какие и как часто?</label></th>
					                <td><textarea name="men_menu_workout" id="men_menu_workout" rows="5" cols="1"><?php the_author_meta( 'men_menu_workout', $user_id ) ?></textarea></td>
		            		</tr>
            
							<tr class="form-textarea">
				                <th><label for="men_menu_what_result">Какой результат хотите достичь?</label></th>
				                <td><textarea name="men_menu_what_result" id="men_menu_what_result" rows="5" cols="1"><?php the_author_meta( 'men_menu_what_result', $user_id ) ?></textarea></td>
					
	            			</tr>
                    		  	
						</table>
					<?php
				

						echo '
						
						<table class="lk-table-women" style="'.$lk_table_women_menu_flag.'">
							<tr>
								<td colspan="3"><div style="border-top: 2px solid #fec300; height: 30px;"></div></td>
							</tr>
							
							<tr>
								<td colspan="3"><h1><i class="fa fa-venus" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Параметры для покупки женского меню</h1></td>
							</tr>';
					?>
			
							<tr class="form-age">
		                        <th><label for="women_menu_age">Возраст женщины, полных лет</label></th>
		                        <td><input class="text-input" name="women_menu_age" type="number" id="women_menu_age" style="width: 100%;" value="<?php the_author_meta( "women_menu_age", $user_id ) ?>" /></td>
		     
		                    </tr>              
		                    
		                    <tr class="form-height">
		                        <th><label for="women_menu_height">Рост женщины, до 1см</label></th>
		                        <td><input class="text-input" name="women_menu_height" type="number" id="women_menu_height" style="width: 100%;" value="<?php the_author_meta( "women_menu_height", $user_id ) ?>" /></td>
		                 
		                    </tr>
		                    
		                     <tr class="form-weight-at-start">
		                        <th><label for="men_menu_weight_at_start">Текущий вес женщины, до 0,1кг</label></th>
		                        <td><input class="text-input" name="women_menu_weight_at_start" type="number" id="women_menu_weight_at_start" step="0.1" style="width: 100%;" value="<?php the_author_meta( "women_menu_weight_at_start", $user_id ) ?>" /></td>			
		                    </tr>
                    
		                    <tr id="daily-activity-row">
		                    	<th><label for="women_menu_daily_activity">Выберите активность женщины</label></th>                                     
		                        <td>
			            <?php    
			                       	$women_menu_daily_activity_value = get_user_meta( $user_id, 'women_menu_daily_activity', true);
			                       		if (empty($women_menu_daily_activity_value)) { $selected_y1 = 'selected="selected"'; };
								        if ($women_menu_daily_activity_value == '1.25') { $selected_y2 = 'selected="selected"'; };
										if ($women_menu_daily_activity_value == '1.3') { $selected_y3 = 'selected="selected"'; };
										if ($women_menu_daily_activity_value == '1.35') { $selected_y4 = 'selected="selected"'; };
										if ($women_menu_daily_activity_value == '1.375') { $selected_y5 = 'selected="selected"'; };
										if ($women_menu_daily_activity_value == '1.4') { $selected_y6 = 'selected="selected"'; };
										if ($women_menu_daily_activity_value == '1.45') { $selected_y7 = 'selected="selected"'; };
		
								        echo '<select name="women_menu_daily_activity" style="background-color: #fafafa; width: 100%;" id="women_menu_daily_activity">';
								        	echo '<option '.$selected_y1.' class="select-width" disabled hidden>Активность?</option>';
					                    	echo '<option '.$selected_y2.' class="select-width" value="1.25">Нет активности (офисная/сидячая работа, езда на транспорте) либо прогулки не менее часа</option>';
											echo '<option '.$selected_y3.' class="select-width" value="1.3">2-3 тренировки в неделю низкой интенсивности  (танцы, пилатес, домашние тренировки, бассейн)</option>';
											echo '<option '.$selected_y4.' class="select-width" value="1.35">2-3 тренировки в неделю средней интенсивности, фитнес, силовые, групповые интенсивные</option>';
											echo '<option '.$selected_y5.' class="select-width" value="1.375">Стабильно интенсивные от 3-х тренировок (50 мин) в неделю/силовые/фитнес</option>';
											echo '<option '.$selected_y6.' class="select-width" value="1.4">4-5 тренировки в неделю высокой интенсивности</option>';
											echo '<option '.$selected_y7.' class="select-width" value="1.45">5 и более интенсивных тренировок в неделю</option>';
										echo '</select>'; 
			                       
		                    echo '</td>
		                    </tr>
		                ';
		                ?>  
		                	<tr class="form-breastfeed">
							<th><label for="women_menu_breastfeed">Грудное вскармливание на сегодня</label></th>
								<td>
								<?php 
		                       		$women_menu_breastfeed_value = get_user_meta ( $user_id, 'women_menu_breastfeed', true);
		                       		if (empty($women_menu_breastfeed_value)) { $selected_f1 = 'selected="selected"'; };
							        if ($women_menu_breastfeed_value == 'Да') { $selected_f2 = 'selected="selected"'; };
									if ($women_menu_breastfeed_value == 'Нет') { $selected_f3 = 'selected="selected"'; };
							        echo '<select name="women_menu_breastfeed" id="women_menu_breastfeed">';
							        echo '<option '.$selected_f1.' disabled hidden value="">Да/Нет?</option>'; 
									echo '<option '.$selected_f2.' value="Да">Да</option>'; 
									echo '<option '.$selected_f3.' value="Нет">Нет</option>'; 
									echo '</select>'; 
		                    	?>    
	                        	</td>
                    		</tr>
		                  
		                    <tr class="form-textarea">
					                <th><label for="women_menu_health_problems">Есть ли проблемы со здоровьем?</label></th>
					                <td><textarea name="women_menu_health_problems" id="women_menu_health_problems" rows="5" cols="1"><?php the_author_meta( 'women_menu_health_problems', $user_id ) ?></textarea></td>
		            		</tr>
		            		
		            		<tr class="form-textarea">
					                <th><label for="women_menu_diet">Какие диеты у вас были до сегодняшнего дня?</label></th>
					                <td><textarea name="women_menu_diet" id="women_menu_diet" rows="5" cols="1"><?php the_author_meta( 'women_menu_diet', $user_id ) ?></textarea></td>
		            		</tr>
		            		
		            		<tr class="form-textarea">
					                <th><label for="women_menu_workout">Есть ли физическая активность, тренировки? Какие и как часто?</label></th>
					                <td><textarea name="women_menu_workout" id="women_menu_workout" rows="5" cols="1"><?php the_author_meta( 'women_menu_workout', $user_id ) ?></textarea></td>
		            		</tr>
            
							<tr class="form-textarea">
				                <th><label for="men_menu_what_result">Какой результат хотите достичь?</label></th>
				                <td><textarea name="women_menu_what_result" id="women_menu_what_result" rows="5" cols="1"><?php the_author_meta( 'women_menu_what_result', $user_id ) ?></textarea></td>
					
	            			</tr>
                    		  	
						</table>

        	</div>
					
					<div class="submit_button_block">
					<input type="hidden" name="action" value="updateUserForm"/>
					<input type="submit" id="updateuser" class="submit button" value="Обновить анкету">
					<p style="width: 700px; text-align: center; margin-left: -25px;">Нажимая на кнопку, вы даете согласие на обработку своих персональных данных и соглашаетесь с <a href="http://maraphon.online/privacy-policy/" target="_blank">политикой конфиденциальности</a></p>
					</div>
				</form>
				
				<div class="alarm_message_block">
				<div id="success_form">Анкета обновлена<br>Дальнейшие инструкции вы получите от администратора марафона в Whatsapp.</div>
				<div id="fail_form">Поля имя, фамилия, телефон и e-mail обязательны для заполнения</div>
				</div>
				
				<div style="height: 25px;"></div>
			
			<script type="text/javascript">
						
					jQuery('#userForm').submit(ajaxSubmitForm);
					function ajaxSubmitForm(){
					
					var userForm = jQuery(this).serialize();
					var first_name = $('input[name="first-name"]').val();
					var last_name = $('input[name="last-name"]').val();
					var telephone = $('input[name="telephone"]').val();
					var email = $('input[name="email"]').val();
						$.ajaxSetup({cache: false});
						if ( first_name && last_name && telephone && email ) {	
								$.ajax({
									type:"POST",
									url: "/wp-admin/admin-ajax.php",
									data: userForm,
									success:function(data){
									$("#success_form").show();
									setTimeout(function(){$('#success_form').fadeOut('slow')},6000);
									}
								});
								} else {
									$("#fail_form").show();
									setTimeout(function(){$('#fail_form').fadeOut('slow')},6000);
								}
						
					return false;
					}
					</script>           
			</div> <!-- ЛИЧНЫЕ ДАННЫЕ -->

		</div> <!-- lk-content -->
		
		<?php endif; ?>	<!-- ОКОНЧАНИЕ ПРОВЕРКИ НА АВТОРИЗАЦИЮ -->
		
	</main> <!-- #main -->
<?php
get_footer();