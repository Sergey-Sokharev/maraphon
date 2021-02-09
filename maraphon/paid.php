<?php
/*
Template Name: paid
*/
	get_header();
?>	
	
<div style="height: 1000px; padding-left: 30px; padding-top: 90px; padding-bottom: 150px; background-color: white;">
	<?php
	/*class Man {
		public $hair = 'русые';
		public $body = 'нормальное';
	}
	
	$masha = new Man();	
	$ivan = new Man();
	
	echo 'Волосы Маши - '.$masha->hair.'<br>';
	echo 'Волосы Ивана - '.$ivan->hair.'<br>';
	
	$masha->hair = 'белые';
	
	echo 'Волосы Маши - '.$masha->hair.'<br>';
	echo 'Волосы Ивана - '.$ivan->hair.'<br>';	
	
	$a = 5;
	$b = 10;
		
	function call ($a, $b) {
		$c = $a * $b;
		return $c;
	} */
	
	class ShopProduct {
		public $title = "Стандартный товар";
		public $producerMainName = "Фамилия автора";
		public $producerFirstName = "Имя автора";
		public $price = 0;
		
		function __construct ($title, $firstName, $lastName, $price ) {
			$this-> title = $title;
			$this->producerMainName = $lastName;
			$this->producerFirstName = $firstName;
			$this->price = $price;
		}
		
		function getProducer() {
			return $this->producerFirstName.' '.$this->producerMainName;
					
		}
	}
	
	$product1 = new ShopProduct("Собачье средце", "Михаил", "Булгаков", 5.99);
	

	
	print "Автор: {$product1->getProducer()}";
	

	?>			
	</div>
</div>

	</main><!-- #main -->

<?php
get_footer();
?>