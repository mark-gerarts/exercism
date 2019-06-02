<?php

class Minesweeper
{
    public function solve(Board $board): void
    {
        foreach ($board as $p => $square) {
            if ($square !== ' ') {
                continue;
            }

            $numberOfMines = $this->getNumberOfProximateMines($board, $p);
            if ($numberOfMines > 0) {
                $board->set($p, $numberOfMines);
            }
        }
    }

    /**
     * Calculates the number of mines that are in the area surrounding the
     * given position.
     */
    private function getNumberOfProximateMines(Board $board, Position $p): int
    {
        $neighbours = $board->getNeighbouringValues($p);
        $mines = array_filter($neighbours, function (string $square) {
            return $square === '*';
        });

        return count($mines);
    }
}
