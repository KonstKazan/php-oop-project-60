<?php

namespace Hexlet\Validator\Tests;

use Hexlet\Validator\Validator;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    public function testStringIsValid(): void
    {
        $v = new Validator();
        $schema = $v->string();
        Assert::assertTrue($schema->isValid(null));

        $schema->required();
        Assert::assertFalse($schema->isValid(null));
    }
}
