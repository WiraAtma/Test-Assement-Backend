<?php

function checkValidBrackets($text) {
    $stack = [];
    $pairs = [
        ')' => '(',
        ']' => '[',
        '}' => '{', 
        '>' => '<'
    ];

    for($i = 0; $i < strlen($text); $i++) {
        $char = $text[$i];
        if(isset($pairs[$char])) {
            $top = array_pop($stack);
            if($top != $pairs[$char]) {
                return false;
            }
        } else {
            $stack[] = $char;
        }
    }

    return empty($stack);
}

//Example in Test
var_dump(checkValidBrackets("({[]})")); // true

var_dump(checkValidBrackets("(]")); // false