<?php
header('Content-Type: text/csv');
header("Content-Transfer-Encoding: Binary"); 
header("Content-disposition: attachment; filename=data.csv"); 
require_once('api.php');

    $file = fopen("data.csv","w");
   
    $datePref = mysql_real_escape_string(trim($_GET['datePref']));
    $numberPref = mysql_real_escape_string(trim($_GET['numberPref']));
    $osPref = mysql_real_escape_string(trim($_GET['osPref']));
    $sep = mysql_real_escape_string(trim($_GET['sepPref']));
    $endline = "";
    $separator = "";
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

    switch($sep){
        case "com";
            $separator = ",";
            break;
        case "tab":
            $separator = "\t";
            break;
        case "colon":
            $separator = ";";
            break;
    }
    foreach($data as $dat){
        foreach($dat as $a){
            fprintf($file,"\"".strval($a)."\"$separator");
        }
        $stat = fstat($file);
        ftruncate($file, $stat['size']-1); 
        fwrite($file,$endline);
        //fputcsv($file,$a);
    }

fclose($file);
readfile("data.csv");

?>