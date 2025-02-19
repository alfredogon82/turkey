<?php
require_once 'Turkey.php';

class TurkeyExport
{
    private $turkey;

    public function __construct()
    {
        $this->turkey = new Turkey();
    }

    public function exportToCSV($filename = 'turkeys.csv')
    {
        $turkeys = $this->turkey->getAllTurkeys();
        $file = fopen($filename, 'w');

        // Add CSV headers
        fputcsv($file, ['ID', 'Name', 'Weight', 'Age', 'Status', 'Color', 'Created At']);

        // Add data rows
        foreach ($turkeys as $turkey) {
            fputcsv($file, $turkey);
        }

        fclose($file);
        return $filename;
    }
}
?>
