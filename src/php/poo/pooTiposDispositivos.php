<?php

include_once 'pooConnectionDb.php';

class Tipos{
    public static function obtenerTipos(){
        $consulta = Connection::connect()->prepare("SELECT
            IdTipo,
            Nombre
            FROM Tipos
            ORDER BY Nombre ASC;");

        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function obtenerTiposTelefono(){
        $consulta = Connection::connect()->prepare("SELECT
            IdTipo,
            Nombre
            FROM Tipos
            WHERE Nombre LIKE '%inalambrico%' OR Nombre LIKE '%fijo%'
            ORDER BY Nombre ASC;");

        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
}