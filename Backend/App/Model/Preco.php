<?php

use App\Core\Model;

class Preco {

    public $id;
    public $primeiraHora;
    public $demaisHoras;
    public $dataHora;

    public function listAll(){
        $sql = " SELECT * FROM tblPrecos ";

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