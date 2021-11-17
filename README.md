# php-csv

A simple PHP utility to work with CSV files.

## Install

Install package with composer

```
composer require http-tom/php-csv
```

## How to use

```php
require_once 'vendor/autoload.php';
use HttpTom\Csv\CSV as CSV;

$csv = new CSV(dirname(__FILE__).'/csv-resource-folder/');
```

Read a CSV file

```php
$csv->readCSV('test.csv', ',');
```

Write a CSV file

```php
$array = []
$array[] = [
    ['header1'],['header2']
];
$array[] = [
    ['row1-field1'],['row1-field2']
];

$csv->writeCSV('test.csv', $array);
```

To extract headers from a CSV file (can be array of loaded csv, or filename to csv);
```php
// from filename
$csv->getHeaders(dirname(__FILE__).'/csv-resource-folder/test.csv');

// from array
$csv->getHeaders($array);
```

