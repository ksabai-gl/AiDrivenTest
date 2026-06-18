<?php

namespace Core\AppToken\Application\UseCases;

use App\Exceptions\UnauthorizedException;
use Core\AppToken\Domain\Services\AppTokenService;
use DomainException;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\SignatureInvalidException;
use InvalidArgumentException;
use UnexpectedValueException;

class ParseAppToken
{
    private string $publicKey;
    private string $algorithm;
    public function __construct(private AppTokenService $service) {
        $this->publicKey = file_get_contents(base_path(env('JWT_PUBLIC_KEY_PATH')));
        $this->algorithm = env('JWT_TYPE');
    }

    public function handle(string $token)
    {
        try {
            return JWT::decode($token, new Key($this->publicKey, $this->algorithm));
        } catch (InvalidArgumentException $e) {
            throw new UnauthorizedException(__("You has been verified account to failed"));
        } catch (DomainException $e) {
            throw new UnauthorizedException(__("You has been verified account to failed"));
        } catch (SignatureInvalidException $e) {
            throw new UnauthorizedException(__("You has been verified account to failed"));
        } catch (BeforeValidException $e) {
            throw new UnauthorizedException(__("You has been verified account to failed"));
        } catch (ExpiredException $e) {
            throw new UnauthorizedException(__("Your token is expire"));
        } catch (UnexpectedValueException $e) {
            throw new UnauthorizedException(__("You has been verified account to failed"));
        };
    }
}