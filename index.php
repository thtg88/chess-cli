<?php

require 'vendor/autoload.php';

use Thtg88\ChessCli\Exceptions\InvalidMove;
use Thtg88\ChessCli\Game;
use Thtg88\ChessCli\MoveNotationParser;

const DEBUG_MODE = false;
const VISUALIZE_PIECE_DESTINATIONS_ENABLED = false;

$game = new Game(
    DEBUG_MODE,
    visualise_piece_destinations: VISUALIZE_PIECE_DESTINATIONS_ENABLED,
);

$stdin = fopen('php://stdin', 'r');

if (!$stdin) {
    throw new RuntimeException('Can not open stdin stream');
}

while (true) {
    $game->draw();

    try {
        $move = (new MoveNotationParser(trim(fgets($stdin, 255))))->parse();

        if (DEBUG_MODE) {
            var_dump($move);
        }

        $game->applyMove($move);
    } catch (InvalidMove $e) {
        echo "Invalid move: {$e->getMessage()}" . PHP_EOL . PHP_EOL;
    }
}
