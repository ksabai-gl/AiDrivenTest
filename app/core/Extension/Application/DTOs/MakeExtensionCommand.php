<?php

namespace Core\Extension\Application\DTOs;

class MakeExtensionCommand
{
    private function __construct(
        public string $directory,
        public string $name,
        public string $version,
        public ?string $description,
        public bool $verified,
        public bool $status,
        public ?string $author = null,
        public ?string $icon = null,
        public ?string $support_version = null,
        public ?string $email = null
    ) {}


    public static function fromArray(array $data): self
    {
        return new self(
            directory: (string) ($data['directory'] ?? ''),
            name: (string) ($data['name'] ?? 'Unknown Extension'),
            version: (string) ($data['version'] ?? '0.0.0'),
            description: $data['description'] ?? null,
            verified: (bool) ($data['verified'] ?? false),
            status: (bool) ($data['status'] ?? false),
            author: $data['author'] ?? null,
            icon: $data['icon'] ?? 'bi bi-gear',
            support_version: $data['support_version'] ?? null,
            email: $data['email'] ?? null
        );
    }


    public function toArray(): array
    {
        $this->currentDirectory();
        return [
            'directory'        => $this->directory,
            'name'        => $this->name,
            'version'     => $this->version,
            'description' => $this->description,
            'verified'    => $this->verified,
            'status'     => $this->status,
            'author' => $this->author,
            'icon'  => $this->icon,
            'support_version' => $this->support_version,
            'email'=> $this->email
        ];
    }

    public function currentDirectory() : string
    {
        if($this->directory === '') {
            return $this->directory;
        }
        $directory = explode('/',$this->directory);
        $this->directory = $directory[count($directory) - 1];
        return $this->directory;
    }

    /* ---------- Getters ---------- */

    public function directory(): string
    {
        return $this->directory;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function version(): string
    {
        return $this->version;
    }

    public function description(): ?string
    {
        return $this->description;
    }

    public function isVerified(): bool
    {
        return $this->verified;
    }

    public function isEnabled(): bool
    {
        return $this->status;
    }

    /* ---------- Domain behavior ---------- */

    public function enable()
    {
        $this->status = true;
    }

    public function disable()
    {
        $this->status = false;
    }
    public function switchStatus(){
        $this->status = $this->status ? false : true;
    }
}
