<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of OCI
 *
 * @author anderson
 */
class OCI {
    
    private static $Connect = null;

    private static function Conectar() {
        try {

            if (self::$Connect == null) {

                $tns = "(DESCRIPTION =
                            (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.2.10)(PORT = 1521))
                            (CONNECT_DATA =
                              (SERVER = DEDICATED)
                              (SERVICE_NAME = STAFEDEV)
                            )
                          )";

                self::$Connect = oci_connect('INTERFACE', 'FGBNY946', $tns, 'AL32UTF8');
                
            }
        } catch (PDOException $e) {
            PHPErro($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            die;
        }

        return self::$Connect;
    }

    protected static function getConn() {
        return self::Conectar();
    }
    
}
