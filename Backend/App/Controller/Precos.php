<?php

use App\Core\Controller;

class Precos extends Controller{
    public function index(){
        $precoModel = $this->Model("Preco");

        $precos = $precoModel->listAll();

        echo json_encode($precos, JSON_UNESCAPED_UNICODE);
    }
}