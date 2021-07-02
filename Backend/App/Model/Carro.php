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

        if ($stmt->execute()) {
            $this->idCarro = Model::getConexao()->lastInsertId();
            return $this;
        } else {
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

    public function findById($id){
        $sql = " SELECT * FROM tblCarros WHERE idCarro = ? ";

        $stmt = Model::getConexao()->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $carro = $stmt->fetch(PDO::FETCH_OBJ);

            $this->idCarro = $carro->id;
            $this->nome = $carro->nome;
            $this->placa = $carro->placa;
            $this->dataEntrada = $carro->dataEntrada;
            $this->horaEntrada = $carro->horaEntrada;
            $this->horaSaida = $carro->horaSaida;
            $this->valorPago = $carro->valorPago;
            $this->statusCarro = $carro->statusCarro;
            $this->idPreco = $carro->idPreco;

            return $this;
        }else{
            return false;
        }
    }

    public function update(){
        $sql = " UPDATE tblCarros  
                 SET nome = ?, placa = ? 
                 where idCarro = ? ";

        $stmt = Model::getConexao()->prepare($sql);
        $stmt->bindValue(1, $this->nome);
        $stmt->bindValue(2, $this->placa);
        $stmt->bindValue(3, $this->id);

        return $stmt->execute();
    }
}
