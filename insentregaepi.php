<?php

require('./dao/EntregaEPIDAO.class.php');

$entregaEPIDAO = new EntregaEPIDAO();
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$codigo = 0;

    if (isset($dados)):

            //$json_str = ' {"dados":[{"dataEntrega":"10/11/2016 10:36","epi":130,"idEntrega":1,"matricEntregador":19759,"matricRecebedor":19759,"motivo":3,"status":3},{"dataEntrega":"10/11/2016 11:24","epi":130,"idEntrega":2,"matricEntregador":19759,"matricRecebedor":19759,"motivo":3,"status":2},{"dataEntrega":"10/11/2016 11:26","epi":130,"idEntrega":3,"matricEntregador":19759,"matricRecebedor":19759,"motivo":3,"status":0}]}';
						   //{"dados":[{"dataEntrega":"10/11/2016 09:55","epi":130,"idEntrega":1,"matricEntregador":19759,"matricRecebedor":19759,"motivo":1,"status":0}]}
						   //{"dados":[{"dataEntrega":"10/11/2016 09:55","epi":130,"idEntrega":1,"matricEntregador":19759,"matricRecebedor":19759,"motivo":1,"status":0},{"dataEntrega":"10/11/2016 09:58","epi":130,"idEntrega":2,"matricEntregador":19759,"matricRecebedor":19759,"motivo":5,"status":3}]}
			
            //faz o parsing da string, criando o array "empregados"
            $jsonObj = json_decode($dados['dados']);
			//$jsonObj = json_decode($json_str);
            $dados = $jsonObj->dados;
            $teste = $entregaEPIDAO->salvarDados($dados);

    endif;

	
    echo 'GRAVOU';