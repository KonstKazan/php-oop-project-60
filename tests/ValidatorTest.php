<?php

use Hexlet\Code\Validator;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    public function testStringIsValid(): void
    {
        $v = new Validator();
        $schema = $v->string();
        $this->assertTrue($schema->isValid(null));

        $schema->required();
        $this->assertFalse($schema->isValid(null));
    }
}