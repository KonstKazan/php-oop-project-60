<?php

namespace Hexlet\Code;

class Validator
{
    public function string(): StringValidate
    {
        return new StringValidate();
    }
}