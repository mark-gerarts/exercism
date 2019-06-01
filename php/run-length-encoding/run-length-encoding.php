<?php

function encode(string $input): string {
    return (new RunLengthEncoder())->encode($input);
}

function decode(string $input): string {
    return (new RunLengthDecoder())->decode($input);
}

class RunLengthEncoder
{
    public function encode(string $input): string
    {
        $encodedString = '';
        // This regex splits the input every time the character is different
        // from the previous character. E.g. AAAABCC would be [AAAA, B, CC].
        preg_match_all('/(.)\1*/', $input, $matches);
        foreach ($matches[0] as $sequence) {
            $encodedString .= $this->encodeSequence($sequence);
        }

        return $encodedString;
    }

    /**
     * Encodes a repeated sequence of characters. E.g. WWWW -> 4W, C -> C, ...
     */
    private function encodeSequence(string $sequence): string
    {
        $length = strlen($sequence);
        $character = $sequence[0];
        // A single character isn't preceded with a number.
        if ($length === 1) {
            return $character;
        }

        return $length . $character;
    }
}

class RunLengthDecoder
{
    public function decode(string $input): string
    {
        $decodedString = '';
        //This regex splits the input in parts that are either
        // number + character or a single character.
        preg_match_all('/(\d+.)|./', $input, $matches);
        foreach ($matches[0] as $part) {
            $decodedString .= $this->decodePart($part);
        }

        return $decodedString;
    }

    /**
     * Decodes a single part of the encoded string. E.g. 4W -> WWWW, C ->c, ...
     */
    private function decodePart(string $part): string
    {
        if (strlen($part) === 1) {
            return $part;
        }

        // The number of times we need to repeat the character. We get this by
        // taking the entire part except the last character.
        $repeat = substr($part, 0, -1);
        $character = substr($part, -1);

        return str_repeat($character, $repeat);
    }
}
