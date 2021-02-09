<?php
/*
Template Name: blog
*/
	get_header();
?>
	<style>
		@media screen and (max-width:1279px){
		#primary {
			margin: auto;
			margin-top: 65px;
			width: 720px;
			margin-bottom: -23px;
			background-color: white;
			padding: 1px 20px 30px 20px;
	    }
		.opacity-line {
	        position: absolute;
	        height: 65px;
	        width: 720px;
	        background-color: #717171;
	        margin-top: 90px;
	        z-index: 9;
	    }
	    .blog_main_page {
		    padding-top: 30px;
	    }
	    .blog_author_banner {
		    margin-top: 30px !important;
		    background-color: #fafafa;
		    height: 300px;
		    font-size: 28px;
		    box-shadow: rgba(0, 0, 0, 0.18) 0px 2px 4px;
		    padding-bottom: 30px;
	    }
	    .blog_author_banner p {
		    padding-left: 20px;
		    width: 440px;
		    float: left;
		    text-align: center;
		    padding-top: 60px !important;
	    }
	    .blog_author_banner img {
		    width: 200px;
		    height: 300px;
		    float: right;
	    }
		.my_blog_preview {
			background-color: #fafafa;
			margin-top: 30px;
			box-shadow: rgba(0, 0, 0, 0.18) 0px 2px 4px;
		}
		.my_blog_photo_preview {
			margin-left: 7px;
			margin-top: 85px;
			width: 280px;
			height: 280px;
			float: left;
		}
		.my_blog_text_preview {
			margin-left: 307px;
			width: 390px;
			text-align: center;
			padding-top: 8px;
		}
		.my_blog_text_preview_title {
			font-size: 40px;
			margin-left: -480px;
			width: 640px;
			text-align: center;
			position: absolute;
			font-family: kelson;
		}
		.my_blog_text_preview p {
			font-size: 20px;
			text-align: left;
			padding-right: 50px;
			margin-top: 65px;
			padding-bottom: 10px;
			min-height: 312px;
		}
		.my_blog_text_preview_detailed {
			display: none;
			font-size: 28px;
			color: #fec300;
			position: absolute;
			margin-left: -420px;
			margin-top: -75px;
		}
		.my_blog_text_preview_detailed:hover {
			color: #252525;
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
	        z-index: 9;
	    }
	    .blog_main_page {
		    padding-top: 30px;
	    }
	    .blog_author_banner {
		    background-color: #fafafa;
		    height: 350px;
		    font-size: 32px;
		    box-shadow: rgba(0, 0, 0, 0.18) 0px 2px 4px;
		    padding-bottom: 30px;
	    }
	    .blog_author_banner p {
		    padding-top: 90px;
		    width: 800px;
		    float: left;
		    text-align: center;
	    }
	    .blog_author_banner img {
		    width: 300px;
		    height: 350px;
		    float: right;
	    }
		.my_blog_preview {
			background-color: #fafafa;
			min-height: 300px;
			margin-top: 30px;
			box-shadow: rgba(0, 0, 0, 0.18) 0px 2px 4px;
		}
		.my_blog_photo_preview {
			width: 300px;
			height: 300px;
			position: absolute;
		}
		.my_blog_text_preview {
			margin-left: 350px;
			text-align: center;
			padding-top: 20px;
		}
		.my_blog_text_preview_title {
			font-size: 32px;
		}
		.my_blog_text_preview p {
			font-size: 18px;
			text-align: left;
			padding-right: 50px;
			padding-top: 20px;
		}
		.my_blog_text_preview_detailed {
			font-size: 18px;
			position: absolute;
			margin-left: -397px;
			margin-top: -18px;
			color: #fec300;
		}
		.my_blog_text_preview_detailed:hover {
			color: #252525;
		}
	    
		}
	</style>
	<main id="primary" class="site-main">
			
			<?php
			global $wpdb;
			$current_user = wp_get_current_user();
			$user_id = $current_user->ID;
			
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

			<div class="blog_author_banner">
				<p>Привет, добро пожаловать в мой блог на maraphon.online<br>Будем говорить о красоте и рок-н-ролле</p>
				<img style="object-fit: cover;" class="item" src="http://maraphon.online/wp-content/uploads/register-menu-background.jpg" alt="Марафон онлайн">
			</div>
			
			
				<?php 
				//$current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$params = array(
					'posts_per_page' => 10, // количество постов на странице
					'post_type'       => 'blog', // тип постов
					//'author' => 1
					//'paged'           => $current_page // текущая страница
				);
				query_posts($params);
		 
				//$wp_query->is_archive = true;
				//$wp_query->is_home = false;
		 
				while(have_posts()): the_post();
					echo '<div class="my_blog_preview">';
						$image = get_field('my_blog_photo_preview');
						$size = 'medium'; // (thumbnail, medium, large, full or custom size)		
						if( $image ) {
							echo '<div class="my_blog_photo_preview"><a href="'.get_the_permalink().'">'.wp_get_attachment_image( $image['ID'], $size, true ).'</a></div>';
						};
							
						echo '<div class="my_blog_text_preview">';
							echo '<a href="'.get_the_permalink().'" class="my_blog_text_preview_title">'.get_the_title().'</a>';	
							echo '<p>'.get_field('my_blog_text_preview').'</p>';
							echo '<a href="'.get_the_permalink().'" class="my_blog_text_preview_detailed">Подробнее</a>';
						echo '</div>';
					echo '</div>';
				endwhile;
				
				wp_pagenavi(); ?>
				
		 <?php endif; 
			
	echo '</main>'; ?>
<?php
get_footer();