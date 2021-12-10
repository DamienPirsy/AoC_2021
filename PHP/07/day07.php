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
    // calculate the mean value
    $mean = round(array_sum($items) / count($items));
    $sum = 0;
    logger(json_encode($items));
    foreach ($items as $item) {
        $diff = abs($item - $mean);
        $i = 0;
        foreach(range(1, $diff) as $step) {
            $i+=$step;   
        }
        logger("%d to %d: %d (%s). Fuel: %d", $item, $mean, $diff, json_encode(range(1, $diff)), $i);
        $sum += $i;
        logger('sum: %s', $sum);
    }
    return result($sum);
}