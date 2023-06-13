<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('../dbutil/OCI.class.php');
/**
 * Description of FuncDAO
 *
 * @author anderson
 */
class FuncDAO extends OCI {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados() {

        $select = " SELECT DISTINCT "
                    . " CL.CD AS \"matricFunc\" "
                    . " , CR.NOME AS \"nomeFunc\" "
                . " FROM "
                    . " USINAS.COLAB CL "
                    . " , USINAS.CORR CR "
                    . " , USINAS.REG_DEMIS RD "
                . " WHERE "
                    . " CL.CORR_ID = CR.CORR_ID "
                    . " AND CL.CD > 11406 "
                    . " AND CL.COLAB_ID = RD.COLAB_ID(+) "
                    . " AND RD.COLAB_ID IS NULL "
                . " ORDER BY "
                    . " CL.CD "
                . " ASC";      

        $this->Conn = parent::getConn();
        $statement = oci_parse($this->Conn, $select);
        oci_execute($statement);
        oci_fetch_all($statement, $result, null, null, OCI_FETCHSTATEMENT_BY_ROW);
        oci_free_statement($statement);
        return $result;
        
    }
    
}
