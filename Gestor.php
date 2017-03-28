<?php

class Gestor {
    
    private $dateMethod;
    private $numberMethod;
    private $pdo;
    private $data = array();
    
    function __construct($dateMethod, $numberMethod){
        $this->pdo = new PDO('mysql:host=localhost;dbname=storage', 'root', '');
        $this->dateMethod = "getDate".ucfirst($dateMethod);
        $this->numberMethod = "getNumber".ucfirst($numberMethod);
    }
    
    function call($date,$number){
        $this->data = $this->$dateMethod();
        $this->data = $this->$numberMethod();
        return $data;
    }

    function getDateEn (){
        $dateEn = array();
        foreach($this->pdo->query('SELECT date FROM data') as $date){
            if($date > 0){
                $dateArray = explode("-",$date[0]);
                $y = $dateArray[0];
                $m = $dateArray[1];
                $d = $dateArray[2];
                array_push($dateEn, $m."/".$d."/".$y);
                
            }
        }
        return $dateEn;
    }

    function getDateIt (){
        $dateIt = array();
        foreach($this->pdo->query('SELECT date FROM data') as $date){
            if($date > 0){
                $dateArray = explode("-",$date[0]);
                $y = $dateArray[0];
                $m = $dateArray[1];
                $d = $dateArray[2];
                array_push($dateIt, $d."/".$m."/".$y);
                
            }
        }
        return $dateIt;
    }

    function getDateData (){
        $dateData = array();
        foreach($this-> pdo->query('SELECT date FROM data') as $date){
            if($date > 0){
                $dateArray = explode("-",$date[0]);
                $y = $dateArray[0];
                $m = $dateArray[1];
                $d = $dateArray[2];
                array_push($dateData, $y."-".$m."-".$d);
                
            }
        }
        return $dateData;
    }

    function getNumberPoint(){
        $numEn = array();
        foreach($this->pdo->query('SELECT number FROM data') as $number){
            if($number > 0){
                array_push($numEn, str_replace(",",".",$number[0]));
                
            }
        }
        return $numEn;
    }

    function getNumberComma(){
        $numIt = array();
        foreach($this->pdo->query('SELECT number FROM data') as $number){
            if($number > 0){
                array_push($numIt, str_replace(".",",",$number[0]));
                
            }
        }
        return $numIt;
    }
}

?>