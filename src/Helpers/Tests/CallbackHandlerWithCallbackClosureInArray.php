<?php

/*
 * This file is part of the Sevotransact package.
 *
 * (c) Prince Dorcis <princedorcis@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Prinx\Sevotransact\Helpers\Tests;

use Prinx\Sevotransact\Callback;
use Prinx\Sevotransact\Contracts\CallbackHandlerInterface;

class CallbackHandlerWithCallbackClosureInArray implements CallbackHandlerInterface
{
    public function callbacks(Callback $callback)
    {
        return [
            ['000', [
                function (Callback $callback) { echo '__000__'; },
                function (Callback $callback) { echo '__000__'; },
            ]],
            ['101', [
                function (Callback $callback) { echo '__101__'; },
                function (Callback $callback) { echo '__101__'; },
            ]],
            ['102', [
                function (Callback $callback) { echo '__102__'; },
                function (Callback $callback) { echo '__102__'; },
            ]],
            ['103', [
                function (Callback $callback) { echo '__103__'; },
                function (Callback $callback) { echo '__103__'; },
            ]],
            ['104', [
                function (Callback $callback) { echo '__104__'; },
                function (Callback $callback) { echo '__104__'; },
            ]],
            ['114', [
                function (Callback $callback) { echo '__114__'; },
                function (Callback $callback) { echo '__114__'; },
            ]],
            ['600', [
                function (Callback $callback) { echo '__600__'; },
                function (Callback $callback) { echo '__600__'; },
            ]],
            ['909', [
                function (Callback $callback) { echo '__909__'; },
                function (Callback $callback) { echo '__909__'; },
            ]],
            ['success', [
                function (Callback $callback) { echo '__Success__'; },
                function (Callback $callback) { echo '__Success__'; },
            ]],
            ['failure', [
                function (Callback $callback) { echo '__Failure__'; },
                function (Callback $callback) { echo '__Failure__'; },
            ]],
        ];
    }
}
