<?php

namespace Core\Authencation\Domain\Repositories;

use Core\Authencation\Domain\Entities\Authencation;

interface AuthencationRepositoryInterface
{
    public function create(Authencation $entity): Authencation;
    public function token(Authencation $entity): string;
    public function findByEmail(string $email): ?Authencation;
    public function findById(int $id): ?Authencation;
    public function update(Authencation $entity) : Authencation;
}