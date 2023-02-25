<?php

namespace Thtg88\ChessCli\Pieces;

use Thtg88\ChessCli\Board;
use Thtg88\ChessCli\Color;
use Thtg88\ChessCli\Destination;

final class King extends Piece
{
    public function toFenString(): string
    {
        return $this->color === Color::WHITE ? 'K' : 'k';
    }

    public function toNotationString(): string
    {
        return 'K';
    }

    public function toString(): string
    {
        return $this->color === Color::WHITE ? '🤴' : '🤴🏿';
    }

    public function destinations(): array
    {
        $destinations = [];

        if ($this->y < Board::HEIGHT - 1) {
            $destinations[] = new Destination($this->x, $this->y + 1);
        }
        if ($this->x < Board::WIDTH - 1 && $this->y < Board::HEIGHT - 1) {
            $destinations[] = new Destination($this->x + 1, $this->y + 1);
        }
        if ($this->x < Board::WIDTH - 1) {
            $destinations[] = new Destination($this->x + 1, $this->y);
        }
        if ($this->x < Board::WIDTH - 1 && $this->y > 0) {
            $destinations[] = new Destination($this->x + 1, $this->y - 1);
        }
        if ($this->y > 0) {
            $destinations[] = new Destination($this->x, $this->y - 1);
        }
        if ($this->x > 0 && $this->y > 0) {
            $destinations[] = new Destination($this->x - 1, $this->y - 1);
        }
        if ($this->x > 0) {
            $destinations[] = new Destination($this->x - 1, $this->y);
        }
        if ($this->x > 0 && $this->y < Board::HEIGHT - 1) {
            $destinations[] = new Destination($this->x - 1, $this->y + 1);
        }

        return $destinations;
    }
}
