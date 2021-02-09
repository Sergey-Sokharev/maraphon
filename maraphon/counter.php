<?php
/*
Template Name: counter
*/

get_header();
?>

	<main id="primary" class="site-main">

	<div class="counter">
    
     <div class="opacity-line-counter-mobile">
       </div>
    <h1 class="h1-counter">Калькулятор норм КБЖУ</h1>
  <div class="card-body">
    
	<div class="display1">
		<h5 class="card-title">Внесите свои данные в поля</h5><br><small>Только целочисленные значения</small><hr>
		
		<div class="alert alert-danger error" role="alert">
			Заполните все поля!
		</div>
		
		<form>
		<div class="form-group">
			<label>Ваш пол</label><br>
			<div class="form-check form-check-inline">
			  <input class="form-check-input" type="radio" name="pol" id="inlineRadio1" value="Мужской">
			  <label class="form-check-label" for="inlineRadio1">&nbsp;Мужской</label>
			</div>
			<div class="form-check form-check-inline">
			  <input class="form-check-input" type="radio" name="pol" id="inlineRadio2" value="Женский" checked="check">
			  <label class="form-check-label" for="inlineRadio2"> &nbsp;Женский</label>
			</div>
		</div>
		  
		  <div class="form-group form-group-data">
			<label for="vozrast">Ваш возраст</label><br>
			<input type="number" class="form-control" id="ves" placeholder="Ваш возраст" name="vozrast" pattern="^[0-9]" title='Только целые числа' min="1" step="1">
		  </div>	
		  <div class="form-group form-group-data">
			<label for="rost">Ваш рост</label><br>
			<input type="number" class="form-control" id="ves" placeholder="Ваш рост" name="rost"  pattern="^[0-9]" title='Только целые числа' min="1" step="1">
		  </div>
		  <div class="form-group form-group-data">
			<label for="ves">Ваш вес</label><br>
			<input type="number" class="form-control" id="ves" placeholder="Ваш вес" name="ves"  pattern="^[0-9]" title='Только целые числа' min="1" step="1">
		  </div>
		
		<hr>
			<h5 class="card-title">Для точной нормы калорий вам необходимо определить коэффициент физической активности</h5>
        <br>
		<hr>
				
		<select class="select" name="active" style="width:100%;">
			<option value="1.25">[1.25]  Нет активности (офисная/сидячая работа, езда на транспорте) либо прогулки не менее часа, либо 1 тренировка в неделю</option>
			<option value="1.3">[1.3]  2-3 тренировки в неделю низкой интенсивности  (танцы, пилатес, домашние тренировки, бассейн)</option>
			<option value="1.35">[1.35]  2-3 тренировки в неделю средней интенсивности, фитнес, силовые, групповые интенсивные</option>
			<option value="1.375">[1.375]  Стабильно интенсивные от 3-х тренировок (50 мин) в неделю/силовые/фитнес</option>
			<option value="1.4">[1.4]  4-5 тренировки в неделю высокой интенсивности</option>
			<option value="1.45">[1.45]  5 и более интенсивных тренировок в неделю</option>
		</select>
		<br><br>
		<hr>
          <div class="alert alert-danger error" role="alert">
			Заполните все поля!
		</div>
		<br>
		<a href="#" class="btnc btn-block">Рассчитать</a>
		</form>
		<p style="width: 660px; text-align: center; margin: auto; margin-top: 10px; padding-bottom: 0px; font-size: 16px !important;">Нажимая на кнопку, вы даете согласие на обработку своих персональных данных и соглашаетесь с <a href="http://maraphon.online/privacy-policy/" target="_blank">политикой конфиденциальности</a></p> 
	</div>
	
	<div class="display2">
	
	<h5 class="card-title">Ваш индекс массы тела: <span class="imt"></span> <span class="desc" style="color:#FE634E">[Ожирение 1ой степени]</span></h5>

	<h5 class="card-title result-h5">Ниже калькулятор рассчитал вашу норму калорий:</h5>

	<table class="table table-bordered table-hover ">
	  <tbody>
		<tr>
		  <td>Ваш базовый метаболизм (основной обмен) минимальная норма</td>
		  <td class="base_metabolism"></td>
		</tr>
		<tr>
		  <td>Ваша норма калорий для поддержания веса (не набирать и не худеть)</td>
		  <td class="norma_calorii"></td>
		</tr>
		<tr>
		  <td>Дефицит калорий 20% (для похудения)</td>
		  <td class="deficit20"></td>
		</tr>
		<tr>
		  <td>Дефицит калорий 15% (для похудения)</td>
		  <td class="deficit15"></td>
		</tr>
		
	  </tbody>
	</table>
	
	<h5 class="card-title">Теперь чтобы вы активно худели, вам необходимо питаться:</h5>

	
	<table class="table table-bordered table-hover ">
	  <tbody>
		<tr>
		  <td>От</td>
		  <td class="deficit20"></td>
		</tr>
		<tr>
		  <td>До</td>
		  <td class="deficit15"></td>
		</tr>
		<tr>
		  <td>В дни ПМС, КД или в те дни, когда чувствуете голод, то питаться можно ДО <br>(это тоже будет похудение, но медленное и комфортное)</td>
		  <td class="golod"></td>
		</tr>
		<tr>
		  
		</tr>
		
	  </tbody>
	</table>
	
