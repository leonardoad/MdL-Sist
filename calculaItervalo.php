<?php

// Determinando um intervalo entre duas datas
// formato: dd/mm/aaaa

function calculaIntervalo($data1, $data2 = '') {
    // se data2 for omitida, o calculo sera feito ate a data atual
    $data2 = $data2 == '' ? date('d/m/Y H:i', mktime()) : $data2;


    list($data1, $hora1) = explode(' ', $data1);
    list($data2, $hora2) = explode(' ', $data2);

//die($data2.' '.$hora2);
    // separa as horas em hora,min e seg
    list($hora1, $min1, $seg1) = explode(':', $hora1);
    list($hora2, $min2, $seg2) = explode(':', $hora2);

    // separa as datas em dia,mes e ano
    list($dia1, $mes1, $ano1) = explode('/', $data1);
    list($dia2, $mes2, $ano2) = explode('/', $data2);

    // so lembrando que o padrao eh MM/DD/AAAA
    $timestamp1 = mktime($hora1, $min1, $seg1, $mes1, $dia1, $ano1);
    $timestamp2 = mktime($hora2, $min2, $seg2, $mes2, $dia2, $ano2);
//            $timestamp2 = mktime(0,0,0,$mes2,$dia2,$ano2);
    // calcula a diferenca em timestamp
    $diferenca = ($timestamp2 - $timestamp1);

    // retorna o calculo em anos, meses e dias
//            return (date('Y',$diferenca)-1970).' anos,'.(date('m',$diferenca)-1).' meses e '.(date('d',$diferenca)-1).' dias '.(date('H',$diferenca)).' horas '.(date('i',$diferenca)).' min';
    return ($diferenca) / 3600 / 24 . ' dias ' . ($diferenca) / 60 / 60 . ' horas ' . ($diferenca) / 60 . ' minutos';
}

echo calculaIntervalo('03/01/2010 12:30', '04/01/2010 13:00');
?>