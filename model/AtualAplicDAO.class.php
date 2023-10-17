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

    public function verAtual($nroAparelho) {

        $select = "SELECT "
                        . " COUNT(*) AS QTDE "
                    . " FROM "
                        . " PEPI_ATUAL "
                    . " WHERE "
                        . " NRO_APARELHO = " . $nroAparelho;   

        $this->Conn = parent::getConn();
        $stid = oci_parse($this->Conn, $select);
        oci_execute($stid);

        while (oci_fetch($stid)) {
            $v = oci_result($stid, 'QTDE');
        }

        oci_free_statement($stid);
        return $v;
        
    }
        
    public function verToken($token) {

        $select = "SELECT "
                    . " COUNT(*) AS QTDE "
                . " FROM "
                    . " PEPI_ATUAL "
                . " WHERE "
                    . " TOKEN = '" . $token . "'";

        $this->Conn = parent::getConn();
        $stid = oci_parse($this->Conn, $select);
        oci_execute($stid);

        while (oci_fetch($stid)) {
            $v = oci_result($stid, 'QTDE');
        }

        oci_free_statement($stid);
        return $v;
    }

    public function insAtual($nroAparelho, $versao) {
        
        $sql = "INSERT INTO PEPI_ATUAL ("
                                . " NRO_APARELHO "
                                . " , VERSAO "
                                . " , DTHR_ULT_ACESSO "
                                . " , TOKEN "
                            . " ) "
                            . " VALUES ("
                                . " " . $nroAparelho
                                . " , '" . $versao . "'"
                                . " , SYSDATE "
                                . " , '" . strtoupper(md5('PEPI-VERSAO_' . $versao . '-' . $nroAparelho)) . "'"
                            . " )";

        $this->OCI = parent::getConn();
        $result = oci_parse($this->OCI, $sql);
        oci_execute($result);
        
    }
    
    public function retAtual($nroAparelho) {

        $select = " SELECT "
                        . " VERSAO_NOVA "
                        . " , VERSAO_ATUAL"
                    . " FROM "
                        . " PEPI_ATUAL "
                    . " WHERE "
                        . " NRO_APARELHO = " . $nroAparelho;

        $this->Conn = parent::getConn();
        $statement = oci_parse($this->Conn, $select);
        oci_execute($statement);
        oci_fetch_all($statement, $result, null, null, OCI_FETCHSTATEMENT_BY_ROW);
        oci_free_statement($statement);
        return $result;
        
    }

    public function updAtual($nroAparelho, $versao) {

        $sql = "UPDATE PEPI_ATUAL "
                            . " SET "
                                . " VERSAO = '" . $versao . "'"
                                . " , DTHR_ULT_ACESSO = SYSDATE "
                                . " , TOKEN = '" . strtoupper(md5('PEPI-VERSAO_' . $versao . '-' . $nroAparelho)) . "'"
                            . " WHERE "
                                . " NRO_APARELHO = " . $nroAparelho;

        $this->OCI = parent::getConn();
        $result = oci_parse($this->OCI, $sql);
        oci_execute($result);
        
    }
    
    public function updUltAcesso($nroAparelho) {

        $sql = "UPDATE PEPI_ATUAL "
                        . " SET "
                            . " DTHR_ULT_ACESSO = SYSDATE "
                        . " WHERE "
                            . " NRO_APARELHO = " . $nroAparelho;

        $this->OCI = parent::getConn();
        $result = oci_parse($this->OCI, $sql);
        oci_execute($result);
        
    }

    public function dataHora() {

        $select = " SELECT "
                        . " TO_CHAR(SYSDATE, 'DD/MM/YYYY HH24:MI') AS DTHR "
                    . " FROM "
                        . " DUAL ";


        $this->Conn = parent::getConn();
        $stid = oci_parse($this->Conn, $select);
        oci_execute($stid);

        while (oci_fetch($stid)) {
            $v = oci_result($stid, 'DTHR');
        }

        oci_free_statement($stid);
        return $v;
    }
    
}
