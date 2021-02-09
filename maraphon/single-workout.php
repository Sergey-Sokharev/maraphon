<?php
/**
 * The template for displaying workout posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package maraphon
 */

get_header();
?>

	<main id="primary" class="site-main">
		
	<style>
		
	.entry-meta {
		display: none;
	}	
	.post-thumbnail {
		display: none;
	}
	.entry-content table {
		box-shadow: 0 0 8px grey;
		border: 0;
	}
	.entry-content table tr {
		border: 0;
	}
	.entry-content table tr:first-child {
		background-color: #f6f6f6;
	}
	.entry-content table td {
		padding-left: 6px;
		padding-right: 6px;
	}
	.entry-content table td:first-child {
		padding: 0 5px 0 5px;
	}
	.entry-footer {
		display: none;
	}
	.entry-header {
		display: none;
		text-align: center;
		width: 660px;
	}	
		
    @media screen and (max-width:1279px){
	        
    #primary {
		width: 720px;
		margin: auto;
		margin-top: 65px;
		background-color: white;
		background-image: url(/wp-content/uploads/background_mobile_1.png);
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
	
	.entry-content {
	    margin-top: 0;
    }
    
    .entry-content table {
	    width: 700px !important;
	    margin-left: -20px;
    }
    
	.entry-content h1 {
		font-family: kelson;
		font-size: 36px;
		margin-top: 22px;
		margin-bottom: 10px;
	}
	
	.entry-content h1:first-child {
		font-family: kelson;
		font-size: 36px;
	}
	
	.entry-content h2 {
		font-family: kelson;
		font-size: 26px;
		padding-bottom: 10px;
	}
	
	.entry-content p {
		margin-bottom: 1em;
	}

	iframe {
		width: 720px;
		margin-left: -30px;
		box-shadow: 0 10px 18px -13px #000;
	}
	.back_to_personal_menu {
		text-decoration: none;
		font-size: 32px;
		color: #fec300 !important;
		margin-bottom: 20px;
		font-family: kelson;	
	}
	
	.back_to_personal_menu:hover {
		color: black !important;	
	}
	
	}
	@media screen and (min-width:1279px){  
	#primary {
		margin: auto;
		margin-top: 70px;
		margin-bottom: -20px;
		background-color: white;
		background-image: url(/wp-content/uploads/shop_background_1.png);
		padding-left: 70px;
		padding-bottom: 40px;
		padding-right: 70px;
    }
	.opacity-line {
        position: absolute;
        height: 70px;
        width: 1280px;
        background-color: #d5d5d5;
        margin-top: 90px;
        z-index: 998;
    }
    
    .entry-content h1 {
		font-family: kelson;
		font-size: 32px;
		margin-top: 25px;
		margin-bottom: 10px;
	}
    
	.entry-content h1:first-child {
		font-family: kelson;
		font-size: 32px;
		padding-top: 30px;
	}
	
	.entry-content h2 {
		font-family: kelson;
		font-size: 26px;
		padding-bottom: 10px;
	}
	.entry-content p {
		margin-bottom: 1em;
	}
	
	.entry-content table {
		margin-bottom: 0;
	}
	
	iframe {
		width: 900px;
		height: 505px;
		/*margin-left: 120px;*/
		box-shadow: 0 10px 18px -13px #000;
	}
	.back_to_personal_menu {
		text-decoration: none;
		font-size: 24px;
		color: #fec300 !important;
		margin-bottom: 10px;
		font-family: kelson;	
	}
	
	.back_to_personal_menu:hover {
		color: black !important;	
	}
	
	}
	
	</style>
		
		<?php
		if ( !is_user_logged_in() ) :
	                        $enter_link_message = '
	                        <div style="height: 700px; background-color: white">
								<p style="text-align: center; padding-top: 250px; font-size: 28px;">
									<a class="lk_enter_a" href="http://maraphon.online/wp-login.php?">Войдите</a>, чтобы просматривать тренировки
								</p>
							</div>
	                        ';
	                        _e($enter_link_message, 'profile'); 
		else : 
			
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

		endwhile; // End of the loop.
		
		$user = wp_get_current_user();
		$member_men_menu = get_user_meta ( $user->ID, 'men_menu_lk', true);
		if ( (is_user_role('administrator', $user->ID)) || ($member_men_menu == 'men_menu_2000') || ($member_men_menu == 'men_menu_2200') || ($member_men_menu == 'men_menu_2500') ) {
				echo '<br><a href="/lk#tab4" class="back_to_personal_menu">← Назад к разделу "Мои тренировки"</a><br><br>';
			 } else {
				echo '<br><a href="/lk#tab3" class="back_to_personal_menu">← Назад к разделу "Мои тренировки"</a><br><br>';
		};
		
		endif; //конец условия для просмотра тренировок	
		?>
		
		

	</main><!-- #main -->
	
<?php
get_footer();
