<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'ConnDEV.class.php';
/**
 * Description of EntregaEPIDAO
 *
 * @author anderson
 */
class EntregaEPIDAO extends ConnDEV {
    //put your code here
  
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function salvarDados($dados) {
        
        $cod = 0;

        $select = " SELECT COUNT(ID) AS ID FROM EPI_APONTA ";

        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        foreach ($result as $ret):
            $codigo = $ret['ID'];
        endforeach;
		
        foreach ( $dados as $d )
        {

            $codigo = $codigo + 1;
		
            $insert = "INSERT INTO EPI_APONTA (ID, EMPRESA, MATRIC_RECEBEDOR, DATA_ENTREGA"
            . ", COD_EPI, QTDE_ENTREGUE, COD_MOTIVO, STATUS"
            . ", DATA_INSERT, MATRIC_ENTREGADOR) "
            . " VALUES (" . $codigo . ", 1, " . $d->matricRecebedor . ", "
            . " TO_DATE('"  . $d->dataEntrega . "','DD/MM/YYYY HH24:MI'), "
            . " " . $d->epi . ", 1, "
            . " " . $d->motivo . ", " . $d->status . ", "
            . " SYSDATE, " . $d->matricEntregador . ")";

            //$this->Conn = parent::getConn();
            $this->Create = $this->Conn->prepare($insert);
            $this->Create->execute();
			
			//$codigo = $insert;

        }
        
        return $codigo;
		
    }
    
}
