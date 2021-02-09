<?php
/*
Template Name: director-cabinet
*/

get_header();
?>
	<main id="primary" class="site-main">

		<div class="account-main">
			<div class="cabinet-main-banner">   		
        		<div class="maraphon_day">
					<span>
				        <?php
					    $_monthsList = array(
						"1"=>"январе","2"=>"феврале","3"=>"марте",
						"4"=>"апреле","5"=>"мае", "6"=>"июне",
						"7"=>"июле","8"=>"августе","9"=>"сентябре",
						"10"=>"октябре","11"=>"ноябре","12"=>"декабре");
						$_monthsListThis = array(
						"01"=>"января","2"=>"февраля","3"=>"марта",
						"4"=>"апреля","5"=>"мая", "6"=>"июня",
						"7"=>"июля","8"=>"августа","9"=>"сентября",
						"10"=>"октября","11"=>"ноября","12"=>"декабря");
						$_monthsListThere = array(
						"1"=>"Январь","2"=>"Февраль","3"=>"Март",
						"4"=>"Апрель","5"=>"Май", "6"=>"Июнь",
						"7"=>"Июль","8"=>"Август","9"=>"Сентябрь",
						"10"=>"Октябрь","11"=>"Ноябрь","12"=>"Декабрь");
						$n = current_time("m") + 1 > 12 ? 1 : current_time("n")+1;
						$next_month = $_monthsList[$n];
						$m = current_time("n");
						$this_month = $_monthsListThis[$m];
					    if ((current_time("j") + 0) >= 29) {
							echo 'Марафон окончен,<br>до встречи в '.$next_month.'!';
						} else {
							echo 'Сегодня '.current_time ('j',0).' день марафона '.$this_month.'';
						};    
					    ?>
			        </span>
        		</div>

        		<img class="account-main-banner-image" src="<?php echo content_url() ?>/uploads/lk-banner-5-1280x320-1.jpg">
				<p class="account-main-banner-header">Кабинет директора
        		</p>
				<p class="account-main-banner-header-text">
				maraphon.online
        		</p>
    		</div>
    	
	    	<div id="admin_url_block" style="margin-top: -161px;">
		        	<a href="/director-cabinet/">Кабинет директора</a>
		        	<br>
		        	<a href="http://maraphon.online/kbju/" target="_blank" class="member_report" >Калькулятор</a>
		        	<br>
		        	<a href="http://maraphon.online/wp-admin/users.php" target="_blank" class="member_report" >Wordpress</a>
		        	<br>
		        	<a href="<?php echo wp_logout_url('/') ?>" >Выход</a>
	        </div>
        
			<div id="admin_url_block_opacity" style="margin-top: -161px;"></div>

		    <?php //Скрываем управление марафоном для всех ролей, кроме администратора
			$user = wp_get_current_user();
			if (is_user_role('administrator', $user->ID)) {
		 	echo 
			'<style>
		    #admin_url_block {display: block !important}
		    #admin_url_block_opacity {display: block !important}
		    </style>';} 
		    ?>
	        
			<div class="admin-navigation">
				<ul id="drag" class="tabs"> 
	            <li id="admin-report" class="hide-button" ><a title="" class="btn1" href="#tabu1"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ОТЧЕТЫ</a></li>
	            <li id="admin-members" class="hide-button" ><a title="" class="btn1" href="#tabu2"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;УЧАСТНИКИ</a></li>
	            <li id="admin-result" class="hide-button" ><a title="" class="btn1" href="#tabu3"><i class="fa fa-trophy" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;РЕЗУЛЬТАТЫ</a></li>      
	            <li id="admin-cash" class="hide-button" ><a title="" class="btn1" href="#tabu4"><i class="fa fa-credit-card" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ОПЛАТА</a></li>
	            <li id="admin-settings" class="hide-button" ><a title="" class="btn1" href="#tabu5"><i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;НАСТРОЙКИ</a></li>    
	            </ul>
			</div>
	        
	        <script>
		    $(function() {
	        $('.tabs li').click(function(event){
	        event.preventDefault();
	        $('.tabs li').removeClass('active');
	        $(this).addClass('active');
	        $('.tabu-content').hide();
	        var activeTab = $(this).find('a').attr('href');
	        $(activeTab).show();
	        });
	        var hash = window.location.hash;
	        hash ?  $("a[href='"+hash+"']").click()  : $('.tabs li:first').click()
			});
			</script>

		<div class="admin-content">
            <div id="tabu1" class="tabu-content">
            <div class="members_header_div"><p class="members_header">Ежедневные отчеты участников</p></div>
            <br> 

            	<?php if ( !is_user_role('administrator', $user->ID) ) : ?>
            		<div style="height: 700px; background-color: white">
                    <p class="warning">
                        <?php 
	                        $enter_link_message = '<p style="text-align: center; padding-top: 250px; font-size: 28px;"><a href="http://maraphon.online/wp-login.php?">Войдите</a> под учетной записью администратора, чтобы просматривать данные</p>';
	                        _e($enter_link_message, 'profile'); 
	                        ?>
                    </p>
            		</div>
				<?php else : ?>
				
				<?php

				global $wpdb;
				$current_user = wp_get_current_user();
				$user_id = $current_user->ID;
				$curator_table_db_period = current_time("Y-m");
				$curator_table_member_period = current_time("m.Y");
				//$curator_table_db_period = '2021-01';
				//$curator_table_member_period = '01.2021';
			    $four_days_ago = current_time('d') - 3; //объявление переменных для подсчета количества отчетов по кураторам
			    if ( $four_days_ago > 0 ) {
				$date_from = $curator_table_db_period.'-01';
		        $date_before = $curator_table_db_period.'-'.$four_days_ago;
		        } else {
			    	$date_from = $curator_table_db_period.'-01';
					$date_before = $curator_table_db_period.'-01';   
		        };
		        $main_curator = 'Екатерина';
		        $curator_1 = 'Наталья';
		        $curator_2 = 'Дмитрий';
		        $maraphon_member_month = current_time('m.Y');
				
				$day_now = current_time('j');

				if ($day_now == 1 || $day_now == 2) {
					$yesterday_month = current_time('n') - 1;
					if ($yesterday_month == 0) {$yesterday_month = '12'; $yesterday_year = current_time('Y') - 1; $yesterday_year_four_days = current_time('Y') - 1;};
					if ($yesterday_month == 1) {$yesterday_month = '01'; $yesterday_year = current_time('Y'); $yesterday_year_four_days = current_time('Y');};
					if ($yesterday_month == 2) {$yesterday_month = '02'; $yesterday_year = current_time('Y'); $yesterday_year_four_days = current_time('Y');};
					if ($yesterday_month == 3) {$yesterday_month = '03'; $yesterday_year = current_time('Y'); $yesterday_year_four_days = current_time('Y');};
					if ($yesterday_month == 4) {$yesterday_month = '04'; $yesterday_year = current_time('Y'); $yesterday_year_four_days = current_time('Y');};
					if ($yesterday_month == 5) {$yesterday_month = '05'; $yesterday_year = current_time('Y'); $yesterday_year_four_days = current_time('Y');};
					if ($yesterday_month == 6) {$yesterday_month = '06'; $yesterday_year = current_time('Y'); $yesterday_year_four_days = current_time('Y');};
					if ($yesterday_month == 7) {$yesterday_month = '07'; $yesterday_year = current_time('Y'); $yesterday_year_four_days = current_time('Y');};
					if ($yesterday_month == 8) {$yesterday_month = '08'; $yesterday_year = current_time('Y'); $yesterday_year_four_days = current_time('Y');};
					if ($yesterday_month == 9) {$yesterday_month = '09'; $yesterday_year = current_time('Y'); $yesterday_year_four_days = current_time('Y');};
					if ($yesterday_month == 10) {$yesterday_month = '10'; $yesterday_year = current_time('Y'); $yesterday_year_four_days = current_time('Y');};
					if ($yesterday_month == 11) {$yesterday_month = '11'; $yesterday_year = current_time('Y'); $yesterday_year_four_days = current_time('Y');};
					$two_days_start = '29';
					$two_days_finish = '30';
					$four_days_start = '29';
					$four_days_finish = '31';
					$two_days_start_db = $yesterday_year.'-'.$yesterday_month.'-29';
					$two_days_finish_db = $yesterday_year.'-'.$yesterday_month.'-30';
					$four_days_start_db = $yesterday_year.'-'.$yesterday_month.'-29';
					$four_days_finish_db = $yesterday_year.'-'.$yesterday_month.'-31';
					$this_month_for_button = $_monthsListThis[$yesterday_month];
					$curator_period_newbie = $two_days_start.'-'.$two_days_finish.' '.$this_month_for_button;
					$curator_period_profy = $four_days_start.'-'.$four_days_finish.' '.$this_month_for_button;
					
				} else if ($day_now == 3 || $day_now == 4) {
					$yesterday_month_four_days = current_time('n') - 1;
					if ($yesterday_month_four_days == 0) {$yesterday_month_four_days = '12'; $yesterday_year_four_days = current_time('Y') - 1;};
					if ($yesterday_month_four_days == 1) {$yesterday_month_four_days = '01'; $yesterday_year_four_days = current_time('Y');};
					if ($yesterday_month_four_days == 2) {$yesterday_month_four_days = '02'; $yesterday_year_four_days = current_time('Y');};
					if ($yesterday_month_four_days == 3) {$yesterday_month_four_days = '03'; $yesterday_year_four_days = current_time('Y');};
					if ($yesterday_month_four_days == 4) {$yesterday_month_four_days = '04'; $yesterday_year_four_days = current_time('Y');};
					if ($yesterday_month_four_days == 5) {$yesterday_month_four_days = '05'; $yesterday_year_four_days = current_time('Y');};
					if ($yesterday_month_four_days == 6) {$yesterday_month_four_days = '06'; $yesterday_year_four_days = current_time('Y');};
					if ($yesterday_month_four_days == 7) {$yesterday_month_four_days = '07'; $yesterday_year_four_days = current_time('Y');};
					if ($yesterday_month_four_days == 8) {$yesterday_month_four_days = '08'; $yesterday_year_four_days = current_time('Y');};
					if ($yesterday_month_four_days == 9) {$yesterday_month_four_days = '09'; $yesterday_year_four_days = current_time('Y');};
					if ($yesterday_month_four_days == 10) {$yesterday_month_four_days = '10'; $yesterday_year_four_days = current_time('Y');};
					if ($yesterday_month_four_days == 11) {$yesterday_month_four_days = '11'; $yesterday_year_four_days = current_time('Y');};
					$two_days_start = '01';
					$two_days_finish = '02';
					$four_days_start = '29';
					$four_days_finish = '31';
					$two_days_start_db = current_time('Y-m').'-01';
					$two_days_finish_db = current_time('Y-m').'-02';
					$four_days_start_db = $yesterday_year_four_days.'-'.$yesterday_month_four_days.'-29';
					$four_days_finish_db = $yesterday_year_four_days.'-'.$yesterday_month_four_days.'-31';
					$this_month_for_button = $_monthsListThis[current_time('n')];
					$this_month_for_button_four_days = $_monthsListThis[$yesterday_month_four_days];
					$curator_period_newbie = $two_days_start.'-'.$two_days_finish.' '.$this_month_for_button;
					$curator_period_profy = $four_days_start.'-'.$four_days_finish.' '.$this_month_for_button_four_days;
				} else {
					if ($day_now == 5 || $day_now == 6) {$two_days_start = '03'; $two_days_finish = '04'; $four_days_start = '01'; $four_days_finish = '04';};
					if ($day_now == 7 || $day_now == 8) {$two_days_start = '05'; $two_days_finish = '06'; $four_days_start = '01'; $four_days_finish = '04';};
					if ($day_now == 9 || $day_now == 10) {$two_days_start = '07'; $two_days_finish = '08'; $four_days_start = '05'; $four_days_finish = '08';};
					if ($day_now == 11 || $day_now == 12) {$two_days_start = '09'; $two_days_finish = '10'; $four_days_start = '05'; $four_days_finish = '08';};
					if ($day_now == 13 || $day_now == 14) {$two_days_start = '11'; $two_days_finish = '12'; $four_days_start = '09'; $four_days_finish = '12';};
					if ($day_now == 15 || $day_now == 16) {$two_days_start = '13'; $two_days_finish = '14'; $four_days_start = '09'; $four_days_finish = '12';};
					if ($day_now == 17 || $day_now == 18) {$two_days_start = '15'; $two_days_finish = '16'; $four_days_start = '13'; $four_days_finish = '16';};
					if ($day_now == 19 || $day_now == 20) {$two_days_start = '17'; $two_days_finish = '18'; $four_days_start = '13'; $four_days_finish = '16';};
					if ($day_now == 21 || $day_now == 22) {$two_days_start = '19'; $two_days_finish = '20'; $four_days_start = '17'; $four_days_finish = '20';};
					if ($day_now == 23 || $day_now == 24) {$two_days_start = '21'; $two_days_finish = '22'; $four_days_start = '17'; $four_days_finish = '20';};
					if ($day_now == 25 || $day_now == 26) {$two_days_start = '23'; $two_days_finish = '24'; $four_days_start = '21'; $four_days_finish = '24';};
					if ($day_now == 27 || $day_now == 28) {$two_days_start = '25'; $two_days_finish = '26'; $four_days_start = '21'; $four_days_finish = '24';};
					if ($day_now == 29 || $day_now == 30) {$two_days_start = '27'; $two_days_finish = '28'; $four_days_start = '25'; $four_days_finish = '28';};
					if ($day_now == 31) {$two_days_start = '29'; $two_days_finish = '30'; $four_days_start = '25'; $four_days_finish = '28';};	
					$two_days_start_db = current_time('Y-m').'-'.$two_days_start;
					$two_days_finish_db = current_time('Y-m').'-'.$two_days_finish;
					$four_days_start_db = current_time('Y-m').'-'.$four_days_start;
					$four_days_finish_db = current_time('Y-m').'-'.$four_days_finish;
					$this_month_for_button = $_monthsListThis[current_time('n')];
					$this_month_for_button_four_days = $_monthsListThis[current_time('n')];
					$curator_period_newbie = $two_days_start.'-'.$two_days_finish.' '.$this_month_for_button;
					$curator_period_profy = $four_days_start.'-'.$four_days_finish.' '.$this_month_for_button_four_days;
				};
				
				$yesterday_vip = current_time('j') - 1;
				if ($yesterday_vip < 10) {$yesterday_vip = '0'.$yesterday_vip;};
				if ($yesterday_vip == 0) {
				$yesterday_month_vip = current_time('n') - 1;
				if ($yesterday_month_vip == 0) {$yesterday_vip = '31'; $yesterday_month_vip = '12'; $yesterday_year_vip = current_time('Y') - 1;};
				if ($yesterday_month_vip == 1) {$yesterday_vip = '31'; $yesterday_month_vip = '01'; $yesterday_year_vip = current_time('Y');};
				if ($yesterday_month_vip == 2) {$yesterday_vip = '28'; $yesterday_month_vip = '02'; $yesterday_year_vip = current_time('Y');};
				if ($yesterday_month_vip == 3) {$yesterday_vip = '31'; $yesterday_month_vip = '03'; $yesterday_year_vip = current_time('Y');};
				if ($yesterday_month_vip == 4) {$yesterday_vip = '30'; $yesterday_month_vip = '04'; $yesterday_year_vip = current_time('Y');};
				if ($yesterday_month_vip == 5) {$yesterday_vip = '31'; $yesterday_month_vip = '05'; $yesterday_year_vip = current_time('Y');};
				if ($yesterday_month_vip == 6) {$yesterday_vip = '30'; $yesterday_month_vip = '06'; $yesterday_year_vip = current_time('Y');};
				if ($yesterday_month_vip == 7) {$yesterday_vip = '31'; $yesterday_month_vip = '07'; $yesterday_year_vip = current_time('Y');};
				if ($yesterday_month_vip == 8) {$yesterday_vip = '31'; $yesterday_month_vip = '08'; $yesterday_year_vip = current_time('Y');};
				if ($yesterday_month_vip == 9) {$yesterday_vip = '30'; $yesterday_month_vip = '09'; $yesterday_year_vip = current_time('Y');};
				if ($yesterday_month_vip == 10) {$yesterday_vip = '31'; $yesterday_month_vip = '10'; $yesterday_year_vip = current_time('Y');};
				if ($yesterday_month_vip == 11) {$yesterday_vip = '30'; $yesterday_month_vip = '11'; $yesterday_year_vip = current_time('Y');};
				$yesterday_db = $yesterday_year_vip.'-'.$yesterday_month_vip.'-'.$yesterday_vip;
				$this_month_for_button = $_monthsListThis[$yesterday_month_vip];
				$curator_period_vip = $yesterday_vip.' '.$this_month_for_button;
				} else {
					$yesterday_month_vip = current_time('n');
					$yesterday_year_vip = current_time('Y');
					$yesterday_db = $yesterday_year_vip.'-'.$yesterday_month_vip.'-'.$yesterday_vip;
					$this_month_for_button = $_monthsListThis[$yesterday_month_vip];
					$curator_period_vip = $yesterday_vip.' '.$this_month_for_button;
				};
				
				$this_month_curator_member_count = $wpdb->get_results(
				"
				SELECT 
				(SELECT COUNT(*)
			    FROM wpux_orders orders
			    WHERE (orders.maraphon_next_month LIKE '%Новичок%'
			    OR orders.maraphon_next_month LIKE '%Семейный%')
			    AND orders.maraphon_member_month = '$curator_table_member_period') AS newbie,
			    (SELECT COUNT(*)
			    FROM wpux_orders orders
			    WHERE orders.maraphon_next_month LIKE '%Профи%'
			    AND orders.maraphon_member_month = '$curator_table_member_period') AS profy,
			    (SELECT COUNT(*)
			    FROM wpux_orders orders
			    WHERE orders.maraphon_next_month LIKE '%VIP%'
			    AND orders.maraphon_member_month = '$curator_table_member_period') AS vip,
			    (
			    SELECT COUNT(*)
			    FROM wpux_orders orders
			    LEFT OUTER JOIN wpux_daily_report daily
							ON (
						    daily.user_id = orders.user_id 
                            AND daily.date LIKE '%$curator_table_db_period%')
                            
							WHERE daily.date is null 
							AND orders.maraphon_member_month = '$curator_table_member_period' 
                            AND (orders.paid = 1 OR orders.credit = 1) 
				) AS total_lost_report_members,
				(
				SELECT COUNT(*)
				FROM wpux_daily_report A, wpux_orders orders
				WHERE orders.user_id = A.user_id 
                AND orders.maraphon_member_month = '$curator_table_member_period'
				AND (DATE(A.date) BETWEEN '$date_from' AND '$date_before')
				AND
				A.date =
				(
				SELECT MAX(DATE)
				FROM wpux_daily_report B
				WHERE A.user_id = B.user_id
				)
				) AS lost_report_members
				"
				);
				
				$main_curator_report_count = $wpdb->get_results(
				"
				SELECT
				(SELECT
				COUNT(DISTINCT daily.user_id)
				FROM wpux_daily_report daily, wpux_orders orders
				WHERE daily.user_id = orders.user_id
				AND orders.date =
								(
								SELECT MAX(DATE)
								FROM wpux_orders orders2
								WHERE orders.user_id = orders2.user_id
                                AND orders2.maraphon_member_month = '$maraphon_member_month'
                                AND (orders.maraphon_next_month LIKE '%Новичок%' OR orders.maraphon_next_month LIKE '%Семейный%')
                                AND orders2.curator = '$main_curator'
								)
				AND DATE(daily.date) BETWEEN '$two_days_start_db' AND '$two_days_finish_db'
				AND daily.comment = 'Отчет на проверке'
				) AS main_curator_newbie_report,
				(SELECT
				COUNT(DISTINCT daily.user_id)
				FROM wpux_daily_report daily, wpux_orders orders
				WHERE daily.user_id = orders.user_id
                AND orders.date =
								(
								SELECT MAX(DATE)
								FROM wpux_orders orders2
								WHERE orders.user_id = orders2.user_id
                                AND orders2.maraphon_member_month = '$maraphon_member_month'
                                AND orders.maraphon_next_month LIKE '%Профи%'
                                AND orders2.curator = '$main_curator'
								)
				AND DATE(daily.date) BETWEEN '$four_days_start_db' AND '$four_days_finish_db'
				AND daily.comment = 'Отчет на проверке'
				) AS main_curator_profy_report,
				(SELECT
				COUNT(*)
				FROM wpux_daily_report daily, wpux_orders orders
				WHERE daily.user_id = orders.user_id
                AND orders.date =
								(
								SELECT MAX(DATE)
								FROM wpux_orders orders2
								WHERE orders.user_id = orders2.user_id
                                AND orders2.maraphon_member_month = '$maraphon_member_month'
                                AND orders.maraphon_next_month LIKE '%VIP%'
                                AND orders2.curator = '$main_curator'
								)
				AND DATE(daily.date) = '$yesterday_db'
				AND daily.comment = 'Отчет на проверке'
				) AS main_curator_vip_report
				"
				);
				
				$add_curator_report_count = $wpdb->get_results(
				"
				SELECT
				(SELECT
				COUNT(DISTINCT daily.user_id)
				FROM wpux_daily_report daily, wpux_orders orders
				WHERE daily.user_id = orders.user_id
				AND orders.date =
								(
								SELECT MAX(DATE)
								FROM wpux_orders orders2
								WHERE orders.user_id = orders2.user_id
                                AND orders2.maraphon_member_month = '$maraphon_member_month'
                                AND orders.maraphon_next_month LIKE '%Профи%'
                                AND orders2.curator = '$curator_1'
								)
				AND DATE(daily.date) BETWEEN '$four_days_start_db' AND '$four_days_finish_db'
				AND daily.comment = 'Отчет на проверке'
				) AS curator_1_profy_report,
				(SELECT
				COUNT(DISTINCT daily.user_id)
				FROM wpux_daily_report daily, wpux_orders orders
				WHERE daily.user_id = orders.user_id
				AND orders.date =
								(
								SELECT MAX(DATE)
								FROM wpux_orders orders2
								WHERE orders.user_id = orders2.user_id
                                AND orders2.maraphon_member_month = '$maraphon_member_month'
                                AND orders.maraphon_next_month LIKE '%Профи%'
                                AND orders2.curator = '$curator_2'
								)
				AND DATE(daily.date) BETWEEN '$four_days_start_db' AND '$four_days_finish_db'
				AND daily.comment = 'Отчет на проверке'
				) AS curator_2_profy_report
				"	
				);
				
				if( $this_month_curator_member_count ) {
					foreach ( $this_month_curator_member_count as $curator_member_count ) {
					$newbie_counter = $curator_member_count->newbie;
					$profy_counter = $curator_member_count->profy;
					$vip_counter = 	$curator_member_count->vip;		
					$total_lost_report_members = $curator_member_count->total_lost_report_members;
					$lost_report_members = $curator_member_count->lost_report_members;
					};
				};
				
				if( $main_curator_report_count ) {
					foreach ( $main_curator_report_count as $main_curator_member_count ) {
						$main_curator_newbie_report_count = $main_curator_member_count->main_curator_newbie_report;
						$main_curator_profy_report_count = $main_curator_member_count->main_curator_profy_report;
						$main_curator_vip_report_count = $main_curator_member_count->main_curator_vip_report;
					};
				};
				
				if( $add_curator_report_count ) {
					foreach ( $add_curator_report_count as $add_curator_member_count ) {
						$curator_1_profy_report_count = $add_curator_member_count->curator_1_profy_report;
						$curator_2_profy_report_count = $add_curator_member_count->curator_2_profy_report;
					};
				};
				?>
				
		<style>
			.membersReportButton {
			margin-top: 10px;
			height: 40px;
			}
		</style>
				
		<table class="curator_member_report_table"> <!-- строка 6723 -->
			<tr>
				<th>
					Пакет
				</th>
				<th>
					Участников<br>всего
				</th>
				<th>
					Период<br>проверки
				</th>
				<th>
					<?php echo $main_curator; ?>
				</th>
				<th>
					<?php echo $curator_1; ?>
				</th>
				<th>
					<?php echo $curator_2; ?>
				</th>
			</tr>
			<tr>
				<td>
					Пакет "Новичок"
				</td>
				<td>
					<?php echo $newbie_counter; ?>
				</td>
				<td>
					<?php echo $curator_period_newbie; ?>
				</td>
				<td>
					<button class="membersReportButton" id="main_curator_newbie_report_button"><?php echo $main_curator_newbie_report_count; ?></button>
				</td>
				<td>
					-
				</td>
				<td>
					-
				</td>
			</tr>
			<tr>
				<td>
					Пакет "Профи"
				</td>
				<td>
					<?php echo $profy_counter; ?>
				</td>
				<td>
					<?php echo $curator_period_profy; ?>
				</td>
				<td>
					<button class="membersReportButton"  id="main_curator_profy_report_button"><?php echo $main_curator_profy_report_count; ?></button>
				</td>
				<td>
					<button class="membersReportButton" id="curator_1_profy_report_button"><?php echo $curator_1_profy_report_count; ?></button>
				</td>
				<td>
					<button class="membersReportButton" id="curator_2_profy_report_button"><?php echo $curator_2_profy_report_count; ?></button>
				</td>
			</tr>
			<?php 
			if ($vip_counter > 0) {
				echo '	
					<tr>
						<td>
							Пакет "VIP"
						</td>
						<td>
							'.$vip_counter.'
						</td>
						<td>
							'.$curator_period_vip.'
						</td>
						<td>
							<button class="membersReportButton" id="main_curator_vip_report_button">'.$main_curator_vip_report_count.'</button>
						</td>
						<td>
							-
						</td>
						<td>
							-
						</td>
					</tr>
				';
			};
			?>
			<tr>
				<td colspan="2">
					Участники,<br>не отправляющие отчеты
				</td>
				<td>
					<?php echo $_monthsListThere[current_time("n")].' '.current_time("Y"); ?>
				</td>
				<td style="border-right: 0";>
				</td>
				<td style="border-left: 0; border-right: 0;">
					<?php
					if (current_time("j") > 3 && current_time("j") < 29) {
						echo '<button class="membersReportButton" id="lost_members_report_button">'.($total_lost_report_members + $lost_report_members).'</button>';
					} else {
						echo '<button class="membersReportButton" id="lost_members_report_button" disabled>Нет</button>';
					}
					
					
					?>
				</td>
				<td style="border-left: 0;">
				</td>
			</tr>
		</table>
		
		<script type="text/javascript">
			
		$(function() {
				function showDailyReportNewbie(){
					  $.ajaxSetup({cache: false});
						jQuery.ajax({
							type:"POST",
							url: "/wp-admin/admin-ajax.php",
							data: {action: "showDailyReportNewbie"
							},
							success:function(data){
							jQuery(".showDailyReportData").html(data);
							$("#first_3_day_admin").remove();					
							}
						});
						return false;
					}
				    $("#main_curator_newbie_report_button").click(showDailyReportNewbie);
		});
			
		$(function() {
				function showDailyReportProfy(){
					  $.ajaxSetup({cache: false});
					  var curator = this.id;
						jQuery.ajax({
							type:"POST",
							url: "/wp-admin/admin-ajax.php",
							data: {action: "showDailyReportProfy",
								   curator
							},
							success:function(data){
							jQuery(".showDailyReportData").html(data);
							$("#first_3_day_admin").remove();					
							}
						});
						return false;
					}
				    $("#main_curator_profy_report_button").click(showDailyReportProfy);
				    $("#curator_1_profy_report_button").click(showDailyReportProfy);
				    $("#curator_2_profy_report_button").click(showDailyReportProfy);
				    
		});
		
		$(function() {
				function showDailyReportVIP(){
					  $.ajaxSetup({cache: false});
					  var curator = this.id;
						jQuery.ajax({
							type:"POST",
							url: "/wp-admin/admin-ajax.php",
							data: {action: "showDailyReportVIP",
								   curator
							},
							success:function(data){
							jQuery(".showDailyReportData").html(data);
							$("#first_3_day_admin").remove();					
							}
						});
						return false;
					}
				    $("#main_curator_vip_report_button").click(showDailyReportVIP);
		});	
			
		$(function() {
				function showLostMembersReport(){
					  $.ajaxSetup({cache: false});
						jQuery.ajax({
							type:"POST",
							url: "/wp-admin/admin-ajax.php",
							data: {action: "showLostMembersReport"
							},
							success:function(data){
							jQuery(".showDailyReportData").html(data);
							$("#first_3_day_admin").remove();	
							}
						});
						return false;
					}
				    $("#lost_members_report_button").click(showLostMembersReport);
				});
		</script>
				
                <br>
            	<div class="showDailyReportData" style="margin-top: 20px;"></div>
            	<div id="first_3_day_admin" style="height: 200px"></div>
				
            	<script type="text/javascript">

				$(function() {
				function showDailyReportTwoDays(){
					  $.ajaxSetup({cache: false});
						jQuery.ajax({
							type:"POST",
							url: "/wp-admin/admin-ajax.php",
							data: {action: "showDailyReportTwoDays"
							},
							success:function(data){
							jQuery(".showDailyReportData").html(data);
							$("#first_3_day_admin").remove();					
							}
						});
						return false;
					}
				    $("#membersReportButtonTwoDays").click(showDailyReportTwoDays);
				});

				$(function() {
				function showDailyReportYesterday(){
					  $.ajaxSetup({cache: false});
						jQuery.ajax({
							type:"POST",
							url: "/wp-admin/admin-ajax.php",
							data: {action: "showDailyReportYesterday"
							},
							success:function(data){
							jQuery(".showDailyReportData").html(data);
							$("#membersReportButtonYesterday").text('Отчеты проверяются...');
							$("#membersReportButtonToday").text('<?php echo $ending_today;?>');
							$("#first_3_day_admin").remove();	
							}
						});
						return false;
					}
				    $("#membersReportButtonYesterday").click(showDailyReportYesterday);
				});
			</script>	
				
            	<br>  
		</div>
		
		<div id="tabu2" class="tabu-content">
			
				<div class="members_header_div"><p class="members_header">Отчет по ролям марафона и меню</p></div>
				<div>
		
				<form id="choosePeriodForAdmin">
					
					<?php 
						
					if (current_time("d") < 25) {
					if (current_time("m") == '01') { $select_month_01 = 'selected="selected"'; };
					if (current_time("m") == '02') { $select_month_02 = 'selected="selected"'; };
					if (current_time("m") == '03') { $select_month_03 = 'selected="selected"'; };
					if (current_time("m") == '04') { $select_month_04 = 'selected="selected"'; };
					if (current_time("m") == '05') { $select_month_05 = 'selected="selected"'; };
					if (current_time("m") == '06') { $select_month_06 = 'selected="selected"'; };
					if (current_time("m") == '07') { $select_month_07 = 'selected="selected"'; };
					if (current_time("m") == '08') { $select_month_08 = 'selected="selected"'; };
					if (current_time("m") == '09') { $select_month_09 = 'selected="selected"'; };
					if (current_time("m") == '10') { $select_month_10 = 'selected="selected"'; };
					if (current_time("m") == '11') { $select_month_11 = 'selected="selected"'; };
					if (current_time("m") == '12') { $select_month_12 = 'selected="selected"'; };
					if (current_time("Y") == '2020') { $select_year_2020 = 'selected="selected"'; };
					if (current_time("Y") == '2021') { $select_year_2021 = 'selected="selected"'; };
					if (current_time("Y") == '2022') { $select_year_2022 = 'selected="selected"'; };
					if (current_time("Y") == '2023') { $select_year_2023 = 'selected="selected"'; };
					if (current_time("Y") == '2024') { $select_year_2024 = 'selected="selected"'; };
					if (current_time("Y") == '2025') { $select_year_2025 = 'selected="selected"'; };
					} else {
						if (current_time("m") == '01') { $select_month_02 = 'selected="selected"'; };
						if (current_time("m") == '02') { $select_month_03 = 'selected="selected"'; };
						if (current_time("m") == '03') { $select_month_04 = 'selected="selected"'; };
						if (current_time("m") == '04') { $select_month_05 = 'selected="selected"'; };
						if (current_time("m") == '05') { $select_month_06 = 'selected="selected"'; };
						if (current_time("m") == '06') { $select_month_07 = 'selected="selected"'; };
						if (current_time("m") == '07') { $select_month_08 = 'selected="selected"'; };
						if (current_time("m") == '08') { $select_month_09 = 'selected="selected"'; };
						if (current_time("m") == '09') { $select_month_10 = 'selected="selected"'; };
						if (current_time("m") == '10') { $select_month_11 = 'selected="selected"'; };
						if (current_time("m") == '11') { $select_month_12 = 'selected="selected"'; };
						if (current_time("Y") == '2020') { $select_year_2020 = 'selected="selected"'; };
						if (current_time("Y") == '2021') { $select_year_2021 = 'selected="selected"'; };
						if (current_time("Y") == '2022') { $select_year_2022 = 'selected="selected"'; };
						if (current_time("Y") == '2023') { $select_year_2023 = 'selected="selected"'; };
						if (current_time("Y") == '2024') { $select_year_2024 = 'selected="selected"'; };
						if (current_time("Y") == '2025') { $select_year_2025 = 'selected="selected"'; };
						if (current_time("m") == '12') { 
							$select_month_01 = 'selected="selected"'; 
							if (current_time("Y") == '2020') { $select_year_2021 = 'selected="selected"'; };
							if (current_time("Y") == '2021') { $select_year_2022 = 'selected="selected"'; };
							if (current_time("Y") == '2022') { $select_year_2023 = 'selected="selected"'; };
							if (current_time("Y") == '2023') { $select_year_2024 = 'selected="selected"'; };
							if (current_time("Y") == '2024') { $select_year_2025 = 'selected="selected"'; };
						};
					}
					?>
					
					<select class="choose_members_by_type" name="choose_members_by_type" id="choose_members_by_type" style="text-align-last: center;">
						<option value="maraphon_order">Марафон</option>
						<option value="menu_order">Меню</option>
						<option value="menu_order_new">Меню (новый, не работает пока)</option>
					<select>
					
					<select class="members_choose_month" name="choose_period_month" id="choose_period_month">
						<option <?php echo $select_month_01?> value="01">Январь</option>
						<option <?php echo $select_month_02?> value="02">Февраль</option>
						<option <?php echo $select_month_03?> value="03">Март</option>
						<option <?php echo $select_month_04?> value="04">Апрель</option>
						<option <?php echo $select_month_05?> value="05">Май</option>
						<option <?php echo $select_month_06?> value="06">Июнь</option>
						<option <?php echo $select_month_07?> value="07">Июль</option>
						<option <?php echo $select_month_08?> value="08">Август</option>
						<option <?php echo $select_month_09?> value="09">Сентябрь</option>
						<option <?php echo $select_month_10?> value="10">Октябрь</option>
						<option <?php echo $select_month_11?> value="11">Ноябрь</option>
						<option <?php echo $select_month_12?> value="12">Декабрь</option>
					</select>
					
					<select class="members_choose_year" name="choose_period_year" id="choose_period_year">
						<option <?php echo $select_year_2020?> value="2020">2020</option>
						<option <?php echo $select_year_2021?> value="2021">2021</option>
						<option <?php echo $select_year_2022?> value="2022">2022</option>
						<option <?php echo $select_year_2023?> value="2023">2023</option>
						<option <?php echo $select_year_2024?> value="2024">2024</option>
						<option <?php echo $select_year_2025?> value="2025">2025</option>
					</select>
					
					
					<input type="hidden" name="action" value="choosePeriodForAdmin"/>
					<input type="submit" id="updateuser" class="submit button" value="Сформировать">
				</form>
				
				<script type="text/javascript">
				jQuery('#choosePeriodForAdmin').submit(ajaxChoosePeriod);
				function ajaxChoosePeriod(){
				var choosePeriodData = jQuery(this).serialize();
				$.ajaxSetup({cache: false});
				jQuery.ajax({
				type:"POST",
				url: "/wp-admin/admin-ajax.php",
				data: choosePeriodData,
				success:function(data){
				$("#this_month_member").empty();
				$("#this_month_member").html(data);
				$(".members_choose_div").hide(); 
				}
				});
				return false;
				}
				</script>
						
				<div id="this_month_member">
				</div>
				
				<div class="members_choose_div">
				</div>	


		</div>
			

		</div> 
		
		<div id="tabu3" class="tabu-content">
			<div class="members_header_div"><p class="members_header">Отчет по результатам участников марафона</p></div>
			
		
				<form id="chooseResultPeriodForAdmin">
					
					<?php 
					if (current_time("m") == '01') { $select_month_01 = 'selected="selected"'; };
					if (current_time("m") == '02') { $select_month_02 = 'selected="selected"'; };
					if (current_time("m") == '03') { $select_month_03 = 'selected="selected"'; };
					if (current_time("m") == '04') { $select_month_04 = 'selected="selected"'; };
					if (current_time("m") == '05') { $select_month_05 = 'selected="selected"'; };
					if (current_time("m") == '06') { $select_month_06 = 'selected="selected"'; };
					if (current_time("m") == '07') { $select_month_07 = 'selected="selected"'; };
					if (current_time("m") == '08') { $select_month_08 = 'selected="selected"'; };
					if (current_time("m") == '09') { $select_month_09 = 'selected="selected"'; };
					if (current_time("m") == '10') { $select_month_10 = 'selected="selected"'; };
					if (current_time("m") == '11') { $select_month_11 = 'selected="selected"'; };
					if (current_time("m") == '12') { $select_month_12 = 'selected="selected"'; };
					?>
					
					<select class="members_choose_month" name="choose_period_month" id="choose_period_result_month">
						<option <?php echo $select_month_01?> value="01">Январь</option>
						<option <?php echo $select_month_02?> value="02">Февраль</option>
						<option <?php echo $select_month_03?> value="03">Март</option>
						<option <?php echo $select_month_04?> value="04">Апрель</option>
						<option <?php echo $select_month_05?> value="05">Май</option>
						<option <?php echo $select_month_06?> value="06">Июнь</option>
						<option <?php echo $select_month_07?> value="07">Июль</option>
						<option <?php echo $select_month_08?> value="08">Август</option>
						<option <?php echo $select_month_09?> value="09">Сентябрь</option>
						<option <?php echo $select_month_10?> value="10">Октябрь</option>
						<option <?php echo $select_month_11?> value="11">Ноябрь</option>
						<option <?php echo $select_month_12?> value="12">Декабрь</option>
					</select>

					<?php 
					if (current_time("Y") == '2020') { $select_year_2020 = 'selected="selected"'; };
					if (current_time("Y") == '2021') { $select_year_2021 = 'selected="selected"'; };
					if (current_time("Y") == '2022') { $select_year_2022 = 'selected="selected"'; };
					if (current_time("Y") == '2023') { $select_year_2023 = 'selected="selected"'; };
					if (current_time("Y") == '2024') { $select_year_2024 = 'selected="selected"'; };
					if (current_time("Y") == '2025') { $select_year_2025 = 'selected="selected"'; };
					?>
					
					<select class="members_choose_year" name="choose_period_year" id="choose_period_result_year">
						<option <?php echo $select_year_2020?> value="2020">2020</option>
						<option <?php echo $select_year_2021?> value="2021">2021</option>
						<option <?php echo $select_year_2022?> value="2022">2022</option>
						<option <?php echo $select_year_2023?> value="2023">2023</option>
						<option <?php echo $select_year_2024?> value="2024">2024</option>
						<option <?php echo $select_year_2025?> value="2025">2025</option>
					</select>
					
					
					<input type="hidden" name="action" value="chooseResultPeriodForAdmin"/>
					<input type="submit" id="updateuser" class="submit button" value="Сформировать">
				</form>
				
				<script type="text/javascript">
				jQuery('#chooseResultPeriodForAdmin').submit(ajaxResultChoosePeriod);
				function ajaxResultChoosePeriod(){
				var chooseResultPeriodData = jQuery(this).serialize();
				$.ajaxSetup({cache: false});
				jQuery.ajax({
				type:"POST",
				url: "/wp-admin/admin-ajax.php",
				data: chooseResultPeriodData,
				success:function(data){
				$("#this_month_result").empty();
				$("#this_month_result").html(data);
				$(".result_choose_div").hide(); 
				}
				});
				return false;
				}
				</script>
						
				<div id="this_month_result">
				</div>
				
				<div class="result_choose_div">
				</div>

		</div> <!-- div id="tabu3" -->
		
		<div id="tabu4" class="tabu-content">
			
		<div class="paid_header_div"><p class="paid_header">Отчет по заказам и оплатам</p></div>
		
		
				<form id="choosePeriodBy">
					
					<select name="choose_period_by_type" id="choose_period_by_type">
						<option value="menu_order_new">Продажи меню (новый)</option>
						<option value="workout_order">Продажи тренировок</option>
						<option value="menu_order">Продажи меню</option>
						<option selected="selected" value="date_order">Заказы марафона</option>
						<option value="period_order">Подтвержденные заказы</option>
						<option value="nomoney_order">Неоплаченные заказы</option>
						<option value="credit_order">Отсрочка заказа</option>
						<option value="lost_order">Потерянные клиенты</option>
					<select>
					
					
					<?php 
					if (current_time("m") == '01') { $selectDateMonth_01 = 'selected="selected"'; };
					if (current_time("m") == '02') { $selectDateMonth_02 = 'selected="selected"'; };
					if (current_time("m") == '03') { $selectDateMonth_03 = 'selected="selected"'; };
					if (current_time("m") == '04') { $selectDateMonth_04 = 'selected="selected"'; };
					if (current_time("m") == '05') { $selectDateMonth_05 = 'selected="selected"'; };
					if (current_time("m") == '06') { $selectDateMonth_06 = 'selected="selected"'; };
					if (current_time("m") == '07') { $selectDateMonth_07 = 'selected="selected"'; };
					if (current_time("m") == '08') { $selectDateMonth_08 = 'selected="selected"'; };
					if (current_time("m") == '09') { $selectDateMonth_09 = 'selected="selected"'; };
					if (current_time("m") == '10') { $selectDateMonth_10 = 'selected="selected"'; };
					if (current_time("m") == '11') { $selectDateMonth_11 = 'selected="selected"'; };
					if (current_time("m") == '12') { $selectDateMonth_12 = 'selected="selected"'; };
					
					?>
					
					<select style="margin-left: 21px;" name="choose_period_by_date_month" id="choose_period_by_date_month">
						<option <?php echo $selectDateMonth_01?> value="01">Январь</option>
						<option <?php echo $selectDateMonth_02?> value="02">Февраль</option>
						<option <?php echo $selectDateMonth_03?> value="03">Март</option>
						<option <?php echo $selectDateMonth_04?> value="04">Апрель</option>
						<option <?php echo $selectDateMonth_05?> value="05">Май</option>
						<option <?php echo $selectDateMonth_06?> value="06">Июнь</option>
						<option <?php echo $selectDateMonth_07?> value="07">Июль</option>
						<option <?php echo $selectDateMonth_08?> value="08">Август</option>
						<option <?php echo $selectDateMonth_09?> value="09">Сентябрь</option>
						<option <?php echo $selectDateMonth_10?> value="10">Октябрь</option>
						<option <?php echo $selectDateMonth_11?> value="11">Ноябрь</option>
						<option <?php echo $selectDateMonth_12?> value="12">Декабрь</option>
					</select>

					<?php 
					if (current_time("Y") == '2020') { $selectDateYear_2020 = 'selected="selected"'; };
					if (current_time("Y") == '2021') { $selectDateYear_2021 = 'selected="selected"'; };
					if (current_time("Y") == '2022') { $selectDateYear_2022 = 'selected="selected"'; };
					if (current_time("Y") == '2023') { $selectDateYear_2023 = 'selected="selected"'; };
					if (current_time("Y") == '2024') { $selectDateYear_2024 = 'selected="selected"'; };
					if (current_time("Y") == '2025') { $selectDateYear_2025 = 'selected="selected"'; };
					?>
					
					<select style="margin-bottom: 10px; margin-left: 5px;" name="choose_period_by_date_year" id="choose_period_by_date_year">
						<option <?php echo $selectDateYear_2020?> value="2020">2020</option>
						<option <?php echo $selectDateYear_2021?> value="2021">2021</option>
						<option <?php echo $selectDateYear_2022?> value="2022">2022</option>
						<option <?php echo $selectDateYear_2023?> value="2023">2023</option>
						<option <?php echo $selectDateYear_2024?> value="2024">2024</option>
						<option <?php echo $selectDateYear_2025?> value="2025">2025</option>
					</select>
					
					
					<input type="hidden" name="action" value="choosePeriodByFunc"/>
					<input style="" type="submit" id="updateuser" class="submit button" value="Сформировать">
				</form>
				
				<script type="text/javascript">
					$( document ).ready(function() {
						$("#choose_period_by_type").change(function() {
							var selected_value = $(this).val();
							var d = new Date(),
							day_now = d.getDate(),
							month_now = d.getMonth(),
							year_now = d.getFullYear();
							next_year = parseInt(year_now) + 1;
					       
					       if ( (day_now <= 5) && (selected_value=='period_order') ) {
							   if (month_now == 0) {$('#choose_period_by_date_month option[value="01"]').prop('selected', true);};
							   if (month_now == 1) {$('#choose_period_by_date_month option[value="02"]').prop('selected', true);};
							   if (month_now == 2) {$('#choose_period_by_date_month option[value="03"]').prop('selected', true);};
							   if (month_now == 3) {$('#choose_period_by_date_month option[value="04"]').prop('selected', true);};
							   if (month_now == 4) {$('#choose_period_by_date_month option[value="05"]').prop('selected', true);};
							   if (month_now == 5) {$('#choose_period_by_date_month option[value="06"]').prop('selected', true);};
							   if (month_now == 6) {$('#choose_period_by_date_month option[value="07"]').prop('selected', true);};
							   if (month_now == 7) {$('#choose_period_by_date_month option[value="08"]').prop('selected', true);};
							   if (month_now == 8) {$('#choose_period_by_date_month option[value="09"]').prop('selected', true);};
							   if (month_now == 9) {$('#choose_period_by_date_month option[value="10"]').prop('selected', true);};
							   if (month_now == 10) {$('#choose_period_by_date_month option[value="11"]').prop('selected', true);};
							   if (month_now == 11) {$('#choose_period_by_date_month option[value="12"]').prop('selected', true); $(`#choose_period_by_date_year option[value="${year_now}"]`).prop('selected', true);};
						   } else if ( (day_now > 5) && (selected_value=='period_order') ) {
							   if (month_now == 0) {$('#choose_period_by_date_month option[value="02"]').prop('selected', true);};
							   if (month_now == 1) {$('#choose_period_by_date_month option[value="03"]').prop('selected', true);};
							   if (month_now == 2) {$('#choose_period_by_date_month option[value="04"]').prop('selected', true);};
							   if (month_now == 3) {$('#choose_period_by_date_month option[value="05"]').prop('selected', true);};
							   if (month_now == 4) {$('#choose_period_by_date_month option[value="06"]').prop('selected', true);};
							   if (month_now == 5) {$('#choose_period_by_date_month option[value="07"]').prop('selected', true);};
							   if (month_now == 6) {$('#choose_period_by_date_month option[value="08"]').prop('selected', true);};
							   if (month_now == 7) {$('#choose_period_by_date_month option[value="09"]').prop('selected', true);};
							   if (month_now == 8) {$('#choose_period_by_date_month option[value="10"]').prop('selected', true);};
							   if (month_now == 9) {$('#choose_period_by_date_month option[value="11"]').prop('selected', true);};
							   if (month_now == 10) {$('#choose_period_by_date_month option[value="12"]').prop('selected', true);};
							   if (month_now == 11) {$('#choose_period_by_date_month option[value="01"]').prop('selected', true); $(`#choose_period_by_date_year option[value="${next_year}"]`).prop('selected', true);};
					       } else if ((day_now > 14) && (selected_value=='nomoney_order' || selected_value=='credit_order')) {
						       if (month_now == 0) {$('#choose_period_by_date_month option[value="02"]').prop('selected', true);};
							   if (month_now == 1) {$('#choose_period_by_date_month option[value="03"]').prop('selected', true);};
							   if (month_now == 2) {$('#choose_period_by_date_month option[value="04"]').prop('selected', true);};
							   if (month_now == 3) {$('#choose_period_by_date_month option[value="05"]').prop('selected', true);};
							   if (month_now == 4) {$('#choose_period_by_date_month option[value="06"]').prop('selected', true);};
							   if (month_now == 5) {$('#choose_period_by_date_month option[value="07"]').prop('selected', true);};
							   if (month_now == 6) {$('#choose_period_by_date_month option[value="08"]').prop('selected', true);};
							   if (month_now == 7) {$('#choose_period_by_date_month option[value="09"]').prop('selected', true);};
							   if (month_now == 8) {$('#choose_period_by_date_month option[value="10"]').prop('selected', true);};
							   if (month_now == 9) {$('#choose_period_by_date_month option[value="11"]').prop('selected', true);};
							   if (month_now == 10) {$('#choose_period_by_date_month option[value="12"]').prop('selected', true);};
							   if (month_now == 11) {$('#choose_period_by_date_month option[value="01"]').prop('selected', true); $(`#choose_period_by_date_year option[value="${next_year}"]`).prop('selected', true);};
						   } else if ((day_now <= 14) && (selected_value=='nomoney_order' || selected_value=='credit_order')) {
						       if (month_now == 0) {$('#choose_period_by_date_month option[value="01"]').prop('selected', true);};
							   if (month_now == 1) {$('#choose_period_by_date_month option[value="02"]').prop('selected', true);};
							   if (month_now == 2) {$('#choose_period_by_date_month option[value="03"]').prop('selected', true);};
							   if (month_now == 3) {$('#choose_period_by_date_month option[value="04"]').prop('selected', true);};
							   if (month_now == 4) {$('#choose_period_by_date_month option[value="05"]').prop('selected', true);};
							   if (month_now == 5) {$('#choose_period_by_date_month option[value="06"]').prop('selected', true);};
							   if (month_now == 6) {$('#choose_period_by_date_month option[value="07"]').prop('selected', true);};
							   if (month_now == 7) {$('#choose_period_by_date_month option[value="08"]').prop('selected', true);};
							   if (month_now == 8) {$('#choose_period_by_date_month option[value="09"]').prop('selected', true);};
							   if (month_now == 9) {$('#choose_period_by_date_month option[value="10"]').prop('selected', true);};
							   if (month_now == 10) {$('#choose_period_by_date_month option[value="11"]').prop('selected', true);};
							   if (month_now == 11) {$('#choose_period_by_date_month option[value="12"]').prop('selected', true); $(`#choose_period_by_date_year option[value="${year_now}"]`).prop('selected', true);};
						   } else if (selected_value=='date_order' || selected_value=='menu_order') {
						       if (month_now == 0) {$('#choose_period_by_date_month option[value="01"]').prop('selected', true);};
							   if (month_now == 1) {$('#choose_period_by_date_month option[value="02"]').prop('selected', true);};
							   if (month_now == 2) {$('#choose_period_by_date_month option[value="03"]').prop('selected', true);};
							   if (month_now == 3) {$('#choose_period_by_date_month option[value="04"]').prop('selected', true);};
							   if (month_now == 4) {$('#choose_period_by_date_month option[value="05"]').prop('selected', true);};
							   if (month_now == 5) {$('#choose_period_by_date_month option[value="06"]').prop('selected', true);};
							   if (month_now == 6) {$('#choose_period_by_date_month option[value="07"]').prop('selected', true);};
							   if (month_now == 7) {$('#choose_period_by_date_month option[value="08"]').prop('selected', true);};
							   if (month_now == 8) {$('#choose_period_by_date_month option[value="09"]').prop('selected', true);};
							   if (month_now == 9) {$('#choose_period_by_date_month option[value="10"]').prop('selected', true);};
							   if (month_now == 10) {$('#choose_period_by_date_month option[value="11"]').prop('selected', true);};
							   if (month_now == 11) {$('#choose_period_by_date_month option[value="12"]').prop('selected', true); $(`#choose_period_by_date_year option[value="${year_now}"]`).prop('selected', true);};
					       };
					});
					});
				
				</script>
				
				<script type="text/javascript">
				jQuery("#choosePeriodBy").submit(ajaxChoosePeriodBy);
				
				function ajaxChoosePeriodBy(){
				
				var choose_period_by_type = $("#choose_period_by_type").val();
				var choosePeriodData = jQuery(this).serialize();
				if (choose_period_by_type == "date_order") {
				choosePeriodData = choosePeriodData;
				$.ajaxSetup({cache: false});
				jQuery.ajax({
				type:"POST",
				url: "/wp-admin/admin-ajax.php",
				data: choosePeriodData,
				success:function(data){
				$("#this_month_paid").empty();
				$("#this_month_paid").html(data);
				$(".paid_choose_div").hide();
				}
				});
				return false;
				} 
				
				
				else if (choose_period_by_type == 'period_order') {
				choosePeriodData = choosePeriodData;
				$.ajaxSetup({cache: false});
				jQuery.ajax({
				type:"POST",
				url: "/wp-admin/admin-ajax.php",
				data: choosePeriodData,
				success:function(data){
				$("#this_month_paid").empty();
				$("#this_month_paid").html(data);
				$(".paid_choose_div").hide();
				}
				});
				return false;					
				}
				
				else if (choose_period_by_type == 'nomoney_order') {
				choosePeriodData = choosePeriodData;
				$.ajaxSetup({cache: false});
				jQuery.ajax({
				type:"POST",
				url: "/wp-admin/admin-ajax.php",
				data: choosePeriodData,
				success:function(data){
				$("#this_month_paid").empty();
				$("#this_month_paid").html(data);
				$(".paid_choose_div").hide();
				}
				});
				return false;					
				}
				
				else if (choose_period_by_type == 'credit_order') {
				choosePeriodData = choosePeriodData;
				$.ajaxSetup({cache: false});
				jQuery.ajax({
				type:"POST",
				url: "/wp-admin/admin-ajax.php",
				data: choosePeriodData,
				success:function(data){
				$("#this_month_paid").empty();
				$("#this_month_paid").html(data);
				$(".paid_choose_div").hide();
				}
				});
				return false;					
				}
				
				else if (choose_period_by_type == 'menu_order') {
				choosePeriodData = choosePeriodData;
				$.ajaxSetup({cache: false});
				jQuery.ajax({
				type:"POST",
				url: "/wp-admin/admin-ajax.php",
				data: choosePeriodData,
				success:function(data){
				$("#this_month_paid").empty();
				$("#this_month_paid").html(data);
				$(".paid_choose_div").hide();
				}
				});
				return false;					
				}
				
				else if (choose_period_by_type == 'menu_order_new') {
				choosePeriodData = choosePeriodData;
				$.ajaxSetup({cache: false});
				jQuery.ajax({
				type:"POST",
				url: "/wp-admin/admin-ajax.php",
				data: choosePeriodData,
				success:function(data){
				$("#this_month_paid").empty();
				$("#this_month_paid").html(data);
				$(".paid_choose_div").hide();
				}
				});
				return false;					
				}
				
				else if (choose_period_by_type == 'lost_order') {
				choosePeriodData = choosePeriodData;
				$.ajaxSetup({cache: false});
				jQuery.ajax({
				type:"POST",
				url: "/wp-admin/admin-ajax.php",
				data: choosePeriodData,
				success:function(data){
				$("#this_month_paid").empty();
				$("#this_month_paid").html(data);
				$(".paid_choose_div").hide();
				}
				});
				return false;					
				}
				
				else if (choose_period_by_type == 'workout_order') {
				choosePeriodData = choosePeriodData;
				$.ajaxSetup({cache: false});
				jQuery.ajax({
				type:"POST",
				url: "/wp-admin/admin-ajax.php",
				data: choosePeriodData,
				success:function(data){
				$("#this_month_paid").empty();
				$("#this_month_paid").html(data);
				$(".paid_choose_div").hide();
				}
				});
				return false;					
				}
				
				else if (choose_period_by_type == 'workout_members') {
				choosePeriodData = choosePeriodData;
				$.ajaxSetup({cache: false});
				jQuery.ajax({
				type:"POST",
				url: "/wp-admin/admin-ajax.php",
				data: choosePeriodData,
				success:function(data){
				$("#this_month_paid").empty();
				$("#this_month_paid").html(data);
				$(".paid_choose_div").hide();
				}
				});
				return false;					
				}
				
				
				};
				</script>
						
				<div id="this_month_paid">
				</div>	
				
				<div class="paid_choose_div"></div>
		</div>
		
		
		<div id="tabu5" class="tabu-content">
			<div class="members_header_div"><p class="members_header">Настройки марафона</p></div>
		
			<form id="chooseSettingsForm">
				<select class="choose_settings" name="choose_settings_by_type" id="choose_settings_by_type" style="text-align-last: center;">
					<option value="menu_settings">Меню</option>
					<option value="workout_settings">Тренировки</option>
					<option value="curator_settings">Кураторы</option>
				</select>
				
				<input type="hidden" name="action" value="chooseSettingsByType"/>
				<input style="" type="submit" id="updateuser" class="submit button" value="Сформировать">
			</form>
			
			<div id="settings_block"></div>
			<div class="paid_choose_div"></div>
			
			
			<script type="text/javascript">
				$("#chooseSettingsForm").submit(ajaxChooseSettings);
				
				function ajaxChooseSettings(){
					var chooseSettingsData = jQuery(this).serialize();
					$.ajaxSetup({cache: false});
					
						jQuery.ajax({
							type:"POST",
							url: "/wp-admin/admin-ajax.php",
							data: chooseSettingsData,
							success:function(data){
								$("#settings_block").empty();
								$("#settings_block").html(data);
								$(".paid_choose_div").hide();
							}
						});
						return false;
				};
			</script>
			
			
		</div> <!-- id="tabu5" class="tabu-content" -->
		
		<?php endif; ?>	

	</div>

	</main><!-- #main -->

<?php
get_footer();
?>