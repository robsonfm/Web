<?php
	
	require_once("funcoes_validar_login.php");
	$login = $_POST["login"];
	$senha = $_POST["senha"];

	$usuario_validado = valida_login($login,$senha);

	if($usuario_validado){
		echo "Acesso Liberado";

	}else{
		echo "Acesso Negado";
	}
?>