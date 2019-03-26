<?php

class Bob
{
    private const BEHAVIOUR_MAPPING = [
        // A shouted (all-caps) sentence ending with a question mark.
        // To break it down:
        // - (?!^(\d|\W)+$) ensures the sentence isn't all-numeric. Whitespace
        //   is still allowed.
        // - \p{Lu} matches unicode uppercase characters, so..
        // - [\p{Lu}0-9\W]+ matches uppercase alphanumeric characters, with
        //   non-word characters allowed.
        '^(?!^(\d|\W)+$)[\p{Lu}0-9\W]+\?$' => 'Calm down, I know what I\'m doing!',
        // A shouted (all-caps) sentence.
        '^(?!^(\d|\W)+$)[\p{Lu}0-9\W]+$' => 'Whoa, chill out!',
        // A regular question (ends in a question mark).
        '\?$' => 'Sure.',
        // An empty string.
        '^$' => 'Fine. Be that way!'
    ];

    public function respondTo(string $input): string
    {
        // The input is trimmed for -any- whitespace. The standard trim mask is
        // expanded to include unicode whitespace.
        $input = trim($input, "\0\x0B\n\r \t\u{000b}\u{00a0}\u{2002}");

        foreach (self::BEHAVIOUR_MAPPING as $pattern => $response) {
            if (preg_match("/{$pattern}/u", $input)) {
                return $response;
            }
        }

        return 'Whatever.';
    }
}
