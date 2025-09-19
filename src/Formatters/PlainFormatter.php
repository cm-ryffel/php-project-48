<?php

namespace Differ\Differ\Formatters;

class PlainFormatter
{
    public static function render(array $diff): string
    {
        $lines = [];
        self::buildLines($diff, $lines, '');
        return implode("\n", $lines);
    }

    private static function buildLines(array $diff, array &$lines, string $parentKey): void
    {
        foreach ($diff as $item) {
            $key = $item['key'];
            $type = $item['type'];
            $fullKey = $parentKey ? "{$parentKey}.{$key}" : $key;

            switch ($type) {
                case 'nested':
                    self::buildLines($item['children'], $lines, $fullKey);
                    break;
                case 'added':
                    $value = self::formatValue($item['value']);
                    $lines[] = "Property '{$fullKey}' was added with value: {$value}";
                    break;
                case 'removed':
                    $lines[] = "Property '{$fullKey}' was removed";
                    break;
                case 'unchanged':
                    // В plain формате неизмененные свойства не выводятся
                    break;
                case 'changed':
                    $value1 = self::formatValue($item['value1']);
                    $value2 = self::formatValue($item['value2']);
                    $lines[] = "Property '{$fullKey}' was updated. From {$value1} to {$value2}";
                    break;
            }
        }
    }

    private static function formatValue($value): string
    {
        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }
        if (is_null($value)) {
            return 'null';
        }
        if (is_array($value) || is_object($value)) {
            return '[complex value]';
        }
        if (is_string($value)) {
            return "'{$value}'";
        }
        return (string) $value;
    }
}
