var rodada = 1;
var matriz_jogo = Array(3);

matriz_jogo['a'] = Array(3);

matriz_jogo['a'][1] = 0;
matriz_jogo['a'][2] = 0;
matriz_jogo['a'][3] = 0;

matriz_jogo['b'] = Array(3);

matriz_jogo['b'][1] = 0;
matriz_jogo['b'][2] = 0;
matriz_jogo['b'][3] = 0;

matriz_jogo['c'] = Array(3);

matriz_jogo['c'][1] = 0;
matriz_jogo['c'][2] = 0;
matriz_jogo['c'][3] = 0;

$(document).ready(function(){

	
	$('#btn_iniciar_jogo').click( function(){
		//Valdia a digitacao dos apelidos dos jogadores
		if($('#entrada_apelido_jogador_1').val() == ''){
			alert('Apelido do jogador 1 não foi digitado.')
			return false;
		} else if($('#entrada_apelido_jogador_2').val() == ''){
			alert('Apelido do jogador 2 não foi digitado.')
			return false;
		}

		//exibir os apelidos
		$('#nome_jogador_1').html($('#entrada_apelido_jogador_1').val());
		$('#nome_jogador_2').html($('#entrada_apelido_jogador_2').val());

		//Muda Visualização das divs
		$('#pagina_inicial').hide();
		$('#palco_jogo').show();

		
	});

	$('.jogada').click( function(){
		var id_campo_clicado = this.id;
		$('#'+id_campo_clicado).off();
		jogada(id_campo_clicado);
	});

	function jogada(id){
		var icone = '';
		var ponto = 0;

		if ( rodada%2 == 1){
			//vez do jogador 1
			ponto = -1;
			icone = 'url("imagens/marcacao_1.png")';
		}else{
			//vex do jogador 2
			ponto = 1;
			icone = 'url("imagens/marcacao_2.png")';
		}

		$('#'+id).css('background-image',icone);
		rodada++;
		matriz_jogo[id[0]][id[2]] = ponto;

		console.log(matriz_jogo);

		verifica_combinacao();

	}

	function verifica_combinacao(){
		var pontos = 0;
		//verifica na horizontal
		for (var i = 1; i <= 3; i++){
			pontos = pontos + matriz_jogo['a'][i];
		}
		ganhador(pontos);

		pontos = 0;
		for (var i = 1; i <= 3; i++){
			pontos = pontos + matriz_jogo['b'][i];
		}
		ganhador(pontos);

		pontos = 0;
		for (var i = 1; i <= 3; i++){
			pontos = pontos + matriz_jogo['c'][i];
		}
		ganhador(pontos);

		//verifica na vertical
		for (var i = 1; i<=3; i++){
			pontos = 0;
			pontos = pontos + matriz_jogo['a'][i];
			pontos = pontos + matriz_jogo['b'][i];
			pontos = pontos + matriz_jogo['c'][i];
			ganhador(pontos);
		}

		//verifica na diagonal
		pontos = 0;
		pontos = matriz_jogo['a'][1]+matriz_jogo['b'][2]+matriz_jogo['c'][3];
		ganhador(pontos);

		pontos = 0;
		pontos = matriz_jogo['a'][3]+matriz_jogo['b'][2]+matriz_jogo['c'][1];
		ganhador(pontos);
	}

	function ganhador(pontos){
		if (pontos == -3){
			alert($('#entrada_apelido_jogador_1').val()+' é o vencedor');
			$('.jogada').off();
		}else if( pontos == 3){
			alert($('#entrada_apelido_jogador_2').val()+' é o vencedor');
			$('.jogada').off();
		}
	}


});