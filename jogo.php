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
                                    <button type="button" id="buscar" class="btn btn-lg btn-success">Buscar solução</button>
                                </div>
                                <div class="row margin-bottom">
                                    <button type="button" id="parar" class="btn btn-lg btn-danger hide">Parar execução</button>
                                </div>
                                <div class="row">
                                    <button type="button" id="limpar" class="btn btn-lg btn-warning">Limpar tabuleiro</button>
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
                                            <pre><code data-language="javascript"><?php include 'docs/js-jogo.txt'; ?></code></pre>
                                        </div>
                                        <div class="tab-pane fade" id="tab2-item2">
                                            <pre><code data-language="html"><?php include 'docs/html-jogo.txt'; ?><</code></pre>
                                        </div>
                                        <div class="tab-pane fade" id="tab2-item3">
                                            <pre><code data-language="css"><?php include 'docs/css.txt'; ?></code></pre>
                                        </div>
                                    </div>
                                </div>
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
