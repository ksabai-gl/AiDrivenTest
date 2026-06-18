<?php

namespace Core\Authencation\Domain\Entities;

use Carbon\Carbon;

class Authencation
{
    public ?string $system_role = null;
    public function __construct(
        public string $email,
        public ?string $password = null,
        public ?string $name = null,
        public ?int $id = null,
        public ?string $email_verified_at = null,
        public ?string $bio = null,
        public ?string $avatar = null,
        public ?string $phone = null,
        public ?string $last_seen = null,
        public ?string $token = null,
        public ?string $lang = 'en',
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            email: $data['email'],
            password: $data['password'] ?? null,
            name: $data['name'] ?? null,
            id: $data['id'] ?? null,
            email_verified_at: !empty($data['email_verified_at']) 
                ? Carbon::parse($data['email_verified_at'])->format('Y-m-d H:i:s') 
                : null,
            bio: $data['bio'] ?? null,
            avatar: $data['avatar'] ?? null,
            phone: $data['phone'] ?? null,
            last_seen: $data['last_seen'] ?? null,
            lang: $data['lang'] ?? 'en'
        );
    }
    public function toArray(): array
    {
        $toArray = [
            'email' => $this->email,
            'password' => $this->password,
            'name'  => $this->name,
            'id'    => $this->id,
            'email_verified_at' => $this->email_verified_at,
            'bio' => $this->bio,
            'avatar' => $this->avatar,
            'phone' => $this->phone,
            'last_seen' => $this->last_seen,
            'lang' => $this->lang
        ];
        if($this->system_role) {
          $toArray['system_role'] = $this->system_role;
        }
        return $toArray;
    }
    public function response(): array
    {
        return [
            'email' => $this->email,
            'name'  => $this->name,
            'id'    => $this->id,
            'email_verified_at' => $this->email_verified_at,
            'bio' => $this->bio,
            'avatar' => $this->avatar,
            'phone' => $this->phone,
            'last_seen' => $this->last_seen,
            'token' => $this->token,
            'lang' => $this->lang
        ];
    }
    public function verifyAt() {
        $this->email_verified_at = Carbon::now()->format('Y-m-d H:i:s');
    }
    public function notVerify() {
        $this->email_verified_at = null;
    }
    public function lastSeen() {
        $this->last_seen = Carbon::now()->format('Y-m-d H:i:s');
    }
    public function markAdmin(){
        $this->system_role = "admin";
    }
    public function markMember(){
        $this->system_role = "member";
    }
}
