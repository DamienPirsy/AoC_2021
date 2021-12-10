<?php

/**
 * Test input
 */
// $input = "3,4,3,1,2";

function solve_one(string $input) : string
{
    $items = xplode_input($input);
    $fishes = explode(',', $items[0]);
    for ($i=0; $i<80;$i++) {
        $fishes = _fish_population($fishes);
    }
    return result(count($fishes));
}


function solve_two(string $input) : string
{
    $items = xplode_input($input);
    $table = []; // init table holding the number of fishes with that internal timer
    for ($i=0; $i<9;$i++) {
        $table[$i] = 0;
    }
    $fishes = explode(',', $items[0]);
    foreach ($fishes as $fish) {
        $table[$fish]++;
    }
    for ($i = 0; $i<256;$i++) {
        $table = _generation($table);
    }
    return result(array_sum($table));
}


/**
 * Each generation move down the count; al past zero become six and spawn an equal number
 * of new fishes.
 *
 * @param array $table
 * @return array
 */
function _generation(array &$table): array {
    foreach ($table as $timer => $fishes) {
        $table[$timer-1] = $fishes;
    }
    $table[6]+= $table[-1];
    $table[8] = $table[-1];
    $table[-1] = 0;
    return $table;
}

/**
 * Naive solution
 *
 * @param array $fishes
 * @return array
 */
function _fish_population(array &$fishes): array {
    foreach ($fishes as &$fish) {
        if ($fish == 0) {
            $fish = 6;
            array_push($fishes, 9);
        } elseif ($fish <= 9) {
            $fish -= 1;
        }   
    }
    return $fishes;
}