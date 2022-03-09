<?php
namespace App\Libs;

class CSVExport {


    /**
     * Generate CSV string from the $data array. 
     * 
     * @param array $data an array of rows.
     * @param array $headers CSV headers. If $header is null, the keys of the first item will be the CSV headers.
     * 
     * @return string the CSV formated string.
     */
    public static function formatData($data, $headers = null) {
        if ($headers == null) {
            $headers = array_keys($data[0]);
        }
        $CSVContent = '';
        foreach($data as $row) {
            $lineData = [];
            foreach($headers as $h) {
                array_push($lineData, "\"{$row[$h]}\"");
            }
            $CSVContent .= implode(',', $lineData) . PHP_EOL;
        }
        
        return implode(',', $headers) . PHP_EOL . $CSVContent;
    }
}

?>