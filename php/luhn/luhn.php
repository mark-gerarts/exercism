<?php

function isValid(string $number): bool {
    // Validate the input. Spaces are allowed but should be stripped. Any other
    // non-numeric character invalidates the input. The sanitized number should
    // have more than one digit.
    $number = str_replace(' ', '', $number);
    if (!is_numeric($number) || strlen($number) < 2) {
        return false;
    }

    // We start counting from the right, so we reverse the input.
    $digits = array_reverse(str_split($number));

    // Map every other digit to it's Luhn double.
    $luhnDigits = array_map(
        function (int $i, int $digit): int {
            return $i % 2 === 0 ? $digit : luhnDouble($digit);
        },
        array_keys($digits),
        $digits
    );

    return array_sum($luhnDigits) % 10 === 0;
}

function luhnDouble(int $digit): int {
    $double = $digit * 2;
    return $double > 9 ? $double - 9 : $double;
}
