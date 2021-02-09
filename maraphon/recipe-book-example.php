<?php
/*
Template Name: recipe-book-example
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
		 .recipe_book_page h1 {
		    padding-top: 30px;
		    font-family: kelson;
		    font-size: 40px;
		    text-align: center;
	    }
		
		.recipe_book_item:last-child {
			margin-bottom: 20px;
		}
		}
	@media screen and (min-width:1279px){  
		#primary {
			margin: auto;
			margin-top: 70px;
			margin-bottom: -20px;
	    }
		.opacity-line {
	        position: absolute;
	        height: 70px;
	        width: 1280px;
	        background-color: #d5d5d5;
	        margin-top: 90px;
	        z-index: 998;
	    }
	    
	    .recipe_book_page h1 {
		    padding-top: 30px;
		    font-family: kelson;
		    font-size: 40px;
		    text-align: center;
	    }
	    
	    .recipe_book_item:last-child {
			margin-bottom: 20px;
		}
	    }
	
	
	
	
</style>


<main id="primary" class="site-main">

	  <div class="recipe_book_page" style="height: auto; background-color: white;">
	  <h1>Пример книги рецептов</h1>
		  
	  <img src="http://maraphon.online/wp-content/uploads/recipe_book_example_1.jpg" alt="Книга рецептев - завтрак" class="recipe_book_item">
	  <div style="height: 20px; background-color: #252525;"></div>
	  <img src="http://maraphon.online/wp-content/uploads/recipe_book_example_2.jpg" alt="Книга рецептев - обед" class="recipe_book_item">	
	  <div style="height: 20px; background-color: #252525;"></div>
	  <img src="http://maraphon.online/wp-content/uploads/recipe_book_example_3.jpg" alt="Книга рецептев - салаты" class="recipe_book_item">		  
		  
		  
		  
	  </div>




    
</main>
</div>

<?php
get_footer();
