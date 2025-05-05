<?php 

function longestConsecutive($numbers) {
    $numberSet = array_flip($numbers);
    $longest = 0;

    foreach($numbers as $number) {
        if(!isset($numberSet[$number - 1])) {
            $current = $number;
            $length = 1;

            while(isset($numberSet[$current + 1])) {
                $current++;
                $length++;
            }

            $longest = max($longest, $length);
        }
    }

    return $longest;
}

echo longestConsecutive([100, 4, 200, 1, 3, 2]); // output 4
