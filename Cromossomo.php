<?php

class Cromossomo
{
    public $vetor;
    public $aptidao;
    public $geracao;

    function __construct($geracao) {
      $this->geracao = $geracao;
    }

    public function geraVetor() {
        $vetor = [0, 1, 2, 3, 4, 5, 6, 7];
        shuffle($vetor);
        $this->vetor = $vetor;
    }

    public function geraVetorCrossoverCutAndCrossfill($vetor1, $vetor2, $pontoCorte) {

        $vetor = array();
        for ($i = 0; $i < 8; $i++) {
            $vetor[$i] = $i < $pontoCorte ? $vetor1[$i] : $vetor2[$i];
        }

        $count = 0;
        $novoVetor = array_unique(array_merge($vetor, array(0, 1, 2, 3, 4, 5, 6, 7)));
        foreach ($novoVetor AS $valor) {
            $this->vetor[$count] = $valor;
            $count++;
        }
    }

    public function geraVetorMutacaoSwap($vetor) {

        $numeroAleatorio = rand(0, 7);

        $aux = $vetor[$numeroAleatorio];
        foreach ($vetor AS $indice => $valor) {

            if ($numeroAleatorio == $indice) {
                $vetor[$indice] = $numeroAleatorio;
            }
            if ($valor == $numeroAleatorio) {
                $vetor[$indice] = $aux;
            }
        }
        $this->vetor = $vetor;
    }

    public function calculaAptidao() {
        $conflitos = 0;
        for ($i = 0; $i < 8; $i++) {
            for ($j = $i + 1; $j < 8; $j++) {
                if ($this->vetor[$i] === $this->vetor[$j] ||
                    $this->vetor[$i]+$i === $this->vetor[$j]+$j ||
                    $this->vetor[$i]+$j === $this->vetor[$j]+$i) {

                    $conflitos++;
                }
            }
        }
        $this->aptidao = $conflitos;
    }

    function getVetor() {
        return $this->vetor;
    }

    function setVetor($vetor) {
        $this->vetor = $vetor;
    }

    function getAptidao() {
        return $this->aptidao;
    }

    function setAptidao($aptidao) {
        $this->aptidao = $aptidao;
    }

    function getGeracao() {
        return $this->geracao;
    }

    function setGeracao($geracao) {
        $this->geracao = $geracao;
    }
}