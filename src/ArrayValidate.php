<?php

namespace Hexlet\Validator;

class ArrayValidate
{
    private array $result = [
        'required' => true,
        'sizeof' => true,
        'shape' => true,
    ];
    private array $resultDefault = [
        'required' => true,
        'sizeof' => true,
        'shape' => true,
    ];
    private array $rules = [];
    private bool|int $size = false;
    private array $shape = [];

    public function isValid(mixed $value): bool
    {
        foreach ($this->rules as $rule) {
            switch ($rule) {
                case 'required':
                    if (!is_array($value)) {
                        $this->result['required'] = false;
                    }
                    break;
                case 'sizeof':
                    if (count($value) !== $this->size) {
                        $this->result['sizeof'] = false;
                    }
                    break;
                case 'shape':
                    $innerResult = [];
                    foreach ($this->shape as $key => $innerRule) {
                        $innerResult[] = $innerRule->isValid($value[$key]);
                    }
                    $this->result['shape'] = !in_array(false, $innerResult, true);
            }
        }
//        var_dump($this->size);
        $result = !in_array(false, $this->result, true);
        $this->result = array_merge($this->result, $this->resultDefault);
        return $result;
    }

    public function required(): static
    {
        $this->rules[] = 'required';
        return $this;
    }

    public function sizeof(int $size): static
    {
        $this->size = $size;
        $this->rules[] = 'sizeof';
        return $this;
    }

    public function shape(array $shape): static
    {
        $this->rules[] = 'shape';
        $this->shape = $shape;
        return $this;
    }
}
