<?php
class Controller{
    public $views, $model;
    public function __construct() 
    {
        $this->views = new Views();
        $this->cargarModel();
    }
    function cargarModel() 
    {
        $model = get_class($this)."Model";  //obtenemos el nombre de la clase actual (el controlador)
        $ruta = "Models/".$model.".php";    //creamos la ruta del archivo a incluir
        if(file_exists($ruta)){
            require_once $ruta;
            $this->$model = new $model();   //instanciamos al modelo y lo asignamos
        }                                   //verificamos que exista el archivo en esa ruta
    }
}

?>