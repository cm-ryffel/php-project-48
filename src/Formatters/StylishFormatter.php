<?php

namespace Differ\Differ\Formatters;

class StylishFormatter
{
    public static function render(array $diff): string
    {
        $formattedDiff = self::formatDiff($diff);
        return "{\n{$formattedDiff}\n}";
    }

    private static function formatValue($value, int $depth = 1): string
    {
        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }
        if (is_null($value)) {
            return 'null';
        }
        if (!is_array($value)) {
            return (string) $value;
        }

        $indent = str_repeat('    ', $depth);
        $lines = [];

        foreach ($value as $key => $val) {
            $formattedValue = self::formatValue($val, $depth + 1);
            $lines[] = "{$indent}    {$key}: {$formattedValue}";
        }

        return "{\n" . implode("\n", $lines) . "\n{$indent}}";
    }

    private static function formatDiff(array $diff, int $depth = 1): string
    {
        $indent = str_repeat('    ', $depth - 1);
        $lines = [];

        foreach ($diff as $item) {
            $key = $item['key'];
            $type = $item['type'];

            switch ($type) {
                case 'nested':
                    $formattedChildren = self::formatDiff($item['children'], $depth + 1);
                    $lines[] = "{$indent}    {$key}: {\n{$formattedChildren}\n{$indent}    }";
                    break;
                case 'added':
                    $value = self::formatValue($item['value'], $depth);
                    $lines[] = "{$indent}  + {$key}: {$value}";
                    break;
                case 'removed':
                    $value = self::formatValue($item['value'], $depth);
                    $lines[] = "{$indent}  - {$key}: {$value}";
                    break;
                case 'unchanged':
                    $value = self::formatValue($item['value'], $depth);
                    $lines[] = "{$indent}    {$key}: {$value}";
                    break;
                case 'changed':
                    $value1 = self::formatValue($item['value1'], $depth);
                    $value2 = self::formatValue($item['value2'], $depth);
                    $lines[] = "{$indent}  - {$key}: {$value1}";
                    $lines[] = "{$indent}  + {$key}: {$value2}";
                    break;
            }
        }

        return implode("\n", $lines);
    }
}
