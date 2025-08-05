<?php

include_once 'pooConnectionDb.php';

class Modelos{
    public static function obtenerModelos() {
        $consulta = Connection::connect()->prepare("SELECT
                     IdModelo,
                     NombreModelo
                     FROM Modelos
                     ORDER BY NombreModelo ASC;");

        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener todos los modelos de una marca
    public static function obtenerModelosPorMarca($IdMarca) {
        $conn = Connection::connect();
        $stmt = $conn->prepare("SELECT * FROM Modelos WHERE IdMarca = ?");
        $stmt->execute([$IdMarca]);
        return $stmt->fetchAll();
    }
}