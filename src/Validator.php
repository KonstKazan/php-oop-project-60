<?php

namespace Hexlet\Validator;

class Validator
{
    protected static array $customValidator;

    public function string(): StringValidate
    {
        return new StringValidate();
    }

    public function number(): NumberValidate
    {
        return new NumberValidate();
    }

    public function array(): ArrayValidate
    {
        return new ArrayValidate();
    }

    public function addValidator($type, $name, $fn): void
    {
        static::$customValidator = ['name' => $name, 'type' => $type, 'value' => null, 'fn' => $fn];
    }
}
