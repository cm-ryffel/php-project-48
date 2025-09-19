### Hexlet tests and linter status:
[![Actions Status](https://github.com/cm-ryffel/php-project-48/actions/workflows/hexlet-check.yml/badge.svg)](https://github.com/cm-ryffel/php-project-48/actions)

## Installation
As a global command-line tool
bash
composer global require hexlet/code

### As a project dependency
bash
composer require hexlet/code

### Usage
Command Line Interface
bash
# Show help information
gendiff -h

# Show version
gendiff -v

# Compare two JSON files
gendiff file1.json file2.json

# Compare with specific format (currently only 'stylish' supported)
gendiff --format stylish file1.json file2.json

### Example Output
bash
$ gendiff file1.json file2.json
{
  - follow: false
    host: hexlet.io
  - proxy: 123.234.53.22
  - timeout: 50
  + timeout: 20
  + verbose: true
}

### As a Library
php
<?php

require 'vendor/autoload.php';

use function Hexlet\Code\genDiff;

$diff = genDiff('file1.json', 'file2.json');
echo $diff;

### Or with specific format
$diff = genDiff('file1.json', 'file2.json', 'stylish');
echo $diff;

## Formats

### Stylish
```bash
gendiff file1.json file2.json

# Справка
gendiff -h

# Сравнение файлов (формат stylish по умолчанию)
gendiff file1.json file2.json

# Сравнение с указанием формата
gendiff --format plain file1.json file2.json
gendiff --format json file1.yml file2.yml

# Короткая форма указания формата
gendiff -f plain file1.json file2.json


### Demo
https://asciinema.org/a/bEtSVQmtCOJnBsJtD8AtOa6IZ

