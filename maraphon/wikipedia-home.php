<?php
/*
Template Name: wikipedia-home
*/
get_header();
?>		

	<style>
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
		
		.wiki_main_page {
			height: 1200px;
			margin: auto;
			background-color: white;
			padding-top: 60px;
			
			padding-right: 30px;
			width: 720px;
		}
		
		.wiki_main_page_content {
			padding-left: 10px;
		}
		
		.h1_wiki_main_page {
			text-align: center;
			font-size: 48px;
		}
		
		.h2_wiki_main_page {
			font-size: 36px;
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
		.opacity-line {
	        position: absolute;
	        height: 70px;
	        width: 1280px;
	        margin-top: 90px;
	        z-index: 998;
	        }
		}
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

		.wiki_main_page {
			height: 1200px;
			background-color: white;
			padding-top: 60px;
			padding-left: 30px;
			padding-right: 30px;
		}
		
		.h1_wiki_main_page {
			text-align: center;
			font-size: 48px;
		}
		
		.h2_wiki_main_page {
			margin-bottom: 30px;
			font-size: 32px;
		}
		
		
	</style>
	
	
	<div class="wiki_main_page">
		<?php if ( !is_user_role('administrator', $user->ID) ) : ?> <!-- Начало условия проверки роли пользователя для просмотра контента--> 
	                    <p class="warning">
	                        <?php 
		                        $enter_link_message = '<p><a href="http://maraphon.online/wp-login.php?">Войдите</a> под учетной записью администратора, чтобы просматривать данные</p>';
		                        _e($enter_link_message, 'profile'); 
		                        ?>
	                    </p>
		<?php else : ?>  
	
	<h1 class="h1_wiki_main_page">Wikipedia красоты и здоровья<h1>
	<div class="wiki_main_page_content">
		<h2 class="h2_wiki_main_page">Оглавление</h2>
		<?php echo do_shortcode("[pt_view id=a9cbc66hix]"); ?>
	</div>
	
	<?php endif; ?>	<!-- Окончание условия проверки роли пользователя для просмотра контента--> 	
	</div>		
		

	
</div>	<!-- page -->
<?php
get_footer();
