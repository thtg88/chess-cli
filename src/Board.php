<?php

namespace Thtg88\ChessCli;

use Thtg88\ChessCli\Exceptions\InvalidMove;
use Thtg88\ChessCli\Pieces\Bishop;
use Thtg88\ChessCli\Pieces\King;
use Thtg88\ChessCli\Pieces\Knight;
use Thtg88\ChessCli\Pieces\Pawn;
use Thtg88\ChessCli\Pieces\Queen;
use Thtg88\ChessCli\Pieces\Rook;

final class Board
{
    public const WIDTH = 8;
    public const HEIGHT = 8;

    public function __construct(
        private array $pieces,
        private readonly bool $visualise_destinations = false,
    ) {
    }

    public static function make(bool $visualise_piece_destinations): self
    {
        $pieces = self::startingPieces();

        return new self($pieces, $visualise_piece_destinations);
    }

    public function applyMove(Move $move, Color $active_color): void
    {
        /** @var \Thtg88\ChessCli\Pieces\Piece */
        foreach ($this->pieces as $idx => $piece) {
            // check if there's any other piece where we are moving
            foreach ($this->pieces as $other_idx => $other_piece) {
                // Skip same piece
                if ($idx === $other_idx) {
                    continue;
                }

                // TODO: check if different color - we are capturing!

                if ($other_piece->isAt($move->destination->x, $move->destination->y)) {
                    throw new InvalidMove('Another piece already at destination');
                }
            }

            if ($move->isValidFor($piece) && $active_color === $piece->color) {
                $this->pieces[$idx] = $piece->moveTo($move->destination);

                return;
            }
        }

        throw new InvalidMove('The specified piece can not be moved to the destination');
    }

    /**
     * Return the Forsyth-Edwards Notation (FEN) for this board.
     * Please note this function only returns the pieces on this board,
     * not the whole FEN notation for the given game round.
     */
    public function toFenString(): string
    {
        return implode('/', array_map(
            fn (array $row): string => implode('', $row),
            $this->toFenArray(),
        ));
    }

    public function toString(): string
    {
        return implode('', array_map(
            fn (array $row): string => implode('', $row) . PHP_EOL,
            $this->toArray(),
        ));
    }

    private function toArray(): array
    {
        $board = [self::HEIGHT + 1 => [' ', '0️⃣', ' 1️⃣', ' 2️⃣', ' 3️⃣', ' 4️⃣', ' 5️⃣', ' 6️⃣', ' 7️⃣']];

        for ($y = self::HEIGHT; $y > 0; $y--) {
            $board[$y] = [$y];

            for ($x = 0; $x < self::WIDTH; $x++) {
                /** @var \Thtg88\ChessCli\Pieces\Piece $piece */
                foreach ($this->pieces as $piece) {
                    if ($piece->isAt($x, $y - 1)) {
                        $board[$y][$x + 1] = $piece->toString();
                    }
                }

                if (!array_key_exists($x + 1, $board[$y])) {
                    $board[$y][$x + 1] = '🟩';
                }
            }

            $board[$y][] = $y - 1;
        }

        $board[$y] = [' ', ' A', ' B', ' C', ' D', ' E', ' F', ' G', ' H'];

        if ($this->visualise_destinations === true) {
            for ($x = 0; $x < self::WIDTH; $x++) {
                for ($y = 0; $y < self::HEIGHT; $y++) {
                    /** @var \Thtg88\ChessCli\Pieces\Piece $piece */
                    foreach ($this->pieces as $piece) {
                        $destinations = $piece->destinations();

                        /** @var \Thtg88\ChessCli\Destination $destination */
                        foreach ($destinations as $destination) {
                            if ($destination->isAt($x, $y)) {
                                $board[$y + 1][$x + 1] = '❌';
                            }
                        }
                    }
                }
            }
        }

        return $board;
    }

    private function toFenArray(): array
    {
        $board = [];

        for ($y = self::HEIGHT - 1; $y >= 0; $y--) {
            $board[$y] = [];
            $row_empty_piece_counter = 0;

            for ($x = 0; $x < self::WIDTH; $x++) {
                $piece_found = false;

                /** @var \Thtg88\ChessCli\Pieces\Piece $piece */
                foreach ($this->pieces as $piece) {
                    if ($piece->isAt($x, $y)) {
                        if ($row_empty_piece_counter !== 0) {
                            $board[$y][] = $row_empty_piece_counter;
                            $row_empty_piece_counter = 0;
                        }

                        $board[$y][] = $piece->toFenString();
                        $piece_found = true;
                        break;
                    }
                }

                if (!$piece_found) {
                    $row_empty_piece_counter++;
                }
            }

            if ($row_empty_piece_counter !== 0) {
                $board[$y][] = (string) $row_empty_piece_counter;
                $row_empty_piece_counter = 0;
            }
        }

        return $board;
    }

    private static function startingPieces(): array
    {
        return [
            // WHITE
            new Rook(0, 0, Color::WHITE),
            new Knight(1, 0, Color::WHITE),
            new Bishop(2, 0, Color::WHITE),
            new Queen(3, 0, Color::WHITE),
            new King(4, 0, Color::WHITE),
            new Bishop(5, 0, Color::WHITE),
            new Knight(6, 0, Color::WHITE),
            new Rook(7, 0, Color::WHITE),
            new Pawn(0, 1, Color::WHITE),
            new Pawn(1, 1, Color::WHITE),
            new Pawn(2, 1, Color::WHITE),
            new Pawn(3, 1, Color::WHITE),
            new Pawn(4, 1, Color::WHITE),
            new Pawn(5, 1, Color::WHITE),
            new Pawn(6, 1, Color::WHITE),
            new Pawn(7, 1, Color::WHITE),

            // BLACK
            new Rook(0, 7, Color::BLACK),
            new Knight(1, 7, Color::BLACK),
            new Bishop(2, 7, Color::BLACK),
            new Queen(3, 7, Color::BLACK),
            new King(4, 7, Color::BLACK),
            new Bishop(5, 7, Color::BLACK),
            new Knight(6, 7, Color::BLACK),
            new Rook(7, 7, Color::BLACK),
            new Pawn(0, 6, Color::BLACK),
            new Pawn(1, 6, Color::BLACK),
            new Pawn(2, 6, Color::BLACK),
            new Pawn(3, 6, Color::BLACK),
            new Pawn(4, 6, Color::BLACK),
            new Pawn(5, 6, Color::BLACK),
            new Pawn(6, 6, Color::BLACK),
            new Pawn(7, 6, Color::BLACK),
        ];
    }
}