<!--	<h5 class="card-title">Ваши нормы белков, жиров и углеводов!</h5>

	
	<table class="table table-bordered table-hover ">
	  <tbody>
		<tr>
		  <td></td>
		  <td>От</td>
		  <td>До</td>
		</tr>
		<tr>
		  <td>ВАША НОРМА БЕЛКОВ</td>
		  <td class="norma_belkov_ot">82,48</td>
		  <td class="norma_belkov_do">111,34</td>
		</tr>
		<tr>
		  <td>ВАША НОРМА ЖИРОВ</td>
		  <td class="norma_jirov_ot">82,48</td>
		  <td class="norma_jirov_do">111,34</td>
		</tr>
		<tr>
		  <td>ВАША НОРМА УГЛЕВОДОВ</td>
		  <td class="norma_uglevodov_ot">82,48</td>
		  <td class="norma_uglevodov_do">111,34</td>
		</tr>
		<tr>
		  <td>ВАША НОРМА САХАРА</td>
		  <td>21</td>
		  <td>30</td>
		</tr>
		
	  </tbody>
	</table>
	
	<h5 class="card-title">Ниже ваша табличка с нормами.<br></h5>

	
	<table class="table table-bordered table-hover " style="border-color:#FE634E">
	  <tbody>
		<tr>
		  <td>Мой ВЕС</td>
		  <td class="ves"></td>
		  <td>кг</td>
		</tr>
		<tr>
		  <td>Мой РОСТ</td>
		  <td class="rost"></td>
		  <td>см</td>
		</tr>
		<tr>
		  <td>Мой ВОЗРАСТ</td>
		  <td class="vozrast"></td>
		  <td>лет</td>
		</tr>
		<tr>
		  <td>Моя активность</td>
		  <td class="active"></td>
		  <td></td>
		</tr>
		<tr>
		  <td>Мой индекс массы тела</td>
		  <td class="imt"></td>
		  <td></td>
		</tr>		
		<tr>
		  <td>Я воспользовалась понижающим коэффициентом</td>
		  <td class="pk"></td>
		  <td></td>
		</tr>
		<tr>
		  <td>Мой БАЗОВЫЙ метаболизм</td>
		  <td class="base_metabolism"></td>
		  <td>ккал в сутки</td>
		</tr>
		<tr>
		  <td>Моя норма калорий для поддержания веса</td>
		  <td class="norma_calorii"></td>
		  <td>ккал в сутки</td>
		</tr>
		<tr>
		  <td>Я буду худеть ОТ</td>
		  <td class="deficit20"></td>
		  <td>ккал в сутки</td>
		</tr>
		<tr>
		  <td>Я буду худеть ДО</td>
		  <td class="deficit15"></td>
		  <td>ккал в сутки</td>
		</tr>
		<tr>
		  <td>В дни ПМС, КД или в те дни, когда я буду чувствовать голод, то питаться можно ДО</td>
		  <td class="golod"></td>
		  <td>ккал в сутки</td>
		</tr>
		<tr>
		  <td>Белков кушать (от и до)</td>
		  <td class="norma_belkov_ot"></td>
		  <td class="norma_belkov_do"></td>
		</tr>
		<tr>
		  <td>Жиров кушать (от и до)</td>
		  <td class="norma_jirov_ot"></td>
		  <td class="norma_jirov_do"></td>
		</tr>
		<tr>
		  <td>Углеводов кушать (от и до)</td>
		  <td class="norma_uglevodov_ot"></td>
		  <td class="norma_uglevodov_do"></td>
		</tr>		
	  </tbody>
	</table>  -->
	
	<div class="alert alert-warning" role="alert" id="gv-table-div">
		ВНИМАНИЕ! Таблица не учитывает ГВ! Если вы на ГВ, то прибавьте к своим нормам дополнительное кол-во калорий:<br>
		<table class="table table-bordered table-hover" id="gv-table">
			<tr>
			  <td>0-3 мес</td>
			<!--  <td>450-500ккал/б-40/ж-20/у-40</td> -->
			<td>450-500 ккал</td>
			</tr>
			<tr>
			  <td>3-6 мес</td>
			<!--   <td>350-450ккал/б-35/ж-15/у-30</td> -->
			<td>350-450 ккал</td>
			</tr>
			<tr>
			  <td>6-9 мес</td>
			<!--   <td>250-350ккал/б-25/ж-10/у-20</td> -->
			<td>250-350 ккал</td>
			</tr>			
			<tr>
			  <td>9-12 мес</td>
			<!--   <td>100-250кал/б-20/ж-5/у-15</td> -->
			<td>100-250 ккал</td>
			</tr>

		</table>
	</div>
	<br>
	<div class="btnc btn-success btn-block re"><a href="#" >Пересчитать</a></div>
	
  </div>
 </div> 
  
  
