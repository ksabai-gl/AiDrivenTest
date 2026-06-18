<?php

namespace Core\Authencation\Http\Controllers;

use Core\Authencation\Application\UseCases\CreateAuthencation;
use Core\Authencation\Application\DTOs\CreateAuthencationRequest;
use Core\Authencation\Application\DTOs\ForgetAuthencationRequest as DTOsForgetAuthencationRequest;
use Core\Authencation\Application\DTOs\ResetAuthencationRequest as DTOsResetAuthencationRequest;
use Core\Authencation\Application\DTOs\UpdateAuthencationRequest as DTOsUpdateAuthencationRequest;
use Core\Authencation\Application\DTOs\VerifyAuthencationRequest as DTOsVerifyAuthencationRequest;
use Core\Authencation\Application\UseCases\ForgetAuthencation;
use Core\Authencation\Application\UseCases\LoginAuthencation;
use Core\Authencation\Application\UseCases\ProfileAuthencation;
use Core\Authencation\Application\UseCases\ResetAuthencation;
use Core\Authencation\Application\UseCases\UpdateAuthencation;
use Core\Authencation\Application\UseCases\VerifyAuthencation;
use Core\Authencation\Http\Requests\CreateAuthencationRequest as FormRequest;
use Core\Authencation\Http\Requests\ForgetAuthencationRequest;
use Core\Authencation\Http\Requests\LoginAuthencationRequest;
use Core\Authencation\Http\Requests\ProfileAuthencationRequest;
use Core\Authencation\Http\Requests\ResetAuthencationRequest;
use Core\Authencation\Http\Requests\UpdateAuthencationRequest;
use Core\Authencation\Http\Requests\VerifyAuthencationRequest;

class AuthencationController
{
    public function register(FormRequest $request, CreateAuthencation $useCase)
    {
        $dto = CreateAuthencationRequest::fromArray($request->all());
        $entity = $useCase->handle($dto);
        return response()->json(['message' => $entity]);
    }
    public function profile(ProfileAuthencationRequest $request, ProfileAuthencation $useCase)
    {
        $entity = $useCase->handle($request->all());
        return response()->json(['message' => $entity]);
    }
    public function update(
        UpdateAuthencationRequest $request,
        UpdateAuthencation $useCase
    ) {
        $dto = DTOsUpdateAuthencationRequest::fromArray($request->all());
        $entity = $useCase->handle($dto);
        return response()->json(['message' => $entity]);
    }
    public function login(LoginAuthencation $useCase, LoginAuthencationRequest $request)
    {
        $dto = CreateAuthencationRequest::fromArray($request->all());
        $entity = $useCase->handle($dto);
        return response()->json(['message' => $entity]);
    }
    public function verify(
        VerifyAuthencation $useCase,
        VerifyAuthencationRequest $request
    ) {
        $dto = DTOsVerifyAuthencationRequest::fromArray($request->all());
        $entity = $useCase->handle($dto);
        return response()->json(['message' => $entity]);
    }
    public function forgetPassword(
        ForgetAuthencationRequest $request,
        ForgetAuthencation $useCase
    ){
        $dto = DTOsForgetAuthencationRequest::fromArray($request->all());
        $entity = $useCase->handle($dto);
        return response()->json(['message' => $entity]);
    }
    public function resetPassword(
        ResetAuthencation $useCase,
        ResetAuthencationRequest $request
    ) {
        $dto = DTOsResetAuthencationRequest::fromArray($request->all());
        $entity = $useCase->handle($dto);
        return response()->json(['message' => $entity]);
    }
}
