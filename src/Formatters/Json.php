<?php

namespace Src\Formatters\Json;

/**
 * @param array<mixed> $ast
 * @return mixed
 */
function format(array $ast): mixed
{
    return json_encode($ast);
}
