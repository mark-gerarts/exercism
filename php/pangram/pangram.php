<?php

function isPangram(string $sentence): bool {
    $sentence = strtolower($sentence);

    foreach (range('a', 'z') as $letter) {
        if (strpos($sentence, $letter) === false) {
            return false;
        }
    }

    return true;
}
