<?php

namespace Gendiff\Code\Tests;

use PHPUnit\Framework\TestCase;

use function Src\Differ\gendiff;

class GenDiffTest extends TestCase
{
    public function testGendiff($file1, $file2)
    {
        $this->assertStringEqualsFile(
            '{"- follow":"false",
            "host":"hexlet.io",
            "- proxy":"123.234.53.22",
            "- timeout":50,
            "+ timeout":20,
            "+ verbose":
            "true"}',
            gendiff($file1, $file2)
        );
    }
}
