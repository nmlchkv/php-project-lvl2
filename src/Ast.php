<?php

namespace Src\Ast;

use function Functional\map;
use function Functional\sort;

/**
 * @param array<mixed> $firstContent
 * @param array<mixed> $secondContent
 * @return array<mixed>
 */

function buildAst(array $firstContent, array $secondContent): array
{
    $keys = array_merge(array_keys($firstContent), array_keys($secondContent));
    $uniqueKeys = array_unique($keys);
    $sortedKeys = sort($uniqueKeys, fn ($a, $b) => strcmp($a, $b), false);

    return array_map(fn($key) => getAst($key, $firstContent, $secondContent), $sortedKeys);
}

/**
 * @param string $type
 * @param string $key
 * @param mixed $value
 * @param mixed $secondValue
 * @return array<mixed>
 */

function getAstNode(string $type, string $key, $value, $secondValue = null): array
{
    return ['type' => $type,
        'key' => $key,
        'value' => $value,
        'secondValue' => $secondValue];
}

/**
 * @param string $key
 * @param array<mixed> $firstContent
 * @param array<mixed> $secondContent
 * @return array<mixed>
 */

function getAst(string $key, array $firstContent, array $secondContent): array
{
    $firstValue = $firstContent[$key] ?? null;
    $secondValue = $secondContent[$key] ?? null;
    if (is_array($firstValue) && is_array($secondValue)) {
        return getAstNode('hasChildren', $key, buildAst($firstValue, $secondValue));
    }

    if (!array_key_exists($key, $firstContent)) {
        return getAstNode('added', $key, normalizeContent($secondValue));
    }

    if (!array_key_exists($key, $secondContent)) {
        return  getAstNode('deleted', $key, normalizeContent($firstValue));
    }

    if ($firstValue !== $secondValue) {
        return getAstNode('changed', $key, normalizeContent($firstValue), normalizeContent($secondValue));
    }

    return getAstNode('unchanged', $key, $firstValue);
}

/**
 * @param mixed $content
 * @return mixed
 */

function normalizeContent($content)
{
    $iter = function ($content) use (&$iter) {
        if (!is_array($content)) {
            return $content;
        }

        $keys = array_keys($content);
        return map($keys, function ($key) use ($content, $iter) {
            $value = (is_array($content[$key])) ? $iter($content[$key]) : $content[$key];

            return ['type' => 'unchanged', 'key' => $key, 'value' => $value];
        });
    };

    return $iter($content);
}

/**
 * @param array<mixed> $node
 * @return string
 */

function getType(array $node): string
{
    return $node['type'];
}

/**
 * @param array<mixed> $node
 * @return string
 */

function getKey(array $node): string
{
    return $node['key'];
}

/**
 * @param array<mixed> $node
 * @return mixed
 */

function getValue(array $node)
{
    return $node['value'];
}

/**
 * @param array<mixed> $node
 * @return mixed
 */

function getSecondValue(array $node)
{
    return $node['secondValue'];
}

/**
 * @param array<mixed> $node
 * @return array<mixed>
 */

function getChildren(array $node): array
{
    return $node['value'];
}

/**
 * @param array<mixed> $node
 * @return bool
 */

function hasChildren(array $node): bool
{
    return array_key_exists('children', $node);
}
