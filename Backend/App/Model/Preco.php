<?php

use App\Core\Model;

class Preco
{

    public $idPreco;
    public $primeiraHora;
    public $demaisHoras;
    public $dataHora;
    public $idCarro;

    public function listAll()
    {
        $sql = " SELECT * FROM tblPrecos ";

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
        $sql = " INSERT INTO tblPrecos 
                (dataHora, idCarro, primeiraHora, demaisHoras) 
                VALUES  (?, ?, ?, ?) ";

        $stmt = Model::getConexao()->prepare($sql);
        $stmt->bindValue(1, $this->dataHora);
        $stmt->bindValue(2, $this->idCarro);
        $stmt->bindValue(3, $this->primeiraHora);
        $stmt->bindValue(4, $this->demaisHoras);

        if ($stmt->execute()) {
            $this->idPreco = Model::getConexao()->lastInsertId();
            return $this;
        } else {
            return false;
        }


        // insert into tblPrecos (dataHora, idCarro, primeiraHora, demaisHoras) 
        // values ('2021-06-28 11:39:00', 2, 2, 5);
    }

    public function buscarPorId($id)
    {

        $sql = " SELECT * FROM tblPrecos WHERE idPreco = ? ";

        $stmt = Model::getConexao()->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $preco = $stmt->fetch(PDO::FETCH_OBJ);

            $this->idPreco = $preco->idPreco;
            $this->dataHora = $preco->dataHora;
            $this->idCarro = $preco->idCarro;
            $this->primeiraHora = $preco->primeiraHora;
            $this->demaisHoras = $preco->demaisHoras;
            return $this;
        } else {
            return false;
        }
    }

    public function getDateTime(){
        $sql = " SELECT current_timestamp() as dataHoraAtual ";

        $stmt = Model::getConexao()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $result[0]->dataHoraAtual;
    }
}
