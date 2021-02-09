<?php
/*
Template Name: razbor-produktov
*/
get_header();
?>		
	
	<style>
		
		.cvplbd {
			font-family: kelson;
		}
		
	@media screen and (max-width:1279px){  /*мобайл*/
        #primary {
			width: 720px;
			margin: auto;
			margin-top: 65px;
			background-color: white;
			padding-left: 30px;
			padding-right: 30px;
			padding-bottom: 30px;
			padding-top: 20px;
			margin-bottom: -23px;
		}
	    .opacity-line {
		    position: absolute;
		    height: 65px;
		    width: 720px;
		    background-color: #717171;
		    display: block !important;
		    margin-top: 90px;
		    z-index: 9;
		}
		.e-letter {
			position: absolute;
			font-size: 22px;
			font-weight: 500;
			font-family: kelson;
			color: #252525;
			margin-top: -78px;
			margin-left: 184px;	
		}
		 .asp_main_container {
		    margin-top: -22px !important;
		}
		.back_to_personal_menu {
			text-decoration: none;
			font-size: 36px;
			color: #fec300 !important;
			margin-bottom: 20px;
			font-family: kelson;	
		}
		.back_to_personal_menu:hover {
			color: black !important;	
		}
		.manual_main_page {
			margin: auto;
			height: auto;
			background-color: white;
			padding-top: 60px;
			width: 720px;
		}
		.manual_main_page_content {
			padding-left: 40px;
			padding-right: 40px;
		}
		.manual_main_page p {
			font-size: 24px;
			font-weight: 400;
		}
		.h1_manual_main_page {
			font-family: kelson;
			text-align: center;
			font-size: 40px;
			padding-top: 10px;
			padding-bottom: 17px;
		}
		.h2_manual_main_page {
			visibility: hidden;
		}	
		#wpdreams_asp_results_1 {
			width: 640px;
		}
		#ajaxsearchpro1_1 {
			width: 640px;
			margin-left: 0px;
			font-size: 44px;
		}
		#wpdreams_asp_results_1 {
			width: 640px;
		}
		
		}
		
	@media screen and (min-width:1279px){  /*десктоп*/
		#primary {
			margin: auto;
			margin-top: 70px;
			background-color: white;
			padding-left: 70px;
			padding-bottom: 40px;
			padding-right: 70px;
	    }
	    #page {
		    margin-bottom: -20px !important;
	    }
		.opacity-line {
	        position: absolute;
	        height: 70px;
	        width: 1280px;
	        margin-top: 90px;
	        z-index: 998;
	    }
		.e-letter {
		    display: none;
	    }
	    .asp_main_container {
		    margin-top: -25px !important;
			width: 522px !important;
		}
		/*.probox {
			height: 32px !important;
		}
		
		.promagnifier {
			height: 32px !important;
			width: 32px !important;
		}
		
		.innericon {
			height: 32px !important;
			width: 32px !important;
		}
		
		.orig {
			height: 32px !important;
			font-size: 24px !important;
		}
		
		.autocomplete {
			height: 32px !important;
			font-size: 24px !important;
		} */
		.back_to_personal_menu {
			text-decoration: none;
			font-size: 24px;
			color: #fec300 !important;
			margin-bottom: 20px;
			font-family: kelson;	
		}
		.back_to_personal_menu:hover {
			color: black !important;	
		}
		.manual_main_page {
			height: auto;
			padding-bottom: 10px;
			background-color: white;
			padding-top: 60px;
			width: 1280px
		}
		.manual_main_page_content {
			width: 1200px;
			margin-left: 40px;
		}
		.pt-cv-wrapper {
			margin-left: 2px;
		}
		.pt-cv-title {
			margin-left: 0px;
		}
		.h1_manual_main_page {
			text-align: center;
			font-size: 48px;
			margin-top: 20px;
			font-family: kelson;
		}
		.h2_manual_main_page {
			margin-top: -10px;
			margin-bottom: 30px;
			font-size: 32px;
		}
		.manual_main_page_content {
			font-size: 24px;
			font-weight: 400;
		}

		
		}
	</style>

	<div class="manual_main_page">
		<?php 
		global $wpdb;
		$user = wp_get_current_user();
		if ( !is_user_role('administrator', $user->ID) ) : ?> <!-- Начало условия проверки роли пользователя для просмотра контента--> 
	        <p class="warning">
	            <?php 
		        $enter_link_message = '<div style="height: 500px; background-color: white; text-align: center; margin-top: 250px;"><p style="padding-left: 20px; font-size: 36px;"><a href="http://maraphon.online/wp-login.php?">Войдите</a> под учетной записью администратора, чтобы просматривать данные</p></div>';
		        _e($enter_link_message, 'profile'); 
		        ?>
	        </p>
		<?php else : ?>  
	
		<h1 class="h1_manual_main_page">Правила и инструкции марафона<h1>
		<div class="manual_main_page_content">
			<?php echo do_shortcode('[wpdreams_ajaxsearchpro id=2]'); ?>
			<?php echo do_shortcode('[wpdreams_ajaxsearchpro_results id=2 element="div"]'); ?>
			<?php echo do_shortcode("[pt_view id=944a106gr6]"); ?>
			<span class="e-letter">е</span>
			<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				Наш марафон существует с марта 2019 года. За этот период мы накопили и систематизировали ряд правил и инструкций для участников. На этой странице вы найдете ответы на все ваши самые часто задаваемые вопросы.
			</p>
			<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				Перед стартом марафона вам необходимо полностью ознакомиться со всеми разделами по порядку. В течение марафона, если вы что-то подзабыли, вы можете воспользоваться поиском.
			</p>
		</div>
	
		
		<?php endif; ?>	<!-- Окончание условия проверки роли пользователя для просмотра контента--> 	
	</div>		
		
</div>	<!-- page -->
<?php
get_footer();
