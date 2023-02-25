<?php

namespace Thtg88\ChessCli;

enum Color
{
    case BLACK;
    case WHITE;

    public function opposite(): self
    {
        return match ($this) {
            Color::BLACK => Color::WHITE,
            Color::WHITE => Color::BLACK,
        };
    }

    public function toFenString(): string
    {
        return match ($this) {
            Color::BLACK => 'b',
            Color::WHITE => 'w',
        };
    }
}
