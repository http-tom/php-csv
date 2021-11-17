<?php
namespace HttpTom\Csv;

use Exception;

class CSV {
    
    protected $rootPath = '';

    /**
     * @param string $rootPath  The root path prefix for all CSV files
     */
    public function __construct($rootPath)
    {
        $this->rootPath = rtrim($rootPath,DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;
    }

    public function getRootPath()
    {
        return $this->rootPath;
    }

    /**
     * @param string $filename_in   The path and filename of the file you want to read in
     * @return array $lines         Array of lines from the CSV read
     */
    public function readCSV($filename_in, $delimiter = ',')
    {
        $lines = [];
        // open csv
        // echo PHP_EOL.'Reading CSV file.....'.PHP_EOL;
        $csv_file = fopen($this->rootPath.$filename_in, 'r');
        if(!$csv_file)
        {
            throw new Exception('Unable to open file ' . $filename_in);
        }
        while(!feof($csv_file))
        {
            $line = fgetcsv($csv_file, 0, $delimiter);
            if(!is_bool($line)) {
                if(count($line) == 1)
                {
                    $lines[] = $line[0];
                }
                else
                {
                    $lines[] = $line;
                }
            }
        }
        fclose($csv_file);
        // echo PHP_EOL.'File read complete.....'.PHP_EOL;

        return $lines;
    }

    /**
     * @param string $filename  The path and filename to write to
     * @return void
     */
    public function writeCSV($filename, $lines)
    {
        // write new csv
        try {
            $new_csv = fopen($this->rootPath.$filename, 'w');
        } catch (Exception $e) {
            // echo $e->getMessage() . PHP_EOL;
            throw new Exception($e->getMessage());
        }
        if(!$new_csv)
        {
            throw new Exception('Unable to open file ' . $filename);
        }
        // fputcsv($new_csv, $lines[0]);
        foreach($lines as $line)
        {
            if(is_array($line))
            {
                fputcsv($new_csv, $line);
            }
            else
            {
                fputcsv($new_csv, [$line]);
            }
        }
        fclose($new_csv);
    }

    /**
     * Gets headers, either if array is given the first row is returned. If string, filename assumed.
     * @param mixed $var
     */
    public function getHeaders($var)
    {
        if(is_string($var))
        {
            $csv_file = fopen($var, 'r');
            if(!$csv_file)
            {
                throw new Exception('Unable to open file ' . $var);
            }
            while(!feof($csv_file))
            {
                $line = fgetcsv($csv_file);
                if(!is_bool($line)) {
                    fclose($csv_file);
                    return $line;
                }
            }
            if(is_resource($csv_file))
            {
                fclose($csv_file);
            }
            return [];
        }
        if(is_array($var))
        {
            return $var[0];
        }
    }
}