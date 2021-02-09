<?php
/*
Template Name: privacy-policy
*/
get_header();
?>

	<div style="height: auto; padding-top: 90px; margin-bottom: -23px; background-color: white;">
		
	<style>
		.entry-header {
			background-color: white;
		}
		
        @media screen and (max-width:1279px){

		.entry-title {
			margin-left: auto !important;
		}
		
		.entry-footer {
			display: none;
		}
		}
		@media screen and (min-width:1279px){  

		.entry-title {
			margin: auto !important;
		}
		
		.entry-footer {
			display: none;
		}
		}
		</style>
	
		
		
		
		
		
	
		<?php
			
			
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );
		
			/*the_post_navigation(
				array(
					'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'maraphon' ) . '</span> <span class="nav-title">%title</span>',
					'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'maraphon' ) . '</span> <span class="nav-title">%title</span>',
				)
			);

			 If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif; */

		endwhile; // End of the loop.
		?>
	</div>
	

</main><!-- #main -->

<?php
get_footer();