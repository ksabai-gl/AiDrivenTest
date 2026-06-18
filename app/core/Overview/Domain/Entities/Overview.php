<?php

namespace Core\Overview\Domain\Entities;

class Overview
{
    public float $compare = 0.0;

    public function __construct(
        public int $current = 0,
        public int $prev = 0,
        public string $compare_text = '',
        public string $type = '',
        public string $icon = 'bi bi-currency-dollar'
    ) {
        $this->makeCompare();
    }

    public static function fromArray(array $data): self
    {
        $context = new self(
            current: (int) ($data['current'] ?? 0),
            prev: (int) ($data['prev'] ?? 0),
            compare_text: (string) ($data['compare_text'] ?? ''),
            type: (string) ($data['type'] ?? ''),
            icon: (string) ($data['icon'] ?? 'bi bi-currency-dollar')
        );

        $context->makeCompare();

        return $context;
    }

    public function toArray(): array
    {
        $this->makeCompare();

        return [
            'current'       => $this->current,
            'prev'          => $this->prev,
            'compare'       => $this->compare,
            'compare_text'  => $this->compare_text,
            'type'          => $this->type,
            'icon'          => $this->icon,
        ];
    }

    private function makeCompare(): void
    {
        if ($this->prev === 0) {
            $this->compare = $this->current > 0 ? 100.0 : 0.0;
            return;
        }

        $this->compare = round(
            (($this->current - $this->prev) / $this->prev) * 100,
            2
        );
    }
}
