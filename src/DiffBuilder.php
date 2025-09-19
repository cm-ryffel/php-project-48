<?php

namespace Differ\Differ;

class DiffBuilder
{
    public static function buildDiff(array $data1, array $data2): array
    {
        $keys = array_unique(array_merge(array_keys($data1), array_keys($data2)));
        sort($keys);

        $diff = [];
        foreach ($keys as $key) {
            $value1 = $data1[$key] ?? null;
            $value2 = $data2[$key] ?? null;

            if (!array_key_exists($key, $data1)) {
                $diff[] = [
                    'type' => 'added',
                    'key' => $key,
                    'value' => $value2
                ];
            } elseif (!array_key_exists($key, $data2)) {
                $diff[] = [
                    'type' => 'removed',
                    'key' => $key,
                    'value' => $value1
                ];
            } elseif (is_array($value1) && is_array($value2)) {
                $diff[] = [
                    'type' => 'nested',
                    'key' => $key,
                    'children' => self::buildDiff($value1, $value2)
                ];
            } elseif ($value1 === $value2) {
                $diff[] = [
                    'type' => 'unchanged',
                    'key' => $key,
                    'value' => $value1
                ];
            } else {
                $diff[] = [
                    'type' => 'changed',
                    'key' => $key,
                    'value1' => $value1,
                    'value2' => $value2
                ];
            }
        }

        return $diff;
    }
}
