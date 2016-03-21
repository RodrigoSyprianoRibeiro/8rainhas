<?php

require_once('Cromossomo.php');

if ($_POST) {

    $geracaoAtual = 1;

    // Parametros passados
    $quantidadePopulacaoInicial = 20; // Quantidade da população inicial.
    $quantidadeGeracoes = 20 - 1; // Quantidade de quantas vezes vai gerar população nova.
    $quantidadeSelecao = 0.5; // Quantidade da população que vai ser selecionada para a nova população.
    $quantidadeCrossover = 1; // Quantidade da população que vai fazer Crossover.
    $quantidadeMutacao = 0.1; // Quantidade da população que vai sofrer Mutação.
    $pontoCorte = 4; // Ponto de corte do vetor para fazer recombinação.

    $populacao = array();

    geraPopulacaoInicial();

    while ($quantidadeGeracoes > 0) {
        geraNovaPopulacao();
        $quantidadeGeracoes--;
    }

    usort($populacao, 'ordenador');

    function geraPopulacaoInicial() {

        global $quantidadePopulacaoInicial, $geracaoAtual, $populacao;

        for ($i = 0; $i < $quantidadePopulacaoInicial; $i++) {
            $cromossomo = new Cromossomo($geracaoAtual);
            $cromossomo->geraVetor();
            $cromossomo->calculaAptidao();
            array_push($populacao, $cromossomo);
        }
    }

    function geraNovaPopulacao() {

        global $geracaoAtual;

        $geracaoAtual++;

        selecaoEletista();

        crossover();

        mutacao();
    }

    function selecaoEletista() {

        global $populacao, $quantidadeSelecao;

        usort($populacao, 'ordenador');

        $totalPopulacao = (int) (count($populacao) * $quantidadeSelecao);

        $populacaoEletista = array();
        for ($i = 0; $i < $totalPopulacao; $i++) {
            array_push($populacaoEletista, $populacao[$i]);
        }

        $populacao = $populacaoEletista;
        unset($populacaoEletista);
    }

    function crossover() {

        global $populacao;

        $populacaoCrossover = geraPopulacaoCrossover();

        for ($i = 0; $i < count($populacaoCrossover); $i+=2) {
            aplicarCrossoverCutAndCrossfill($populacaoCrossover[$i], $populacaoCrossover[$i+1]);
        }

        $populacao = array_merge($populacao, $populacaoCrossover);
        unset($populacaoCrossover);
    }

    function geraPopulacaoCrossover() {

        global $populacao, $quantidadeCrossover;

        $totalCrossover = (int) (count($populacao) * $quantidadeCrossover);

        $populacaoCrossover = array();
        while ($totalCrossover > 0) {

            $numeroAleatorio = rand(0, count($populacao)-1);
            array_push($populacaoCrossover, $populacao[$numeroAleatorio]);
            unset($populacao[$numeroAleatorio]);
            sort($populacao);

            $totalCrossover--;
        }
        return $populacaoCrossover;
    }

    function aplicarCrossoverCutAndCrossfill($cromossomo1, $cromossomo2) {

        global $geracaoAtual, $pontoCorte, $populacao;

        $cromossomoFilho1 = new Cromossomo($geracaoAtual);
        $cromossomoFilho2 = new Cromossomo($geracaoAtual);

        $cromossomoFilho1->geraVetorCrossoverCutAndCrossfill(
                $cromossomo1->getVetor(),
                $cromossomo2->getVetor(),
                $pontoCorte);

        $cromossomoFilho2->geraVetorCrossoverCutAndCrossfill(
                $cromossomo2->getVetor(),
                $cromossomo1->getVetor(),
                $pontoCorte);

        $cromossomoFilho1->calculaAptidao();
        $cromossomoFilho2->calculaAptidao();

        array_push($populacao, $cromossomoFilho1);
        array_push($populacao, $cromossomoFilho2);
    }

    function mutacao() {

        global $populacao, $quantidadeMutacao;

        $totalMutacao = (int) (count($populacao) * $quantidadeMutacao);

        while ($totalMutacao > 0) {

            $numeroAleatorio = rand(0, count($populacao)-1);
            aplicarMutacaoSwap($populacao[$numeroAleatorio]);

            $totalMutacao--;
        }
    }

    function aplicarMutacaoSwap($cromossomo) {
        $cromossomo->geraVetorMutacaoSwap($cromossomo->getVetor());
        $cromossomo->calculaAptidao();
    }

    function ordenador($cromossomo1, $cromossomo2) {
        if ($cromossomo1->getAptidao() < $cromossomo2->getAptidao()) {
            return -1;
        } elseif ($cromossomo1->getAptidao() > $cromossomo2->getAptidao()) {
            return +1;
        }
        return 0;
    }
}