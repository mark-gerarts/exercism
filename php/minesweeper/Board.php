<?php

class Board implements \IteratorAggregate
{
    private $board;

    public function __construct(array $rows)
    {
        $this->board = $rows;
    }

    public function set(Position $p, string $value): void
    {
        $this->board[$p->getY()][$p->getX()] = $value;
    }

    public function get(Position $p): string
    {
        return $this->board[$p->getY()][$p->getX()];
    }

    public function getNeighbouringValues(Position $p): array
    {
        $neighbouringPositions = $p->getNeighbouringPositions();
        $neighbouringPositions = array_filter(
            $neighbouringPositions,
            function (Position $p) {
                return $p->getX() > 0
                    && $p->getX() < count($this->board[0]) - 1
                    && $p->getY() > 0
                    && $p->getY() < count($this->board) - 1;
            }
        );

        return array_map([$this, 'get'], $neighbouringPositions);
    }

    public function toString(): string
    {
        $lines = array_map(
            function (array $line): string {
                return implode('', $line);
            },
            $this->board
        );

        return "\n" . implode("\n", $lines) . "\n";
    }

    public function getIterator(): \Iterator
    {
        foreach ($this->board as $y => $line) {
            foreach ($line as $x => $square) {
                if ($this->isBorder($square)) {
                    continue;
                }

                $p = new Position($x, $y);
                yield $p => $this->get($p);
            }
        }
    }

    private function isBorder(string $square): bool
    {
        return in_array($square, ['+', '-', '|'], true);
    }
}
