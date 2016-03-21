<?php

require_once('library/Log.php');
require_once('AlgoritmosGeneticos.php');

if ($_POST) {

    $inicioExecucao = date('Y-m-d H:i:s');
  
    $algoritimoGenetico = new AlgoritmosGeneticos($_POST);

    $algoritimoGenetico->geraPopulacaoInicial();

    while ($algoritimoGenetico->quantidadeGeracoes > 0 && count($algoritimoGenetico->populacao) > 0) {

        $algoritimoGenetico->geraNovaPopulacao();

        $melhorUltimoCromossomo = $algoritimoGenetico->getMelhorCromossomo();

        if ($melhorUltimoCromossomo !== null) {
            $melhorCromossomo = $melhorUltimoCromossomo;
        }

        $algoritimoGenetico->quantidadeGeracoes--;
    }

    $fimExecucao = date('Y-m-d H:i:s');
    Log::escreveArquivo("log.txt", $inicioExecucao, $fimExecucao, $melhorCromossomo, $_POST);

    echo json_encode($melhorCromossomo);
}