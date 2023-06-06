<?php

require 'vendor/autoload.php';
include('dbconfig.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Create a new Spreadsheet object
$spreadsheet = new Spreadsheet();

// Select the active worksheet
$worksheet = $spreadsheet->getActiveSheet();

// Set the column headers

$worksheet->setCellValue('A1', 'N_lot');
$worksheet->setCellValue('B1', 'usage_h');
$worksheet->setCellValue('C1', 'Nature');
$worksheet->setCellValue('D1', 'surface_lot');
$worksheet->setCellValue('E1', 'S_sol');
$worksheet->setCellValue('F1', 'RDC');
$worksheet->setCellValue('G1', 'Mezzanine');
$worksheet->setCellValue('H1', 'per_etage');
$worksheet->setCellValue('I1', 'deue_etage');
$worksheet->setCellValue('J1', 'troisi_etage');
$worksheet->setCellValue('K1', 'quatreme_etage');
$worksheet->setCellValue('L1', 'cinq_etage');
$worksheet->setCellValue('M1', 'six_etage');
$worksheet->setCellValue('N1', 'sept_etage');
$worksheet->setCellValue('O1', 'surface_total');
$worksheet->setCellValue('P1', 'surface_totalC');
$worksheet->setCellValue('Q1', 'somme');
$worksheet->setCellValue('R1', 'S_Pv');
$worksheet->setCellValue('S1', 'PVC');

//T U V W X Y Z




// Fetch the data from the database
$query = "SELECT * FROM fichier_technique";
$result = mysqli_query($conn, $query);

// Set the row counter to 2 (to start writing the data from the second row)
$row = 2;

// Loop through the data and write it to the worksheet
while ($data = mysqli_fetch_assoc($result)) {
    $worksheet->setCellValue('A' . $row, $data['N_lot']);
    $worksheet->setCellValue('B' . $row, $data['usage_h']);
    $worksheet->setCellValue('C' . $row, $data['Nature']);
    $worksheet->setCellValue('D' . $row, $data['surface_lot']);
    $worksheet->setCellValue('E' . $row, $data['S_sol']);
    $worksheet->setCellValue('F' . $row, $data['RDC']);
    $worksheet->setCellValue('G' . $row, $data['Mezzanine']);
    $worksheet->setCellValue('H' . $row, $data['per_etage']);
    $worksheet->setCellValue('I' . $row, $data['deue_etage']);
    $worksheet->setCellValue('J' . $row, $data['troisi_etage']);
    $worksheet->setCellValue('K' . $row, $data['quatreme_etage']);
    $worksheet->setCellValue('L' . $row, $data['cinq_etage']);
    $worksheet->setCellValue('M' . $row, $data['six_etage']);
    $worksheet->setCellValue('N' . $row, $data['sept_etage']);
    $worksheet->setCellValue('O' . $row, $data['surface_total']);
    $worksheet->setCellValue('P' . $row, $data['surface_totalC']);
    $worksheet->setCellValue('Q' . $row, $data['somme']);
    $worksheet->setCellValue('R' . $row, $data['S_Pv']);
    $worksheet->setCellValue('S' . $row, $data['PVC']);
   
    // Et ainsi de suite
    $row++;
    
}

// Create a new Excel object and save the workbook to a file
$writer = new Xlsx($spreadsheet);
$writer->save('D:/exported_data.xlsx');

// Output a success message
$_SESSION['message'] = "exporté avec succès";
header('Location: home.php');
exit(0);


?>
