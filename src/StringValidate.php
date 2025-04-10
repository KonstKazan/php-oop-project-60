<?php

namespace Hexlet\Code;

class StringValidate extends Validator
{
    private bool|int $minLength = false;
    public string $contains = '';
//    private bool $required = false;
    private array $result = [
        'required' => true,
        'contains' => true,
        'minLength' => true,
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
            }
        }
        return !in_array(false, $this->result, true);
    }

    public function required(): static
    {
//        $this->required = true;
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
}
