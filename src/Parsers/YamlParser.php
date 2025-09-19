<?php

namespace Differ\Differ\Parsers;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

class YamlParser implements ParserInterface
{
    public function parse(string $content): array
    {
        try {
            return Yaml::parse($content);
        } catch (ParseException $e) {
            throw new \Exception('Invalid YAML: ' . $e->getMessage());
        }
    }
}
