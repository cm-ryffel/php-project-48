<?php

namespace Differ\Differ\Parsers;

class ParserFactory
{
    public static function getParser(string $filePath): ParserInterface
    {
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);

        switch ($extension) {
            case 'json':
                return new JsonParser();
            case 'yml':
            case 'yaml':
                return new YamlParser();
            default:
                throw new \Exception("Unsupported file format: {$extension}");
        }
    }
}
