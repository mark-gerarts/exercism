<?php

function squareOfSum(int $n): int {
    return array_sum(range(1, $n)) ** 2;
}

function sumOfSquares(int $n): int {
    $squares = array_map(
        function (int $x): int {
            return $x ** 2;
        },
        range(1, $n)
    );

    return array_sum($squares);
}

function difference(int $n): int {
    return squareOfSum($n) - sumOfSquares($n);
}
