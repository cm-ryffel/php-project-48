<?php

namespace Differ\Differ;

function genDiff($filePath1, $filePath2, $format = 'stylish')
{
    $content1 = FileParser::read($filePath1);
    $data1 = FileParser::parse($content1, $filePath1);

    $content2 = FileParser::read($filePath2);
    $data2 = FileParser::parse($content2, $filePath2);

    $diff = DiffBuilder::buildDiff($data1, $data2);

    $formatter = Formatters::getFormatter($format);
    return $formatter::render($diff);
}