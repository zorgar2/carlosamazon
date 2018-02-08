<?php

namespace App\Helper;

class DbHelper {
    function __construct() {
        $opciones = [\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"];
        try {
            $this->db = new \PDO('mysql:host=localhost;dbname=cms', 'Amazon_aws', 'jkanime2', $opciones);
            $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            echo 'Falló la conexión: ' . $e->getMessage();
        }
    }
}
