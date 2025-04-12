<?php

namespace Hexlet\Validator;

class NumberValidate extends Validator
{
    private array $result = [
        'required' => true,
        'positive' => true,
        'range' => true,
    ];
    private array $resultDefault = [
        'required' => true,
        'positive' => true,
        'range' => true,
    ];
    private array $range = ['minNum' => 0, 'maxNum' => 0];
    private array $rules = [];


    public function isValid(string|null $value): bool
    {
        foreach ($this->rules as $rule) {
            switch ($rule) {
                case 'required':
                    if ($value === null) {
                        $this->result['required'] = false;
                    }
                    break;
                case 'positive':
                    if ($value < 0) {
                        $this->result['positive'] = false;
                    }
                    break;
                case 'range':
                    if ($this->range['minNum'] > $value || $value > $this->range['maxNum']) {
                        $this->result['range'] = false;
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

    public function positive(): static
    {
        $this->rules[] = 'positive';
        return $this;
    }

    public function range(int $minNum, int $maxNum): static
    {
        $this->range['minNum'] = $minNum;
        $this->range['maxNum'] = $maxNum;
        $this->rules[] = 'range';
        return $this;
    }

    public function test(string $name, int $value): static
    {
        parent::$customValidator['value'] = $value;
        $this->rules[] = 'custom';
        return $this;
    }
}
