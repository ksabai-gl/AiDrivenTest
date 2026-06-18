<?php

namespace Core\Extension\Application\DTOs;

class CreateExtensionRequest
{
    public function __construct(
        public \Illuminate\Http\UploadedFile $file
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            file: $data['file']
        );
    }
    public function toArray(): array
    {
        return [
            'file' => $this->file
        ];
    }
}