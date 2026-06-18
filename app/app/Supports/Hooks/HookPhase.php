<?php 
namespace App\Supports\Hooks;

final class HookPhase
{
    public const VALIDATE = 'validate';
    public const RESPONSE = 'response';
    public const UI = 'ui';
    public const QUERY = 'query';
}
