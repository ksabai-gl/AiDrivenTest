<?php 
namespace App\Supports\Forms;
final class SearchIndexRender {
    function __construct(
    private string $type = SearchFieldType::SEARCH,
    private ?string $placeholder = null,
    private ?array $options = [],
    private string $label = '',
    private string $key = ''
    ) {

    }
    public function toArray(){
        return [
            'type' => $this->type,
            'placeholder' => $this->placeholder,
            'options' => $this->options,
            'label' => $this->label,
            'key'   => $this->key
        ];
    }
}
