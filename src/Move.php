<?php

namespace Thtg88\ChessCli;

use Thtg88\ChessCli\Pieces\Piece;

final class Move
{
    public function __construct(
        public readonly string $piece_classname,
        public readonly Destination $destination,
    ) {
    }

    public function isValidFor(Piece $piece): bool
    {
        if (get_class($piece) !== $this->piece_classname) {
            return false;
        }

        foreach ($piece->destinations() as $possible_destination) {
            if ($this->destination->isAt($possible_destination->x, $possible_destination->y)) {
                return true;
            }
        }

        return false;
    }
}
