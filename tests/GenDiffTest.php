<?php

namespace Hexlet\Code\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class GenDiffTest extends TestCase
{
        /**
     * @dataProvider diffDataProvider
     *
     * @param string $file1
     * @param string $file2
     * @param string $format
     * @param string $result
     * @return void
     */
    public function testGendiff(string $file1, string $file2, string $format, $result): void
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
            ],
            [
                "filepath1.json",
                "filepath2.json",
                "json",
                "resultTrueJson.txt"
            ],
            [
                "filepath1.yaml",
                "filepath2.yaml",
                "json",
                "resultTrueJson.txt"
            ]
        ];
    }

    private function getFullPathToFixture(string $path): string
    {
        return __DIR__ . "/fixtures/" . $path;
    }
}
