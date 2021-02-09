<?php

/*
Template Name: home
*/ 

/**
 * The template for displaying home page
 *
 * This is the template that displays home page.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package maraphon
 */

get_header();
?>

	<main id="primary" class="site-main">
		

    <div class="banner">
            <div id="owl-demo">
            <!--     <a href="">
                    <img style="object-fit: cover; object-position: 95% 50%;" class="item" src="wp-content/uploads/baner-ng-1280-640-2.jpg" alt="Марафон онлайн">
                </a> -->
               <a href="">
                    <img style="object-fit: cover; object-position: 68% 50%;" class="item" src="wp-content/uploads/baner-katya-ganteli-1-1280-640.jpg" alt="Марафон онлайн">
                </a>  
            </div>
            <h1 class="banner-text-1">
                28 дней онлайн <br> с профессиональным <br> фитнес тренером
            </h1>
            <p class="banner-header-1">
                ВОЙТЕНКО <br> ЕКАТЕРИНОЙ
            </p>
        <!--     <a class="button-reg" href="http://maraphon.online/register/">ЗАПИСАТЬСЯ</a> -->
           <a class="button-reg" href="http://maraphon.online/shop/maraphon/">ЗАПИСАТЬСЯ</a> 
    </div>
    
      
    <div class="utp-main">
         <div class="utp-element-1">
             <a href="/menu-example/" class="utp-header-1">ВАШЕ МЕНЮ
             </a>
        </div>
        
        <div class="utp-element-2">
             <a href="/workout-example/" class="utp-header-2">КОМПЛЕКС<br>ТРЕНИРОВОК
             </a>
        </div>
        
        <a href="/menu/"><img class="narrow-1" src="wp-content/uploads/narrow-50x50-1.jpg" alt="Стрелка"></a>
        <a href="/example/"><img class="narrow-2" src="wp-content/uploads/narrow-50x50-1.jpg" alt="Стрелка"></a>
                
        <div class="clearfloat"></div>
        
        <div class="utp-element-3">
             <a href="/razbor-produktov/" class="utp-header-3">РАЗБОР <br> ПРОДУКТОВ
             </a>
        </div>
        
        <div class="utp-element-3-mobile">
             <a href="/razbor-produktov/" class="utp-header-3">РАЗБОР ПРОДУКТОВ
             <p class="utp-text-3">
             Энциклопедия <br> качественных продуктов <br> в наших магазинах
             </p>
             </a>
            
        </div>

        <a href="/register/"><img class="narrow-3" src="wp-content/uploads/narrow-50x50-1.jpg"></a>
    </div> 
    
    <div class="vizitka">
        <p class="vizitka-header">
            Привет, моя хорошая!
        </p>
        <p class="vizitka-text">
            Я рада приветствовать тебя в моем онлайн проекте. Целый месяц рука об руку мы будем двигаться к намеченной цели. Я научу тебя питаться вкусно и правильно, без вреда для здоровья достигнуть результата и  надолго закрепить его. Нас ждет невероятно продуктивный месяц. Скорее жми кнопку ЗАПИСАТЬСЯ и присоединяйся к нашей дружной команде!
        </p>
        <img class="vizitka-img" src="wp-content/uploads/vizitka-1280x436-1.jpg" alt="Визитка">
    </div>
	<div style="height: 23px;"></div>


<!-- <iframe class="iframe-mobile" src="https://averin.pro/widget.php?l=voitenko_catsss&style=1&gallery=1&s=150&icc=3&icr=1&t=1&tt=Я в Instagram&h=0&ttcolor=000000&th=efc208&bw=efc208&bscolor=FFFFFF&bs=FF0000&ts=Подписаться&ch=utf8" allowtransparency="true" frameborder="0" scrolling="no" style="border:none;overflow:hidden;width:720px; height: 269px" ></iframe>
209px --> 
    
<!--<iframe class="iframe-desktop" src="https://averin.pro/widget.php?l=voitenko_catsss&style=1&gallery=1&s=150&icc=3&icr=1&t=1&tt=Я в Instagram&h=0&ttcolor=000000&th=efc208&bw=efc208&bscolor=FFFFFF&bs=FF0000&ts=Подписаться&ch=utf8" allowtransparency="true" frameborder="0" scrolling="no" style="border:none;overflow:hidden;width:1280px; height: 455px" ></iframe>
 350px -->    
 
</main>
</div>

	<link rel="stylesheet" href="<?php echo content_url() ?>/themes/maraphon/css/owl.carousel.css">
	<script src="<?php echo content_url() ?>/themes/maraphon/js/jquery-1.9.1.min.js"></script>
    <script src="<?php echo content_url() ?>/themes/maraphon/js/owl.carousel.min.js"></script>
	
    
    <script>
    $(document).ready(function() {
	     
            var owl = $("#owl-demo");
            $("#owl-demo").owlCarousel({
                            autoPlay: 6000,
                            items : 1,
                            itemsDesktop : [1000,1],
                            itemsDesktopSmall : [900,1],
                            itemsTablet: [600,1],
                            itemsMobile : false  
                            });
                            $(".next").click(function(){
                            owl.trigger('owl.next');
                            })
                            $(".prev").click(function(){
                            owl.trigger('owl.prev');
                            })  
            });
            
   
    </script> 


<?php
get_footer();
?>
