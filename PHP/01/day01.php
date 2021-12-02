<?php

/**
 * Test input
 */
// $input = "199
// 200
// 208
// 210
// 200
// 207
// 240
// 269
// 260
// 263";

function solve_one(string $input) : string {
    $items = xplode_input($input, true);
    $counter = -1; // so I could discard the first one
    $previous = 0;
    array_map(function($current) use(&$previous, &$counter) {
        if ($current > $previous) {            
            $counter++;
        }
        $previous = $current;
    }, $items);
    return result($counter);
}


function solve_two(string $input) : string
{
    $items = xplode_input($input, true);
    $numItems = count($items);
    $tuples = [];
    for ($i=1; $i<$numItems;$i++) { // create all the 3-item tuples
        if (($i+1) <= $numItems-1) {  // don't create a tuple if there are not enough elements
            $tuples[$i] = $items[$i-1] + $items[$i] + $items[$i+1];
        }
    }
    return solve_one(implode("\n", $tuples));
}