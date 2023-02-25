<?php

namespace Thtg88\ChessCli;

final class Game
{
    public function __construct(
        private readonly bool $debug = false,
        private ?Board $board = null,
        private Color $active_color = Color::WHITE,
        private int $half_move_clock = 0,
        private int $fullmove_number = 1,
        private readonly bool $visualise_piece_destinations = false,
    ) {
        $this->board = $board ?? Board::make($visualise_piece_destinations);
    }

    public function draw(): void
    {
        $this->clearScreen();

        echo $this->board->toString() . PHP_EOL . PHP_EOL;
        echo "FEN: {$this->toFenString()}" . PHP_EOL . PHP_EOL;

        echo 'Next move: ';
    }

    public function applyMove(Move $move): void
    {
        $this->board->applyMove($move, $this->active_color);

        if ($this->debug) {
            echo "Moved {$move->piece_classname} to x:{$move->destination->x} y:{$move->destination->y}" . PHP_EOL;
        }

        if ($this->active_color === Color::BLACK) {
            $this->fullmove_number = $this->fullmove_number + 1;
        }

        $this->active_color = $this->active_color->opposite();
    }

    public function toFenString(): string
    {
        // TODO: add castling rights (-)
        // TODO: add en-passant targets (-)
        return "{$this->board->toFenString()} {$this->active_color->toFenString()} - - {$this->half_move_clock} {$this->fullmove_number}";
    }

    private function clearScreen(): void
    {
        if ($this->debug) {
            return;
        }

        echo "\e[H\e[J";
    }
}
