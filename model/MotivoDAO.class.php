<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('../dbutil/OCI.class.php');
/**
 * Description of MotivoDAO
 *
 * @author anderson
 */
class MotivoDAO extends OCI {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados() {

        $select = " SELECT DISTINCT "
                    . " MOTIVOEPI_ID as \"idMotivo\" "
                    . " , CD as \"codMotivo\" "
                    . " , DESCR as \"descrMotivo\" "
                . " FROM "
                    . " USINAS.MOTIVO_EPI "
                . " ORDER BY "
                    . " CD "
                . " ASC";

        $this->Conn = parent::getConn();
        $statement = oci_parse($this->Conn, $select);
        oci_execute($statement);
        oci_fetch_all($statement, $result, null, null, OCI_FETCHSTATEMENT_BY_ROW);
        oci_free_statement($statement);
        return $result;
        
    }
    
    
}
