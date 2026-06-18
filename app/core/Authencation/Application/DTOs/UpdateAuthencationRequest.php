<?php

namespace Core\Authencation\Application\DTOs;

class UpdateAuthencationRequest
{
    public function __construct(
        public string $email,
        public ?string $password,
        public ?string $new_password,
        public string $name,
        public string $phone,
        public ?string $bio,
        public ?string $avatar,
        public ?int $id,
        public ?string $lang = null
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            email: $data['email'],
            password: $data['password'] ?? null,
            name: $data['name'],
            phone: $data['phone'],
            id: $data['id'] ?? null,
            new_password: $data['new_password'] ?? null,
            bio: $data['bio'] ?? null,
            avatar: $data['avatar'] ?? null,
            lang: $data['lang'] ?? null
        );
    }
    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
            'name'  => $this->name,
            'phone' => $this->phone,
            'id'    => $this->id,
            'new_password'  => $this->new_password,
            'bio'   => $this->bio,
            'avatar'    => $this->avatar,
            'lang'=> $this->lang,
        ];
    }
}