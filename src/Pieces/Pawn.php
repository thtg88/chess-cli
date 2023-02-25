<?php

namespace Thtg88\ChessCli\Pieces;

use Thtg88\ChessCli\Board;
use Thtg88\ChessCli\Color;
use Thtg88\ChessCli\Destination;

final class Pawn extends Piece
{
    public function toNotationString(): string
    {
        return '';
    }

    public function toFenString(): string
    {
        return $this->color === Color::WHITE ? 'P' : 'p';
    }

    public function toString(): string
    {
        return $this->color === Color::WHITE ? '⚪️' : '⚫️';
    }

    public function destinations(): array
    {
        return $this->color === Color::WHITE ?
            $this->whiteDestinations() :
            $this->blackDestinations();
    }

    private function whiteDestinations(): array
    {
        $destinations = [];

        if ($this->y >= Board::HEIGHT - 1) {
            return $destinations;
        }

        // They can eat on the left
        if ($this->x > 0) {
            $destinations[] = new Destination($this->x - 1, $this->y + 1);
        }
        // They can eat on the right
        if ($this->x < Board::WIDTH - 1) {
            $destinations[] = new Destination($this->x + 1, $this->y + 1);
        }
        // When they are opening
        if ($this->y === 1) {
            $destinations[] = new Destination($this->x, $this->y + 2);
        }

        $destinations[] = new Destination($this->x, $this->y + 1);

        return $destinations;
    }

    private function blackDestinations(): array
    {
        $destinations = [];

        if ($this->y <= 0) {
            return $destinations;
        }

        // They can eat on the left
        if ($this->x > 0) {
            $destinations[] = new Destination($this->x - 1, $this->y - 1);
        }
        // They can eat on the right
        if ($this->x < Board::WIDTH - 1) {
            $destinations[] = new Destination($this->x + 1, $this->y - 1);
        }
        // When they are opening
        if ($this->y ===  Board::HEIGHT - 2) {
            $destinations[] = new Destination($this->x, $this->y - 2);
        }

        $destinations[] = new Destination($this->x, $this->y - 1);

        return $destinations;
    }
}
