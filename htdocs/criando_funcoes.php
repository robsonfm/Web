<?php
	function primeira_funcao(){
		echo "Curso de PHP";
	}

	primeira_funcao();

	echo "<br>";

	function segunda_funcao($texto){
		echo $texto;
	}

	$texto = "Executando a segunda função";

	segunda_funcao($texto);

	echo "<br>";

	function calcular_soma($a, $b){
		return $a + $b;
	}

	echo calcular_soma(7,2);
?>