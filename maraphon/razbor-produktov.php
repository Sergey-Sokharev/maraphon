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
		
		
		
	@media screen and (max-width:1279px){
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
			background-image: url(/wp-content/uploads/razbor_background.jpg);
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
		.razbor_main_page {
			margin: auto;
			height: auto;
			background-color: white;
			padding-top: 60px;
			padding-right: 30px;
			width: 720px;
			background-image: url(/wp-content/uploads/razbor_background.jpg);
		}
		.razbor_main_page_content {
			padding-left: 40px;
		}
		.h1_razbor_main_page {
			font-family: kelson;
			text-align: center;
			font-size: 48px;
		}
		.h2_razbor_main_page {
			visibility: hidden;
		}
		
		#ajaxsearchpro1_1 {
			width: 640px;
			margin-left: 0px;
			font-size: 44px;
		}
		#wpdreams_asp_results_1 {
			width: 680px;
			margin-left: -20px;
		}
		
		}
		
	@media screen and (min-width:1279px){  
		#primary {
			margin: auto;
			margin-top: 70px;
			margin-bottom: -20px;
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
	    
	    .asp_main_container {
		    margin-top: -85px !important;
			width: 522px !important;
		}
		
		/*.probox {
			height: 32px !important;
		}
		
		.orig {
			font-size: 24px !important;
			height: 32px !important;
		}
		
		.proinput form input {
			font-size: 24px !important;
		}
		
		.autocomplete {
			font-size: 24px !important;
		}
		
		.innericon {
			width: 32px !important;
			height: 32px !important;
		} 
		
		.promagnifier {
			width: 32px !important;
			height: 32px !important;
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
		.razbor_main_page {
			height: auto;
			background-color: white;
			padding-top: 60px;
			padding-left: 30px;
			padding-right: 30px;
			background-image: url(/wp-content/uploads/razbor_background.jpg);
	
		}
		.h1_razbor_main_page {
			text-align: center;
			font-size: 48px;
			margin-top: 20px;
			font-family: kelson;
		}
		.h2_razbor_main_page {
			margin-top: -10px;
			margin-bottom: 30px;
			font-size: 32px;
			font-family: kelson;
		}
		
		}
	</style>

	<div class="razbor_main_page">
		<?php 
		global $wpdb;
		$user = wp_get_current_user();
		$user_id = $user->ID;		
		
		
		if ( (!is_user_role('administrator', $user->ID)) && ($user_id != '272')) : ?> <!-- Начало условия проверки роли пользователя для просмотра контента--> 
	        <p class="warning">
	            <?php 
		        $enter_link_message = '<div style="height: 500px; background-color: white; text-align: center; margin-top: 250px;"><p style="padding-left: 20px; font-size: 36px;"><a href="http://maraphon.online/wp-login.php?">Войдите</a> под учетной записью администратора, чтобы просматривать данные</p></div>';
		        _e($enter_link_message, 'profile'); 
		        ?>
	        </p>
		<?php else : ?>  
	
		<h1 class="h1_razbor_main_page">Разбор продуктов<h1>
		<div class="razbor_main_page_content">
			<h2 class="h2_razbor_main_page">Оглавление</h2>
			<?php echo do_shortcode('[wpdreams_ajaxsearchpro id=1]'); ?>
			<?php echo do_shortcode('[wpdreams_ajaxsearchpro_results id=1 element="div"]'); ?>
			<?php echo do_shortcode("[pt_view id=cb8dfbckde]"); ?>
		</div>
		
		<?php endif; ?>	<!-- Окончание условия проверки роли пользователя для просмотра контента--> 	
	</div>		
		
</div>	<!-- page -->
<?php
get_footer();
