<?php

class BoardParser
{
    /**
     * Parses and validates the input, yielding a Board instance.
     */
    public function parseInput(string $input): Board
    {
        $lines = array_values(array_filter(explode("\n", $input)));
        $this->validate($lines);
        $board = new Board(array_map('str_split', $lines));
        $this->validateSquareCount($board);

        return $board;
    }

    private function validate(array $lines): void
    {
        $lastLine = $lines[count($lines) - 1];
        $firstLine = $lines[0];
        // Check if the top and bottom border are correct.
        if (!$this->isHorizontalBorder($firstLine) || !$this->isHorizontalBorder($lastLine)) {
            throw new \InvalidArgumentException('Malformed board');
        }

        // Check if the other rows contain their borders.
        for ($i = 1; $i < count($lines) - 1; $i++) {
            if (!$this->isValidRow($lines[$i])) {
                throw new \InvalidArgumentException('Malformed board');
            }
        }

        // Check if each row is of equal length.
        if (!$this->areEqualLength($lines)) {
            throw new \InvalidArgumentException('Malformed board');
        }
    }

    private function isHorizontalBorder(string $line): bool
    {
        return preg_match('/\+-*\+/', $line);
    }

    private function isValidRow(string $line): bool
    {
        return preg_match('/^\|[\s\*]+\|$/', $line);
    }

    private function areEqualLength(array $lines): bool
    {
        return count(array_unique(array_map('strlen', $lines))) === 1;
    }

    private function validateSquareCount(Board $board): void
    {
        if (iterator_count($board) < 2) {
            throw new \InvalidArgumentException('Not enough squares');
        }
    }
}
