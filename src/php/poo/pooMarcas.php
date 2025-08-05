<?php

include_once 'pooConnectionDb.php';

class Marcas {
    public static function obtenerMarcas() {
        $consulta = Connection::connect()->prepare("SELECT
                     IdMarca,
                     Nombre
                     FROM Marcas
                     ORDER BY Nombre ASC;");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function obtenerMarcasTelefonos() {
        $consulta = Connection::connect()->prepare("SELECT
            IdMarca,
            Nombre
            FROM Marcas
            WHERE nombre LIKE '%Yealink%' OR nombre LIKE '%grandstream%'
            ORDER BY Nombre ASC;");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
}