<?php 
namespace App\Supports\Forms;
final class IndexFieldRender {
    function __construct(
    private string $type = IndexFieldType::TEXT,
    private ?string $value = null,
    private string $key = '',
    private string $label = ''
    ) {

    }
    public function toArray(){
        return [
            'type' => $this->type,
            'value' => $this->value,
            'key' => $this->key,
            'label' => $this->label
        ];
    }
}
