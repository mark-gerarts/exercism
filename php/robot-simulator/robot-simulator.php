<?php

class Robot
{
    public const DIRECTION_NORTH = 0;
    public const DIRECTION_EAST = 1;
    public const DIRECTION_SOUTH = 2;
    public const DIRECTION_WEST = 3;

    /**
     * These are public because the test suite requires it...
     */
    public $position;
    public $direction;

    public function __construct(array $startPosition, string $startDirection)
    {
        $this->position = $startPosition;
        $this->direction = $startDirection;
    }

    public function advance(): Robot
    {
        [$x, $y] = $this->position;
        switch ($this->direction) {
            case self::DIRECTION_NORTH:
                $y++;
                break;
            case self::DIRECTION_EAST:
                $x++;
                break;
            case self::DIRECTION_SOUTH:
                $y--;
                break;
            case self::DIRECTION_WEST:
                $x--;
                break;
        }

        $this->position = [$x, $y];

        return $this;
    }

    public function instructions(string $instructionString): void
    {
        foreach (str_split($instructionString) as $instruction) {
            $this->performInstruction($instruction);
        }
    }

    public function turnLeft(): Robot
    {
        for ($i = 0; $i < 3; $i++) {
            $this->turnRight();
        }

        return $this;
    }

    public function turnRight(): Robot
    {
        $this->direction++;
        $this->direction %= 4;

        return $this;
    }

    private function performInstruction(string $instruction): void
    {
        switch ($instruction) {
            case 'A':
                $this->advance();
                break;
            case 'L':
                $this->turnLeft();
                break;
            case 'R':
                $this->turnRight();
                break;
            default:
                throw new \InvalidArgumentException('Invalid instruction given');
        }
    }
}
