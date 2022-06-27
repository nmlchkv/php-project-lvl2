<?php

namespace Src\Formatters\Json;

/**
 * @param array<mixed> $ast
 * @return mixed
 */

function format(array $ast)
{
    return json_encode($ast);
}
