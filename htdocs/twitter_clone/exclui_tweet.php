<?php	
	session_start();

	if (!isset($_SESSION['usuario'])){
		header('Location: index.php?erro=1');
	}

	require_once('db.class.php');
	
	$id_tweet = $_POST['tweet'];
	$id_usuario = $_POST['usuario'];

	if($id_tweet != '' && $id_usuario != '' && $id_usuario == $_SESSION['id_usuario']){
		$objDb = new db();
		$link = $objDb->conecta_mysql();

		$sql = "DELETE FROM tweet WHERE id_tweet = $id_tweet AND id_usuario = $id_usuario";

		mysqli_query($link, $sql);
	}
	
?>