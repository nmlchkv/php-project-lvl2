<?php

namespace Differ\Differ;

use Exception;

use function Src\Parsers\parse;
use function Src\Formatters\format;
use function Src\Ast\getAst;

/**
 * @param string $firstPath
 * @param string $secondPath
 * @param string $format
 * @return string
 */

function genDiff(string $firstPath, string $secondPath, string $format = 'stylish'): string
{
    $firstContent = parsePath($firstPath);
    $secondContent = parsePath($secondPath);
    $ast = getAst($firstContent, $secondContent);
    return format($ast, $format);
}

 /**
  * @param string $path
  * @return array<string>
  */

function parsePath($path): array
{
    $content = getContent($path);
    $fileType = pathinfo(getPath($path), PATHINFO_EXTENSION);
    return parse($fileType, $content);
}

 /**
  * @param string $path
  * @return string
  */

function getContent(string $path): string
{
    $filePath = getPath($path);
    $fileContent = file_get_contents($filePath);
    if ($fileContent === false) {
        throw new Exception("Cant read file");
    } else {
        return $fileContent;
    }
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
