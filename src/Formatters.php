<?php

namespace Hexlet\Code;

use Hexlet\Code\Formatters\StylishFormatter;
use Hexlet\Code\Formatters\PlainFormatter;
use Hexlet\Code\Formatters\JsonFormatter;

class Formatters
{
    public static function getFormatter(string $format): object
    {
        switch ($format) {
            case 'stylish':
                return new StylishFormatter();
            case 'plain':
                return new PlainFormatter();
            case 'json':
                return new JsonFormatter();
            default:
                throw new \Exception("Unknown format: {$format}");
        }
    }
}