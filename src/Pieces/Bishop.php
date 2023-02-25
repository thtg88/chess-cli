<?php

namespace Thtg88\ChessCli\Pieces;

use Thtg88\ChessCli\Color;

final class Bishop extends Piece
{
    use Concerns\BishopDestinations;

    public function toFenString(): string
    {
        return $this->color === Color::WHITE ? 'B' : 'b';
    }

    public function toNotationString(): string
    {
        return 'B';
    }

    public function toString(): string
    {
        return $this->color === Color::WHITE ? '🔔' : '🔔';
    }
}
