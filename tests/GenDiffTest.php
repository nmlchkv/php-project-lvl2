<?php

namespace Hexlet\Code\Tests;

use PHPUnit\Framework\TestCase;

use function Src\Differ\genDiff;

class GenDiffTest extends TestCase
{
        /**
     * @dataProvider diffDataProvider
     *
     * @param string $file1
     * @param string $file2
     * @param string $result
     * @return void
     */
    public function testGendiff($file1, $file2, $result)
    {
        $fixture1 = $this->getFullPathToFile($file1);
        $fixture2 = $this->getFullPathToFile($file2);
        $expectedDiff = $this->getFullPathToFile($result);
        $this->assertStringEqualsFile($expectedDiff, genDiff($fixture1, $fixture2));
    }
    public function diffDataProvider()
    {
        return [
            [
                "file1.json",
                "file2.json",
                "resultTrueJson.txt"
            ],
            [
                "file1.yaml",
                "file2.yaml",
                "resultTrueYaml.txt"
            ]
        ];
    }
    private function getFullPathToFile(string $path): string
    {
        return __DIR__ . "/fixtures/" . $path;
    }
}