<style>
    
    
    
</style>  
  
<script>
$('[name=ves]').bind("change keyup input click", function() {
if (this.value.match(/[^0-9]/g)) {
this.value = this.value.replace(/[^0-9]/g, '');
}
});
  $('[name=rost]').bind("change keyup input click", function() {
if (this.value.match(/[^0-9]/g)) {
this.value = this.value.replace(/[^0-9]/g, '');
}
});
  $('[name=vozrast]').bind("change keyup input click", function() {
if (this.value.match(/[^0-9]/g)) {
this.value = this.value.replace(/[^0-9]/g, '');
}
});
  
$('.btnc').click(function()
{
	var pol=$("input[name='pol']:checked").val();
	var desc="";
	
  	var ves = $("[name='ves']").val();
	var rost = $("[name='rost']").val();
	var rost2 = $("[name='rost']").val()*0.01;
	var vozrast = $("[name='vozrast']").val();
	var active = $("[name='active']").val();	
	var imt=ves/(rost2*rost2);

	imt=Math.round(imt);
	
	
	
	
	if (pol=="Женский")
	{
     	 var pk;
      
		if (imt<18) {desc="Дефицит веса"}
		if (imt>=19 && imt<24 ) {desc="[Норма]";}
		if (imt>=25 && imt<26 ) {desc="[Избыточный]";}
		if (imt>=27 && imt<29 ) {desc="[Предожирение]";}
		if (imt>=30 && imt<34 ) {desc="[1я степерь ожирения]";}
		if (imt>=35 && imt<40 ) {desc="[2я степерь ожирения]";}
		if (imt>=40 ) {desc="[3я степень ожирения и выше]";}
		
		/*if (imt<26) {pk=0;}
		if (imt>26 && imt<30 ) {pk=0.05;}
		if (imt>30 && imt<35 ) {pk=0.1;} 
		if (imt>35 && imt<40 ) {pk=0.15;} 
		if (imt>40 ) {pk=0.2;}*/
      
      	if (imt<26) {pk=0;}
		if (imt>=26 && imt<30 ) {pk=0.05;}
		if (imt>=30 && imt<35 ) {pk=0.1;} 
		if (imt>=35 && imt<40 ) {pk=0.15;} 
		if (imt>=40 ) {pk=0.2;}
      
		console.log(typeof pk);
      
		var base_metabolism=Math.round((655+(9.6*ves)+(1.8*rost)-(4.7*vozrast))-(655+(9.6*ves)+(1.8*rost)-(4.7*vozrast))*pk);
      
		var norma_calorii = Math.round(base_metabolism * active);
		var deficit20 = Math.round(norma_calorii-(norma_calorii*0.2));
		var deficit15 = Math.round(norma_calorii-(norma_calorii*0.15));
		var golod = Math.round(norma_calorii-norma_calorii*0.1);
		
		var norma_belkov_ot = Math.round((deficit20*0.25)/4);
		var norma_belkov_do = Math.round((golod*0.3)/4);
		
		var norma_jirov_ot = Math.round((deficit20*0.3)/9);
		var norma_jirov_do = Math.round((golod*0.35)/9);
		
		var norma_uglevodov_ot = Math.round((deficit20*0.35)/4);
		var norma_uglevodov_do = Math.round((golod*0.4)/4);
		
		
		
		console.log('Вес: '+ves);
		$('.ves').text(ves);
		
		console.log('Рост: '+rost);
		$('.rost').text(rost);
		
		console.log('Возраст: '+vozrast);
		$('.vozrast').text(vozrast);
		
		console.log('Активность: '+active);
		$('.active').text(active);
		
		console.log('ИМТ: '+imt);
		$('.imt').text(imt);
		
		console.log('ПК: '+pk);
		$('.pk').text(pk);
		
		console.log('Базовый метаболизм: ' + Math.round(base_metabolism));
		$('.base_metabolism').text(base_metabolism);
		
		console.log('Норма калорий: ' + Math.round(norma_calorii));
		$('.norma_calorii').text(norma_calorii);
		
		console.log('Дефицит калорий 20% : ' + Math.round(deficit20));
		$('.deficit20').text(deficit20);
		
		console.log('Дефицит калорий 15% : ' + Math.round(deficit15));
		$('.deficit15').text(deficit15);
		
		console.log('При голоде : ' + Math.round(golod));
		$('.golod').text(golod);
		
		console.log('Норма белков от : ' + norma_belkov_ot);
		$('.norma_belkov_ot').text(norma_belkov_ot);
		
		console.log('Норма белков до : ' + norma_belkov_do);
		$('.norma_belkov_do').text(norma_belkov_do);
		
		console.log('Норма жиров от : ' + norma_jirov_ot);
		$('.norma_jirov_ot').text(norma_jirov_ot);
		
		console.log('Норма жиров до : ' + norma_jirov_do);
		$('.norma_jirov_do').text(norma_jirov_do);
		
		console.log('Норма углеводов от : ' + norma_uglevodov_ot);
		$('.norma_uglevodov_ot').text(norma_uglevodov_ot);
		
		console.log('Норма углеводов до : ' + norma_uglevodov_do);
		$('.norma_uglevodov_do').text(norma_uglevodov_do);
		
		$('.desc').text(desc);
	}
	else
	/******МУЖЧИНЫ******/
	{
      	var pk;
		if (imt<=18) {desc="Дефицит веса"}
		if (imt>=19 && imt<27 ) {desc="[Норма]";}
		if (imt>=27 && imt<29 ) {desc="[Предожирение]";}
		if (imt>=30 && imt<34 ) {desc="[1я степерь ожирения]";}
		if (imt>=35 && imt<40 ) {desc="[2я степерь ожирения]";}
		if (imt>=40 ) {desc="[3я степень ожирения и выше]";}
		
		
		
		if (imt<27) {pk=0;}
		if (imt>=26 && imt<30 ) {pk=0.05;}
		if (imt>=30 && imt<35 ) {pk=0.1;} 
		if (imt>=35 && imt<40 ) {pk=0.15;} 
		if (imt>=40 ) {pk=0.2;}
		
		var base_metabolism=Math.round((65+(13.7*ves)+(5*rost)-(6.8*vozrast))-(65+(13.7*ves)+(5*rost)-(6.8*vozrast))*pk);
		var norma_calorii = Math.round(base_metabolism * active);
		var deficit20 = Math.round(norma_calorii-(norma_calorii*0.2));
		var deficit15 = Math.round(norma_calorii-(norma_calorii*0.15));
		var golod = Math.round(norma_calorii-norma_calorii*0.1);
		
		var norma_belkov_ot = Math.round((deficit20*0.25)/4);
		var norma_belkov_do = Math.round((golod*0.3)/4);
		
		var norma_jirov_ot = Math.round((deficit20*0.3)/9);
		var norma_jirov_do = Math.round((golod*0.35)/9);
		
		var norma_uglevodov_ot = Math.round((deficit20*0.35)/4);
		var norma_uglevodov_do = Math.round((golod*0.4)/4);
		
		
		
		console.log('Вес: '+ves);
		$('.ves').text(ves);
		
		console.log('Рост: '+rost);
		$('.rost').text(rost);
		
		console.log('Возраст: '+vozrast);
		$('.vozrast').text(vozrast);
		
		console.log('Активность: '+active);
		$('.active').text(active);
		
		console.log('ИМТ: '+imt);
		$('.imt').text(imt);
		
		console.log('ПК: '+pk);
		$('.pk').text(pk);
		
		console.log('Базовый метаболизм: ' + Math.round(base_metabolism));
		$('.base_metabolism').text(base_metabolism);
		
		console.log('Норма калорий: ' + Math.round(norma_calorii));
		$('.norma_calorii').text(norma_calorii);
		
		console.log('Дефицит калорий 20% : ' + Math.round(deficit20));
		$('.deficit20').text(deficit20);
		
		console.log('Дефицит калорий 15% : ' + Math.round(deficit15));
		$('.deficit15').text(deficit15);
		
		console.log('При голоде : ' + Math.round(golod));
		$('.golod').text(golod);
		
		console.log('Норма белков от : ' + norma_belkov_ot);
		$('.norma_belkov_ot').text(norma_belkov_ot);
		
		console.log('Норма белков до : ' + norma_belkov_do);
		$('.norma_belkov_do').text(norma_belkov_do);
		
		console.log('Норма жиров от : ' + norma_jirov_ot);
		$('.norma_jirov_ot').text(norma_jirov_ot);
		
		console.log('Норма жиров до : ' + norma_jirov_do);
		$('.norma_jirov_do').text(norma_jirov_do);
		
		console.log('Норма углеводов от : ' + norma_uglevodov_ot);
		$('.norma_uglevodov_ot').text(norma_uglevodov_ot);
		
		console.log('Норма углеводов до : ' + norma_uglevodov_do);
		$('.norma_uglevodov_do').text(norma_uglevodov_do);
		
		$('.desc').text(desc);

		/*$(".alert-warning").css("display","none");*/	
	}
	/**************************/




	$(".display1").css("display","none");
	$(".display2").css("display","block");
  
  	if (ves==="" || rost==="" || vozrast==="" ) 
    {
      	$(".display1").css("display","block");
		$(".display2").css("display","none");
     	$('.error').css("display","block");
        return false;
    }
	
});

$('.re').click(function()
{
	$(".display1").css("display","block");
	$(".display2").css("display","none");
    $('.error').css("display","none");
    $("[name='ves']").val("");
	$("[name='rost']").val("");
	$("[name='vozrast']").val("");
});	
</script>  
  
</div>


	</main><!-- #main -->

<?php
get_footer();
