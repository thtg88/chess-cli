<?php

namespace Thtg88\ChessCli\Pieces;

use Thtg88\ChessCli\Color;
use Thtg88\ChessCli\Pieces\Concerns\BishopDestinations;
use Thtg88\ChessCli\Pieces\Concerns\RookDestinations;

final class Queen extends Piece
{
    use BishopDestinations, RookDestinations {
        BishopDestinations::destinations as bishopDestinations;
        RookDestinations::destinations as rookDestinations;
    }

    public function toFenString(): string
    {
        return $this->color === Color::WHITE ? 'Q' : 'q';
    }

    public function toNotationString(): string
    {
        return 'Q';
    }

    public function toString(): string
    {
        return $this->color === Color::WHITE ? '👸' : '👸🏿';
    }

    public function destinations(): array
    {
        return array_merge($this->rookDestinations(), $this->bishopDestinations());
    }
}
