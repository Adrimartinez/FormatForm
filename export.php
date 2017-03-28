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
        case "lin":
            $endline = "\n";
            break;
        case "mac":
            $endline = "\r";
            break;
    }   
    foreach($data as $dat){
        foreach($dat as $a){
            fprintf($file,"\"".strval($a)."\",");
        }
        $stat = fstat($file);
        ftruncate($file, $stat['size']-1); 
        fwrite($file,$endline);
        //fputcsv($file,$a);
    }

fclose($file);
readfile("data.csv");

?>