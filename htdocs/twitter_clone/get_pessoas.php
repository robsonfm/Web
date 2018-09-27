<?php
	
	session_start();

	if (!isset($_SESSION['usuario'])){
		header('Location: index.php?erro=1');
	}

	require_once('db.class.php');

	$nome_pessoa = $_POST['nome_pessoa'];
	$id_usuario = $_SESSION['id_usuario'];

	$objDb = new db();
	$link = $objDb->conecta_mysql();

	$sql = "SELECT u.*, us.* FROM usuarios AS u LEFT JOIN usuarios_seguidores AS us ON (us.id_usuario = $id_usuario AND u.id = us.seguindo_id_usuario) WHERE usuario LIKE '%$nome_pessoa%' AND id <> $id_usuario ORDER BY u.usuario";


	$resultado_id = mysqli_query($link, $sql);

	if($resultado_id){

		$sem_registros = true;

		while ($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)) {
			echo '<div>';
				echo '<a href="#" class="list-group-item">';
					echo '<strong>'.$registro['usuario'].'</strong><small> - '.$registro['email'].'</small>';
					
					$esta_seguindo_usuario_sn = isset($registro['id_usuario_seguidor']) && !empty($registro['id_usuario_seguidor']) ? 'S' : 'N';

					$btn_seguir_display = 'block';
					$btn_deixar_seguir_display = 'block';

					if ($esta_seguindo_usuario_sn == 'N'){
						$btn_deixar_seguir_display = 'none';
					}else{
						$btn_seguir_display = 'none';
					}

					echo '<p class="list-group-item-text pull-right">';
						echo '<buttom id="btn_seguir_'.$registro['id'].'" type="button" style="display: '.$btn_seguir_display.';" class="btn btn-primary btn_seguir" data-id_usuario="'.$registro['id'].'" >Seguir<buttom>';
					echo '</p>';
					echo '<p class="list-group-item-text pull-right">';
						echo '<buttom id="btn_deixar_seguir_'.$registro['id'].'" type="button" style="display: '.$btn_deixar_seguir_display.';" class="btn btn-danger btn_deixar_seguir" data-id_usuario="'.$registro['id'].'" >Deixar de Seguir<buttom>';
					echo '</p>';
					echo '<div class="clearfix"></div>';
				echo '</a>';
			echo '</div>';
			echo '<br>';
			$sem_registros = false;
		}

		if($sem_registros){
			echo '<div>';
				echo '<a href="#" class="list-group-item">';
					echo '<strong>Nenhum registro encontrado.</strong>';
				echo '</a>';
			echo '</div>';
		}

	}else{
		echo 'Erro na consulta de usuários no banco de dados';
	}

?>