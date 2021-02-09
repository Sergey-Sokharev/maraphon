<?php
/*
Template Name: menu-example
*/

get_header();
?>

<style>
	 @media screen and (max-width:1279px){
        #primary {
			width: 720px;
			margin: auto;
			margin-top: 65px;
			background-color: #252525;
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

		.entry-header {
		    background-color: white;
		    margin-bottom: -4px;
	    }
	    
	    .entry-title {
		    font-family: kelson;
		    font-size: 40px;
		    text-align: center;
		    padding-top: 30px;
	    }
	    
	    .entry-content {
		    margin: 0;
	    }
	    
	    .entry-footer {
		    display: none;
	    }




		}
	@media screen and (min-width:1279px){  
		#primary {
			margin: auto;
			margin-top: 70px;
			margin-bottom: -23px;
	    }
	    
		.opacity-line {
	        position: absolute;
	        height: 70px;
	        width: 1280px;
	        background-color: #d5d5d5;
	        margin-top: 90px;
	        z-index: 998;
	    }
	    
	    .entry-header {
		    background-color: white;
		    margin-bottom: -4px;
	    }
	    
	    .entry-title {
		    font-family: kelson;
		    font-size: 40px;
		    margin: auto;
		    padding-top: 30px;
	    }
	    
	    .entry-content {
		    margin: 0;
	    }
	    
	    .entry-footer {
		    display: none;
	    }
	    
	    }

</style>

<main id="primary" class="site-main">

	  <div class="menu_example_page">
		  <?php get_template_part( 'template-parts/content', get_post_type() );?>
	  </div>


    
</main>
</div>

<?php
get_footer();
