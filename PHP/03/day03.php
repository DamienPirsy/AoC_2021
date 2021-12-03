<?php

/**
 * Test input
 */
// $input = "00100
// 11110
// 10110
// 10111
// 10101
// 01111
// 00111
// 11100
// 10000
// 11001
// 00010
// 01010";

function solve_one(string $input) : string
{
    $items = xplode_input($input);
    $holder = _build_holder($items);

    // count them most frequent for every position
    $mostFrequent = "";
    $leastFrequent = "";
    foreach ($holder as $el) {
        $v = array_count_values($el);
        arsort($v);
        $k = array_keys($v);
        $mostFrequent .= $k[0];
        $leastFrequent .= $k[1];
    }
    return result(bindec($mostFrequent) * bindec($leastFrequent));
}


function solve_two(string $input) : string
{
    $items = xplode_input($input);
    $forOxigen = $forCo2 = $items;

    $len = strlen($items[0]);
    $ox = 0;
    $co2 = 0;

    // prendo l'indice corrente
    for ($i=0;$i<$len;$i++) {

        $oxBits = [];
        // ciclo sugli item e segno tutti i bit in posizione $i
        foreach ($forOxigen as $el) {
            array_push($oxBits, $el[$i]);
        }
        // prendo il bit + frequente
        $v = array_count_values($oxBits);
        arsort($v);
        $k = array_keys($v);
        $oxigenBit = ($v[$k[0]] == $v[$k[1]]) ? "1" : $k[0];

        // ciclo sugli items e prendo solo quelli che hanno in posizione $i il bit + frequente
        $forOxigen = array_filter($forOxigen, function($item) use($oxigenBit, $i) {
            return $item[$i] == $oxigenBit;
        });

        if (count($forOxigen) == 1) {
            $ox =  array_values($forOxigen)[0];
            break;
        }
    }

    for ($i=0; $i<strlen($items[0]); $i++) {
        $co2bits = [];
        // ciclo sugli item e segno tutti i bit in posizione $i
        foreach ($forCo2 as $el) {
            array_push($co2bits, $el[$i]);
        }
        // prendo il bit + frequente
        $v = array_count_values($co2bits);
        arsort($v);
        $k = array_keys($v);
        $co2bit = ($v[$k[0]] == $v[$k[1]]) ? "0" : $k[1];

        // ciclo sugli items e prendo solo quelli che hanno in posizione $i il bit + frequente
        $forCo2 = array_filter($forCo2, function($item) use($co2bit, $i) {
            return $item[$i] == $co2bit;
        });

        if (count($forCo2) == 1) {
            $co2 =  array_values($forCo2)[0];
            break;
        }
    }
    return result(bindec($ox) * bindec($co2));
}


function _build_holder(array $items): array {
    $holder = [];
    $itemLen = strlen($items[0]);
    for ($j = 0; $j < $itemLen; $j++) {
        $holder[$j] = [];
    }
    // Build an array with all the nth values
    for ($i = 0; $i < count($items); $i++) {
       for ($j = 0; $j < $itemLen; $j++) {
           array_push($holder[$j], $items[$i][$j]);
       }
    }
    return $holder;
}