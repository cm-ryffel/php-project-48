<?php

namespace Differ\Differ\Parsers;

class JsonParser implements ParserInterface
{
    public function parse(string $content): array
    {
        $data = json_decode($content, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception('Invalid JSON: ' . json_last_error_msg());
        }
        
        return $data;
    }
}