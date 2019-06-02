<?php

class Position
{
    private $x;
    private $y;

    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function getNeighbouringPositions(): array
    {
        return [
            new Position($this->x - 1, $this->y),
            new Position($this->x - 1, $this->y + 1),
            new Position($this->x, $this->y + 1),
            new Position($this->x + 1, $this->y + 1),
            new Position($this->x + 1, $this->y),
            new Position($this->x + 1, $this->y - 1),
            new Position($this->x, $this->y - 1),
            new Position($this->x - 1, $this->y - 1)
        ];
    }
}
