<?php
class Camera{
    public function listCamera(){
        global $pdo;
        $slq;
        $dados = array();

        $sql = $pdo->prepare("SELECT `idcamera`,`alias`, `nome`, `endereco`, `screenshot`, `status`,`data_cadastro` FROM `camera`;");
        $sql->execute();
        if($sql->rowCount() > 0){
            $dados = $sql->fetchAll();
        }
        return $dados;
    }

    public function addCamera($alias, $nome, $endereco, $screenshot, $status){
        global $pdo;
        
        $sql = $pdo->prepare("INSERT INTO `camera`(`nome`, `alias`, `endereco`, `screenshot`, `status`) VALUES (?,?,?,?,?);");
        $sql->bindValue(1,$nome);
        $sql->bindValue(2,$alias);
        $sql->bindValue(3,$endereco);
        $sql->bindValue(4,$screenshot);
        $sql->bindValue(5,$status);
        if($sql->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function editCamera($id, $nome, $status){
        global $pdo;
        $sql = $pdo->prepare("UPDATE `camera` SET `nome`=?,`status`=? WHERE `idcamera` = ?;");
        $sql->bindValue(1,$nome);
        $sql->bindValue(2,$status);
        $sql->bindValue(3,$id);
        if($sql->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function deleteCamera($id){
        global $pdo;
        $sql = $pdo->prepare("DELETE FROM `camera` WHERE `idcamera` = ?;");
        $sql->bindValue(1,$id);
        if($sql->execute()){
            return true;
        }else{
            return false;
        }
    }
}