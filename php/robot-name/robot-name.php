<?php

class Robot
{
    /**
     * @var string
     */
    private $name;

    public function __construct()
    {
        $this->assignNewName();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function reset(): void
    {
        $this->assignNewName();
    }

    private function assignNewName(): void
    {
        static $previousNames = [];
        do {
            $name = $this->getRandomName();
        }
        while (in_array($name, $previousNames, true));

        $previousNames[] = $name;
        $this->name = $name;
    }

    private function getRandomName(): string
    {
        $numberOfLetters = 2;
        $numberOfDigits = 3;
        $name = '';
        for ($i = 0; $i < $numberOfLetters; $i++) {
            $name .= $this->getRandomLetter();
        }
        for ($i = 0; $i < $numberOfDigits; $i++) {
            $name .= $this->getRandomDigit();
        }

        return $name;
    }

    private function getRandomLetter(): string
    {
        return chr(random_int(65, 90));

    }

    private function getRandomDigit(): int
    {
        return random_int(0, 9);
    }
}
