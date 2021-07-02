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
    public $statusCarro = 1;
    public $idPreco;

    public function listAll()
    {
        $sql = " SELECT * FROM tblCarros ";

        $stmt = Model::getConexao()->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);

            return $result;
        } else {
            return [];
        }
    }

    public function insert()
    {
        $sql = " INSERT INTO tblCarros
                 (dataEntrada, horaEntrada, nome, placa, statusCarro, idPreco)
                 VALUES
                 (curdate(), curtime(), ?, ?, ?, ?) ";

        $stmt = Model::getConexao()->prepare($sql);
        $stmt->bindValue(1, $this->nome);
        $stmt->bindValue(2, $this->placa);
        $stmt->bindValue(3, $this->statusCarro);
        $stmt->bindValue(4, $this->idPreco);

        if($stmt->execute()){
            $this->idCarro = Model::getConexao()->lastInsertId();
            return $this;
        }else{
            return false;
        }
    }

    public function getpreco()
    {
        $sql = " SELECT MAX(idPreco) as idPreco FROM tblPrecos ";

        $stmt = Model::getConexao()->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $preco = $stmt->fetch(PDO::FETCH_OBJ);

            return $preco;
        } else {
            return [];
        }
    }
}
