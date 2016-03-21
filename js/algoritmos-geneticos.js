$(function () {

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
  };

  // Ação do botão "Buscar solução" 
  $(document).on('click', '#buscar', function(e){
    e.preventDefault();
    buscarSolucao();
  });

  function buscarSolucao() {
    var dados = $('#parametros').serialize();
    $.ajax({
      dataType: "json",
      type: 'POST',
      url: 'executar.php',
      async: true,
      data: dados,
      success: function(response) {
        exibeEstado(response.vetor);
        modalAviso("Teminou!", "<h3><b>Geração: </b>" + response.geracao + "</h3>\n\
                                <h3><b>Aptidão: </b>" + response.aptidao + "</h3>\n\
                                <h3><b>Fenotipo: </b>" + response.vetor + "</h3>");
                                
      },
      beforeSend: function(){
        desabilitaBotoes();
        abreModalCarregando();
      },
      complete: function(){
        habilitaBotoes();
        fechaModalCarregando();
      }
    });
  };

  // Ação do botão "Limpar tabuleiro" 
  $(document).on('click', '#limpar', function(e){
    e.preventDefault();
    limparTabuleiro();
  });

  function exibeEstado(vetor) { // atualiza tabuleiro na tela - retorna o número de conflitos
    limparTabuleiro();
    for (i = 0; i < 8; i++) {
      $('td[y="'+vetor[i]+'"][x="'+i+'"]').addClass("rainha");
    }
    checaAtaques(vetor);
  }

  function checaAtaques(vetor) { // marca conflitos no tabuleiro
    for (i = 0; i < 7; i++) {
      for (j = i + 1; j < 8; j++) {
        if (vetor[i] === vetor[j] || vetor[i]+i === vetor[j]+j || vetor[i]+j === vetor[j]+i) {
          $('td[y="'+vetor[i]+'"][x="'+i+'"]').addClass("conflito");
          $('td[y="'+vetor[j]+'"][x="'+j+'"]').addClass("conflito");
        }
      }
    }
  }

  function limparTabuleiro() {
    $(".celula").removeClass("rainha");
    $(".celula").removeClass("conflito");
  }

  function habilitaBotoes() {
    $(".btn-success").removeClass("disabled");
    $(".btn-warning").removeClass("disabled");
  }

  function desabilitaBotoes() {
    $(".btn-success").addClass("disabled");
    $(".btn-warning").addClass("disabled");
  }

  function modalAviso(titulo, mensagem) {
    bootbox.dialog({
      title: "<h3 class='smaller lighter no-margin'>"+titulo+"</h3>",
      message: mensagem,
      buttons: {
        danger: {
          label: "<i class='ace-icon fa fa-times'></i> Fechar",
          className: "btn btn-sm btn-danger pull-right"
        }
      }
    });
  }

  function abreModalCarregando() {
    $('html, body').animate({ scrollTop: $("body").offset().top }, 'slow');
    var id = '.carregando';
    var maskHeight = $(document).height();
    var maskWidth = $(window).width();
    $('#mask').css({'width':maskWidth,'height':maskHeight});
    $('#mask').fadeIn(1000);
    $('#mask').fadeTo("slow",0.8);
    var winH = $(window).height();
    var winW = $(window).width();
    $(id).css('top',  winH/2-$(id).height()/2);
    $(id).css('left', winW/2-$(id).width()/2);
    $(id).fadeIn(2000);
  };

  function fechaModalCarregando() {
    $('#mask').hide();
    $('.window').hide();
  };

  $("#populacao_inicial").ionRangeSlider({
    min: 0,
    max: 500,
    from: 20,
    type: 'single',
    step: 10,
    postfix: " indivíduos",
    prettify: false,
    hasGrid: true
  });

  $("#quantidade_geracoes").ionRangeSlider({
    min: 0,
    max: 100,
    from: 20,
    type: 'single',
    step: 1,
    postfix: " gerações",
    prettify: false,
    hasGrid: true
  });

  $(".percentagem").ionRangeSlider({
    min: 0,
    max: 100,
    type: 'single',
    step: 1,
    postfix: "%",
    prettify: false,
    hasGrid: true
  });
});