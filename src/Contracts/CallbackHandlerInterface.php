<?php

/*
 * This file is part of the Sevotransact package.
 *
 * (c) Prince Dorcis <princedorcis@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Prinx\Sevotransact\Contracts;

use Prinx\Sevotransact\Callback;

interface CallbackHandlerInterface
{
    public function callbacks(Callback $callback);
}
