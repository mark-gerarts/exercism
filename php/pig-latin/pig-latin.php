<?php

function translate(string $sentence): string {
    $words = explode(' ', $sentence);
    $words = array_map('translateWord', $words);

    return implode(' ', $words);
}

function translateWord(string $word): string {
    $startsWith = function (string $prefixRegexp) use ($word): bool {
        return preg_match("/^$prefixRegexp/", $word);
    };

    // If the word starts with a vowel, just append 'ay'. Same goes for the
    // special cases 'yt' and 'xr'.
    if ($startsWith('[aeoui]|yt|xr')) {
        return $word . 'ay';
    }

    // 'qu' with a preceding consonant is a special case as well.
    if ($startsWith('.qu')) {
        return substr($word, 3) . $word[0] . 'quay';
    }

    $consonants = array_merge(
        ['thr', 'ch', 'qu', 'th', 'sch'],
        range('b', 'z') // Still includes vowels, but these have been checked before.
    );

    foreach ($consonants as $consonant) {
        if ($startsWith($consonant)) {
            return substr($word, strlen($consonant)) . $consonant . 'ay';
        }
    }

    return $word;
}
