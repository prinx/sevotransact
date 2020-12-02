<?php

namespace Tests\Unit;

use Tests\TestCase;
use Txtpay\Callback;
use Txtpay\Helpers\Tests\CallbackHandlerWithCallbackClosureInArray;
use Txtpay\MobileMoney;

class CallbackHandlerWithCallbackClosureInArrayTest extends TestCase
{

    public function testMustRunProvidedCallbacksIfConditionsMatchFromCallbackHandlerClass()
    {
        $id = (new MobileMoney)->getTransactionId();
        $messages = Callback::getMessages(null, $id);

        $_POST = [
            'status'            => 'test',
            'reason'            => 'test',
            'transaction_id'    => $id,
            'r_switch'          => 'test',
            'subscriber_number' => '23354545454545',
            'amount'            => 1,
            'currency'          => 'GHS',
        ];
        
        foreach ($messages as $code => $expectedMessage) {
            if ($code === 'default') {
                continue;
            }

            $_POST['code'] = $code;

            $callback = new Callback;
            ob_start();
            $callback->process(CallbackHandlerWithCallbackClosureInArray::class);
            $echoed = ob_get_clean();

            if ($callback->isSuccessful()) {
                $this->assertStringContainsString('__Success____Success__', $echoed);
            } elseif ($callback->failed()) {
                $this->assertStringContainsString('__Failure____Failure__', $echoed);
            }

            $this->assertStringContainsString('__'.$code.'____'.$code.'__', $echoed);
        }
    }
}