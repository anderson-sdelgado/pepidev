<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'ConnDEV.class.php';
/**
 * Description of EPIDAO
 *
 * @author anderson
 */
class EPIDAO extends ConnDEV {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados() {

	$result = "";
	
	try{
	
        $select = " SELECT "
                    . " EP.EQUIPPROT_ID AS \"idEPI\" "
                    . " , PR.CD AS \"codigoEPI\" "
                    . " , CARACTER(PR.DESCR) AS \"descricaoEPI\" "
                . " FROM "
                    . " USINAS.EQUIP_PROTECAO EP "
                    . " , USINAS.PROD PR "
                . " WHERE "
                    . " EP.PROD_ID = PR.PROD_ID "
                . " ORDER BY PR.CD DESC ";    
        
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        }
        catch (Exception $e)
        {

        }
		
        return $result;
    }
    
}
