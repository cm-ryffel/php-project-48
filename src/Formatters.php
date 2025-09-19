<?php

namespace Differ\Differ;

use Differ\Differ\Formatters\StylishFormatter;
use Differ\Differ\Formatters\PlainFormatter;
use Differ\Differ\Formatters\JsonFormatter;

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