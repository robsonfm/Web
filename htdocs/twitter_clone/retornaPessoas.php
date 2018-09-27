<?php

	session_start();
	if (!isset($_SESSION['usuario'])){
		header('Location: index.php?erro=1');
	}

	require_once('db.class.php');

	$id_usuario = $_SESSION['id_usuario'];

	$objDb = new db();
	$link = $objDb->conecta_mysql();

	$sql = "Select usuario FROM usuarios WHERE id <> $id_usuario";

	$resultado_id = mysqli_query($link, $sql);

	if($resultado_id){
		$dados = array();
		while ($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)) {
			$dados[] = $registro;
		}

	}else{
		echo 'Erro na consulta de tweets no banco de dados';
	}

	echo json_encode($dados);
?>