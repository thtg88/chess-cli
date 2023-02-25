<?php

namespace Thtg88\ChessCli\Pieces;

use Thtg88\ChessCli\Color;

final class Knight extends Piece
{
    public function toFenString(): string
    {
        return $this->color === Color::WHITE ? 'N' : 'n';
    }

    public function toNotationString(): string
    {
        return 'N';
    }

    public function toString(): string
    {
        return $this->color === Color::WHITE ? '🐴' : '🐴';
    }

    public function destinations(): array
    {
        return [];
    }
}
