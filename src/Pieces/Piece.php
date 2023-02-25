<?php

namespace Thtg88\ChessCli\Pieces;

use Thtg88\ChessCli\Color;
use Thtg88\ChessCli\Destination;

abstract class Piece
{
    final public function __construct(
        public readonly int $x,
        public readonly int $y,
        public readonly Color $color,
    ) {
    }

    abstract public function destinations(): array;
    abstract public function toNotationString(): string;
    abstract public function toFenString(): string;
    abstract public function toString(): string;

    public function isAt(int $x, int $y): bool
    {
        return $this->x === $x && $this->y === $y;
    }

    public function moveTo(Destination $destination): static
    {
        return new static($destination->x, $destination->y, $this->color);
    }
}
