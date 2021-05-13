<?php

/*
 * This file is part of the Txtpay package.
 *
 * (c) Prince Dorcis <princedorcis@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Prinx\Sevotransact\Callback;

use Prinx\Sevotransact\Callback;
use Prinx\Sevotransact\Contracts\CallbackHandlerInterface;

class Handler implements CallbackHandlerInterface
{
    public function callbacks(Callback $callback)
    {
        return [
            // ['000', ''],
            // ['success', ''],
            // ['failure', ''],
        ];
    }
}
