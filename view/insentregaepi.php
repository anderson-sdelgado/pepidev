<?php

$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

require_once('../control/EntregaEPICTR.class.php');

if (isset($info)):

    $entregaEPICTR = new EntregaEPICTR();
    $entregaEPICTR->salvar($info);
    echo 'GRAVOU';

endif;

