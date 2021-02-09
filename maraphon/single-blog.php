<?php
/**
 * The template for displaying blog posts
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
		.entry-footer {
			display: none;
		}
		.entry-header {
			display: none;
			text-align: center;
			width: 660px;
		}
		
		.entry-content ul li {
			list-style: disc;
			list-style-type: disc;
		}
		
		.entry-content ol li {
			list-style: decimal;
			list-style-type: decimal;
		}
		.comment-meta {
			width: 300px;
			margin-left: -45px;
			margin-top: 10px;
			background-color: white;
			color: #252525;
		}
		.reply {
			margin-top: -20px;
		}
		#submit {
			background-color: #fec300;
			font-size: 28px;
			padding: 0.5em 1em 0.4em 1em;
			font-family: kelson;
		}
		.logged-in-as {
			display: none;
		}
		.comment-author {
			float: left;
			margin-right: 10px;
		}
		.comment-metadata {
			width: 350px;
		}
		.comment-body {
			border-bottom: 1px solid grey;
		}
		.comment-form-comment label {
			display: none;
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
			height: auto;
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
		.container span {
			font-size: 36px !important;
		} 
		.container h2 span {
			font-size: 72px !important;
		}
		.container h3 {
			font-size: 36px !important;
		}
		.blog_page {
			height: auto;
			padding-left: 10px;
	
		}
		iframe {
			margin-left: 0px !important;
		}
		
		#blog_main_content_a {
			position: absolute;
			margin-top: -73px !important;
			margin-left: 30px !important;
			font-size: 32px;
			z-index: 9 !important;
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
	        background-color: #d5d5d5;
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
		iframe {
			margin-left: 250px;
		}
		
		.blog_page {
			padding-top: 20px;
		}
		#blog_main_content_a {
			position: absolute;
			margin-top: 10px;
			margin-left: 1025px;
		}
		}
		</style>
		
		<a href="/blog/" class="back_to_personal_menu" id="blog_main_content_a">Оглавление</a>
		
		<div class="blog_page">
			
		<?php 
			if ( !is_user_logged_in() && (!is_user_role('maraphon_1200', $user_id) || !is_user_role('maraphon_1400', $user_id) || !is_user_role('maraphon_1600', $user_id) || !is_user_role('maraphon_1800', $user_id) || !is_user_role('maraphon_2000', $user_id) || !is_user_role('maraphon_2200', $user_id) || !is_user_role('administrator', $user_id) || !is_user_role('content_1', $user_id))) :
	                        $enter_link_message = '
	                        <div style="height: 700px; background-color: white">
								<p style="text-align: center; padding-top: 250px; font-size: 28px;">
									<a class="lk_enter_a" href="http://maraphon.online/wp-login.php?">Войдите</a> в аккаунт с оплаченным доступом</p>
							</div>
	                        ';
	                        _e($enter_link_message, 'profile'); 
			else : 
		?>	
		
		<?php
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content', get_post_type() );
			
			if ( comments_open() || get_comments_number() ) {
			comments_template();
			};
		endwhile; // End of the loop.
		?>
		
		<?php
		$url_rules = substr($_SERVER['REQUEST_URI'], -5);			//rules
		if ($url_rules != 'rules') {
		echo '<a href="/blog/" class="back_to_personal_menu">← Назад к оглавлению </a>';
		};
		?>
		
		<?php endif; ?>	<!-- Окончание условия проверки роли пользователя для просмотра контента--> 
		</div>	

	</main><!-- #main -->

<?php
get_footer();
