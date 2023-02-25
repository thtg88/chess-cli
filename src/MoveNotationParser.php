<?php

namespace Thtg88\ChessCli;

use Thtg88\ChessCli\Exceptions\InvalidMove;
use Thtg88\ChessCli\Pieces\Bishop;
use Thtg88\ChessCli\Pieces\King;
use Thtg88\ChessCli\Pieces\Knight;
use Thtg88\ChessCli\Pieces\Pawn;
use Thtg88\ChessCli\Pieces\Queen;
use Thtg88\ChessCli\Pieces\Rook;

final class MoveNotationParser
{
    public function __construct(private readonly string $move)
    {
    }

    public function parse(): Move
    {
        $this->validate();

        $x = $this->parseX();
        $y = $this->parseY();
        $piece_classname = $this->parsePiece();

        return new Move($piece_classname, new Destination($x, $y));
    }

    private function validate(): bool
    {
        if (strlen($this->move) < 2) {
            throw new InvalidMove("Invalid notation '{$this->move}'");
        }

        $this->validateX();
        $this->validateY();

        return true;
    }

    private function validateX(): bool
    {
        $x = $this->parseX();

        if ($x >= 0 && $x < Board::WIDTH) {
            return true;
        }

        throw new InvalidMove("Invalid notation '{$this->move}'");
    }

    private function validateY(): bool
    {
        $y = $this->parseY();

        if ($y >= 0 && $y < Board::HEIGHT) {
            return true;
        }

        throw new InvalidMove("Invalid notation '{$this->move}'");
    }

    private function parseX(): int
    {
        return ord($this->parseCoordinates()[0]) - 97;
    }

    private function parseY(): int
    {
        return ((int) $this->parseCoordinates()[1]) - 1;
    }

    private function parseCoordinates(): string
    {
        return substr($this->move, -2, 2);
    }

    private function parsePiece(): string
    {
        $move_without_coordinates = str_replace($this->parseCoordinates(), '', $this->move);
        $piece = substr($move_without_coordinates, 0, 1);
        return match ($piece) {
            'B' => Bishop::class,
            'K' => King::class,
            'N' => Knight::class,
            'Q' => Queen::class,
            'R' => Rook::class,
            'x', '' => Pawn::class,
            default => throw new InvalidMove("No piece matches '{$this->move}'"),
        };
    }
}
