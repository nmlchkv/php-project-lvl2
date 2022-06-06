<?php

namespace Src\Formatters\Json;

function format(array $ast)
{
    return json_encode($ast);
}
