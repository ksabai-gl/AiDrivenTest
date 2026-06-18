<?php

namespace Core\Supplier\Http\Requests;

use App\Supports\Hooks\HookAction;
use App\Supports\Hooks\HookContext;
use App\Supports\Hooks\HookDispatcher;
use App\Supports\Hooks\HookPhase;
use App\Supports\Hooks\HookTiming;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSupplierRequest extends FormRequest
{
    public function rules(HookDispatcher $hooks): array
    {
        return [
            'unit_name'     => 'required|string|max:150',
            'email'         => 'nullable|email|max:150',
            'phone'         => 'required|string|max:20',
            'address'       => 'required|string|max:150',
            'tax_code'      => 'required|string|max:50',
            'bank_name'     => 'nullable|string|max:150',
            'bank_account'  => 'nullable|string|max:100',
            'website'       => 'nullable|url|max:150',
            'note'          => 'nullable|string|max:250',
            'active'        => 'required|boolean',
            ...$hooks->dispatch(
                new HookContext(
                    action: HookAction::UPDATE,
                    phase: HookPhase::VALIDATE,
                    timing: HookTiming::ON,
                    payload: [],
                    module: 'Supplier'
                )
            )
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
