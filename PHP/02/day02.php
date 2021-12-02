<?php

/**
 * Test input
 */
// $input = "forward 5
// down 5
// forward 8
// up 3
// down 8
// forward 2";


function solve_one(string $input) : string
{
    $coords = ['x' => 0,'y' => 0];
    $items = xplode_input($input);
    array_map(function($item) use(&$coords) {
        [$direction, $amount] = explode(" ", $item);
        if ($direction == 'forward') {
            $coords['x']+=$amount;
        } else {
            $coords['y']+=($direction == 'up') ? -$amount : $amount;
        }
    }, $items);
    return result($coords['x'] * $coords['y']);
}


function solve_two(string $input) : string
{
    $coords = ['x' => 0,'y' => 0,'a' => 0,'d' => 0];
    $items = xplode_input($input);
    array_map(function($item) use(&$coords) {
        [$direction, $amount] = explode(" ", $item);
        if ($direction == 'forward') {
            $coords['x']+=$amount;
            $coords['d'] += ($amount * $coords['a']);            
        } else {
            $coords['a']+=($direction == 'up') ? -$amount : $amount;
        }
    }, $items);
    return result($coords['x'] * $coords['d']);

}