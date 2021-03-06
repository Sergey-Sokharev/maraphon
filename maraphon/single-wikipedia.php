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
		.wiki_page {
			height: 1200px;
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
		
		.wiki_page {
			padding-top: 20px;
		}
		</style>
		
		
		<div class="wiki_page">
		<?php
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content', get_post_type() );
		endwhile; // End of the loop.
		?>
		
		<?php
		$url_rules = substr($_SERVER['REQUEST_URI'], -5);			//rules
		if ($url_rules != 'rules') {
		echo '<a href="/wikipedia" class="back_to_personal_menu">← Назад к оглавлению </a>';
		};
		?>
		
		<?php //endif; ?>	<!-- Окончание условия проверки роли пользователя для просмотра контента--> 
		</div>	

	</main><!-- #main -->

<?php
get_footer();
