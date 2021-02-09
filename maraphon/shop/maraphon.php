<?php
/*
Template Name: shop-maraphon
*/

get_header();
?>	
	<script src="<?php echo content_url() ?>/themes/maraphon/js/jquery.maskedinput.js"></script>
	<style>
			#shop_header_block_1 {
				background-image: url(/wp-content/uploads/profy_price.png);
			}	
			#shop_header_block_2 {
				background-image: url(/wp-content/uploads/price-1900.png);
			}
			#shop_header_block_3 {
				background-image: url(/wp-content/uploads/price-3400.png);
			}
			#shop_header_block_4 {
				background-image: url(/wp-content/uploads/price-2000.png);
			}
			#shop_header_block_5 {
				background-image: url(/wp-content/uploads/vip-price.png);
			}
			.shop_menu_success_button {
	        	margin-top: -50px;
        	}
			@media screen and (max-width:1279px){
				.opacity-line {
				position: absolute;
				height: 65px;
				width: 720px;
				background-color: #d5d5d5;
				margin-top: 90px;
				opacity: 0.57;
				display: block;
        		}
        		.shop_main_block {
	        		height: 4410px;
        		}
        		#shop_block_1 {
	        		height: 695px;
        		}
        		#shop_block_2 {
	        		margin-bottom: 0px;
	        		height: 695px;
        		}
        		#shop_block_3 {
	        		margin-top: 120px;
	        		height: 735px;
				}
				#shop_block_4 {
	        		height: 740px;
				}
        		#shop_block_5 {
	        		margin-top: 120px;
	        		height: 765px;
	        		margin-bottom: 30px;
        		}
        		#shop_header_block_1 {
	        		margin-top: -137px;
	        		height: 298px;
	        	}
	        	#shop_header_block_2 {
	        		margin-top: -137px;
	        		height: 298px;
	        	}
	        	#shop_header_block_3 {
	        		margin-top: -131px;
	        	}
        		#shop_header_block_4 {
	        		margin-top: -137px;
	        		height: 298px;
	        	}
	        	#shop_header_block_5 {
	        		margin-top: -131px;
	        	}
	        	#vip_shop_menu_success_button {
		        	margin-top: -35px;
	        	}
			}	
			@media screen and (min-width:1279px){  
				.opacity-line {
				position: absolute;
				height: 70px;
				width: 1280px;
				background-color: #d5d5d5;
				margin-top: 90px;
        		}
        		.shop_main_block {
	        		height: 2330px;
        		}
        		.shop_block {
	        		margin-bottom: 0px;
        		}
        		#shop_block_1 {
	        		height: 580px;
        		}
        		#shop_block_2 {
	        		height: 580px;
        		}
        		
        		#shop_block_3 {
	        		margin-top: 120px;
        		}
        		#shop_block_4 {
	        		margin-top: 120px;
        		}
        		#shop_block_5 {
	        		margin-top: 120px;
	        		height: 670px;
        		}
        		#shop_header_block_1 {
	        		margin-top: -137px;
	        		height: 298px;
	        	}
	        	#shop_header_block_2 {
	        		margin-top: -137px;
	        		
	        	}
	        	#shop_header_block_3 {
	        		margin-top: -131px;
	        		
	        	}
        		#shop_header_block_4 {
	        		margin-top: -137px;
	        		height: 298px;
	        	}
	        	#shop_header_block_5 {
	        		margin-top: -131px;
	        	}
        		#vip_maraphon {
	        		margin-top: -10px;
        		}
			}	
	</style>
	
	<script type="text/javascript">
        //закрытие оформления заказа по крестику
				$(document).on("click", "#close_shop_order_table", function(event){
					$("#shop-order-table").hide();
					$(".shop_block").removeClass("changebox");
					var $checkbox = $('.shop_checkbox');
					$checkbox.prop('checked', 0);
					$(".shop_content_block").css("marginTop", "5px");
					$(".shop_content_block").css("marginLeft", "5px");
					$("#shop_header_block_1").css("marginTop", "-137px");
					$("#shop_header_block_2").css("marginTop", "-137px");
					$("#shop_header_block_3").css("marginTop", "-131px");
					$("#shop_header_block_5").css("marginTop", "-131px");
					if ($(window).width() < 1279) {
						$("#shop_header_block_1").css("marginLeft", "158px");
						$("#shop_header_block_2").css("marginLeft", "158px");
						$("#shop_header_block_3").css("marginLeft", "158px");
						$("#shop_header_block_5").css("marginLeft", "158px");
					} else {
						$("#shop_header_block_1").css("marginLeft", "116px");
						$("#shop_header_block_2").css("marginLeft", "116px");
						$("#shop_header_block_3").css("marginLeft", "116px");
						$("#shop_header_block_5").css("marginLeft", "116px");
					}
				});
	</script>
	<?php
	 $_monthsList = array(
					"1"=>"январе","2"=>"феврале","3"=>"марте",
					"4"=>"апреле","5"=>"мае", "6"=>"июне",
					"7"=>"июле","8"=>"августе","9"=>"сентябре",
					"10"=>"октябре","11"=>"ноябре","12"=>"декабре");
	$n = current_time("n") + 1 > 12 ? 1 : current_time("n") + 1;
	$next_month = $_monthsList[$n];
	?>

	<main id="primary" class="site-main" >
	
	<div class="shop_main_block">
		<h1 class="shop_h1" id="shop_h1_maraphon">Выберите пакет для участия в марафоне в <?php echo $next_month; ?></h1>
		
		<?php
		if ( is_user_logged_in() ) {
	 	custom_shop_confirmation_function();
		} else {
		custom_shop_registration_function();
		};
		
		function custom_shop_confirmation_function() {
			echo '
				<script type="text/javascript">
				$(function() {
				   function sendOrderByShopMaraphon(){
					  var sendOrderMaraphonValue = this.id;
					    $.ajaxSetup({cache: false});
				        $.ajax({
						    type:"POST",
							url: "/wp-admin/admin-ajax.php",
							data: {action: "sendOrderByShopMaraphon",
							sendOrderMaraphonValue,
							},
							success:function(data){
								if (sendOrderMaraphonValue == "newbie_maraphon") {
									$("#newbie_maraphon").remove();
									$("#shop_content_block_1" + " .shop_menu_success_button").show()
								} else if (sendOrderMaraphonValue == "newbie_light_maraphon") {
									$("#newbie_light_maraphon").remove();
									$("#shop_content_block_2" + " .shop_menu_success_button").show();
								} else if (sendOrderMaraphonValue == "family_maraphon") {
									$("#family_maraphon").remove();
									$("#shop_content_block_3" + " .shop_menu_success_button").show();
								} else if (sendOrderMaraphonValue == "profy_maraphon") {
									$("#profy_maraphon").remove();
									$("#shop_content_block_4" + " .shop_menu_success_button").show();
								} else if (sendOrderMaraphonValue == "vip_maraphon") {
									$("#vip_maraphon").remove();
									$("#shop_content_block_5" + " .shop_menu_success_button").show();
								};
								$("#primary").empty();
								$("#primary").html(data);
								//var url = "http://maraphon.online/thank-you";
								//top.location.replace(url);
							}
						});
							return false;
						}
						$(".buy_button").click(sendOrderByShopMaraphon);
						});
						
						
						
				</script>
			
			<form id="shop_main_form">
		
					<div class="shop_block" id="shop_block_1">
						<div class="shop_header_block" id="shop_header_block_1"></div>
				    	<div class="shop_content_block" id="shop_content_block_1">
						<br>
						<h3>Пакет "Новичок"</h3>
				   		<p>
					       <strong>Что вы получите:</strong><br>
						   - доступ к меню на 28 дней<br>
				           - доступ к тренировкам<br>
						   - доступ к разбору продуктов<br>
			     	       - доступ к энциклопедии красоты и здоровья<br>
			 		       - общий чат с мотивацией и поддержкой<br>
			 		       - личное сопровождение организатора марафона в Whatsapp<br>
					       - система ежедневных отчетов с обратной связью<br>
					       <br>
						</p>
						
							<div class="buy_button" id="newbie_maraphon"><p>Купить</p></div>
							<div class="shop_menu_success_button" style="display: none;"><p>Заказ успешно оформлен<br><a href="http://maraphon.online/lk/#tab5" target="_blank">Нажмите здесь</a> для обновления анкеты</p></div>
						</div>
					</div>
					
					<div class="shop_block" id="shop_block_2">
						<div class="shop_header_block" id="shop_header_block_2"></div>
				    	<div class="shop_content_block" id="shop_content_block_2">
						<br>
						<h3>Пакет "Новичок Лайт"</h3>
				   		<p>
					       <strong>Что вы получите:</strong><br>
						   - доступ к меню на 28 дней<br>
				           - <strong><span style="color: red">без доступа к тренировкам</span></strong><br>
						   - доступ к разбору продуктов<br>
			     	       - доступ к энциклопедии красоты и здоровья<br>
			 		       - общий чат с мотивацией и поддержкой<br>
			 		       - личное сопровождение организатора марафона в Whatsapp<br>
					       - система ежедневных отчетов с обратной связью<br>
					       <br>
						</p>
						
							<div class="buy_button" id="newbie_light_maraphon"><p>Купить</p></div>
							<div class="shop_menu_success_button" style="display: none;"><p>Заказ успешно оформлен<br><a href="http://maraphon.online/lk/#tab5" target="_blank">Нажмите здесь</a> для обновления анкеты</p></div>
						</div>
					</div>
							
					<div class="shop_block" id="shop_block_3">
						<div class="shop_header_block" id="shop_header_block_3"></div>
				    	<div class="shop_content_block" id="shop_content_block_3">
						<br>
						<h3>Пакет "Семейный"</h3>
				   		<p>
					       <strong>Что вы получите:</strong><br>
						   - доступ к женскому меню на 28 дней<br>
				           - доступ к тренировкам<br>
						   - доступ к разбору продуктов<br>
			     	       - доступ к энциклопедии красоты и здоровья<br>
			 		       - общий чат с мотивацией и поддержкой<br>
			 		       - личное сопровождение организатора марафона в Whatsapp<br>
					       - система ежедневных отчетов с обратной связью<br>
					       - <strong>доступ к мужскому меню на 30 дней</strong><br>
					       <br>
						</p>
							 <div class="buy_button" id="family_maraphon"><p>Купить</p></div>
							 <div class="shop_menu_success_button" style="display: none;"><p>Заказ успешно оформлен<br><a href="http://maraphon.online/lk/#tab5" target="_blank">Нажмите здесь</a> для обновления анкеты</p></div>
						</div>
					</div>
					
				    <div class="shop_block" id="shop_block_4">
				    	<div class="shop_header_block" id="shop_header_block_4">
				    	</div>
				    	<div class="shop_corner_label">
				    	</div>
				    	<div class="shop_label">
				    	</div>
				    	<div class="shop_content_block" id="shop_content_block_4">
					    	<br>
							<h3>Пакет "Профи"</h3>
					   		<p>
						       <strong>Что вы получите:</strong><br>
						       - доступ к меню на 28 дней<br>
						       - доступ к тренировкам<br>
						       - доступ к разбору продуктов<br>
						       - доступ к энциклопедии красоты и здоровья<br>
						       - общий чат с мотивацией и поддержкой<br>
						       - личное сопровождение организатора марафона в Whatsapp<br>
						       - <strong>скидка на мужское меню 30%</strong><br>
						       - <strong>система ежедневных отчетов с обратной связью каждые 4 дня</strong><br>
						    </p>';
						    
						    global $wpdb;
						    $current_user = wp_get_current_user();
						    $user_id = $current_user->ID;
						    //предыдущий месяц
						    $past_month = current_time("n") - 1 == 0 ? 12 : current_time("n") - 1;
						    if ($past_month < 10) {
							    $past_month = '0'.$past_month;
						    };
						    $past_year = current_time("n") - 1 == 0 ? current_time("Y") - 1 : current_time("Y");
						    $past_month_period = $past_month.'.'.$past_year;
						    //2 месяца назад
						    if (current_time("n") - 2 == 0) {
							    $past_month_2 = 12; $past_year_2 = current_time("Y") - 1;
						    	} else if (current_time("n") - 2 == -1) {
							    	$past_month_2 = 11; $past_year_2 = current_time("Y") - 1;
							    	} else {
								    	$past_month_2 = current_time("n") - 2; $past_year_2 = current_time("Y");
							};
							if ($past_month_2 < 10) {
							    $past_month_2 = '0'.$past_month_2;
						    };
						    $past_month_period_2 = $past_month_2.'.'.$past_year_2;
						   	//3 месяца назад
						    if (current_time("n") - 3 == 0) {
							    $past_month_3 = 12; $past_year_3 = current_time("Y") - 1;
						    	} else if (current_time("n") - 3 == -1) {
							    	$past_month_3 = 11; $past_year_3 = current_time("Y") - 1;
							    	} else if (current_time("n") - 3 == - 2) {
								    	$past_month_3 = 10; $past_year_3 = current_time("Y") - 1;
							    		} else {
								    		$past_month_3 = current_time("n") - 3; $past_year_3 = current_time("Y");
							};
							if ($past_month_3 < 10) {
							    $past_month_3 = '0'.$past_month_3;
						    };
						    $past_month_period_3 = $past_month_3.'.'.$past_year_3;					    
						    //текущий месяц
						    $this_month_period = current_time('m.Y');
						    
						    $check_profy_button = $wpdb->get_var( 
							"
							SELECT 
								COUNT(*)
								FROM wpux_orders orders
								WHERE user_id = $user_id
								AND (
								orders.maraphon_member_month = '$past_month_period_3' OR
								orders.maraphon_member_month = '$past_month_period_2' OR
								orders.maraphon_member_month = '$past_month_period' OR
								orders.maraphon_member_month = '$this_month_period'
								)
								AND orders.paid = 1
							"
							);
						    
						    if ($check_profy_button > 0 || is_user_role('administrator', $current_user->ID)) {
							    echo '
							    <style>
							    @media screen and (max-width:1279px){
								    .empty_text {
									    height: 18px;
								}
								}
								@media screen and (min-width:1279px){
									.empty_text {
									    height: 0px;
								}
								}
							    </style> 
							    
							    ';
							    echo '<div class="empty_text"></div>';
							    echo '<div class="buy_button" id="profy_maraphon"><p>Купить</p></div>';
								echo '<div class="shop_menu_success_button" style="display: none;"><p>Заказ успешно оформлен<br><a href="http://maraphon.online/lk/#tab5" target="_blank">Нажмите здесь</a> для обновления анкеты</p></div>';
						    } else {
								echo '
								<style>
							    #profy_m {
									background-color: #9d9d9d;
									color: white;
									font-size: 36px;
									font-family: kelson;
									border-radius: 3px;
									border: 1px solid;
									border-color: #ccc #ccc #bbb;
									height: 54px;
									width: 238px;
									padding-top: 2px;
									padding-left: 43px;
									margin-top: -10px;
								}
								#profy_m:hover {
									cursor: default;
								}
								@media screen and (max-width:1279px){
								#profy_m {
									display: none;
								}
								}
								@media screen and (min-width:1279px){
								#profy_m {
									display: none;
									/*margin-left: 173px;*/
								}
								}
							    </style>			
							    <p style="text-align: center; padding: 0 40px 0 40px;">
							       Приобрести пакет можно только после покупки пакета "Новичок", "Новичок Лайт", "Семейный" или "VIP"<br>
								</p>
								<div class="buy_button_newbie" id="profy_m"><p>Купить</p></div>
								';
						    };
							
						echo '</div>
					</div>
							
					<div class="shop_block" id="shop_block_5">
						<div class="shop_header_block" id="shop_header_block_5"></div>
				    	<div class="shop_content_block" id="shop_content_block_5">
						<br>
						<h3>Пакет "VIP"</h3>
				   		<p>
					       <strong>Что вы получите:</strong><br>
						   - доступ к меню на 28 дней<br>
				           - доступ к тренировкам<br>
						   - доступ к разбору продуктов<br>
			     	       - доступ к энциклопедии красоты и здоровья<br>
			 		       - общий чат с мотивацией и поддержкой<br>
					       - <strong>скидка на мужское меню 30%</strong><br>
					       - <strong>ежедневное личное сопровождение в Whatsapp</strong><br>
					       - <strong>возможность сохранить меню в .pdf формате</strong><br>
					       - <strong>индивидуальное составление тренировок для дома или зала</strong><br>
					       - <strong>книга рецептов в подарок</strong><br>
					       
						</p>
						<div class="buy_button" id="vip_maraphon"><p>Купить</p></div>
						<div class="shop_menu_success_button" id="vip_shop_menu_success_button" style="display: none;"><p>Заказ успешно оформлен<br><a href="http://maraphon.online/lk/#tab5" target="_blank" style="color: #fec300;">Нажмите здесь</a> для обновления анкеты</p></div>
						</div>
					</div>			
			
				</div>
			</form>						
				';
		};
		
		function custom_shop_registration_function() {
			$_monthsList = array(
						"1"=>"январь","2"=>"февраль","3"=>"март",
						"4"=>"апрель","5"=>"май", "6"=>"июнь",
						"7"=>"июль","8"=>"август","9"=>"сентябрь",
						"10"=>"октябрь","11"=>"ноябрь","12"=>"декабрь");
			$n = current_time("m")+ 1 > 12 ? 1 : current_time("m")+1;
			$next_month = $_monthsList[$n];
			$year = current_time("m") + 1 > 12 ? current_time("Y") +1 : current_time("Y");	
		    if (isset($_POST['submit'])) {
		        shop_validation(
		        $_POST['password'],
		        $_POST['email'],
		        $_POST['telephone'],
		        $_POST['first_name'],
		        $_POST['last_name'],
		        $_POST['newbie_maraphon'],
		        $_POST['newbie_light_maraphon'],
		        $_POST['family_maraphon'],
		        $_POST['profy_maraphon'],
		        $_POST['vip_maraphon'],
				); 
				
		        global $username, $password, $email, $telephone, $first_name, $last_name, $newbie_maraphon, $newbie_light_maraphon, $family_maraphon, $profy_maraphon, $vip_maraphon ;
		        $password 	= 	esc_attr($_POST['password']);
		        $email 		= 	sanitize_email($_POST['email']);
		        $telephone 	= 	sanitize_text_field($_POST['telephone']);
		        $first_name = 	sanitize_text_field($_POST['first_name']);
		        $last_name = 	sanitize_text_field($_POST['last_name']);
		        $newbie_maraphon = 	sanitize_text_field($_POST['newbie_maraphon']);
		        $newbie_light_maraphon = 	sanitize_text_field($_POST['newbie_light_maraphon']);
		        $family_maraphon = 	sanitize_text_field($_POST['family_maraphon']);
		        $profy_maraphon = 	sanitize_text_field($_POST['profy_maraphon']);
		        $vip_maraphon = 	sanitize_text_field($_POST['vip_maraphon']);
		       
		        complete_registration(
		        $username,
		        $password,
		        $email,
		        $telephone,
		        $first_name,
		        $last_name,
		        $newbie_maraphon,
		        $newbie_light_maraphon,
		        $family_maraphon,
		        $profy_maraphon,
		        $vip_maraphon
				);
		    }
		
		    registration_form(
		        $password,
		        $email,
		        $telephone,
		        $first_name,
		        $last_name,
		        $newbie_maraphon,
		        $newbie_light_maraphon,
		        $family_maraphon,
		        $profy_maraphon,
		        $vip_maraphon
				);
			}

			function registration_form( $password, $email, $telephone, $first_name, $last_name, $newbie_maraphon, $newbie_light_maraphon, $family_maraphon, $profy_maraphon, $vip_maraphon ) {
				
				$_monthsList = array(
						"1"=>"январь","2"=>"февраль","3"=>"март",
						"4"=>"апрель","5"=>"май", "6"=>"июнь",
						"7"=>"июль","8"=>"август","9"=>"сентябрь",
						"10"=>"октябрь","11"=>"ноябрь","12"=>"декабрь");
						
				$_monthsListPadezh = array(
						"1"=>"января","2"=>"февраля","3"=>"марта",
						"4"=>"апреля","5"=>"мая", "6"=>"июня",
						"7"=>"июля","8"=>"августа","9"=>"сентября",
						"10"=>"октября","11"=>"ноября","12"=>"декабря");
						
						$n = current_time("m")+ 1 > 12 ? 1 : current_time("m")+1;
						$this_month_padezh = $_monthsListPadezh[current_time("m")];
						$next_month = $_monthsList[$n];
						$next_month_padezh = $_monthsListPadezh[$n];
						$nn = current_time("m")+ 2 > 12 ? 1 : current_time("m")+2;
						$next_year = current_time("m") + 2 > 12 ? current_time("Y") +1 : current_time("Y");
						$nnext_month = $_monthsList[$nn];
						$year = current_time("m") + 1 > 12 ? current_time("Y") +1 : current_time("Y");
						
			    echo '
			    <style>
			    #profy_m {
					background-color: #9d9d9d;
				}
				#profy_m:hover {
					color: white;
					cursor: default;
				}
			    </style>
			    
			    
			    <script type="text/javascript">
			    $(document).on("click", "#newbie_m", function (e) {
		            var $checkbox = $("#newbie_maraphon");
		            if (e.target !== $checkbox[0]) {
		            $checkbox.prop("checked", !$checkbox.prop("checked"));
		            }
		            if ($("#newbie_maraphon").prop("checked")) {
			        $(".shop_block").removeClass("changebox");
					$("#shop_block_1").addClass("changebox");
					$("#shop-order-table").show();
					$("#shop_content_block_1").css("marginTop", "0px");
					$("#shop_content_block_1").css("marginLeft", "0px");
					$("#shop_header_block_1").css("marginTop", "-142px");
					
					} else {
					$("#shop_block_1").removeClass("changebox");
					};
					if ($(window).width() < 1279) {
						$("#shop-order-table").css("marginTop", "-3863px");
						$("#shop_header_block_1").css("marginLeft", "153px");
					} else {
						$("#shop-order-table").css("marginTop", "-2005px");
						$("#shop_header_block_1").css("marginLeft", "111px");
					}
		        });
		        
		        $(document).on("click", "#newbie_light_m", function (e) {
		            var $checkbox = $("#newbie_light_maraphon");
		            if (e.target !== $checkbox[0]) {
		            $checkbox.prop("checked", !$checkbox.prop("checked"));
		            }
		            if ($("#newbie_light_maraphon").prop("checked")) {
			        $(".shop_block").removeClass("changebox");
					$("#shop_block_2").addClass("changebox");
					$("#shop-order-table").show();
					$("#shop_content_block_2").css("marginTop", "0px");
					$("#shop_content_block_2").css("marginLeft", "0px");
					$("#shop_header_block_2").css("marginTop", "-142px");
					
					} else {
					$("#shop_block_2").removeClass("changebox");
					};
					if ($(window).width() < 1279) {
						$("#shop-order-table").css("marginTop", "-3103px");
						$("#shop_header_block_2").css("marginLeft", "153px");
					} else {
						$("#shop-order-table").css("marginTop", "-2005px");
						$("#shop_header_block_2").css("marginLeft", "111px");
					}
		        });
		        
				$(document).on("click", "#family_m", function (e) {
		            var $checkbox = $("#family_maraphon");
		            if (e.target !== $checkbox[0]) {
		            $checkbox.prop("checked", !$checkbox.prop("checked"));
		            }
		            if ($("#family_maraphon").prop("checked")) {
					$(".shop_block").removeClass("changebox");
					$("#shop_block_3").addClass("changebox");
					$("#shop-order-table").show();
					
					$("#shop_content_block_3").css("marginTop", "0px");
					$("#shop_content_block_3").css("marginLeft", "0px");
					$("#shop_header_block_3").css("marginTop", "-136px");
						
					} else {
					$("#shop_block_3").removeClass("changebox");
					};
					if ($(window).width() < 1279) {
						$("#shop-order-table").css("marginTop", "-2332px");
						$("#shop_header_block_3").css("marginLeft", "153px");
					} else {
						$("#shop-order-table").css("marginTop", "-1304px");
						$("#shop_header_block_3").css("marginLeft", "111px");
					}
		        });
		        
		        $(document).on("click", "#vip_m", function (e) {
		            var $checkbox = $("#vip_maraphon");
		            if (e.target !== $checkbox[0]) {
		            $checkbox.prop("checked", !$checkbox.prop("checked"));
		            }
		            if ($("#vip_maraphon").prop("checked")) {
					$(".shop_block").removeClass("changebox");
					$("#shop_block_5").addClass("changebox");
					$("#shop-order-table").show();
					
					$("#shop_content_block_5").css("marginTop", "0px");
					$("#shop_content_block_5").css("marginLeft", "0px");
					$("#shop_header_block_5").css("marginTop", "-136px");
						
					} else {
					$("#shop_block_5").removeClass("changebox");
					};
					if ($(window).width() < 1279) {
						$("#shop-order-table").css("marginTop", "-688px");
						$("#shop_header_block_5").css("marginLeft", "153px");
					} else {
						$("#shop-order-table").css("marginTop", "-574px");
						$("#shop_header_block_5").css("marginLeft", "111px");
					}
		        });
		        
		        </script>
			    
			    <form action="' . $_SERVER['REQUEST_URI'] . '" method="post" id="shop_main_form">
				    <div class="shop_block" id="shop_block_1">
						<div class="shop_header_block" id="shop_header_block_1"></div>
				    	<div class="shop_content_block" id="shop_content_block_1">
						<br>
						<h3>Пакет "Новичок"</h3>
				   		<p>
					       <strong>Что вы получите:</strong><br>
						   - доступ к меню на 28 дней<br>
				           - доступ к тренировкам<br>
						   - доступ к разбору продуктов<br>
			     	       - доступ к энциклопедии красоты и здоровья<br>
			 		       - общий чат с мотивацией и поддержкой<br>
			 		       - личное сопровождение организатора марафона в Whatsapp<br>
					       - система ежедневных отчетов с обратной связью<br>
					       <br>
						</p>
						
							<div class="buy_button" id="newbie_m"><p>Купить</p></div>
							<input class="shop_checkbox" type="checkbox" id="newbie_maraphon" name="newbie_maraphon" value="newbie_maraphon">
						</div>
					</div>
					
					<div class="shop_block" id="shop_block_2">
						<div class="shop_header_block" id="shop_header_block_2"></div>
				    	<div class="shop_content_block" id="shop_content_block_2">
						<br>
						<h3>Пакет "Новичок Лайт"</h3>
				   		<p>
					       <strong>Что вы получите:</strong><br>
						   - доступ к меню на 28 дней<br>
				           - <strong><span style="color: red">без доступа к тренировкам</span></strong><br>
						   - доступ к разбору продуктов<br>
			     	       - доступ к энциклопедии красоты и здоровья<br>
			 		       - общий чат с мотивацией и поддержкой<br>
			 		       - личное сопровождение организатора марафона в Whatsapp<br>
					       - система ежедневных отчетов с обратной связью<br>
					       <br>
						</p>
						
							<div class="buy_button" id="newbie_light_m"><p>Купить</p></div>
							<input class="shop_checkbox" type="checkbox" id="newbie_light_maraphon" name="newbie_light_maraphon" value="newbie_light_maraphon">
						</div>
					</div>
							
					<div class="shop_block" id="shop_block_3">
						<div class="shop_header_block" id="shop_header_block_3"></div>
				    	<div class="shop_content_block" id="shop_content_block_3">
						<br>
						<h3>Пакет "Семейный"</h3>
				   		<p>
					       <strong>Что вы получите:</strong><br>
						   - доступ к женскому меню на 28 дней<br>
				           - доступ к тренировкам<br>
						   - доступ к разбору продуктов<br>
			     	       - доступ к энциклопедии красоты и здоровья<br>
			 		       - общий чат с мотивацией и поддержкой<br>
			 		       - личное сопровождение организатора марафона в Whatsapp<br>
					       - система ежедневных отчетов с обратной связью<br>
					       - <strong>доступ к мужскому меню на 30 дней</strong><br>
					       <br>
						</p>
							 <div class="buy_button" id="family_m"><p>Купить</p></div>
							 <input class="shop_checkbox" type="checkbox" id="family_maraphon" name="family_maraphon" value="family_maraphon">
						</div>
					</div>
					
				    <div class="shop_block" id="shop_block_4">
				    	<div class="shop_header_block" id="shop_header_block_4">
				    	</div>
				    	<div class="shop_corner_label">
				    	</div>
				    	<div class="shop_label">
				    	</div>
				    	<div class="shop_content_block" id="shop_content_block_4">
					    	<br>
							<h3>Пакет "Профи"</h3>
					   		<p>
						       <strong>Что вы получите:</strong><br>
						       - доступ к меню на 28 дней<br>
						       - доступ к тренировкам<br>
						       - доступ к разбору продуктов<br>
						       - доступ к энциклопедии красоты и здоровья<br>
						       - общий чат с мотивацией и поддержкой<br>
						       - личное сопровождение организатора марафона в Whatsapp<br>
						       - <strong>скидка на мужское меню 30%</strong><br>
						       - <strong>система ежедневных отчетов с обратной связью каждые 4 дня</strong><br>
						    </p>';
							echo '		
							    <p style="text-align: center; padding: 0 40px 0 40px;">
							       Приобрести пакет можно только после покупки пакета "Новичок", "Новичок Лайт", "Семейный" или "VIP"<br>
								</p>
						</div>
					</div>
							
					<div class="shop_block" id="shop_block_5">
						<div class="shop_header_block" id="shop_header_block_5"></div>
				    	<div class="shop_content_block" id="shop_content_block_5">
							<br>
							<h3>Пакет "VIP"</h3>
					   		<p>
						       <strong>Что вы получите:</strong><br>
							   - доступ к меню на 28 дней<br>
					           - доступ к тренировкам<br>
							   - доступ к разбору продуктов<br>
				     	       - доступ к энциклопедии красоты и здоровья<br>
				 		       - общий чат с мотивацией и поддержкой<br>
						       - <strong>скидка на мужское меню 30%</strong><br>
						       - <strong>ежедневное личное сопровождение в Whatsapp</strong><br>
						       - <strong>возможность сохранить меню в .pdf формате</strong><br>
						       - <strong>индивидуальное составление тренировок для дома или зала</strong><br>
						       - <strong>книга рецептов в подарок</strong><br>
							</p>
							<div class="buy_button" id="vip_m"><p>Купить</p></div>
							<input class="shop_checkbox" type="checkbox" id="vip_maraphon" name="vip_maraphon" value="vip_maraphon">
						</div>
					</div>			
			
				</div>
							
				';
						
				echo '

					    <table class="register-main-table" id="shop-order-table" style="background-image: url();" >
						
						<tr style="height: 15px;">
							<td>
							<a class="close_result_user_for_admin" id="close_shop_order_table" title="Закрыть"> x</a>
							</td>
						</tr
						
						<tr>
						<td colspan="2"><p style="font-size: 20px; text-align: center">Для оформления заказа необходима регистрация<br>Пожалуйста, заполните короткую анкету</p></td>
						</tr>
						
						<tr>
						<th><label style="font-size: 36px;"><strong>Оформление заказа</strong></label></th>
						</tr>
						
						<tr>
						<th><label for="email">E-mail<strong> * </strong></label></th>
						<td><input type="text" name="email" value="' . (isset($_POST['email']) ? $email : null) . '"></td>
						</tr>
						
						<tr>
						<th><label for="password">Пароль<strong> * </strong><br></label><label style="font-size:14px;">(не менее 6 символов)</label></th>
						<td><input type="password" name="password" value="' . (isset($_POST['password']) ? $password : null) . '"></td>
						</tr>
		
						<script>
						    $(document).ready(function() {
						    $("#phone").mask("8-999-999-99-99");
						  });
						</script>
						
						<tr>
						<th><label for="telephone">Телефон<strong> * </strong></label></th>
						<td><input type="text" name="telephone" id="phone" value="' . (isset($_POST['telephone']) ? $telephone : null) . '"></td>
						</tr>
						
						<tr>
						<th><label for="first_name">Имя</label></th>
						<td><input type="text" name="first_name" value="' . (isset($_POST['first_name']) ? $first_name : null) . '"></td>
						</tr>
						
						<tr>
						<th><label for="last_name">Фамилия</label></th>
						<td><input type="text" name="last_name" value="' . (isset($_POST['last_name']) ? $last_name : null) . '"></td>
						</tr>
							
						<tr>
						<td><input type="submit" id="register_main_form_buy_button" name="submit" value="Отправить"/><td>
						</tr>
						
						<tr>
						<td>
						<p class="register_confidentional">Нажимая на кнопку, вы даете согласие на обработку своих персональных данных и соглашаетесь с <a href="http://maraphon.online/privacy-policy/" target="_blank">политикой конфиденциальности</a></p>
						</td>
						<td>
						</td>
						</tr>
						
						
						</table>
						';
				echo '	    				
				
				
				<div style="display:none">
						'.(isset($_POST['telegram']) ? $telegram : null).'
						'.(isset($_POST['men_menu']) ? $men_menu : null).'
						'.(isset($_POST['women_menu']) ? $women_menu : null).'
						'.(isset($_POST['recipe_book']) ? $recipe_book : null).'
						'.(isset($_POST['workout']) ? $workout : null).'
				</div>
				
				</form>  
				 
				</div>
				';
			} 

			function shop_validation( $password, $email, $telephone, $first_name, $last_name, $newbie_maraphon, $newbie_light_maraphon, $family_maraphon, $profy_maraphon, $vip_maraphon )  {
			    global $reg_errors;
			    $reg_errors = new WP_Error;
			    $email = trim($email);
			
			    if ( empty( $password ) || empty( $email ) || empty( $telephone) || empty( $first_name) || empty( $last_name) ) {
			        $reg_errors->add('field', 'заполните обязательные поля');
			    }
				
			    if ( strlen( $password ) < 6 ) {
			        $reg_errors->add('password', 'пароль не может быть менее 6 символов');
			    }
						        
			   /* if ( !is_email( $email ) ) {
			        $reg_errors->add('email_invalid', 'адрес e-mail введено некорректно');
			    } */
			
			    if ( email_exists( $email ) ) {
			        $reg_errors->add('email', 'адрес e-mail уже используется');
			    }
			    
			     if ( strlen( $telephone ) < 6 ) {
			        $reg_errors->add('telephone', 'номер телефона не может быть менее 6 символов');
			    }
			 
			    if ( is_wp_error( $reg_errors ) ) {
					echo '<div class="reg_error_div">';
			        foreach ( $reg_errors->get_error_messages() as $error ) {
			            echo '<div class="reg_error_message_1">';
			            echo '<strong>Ошибка</strong>: ';
			            echo $error . '<br/>';
			            echo '</div>';
			        }
			        echo '</div>';
			    }
			} 

			function complete_registration() {
			    global $wpdb, $reg_errors, $password, $email, $telephone, $first_name, $last_name, $newbie_maraphon, $newbie_light_maraphon, $family_maraphon, $profy_maraphon, $vip_maraphon ;
			    if ( count($reg_errors->get_error_messages()) < 1 ) {
				    
				    if ($family_maraphon == 'family_maraphon') {
			        $userdata_for_registration = array(
			        'user_login'	=> 	$email,
			        'user_email' 	=> 	$email,
			        'user_pass' 	=> 	$password,
			        'telephone' 	=> 	$telephone,
			        'first_name' 	=> 	$first_name,
			        'last_name' 	=> 	$last_name,
			        'maraphon_counter' => 0,
			        'workout_class' => 'Нет',
			        'men_menu_lk' => 'men_menu',
					);
					} else {
					$userdata_for_registration = array(
			        'user_login'	=> 	$email,
			        'user_email' 	=> 	$email,
			        'user_pass' 	=> 	$password,
			        'telephone' 	=> 	$telephone,
			        'first_name' 	=> 	$first_name,
			        'last_name' 	=> 	$last_name,
			        'maraphon_counter' => 0,
			        'workout_class' => 'Нет',
					);	
					};
					
					$next_month_confirm = current_time("n") + 1 > 12 ? 1 : current_time("n") + 1;
					$mail_month = $_monthsList[$next_month_confirm];
					if ($next_month_confirm < 10) {$next_month_confirm = '0'.$next_month_confirm;};
					$next_year_confirm = current_time("n") + 1 > 12 ? current_time("Y") + 1 : current_time("Y");
					$maraphon_member_month = $next_month_confirm.'.'.$next_year_confirm;
			        
			        $message  = sprintf(__('Здравствуйте, %s'), $first_name) . ",\n\n";
			        $message .= __('спасибо за ваш заказ и регистрацию на maraphon.online. Вы можете войти в личный кабинет, используя эти данные:') . "\n\n";
			        $message .= __('http://maraphon.online/lk') . "\n";
			        $message .= sprintf(__('Имя пользователя: %s'), $email) . "\n";
			        $message .= sprintf(__('Пароль: %s'), $password) . "\n\n";
			        $message .= __('Ваш заказ:') . "\n\n";
			        if (!empty($newbie_maraphon)){
				        $message .= __('- пакет "Новичок"') . "\n";
				        $order_maraphon_text = 'пакет "Новичок"';
				        $amount = 2500;
			        };
			         if (!empty($newbie_light_maraphon)){
				        $message .= __('- пакет "Новичок Лайт"') . "\n";
				        $order_maraphon_text = 'пакет "Новичок Лайт"';
				        $amount = 1900;
			        };
			        if (!empty($family_maraphon)){
				        $message .= __('- пакет "Семейный"') . "\n";
				        $order_maraphon_text = 'пакет "Семейный"';
				        $amount = 3400;
			        };
			        if (!empty($profy_maraphon)){
				        $message .= __('- пакет "Профи"') . "\n";
				        $order_maraphon_text = 'пакет "Профи"';
				        $amount = 1500;
			        };
			        if (!empty($vip_maraphon)){
				        $message .= __('- пакет "VIP"') . "\n";
				        $order_maraphon_text = 'пакет "VIP"';
				        $amount = 5500;
			        };
			        if (!empty($amount)){
				        $message .= __('--------------------------------------') . "\n";
				        $message .= __('Стоимость заказа - '.$amount.'р.') . "\n";
			        };
			        $message .= __('') . "\n";
			        $message .= __('В течение часа (с 09:00 до 00:00 ежедневно) с вами свяжется администратор марафона для уточнения деталей заказа и оплаты. Пожалуйста, ожидайте. ') . "\n\n";
			        $message .= sprintf(__('Если у вас возникли какие-то вопросы с регистрацией или входом, пожалуйста, свяжитесь с администратором по e-mail: %s'), get_option('admin_email')) . " либо по телефону 8-909-549-60-86\n\n";
			        $message .= __('----------------------------------------') . "\n";
			        $message .= __('Maraphon Online от Екатерины Войтенко. Красивая фигура - это просто!');
			        wp_mail($email, 'Спасибо за ваш заказ', $message, $headers, $attachments);
			
			
					$phone= str_replace([' ', '(', ')', '-', '_'], '', $telephone);
					$phone_whatsapp = preg_replace('/^8/', '+7', $phone);
					$phone_mail = preg_replace('/^7/', '8', $phone);                    
			        $message_a .= sprintf(__('Имя: %s'), $first_name) . " ";
			        $message_a .= sprintf(__('%s'), $last_name) . "\n";
			        $message_a .= sprintf(__('Телефон: %s'), $phone_mail) . "\n";
			        $message_a .= sprintf(__('Почта: %s'), $email) . "\n\n";
			        $message_a .= __('Заказ:') . "\n\n";
			        if (!empty($newbie_maraphon)){
				        $message_a .= __('- пакет "Новичок"') . "\n";
			        };
			        if (!empty($newbie_light_maraphon)){
				        $message_a .= __('- пакет "Новичок Лайт"') . "\n";
			        };
			        if (!empty($family_maraphon)){
				        $message_a .= __('- пакет "Семейный"') . "\n";
			        };
			        if (!empty($profy_maraphon)){
				        $message_a .= __('- пакет "Профи"') . "\n";
			        };
			        if (!empty($vip_maraphon)){
				        $message_a .= __('- пакет "VIP"') . "\n";
			        };
			        if (!empty($amount)){
				        $message_a .= __('--------------------------------------') . "\n";
				        $message_a .= __('Стоимость заказа - '.$amount.'р.') . "\n";
			        };
			        $message_a .= __('') . "\n";
			        $message_a .= sprintf(__('Написать клиенту в Whatsapp: https://api.whatsapp.com/send?phone=%s'), $phone_whatsapp) . "\n";
			        wp_mail('info@maraphon.online', 'Новый заказ с регистрацией на сайте', $message_a, $headers, $attachments);
			        		
						
						$date_func = current_time ('Y.m.d',0);
						$wpdb->insert(
						'wpux_orders',
						array( 
						'date' => $date_func,	
						'user_email' => $email,
						'telephone' => $telephone,
						'first_name' => $first_name,
						'last_name' => $last_name,
						'maraphon_next_month' => $order_maraphon_text,
						'maraphon_member_month' => $maraphon_member_month,
						'credit' => 0,
						'paid' => 0,
						'amount' => $amount,
						'curator' => 'Екатерина',
						'admin_comment' => '',
						'director_comment' => ''
						)
						);
						
						if ($family_maraphon == 'family_maraphon') {
							$amount = 0;
							$wpdb->insert(
								'wpux_orders',
								array(
									'date' => $date_func,	
									'user_email' => $email,
									'telephone' => $telephone,
									'first_name' => $first_name,
									'last_name' => $last_name,
									'men_menu' => 'men_menu',
									'credit' => 0,
									'paid' => 0,
									'amount' => $amount,
									'admin_comment' => 'Пакет Семейный',
									'director_comment' => 'Пакет Семейный'
								)
							);
						};
						
					$user = wp_insert_user( $userdata_for_registration );
					
				} //окончание условия reg_errors
			} // окончание функции custom_shop_function()
		
		?>
		
	</div> <!-- shop_main_block -->

	</div>
	</main><!-- #main -->

<?php
get_footer();