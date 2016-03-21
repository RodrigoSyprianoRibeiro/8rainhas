<?php

require_once('Cromossomo.php');

class AlgoritmosGeneticos {

    public $geracaoAtual;
    public $populacao;

    // Parametros passados
    public $quantidadePopulacaoInicial; // Quantidade da população inicial.
    public $quantidadeGeracoes; // Quantidade de quantas vezes vai gerar população nova.
    public $quantidadeSelecao; // Quantidade da população que vai ser selecionada para a nova população.
    public $quantidadeCrossover; // Quantidade da população que vai fazer Crossover.
    public $quantidadeMutacao; // Quantidade da população que vai sofrer Mutação.

    function __construct($dados) {
        $this->geracaoAtual = 1;
        $this->populacao = array();

        // Parametros passados
        $this->quantidadePopulacaoInicial = (int) $dados['populacao_inicial']; // Quantidade da população inicial.
        $this->quantidadeGeracoes = (int) ($dados['quantidade_geracoes'] - 1); // Quantidade de quantas vezes vai gerar população nova.
        $this->quantidadeSelecao = (float) ($dados['quantidade_selecao'] / 100); // Quantidade da população que vai ser selecionada para a nova população.
        $this->quantidadeCrossover = (float) ($dados['quantidade_crossover'] / 100);// Quantidade da população que vai fazer Crossover.
        $this->quantidadeMutacao = (float) ($dados['quantidade_mutacao'] / 100); // Quantidade da população que vai sofrer Mutação.
    }
  
    public function geraPopulacaoInicial() {
        for ($i = 0; $i < $this->quantidadePopulacaoInicial; $i++) {
            $cromossomo = new Cromossomo($this->geracaoAtual);
            $cromossomo->geraVetor();
            $cromossomo->calculaAptidao();
            array_push($this->populacao, $cromossomo);
        }
    }

    public function geraNovaPopulacao() {

        $this->geracaoAtual++;

        $this->selecaoEletista();

        $this->crossover();

        $this->mutacao();
    }

    public function getMelhorCromossomo() {

        $this->ordenarPopulacaoMaiorMenor();
        return $this->populacao[0];
    }

    public function selecaoEletista() {

        $this->ordenarPopulacaoMaiorMenor();

        $totalPopulacao = round(count($this->populacao) * $this->quantidadeSelecao);
        $populacaoEletista = array();
        for ($i = 0; $i < $totalPopulacao; $i++) {
            array_push($populacaoEletista, $this->populacao[$i]);
        }

        $this->populacao = $populacaoEletista;
        unset($populacaoEletista);
    }

    public function crossover() {

        $populacaoCrossover = $this->geraPopulacaoCrossover();

        for ($i = 0; $i < count($populacaoCrossover); $i+=2) {
            $this->aplicarCrossoverCutAndCrossfill($populacaoCrossover[$i], $populacaoCrossover[$i+1]);
        }

        $this->populacao = array_merge($this->populacao, $populacaoCrossover);
        unset($populacaoCrossover);
    }

    public function geraPopulacaoCrossover() {

        $quantidadeCrossover = round(count($this->populacao) * $this->quantidadeCrossover);
        $totalCrossover = ($quantidadeCrossover % 2 == 0) ? $quantidadeCrossover : $quantidadeCrossover - 1;

        $populacaoCrossover = array();
        while ($totalCrossover > 0) {

            $numeroAleatorio = rand(0, count($this->populacao)-1);
            array_push($populacaoCrossover, $this->populacao[$numeroAleatorio]);
            unset($this->populacao[$numeroAleatorio]);
            sort($this->populacao);

            $totalCrossover--;
        }
        return $populacaoCrossover;
    }

    public function aplicarCrossoverCutAndCrossfill($cromossomo1, $cromossomo2) {

        $pontoCorte = 4; // Ponto de corte do vetor para fazer recombinação.

        $cromossomoFilho1 = new Cromossomo($this->geracaoAtual);
        $cromossomoFilho2 = new Cromossomo($this->geracaoAtual);

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

        array_push($this->populacao, $cromossomoFilho1);
        array_push($this->populacao, $cromossomoFilho2);
    }

    public function mutacao() {

        $totalMutacao = round(count($this->populacao) * $this->quantidadeMutacao);

        while ($totalMutacao > 0) {

            $numeroAleatorio = rand(0, count($this->populacao)-1);
            $this->aplicarMutacaoSwap($this->populacao[$numeroAleatorio]);

            $totalMutacao--;
        }
    }

    public function aplicarMutacaoSwap($cromossomo) {
        $cromossomo->geraVetorMutacaoSwap($cromossomo->getVetor());
        $cromossomo->calculaAptidao();
    }

    public function ordenarPopulacaoMaiorMenor() {

        if (!function_exists('ordenador')) {
            function ordenador($cromossomo1, $cromossomo2) {
                if ($cromossomo1->getAptidao() < $cromossomo2->getAptidao()) {
                    return -1;
                } elseif ($cromossomo1->getAptidao() > $cromossomo2->getAptidao()) {
                    return +1;
                }
                return 0;
            }
        }

        usort($this->populacao, 'ordenador');
    }
}