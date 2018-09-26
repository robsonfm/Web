var timerId = null; //variavel que armazena a chamada da função timeout 
var dificultade = null;

function iniciaJogo(){
	var url = window.location.search;
	
	dificultade = url.replace("?", "");
	var tempo_segundos = 0;
	
	if(dificultade == 1){//1 fácil -> 120segundos
		tempo_segundos = 120;
	}else if(dificultade == 2){ //2 normal -> 60segundos
		tempo_segundos = 60;
	}else if(dificultade == 3){//1 fácil -> 30segundos
		tempo_segundos = 30;
	}

	//inserindo segundos no span
	document.getElementById('cronometro').innerHTML = tempo_segundos;

	var qtde_baloes = 63;
	
	cria_baloes(qtde_baloes);

	//imprimir qtde de baloes inteiros
	document.getElementById('baloes_inteiros').innerHTML = qtde_baloes;

	document.getElementById('baloes_estourados').innerHTML = 0;

	contagem_tempo(tempo_segundos + 1);
}

function cria_baloes(qtde_baloes){
	for (var i = 1; i <= qtde_baloes; i++) {
		var balao = document.createElement("img");
		balao.src = 'imagens/balao_azul_pequeno.png';
		balao.style.margin = '10px';
		balao.style.padding = '5px';
		balao.id = 'b'+i;
		balao.onclick = function(){
			estourar(this);
		};

		document.getElementById('cenario').appendChild(balao);

	}
}

function contagem_tempo(segundos) {

	segundos--;

	if( segundos == -1){
		game_over();
		parar_jogo();
		tela_inicial();

	}else{
		document.getElementById('cronometro').innerHTML = segundos;

		timerId  = setTimeout("contagem_tempo("+segundos+")",1000);
	}
	
}

function game_over(){
	alert('Fim de jogo. Você não conseguiu estourar todos os balões a tempo');
}

function estourar(e){
	var id_balao = e.id;

	document.getElementById(id_balao).setAttribute("onclick","");

	document.getElementById(id_balao).src = 'imagens/balao_azul_pequeno_estourado.png';
	pontuacao();

}

function pontuacao(){
	var baloes_inteiros = document.getElementById('baloes_inteiros').innerHTML;
	var baloes_estourados = document.getElementById('baloes_estourados').innerHTML;

	baloes_inteiros = parseInt(baloes_inteiros);
	baloes_estourados = parseInt(baloes_estourados);

	baloes_inteiros--;
	baloes_estourados++;

	document.getElementById('baloes_inteiros').innerHTML = baloes_inteiros;
	document.getElementById('baloes_estourados').innerHTML = baloes_estourados;

	situacao_jogo(baloes_inteiros);

}

function situacao_jogo(baloes_inteiros){
	if (baloes_inteiros == 0){

		var dificul = null;
		var time = null;

		if(dificultade == 1){//1 fácil -> 120segundos
			dificul = 'Fácil';
			time = 120;
		}else if(dificultade == 2){ //2 normal -> 60segundos
			dificul = 'Normal';
			time = 60;
		}else if(dificultade == 3){//1 fácil -> 30segundos
			dificul = 'Difícil';
			time = 30;
		}

		var texto_resultado1 = 'Parabéns!!!';
		var texto_resultado2 ='Você conseguiu estourar todos os balões a tempo!';
		var texto_resultado3 ='A dificultade escolhida foi: '+ dificul;
		var texto_resultado4 ='Tempo: '+document.getElementById('cronometro').innerHTML+' / '+time;
		/*alert('Parabéns, você conseguiu estourar todos os balões a tempo!\nA dificultade escolhida foi: '+ dificul+'\nTempo: '
			+document.getElementById('cronometro').innerHTML+' / '+time);*/
		document.getElementById('parabens').innerHTML = texto_resultado1;
		document.getElementById('mensagem').innerHTML = texto_resultado2;
		document.getElementById('dificuldadofinal').innerHTML = texto_resultado3;
		document.getElementById('tempo_restante').innerHTML = texto_resultado4;
		parar_jogo();
		//tela_inicial();
	}
}

function parar_jogo(){
	clearTimeout(timerId);
}

function tela_inicial(){
	window.location.href = 'index.html';
}