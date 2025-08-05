<?php

include_once 'pooConnectionDb.php';

class GeneracionRam{
    public static function obtenerGeneracionRam() {
        $consulta = Connection::connect()->prepare("SELECT
                     IdGeneracionRam,
                     GeneracionRam
                     FROM genRam
                     ORDER BY GeneracionRam ASC;");

        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
}