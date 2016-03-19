$(function () {

  var rainhas = []; // vetor com as posições das rainhas no tabuleiro - o índice do vetor indica a coluna, e o valor a linha
  var passos = 0; // contador de passos até a solução
  var passosSemMudanca; // há quantos passos não houve mudança no tabuleiro - para detectar situações de estagnação
  var anterior = []; // estado anterior do tabuleiro - para detectar situações de estagnação
  var delay = 500; // delay entre iterações
  var emExecucao = false;

  montaTabuleiro();

  function montaTabuleiro() {
    var count = 0;
    var html = "<table id='tabuleiro'>";
    for (y = 0; y < 8; y++) {
      html += "<tr>";
      for (x = 0; x < 8; x++) {
        html += "<td y='"+y+"' x='"+x+"' class='c"+(count%2)+" celula'></td>";
        count++;
      }
      html += "</tr>";
      count++;
    }
    html += "</table>";
    $("#quadro").html(html);
    rainhas = [];
  }

  function buscarSolucao() {
    desabilitaBotoes();
    for (i = 0; i < 8; i++) { // garante que exista uma rainha em cada coluna
      if (rainhas[i] === undefined) { // se não existe uma rainha nessa coluna
        rainhas[i] = Math.floor(Math.random() * 8); // adiciona, em uma linha aleatória
      }
    }
    passos = 0;
    passosSemMudanca = 0;
    anterior = [];
    melhoraIterativa(0); // inicia o algoritmo de melhora iterativa, a partir da primeira coluna
  }

  function melhoraIterativa(i) { // tenta minimizar o número de conflitos na coluna i
    var min; // número mínimo de conflitos
    var opcoes = []; // array das posições com mínimo de conflitos
    var conflitos, y;

    if (exibeEstado()) { // atualiza tabuleiro na tela - prossegue se ainda houver conflitos
      if (emExecucao === true) {
        passos++;
        $("#passos").html(passos);
        conflitos = checaConflitos(i);
        min = conflitos; // inicializa número mínimo de conflitos
        opcoes = [rainhas[i]]; // inicializa lista de opções com a posição atual
        for (y = 0; y < 8; y++) {
          rainhas[i] = y;
          conflitos = checaConflitos(i);
          if (conflitos < min) { // se achou um menor número de conflitos
            min = conflitos; // atualiza mínimo
            opcoes = [y]; // reinicializa lista de opções com essa posição
          } else if (conflitos === min) { // se essa posição tem o número mínimo de conflitos
            opcoes.push(y); // adiciona à lista de opções
          }
        }
        y = Math.floor(Math.random() * opcoes.length); // escolhe uma das posições que tem o mínimo de conflitos
        rainhas[i] = opcoes[y]; // reposiciona rainha desta coluna

        if (comparaEstados(rainhas, anterior)) { // verifica se houve mudança no tabuleiro
          passosSemMudanca++;
        } else {
          anterior = copiaEstado(rainhas);
          passosSemMudanca = 0;
        }

        exibeEstado(); // exibe tabuleiro atualizado
        i = (i < 7) ? i + 1 : 0; // próxima coluna

        window.setTimeout(function() {
          melhoraIterativa(i);
        }, delay);  // nova iteração em n milissegundos
      }
    } else { // se não há conflitos no tabuleiro, encontrou uma solução!
      habilitaBotoes();
      modalAviso("Sucesso!", "Solução encontrada!");
    }
  }

  function checaConflitos(i) { // calcula número de conflitos da rainha na coluna i
    var conflitos = 0;
    for (x = 0; x < 8; x++) {
      if (x !== i) { // não compara coluna com ela própria.
        if (rainhas[i] === rainhas[x] || rainhas[i]+i === rainhas[x]+x || rainhas[i]+x === rainhas[x]+i) {
          conflitos++;
        }
      }
    }
    return conflitos;
  }

  function copiaEstado(estado) { // retorna uma cópia do estado
    var retorno = [];
    for (var i = 0; i < estado.length; i++) { // copia elementos do array
      retorno[i] = estado[i]; // necessário para evitar a cópia por referência
    }
    return retorno;
  }

  function comparaEstados(estado1, estado2) { // compara estados
    for (var i = 0; i < estado1.length; i++) {
      if (estado1[i] !== estado2[i]) {
        return false;
      }
    }
    return true;
  }

  function exibeEstado() { // atualiza tabuleiro na tela - retorna o número de conflitos
    var elemento;
    for (y = 0; y < 8; y++) {
      for (x = 0; x < 8; x++) {
        elemento = $('td[y="'+y+'"][x="'+x+'"]');
        if (elemento.hasClass("rainha")) {
          elemento.removeClass("rainha"); // remove a classe 'rainha' da célula
        }
        if (rainhas[x] !== undefined && y === rainhas[x]) {
          elemento.addClass("rainha");
        }
      }
    }
    return checaAtaques();
  }

  function checaAtaques() { // marca conflitos no tabuleiro e retorna o número de conflitos
    var conflitos = 0;
    $(".celula").removeClass("conflito"); // limpa status de conflitos das células do tabuleiro
    for (i = 0; i < rainhas.length - 1; i++) { // checa conflitos entre as rainhas no tabuleiro
      if (rainhas[i] !== undefined) {
        for (j = i + 1; j < rainhas.length; j++) {
          if (rainhas[i] === rainhas[j] || rainhas[i]+i === rainhas[j]+j || rainhas[i]+j === rainhas[j]+i) {
            $('td[y="'+rainhas[i]+'"][x="'+i+'"]').addClass("conflito");
            $('td[y="'+rainhas[j]+'"][x="'+j+'"]').addClass("conflito");
            conflitos++;
          }
        }
      }
    }
    return conflitos;
  }

  // Ação de clicar no tabuleiro para coloca/remove rainha na célula clicada pelo usuário
  $(document).on('click', '.celula', function(e) {
    e.preventDefault();
    if (emExecucao === false) {
      efetuaJogada($(this));
    }
  });

  // Ação do botão "Buscar solução" 
  $(document).on('click', '#buscar', function(e){
    e.preventDefault();
    emExecucao = true;
    buscarSolucao();
  });
  
  // Ação do botão "Parar execução" 
  $(document).on('click', '#parar', function(e){
    e.preventDefault();
    emExecucao = false;
    habilitaBotoes();
  });

  // Ação do botão "Limpar tabuleiro" 
  $(document).on('click', '#limpar', function(e){
    e.preventDefault();
    limparTabuleiro();
  });

  function limparTabuleiro() {
    emExecucao = false;
    rainhas = [];
    exibeEstado();
    passos = 0;
    $("#passos").html(0);
  }

  function efetuaJogada(elemento) {

    var y = parseInt(elemento.attr('y')); // pega linha
    var x = parseInt(elemento.attr('x')); // pega coluna

    if (elemento.hasClass("rainha")) { // já existe uma rainha na casa clicada
      elemento.removeClass("rainha"); // remove a classe 'rainha' da célula
      rainhas[x] = undefined;
    } else {
      if (rainhas[x] !== undefined) { // já existe uma rainha na mesma coluna
        $('td[y="'+rainhas[x]+'"][x="'+x+'"]').removeClass("rainha"); // remove
      }
      elemento.addClass("rainha"); // coloca a rainha na célula clicada
      rainhas[x] = y; // atualiza vetor
    }

    var tmp = checaAtaques(); // verifica conflitos
    var i = 0;
    for (x = 0; x < 8; x++) {
      if (rainhas[x] !== undefined) { // checa quantas rainhas estão no tabuleiro
        i++;
      }
    }
    if (i === 8 && tmp === 0) {
      modalAviso("Parabéns!", "Você solucionou o problema!");
    } else {
      passos++;
      $("#passos").html(passos);
    }
  }

  function habilitaBotoes() {
    $(".btn-success").removeClass("disabled");
    $(".btn-danger").addClass("hide");
    $(".btn-warning").removeClass("disabled");
  }

  function desabilitaBotoes() {
    $(".btn-success").addClass("disabled");
    $(".btn-danger").removeClass("hide");
    $(".btn-warning").addClass("disabled");
  }

  function modalAviso(titulo, mensagem) {
    bootbox.dialog({
      title: "<h3 class='smaller lighter no-margin'>"+titulo+"</h3>",
      message: "<h3>"+mensagem+"</h3>", 
      buttons: {
        danger: {
          label: "<i class='ace-icon fa fa-times'></i> Fechar",
          className: "btn btn-sm btn-danger pull-right"
        }
      }
    });
  }
  jQuery.get('docs/html.txt', function(data) {
    $('#codigo-fonte-html').html(data.replace('n',''));
  });
  jQuery.get('docs/css.txt', function(data) {
    $('#codigo-fonte-css').html(data.replace('n',''));
  });
});