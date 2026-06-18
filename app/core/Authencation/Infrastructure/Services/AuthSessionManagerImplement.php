<?php 
namespace Core\Authencation\Infrastructure\Services;

use Core\Authencation\Domain\Services\AuthSessionManager;
use Illuminate\Support\Facades\Auth;

class AuthSessionManagerImplement implements AuthSessionManager {
    public function logout(): void {
        if(Auth::check()) {
            Auth::logout();
            session()->invalidate();
            session()->regenerateToken();    
        }
    }
    public function login(array $data): void {
        Auth::loginUsingId($data['id']);
    }
}

