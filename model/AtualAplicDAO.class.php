<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('../dbutil/OCI.class.php');
/**
 * Description of AtualizaAplicDAO
 *
 * @author anderson
 */
class AtualAplicDAO extends OCI {
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function verAtual($celular) {

        $select = "SELECT "
                        . " COUNT(*) AS QTDE "
                    . " FROM "
                        . " PEPI_ATUALIZACAO "
                    . " WHERE "
                        . " NUMERO_LINHA = " . $celular;    

        $this->Conn = parent::getConn();
        $stid = oci_parse($this->Conn, $select);
        oci_execute($stid);

        while (oci_fetch($stid)) {
            $v = oci_result($stid, 'QTDE');
        }

        oci_free_statement($stid);
        return $v;
        
    }
    
    public function insAtual($celular, $va) {
        
        $sql = "INSERT INTO PEPI_ATUALIZACAO ("
                    . " NUMERO_LINHA "
                    . " , VERSAO_ATUAL "
                    . " , VERSAO_NOVA "
                    . " , DTHR_ULT_ATUAL "
                    . " ) "
                    . " VALUES ("
                    . " " . $celular
                    . " , " . $va
                    . " , " . $va
                    . " , SYSDATE "
                    . " )";

        $this->OCI = parent::getConn();
        $result = oci_parse($this->OCI, $sql);
        oci_execute($result);
        
    }
    
    public function retAtual($celular) {

        $select = " SELECT "
                        . " VERSAO_NOVA "
                        . " , VERSAO_ATUAL"
                    . " FROM "
                        . " PEPI_ATUALIZACAO "
                    . " WHERE "
                        . " NUMERO_LINHA = " . $celular;

        $this->Conn = parent::getConn();
        $statement = oci_parse($this->Conn, $select);
        oci_execute($statement);
        oci_fetch_all($statement, $result, null, null, OCI_FETCHSTATEMENT_BY_ROW);
        oci_free_statement($statement);
        return $result;
        
    }
    
    public function updAtualNova($celular, $va) {

        $sql = "UPDATE PBM_ATUALIZACAO "
                        . " SET "
                        . " VERSAO_ATUAL = TRIM(TO_CHAR(" . $va . ", '99999999D99'))"
                        . " , VERSAO_NOVA = TRIM(TO_CHAR(" . $va . ", '99999999D99'))"
                        . " , DTHR_ULT_ATUAL = SYSDATE "
                        . " WHERE "
                        . " NUMERO_LINHA = " . $celular;

        $this->OCI = parent::getConn();
        $result = oci_parse($this->OCI, $sql);
        oci_execute($result);
        
    }

    public function updAtual($celular, $va) {

        $sql = "UPDATE PBM_ATUALIZACAO "
                    . " SET "
                    . " VERSAO_ATUAL = TRIM(TO_CHAR(" . $va . ", '99999999D99'))"
                    . " , DTHR_ULT_ATUAL = SYSDATE "
                    . " WHERE "
                        . " NUMERO_LINHA = " . $celular;

        $this->OCI = parent::getConn();
        $result = oci_parse($this->OCI, $sql);
        oci_execute($result);
        
    }
    
    
}
