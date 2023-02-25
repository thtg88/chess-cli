<?php

namespace Thtg88\ChessCli\Exceptions;

use InvalidArgumentException;

final class InvalidMove extends InvalidArgumentException
{
    public function __construct($message = 'Invalid move')
    {
        parent::__construct($message);
    }
}
