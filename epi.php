<?php

require('./dao/EPIDAO.class.php');

$epiDAO = new EPIDAO();

//cria o array associativo
$dados = array("dados"=>$epiDAO->dados());

//converte o conteúdo do array associativo para uma string JSON
$json_str = json_encode($dados);

//imprime a string JSON
echo "$json_str";

