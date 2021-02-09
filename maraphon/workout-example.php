<?php
/*
Template Name: workout-example
*/

get_header();
?>

<main id="primary" class="site-main">

	<div class="workout-page">
    	<div class="workout-main-banner">
	        <img class="workout-main-banner-image" src="<?php echo content_url() ?>/uploads/lk-banner-5-1280x320-1.jpg">
	        <p class="workout-main-banner-header">ПРИМЕР ТРЕНИРОВОЧНОГО ПРОЦЕССА
	        </p>
	        <p class="workout-main-banner-header-text">
	        Пример онлайн тренировки для дома, которая входит в пакет 28 дневного марафона
	        </p>
    	</div>
    	<div class="workout_content_text">
	    	<h1><i class="fa fa-rocket" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Пример тренировки</h1>
	    	<p>Физическая активность в нашей жизни - один из основных критериев здоровья. Многие из вас много времени проводят в офисе, мало двигаются и, как следствие, часто испытывают упадок сил. Я создала такой комплекс тренировок, который подойдет для женщин любого возраста и с любым уровнем подготовки. Даже если вы никогда не занимались спортом, не переживайте, вы справитесь!</p>				
			<p>Ниже вы увидите пример одной тренировки. Все тренировки будут доступны вам в любое время в онлайн формате</p>
    	</div>
    	<iframe class="workout_video" src="https://www.youtube.com/embed/BY_pTPr6_dA?list=PLDLX-EMUMaO0wmu0p-NaOzcPJXvy6qMtR" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    	<p class="workout_copyright"> © <?php echo current_time("Y"); ?> Марафон Онлайн от Войтенко Екатерины</p>
    	
    	
	</div>
    
    
</main>
</div>

<?php
get_footer();
