<?php

use App\Core\Controller;

class Precos extends Controller
{
    public function index()
    {
        $precoModel = $this->Model("Preco");

        $precos = $precoModel->listAll();

        echo json_encode($precos, JSON_UNESCAPED_UNICODE);
    }

    public function find($id)
    {

        $precoModel = $this->Model("Preco");
        $preco = $precoModel->buscarPorId($id);

        if ($preco) {
            echo json_encode($preco, JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(400);
            echo json_encode(["erro" => "Preço não encontrada"], JSON_UNESCAPED_UNICODE);
        }
    }

    public function store()
    {
        $novoPreco = $this->getRequestBody();

        $precoModel = $this->Model("Preco");

        $precoModel->dataHora = $precoModel->getDateTime();
        $precoModel->idCarro = $novoPreco->idCarro;
        $precoModel->primeiraHora = $novoPreco->primeiraHora;
        $precoModel->demaisHoras = $novoPreco->demaisHoras;

        $precoModel = $precoModel->insert();

        if ($precoModel) {
            http_response_code(201);
            echo json_encode($precoModel, JSON_UNESCAPED_UNICODE);
        } else {
            //se deu errado, mudar status code para 500 e retornar mensagem de erro
            http_response_code(500);
            echo json_encode(["erro" => "Problemas ao inserir preços"]);
        }
    }
}
