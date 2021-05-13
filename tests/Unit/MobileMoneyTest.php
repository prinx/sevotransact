<?php

/*
 * This file is part of the Sevotransact package.
 *
 * (c) Prince Dorcis <princedorcis@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Tests\Unit;

use function Prinx\Dotenv\env;
use function Prinx\Dotenv\persistEnv;
use Tests\TestCase;
use Prinx\Sevotransact\MobileMoney;

class MobileMoneyTest extends TestCase
{
    protected $defaultConfig = [
        'SEVOTRANSACT_ID'                 => 'your_sevotransact_id',
        'SEVOTRANSACT_KEY'                => 'your_sevotransact_key',
        'SEVOTRANSACT_ACCOUNT'            => 'your_sevotransact_account',
        'SEVOTRANSACT_NICKNAME'           => 'your_sevotransact_nickname',
        'SEVOTRANSACT_DESCRIPTION'        => 'your_sevotransact_description',
        'SEVOTRANSACT_PRIMARY_CALLBACK'   => 'primary_callback',
        'SEVOTRANSACT_SECONDARY_CALLBACK' => 'secondary_callback',
    ];

    public function testAutoConfig()
    {
        $this->runConfigTest();
    }

    public function testConfigWithPrefix()
    {
        $this->runConfigTest('PREFIX_');
    }

    public function testConfigWithSuffix()
    {
        $this->runConfigTest('', '_SUFFIX');
    }

    public function testConfigWithPrefixAndSuffix()
    {
        $this->runConfigTest('PREFIX_', '_SUFFIX');
    }

    /**
     * Test make request.
     * To run this test kindly update the .env.bis file true api credentials.
     *
     * @return void
     */
    public function testMakeRequest()
    {
        $this->loadEnv(realpath(__DIR__.'/../../').'/.env.bis');

        $payment = new MobileMoney();

        $amount = 0.2;
        $phone = env('TEST_PHONE');
        $network = 'MTN';

        $request = $payment->request($amount, $phone, $network);

        // dump($request);
        $this->assertTrue($request->isBeingProcessed());
        $this->assertEquals($request->getTransactionId(), $payment->getTransactionId());
    }

    public function runConfigTest($prefix = '', $suffix = '')
    {
        $this->loadEnv(realpath(__DIR__.'/../../').'/.env');

        $this->fillEnvWithConfig($prefix, $suffix);

        $payment = new MobileMoney();

        $payment->configure();
        $this->assertEquals($payment->getApiId(), env($prefix.'SEVOTRANSACT_ID'.$suffix));
        $this->assertEquals($payment->getApiKey(), env($prefix.'SEVOTRANSACT_KEY'.$suffix));
        $this->assertEquals($payment->getAccount(), env($prefix.'SEVOTRANSACT_ACCOUNT'.$suffix));
        $this->assertEquals($payment->getNickname(), env($prefix.'SEVOTRANSACT_NICKNAME'.$suffix));
        $this->assertEquals($payment->getDescription(), env($prefix.'SEVOTRANSACT_DESCRIPTION'.$suffix));
        $this->assertEquals($payment->getPrimaryCallback(), env($prefix.'SEVOTRANSACT_PRIMARY_CALLBACK'.$suffix));
        $this->assertEquals($payment->getSecondaryCallback(), env($prefix.'SEVOTRANSACT_SECONDARY_CALLBACK'.$suffix));
    }

    public function fillenvWithConfig($prefix = '', $suffix = '')
    {
        $env = realpath(__DIR__.'/../../').'/.env';
        $this->createEnvIfNotExist($env);

        foreach ($this->defaultConfig as $key => $value) {
            persistEnv($prefix.$key.$suffix, $value);
        }
    }
}
