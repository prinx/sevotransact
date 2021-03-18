<?php

namespace Txtpay\Abstracts;

use Respect\Validation\Rules\ArrayType;
use Respect\Validation\Rules\BoolType;
use Respect\Validation\Rules\Instance;
use Respect\Validation\Rules\Nullable;
use Respect\Validation\Rules\Optional;
use Respect\Validation\Rules\StringType;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Txtpay\Contracts\MobileMoneyResponseInterface;

abstract class MobileMoneyResponse implements MobileMoneyResponseInterface
{
    protected $responseBag = [];

    /**
     * Validation rules.
     *
     * @return \Respect\Validation\Validatable[]
     */
    public static function validationRules()
    {
        return [
            'isBeingProcessed' => new BoolType(),
            'body' => new ArrayType(),
            'bodyRaw' => new StringType(),
            'full' => new Instance(ResponseInterface::class),
            'error' => new Optional(new Nullable(new StringType())),
        ];
    }

    public function __construct(array $responseBag)
    {
        $responseBag['error'] = $responseBag['error'] ?? null;
        $this->validateResponse($responseBag);
        $this->responseBag = $responseBag;
    }

    /**
     * Validate response bag.
     *
     * @return void
     *
     * @throws \Respect\Validation\Exceptions\ValidationException
     */
    public function validateResponse(array $responseBag)
    {
        foreach (self::validationRules() as $key => $rule) {
            $rule->check($responseBag[$key] ?? null);
        }
    }

    abstract public function isBeingProcessed(): bool;

    /**
     * Error.
     *
     * @return string|null
     */
    abstract public function getError();

    abstract public function getBody(): array;

    abstract public function getBodyRaw(): string;

    abstract public function getFull(): ResponseInterface;

    abstract public function getStatus();

    abstract public function getTransactionId(): string;
}