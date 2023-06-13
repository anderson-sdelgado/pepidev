<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/EPIDAO.class.php');
require_once('../model/FuncDAO.class.php');
require_once('../model/MotivoDAO.class.php');
/**
 * Description of BaseDadosCTR
 *
 * @author anderson
 */
class BaseDadosCTR {
    
    public function dadosEPI() {

        $epiDAO = new EPIDAO();

        $epiDAO->atual();
        $dados = array("dados"=>$epiDAO->dados());
        $json_str = json_encode($dados);

        return $json_str;

    }
    
    public function dadosFunc() {

        $funcDAO = new FuncDAO();

        $dados = array("dados"=>$funcDAO->dados());
        $json_str = json_encode($dados);

        return $json_str;

    }

    public function dadosMotivo() {

        $motivoDAO = new MotivoDAO();

        $dados = array("dados"=>$motivoDAO->dados());
        $json_str = json_encode($dados);

        return $json_str;

    }
    
}
