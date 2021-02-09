<?php
/**
 * The template for displaying razbor posts
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
		}
		.entry-content ol li {
			list-style: decimal;
		}
		.entry-content p {
			margin-bottom: 0px;
		}
		.sostav_ul {
			margin-left: 25px;
			margin-bottom: 0rem;
		}
		.sostav_ul li {
			list-style: disc;
		}
		.pt-cv-wrapper {
			margin-bottom: -10px;
		}
		.razbor_h1 {
			text-align: center;
			margin-bottom: 0px;
		}
		.razbor_h3 {
			text-align: center;
			width: 70%;
			margin: auto;
			font-weight: 400;
		}
		.razbor_image_div {
			height: 642px;
			width: 642px;
			margin: auto;
			border: 1px solid grey;
			margin-top: 10px;
			margin-bottom: 20px;
			box-shadow: 0 10px 18px -13px #000;
		}
		.razbor_main_table {
			border: 1px solid grey;
			border-collapse: collapse;
			background-color: white;
		}
		.razbor_main_table tr {

		}
		.razbor_main_table td {
			padding: 30px 20px 30px 20px;
			font-weight: 600;
			font-size: 28px;
		}
		.razbor_main_table th {
			padding-left: 5px;
			padding-right: 5px;

			text-align: center;
			font-size: 28px;
			font-weight: 400;
			font-family: Helvetica;
		}
		.entry-content {
			width: 100%;
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
		.entr-content {
			width: 640px;
			border: 1px solid grey;
			padding: 10px 10px 10px 10px;
			margin-left: 5px;
		}
		.entry-content h1 {
		    margin-top: -20px;
		    font-family: kelson;
	    }
	    .razbor_h3 {
		    font-size: 28px;
		}
		.razbor_image_div img {
			width: 640px;
			height: 640px;
		}
	    .razbor_main_table {
		    width: 640px;
		    margin: auto;
		}
		.razbor_main_table th {
			font-size: 20px;
		}
		.razbor_main_table td {
			font-size: 20px;
		}
		.food_review_conclusion {
			font-size: 36px;
			color:rgb(20, 104, 169);
			text-align: center;
			margin-bottom: -15px;
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
		.razbor_page {
			height: auto;
			padding-left: 10px;
		}
		
		#razbor_main_content_a {
			position: absolute;
			margin-left: 30px;
			margin-top: -73px;
			z-index: 10;
		}
		
		.razbor {
			margin-bottom: 10px;
		}
		
		.press_button {
			margin-left: 100px !important;
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
			background-image: url(/wp-content/uploads/razbor_background.jpg);
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
	    .razbor_h3 {
		    font-size: 24px;
		}
		
		.food_review_image_caption_block {
			background-color: white;
			margin-top: 20px;
			border: 1px solid grey;
			margin-bottom: 20px;
		}
		
		.razbor_image_div {
			width: 322px;
			height: 322px;
			margin-top: 20px;
			margin-left: 20px;
			margin-bottom: 20px;
			text-align: -webkit-center;
		}
		
		.razbor_image_div img {
			width: 320px;
			height: 320px;
		}
		
		.razbor_main_table {
			margin-left: 366px;
			margin-top: -340px;
			margin-bottom: 20px;
			width: 750px;
			border: 0;
			min-height: 320px;
		}
		
		.razbor_main_table th {
			padding-top: 10px;
			padding-bottom: 10px;
			font-size: 18px;
		}
		
		.razbor_main_table td {
			padding-top: 10px;
			padding-bottom: 10px;
			font-size: 18px;
		}
		.food_review_conclusion {
			font-size: 32px;
			color:rgb(20, 104, 169);
			text-align: left;
			margin-bottom: -15px;
			margin-left: -5px
		}
		
		.sostav_ul {
			margin-left: 18px;
		}
		
		.entr-content {
			width: 1100px;
			padding: 20px 20px 20px 20px;
			border: 1px solid grey;
			margin: 20px 20px 20px 20px;
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
		.razbor_page {
			height: auto;
			padding-top: 20px;
		}
		
		#razbor_main_content_a {
			position: absolute;
			margin-top: 12px;
			margin-left: 1012px;
		}
		
		.razbor {
			margin-bottom: 10px;
		}
		
		}
		</style>
		
		
		<a href="/razbor-produktov/" class="back_to_personal_menu" id="razbor_main_content_a">Оглавление</a>
		<div class="razbor_page">
		
		<?php
		while ( have_posts() ) :
			
				
			if (get_field('razbor_image') != '') {	
				the_title('<h1 class="razbor_h1">','</h1>');
			};
			
			if (get_field('razbor_opisanie') != '') {
				echo '<h3 class="razbor_h3">'.get_field('razbor_opisanie').'</h3>';
			};		
			
			echo '<div class="food_review_image_caption_block">';
			$image = get_field('razbor_image');
			$size = 'full'; // (thumbnail, medium, large, full or custom size)		
			if( $image ) {
				echo '<div class="razbor_image_div">';
			    echo wp_get_attachment_image( $image['ID'], $size, true );
			    echo '</div>';
			};
			
			$conclusions = get_field('razbor_verdikt');
			if ($conclusions) {
				foreach( $conclusions as $conclusion );
			};
			
			if ((get_field('razbor_sostav') != '') && (get_field('razbor_sostav') != 'товарная группа') && ($conclusion != 'товарная группа')) {
				echo '
				<table class="razbor_main_table">';
				
					echo '<tr>
							<td colspan="3">
								<p class="food_review_conclusion" style="">Вывод: '.$conclusion.'</p>
							</td>
						</tr>';
					
					if (get_field('razbor_proizvoditel') != '') {
					echo '<tr>
						<th style="width: 30%">
							&nbsp;Производитель&nbsp;
						</th>
						<td colspan="2" style="width: 70%">
							'.get_field('razbor_proizvoditel').'
						</td>
					</tr>';
					}
					
				/*	if (get_field('razbor_izgotovitel') != '') {
					echo '<tr>
						<th style="width: 30%">
							&nbsp;Изготовитель&nbsp;
						</th>
						<td colspan="2" style="width: 70%">
							'.get_field('razbor_izgotovitel').'
						</td>
					</tr>';
					};  */
					
					echo '<tr>
						<th>
							&nbsp;Состав&nbsp;
						</th>
						<td colspan="2">
							'.get_field('razbor_sostav').'
						</td>
					</tr>';
					
					echo '<tr>
						<th>
							<p style="margin-bottom: 0rem;">Нежелательные<br>или опасные добавки&nbsp;</p>
						</th>
						
						<td colspan="2">
							<ul class="sostav_ul">';
								$dobavki_string = get_field('razbor_dobavki');
								$dobavki_string = str_replace("<p>", "<li>", $dobavki_string);
								$dobavki_string = str_replace("br", "li", $dobavki_string);
								$dobavki_string = str_replace("</p>", "</li>", $dobavki_string);
								echo $dobavki_string; 
							echo '</ul>
						</td>
					</tr>';
					
					$where_to_buys = get_field('razbor_shop');
					if ($where_to_buys) {
					echo '<tr>
						<th>
							&nbsp;Где купить&nbsp;
						</th>
						<td colspan="2">';
						
							$count_shop = 0;
							foreach( $where_to_buys as $where_to_buy ) {
								$count_shop = $count_shop + 1;
								if ($count_shop == 1) {
								echo $where_to_buy;
								} else if ($count_shop > 1) {
									echo ', '.$where_to_buy;
								}
							};
						
						echo '</td>
					</tr>'; 
					};
					
					global $wpdb;
					$current_user = wp_get_current_user();
					if(is_user_role('administrator', $current_user->ID)) {
						$food_review_admin_block = '';
						echo '
						<style>
							.food_review_admin_table_border {
								border: 1px solid grey;
								text-align: center;
							}
						</style>
						';
					} else {
						$food_review_admin_block = 'display: none';
					};
					
					echo '<tr class="food_review_admin_table_border" style="'.$food_review_admin_block.'">
						<th>
							Характеристики продукта
						</th>
						<td class="food_review_admin_table_border">
							На упаковке
						</td>
						<td>
							Факт
						</td>
					</tr>';
					
					
					if (get_field('food_review_kcal') != '') {
					$carbohydrat = get_field('food_review_carbohydrat');
					$protein = get_field('food_review_protein');
					$fat = get_field('food_review_fat');
					$kcal = $protein * 4  + $fat * 9 + $carbohydrat * 4;
					$kcal_real = $kcal + $protein;
					$kcal_carbohydrat = $kcal_real - ($protein * 4 + $fat * 9);
					$carbohydrat_real = $kcal_carbohydrat / 4;

					echo '<tr class="food_review_admin_table_border">
						<th>
							&nbsp;Ккал на 100гр.<br>продукта &nbsp;
						</td>
						<td class="food_review_admin_table_border" style="">
							'.get_field('food_review_kcal').'
						</td>
						<td style="'.$food_review_admin_block.'">
							'.$kcal_real.'
						</td>
					</tr>';
					};
					
					if (get_field('food_review_protein') != '') {
					echo '<tr class="food_review_admin_table_border">
						<th>
							&nbsp;Белков на 100гр. продукта &nbsp;
						</td>
						<td class="food_review_admin_table_border">
							'.get_field('food_review_protein').'
						</td>
						<td style="'.$food_review_admin_block.'">
							'.$protein.'
						</td>
					</tr>';
					};
					
					if (get_field('food_review_fat') != '') {
					echo '<tr class="food_review_admin_table_border">
						<th>
							&nbsp;Жиров на 100гр. продукта &nbsp;
						</td>
						<td class="food_review_admin_table_border">
							'.get_field('food_review_fat').'
						</td>
						<td style="'.$food_review_admin_block.'">
							'.$fat.'
						</td>
					</tr>';
					};
					
					if (get_field('food_review_carbohydrat') != '') {
					
					echo '<tr class="food_review_admin_table_border">
						<th>
							&nbsp;Углеводов на 100гр. продукта &nbsp;
						</td>
						<td class="food_review_admin_table_border">
							'.get_field('food_review_carbohydrat').'
						</td>
						<td style="'.$food_review_admin_block.'">
							'.$carbohydrat_real.'
						</td>
					</tr>';
					};
					
					if (get_field('food_review_sugar') != '') {
					echo '<tr class="food_review_admin_table_border">
						<th>
							&nbsp;Из них сахара&nbsp;
						</td>
						<td class="food_review_admin_table_border">
							'.get_field('food_review_sugar').'
						</td>
						<td style="'.$food_review_admin_block.'">
							Расчет
						</td>
					</tr>';
					};
					
					if (get_field('food_review_fiber') != '') {
					echo '<tr class="food_review_admin_table_border">
						<th>
							&nbsp;Клетчатка на 100гр. продукта &nbsp;
						</td>
						<td class="food_review_admin_table_border">
							'.get_field('food_review_fiber').'
						</td>
						<td style="'.$food_review_admin_block.'">
							Расчет
						</td>
					</tr>';
					};

					if (get_field('food_review_comment') != '') {
					echo '<tr>
						<th>
							&nbsp;Комментарий&nbsp;
						</td>
						<td colspan="2">
							'.get_field('food_review_comment').'
						</td>
					</tr>';
					};
					
					
					echo '
					</tr>
				</table>
			';
			};
			
			echo '</div>';
			
			the_post();
			get_template_part( 'template-parts/content', get_post_type() );
			
			
		endwhile; // End of the loop.
		?>
		
		<a onclick="javascript:history.back(); return false;" class="back_to_personal_menu">← Назад</a>
		
		<?php //endif; ?>	<!-- Окончание условия проверки роли пользователя для просмотра контента--> 
		</div>	
		
		<script>
			//$(".entry-content").children("p").remove();
			
			/*var image = $(".razbor_image_div").children("img");
			var image_width = image.attr("width");
			var image_height = image.attr("height");
			if (image_width != image_height) {
				var image_src = image.attr("src");
				var css_src = "url(" + image_src + ")";
				$(".razbor_image_div").children("img").attr("src", "");
				$(".razbor_image_div").children("img").attr("srcset", "");
				$(".razbor_image_div").children("img").css("backgroundImage", css_src);
				$(".razbor_image_div").children("img").css("backgroundSize", "contain");
				$(".razbor_image_div").children("img").css("backgroundRepeat", "no-repeat");
				$(".razbor_image_div").children("img").css("backgroundPosition", "center");
				$(".razbor_image_div").children("img").css("backgroundColor", "white");
			};*/
		</script>

	</main><!-- #main -->

<?php
get_footer();
