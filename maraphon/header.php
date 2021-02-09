<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package maraphon
 */

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
	global $wpdb, $check_any_workout_to_buy, $check_women_menu_to_buy, $check_men_menu_to_buy;
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
?>
<div id="page" class="site page">
	<header id="masthead" class="site-header">

	<a href="https://instagram.com/voitenko_catsss" target="_blank" class="instagram_logo"><img src="<?php echo content_url() ?>/uploads/instagram-icon-60x60-1.png"/></a>
        <a href="https://api.whatsapp.com/send?phone=79528986463" target="_blank" class="whatsapp_logo"><img src="<?php echo content_url() ?>/uploads/whatsapp-icon-60x60-1.png"/></a>	
       	<a href="/"><img class="logo" src="<?php echo content_url() ?>/uploads/logo-png-125x160-1.png"></a>
	   		   	
	<a href="
        <?php
	        $current_user = wp_get_current_user();
	        if ( 	(
	                (is_user_logged_in()) 
		            && 
			        (is_user_role('notconfirm', $current_user->ID))
				    ) 
	          	&& 
		            ( 
			        get_the_author_meta( 'men_menu_lk', $current_user->ID ) == 'men_menu' ||
	            	get_the_author_meta( 'men_menu_lk', $current_user->ID ) == 'men_menu_1800' || 
					get_the_author_meta( 'men_menu_lk', $current_user->ID ) == 'men_menu_2000' || 
					get_the_author_meta( 'men_menu_lk', $current_user->ID ) == 'men_menu_2200' || 
					get_the_author_meta( 'men_menu_lk', $current_user->ID ) == 'men_menu_2500'
				    )
				) {
                  echo '/lk/#tab5';
				  } else if (is_user_logged_in() && (is_user_role('maraphon_1200', $user->ID) || is_user_role('maraphon_1400', $user->ID) || is_user_role('maraphon_1600', $user->ID) || is_user_role('maraphon_1800', $user->ID) || is_user_role('maraphon_2000', $user->ID) || is_user_role('maraphon_2200', $user->ID) || is_user_role('administrator', $user->ID) || is_user_role('content_1', $user->ID))) {
	              echo '/lk';
		          } else if ( is_user_logged_in() && is_user_role('notconfirm', $user->ID)) {
	              echo 'http://maraphon.online/lk#tab5';
	              } else {
			      echo '/wp-login.php?'; 
            };    
        ?>
       " class="lk">
        &nbsp;&nbsp;
       	<?php
	       	 
            if ( is_user_logged_in() ) {
	            if (!empty(wp_get_current_user()->first_name) || !empty(wp_get_current_user()->last_name)) {
		            echo wp_get_current_user()->first_name . "\n";
					echo wp_get_current_user()->last_name;
	            } else {
		          	echo wp_get_current_user()->user_login;  
	            }
            } else {
            echo 'Войти';
            }
        ?>
        &nbsp;&nbsp;</a>
             
       <div class="opacity-line">
       </div>

    <div class="nav">
        <span id="trigger" class="trigger">
          <i></i>
          <i></i>
          <i></i>
        </span>
        
      <ul id="menu" class="menu">
	      
	    <style>
		    .show_menu {
			    display: flex !important;
		    }
		    
		    .hide_menu {
			    display: none !important;
			}
		</style>
	      
	    <?php
		if (is_user_logged_in() && (is_user_role('administrator', $user->ID) || is_user_role('content_1', $user->ID))) {  
		//Магазин
		echo '<li class="first_level show_menu"><a href="/shop/"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ИНТЕРНЕТ-МАГАЗИН</a></li>';
		echo '<li class="first_level show_menu" id="mobile_menu_workout"><a href="/lk#tab4"><i class="fa fa-rocket" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОИ ТРЕНИРОВКИ</a></li>';	
		echo '<li class="first_level show_menu" id="mobile_menu_men_menu"><a href="/lk#tab3"><i class="fa fa-file-text" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МУЖСКОЕ МЕНЮ</a></li>';
		echo '<li class="first_level show_menu" id="mobile_menu_women_menu"><a href="/lk#tab2"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ЖЕНСКОЕ МЕНЮ</a></li>';
		echo '<li class="first_level show_menu"><a href="/razbor-produktov/"><i class="fa fa-balance-scale" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;РАЗБОР ПРОДУКТОВ</a></li>';	
		echo '<li class="first_level show_menu" id="mobile_menu_report"><a href="/lk/"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ЕЖЕДНЕВНЫЙ ОТЧЕТ</a></li>';
		echo '<li class="first_level show_menu"><a href="/director-cabinet/"><i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;УПРАВЛЕНИЕ МАРАФОНОМ</a></li>';
		echo '<li class="first_level show_menu"><a id="second_menu_level">&nbsp;&nbsp;&nbsp;ДАЛЕЕ&nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a></li>';	
		echo '<li class="second_level hide_menu"><a id="first_menu_level"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;НАЗАД</a></li>';
		echo '<li class="second_level hide_menu"><a href="/manual-home/"><i class="fa fa-graduation-cap" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ПРАВИЛА МАРАФОНА</a></li>';
		echo '<li class="second_level hide_menu"><a href="/blog/"><i class="fa fa-ravelry" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;БЛОГ</a></li>';
		echo '<li class="second_level hide_menu"><a href="/kbju/"><i class="fa fa-calculator" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;СЧЕТЧИК КАЛОРИЙ</a></li>';
		echo '<li class="second_level hide_menu"><a href="/lk#tab6"><i class="fa fa-address-card-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОЯ АНКЕТА</a></li>';
		echo '<li class="second_level hide_menu"><a href="/lk#tab5"><i class="fa fa-trophy" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОИ ЗАМЕРЫ</a></li>';
		echo '<li class="second_level hide_menu"><a href="/feedback/"><i class="fa fa-comments-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ОТЗЫВЫ</a></li>';
		echo '<li class="second_level hide_menu"><a href="'.wp_logout_url('/').'"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ВЫХОД</a></li>';
		
		echo '
		<script type="text/javascript">
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
		';
		          
		    
		} else if (
		        is_user_logged_in() 
		        && (
			    get_the_author_meta( 'men_menu_lk', $current_user->ID ) == 'men_menu_1600' ||
	            get_the_author_meta( 'men_menu_lk', $current_user->ID ) == 'men_menu_1800' || 
				get_the_author_meta( 'men_menu_lk', $current_user->ID ) == 'men_menu_2000' || 
				get_the_author_meta( 'men_menu_lk', $current_user->ID ) == 'men_menu_2200' || 
				get_the_author_meta( 'men_menu_lk', $current_user->ID ) == 'men_menu_2500' 
				)
	        ) {
		//Магазин
		echo '<li><a href="/shop/"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ИНТЕРНЕТ-МАГАЗИН</a></li>';       
		         
		//Войти - Моя анкета
		echo '<li id="menu_form_1"><a href="';   
            if ( is_user_logged_in() && (is_user_role('maraphon_1200', $user->ID) || is_user_role('maraphon_1400', $user->ID) || is_user_role('maraphon_1600', $user->ID) || is_user_role('maraphon_1800', $user->ID) || is_user_role('maraphon_2000', $user->ID) || is_user_role('maraphon_2200', $user->ID) || is_user_role('administrator', $user->ID) || is_user_role('notconfirm', $user->ID)) ) 
	        {
               echo '/lk#tab6';
            } else 
            {
            	echo '/wp-admin';
            }

	    echo '">';

            if ( is_user_logged_in() ) {
                echo '<i class="fa fa-address-card-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОЯ АНКЕТА';
            }
            else {
            echo '<i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ВОЙТИ';
            }
	    echo '</a></li>';
	    
	    //Мои замеры 
	    echo '<li><a href="/lk#tab5"><i class="fa fa-trophy" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОИ ЗАМЕРЫ</a></li>';
	    
	    //Пример тренировок - Мои тренировки   
        echo '<li><a href="';
            if ( is_user_logged_in() && (is_user_role('maraphon_1200', $user->ID) || is_user_role('maraphon_1400', $user->ID) || is_user_role('maraphon_1600', $user->ID) || is_user_role('maraphon_1800', $user->ID) || is_user_role('maraphon_2000', $user->ID) || is_user_role('maraphon_2200', $user->ID) || is_user_role('administrator', $user->ID) || $check_any_workout_to_buy > 0 ) ) 
	        {
               echo '/lk#tab4';
            }
            else {
            echo '/workout-example/';
            }
		echo '">';
            if ( is_user_logged_in() && (is_user_role('maraphon_1200', $user->ID) || is_user_role('maraphon_1400', $user->ID) || is_user_role('maraphon_1600', $user->ID) || is_user_role('maraphon_1800', $user->ID) || is_user_role('maraphon_2000', $user->ID) || is_user_role('maraphon_2200', $user->ID) || is_user_role('administrator', $user->ID) || $check_any_workout_to_buy > 0 ) ) 
            {
                echo '<i class="fa fa-rocket" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОИ ТРЕНИРОВКИ';
            }
            else {
            echo '<i class="fa fa-rocket" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ПРИМЕР ТРЕНИРОВОК';
            }
	    echo '</a></li>';
        
        //Мужское меню
        echo '<li><a href="';  
            if ( is_user_logged_in() ) {
               echo '/lk#tab3';
            }
		echo '">';
            if ( is_user_logged_in() ) {
                echo '<i class="fa fa-file-text" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МУЖСКОЕ МЕНЮ';
            }
        echo '</a></li>';
        
        //Мое меню - Пример меню
        echo '<li><a href="';  
            if ( (is_user_logged_in() && (!is_user_role('notconfirm', $user->ID))) || 
            	((is_user_logged_in()) &&
            	(get_the_author_meta( 'women_menu_lk', $current_user->ID ) == 'women_menu_1200' || 
				get_the_author_meta( 'women_menu_lk', $current_user->ID ) == 'women_menu_1400' || 
				get_the_author_meta( 'women_menu_lk', $current_user->ID ) == 'women_menu_1600' || 
				get_the_author_meta( 'women_menu_lk', $current_user->ID ) == 'women_menu_1800' ||
				get_the_author_meta( 'women_menu_lk', $current_user->ID ) == 'women_menu_2000' ||
				get_the_author_meta( 'women_menu_lk', $current_user->ID ) == 'women_menu_2000'))
			) {
               echo '/lk#tab2';
            }
            else {
            echo '/menu-example/';
            }
		echo '">';
            if ( (is_user_logged_in() && (!is_user_role('notconfirm', $user->ID))) || 
            	((is_user_logged_in()) &&
            	(get_the_author_meta( 'women_menu_lk', $current_user->ID ) == 'women_menu_1200' || 
				get_the_author_meta( 'women_menu_lk', $current_user->ID ) == 'women_menu_1400' || 
				get_the_author_meta( 'women_menu_lk', $current_user->ID ) == 'women_menu_1600' || 
				get_the_author_meta( 'women_menu_lk', $current_user->ID ) == 'women_menu_1800' ||
				get_the_author_meta( 'women_menu_lk', $current_user->ID ) == 'women_menu_2000' ||
				get_the_author_meta( 'women_menu_lk', $current_user->ID ) == 'women_menu_2000'))
			) {
                echo '<i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ЖЕНСКОЕ МЕНЮ';
            }
            else {
            echo '<i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ПРИМЕР МЕНЮ';
            }
        echo '</a></li>';
		
		//Счетчик калорий - Ежедневный отчет
	    echo '<li><a href="';
            if ( is_user_logged_in() && (is_user_role('maraphon_1200', $user->ID) || is_user_role('maraphon_1400', $user->ID) || is_user_role('maraphon_1600', $user->ID) || is_user_role('maraphon_1800', $user->ID) || is_user_role('maraphon_2000', $user->ID) || is_user_role('maraphon_2200', $user->ID) || is_user_role('administrator', $user->ID)) ) 
	        {
               echo '/lk';
            }
            else {
            echo '/counter/';
            }
		echo '">';
            if ( is_user_logged_in() && (is_user_role('maraphon_1200', $user->ID) || is_user_role('maraphon_1400', $user->ID) || is_user_role('maraphon_1600', $user->ID) || is_user_role('maraphon_1800', $user->ID) || is_user_role('maraphon_2000', $user->ID) || is_user_role('maraphon_2200', $user->ID) || is_user_role('administrator', $user->ID)) ) 
            {
                echo '<i class="fa fa-calendar-check-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ЕЖЕДНЕВНЫЙ ОТЧЕТ';
            }
            else {
            echo '<i class="fa fa-calculator" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;СЧЕТЧИК КАЛОРИЙ';
            }
	    echo '</a></li>'; 
		
		//Управление марафоном - Выход
	    echo '<li><a href="/director-cabinet/">';
            $user = wp_get_current_user();
			if (is_user_role('administrator', $user->ID)) {
                echo '<i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;УПРАВЛЕНИЕ МАРАФОНОМ';
            }
            else {
            echo 
                '<style>
                    .nav ul :nth-child(9) {display: none};
               </style>';
            }
	    echo '</a></li>';
	        
        echo '<li><a href="/feedback/"><i class="fa fa-comments-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ОТЗЫВЫ</a></li>';
        
        echo '<li style="';
        	if (is_user_logged_in()) {
	        	echo 'display:flex';
	        } else {
		        echo 'display:none';
		    };
		echo '"><a href="';
		echo wp_logout_url('/');
		echo '"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ВЫХОД</a></li>';
		
		if ( is_user_logged_in() ) {
            echo 
            '<style>
          		.nav ul :nth-child(10) {display: none};
                .nav ul :nth-child(11) {display: flex};
            </style>';
            }
            else {
            echo 
            '<style>
              	.nav ul :nth-child(9) {display: none};      
            </style>';
        }

		    
		
		 
		} else {  // начало условия мужского меню нет
			
		//Магазин
		echo '<li><a href="/shop/"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ИНТЕРНЕТ-МАГАЗИН</a></li>';
		//Войти - Моя анкета
		echo '<li id="menu_form_1"><a href="';   
            if ( is_user_logged_in() && (is_user_role('maraphon_1200', $user->ID) || is_user_role('maraphon_1400', $user->ID) || is_user_role('maraphon_1600', $user->ID) || is_user_role('maraphon_1800', $user->ID) || is_user_role('maraphon_2000', $user->ID) || is_user_role('maraphon_2200', $user->ID) || is_user_role('administrator', $user->ID) || is_user_role('notconfirm', $user->ID)) ) 
	        {
               echo '/lk#tab5';
            } else 
            {
            	echo '/wp-admin';
            }

	    echo '">';

            if ( is_user_logged_in() ) {
                echo '<i class="fa fa-address-card-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОЯ АНКЕТА';
            }
            else {
            echo '<i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ВОЙТИ';
            }
	    echo '</a></li>';
	    
	    //Мои замеры
	    //if ( is_user_logged_in() ) {
	    echo '<li><a href="/lk#tab4"><i class="fa fa-trophy" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОИ ЗАМЕРЫ</a></li>';
	    //};
	    
	    //Пример тренировок - Мои тренировки   
        echo '<li><a href="';
            if ( is_user_logged_in() && (is_user_role('maraphon_1200', $user->ID) || is_user_role('maraphon_1400', $user->ID) || is_user_role('maraphon_1600', $user->ID) || is_user_role('maraphon_1800', $user->ID) || is_user_role('maraphon_2000', $user->ID) || is_user_role('maraphon_2200', $user->ID) || is_user_role('administrator', $user->ID) || $check_any_workout_to_buy > 0) ) 
	        {
               echo '/lk#tab3';
            }
            else {
            echo '/workout-example/';
            }
		echo '">';
            if ( is_user_logged_in() && (is_user_role('maraphon_1200', $user->ID) || is_user_role('maraphon_1400', $user->ID) || is_user_role('maraphon_1600', $user->ID) || is_user_role('maraphon_1800', $user->ID) || is_user_role('maraphon_2000', $user->ID) || is_user_role('maraphon_2200', $user->ID) || is_user_role('administrator', $user->ID) || $check_any_workout_to_buy > 0) ) 
            {
                echo '<i class="fa fa-rocket" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОИ ТРЕНИРОВКИ'; 
            }
            else {
            echo '<i class="fa fa-rocket" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ПРИМЕР ТРЕНИРОВОК';
            }
	    echo '</a></li>';
	    
	    //Мое меню - Пример меню
        echo '<li><a href="';  
            if ( is_user_logged_in()
            	&& 
            	((!is_user_role('notconfirm', $user->ID)) ||
            	get_the_author_meta( 'women_menu_lk', $current_user->ID ) == 'women_menu_1200' || 
				get_the_author_meta( 'women_menu_lk', $current_user->ID ) == 'women_menu_1400' || 
				get_the_author_meta( 'women_menu_lk', $current_user->ID ) == 'women_menu_1600' || 
				get_the_author_meta( 'women_menu_lk', $current_user->ID ) == 'women_menu_1800' ||
				get_the_author_meta( 'women_menu_lk', $current_user->ID ) == 'women_menu_2000' ||
				get_the_author_meta( 'women_menu_lk', $current_user->ID ) == 'women_menu_2000'
            	) ) {
               echo '/lk#tab2';
            }
            else {
            echo '/menu-example/';
            }
		echo '">';
            if ( is_user_logged_in()
            	&& 
            	((!is_user_role('notconfirm', $user->ID)) ||
            	get_the_author_meta( 'women_menu_lk', $current_user->ID ) == 'women_menu_1200' || 
				get_the_author_meta( 'women_menu_lk', $current_user->ID ) == 'women_menu_1400' || 
				get_the_author_meta( 'women_menu_lk', $current_user->ID ) == 'women_menu_1600' || 
				get_the_author_meta( 'women_menu_lk', $current_user->ID ) == 'women_menu_1800' ||
				get_the_author_meta( 'women_menu_lk', $current_user->ID ) == 'women_menu_2000' ||
				get_the_author_meta( 'women_menu_lk', $current_user->ID ) == 'women_menu_2000'
            	) ) {
                echo '<i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;МОЕ МЕНЮ';
            }
            else {
            echo '<i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ПРИМЕР МЕНЮ';
            }
        echo '</a></li>';
		
		//Счетчик калорий - Ежедневный отчет
	    echo '<li><a href="';
            if ( is_user_logged_in() && (is_user_role('maraphon_1200', $user->ID) || is_user_role('maraphon_1400', $user->ID) || is_user_role('maraphon_1600', $user->ID) || is_user_role('maraphon_1800', $user->ID) || is_user_role('maraphon_2000', $user->ID) || is_user_role('maraphon_2200', $user->ID) || is_user_role('administrator', $user->ID)) ) 
	        {
               echo '/lk';
            }
            else {
            echo '/counter/';
            }
		echo '">';
            if ( is_user_logged_in() && (is_user_role('maraphon_1200', $user->ID) || is_user_role('maraphon_1400', $user->ID) || is_user_role('maraphon_1600', $user->ID) || is_user_role('maraphon_1800', $user->ID) || is_user_role('maraphon_2000', $user->ID) || is_user_role('maraphon_2200', $user->ID) || is_user_role('administrator', $user->ID)) ) 
            {
                echo '<i class="fa fa-calendar-check-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ЕЖЕДНЕВНЫЙ ОТЧЕТ';
            }
            else {
            echo '<i class="fa fa-calculator" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;СЧЕТЧИК КАЛОРИЙ';
            }
	    echo '</a></li>';
		
		//Управление марафоном - Выход
	    echo '<li><a href="/director-cabinet/">';
            $user = wp_get_current_user();
			if (is_user_role('administrator', $user->ID)) {
                echo 'УПРАВЛЕНИЕ МАРАФОНОМ';
            }
            else {
            echo 
                '<style>
                    .nav ul :nth-child(8) {display: none};
               </style>';
            }
	    echo '</a></li>';
	        
        echo '<li><a href="/feedback/"><i class="fa fa-comments-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ОТЗЫВЫ</a></li>';
        
        echo '<li style="';
        	if (is_user_logged_in()) {
	        	echo 'display:flex';
	        } else {
		        echo 'display:none';
		    };
		echo '"><a href="';
		echo wp_logout_url('/');
		echo '"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ВЫХОД</a></li>';
		
		if ( is_user_logged_in() ) {
            echo 
            '<style>
          		.nav ul :nth-child(9) {display: none};
                .nav ul :nth-child(10) {display: flex};
            </style>';
            }
            else {
            echo 
            '<style>
              	.nav ul :nth-child(8) {display: none};      
            </style>';
        }
		
		}; // конец условия по мужскому меню
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
	            get_the_author_meta( 'men_menu_lk', $current_user->ID ) == 'men_menu_1800' || 
		    get_the_author_meta( 'men_menu_lk', $current_user->ID ) == 'men_menu_2000' || 
		    get_the_author_meta( 'men_menu_lk', $current_user->ID ) == 'men_menu_2200' || 
		    get_the_author_meta( 'men_menu_lk', $current_user->ID ) == 'men_menu_2500' || 
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
	        	echo '<li><a href="/blog/">АВТОРСКИЙ БЛОГ</a></li>';   
            } else {
	            echo '<li><a href="/counter/">СЧЕТЧИК КАЛОРИЙ</a></li>';
            };
            
   	        echo '<li><a href="/shop/">МАГАЗИН</a></li>';   
			?>
            
      </ul>
      </div>
      
      <script>
          document.getElementById("trigger").onclick = function() {open()};
          function open(){document.getElementById("menu").classList.toggle("show");
	      //$(".menu").addClass("show");
		  $(".second_level").filter(".show_menu").removeClass("show_menu");
		  $(".second_level").addClass("hide_menu");
		  $(".first_level").filter(".hide_menu").removeClass("hide_menu");
		  $(".first_level").addClass("show_menu");     
          }
      </script>
    </header><!-- #masthead -->