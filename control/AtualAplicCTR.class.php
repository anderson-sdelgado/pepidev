<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require('../model/AtualAplicDAO.class.php');
/**
 * Description of AtualAplicativoCTR
 *
 * @author anderson
 */
class AtualAplicCTR {
    
    public function atualAplic($info) {

        $atualAplicDAO = new AtualAplicDAO();

        $jsonObj = json_decode($info['dado']);
        $dados = $jsonObj->dados;

        foreach ($dados as $d) {
            $celular = $d->idCelularAtual;
            $va = $d->versaoAtual;
        }

        $retorno = 'N';

        $v = $atualAplicDAO->verAtual($celular);
        if ($v == 0) {
            $atualAplicDAO->insAtual($celular, $va);
        } else {
            $result = $atualAplicDAO->retAtual($celular);
            foreach ($result as $item) {
                $vn = $item['VERSAO_NOVA'];
                $vab = $item['VERSAO_ATUAL'];
            }
            if ($va != $vab) {
                $atualAplicDAO->updAtualNova($celular, $va);
            } else {
                if ($va != $vn) {
                    $retorno = 'S'; 
                } else {
                    if (strcmp($va, $vab) <> 0) {
                        $atualAplicDAO->updAtual($celular, $va);
                    }
                }
            }
        }
        return $retorno;
    }
    
}