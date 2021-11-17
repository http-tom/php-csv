<?php

declare(strict_types=1);

require dirname(dirname(dirname(dirname(__FILE__)))).'/vendor/autoload.php';

use PHPUnit\Framework\TestCase;

use HttpTom\Csv\CSV as CSV;


final class CSVTest extends TestCase {

    public function testReadCSV()
    {
        $csv = new CSV(__DIR__);
        $arr = $csv->readCSV('test.csv');
        $this->assertIsArray($arr);
    }
}
