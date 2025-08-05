<?php

include_once 'pooConnectionDb.php';

class Estados{

    public static function obtenerEstados(){

        $consulta = Connection::connect()->prepare("SELECT
            IdEstado,
            Nombre
            FROM Estados
            ORDER BY Nombre ASC;");

        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
}