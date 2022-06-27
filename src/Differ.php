<?php

namespace Differ\Differ;

use Exception;

use function Src\Parsers\parse;
use function Src\Formatters\format;
use function Src\Ast\ast;

/**
 * @param string $firstFile
 * @param string $secondFile
 * @param string $format
 * @return string
 */

function genDiff(string $firstFile, string $secondFile, string $format = 'stylish'): string
{
    $firstContent = getContent($firstFile);
    $secondContent = getContent($secondFile);
    $ast = ast($firstContent, $secondContent);
    return format($ast, $format);
}

/**
 * @param string $file
 * @return array<string>
 */

function getContent(string $file): array
{
    $filePath = getPath($file);
    $fileContent = file_get_contents($filePath);
    if ($fileContent === false) {
        throw new Exception("Cant read file");
    }
    $fileType = pathinfo($filePath, PATHINFO_EXTENSION);
    return parse($fileType, $fileContent);
}

/**
 * @param string $file
 * @return string
 */

function getPath(string $file): string
{
    if (strpos($file, '/') === 0) {
        return $file;
    }
    return __DIR__ . '/../' . $file;
}
