<?php

	require_once('db.class.php');

	$objDb = new db();
	$link = $objDb->conecta_mysql();

	$sql = "SELECT * FROM usuarios";

	//executar a query
	$resultado_id = mysqli_query($link, $sql); 

	if ($resultado_id){
		$dados_usuario = array();

		while ($linha = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)) {
			$dados_usuario[] = $linha;
		}

		foreach ($dados_usuario as $usuario) {
			var_dump($usuario);
			echo "<br><br>";
		}
	}else{
		echo 'Erro na execuçao da consulta, favor entrar em contato com o admin do site.';
	}

?>