<?php 
namespace Core\Authencation\Domain\Services;
interface AuthSessionManager {
    public function login(array $data): void;
    public function logout(): void;
}
