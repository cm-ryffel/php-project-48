<?php

namespace Hexlet\Code\Tests;

use PHPUnit\Framework\TestCase;
use function Hexlet\Code\genDiff;

class GenDiffTest extends TestCase
{
    public function testGenDiffJson()
    {
        $expected = file_get_contents(__DIR__ . '/fixtures/expected_json.txt');
        $actual = genDiff(__DIR__ . '/fixtures/file1_nested.json', __DIR__ . '/fixtures/file2_nested.json', 'json');
        $this->assertEquals($expected, $actual);
    }

    public function testGenDiffYaml()
    {
        $expected = file_get_contents(__DIR__ . '/fixtures/expected_stylish.txt');
        $actual = genDiff(__DIR__ . '/fixtures/file1.yml', __DIR__ . '/fixtures/file2.yml');
        $this->assertEquals($expected, $actual);
    }

    public function testGenDiffNestedJson()
    {
        $expected = file_get_contents(__DIR__ . '/fixtures/expected_stylish_nested.txt');
        $actual = genDiff(__DIR__ . '/fixtures/file1_nested.json', __DIR__ . '/fixtures/file2_nested.json');
        $this->assertEquals($expected, $actual);
    }

    public function testGenDiffNestedYaml()
    {
        $expected = file_get_contents(__DIR__ . '/fixtures/expected_stylish_nested.txt');
        $actual = genDiff(__DIR__ . '/fixtures/file1_nested.yml', __DIR__ . '/fixtures/file2_nested.yml');
        $this->assertEquals($expected, $actual);
    }

    public function testGenDiffWithNonExistentFile()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('File not found: nonexistent.json');
        
        genDiff('nonexistent.json', __DIR__ . '/fixtures/file2.json');
    }

    public function testGenDiffWithInvalidJson()
    {
        $invalidJsonPath = __DIR__ . '/fixtures/invalid.json';
        file_put_contents($invalidJsonPath, '{ invalid json }');
        
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Invalid JSON');
        
        try {
            genDiff($invalidJsonPath, __DIR__ . '/fixtures/file2.json');
        } finally {
            if (file_exists($invalidJsonPath)) {
                unlink($invalidJsonPath);
            }
        }
    }

    public function testGenDiffWithInvalidYaml()
    {
        $invalidYamlPath = __DIR__ . '/fixtures/invalid.yml';
        file_put_contents($invalidYamlPath, 'invalid: yaml: content');
        
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Invalid YAML');
        
        try {
            genDiff($invalidYamlPath, __DIR__ . '/fixtures/file2.yml');
        } finally {
            if (file_exists($invalidYamlPath)) {
                unlink($invalidYamlPath);
            }
        }
    }

    public function testGenDiffPlain()
    {
        $expected = file_get_contents(__DIR__ . '/fixtures/expected_plain.txt');
        $actual = genDiff(__DIR__ . '/fixtures/file1_nested.json', __DIR__ . '/fixtures/file2_nested.json', 'plain');
        $this->assertEquals($expected, $actual);
    }

    public function testGenDiffPlainYaml()
    {
        $expected = file_get_contents(__DIR__ . '/fixtures/expected_plain.txt');
        $actual = genDiff(__DIR__ . '/fixtures/file1_nested.yml', __DIR__ . '/fixtures/file2_nested.yml', 'plain');
        $this->assertEquals($expected, $actual);
    }

    public function testGenDiffJsonYaml()
    {
        $expected = file_get_contents(__DIR__ . '/fixtures/expected_json.txt');
        $actual = genDiff(__DIR__ . '/fixtures/file1_nested.yml', __DIR__ . '/fixtures/file2_nested.yml', 'json');
        $this->assertEquals($expected, $actual);
    }
}
