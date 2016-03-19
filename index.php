<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Trabalho da disciplina Modelos Evolucionários e Tratamento de Incertezas da faculdade UNISUL, para resolver o problema das 8 Rainhas." />
    <meta name="author" content="Rodrigo Sypriano Ribeiro">
    <title>8 Rainhas | Modelos Evolucionários e Tratamento de Incertezas</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/lightbox.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/rainbow/blackboard.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="images/ico/favicon.ico">
</head><!--/head-->

<body>
    <header id="header">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 overflow">
                   <div class="social-icons pull-right">
                        <ul class="nav nav-pills">
                            <li><a href="https://github.com/RodrigoSyprianoRibeiro/8rainhas" target="_blank"><i class="fa fa-github"></i></a></li>
                        </ul>
                    </div>
                </div>
             </div>
        </div>
        <div class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html">
                        <h1><img src="images/rainha.png" alt="logo"> 8 Rainhas</h1>
                    </a>

                </div>
            </div>
        </div>
    </header>
    <!--/#header-->

    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul id="tab1" class="nav nav-tabs">
                        <li class="active"><a href="#tab1-item1" data-toggle="tab">Jogo</a></li>
                        <li><a href="#tab1-item2" data-toggle="tab">Código</a></li>
                        <li><a href="#tab1-item3" data-toggle="tab">Sobre</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="tab1-item1">
                            <div class="col-sm-3 wow fadeIn text-center padding" data-wow-duration="1000ms" data-wow-delay="300ms">
                                <h2>Passos executados:</h2>
                                <h1 id="passos">0</h1>
                            </div>
                            <div class="col-sm-6 wow fadeIn text-center padding" data-wow-duration="1000ms" data-wow-delay="300ms">
                                <div id="quadro"></div>
                            </div>
                            <div class="col-sm-3 wow fadeIn text-center padding" data-wow-duration="1000ms" data-wow-delay="300ms">
                                <div class="row margin-bottom">
                                    <button type="button" id="busca" class="btn btn-lg btn-success">Busca solução</button>
                                </div>
                                <div class="row margin-bottom">
                                    <button type="button" id="parar" class="btn btn-lg btn-danger hide">Parar execução</button>
                                </div>
                                <div class="row">
                                    <button type="button" id="limpa" class="btn btn-lg btn-warning">Limpa tabuleiro</button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab1-item2">
                            <div class="col-sm-12 wow fadeIn" data-wow-duration="500ms" data-wow-delay="300ms">
                                <h2 class="page-header">Código <strong>Fonte</strong></h2>
                                <div class="col-md-12">
                                    <ul id="tab2" class="nav nav-tabs">
                                        <li class="active"><a href="#tab2-item1" data-toggle="tab">JS</a></li>
                                        <li><a href="#tab2-item2" data-toggle="tab">HTML</a></li>
                                        <li><a href="#tab2-item3" data-toggle="tab">CSS</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade active in" id="tab2-item1">
                                          <pre><code id="codigo-fonte-js" data-language="javascript"><?php include 'docs/js.txt'; ?></code></pre>
                                        </div>
                                        <div class="tab-pane fade" id="tab2-item2">
                                            <pre><code id="codigo-fonte-html" data-language="html"></code></pre>
                                        </div>
                                        <div class="tab-pane fade" id="tab2-item3">
                                            <pre><code id="codigo-fonte-css" data-language="css"></code></pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab1-item3">
                            <div class="col-sm-12 wow fadeIn" data-wow-duration="500ms" data-wow-delay="300ms">
                                <h2 class="page-header">Sobre o Desafio <strong>8 Rainhas</strong></h2>
                                <blockquote>
                                    <p>O desafio das 8 Rainhas tem como objetivo posicionar oito rainhas
                                    em um tabuleiro de xadrez de modo que nenhuma delas ataque nenhuma outra rainha.
                                    Será baseado nas propriedades da rainha de um jogo de xadrez.</p>

                                    <p>Podemos buscar uma solução eficiente para o problema estudando as propriedades
                                    das rainhas. Uma das propriedades da rainha é que não pode haver outra rainha na
                                    linha ou na coluna onde esta se encontra. Assim, na construção do algoritmo de
                                    solução, não tentaremos posicionar uma rainha em uma posição que esteja sendo atacada.
                                    Esta mesma propriedade também vale para as diagonais em relação as rainha já posicionadas.</p>
                                </blockquote>
                            </div>
                            <div class="col-sm-12 wow fadeIn" data-wow-duration="500ms" data-wow-delay="300ms">
                                <h2 class="page-header"><strong>Autores</strong></h2>
                                <blockquote>
                                    <p>Rodrigo Ribeiro e Taynara Rechia.</p>

                                    <footer>Trabalho da disciplina <cite title="Modelos Evolucionários e Tratamento de Incertezas">Modelos Evolucionários e Tratamento de Incertezas</cite>
                                    do curso de Ciência da Computação da UNISUL (Universidade do Sul de Santa Catarina).</footer>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/#services-->

    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center bottom-separator">
                    <img src="images/home/under.png" class="img-responsive inline" alt="">
                </div>
                <div class="col-sm-12">
                    <div class="copyright-text text-center">
                        <p>&copy; 8 Rainhas 2016. All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--/#footer-->

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/lightbox.min.js"></script>
    <script type="text/javascript" src="js/wow.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript" src="js/bootbox.js"></script>
    <script type="text/javascript" src="js/system.js"></script>
    <script type="text/javascript" src="js/rainbow/rainbow.min.js"></script>
    <script type="text/javascript" src="js/rainbow/language/generic.js"></script>
    <script type="text/javascript" src="js/rainbow/language/css.js"></script>
    <script type="text/javascript" src="js/rainbow/language/html.js"></script>
    <script type="text/javascript" src="js/rainbow/language/javascript.js"></script>
</body>
</html>
