<?php

namespace Thtg88\ChessCli;

final class DestinationCollection
{
    public function __construct(public readonly array $destinations = [])
    {
    }

    public function push(Destination $destination): self
    {
        $destinations = array_map(static function (Destination $destination) {
            return $destination->clone();
        }, $this->destinations);

        $destinations[] = $destination->clone();

        return new self($destinations);
    }

    public function sort(): self
    {
        $destinations = [];

        for ($x = 0; $x < Board::WIDTH; $x++) {
            for ($y = 0; $y < Board::WIDTH; $y++) {
                /** @var \Thtg88\ChessCli\Destination $destination */
                foreach ($this->destinations as $destination) {
                    if ($destination->isAt($x, $y)) {
                        $destinations[] = $destination->clone();
                    }
                }
            }
        }

        return new self($destinations);
    }
}
