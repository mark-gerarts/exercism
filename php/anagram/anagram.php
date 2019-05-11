<?php

function detectAnagrams(string $word, array $candidates): array {
    return array_values(array_filter(
        $candidates,
        function (string $candidate) use ($word): bool {
            return isAnagram($word, $candidate);
        }
    ));
}

function isAnagram(string $a, string $b): bool {
    $a = mb_strtolower($a);
    $b = mb_strtolower($b);
    if ($a === $b) {
        // Identical words are not anagrams.
        return false;
    }

    return sortString($a) === sortString($b);
}

function sortString(string $string): string {
    $parts = preg_split('//u', $string, -1, PREG_SPLIT_NO_EMPTY);
    sort($parts);

    return implode('', $parts);
}
