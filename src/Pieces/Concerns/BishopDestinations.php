<?php

namespace Thtg88\ChessCli\Pieces\Concerns;

use Thtg88\ChessCli\Board;
use Thtg88\ChessCli\Destination;

trait BishopDestinations
{
    public function destinations(): array
    {
        // XXXXXXXX
        // -XXXXXXX
        // X-XXXXX-
        // XX-XXX-X
        // XXX-X-XX
        // XXXXOXXX
        // XXX-X-XX
        // XX-XXX-X

        $destinations = [];

        $x = $this->x;
        $y = $this->y;

        while ($x > 0 && $y > 0) {
            $x--;
            $y--;
            $destinations[] = new Destination($x, $y);
        }

        $x = $this->x;
        $y = $this->y;

        while ($x > 0 && $y < Board::HEIGHT - 1) {
            $x--;
            $y++;
            $destinations[] = new Destination($x, $y);
        }

        $x = $this->x;
        $y = $this->y;

        while ($x < Board::HEIGHT - 1 && $y > 0) {
            $x++;
            $y--;
            $destinations[] = new Destination($x, $y);
        }

        $x = $this->x;
        $y = $this->y;

        while ($x < Board::WIDTH - 1 && $y < Board::HEIGHT - 1) {
            $x++;
            $y++;
            $destinations[] = new Destination($x, $y);
        }

        return $destinations;
    }
}
