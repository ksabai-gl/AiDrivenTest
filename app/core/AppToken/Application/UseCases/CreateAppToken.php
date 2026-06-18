<?php

namespace Core\AppToken\Application\UseCases;

use Core\AppToken\Application\DTOs\CreateAppTokenRequest;
use Core\AppToken\Domain\Services\AppTokenService;
use Firebase\JWT\JWT;

class CreateAppToken
{
    private string $privateKey;
    private string $algorithm;
    public function __construct(private AppTokenService $service) {
        $this->privateKey = file_get_contents(base_path(env('JWT_PRIVATE_KEY_PATH')));
        $this->algorithm = env('JWT_TYPE');
    }

    public function handle(CreateAppTokenRequest $dto)
    {
        $this->service->create($dto->toArray());
        return JWT::encode([
            'iss' => config('APP_URL'),
            'aud' => 'erp-dashboard',
            'iat' => time(),
            'nbf' => time(),
            'exp' => time() + (60 * $dto->exp),
            'sub' => $dto->id,
            'data' => $dto->data
        ], $this->privateKey, $this->algorithm);
    }
}