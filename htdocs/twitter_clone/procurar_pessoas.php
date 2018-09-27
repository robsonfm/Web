<?php
	session_start();
	if (!isset($_SESSION['usuario'])){
		header('Location: index.php?erro=1');
	}
?>

<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">

		<title>Twitter clone</title>
		
		<!-- jquery - link cdn -->
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

		<!-- jquery ui-->
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

		<!-- bootstrap - link cdn -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

		<script type="text/javascript">
			
			$(document).ready(function(){
				//associar evento de click ao botao
				$('#btn_procurar_pessoa').click(function(){

					if($('#nome_pessoa').val().length > 0){
						pesquisarPessoas();
					}

				});

				$('#nome_pessoa').keypress(function(event){
					if ( event.which == 13 ) {
				        event.preventDefault();
				        pesquisarPessoas();
				    }
				});

				// Captura o retorno do retornaPessoas.php
		        $.getJSON('retornaPessoas.php', function(data){
		            var pessoas = [];
		             
		            // Armazena na array capturando somente o nome do usuario
		            $(data).each(function(key, value) {
		                pessoas.push(value.usuario);
		            });
		             
		            // Chamo o Auto complete do JQuery ui setando o id do input, array com os dados e o mínimo de caracteres para disparar o AutoComplete
		            $('#nome_pessoa').autocomplete({ source: pessoas, minLength: 1});
		        });

				function pesquisarPessoas(){
					$.ajax({
						url: 'get_pessoas.php',
						method: 'post',
						data: $('#form_procurar_pessoas').serialize(),
						success: function(data){
							$('#pessoas').html(data);

							$('.btn_seguir').click(function(){
								var id_usuario = $(this).data('id_usuario');

								$('#btn_seguir_'+id_usuario).hide();
								$('#btn_deixar_seguir_'+id_usuario).show();

								$.ajax({
									url: 'seguir.php',
									method: 'post',
									data: {seguir_id_usuario: id_usuario},
									success: function(data){
										
									}
								});
							});

							$('.btn_deixar_seguir').click(function(){
								var id_usuario = $(this).data('id_usuario');

								$('#btn_deixar_seguir_'+id_usuario).hide();
								$('#btn_seguir_'+id_usuario).show();
								
								$.ajax({
									url: 'deixar_seguir.php',
									method: 'post',
									data: {deixar_seguir_id_usuario: id_usuario},
									success: function(data){
										
									}
								});
							});
						}
					});

				}

				function atualizaQtdTweets(){
					$.ajax({
						url: 'conta_tweets.php',
						success: function(data){
							$('#qtd_tweets').html(data);
						}
					});
				}

				function atualizaQtdSeguidores(){
					$.ajax({
						url: 'conta_seguidores.php',
						success: function(data){
							$('#qtd_seguidores').html(data);
						}
					});
				}

				atualizaQtdTweets();
				atualizaQtdSeguidores();

			});

		</script>
	
	</head>

	<body>

		<!-- Static navbar -->
	    <nav class="navbar navbar-default navbar-static-top">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <img src="imagens/icone_twitter.png" />
	        </div>
	        
	        <div id="navbar" class="navbar-collapse collapse">
	          <ul class="nav navbar-nav navbar-right">
	            <li><a href="home.php">Home</a></li>
	            <li><a href="sair.php">Sair</a></li>
	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	    </nav>


	    <div class="container">

	    	<div class="col-md-3">
	    		<div class="panel panel-default">
	    			<div class="panel-body">
	    				<h4><?= $_SESSION['usuario']?></h4>
	    				<hr/>
	    				<div id="qtd_tweets" class="col-md-6 panel panel-default" ></div>
	    				<div id="qtd_seguidores" class="col-md-6 panel panel-default"></div>

	    			</div>
	    		</div>
	    	</div>
	    	<div class="col-md-6">
	    		<div class="panel panel-default">
	    			<div class="panel-body">
	    				<form id ="form_procurar_pessoas" class="input-group">
	    					<input id="nome_pessoa" name="nome_pessoa" type="text" class="form-control" placeholder="Quem você está procurando" maxlength="140" />
	    					<span class="input-group-btn">
	    						<button id="btn_procurar_pessoa" class="btn btn-default" type="button">Procurar</button>
	    					</span>
	    				</form>
	    				
	    			</div>
	    		</div>

	    		<div id="pessoas" class="list-group"></div>
	    		
			</div>
			<div class="col-md-3">
			</div>


		</div>


	    </div>
	
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
	</body>
</html>