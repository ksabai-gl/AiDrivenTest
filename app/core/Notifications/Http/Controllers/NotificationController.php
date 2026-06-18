<?php

namespace Core\Notifications\Http\Controllers;

use Core\Notifications\Application\DTOs\DeleteNotificationRequest as DTOsDeleteNotificationRequest;
use Core\Notifications\Application\DTOs\IndexNotificationRequest as DTOsIndexNotificationRequest;
use Core\Notifications\Application\DTOs\UpdateNotificationRequest as DTOsUpdateNotificationRequest;
use Core\Notifications\Application\UseCases\DeleteNotification;
use Core\Notifications\Application\UseCases\IndexNotification;
use Core\Notifications\Application\UseCases\UpdateNotification;
use Core\Notifications\Http\Requests\DeleteNotificationRequest;
use Core\Notifications\Http\Requests\IndexNotificationRequest;
use Core\Notifications\Http\Requests\UpdateNotificationRequest;

class NotificationController
{
    public function index(IndexNotificationRequest $request, IndexNotification $useCase)
    {
        $dto = DTOsIndexNotificationRequest::fromArray($request->all());
        $entity = $useCase->handle($dto);
        return response()->json(['message' => $entity]);
    }
    public function update(
        UpdateNotificationRequest $request,
        UpdateNotification $useCase,
        string $id
    ) {
        $request->merge(['id' => $id]);
        $dto = DTOsUpdateNotificationRequest::fromArray($request->all());
        $entity = $useCase->handle($dto);
        return response()->json(['message' => $entity]);
    }
    public function destroy(
        DeleteNotificationRequest $request,
        DeleteNotification $useCase,
        string $id
    ) {
        $request->merge(['id' => $id]);
        $dto = DTOsDeleteNotificationRequest::fromArray($request->all());
        $entity = $useCase->handle($dto);
        return response()->json(['message' => $entity]);
    }
}
