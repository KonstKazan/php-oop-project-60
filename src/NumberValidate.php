<?php

namespace Hexlet\Code;

class NumberValidate extends Validator
{
    private array $result = [
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
            }
        }
        return !in_array(false, $this->result, true);
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
}
