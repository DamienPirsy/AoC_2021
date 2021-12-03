<?php

/**
 * Test input
 */
$input = "00100
11110
10110
10111
10101
01111
00111
11100
10000
11001
00010
01010";

function solve_one(string $input) : string
{
    $items = xplode_input($input);
    $holder = [];
    $itemLen = strlen($items[0]);
    for ($j = 0; $j < $itemLen; $j++) {
        $holder[$j] = [];
    }
    // Build an array with all the nth values
    for ($i = 0; $i < count($items)-1; $i++) {
       for ($j = 0; $j < $itemLen; $j++) {
           array_push($holder[$j], $items[$i][$j]);
       }
    }
    // count them most frequent for every position
    $mostFrequent = "";
    $lessFrequent = "";
    foreach ($holder as $el) {
        $v = array_count_values($el);
        arsort($v);
        $k = array_keys($v);
        $mostFrequent .= $k[0];
        $lessFrequent .= $k[1];
    }
    return result(bindec($mostFrequent) * bindec($lessFrequent));
}


function solve_two(string $input) : string
{
    return "";
}