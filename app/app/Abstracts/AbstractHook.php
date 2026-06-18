<?php
namespace App\Abstracts;
use App\Supports\Hooks\HookContext;
use App\Contracts\Hooks\HookInterface;

abstract class AbstractHook implements HookInterface
{
    protected array $supports = [
        'action' => [],
        'phase'  => [],
        'timing' => [],
    ];

    public static function supports(HookContext $context): bool
    {
        $self = new static;

        return
            self::match($self->supports['action'], $context->action) &&
            self::match($self->supports['phase'],  $context->phase) &&
            self::match($self->supports['timing'], $context->timing);
    }

    protected static function match(array $allowed, string $value): bool
    {
        return empty($allowed) || in_array($value, $allowed, true);
    }
}
