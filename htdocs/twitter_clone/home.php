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

		<!-- bootstrap - link cdn -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

		<script type="text/javascript">
			
			$(document).ready(function(){
				
				
				//associar evento de click ao botao
				$('#btn_tweet').click(function(){
					
					if($('#texto_tweet').val().length > 0){
						incluirTweetnoBD();
					}

				});

				$('#texto_tweet').keypress(function(event){
					if ( event.which == 13 ) {
				        event.preventDefault();
				        incluirTweetnoBD();
				    }
				});

				var timer;

				$(document).on('mouseup', '.div_excluir', function(){
					clearTimeout(timer);
					return false;
				}).on('mousedown', '.div_excluir', function(){
					var clickedItem = this;
					var id_usuario = $(this).data('id_usuario');
					var id_tweet = $(this).data('id_tweet');
					timer = window.setTimeout(function(){

						$.ajax({
							url: 'exclui_tweet.php',
							method: 'post',
							data: {usuario: id_usuario, tweet: id_tweet},
							success: function(data){
								atualizaTweet();
								atualizaQtdTweets();
							}
						});	
					}, 1000);
					return false;
				});

				function incluirTweetnoBD(){
					$.ajax({
						url: 'inclui_tweet.php',
						method: 'post',
						data: {texto_tweet: $('#texto_tweet').val()},
						success: function(data){
							$('#texto_tweet').val('');
							atualizaTweet();
							atualizaQtdTweets();
						}
					});
				}

				function atualizaTweet(){
					$.ajax({
						url: 'get_tweet.php',
						success: function(data){
							$('#tweets').html(data);
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

				atualizaTweet();
				atualizaQtdTweets();
				atualizaQtdSeguidores();

			});

		</script>

		<style type="text/css">
			.div_excluir:hover{
				background: #F2F2F2;
				transition: all 0.2s;
			}



		</style>
	
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
	            <li><a href="sair.php">Sair</a></li>
	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	    </nav>


	    <div class="container">

	    	<div class="col-lg-3 teste">
	    		<div class="panel panel-default">
	    			<div class="panel-body">
	    				<h4><?= $_SESSION['usuario']?></h4>
	    				<hr/>
	    				<div id="qtd_tweets" class="col-md-6 panel panel-default"></div>
	    				<div id="qtd_seguidores" class="col-md-6 panel panel-default"></div>

	    			</div>
	    		</div>
	    	</div>
	    	<div class="col-lg-6">
	    		<div class="panel panel-default">
	    			<div class="panel-body">
	    				<div class="input-group">
	    					<input id="texto_tweet" type="text" class="form-control" placeholder="O que está acontecendo agora" maxlength="140" />
	    					<span class="input-group-btn">
	    						<button id="btn_tweet" class="btn btn-default" type="button">Tweet</button>
	    					</span>
	    				</div>
	    				
	    			</div>
	    		</div>

	    		<div id="tweets" class="list-group"></div>
	    		
			</div>
			<div class="col-lg-3">
				<div class="panel panel-default">
					<div class="panel-body">
						<h4><a href="procurar_pessoas.php">Procurar por Pessoas</a></h4>
					</div>
					
				</div>
			</div>


		</div>


	    </div>
	
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
	</body>
</html>