<?php
require_once '../database/DB.php';
class ItemDAO {
    public function list($id = null) {
        $where = ($id ? "where it.iditem = $id":"");
        $query = "select it.iditem, it.nome, ig.descricao,it.validade,it.valor from ingredientes ig INNER JOIN item it on it.idingredientes = ig.idingredientes $where";
        $conn = DB::getInstancia()->query($query);
        $resultado = $conn->fetchAll();
        return $resultado;
    }
    public function insert(item $obj) {
        $query = "INSERT INTO item (iditem,nome,validade,valor,idingredientes) VALUES (null,:pnome,:pvalidade,:pvalor, :pidingredientes)";
         $conn = DB::getInstancia()->prepare($query);
        $conn->execute(array(':pnome'=>$obj->nome,':pvalidade'=>$obj->validade,':pvalor'=>$obj->valor,':pidingredientes'=>$obj->idingredientes));
        return $conn->rowCount()>0;
    }
    public function update(item $obj) {
        $querry = "UPDATE item SET  nome = :pnome,validade = :pvalidade,valor = :pvalor,idingredientes = :pidingredientes WHERE iditem = :piditem";
         $conn = DB::getInstancia()->prepare($query);
        $conn->execute(array(':pnome'=>$obj->nome,':pvalidade'=>$obj->validade,':pvalor'=>$obj->valor,':pidingredientes'=>$obj->idingredientes,':piditem'=>$obj->iditem));
        return $conn->rowCount()>0;
    }
    public function delete($id) {
        $query = "DELETE from item where iditem = :pid";
        $conn = DB::getInstancia()->prepare($query);
        $conn->execute(array(':pid'=>$id));
        return $conn->rowCount()>0;
    }
}

?>