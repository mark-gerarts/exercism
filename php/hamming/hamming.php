<?php

function distance(string $a, string $b): int {
    if (strlen($a) !== strlen($b)) {
        throw new \InvalidArgumentException('DNA strands must be of equal length.');
    }

    $numberOfEquals = count(array_intersect_assoc(str_split($a), str_split($b)));
    return strlen($a) - $numberOfEquals;
}
