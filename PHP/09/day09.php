<?php

/**
 * Test input
 */
// $input = "
// 2199943210
// 3987894921
// 9856789892
// 8767896789
// 9899965678";

function solve_one(string $input) : string
{
    $rows = xplode_input($input);
    $lows = [];
    for ($y=0;$y<count($rows);$y++) {
        $cols = array_map('intval', str_split($rows[$y]));
        foreach ($cols as $index => $x) {
            $top = $rows[$y-1][$index] ?? 10;
            $left = $rows[$y][$index-1] ?? 10;
            $right = $rows[$y][$index+1] ?? 10;
            $bottom = $rows[$y+1][$index] ?? 10;
            if ($x < $top && $x < $bottom && $x < $left && $x < $right) {
                array_push($lows, $x+1);
            }
        }
    }   
    return result(array_sum($lows));
}


function solve_two(string $input) : string
{
    return result();
}