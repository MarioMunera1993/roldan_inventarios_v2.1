<?php

include_once 'pooConnectionDb.php';

class SistemasOperativos{
    public static function obtenerSistemasOperativos() {
        $consulta = Connection::connect()->prepare("SELECT
                    IdSistemaOperativo,
                    Nombre
                    FROM SistemaOperativo
                    ORDER BY Nombre ASC;");

        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
}