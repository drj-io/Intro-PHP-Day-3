<?php
$i1 = 8;
$i2 = 2;
$i3 = 6;

$result = calculate($i1, $i2, $i3);
	
function calculate( $i1,  $i2,  $i3){
		$difference = $i1-$i2-$i3;
			return divide($i1, $difference); 
}

function divide( $numerator,  $denominator){
		$calculatedResult = -1;
			try{
						if(!$denominator) throw new Exception('Division by zero.');
								$calculatedResult = $numerator/$denominator;
							}
			catch(Exception $e) {
						echo 'Caught exception: ',  $e->getMessage(), "\n", "\n";
								var_dump($e->getTraceAsString());	
							}
			
}

?>
