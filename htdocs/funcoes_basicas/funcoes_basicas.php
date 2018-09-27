<?php
	$valor1 = 1;
	if(isset($valor1)){
		echo "Variável iniciada";
	}else{
		echo "Variável não iniciada";
	}

	/*is empty
	retorna true quando: '', 0, '0', false, null e array() 
	*/
	echo '<br>';

	$valor2 = 'assasa';

	if(empty($valor2)){
		echo "Variável Vazia";
	}else{
		echo "Variável não Vazia";
	}

	echo '<br>';

	$valor3 = '1asda';

	if(is_numeric($valor3)){
		echo "Variável numérica";
	}else{
		echo "Variável não numérica";
	}

?>