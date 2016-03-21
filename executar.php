<?php

require_once('AlgoritmosGeneticos.php');

if ($_POST) {

    $algoritimoGenetico = new AlgoritmosGeneticos($_POST);

    $algoritimoGenetico->geraPopulacaoInicial();

    while ($algoritimoGenetico->quantidadeGeracoes > 0) {
        $algoritimoGenetico->geraNovaPopulacao();
        $algoritimoGenetico->quantidadeGeracoes--;
    }

    echo json_encode($algoritimoGenetico->getMelhorCromossomo());
}