<?php

/*
Template Name: feedback
*/ 

get_header();
?>
    <main id="primary" class="site-main">
    <style>
        @media screen and (max-width:1279px){
        #primary {
	width: 720px;
	margin: auto;
	margin-top: 80px;
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
	}
	@media screen and (min-width:1279px){  
		#primary {
	margin: auto;
	margin-top: 90px;
	margin-bottom: 20px;
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
	</style>

	<div class="feedback_top"></div>
	<?php echo do_shortcode('[testimonial_view id="1"]'); ?>
	<div class="feedback_bottom"></div>
	</main><!-- #main -->
<?php
get_footer();
