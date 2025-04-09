<?php

namespace Hexlet\Code;
class StringValidate extends Validator
{
    private bool $minLength = false;
    private bool $contains = false;
    private bool $required = false;
    public function isValid($value): bool
    {
        if ($this->required === false && $this->minLength === false && $this->contains === false) {
            return true;
        }
        if ($value === null || $value === '') {
            return false;
        }
        return true;
    }

    public function required(): static
    {
        $this->required = true;
        return $this;
    }

    public function contains($find): static
    {
        $this->contains = $find;
        return $this;
    }

    public function minLength($length): static
    {
        $this->$length = $length;
        return $this;
    }
}