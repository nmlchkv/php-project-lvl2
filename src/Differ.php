<?php

namespace Differ\Differ;

use Exception;

use function Src\Parsers\parse;
use function Src\Formatters\format;
use function Src\Ast\ast;

/**
 * @param string $firstPath
 * @param string $secondPath
 * @param string $format
 * @return string
 */

function genDiff(string $firstPath, string $secondPath, string $format = 'stylish'): string
{
    $firstContent = getContent($firstPath);
    $secondContent = getContent($secondPath);
    $ast = ast($firstContent, $secondContent);
    return format($ast, $format);
}

/**
 * @param string $path
 * @return array<string>
 */

function getContent(string $path): array
{
    $filePath = getPath($path);
    $fileContent = file_get_contents($filePath);
    if ($fileContent === false) {
        throw new Exception("Cant read file");
    }
    $fileType = pathinfo($filePath, PATHINFO_EXTENSION);
    return parse($fileType, $fileContent);
}

/**
 * @param string $path
 * @return string
 */

function getPath(string $path): string
{
    if (strpos($path, '/') === 0) {
        return $path;
    }
    return __DIR__ . '/../' . $path;
}
