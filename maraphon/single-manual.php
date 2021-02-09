<?php
/**
 * The template for displaying manual posts
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
		.entry-content {
			width: 640px;
		}
		.entry-content h1 {
		    margin-top: -20px;
		    font-family: kelson;
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
		.container span {
			font-size: 36px !important;
		} 
		.container h2 span {
			font-size: 72px !important;
		}
		.container h3 {
			font-size: 36px !important;
		}
		.manual_page {
			height: auto;
			padding-left: 10px;
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
	    .entry-content h1 {
		    margin-top: -20px;
		    font-family: kelson;
	    } 
		.back_to_personal_menu {
			text-decoration: none;
			font-size: 24px;
			color: #fec300 !important;
			margin-bottom: 20px;
			font-family: kelson;
			cursor: pointer;	
		}
		.back_to_personal_menu:hover {
			color: black !important;	
		}
		.manual_page {
			padding-top: 20px;
		}
		
		}
		</style>
		
		
		<div class="manual_page">
		<?php
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content', get_post_type() );
		endwhile; // End of the loop.
		?>
		
		<a onclick="javascript:history.back(); return false;" class="back_to_personal_menu">← Назад</a>
		
		<?php //endif; ?>	<!-- Окончание условия проверки роли пользователя для просмотра контента--> 
		</div>	

	</main><!-- #main -->

<?php
get_footer();
