<?php

include_once 'pooConnectionDb.php';

class Telefonos {
     //traera todos los Telefonos con sus caracteristicas
    public static function mostrarTotalTelefonos() {
        $consulta = Connection::connect()->prepare("SELECT
                    t.PlacaTelefono,
                    m.Nombre AS MarcaTelefono,
                    md.NombreModelo AS ModeloTelefono,
                    t.Serial,
                    tp.Nombre AS TipoTelefono,
                    t.IpTelefono,
                    t.Mac,
                    t.FechaCompra,
                    e.Nombre AS EstadoTelefono,
                    t.Precio,
                    t.Notas,
                    u.Nombre AS Ubicacion
                    FROM Telefonos AS t
                    JOIN Modelos AS md ON md.IdModelo = t.IdModelo
                    JOIN Marcas AS m ON md.IdMarca = m.IdMarca
                    JOIN Tipos AS tp ON t.IdTipoTelefono = tp.IdTipo
                    JOIN Estados AS e ON t.IdEstado = e.IdEstado
                    JOIN Ubicaciones AS u ON t.IdUbicacion = u.IdUbicacion ");
        $consulta->execute();
        $datos = $consulta->fetchAll();
        return $datos;
    }

    // Inserta un nuevo computador y sus datos relacionados
    public static function insertarNuevoTelefono(){
        
        try{

            $conn = Connection::connect();
            $conn->beginTransaction();

            $PlacaTelefono = $_POST['PlacaTelefono'];
            $IdMarca = $_POST['IdMarca'];
            $IdModelo = $_POST['idModelo'];
            $Serial = $_POST['serial'];
            $IdTipo = $_POST['IdTipo'];
            $IpTelefono = $_POST['ipTelefono'];
            $Mac = $_POST['Mac'];
            $fechaCompra = $_POST['FechaCompra'];
            $IdEstado = $_POST['IdEstado'];
            $Precio = $_POST['Precio'];
            $IdUbicacion = $_POST['IdUbicacion'];
            $Observaciones = $_POST['Observaciones'];

            $stmt = $conn->prepare("INSERT INTO Telefonos (
                                PlacaTelefono,
                                IdMarca,  
                                IdModelo, 
                                IdTipoTelefono,
                                IpTelefono,
                                Mac, 
                                FechaCompra, 
                                IdEstado, 
                                IdUbicacion,
                                Precio, 
                                Notas,
                                Serial) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$PlacaTelefono, $IdMarca, $IdModelo, $IdTipo, $IpTelefono, $Mac, $fechaCompra, $IdEstado, $IdUbicacion, $Precio, $Observaciones, $Serial ]);
            $conn->commit();
            return true;

        }catch (Exception $e) {
            if (isset($conn)) $conn->rollBack();
            return 'Error al guardar: ' . $e->getMessage();
        }

    }
}