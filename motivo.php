<?php

require('./dao/MotivoDAO.class.php');

$motivoDAO = new MotivoDAO();

//cria o array associativo
$dados = array("dados"=>$motivoDAO->dados());

//converte o conteúdo do array associativo para uma string JSON
$json_str = json_encode($dados);

//imprime a string JSON
echo "$json_str";
