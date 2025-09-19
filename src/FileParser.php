<?php

namespace Hexlet\Code;

use Hexlet\Code\Parsers\ParserFactory;

class FileParser
{
    public static function read($filePath)
    {
        $absolutePath = realpath($filePath);
        if (!$absolutePath) {
            throw new \Exception("File not found: {$filePath}");
        }
        
        $content = file_get_contents($absolutePath);
        if ($content === false) {
            throw new \Exception("Failed to read file: {$filePath}");
        }
        
        return $content;
    }
    
    public static function parse($content, $filePath)
    {
        $parser = ParserFactory::getParser($filePath);
        return $parser->parse($content);
    }
}