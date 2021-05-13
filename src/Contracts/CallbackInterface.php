<?php

/*
 * This file is part of the Txtpay package.
 *
 * (c) Prince Dorcis <princedorcis@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Prinx\Sevotransact\Contracts;

/**
 * CallbackInterface.
 */
interface CallbackInterface
{
    /**
     * Register the callback if conditions match the request parameters.
     *
     * @param string|array $conditions String or associative array matching the request parameters.
     *                                 If string, the parameter is the defaultConditionName.
     * @param callable      $callback
     *
     * @return $this
     */
    public function on($conditions, callable $callback);

    /**
     * Register callback if the transaction is successful.
     *
     * The successful transaction is determined by the code of the request.
     *
     * @param callable $callback
     *
     * @return $this
     */
    public function success(callable $callback);

    /**
     * Run callback if the transaction has failed.
     *
     * The failed request is determined by the code of the request.
     *
     * @param callable $callback
     *
     * @return $this
     */
    public function failure(callable $callback);

    /**
     * Run callback whether the transaction is successful or not.
     *
     * @param callable $callback
     *
     * @return $this
     */
    public function always(callable $callback);

    /**
     * Register callback.
     *
     * @param callable $callback
     *
     * @return $this
     */
    public function register(callable $callback);

    /**
     * Run the registered callbacks against the callback request.
     *
     * @param callable $callback Optional callback that will be run after all the callbacks have been run.
     *
     * @return $this
     */
    public function process(callable $callback = null);

    public function isSuccessful();

    public function failed();
}
