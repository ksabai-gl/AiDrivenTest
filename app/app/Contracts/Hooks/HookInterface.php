<?php 
namespace App\Contracts\Hooks;

use App\Supports\Hooks\HookContext;
use App\Supports\Hooks\HookResult;

interface HookInterface
{
    public static function supports(HookContext $context): bool;

    public function handle(HookContext $context): HookResult;
}
