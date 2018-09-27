<?php

	session_start();

	require_once('db.class.php');

	$usuario = $_POST['usuario'];
	$email = $_POST['email'];
	$senha = md5($_POST['senha']);

	$objDb = new db();
	$link = $objDb->conecta_mysql();

	$usuario_existe = false;
	$email_existe = false;

	//verificar se usuario já existe
	$sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
	if ($resultado_id = mysqli_query($link, $sql)){
		$dados_usuario = mysqli_fetch_array($resultado_id);
		if(isset($dados_usuario['usuario'])){
			$usuario_existe = true;
		}
	}else{
		echo "Erro ao tentar localizar o registro do email";
	}


	//verificar se o email já existe
	$sql = "SELECT * FROM usuarios WHERE email = '$email'";
	if ($resultado_id = mysqli_query($link, $sql)){
		$dados_usuario = mysqli_fetch_array($resultado_id);
		if(isset($dados_usuario['email'])){
			$email_existe = true;
		}
	}else{
		echo "Erro ao tentar localizar o registro do usuário";
	}

	if($usuario_existe || $email_existe){
		$retorno_get = '';

		if($usuario_existe){
			$retorno_get.="erro_usuario=1&";
		}

		if($email_existe){
			$retorno_get.="erro_email=1&";
		}

		header('Location: inscrevase.php?'.$retorno_get);
	}else{
		$sql = "INSERT INTO usuarios(usuario, email, senha) values ('$usuario','$email','$senha')";

		//executar a query
		if(mysqli_query($link, $sql)){
			$sql = "SELECT id, usuario FROM usuarios WHERE usuario = '$usuario' AND email = '$email'";

			$resultado_id = mysqli_query($link, $sql);
		
			if ($resultado_id){
				$dados_usuario = mysqli_fetch_array($resultado_id);

				if(isset($dados_usuario['usuario'])){
					$_SESSION['id_usuario'] = $dados_usuario['id'];
					$_SESSION['usuario'] = $dados_usuario['usuario'];
					$_SESSION['email'] = $dados_usuario['email'];
					header('Location: home.php');
				}else{
					header('Location: index.php');
				}
			}else{
				echo 'Erro na execuçao da consulta, favor entrar em contato com o admin do site.';
			}

		}else{
			echo('Erro ao registrar o usuário!');
		}
	}
?>