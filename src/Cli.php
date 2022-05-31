<?php

namespace Src\Cli;

use Docopt;

use function src\differ\genDiff;

function start(): string
{
    $doc = <<<DOC
    Generate diff
    
    Usage:
      gendiff (-h|--help)
      gendiff (-v|--version)
      gendiff [--format <fmt>] <firstFile> <secondFile>
    
    Options:
      -h --help                     Show this screen
      -v --version                  Show version
      --format <fmt>                Report format [default: stylish]
    DOC;

    $args = Docopt::handle($doc, ['version' => 'gendiff v: 0.0.1']);

    $firstFile = $args['<firstFile>'];
    $secondFile = $args['<secondFile>'];

    return genDiff($firstFile, $secondFile);
}
