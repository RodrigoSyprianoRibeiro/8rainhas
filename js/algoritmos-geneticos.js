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
  }

  function buscarSolucao() {
    desabilitaBotoes();
    
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
  
  $(".knob").knob({
    draw: function () {

      if (this.$.data('skin') == 'tron') {

        var a = this.angle(this.cv)     // Angle
                , sa = this.startAngle  // Previous start angle
                , sat = this.startAngle // Start angle
                , ea                    // Previous end angle
                , eat = sat + a         // End angle
                , r = true;

        this.g.lineWidth = this.lineWidth;

        this.o.cursor
                && (sat = eat - 0.3)
                && (eat = eat + 0.3);

        if (this.o.displayPrevious) {
          ea = this.startAngle + this.angle(this.value);
          this.o.cursor
                  && (sa = ea - 0.3)
                  && (ea = ea + 0.3);
          this.g.beginPath();
          this.g.strokeStyle = this.previousColor;
          this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
          this.g.stroke();
        }

        this.g.beginPath();
        this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
        this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
        this.g.stroke();

        this.g.lineWidth = 2;
        this.g.beginPath();
        this.g.strokeStyle = this.o.fgColor;
        this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
        this.g.stroke();

        return false;
      }
    }
  });

  $('.inteiro').keyup(function() {
    var valor = $(this).val().replace(/[^0-9]+/g,'');
    $(this).val(valor);
  });
});