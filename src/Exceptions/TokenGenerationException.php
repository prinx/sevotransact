<?php

/*
 * This file is part of the Sevotransact package.
 *
 * (c) Prince Dorcis <princedorcis@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Prinx\Sevotransact\Exceptions;

class TokenGenerationException extends \Exception
{
    public function __construct($message = '', $code = 0)
    {
        $message = $message ?: 'Cannot generate token. A possible reason is invalid API credentials.';
        parent::__construct($message, $code);
    }
}
