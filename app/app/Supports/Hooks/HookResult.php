<?php 
namespace App\Supports\Hooks;

final class HookResult
{
    public function __construct(
        public bool $stop = false,
        public mixed $payload
    ) {}

    public static function pass(mixed $payload): self
    {
        return new self(false, $payload);
    }

    public static function abort(mixed $payload = []): self
    {
        return new self(true, $payload);
    }
}
