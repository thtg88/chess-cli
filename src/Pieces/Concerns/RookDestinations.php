<?php

namespace Thtg88\ChessCli\Pieces\Concerns;

use Thtg88\ChessCli\Board;
use Thtg88\ChessCli\Destination;

trait RookDestinations
{
    public function destinations(): array
    {
        $destinations = [];

        for ($y = 0; $y < Board::HEIGHT; $y++) {
            for ($x = 0; $x < Board::WIDTH; $x++) {
                // Same position is not a valid destination
                if ($this->x === $x && $this->y === $y) {
                    continue;
                }

                if ($this->x === $x) {
                    $destinations[] = new Destination($x, $y);
                } else if ($this->y === $y) {
                    $destinations[] = new Destination($x, $y);
                }
            }
        }

        return $destinations;
    }
}
