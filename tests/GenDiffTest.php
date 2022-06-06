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
     * @param string $stylish
     * @return void
     */
    public function testGendiff($file1, $file2, $format, $result)
    {
        $fixture1 = $this->getFullPathToFile($file1);
        $fixture2 = $this->getFullPathToFile($file2);
        $expectedDiff = $this->getFullPathToFile($result);
        $this->assertStringEqualsFile($expectedDiff, genDiff($fixture1, $fixture2, $format));
    }
    /**
     * @return array<int, array<int, string>>
     */
    public function diffDataProvider()
    {
        return [
            [
                "file1.json",
                "file2.json",
                "json",
                "resultTrueJson.txt"
            ],
            [
                "file1.yaml",
                "file2.yaml",
                "json",
                "resultTrueYaml.txt"
            ],
            [
                "filepath1.json",
                "filepath2.json",
                "stylish",
                "resultTrueStylish.txt"
            ],
            [
                "filepath1.yaml",
                "filepath2.yaml",
                "stylish",
                "resultTrueStylish.txt"
            ],
            [
                "filepath1.json",
                "filepath2.json",
                "plain",
                "resultTruePlain.txt"
            ],
            [
                "filepath1.yaml",
                "filepath2.yaml",
                "plain",
                "resultTruePlain.txt"
            ]
        ];
    }
    private function getFullPathToFile(string $path): string
    {
        return __DIR__ . "/fixtures/" . $path;
    }
}
