<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/EntregaEPIDAO.class.php');
/**
 * Description of InserirDadosMecan
 *
 * @author anderson
 */
class EntregaEPICTR {

    public function salvar($info) {
        $jsonObj = json_decode($info['dados']);
        $dadosEntrega = $jsonObj->dados;
        $entregaEPIDAO = new EntregaEPIDAO();
        foreach ($dadosEntrega as $entrega ){
            $v = $entregaEPIDAO->verifEpi($entrega);
            if ($v == 0) {
                $entregaEPIDAO->insEntrega($entrega);
            }
        }
    }


}
