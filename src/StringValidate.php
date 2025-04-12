<?php

namespace Hexlet\Code;

use function _PHPStan_f2f2ddf44\React\Async\parallel;

class StringValidate extends Validator
{
    private bool|int $minLength = false;
    public string $contains = '';
    private array $result = [
        'required' => true,
        'contains' => true,
        'minLength' => true,
        'custom' => true,
    ];
    private array $resultDefault = [
        'required' => true,
        'contains' => true,
        'minLength' => true,
        'custom' => true,
    ];
    private array $rules = [];
    public function isValid(string|null $value): bool
    {
        foreach ($this->rules as $rule) {
            switch ($rule) {
                case 'required':
                    if ($value === null || $value === '') {
                        $this->result['required'] = false;
                    }
                    break;
                case 'contains':
                    if ($value === null || !str_contains($value, $this->contains)) {
                        $this->result['contains'] = false;
                    }
                    break;
                case 'minLength':
                    if ($value === null || strlen($value) < $this->minLength) {
                        $this->result['minLength'] = false;
                    }
                    break;
                case 'custom':
                    $fn = parent::$customValidator['fn'];
                    $this->result['custom'] = $fn($value, parent::$customValidator['value']);
            }
        }
        $result = !in_array(false, $this->result, true);
        $this->result = array_merge($this->result, $this->resultDefault);
        return $result;
    }

    public function required(): static
    {
        $this->rules[] = 'required';
        return $this;
    }

    public function contains(string $find): static
    {
        $this->contains = $find;
        $this->rules[] = 'contains';
        return $this;
    }

    public function minLength(int $length): static
    {
        $this->minLength = $length;
        $this->rules[] = 'minLength';
        return $this;
    }

    public function test(string $name, string $value): static
    {
        parent::$customValidator['value'] = $value;
        $this->rules[] = 'custom';
        return $this;
    }
}
