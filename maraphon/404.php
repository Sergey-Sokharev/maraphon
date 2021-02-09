<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package maraphon
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found">
			<header class="page-header">
				
			</header><!-- .page-header -->

			<div class="page-content">
				<div class="test">
				<h1>Страница 404</h1>
				<p>Кажется вы зашли на страницу, которой уже нет</p>
    			<style>
				.test {
				margin-top: -45px;
 				height: 800px;
				background-color: white;
				text-align: center;
				padding-top: 250px;
				}
			
			.test h1 {
				font-size: 40px;
				font-family: kelson;
			}
			
			.test p {
			margin-left: 20px;
			font-size: 32px;
			font-family: kelson;
			}
			</style>
			</div>
			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
