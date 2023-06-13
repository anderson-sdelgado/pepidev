<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('../dbutil/OCI.class.php');
/**
 * Description of EPIDAO
 *
 * @author anderson
 */
class EPIDAO extends OCI {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function atual(){
        
        $sql = "BEGIN PB_EPI_ESTOQUE(); END;";
        
        $this->Conn = parent::getConn();
        $stid = oci_parse($this->Conn, $sql);
        oci_execute($stid);
        
    }
    
    public function dados() {

        $select = " SELECT "
                    . " EQUIPPROT_ID AS \"idEPI\" "
                    . " , CD AS \"codEPI\" "
                    . " , CARACTER(DESCR) AS \"descrEPI\" "
                    . " , QTDE AS \"qtdeEPI\" "
                . " FROM "
                    . " EPI_ESTOQUE "
                . " ORDER BY CD DESC ";    

        $this->Conn = parent::getConn();
        $statement = oci_parse($this->Conn, $select);
        oci_execute($statement);
        oci_fetch_all($statement, $result, null, null, OCI_FETCHSTATEMENT_BY_ROW);
        oci_free_statement($statement);
        return $result;
    }
    
}
