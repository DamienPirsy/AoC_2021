<?php

/**
 * Test input
 */
// $input = "0,9 -> 5,9
// 8,0 -> 0,8
// 9,4 -> 3,4
// 2,2 -> 2,1
// 7,0 -> 7,4
// 6,4 -> 2,0
// 0,9 -> 2,9
// 3,4 -> 1,4
// 0,0 -> 8,8
// 5,5 -> 8,2";

function solve_one(string $input) : string
{
    $lines = xplode_input($input);
    foreach($lines as $line) {
      $pairs = explode(' -> ', $line);
      $coords[] = [[$x1, $y1] = explode(',', $pairs[0]), [$x2, $y2] = explode(',', $pairs[1])];        
    }
    
    $board = [];
    $counter = 0;
    
    foreach($coords as $coord) {
      if ($coord[0][0] === $coord[1][0]) {
        foreach(range($coord[0][1], $coord[1][1]) as $y) {
            _mark_board($board, $counter, $coord[0][0], $y);
        }        
      } elseif($coord[0][1] === $coord[1][1]) {
        foreach(range($coord[0][0], $coord[1][0]) as $x) {
            _mark_board($board, $counter,$x, $coord[0][1]);
        }
      } else continue; // skip diagonal lines
    } 
    return result($counter);
}


function solve_two(string $input) : string
{
    $lines = xplode_input($input);
    foreach($lines as $line) {
      $pairs = explode(' -> ', $line);
      $coords[] = [[$x1, $y1] = explode(',', $pairs[0]), [$x2, $y2] = explode(',', $pairs[1])];        
    }
    
    $board = [];
    $counter = 0;
    
    foreach($coords as $coord) {
        if ($coord[0][0] === $coord[1][0]) {
            foreach(range($coord[0][1], $coord[1][1]) as $y) {
                _mark_board($board, $counter, $coord[0][0], $y);
            }        
        } elseif($coord[0][1] === $coord[1][1]) {
            foreach(range($coord[0][0], $coord[1][0]) as $x) {
                _mark_board($board, $counter,$x, $coord[0][1]);
            }
        } else {
            $xx = range($coord[0][0], $coord[1][0]);
            $yy = range($coord[0][1], $coord[1][1]);
            foreach($xx as $i => $x) {
                _mark_board($board, $counter, $x, $yy[$i]);
            }
        }
    } 
    return result($counter);
}


function _mark_board(&$board, &$counter, $x, $y) {
    if (! isset($board[$x][$y])) {
        $board[$x][$y] = 0;        
    }
    $board[$x][$y]++;
    if ($board[$x][$y] === 2) {
        $counter++;
    }
}