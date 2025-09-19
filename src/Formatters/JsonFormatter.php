<?php

namespace Hexlet\Code\Formatters;

class JsonFormatter
{
    public static function render(array $diff): string
    {
        $json = json_encode($diff, JSON_PRETTY_PRINT);
        if ($json === false) {
            throw new \Exception('Failed to encode JSON');
        }
        return $json;
    }
}