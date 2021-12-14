<?php

/**
 * Test input
 */
// $input = "
// be cfbegad cbdgef fgaecd cgeb fdcge agebfd fecdb fabcd edb | fdgacbe cefdb cefbgd gcbe
// edbfga begcd cbg gc gcadebf fbgde acbgfd abcde gfcbed gfec | fcgedb cgb dgebacf gc
// fgaebd cg bdaec gdafb agbcfd gdcbef bgcad gfac gcb cdgabef | cg cg fdcagb cbg
// fbegcd cbd adcefb dageb afcb bc aefdc ecdab fgdeca fcdbega | efabcd cedba gadfec cb
// aecbfdg fbg gf bafeg dbefa fcge gcbea fcaegb dgceab fcbdga | gecf egdcabf bgf bfgea
// fgeab ca afcebg bdacfeg cfaedg gcfdb baec bfadeg bafgc acf | gebdcfa ecba ca fadegcb
// dbcfg fgd bdegcaf fgec aegbdf ecdfab fbedc dacgb gdcebf gf | cefg dcbef fcge gbcadfe
// bdfegc cbegaf gecbf dfcage bdacg ed bedf ced adcbefg gebcd | ed bcgafe cdgba cbgef
// egadfb cdbfeg cegd fecab cgb gbdefca cg fgcdab egfdb bfceg | gbdfcae bgc cg cgb
// gcafb gcf dcaebfg ecagb gf abcdeg gaef cafbge fdbac fegbdc | fgae cfgab fg bagce";

function solve_one(string $input) : string
{
    $counts = [];
    /**
     * 1 = 2 segments
     * 4 = 4 segments
     * 7 = 3 segments
     * 8 = 7 segments
     */
    foreach (xplode_input($input) as $line) {
        [$sequence, $digit] = explode(' | ', $line);
        foreach (explode(" ", $digit) as $segment) {
            $len = strlen($segment);
            if (!isset($counts[$len])) {
                $counts[$len] = 0;
            }
            $counts[$len]++;
        }
    }
    return result($counts[2] + $counts[3] + $counts[4] + $counts[7]);
}


/**
 * 
 *
 * @param string $input
 * @return string
 */
function solve_two(string $input) : string
{
    $total = 0;

     /**
     * 1 = 2 segments
     * 2 = 5 segments
     * 3 = 5 segments
     * 4 = 4 segments
     * 5 = 5 segments
     * 6 = 6 segments
     * 7 = 3 segments
     * 8 = 7 segments
     * 9 = 6 segments
     * 0 = 6 segments
     */
    foreach (xplode_input($input) as $line) {

        [$sequence, $digits] = explode(' | ', $line);
        $nums = [];        
        // numbers share common segments, given those I have I can work out the others
        // by considering the common elements.
        foreach (explode(" ", $sequence) as $letters) {
            $nums[strlen($letters)][] = $letters;
        }
        $numbers = [];
        $numbers[1] = _sort_str($nums[2][0]);
        // 3 is the only number, among those with 5 segments, to share the same segments of nr 1
        foreach ($nums[5] as $k => $element) {
            $common = _common_with($numbers[1], $element);
            if ($common == 2) {
                $numbers[3] = _sort_str($element);
                unset($nums[5][$k]);
            }
        }
        $numbers[4] = _sort_str($nums[4][0]);
        $numbers[7] = _sort_str($nums[3][0]);
        $numbers[8] = _sort_str($nums[7][0]);

        // 5 and 2
        foreach ($nums[5] as $k => $element) {
            $common = _common_with($numbers[4], $element);            
            if ($common == 3) {
                $numbers[5] = _sort_str($element);
            } else {
                $numbers[2] = _sort_str($element);
            }
        }
        // 9 has all segments in common with 4
        foreach ($nums[6] as $k => $element) {
            $common = _common_with($numbers[4], $element);            
            if ($common == 4) {
                $numbers[9] = _sort_str($element);
                unset($nums[6][$k]);
            }
        }
        foreach ($nums[6] as $k => $element) {
            $common = _common_with($numbers[7], $element);            
            if ($common == 2) {
                $numbers[6] = _sort_str($element);
                unset($nums[6][$k]);                
            }
        }
        $numbers[0] = _sort_str(array_values($nums[6])[0]);
        // now we have the mapping, on to understanding which digit it lights. The letters are the same but the order is not.
        $sum = '';
        foreach (array_map('_sort_str', explode(" ", $digits)) as $digit) {
            $sum .= array_search($digit, $numbers, true);
        }
        $total += intval($sum);
    }
    return result($total);
}

function _common_with(string $pattern, string $element): int {
    return count(array_intersect(str_split($pattern), str_split($element)));
}

function _sort_str(string $str): string {
    $toArray = str_split($str);
    sort($toArray);
    return implode("", $toArray);
}