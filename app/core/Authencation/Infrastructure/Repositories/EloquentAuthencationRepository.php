<?php

namespace Core\Authencation\Infrastructure\Repositories;

use App\Models\User;
use Core\Authencation\Domain\Repositories\AuthencationRepositoryInterface;
use Core\Authencation\Domain\Entities\Authencation;
use Illuminate\Support\Facades\Cache;

class EloquentAuthencationRepository implements AuthencationRepositoryInterface
{
    public function create(Authencation $entity): Authencation
    {
        $create = User::create($entity->toArray());
        $entity->id = $create['id'];
        return $entity;
    }
    public function findByEmail(string $email): ?Authencation
    {
        $user = User::where('email',$email)->first();
        if(!$user) {
            return null;
        }
        $entity = Authencation::fromArray($user->toArray());
        $entity->password = $user->password;
        return $entity;
    }
    public function token(Authencation $entity): string
    {
        $user = User::where('email',$entity->email)->first();
        $user->tokens()->delete();
        return $user->createToken("*")->plainTextToken;
    }
    public function findById(int $id): ?Authencation
    {
        $user = User::where('id',$id)->first();
        if(!$user) {
            return null;
        }
        $entity = Authencation::fromArray($user->toArray());
        $entity->password = $user->password;
        return $entity;
    }
    public function update(Authencation $entity): Authencation
    {
        User::where('id',$entity->id)
        ->update($entity->toArray());
        $entity->password = null;
        return $entity;
    }
}