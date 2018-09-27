<?php
	
	class db
	{
		//host
		private $host = 'localhost';

		//usuario
		private $usuario = 'root';

		//senha
		private $senha = '';

		//banco de dados
		private $database = 'twitter_clone';

		public function conecta_mysql(){
			//criar a conexao
			$con = mysqli_connect($this->host, $this->usuario, $this->senha, $this->database);

			//ajustar o charset de comunicacao entre a aplicacao e o banco de dados
			mysqli_set_charset($con, 'utf8');

			//verificar se houve erro de conexão
			if(mysqli_connect_errno()){
				echo 'Erro ao tentar se concetar ao BD MySQL: '.mysqli_connect_error();
			}

			return $con;
		}
	}
?>