<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package maraphon
 */

get_header();
?>

	<style>
		
		@media screen and (max-width:1279px){
        #primary {
			width: 720px;
			margin: auto;
	
			background-color: white;
			padding-left: 30px;
			padding-right: 30px;
	
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
		
		.asp_main_container {
			margin-top: 60px !important;
			
		}
		
		.page-header {
		    background-color: white;
		    margin-left: -30px;
		    padding-left: 30px;
		    margin-bottom: -20px;
		    text-align: center;
		    height: 60px;
	    }
	    
	    .page-title {
		    margin: auto;
	    }
	    
	    .entry-header {
		    background-color: white;
		    margin-left: -30px;
		    padding-left: 30px;
		    height: auto;
			width: 680px;
			text-align: center;
	    }
	    
	    .entry-title {
		    margin-top: 25px;
		    font-size: 32px;
	    }
	    
	    .wp-post-image {
		    box-shadow: 0 10px 18px -13px #000;
		    margin: auto !important;
	    }
	    
	    .entry-summary {
		    padding-bottom: 20px;
		    font-size: 24px;
	    }
	    
	    .post-edit-link {
		    display: none;
	    }
	    
	    .comments-link {
		    display: none;
	    }
	    
	    .entry-footer {
		   margin-left: -30px;
		   height: 20px;
		   background-color: #252525;
	    }
		
		
		}
		
	@media screen and (min-width:1279px){  
		#primary {
			margin: auto;
			margin-top: 70px;
			margin-bottom: -20px;
			background-color: white;
			padding-left: 70px;
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
	    
	    .asp_main_container {
		    position: absolute;
			margin-top: 85px !important;
			margin-left: 620px !important;
			width: 522px !important;
		}
	    
	    .page-header {
		    background-color: white;
		    margin-left: -70px;
		    padding-left: 70px;
		    margin-bottom: -20px;
		    text-align: center;
	    }
	    
	    .page-title {
		    margin: auto;
	    }
	    
	    .entry-header {
		    background-color: white;
		    margin-left: -70px;
		    padding-left: 70px;
	    }
	    
	    .post-thumbnail img {
		    width: 240px;
		    height: 240px;
	    }
	    
	    .entry-title {
		    margin-top: 25px;
		    font-size: 28px;
	    }
	    
	    .entry-summary {
		    padding: 20px 20px 20px 20px;
		    min-height: 260px;
		    margin-left: 260px;
		    margin-top: -240px;
	    }
	    
	    .conclusion {
		    margin-left: 260px;
		    margin-top: -100px;
	    }
	    
	    .post-edit-link {
		    display: none;
	    }
	    
	    .comments-link {
		    display: none;
	    }
	    
	    .entry-footer {
		   margin-left: -70px;
		   height: 20px;
		   background-color: #252525;
	    }
		}
	</style>

	<main id="primary" class="site-main">
		<br>
		<?php echo do_shortcode('[wpdreams_ajaxsearchpro id=1]'); ?>
		<?php echo do_shortcode('[wpdreams_ajaxsearchpro_results id=1 element="div"]'); ?>
		
		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Результаты поиска для: %s', 'maraphon' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
			</header><!-- .page-header -->
			
			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
				
			
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );
				$conclusions = get_field('razbor_verdikt');
				if ($conclusions) {
					foreach( $conclusions as $conclusion );
				};

				echo '
				
				<script>
				$(".entry-summary").html("<p>Состав: '.get_field("razbor_sostav").'</p><p>Вывод: '.$conclusion.'</p>");
				</script>
				
				';
			endwhile;
		
		
		endif; 
		?>
	</main><!-- #main -->

<?php
//get_sidebar();
get_footer();
