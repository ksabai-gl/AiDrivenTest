<?php 
namespace App\Supports\Hooks;

final class HookContext
{
    public function __construct(
        public readonly string $action,   // index | create | update | delete | show
        public readonly string $phase,    // validate | event | response | view
        public readonly string $timing,   // before | after | on
        public readonly string $module,   // module name
        public array $payload
    ) {}
    public static function fromArray(array $data) : self{
        return new self(
            action: $data['action'],
            phase: $data['phase'],
            timing: $data['timing'],
            module: $data['module'],
            payload: $data['payload']
        );
    }
}
