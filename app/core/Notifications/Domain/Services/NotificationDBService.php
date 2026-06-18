<?php

namespace Core\Notifications\Domain\Services;

use App\Exceptions\BadException;
use Core\Notifications\Domain\Entities\Notification;

interface NotificationDBService
{
    public function create(array $data): Notification;
    public function insertMany(array $data) : array;
    public function index(array $data) : array;
    public function update(array $data): Notification | BadException;
    public function delete(array $data): Notification | BadException;
}