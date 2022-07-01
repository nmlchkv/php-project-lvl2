<?php

namespace Hexlet\Code\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class GenDiffTest extends TestCase
{
        /**
     * @dataProvider diffDataProvider
     *
     * @param string $path1
     * @param string $path2
     * @param string $format
     * @param string $expected
     * @return void
     */

    public function testGendiff(string $path1, string $path2, string $format, string $expected): void
    {
        $fixture1 = $this->getFullPathToFixture($path1);
        $fixture2 = $this->getFullPathToFixture($path2);
        $expectedPath = $this->getFullPathToFixture($expected);
        $this->assertStringEqualsFile($expectedPath, genDiff($fixture1, $fixture2, $format));
    }

    /**
     * @return array<int, array<int, string>>
     */

    public function diffDataProvider()
    {
        return [
            [
                'filepath1.json',
                'filepath2.json',
                'stylish',
                'resultTrueStylish.txt'
            ],
            [
                'filepath1.yaml',
                'filepath2.yaml',
                'plain',
                'resultTruePlain.txt'
            ],
            [
                'filepath1.json',
                'filepath2.json',
                'json',
                "resultTrueJson.txt"
            ]
        ];
    }

    private function getFullPathToFixture(string $path): string
    {
        return __DIR__ . "/fixtures/" . $path;
    }
}
