<?php

use App\Core\Controller;

class Carros extends Controller
{

    public function index()
    {
        $carroModel = $this->Model("Carro");

        $carros = $carroModel->listAll();

        echo json_encode($carros, JSON_UNESCAPED_UNICODE);
    }

    public function store()
    {

        $novoCarro = $this->getRequestBody();

        $carroModel = $this->Model("Carro");

        $carroModel->nome = $novoCarro->nome;
        $carroModel->placa = $novoCarro->placa;
        $carroModel->idPreco = $carroModel->getPreco()->idPreco;


        $carroModel = $carroModel->insert();

        if ($carroModel) {
            http_response_code(201);
            echo json_encode($carroModel, JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(500);
            echo json_encode(["erro" => "Problemas ao inserir um novo carro"]);
        }
    }
    public function update($id)
    {
        
    }
}
