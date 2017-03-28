<?php 
require_once('Gestor.php');
class Api {
    
    private $dPref, $nPref;
    private $dat, $number;
    
    function __construct($datePref, $numberPref) {
        $this->dPref = $datePref;
        $this->nPref = $numberPref;
    }
    
    function doTask(){
        $objeto = new Gestor($this->dPref, $this->nPref);
        $methodDa = "getDate".ucfirst($this->dPref);
        $methodNu = "getNumber".ucfirst($this->nPref);
        $this->dat = $objeto->$methodDa();
        $this->number = $objeto->$methodNu();
        return $this->getResponse();
    }
           
    function getResponse(){
        $data = array();
        $i = 0;
        foreach($this->dat as $d){
            $a = array($this->dat[$i], $this->number[$i]);
            array_push($data,$a);
            $i++;
        }
        return $data;
    }
}