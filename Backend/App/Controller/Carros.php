<?php

use App\Core\Controller;

class Carros extends Controller{
    
    public function index(){
        $carroModel = $this->Model("Carro");

        $carros = $carroModel->listAll();

        echo json_encode($carros, JSON_UNESCAPED_UNICODE);
    }
}