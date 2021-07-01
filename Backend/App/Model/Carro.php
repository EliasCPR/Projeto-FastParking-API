<?php

use App\Core\Model;

class Carro
{

    public $idCarro;
    public $nome;
    public $placa;
    public $dataEntrada;
    public $horaEntrada;
    public $horaSaida;
    public $valorPago;
    public $statusCarro;
    public $idPreco;

    public function listAll(){
        $sql = " SELECT * FROM tblCarros ";

        $stmt = Model::getConexao()->prepare($sql);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);

            return $result;
        }else{
            return [];
        }
    }

}
