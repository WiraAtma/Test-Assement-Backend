<?php

function mergeIntervals($data) {
    if(empty($data)) {
        return [];
    }

    usort($data, function($a, $b) {
        return $a[0] <=> $b[0];
    });

    $merged = [$data[0]];

    for($i = 1; $i < count($data); $i++) {
        $last = &$merged[count($merged) - 1];

        if($data[$i][0] <= $last[1]) {
            $last[1] = max($last[1], $data[$i][1]);
        } else {
            $merged[] = $data[$i];
        }
    }

    return $merged;
}

echo json_encode(mergeIntervals([[1, 3], [2, 6], [8, 10], [15, 18]]));