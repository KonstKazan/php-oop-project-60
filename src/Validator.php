<?php

namespace Hexlet\Code;

class Validator
{
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
}
