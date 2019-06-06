<?php

class Series
{
    /**
     * @var int[]
     */
    private $digits;

    public function __construct(string $series)
    {
        if (!is_numeric($series) && $series !== '') {
            throw new \InvalidArgumentException('');
        }

        // When calling str_split on the empty string, it returns an array
        // containing only the empty string. We want an empty array instead.
        $this->digits = $series === '' ? [] : str_split($series);
    }

    public function largestProduct(int $length): int
    {
        if ($length > count($this->digits)) {
            throw new \InvalidArgumentException("Span can't be longer than the input");
        }
        if ($length < 0) {
            throw new \InvalidArgumentException("Span can't be negative");
        }

        $chunks = $this->getChunks($length);
        $products = array_map([$this, 'multiply'], $chunks);

        return max($products);
    }

    private function multiply(array $integers): int
    {
        return array_reduce(
            $integers,
            function (int $carry, int $x): int {
                return $carry * $x;
            },
            1
        );
    }

    private function getChunks(int $length): array
    {
        $chunks = [];
        for ($i = 0; $i <= count($this->digits) - $length; $i ++) {
            $chunks[] = array_slice($this->digits, $i, $length);
        }

        return $chunks;
    }
}
