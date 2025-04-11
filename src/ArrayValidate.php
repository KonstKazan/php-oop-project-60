<?php

namespace Hexlet\Code;

class ArrayValidate extends Validator
{
    private array $result = [
        'required' => true,
        'sizeof' => true,
    ];
    private array $resultDefault = [
        'required' => true,
        'sizeof' => true,
    ];
    private array $rules = [];
    private bool|int $size = false;

    public function isValid(array|null $value): bool
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
}
