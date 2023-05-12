<?php
//This page is for downloading a .csv file containing the contents of a table generated in the Expense Tracker
$csv_contents = filter_input(INPUT_POST, "csv_contents");
$filename = filter_input(INPUT_POST, "csv_filename");
if (!isset($csv_contents) || !isset($filename)) {
    exit("Expense Tracker encountered difficulties accessing the data required for your download. Please close this window and try again later.");
}
else {
    $report = fopen($filename, "w");
    if ($report) {
        fwrite($report, $csv_contents);
        fclose($report);
        header('Content-Description: File Transfer');
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="table.csv"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Content-Length: ' . filesize($filename));
        readfile($filename);
        unlink($filename); //deletes file immediately after it is created and downloaded
		exit();
    }
}
?>