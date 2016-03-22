<?php

class Log {

  public static function mostraTempoExecucao($inicioExecucao, $fimExecucao) {

        $dateTime = new DateTime($inicioExecucao);
        $diferenca = $dateTime->diff(new DateTime($fimExecucao));

        $texto = "";
        $texto .= $diferenca->h > 0 ? $diferenca->h . ' hora(s), ' : '';
        $texto .= $diferenca->i > 0 ? $diferenca->i . ' minuto(s) e ' : '';
        $texto .= $diferenca->s . ' segundo(s)';

        return $texto;
    }

    public static function escreveArquivo($arquivo, $inicioExecucao, $fimExecucao, $melhorCromossomo, $dados) {
        $log = fopen($arquivo, "a");
        $texto  = "Execução: ".self::formatoDataHoraPadrao($inicioExecucao, true)." - ".self::formatoDataHoraPadrao($fimExecucao, true)." (Duração: ".self::mostraTempoExecucao($inicioExecucao, $fimExecucao).") \n";
        $texto .= "Melhor Cromossomo: \n";
        $texto .= "Geração: ".$melhorCromossomo->geracao."\n";
        $texto .= "Aptidão: ".$melhorCromossomo->aptidao."\n";
        $texto .= "Vetor: [".$melhorCromossomo->vetor[0].", ".$melhorCromossomo->vetor[1].", ".$melhorCromossomo->vetor[2].", ".$melhorCromossomo->vetor[3].", ".$melhorCromossomo->vetor[4].", ".$melhorCromossomo->vetor[5].", ".$melhorCromossomo->vetor[6].", ".$melhorCromossomo->vetor[7]."]\n";
        $texto .= "Parâmetros: \n";
        $texto .= "População inicial: ".$dados['populacao_inicial']."\n";
        $texto .= "Quantidade de Gerações: ".$dados['quantidade_geracoes']."\n";
        $texto .= "Quantidade selecionada para a nova população: ".$dados['quantidade_selecao']."%\n";
        $texto .= "Quantidade da população que vai fazer Crossover: ".$dados['quantidade_crossover']."%\n";
        $texto .= "Quantidade da população que vai sofrer Mutação: ".$dados['quantidade_mutacao']."%\n";
        fwrite($log, $texto . "\n");
        fclose($log);
    }

    public static function formatoDataHoraPadrao($dataHora,$exibirHora=true) {
        $novaDataHora = explode(' ', $dataHora);
        $novaData = explode('-', $novaDataHora[0]);
        $novaHora = $exibirHora === true ? $novaDataHora[1] : "";
        return $novaData[2]."/".$novaData[1]."/".$novaData[0]." ".$novaHora;
    }
}