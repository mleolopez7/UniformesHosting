<?php
class Errors extends Controller{
   
    public function __construct(){
        session_start(); 
        parent::__construct();
     } 

    function index(){
        $this->views->getView('Errors', 'index');

    }

    function permisos(){      
        $this->views->getView('Errors', 'permisos');
       
    }
}

?>