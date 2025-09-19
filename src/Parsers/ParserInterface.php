<?php

namespace Differ\Differ\Parsers;

interface ParserInterface
{
    public function parse(string $content): array;
}
