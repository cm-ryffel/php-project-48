<?php

namespace Hexlet\Code\Parsers;

interface ParserInterface
{
    public function parse(string $content): array;
}