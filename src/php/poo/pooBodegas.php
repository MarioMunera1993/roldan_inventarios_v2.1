<?php

include_once 'pooConnectionDb.php';

class Bodegas{

    public static function obtenerBodegas(){

        $consulta = Connection::connect()->prepare("SELECT
            IdUbicacion,
            Nombre
            FROM Ubicaciones
            ORDER BY Nombre ASC;");

        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
}