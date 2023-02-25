<?php

namespace Thtg88\ChessCli\Pieces;

use Thtg88\ChessCli\Color;

final class Rook extends Piece
{
    use Concerns\RookDestinations;

    public function toFenString(): string
    {
        return $this->color === Color::WHITE ? 'R' : 'r';
    }

    public function toNotationString(): string
    {
        return 'R';
    }

    public function toString(): string
    {
        return $this->color === Color::WHITE ? '🏰' : '🏰';
    }
}
