<?php

function isIsogram(string $word): bool {
    $allowedDuplicates = [' ', '-'];
    $word = str_replace($allowedDuplicates, '', $word);
    $word = mb_strtolower($word);
    $letters = preg_split('//u', $word, -1, PREG_SPLIT_NO_EMPTY);

    return count(array_unique($letters)) === count($letters);
}
