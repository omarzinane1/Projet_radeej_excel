<?php
session_start();
include('dbconfig.php');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_POST['save_excel_data'])) {
    $fileName = $_FILES['import_file']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);
    $allowed_ext = ['xls', 'csv', 'xlsx'];

    if (in_array($file_ext, $allowed_ext)) {
        $inputFileNamePath = $_FILES['import_file']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();
        $count = 0;

        foreach ($data as $row) {
            if ($count > 0) {
                $N_lot = $row[0];
                $usage = $row[1];
                $Nature = $row[2];
                $surface_lot = $row[3];
                $S_sol = $row[4];
                $RDC = $row[5];
                $Mezzanine = $row[6];
                $per_etage = $row[7];
                $deue_etage = $row[8];
                $troisi_etage = $row[9];
                $quatreme_etage = $row[10];
                $cinq_etage = $row[11];
                $six_etage = $row[12];
                $sept_etage = $row[13];
                $surface_total = $row[14];
                $surface_totalC = $row[15];
                

                $Query = "INSERT INTO fichier_technique (`N_lot`, `usage_h`, `Nature`, `surface_lot` ,`S_sol`, `RDC`, `Mezzanine`, `per_etage`, `deue_etage`, `troisi_etage`, `quatreme_etage`, `cinq_etage`, `six_etage`, `sept_etage`, `surface_total`, `surface_totalC`, `somme`, `S_Pv`, `PVC`) 
                          VALUES ('$N_lot', '$usage', '$Nature', '$surface_lot','$S_sol', '$RDC', '$Mezzanine', '$per_etage', '$deue_etage', '$troisi_etage', '$quatreme_etage', '$cinq_etage', '$six_etage', '$sept_etage', '$surface_total', '$surface_totalC', ' ', ' ', ' ')";

                $result = mysqli_query($conn, $Query);
                $msg = true;
            } else {
                $count = 1;
            }
        }

        if (isset($msg)) {
            $_SESSION['message'] = "Importé avec succès";
            header('Location: home.php');
            exit(0);
        } else {
            $_SESSION['message'] = "Non importé";
            header('Location: home.php');
            exit(0);
        }
    } else {
        $_SESSION['message'] = "Fichier non valide";
        header('Location: home.php');
        exit(0);
    }
}
