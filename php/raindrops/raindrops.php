<?php

function raindrops(int $n): string {
    $output = '';
    if ($n % 3 === 0) {
        $output .= 'Pling';
    }
    if ($n % 5 === 0) {
        $output .= 'Plang';
    }
    if ($n % 7 === 0) {
        $output .= 'Plong';
    }
    if ($output === '') {
        $output = (string) $n;
    }

    return $output;
}
