<?php

namespace Core\Authencation\Application\UseCases;

use Core\AppToken\Application\UseCases\ParseAppToken;
use Core\Authencation\Application\DTOs\VerifyAuthencationRequest;
use Core\Authencation\Domain\Services\AuthencationService;

class VerifyAuthencation
{
    public function __construct(private AuthencationService $service,
    private ParseAppToken $parseAppToken) {}

    public function handle(VerifyAuthencationRequest $data)
    {
        $tokenData = $this->parseAppToken->handle($data->token);
        return $this->service->verify([
            'id' => $tokenData->data->id
        ]);
    }
}