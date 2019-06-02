<?php

// Let's do our class loading manually.
require 'Position.php';
require 'BoardParser.php';
require 'Board.php';
require 'Minesweeper.php';

function solve(string $input): string {
    $boardParser = new BoardParser();
    $board = $boardParser->parseInput($input);
    $minesweeper = new Minesweeper();
    $minesweeper->solve($board);

    return $board->toString();
}
