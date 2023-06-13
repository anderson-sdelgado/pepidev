<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('../dbutil/OCI.class.php');
/**
 * Description of EntregaEPIDAO
 *
 * @author anderson
 */
class EntregaEPIDAO extends OCI {
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function verifEpi($entrega) {

        $select = " SELECT "
                        . " COUNT(*) AS QTDE "
                    . " FROM "
                        . " EPI_APONTA "
                    . " WHERE "
                        . " DATA_ENTREGA = TO_DATE('" . $entrega->dataEntrega . "','DD/MM/YYYY HH24:MI') "
                        . " AND "
                        . " MATRIC_RECEBEDOR = " . $entrega->matricRecebedor
                        . " AND "
                        . " COD_EPI = " . $entrega->epi;

        $this->Conn = parent::getConn();
        $stid = oci_parse($this->Conn, $select);
        oci_execute($stid);

        while (oci_fetch($stid)) {
            $v = oci_result($stid, 'QTDE');
        }

        oci_free_statement($stid);
        return $v;
        
    }

    public function insEntrega($entrega) {

        $sql = "INSERT INTO EPI_APONTA ("
                    . "  EMPRESA "
                    . " , MATRIC_RECEBEDOR "
                    . " , DATA_ENTREGA "
                    . " , COD_EPI "
                    . " , QTDE_ENTREGUE "
                    . " , COD_MOTIVO "
                    . " , STATUS "
                    . " , DATA_INSERT "
                    . " , MATRIC_ENTREGADOR "
                    . " ) "
                    . " VALUES ("
                    . "  1 "
                    . " , " . $entrega->matricRecebedor
                    . " , TO_DATE('"  . $entrega->dataEntrega . "','DD/MM/YYYY HH24:MI')"
                    . " , " . $entrega->epi
                    . " , 1 "
                    . " , " . $entrega->motivo
                    . " , " . $entrega->status
                    . " , SYSDATE "
                    . " , " . $entrega->matricEntregador
                    . " ) ";

        $this->OCI = parent::getConn();
        $result = oci_parse($this->OCI, $sql);
        oci_execute($result);
        
    }
    
}
