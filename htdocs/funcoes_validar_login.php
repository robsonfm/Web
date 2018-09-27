<?php
	function valida_login($login,$senha){
		$login_bd = 'robson';
		$senha_bd = '123';

		if( $login_bd == $login && $senha_bd == $senha){
			return true;
		}else{
			return false;
		}
	}
?>