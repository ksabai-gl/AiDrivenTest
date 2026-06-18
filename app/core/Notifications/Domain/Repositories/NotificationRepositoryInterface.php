<?php

namespace Core\Notifications\Domain\Repositories;

use Core\Notifications\Domain\Entities\Notification;

interface NotificationRepositoryInterface
{
    public function create(Notification $entity): Notification;
    public function insertMany(array $data) : array;
    public function index(array $data) : array;
    public function update(Notification $entity): Notification;
    public function findById(array $data) : ?Notification;
    public function delete(Notification $entity): Notification;
}