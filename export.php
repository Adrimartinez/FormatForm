<?php
header('Content-Type: text/csv');
header("Content-Transfer-Encoding: Binary"); 
header("Content-disposition: attachment; filename=data.csv"); 
require_once('api.php');

    $file = fopen("data.csv","w");
   
    $datePref = $_GET['datePref'];
    $numberPref = $_GET['numberPref'];
    $osPref = $_GET['osPref'];
    $endline = "";
    $api = new Api($datePref, $numberPref);
    $data = $api->doTask($datePref, $numberPref);

    
    switch($osPref){
        case "win":
            $endline = "\r\n";
            break;
        case "ubu":
            $endline = "\n";
            break;
        case "mac":
            $endline = "\r";
            break;
    }   
    foreach($data as $a){
        fputcsv($file,$a);
        fwrite($file,$endline);
    }

fclose($file);
readfile("data.csv");

?>