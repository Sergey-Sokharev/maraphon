<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package maraphon
 */

get_header();
?>

	<main oncontextmenu="return false;" id="primary" class="site-main">
		
	
		
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
	
	.pdfprnt-buttons {
		display: none !important;
	}
		
    @media screen and (max-width:1279px){
        
    #primary {
		width: 720px;
		margin: auto;
		margin-top: 20px;
		background-color: white;
		padding-left: 0px;
		padding-right: 0px;
		padding-bottom: 23px;
		padding-top: 20px;
		margin-bottom: -23px;
		background-color: #252525;
    }
    
    .entry-content {
	 	margin-left: 0px;
	    width: 720px;
    }
    
    .pdfprnt-bottom-right {
	    background-color: white;
		margin-bottom: -24px;
    }
    
    .menu-page-image {
	    border: 1px solid grey;
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
		padding-left: 30px;
		color: #fec300 !important;
		margin-bottom: 10px;
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
		padding-left: 0px;
		padding-bottom: 23px;
		padding-right: 0px;
		background-color: #252525;
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
	
	 .menu-page-image {
	    border: 1px solid grey;
	}
	
	.pdfprnt-bottom-right {
	    background-color: white;
		margin-bottom: -24px;
    }
	
	.back_to_personal_menu {
		text-decoration: none;
		font-size: 24px;
		color: #fec300 !important;
		margin-bottom: -20px;
		padding-left: 30px;
		font-family: kelson;
		cursor: pointer;	
	}
	
	.back_to_personal_menu:hover {
		color: black !important;	
	}

	</style>
	
	<?php
		global $wpdb;
		$current_user = wp_get_current_user();
		$user_id = $current_user->ID;
		$url = substr($_SERVER['REQUEST_URI'], -3);			//men
		$url_fruits = substr($_SERVER['REQUEST_URI'], 1, 6); //fruits
		$check_men_menu_pdf = $wpdb->get_var( 
					"
					SELECT 
						orders.pdf
						FROM wpux_orders orders
						WHERE orders.user_id = $user_id
						AND orders.men_menu !=''
						ORDER BY orders.date DESC limit 1
					"	
					);
		$check_women_menu_pdf = $wpdb->get_var( 
					"
					SELECT 
						orders.pdf
						FROM wpux_orders orders
						WHERE orders.user_id = $user_id
						AND orders.women_menu !=''
						ORDER BY orders.date DESC limit 1
					"	
					);
		
		$check_women_maraphon_pdf = $wpdb->get_var( 
					"
					SELECT 
						orders.pdf
						FROM wpux_orders orders
						WHERE orders.user_id = $user_id
						AND orders.maraphon_next_month != ''
						ORDER BY orders.date DESC limit 1
					"	
					);
		
		if (																																	
			is_user_role('administrator', $user->ID)	
		    ||
		    ($check_men_menu_pdf == 'men_menu_pdf' && ($url == 'men' || $url_fruits == 'fruits'))
			||
			($check_women_menu_pdf == 'women_menu_pdf')
			||
			($check_men_menu_pdf == 'both_menu_pdf' || $check_women_menu_pdf == 'both_menu_pdf')
			||
			($check_women_maraphon_pdf == 'women_menu_pdf')
		   ) 
		   {echo '
			   <style>
			   	.pdfprnt-buttons {
			   	display: block !important;
				}
			/*	.pdfprnt-buttons a img {
				background-image: url(http://maraphon.online/wp-content/plugins/pdf-print/images/pdf.png);
				background-repeat: no-repeat;
				} */
			   </style>
			';
			};
			
	?>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		   
		
		<?php			
		if ( !is_user_logged_in() ) :
	            $enter_link_message = '
	                <div style="height: 700px; background-color: white">
						<p style="text-align: center; padding-top: 250px; font-size: 28px;">
							<a class="lk_enter_a" href="http://maraphon.online/wp-login.php?">Войдите</a>, чтобы просматривать меню
						</p>
					</div>
	            ';
	            _e($enter_link_message, 'profile'); 
		else : 		
			
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
		
		<?php 
		$user = wp_get_current_user();
		$member_men_menu = get_user_meta ( $user->ID, 'men_menu_lk', true);
		echo '<div style="background-color: white; padding-top: 20px;">';
		/* echo '<a onclick="javascript:history.back(); return false;" class="back_to_personal_menu">← Назад</a>'; */
		
		
		if ( (is_user_role('administrator', $user->ID)) || ($member_men_menu == 'men_menu_2000') || ($member_men_menu == 'men_menu_2200') || ($member_men_menu == 'men_menu_2500') ) {
				echo '<a href="/lk#tab2" class="back_to_personal_menu">← Назад к разделу "Женское меню"</a><br><br>';
				echo '<a href="/lk#tab3" class="back_to_personal_menu">← Назад к разделу "Мужское меню"</a>';
			 } else {
				echo '<a href="/lk#tab2" class="back_to_personal_menu">← Назад к разделу "Мое меню"</a><br><br>';
		};
		
		echo '</div>';
		
		endif; //конец условия для просмотра меню	
		?>
		
		

	</main><!-- #main -->
	
	<style>
	@media screen and (max-width:1279px){
	            
	
	.container span {
		font-size: 36px !important;
	} 
	
	.container h2 span {
		font-size: 72px !important;
	}
	
	.container h3 {
		font-size: 36px !important;
	}
	        	
	}
	</style>


<?php
get_footer();
