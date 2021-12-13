<?php

/**
 * Test input
 */
// $input = "16,1,2,0,4,2,7,1,2,14";

function solve_one(string $input) : string
{
    $items = array_map('intval', explode(',', xplode_input($input)[0]));
    sort($items);
   
    // Calculate the median value
    $middle = floor((count($items)-1) / 2);
    if ($middle%2) {
        $median = $items[$middle];
    } else {
        $el1 = $items[$middle];
        $el2 = $items[$middle+1];
        $median = ($el1+$el2)/2;
    }
    $sum = 0;
    array_map(function($el) use(&$sum, $median) {
        $sum += abs($el-$median); // take the difference between the median and the position
    }, $items);
    return result($sum);
}

function solve_two(string $input) : string
{
    $items = array_map('intval', explode(',', xplode_input($input)[0]));   
    $mean = round(array_sum($items) / count($items));
    $sum = _calc_fuel($items, $mean);
    return result($sum);
}

function _calc_fuel($items, $mean) {
    $sum = 0;
    foreach ($items as $item) {
        $diff = abs($item - $mean);
        $sum += ($diff * ($diff + 1)) / 2;
    }
    return $sum;
}
