<?php

/**
 * Test input
 */
// $input = "7,4,9,5,11,17,23,2,0,14,21,24,10,16,13,6,15,25,12,22,18,20,8,19,3,26,1

// 22 13 17 11  0
//  8  2 23  4 24
// 21  9 14 16  7
//  6 10  3 18  5
//  1 12 20 15 19

//  3 15  0  2 22
//  9 18 13 17  5
// 19  8  7 25 23
// 20 11 10 24  4
// 14 21 16 12  6

// 14 21 17 24  4
// 10 16 15  9 19
// 18  8 23 26 20
// 22 11 13  6  5
//  2  0 12  3  7";

function solve_one(string $input) : string
{
    $items = xplode_input($input);
    $numbers = array_map('intval', explode(",", array_shift($items))); // first row
    $boards = _build_boards($items);

    foreach ($numbers as $number) {
        foreach ($boards as &$board) {
            if (false !== ($r = _mark_board($number, $board))) {
                // stop at the first winning board
                return result($r);
            }
        }
    }
    return result();
}


function solve_two(string $input) : string
{
    $items = xplode_input($input);
    $numbers = array_map('intval', explode(",", array_shift($items))); // first row
    $boards = _build_boards($items);

    $result = "";
    foreach ($numbers as $number) {
        foreach ($boards as $bi => &$board) {
            if (false !== ($r = _mark_board($number, $board))) {
                unset($boards[$bi]);
                $result = $r;                
            }
        }
    }
    return result($result);
}


function _build_boards(array $items) {
    $matrix = [];
    $j = 0;
    // create boards
    for($i=0;$i<count($items);$i++) {
        if (empty($items[$i])) {
            $j++;
        } else {
            $matrix[$j][] = array_values(array_filter(explode(" ", $items[$i]), fn($value) => !is_null($value) && $value !== ''));
        }
    }
    return $matrix;
}

function _mark_board($number, &$board) {
    $winning = false;
    $sum = 0;
    for ($y=0;$y<5;$y++) {
        $hor = 0;
        for ($x=0;$x<5;$x++) {
            if($board[$y][$x] == $number) {
                $board[$y][$x] = 'X';
            }
            if($board[$y][$x] == 'X') {
                $hor++;
            } else {
                $sum += $board[$y][$x];
            }
        }
        if ($hor == 5) {
          $winning = true;
        }
    }

    // count verts
    for ($x=0; $x<5; $x++) {
        $vert = 0;
        for ($y = 0; $y<5; $y++) {
            if ($board[$y][$x] == 'X') {
                $vert++;
            }
        }
        if ($vert == 5) {
            $winning = true;
        }        
    }

    return $winning ? $number * $sum : false;
}