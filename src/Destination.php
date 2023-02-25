<?php

namespace Thtg88\ChessCli;

final class Destination
{
    public function __construct(public readonly int $x, public readonly int $y)
    {
    }

    public function clone(): self
    {
        return new self($this->x, $this->y);
    }

    public function isAt(int $x, int $y): bool
    {
        return $this->x === $x && $this->y === $y;
    }
}
