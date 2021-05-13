<?php

/*
 * This file is part of the Sevotransact package.
 *
 * (c) Prince Dorcis <princedorcis@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Prinx\Sevotransact\Laravel;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Prinx\Sevotransact\Callback;
use Prinx\Sevotransact\Contracts\CallbackInterface;
use Prinx\Sevotransact\Contracts\MobileMoneyInterface;
use Prinx\Sevotransact\MobileMoney;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(MobileMoneyInterface::class, MobileMoney::class);
        $this->app->bind(CallbackInterface::class, Callback::class);
    }

    public function provides()
    {
        return [MobileMoneyInterface::class, CallbackInterface::class];
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
