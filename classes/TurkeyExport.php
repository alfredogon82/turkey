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

    public function generateSQLReport($filename = 'turkey_report.sql')
    {
        $turkeys = $this->turkey->getAllTurkeys();
        $file = fopen($filename, 'w');

        // Add SQL report headers
        fwrite($file, "SELECT id, name, status FROM turkeys;\n");

        // Add data rows
        foreach ($turkeys as $turkey) {
            fwrite($file, "INSERT INTO turkeys (id, name, weight, age, status, color, created_at) VALUES (" .
                $turkey['id'] . ", '" . $turkey['name'] . "', " . $turkey['weight'] . ", " . $turkey['age'] . ", '" .
                $turkey['status'] . "', '" . $turkey['color'] . "', '" . $turkey['created_at'] . "');\n");
        }

        fclose($file);
        return $filename;
    }
}
?>
