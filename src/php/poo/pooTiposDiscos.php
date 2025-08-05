<?php

include_once 'pooConnectionDb.php';

class TiposDiscos{
    public static function obtenerTiposDiscos(){
        $consulta = Connection::connect()->prepare("SELECT
            IdTipoDisco,
            NombreTipo
            FROM TiposDisco
            ORDER BY NombreTipo ASC;");

        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

}