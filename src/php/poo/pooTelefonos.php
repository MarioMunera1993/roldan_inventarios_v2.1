<?php

include_once 'pooConnectionDb.php';

class Telefonos {
     //traera todos los Telefonos con sus caracteristicas
    public static function mostrarTotalTelefonos() {
        $consulta = Connection::connect()->prepare("SELECT
                    t.IdTelefono,
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
                    JOIN Ubicaciones AS u ON t.IdUbicacion = u.IdUbicacion 
                    ORDER BY t.PlacaTelefono ASC;");
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

    // Devuelve los datos de un Telefono para edición
    public static function obtenerDatosParaEditar($placa) {
        $conn = Connection::connect();
        $stmt = $conn->prepare("SELECT
                    t.PlacaTelefono,
                    m.IdMarca,
                    md.IdModelo,
                    t.Serial,
                    tp.IdTipo,
                    t.IpTelefono,
                    t.Mac,
                    t.FechaCompra,
                    e.IdEstado,
                    t.Precio,
                    t.Notas,
                    u.IdUbicacion
                    FROM Telefonos AS t
                    JOIN Modelos AS md ON md.IdModelo = t.IdModelo
                    JOIN Marcas AS m ON md.IdMarca = m.IdMarca
                    JOIN Tipos AS tp ON t.IdTipoTelefono = tp.IdTipo
                    JOIN Estados AS e ON t.IdEstado = e.IdEstado
                    JOIN Ubicaciones AS u ON t.IdUbicacion = u.IdUbicacion 
                    WHERE t.PlacaTelefono = ?");
        $stmt->execute([$placa]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

   public static function editarTelefonos() {
        try {
            $conn = Connection::connect();
            $conn->beginTransaction();

            // 1. Validar y obtener datos del POST
            if (!isset($_POST['PlacaTelefono']) || empty($_POST['PlacaTelefono'])) {
                return "Placa del teléfono no proporcionada";
            }

            // Obtener datos del POST
            $PlacaTelefono = $_POST['PlacaTelefono'];
            $IdMarca = $_POST['IdMarca'];
            $IdModelo = $_POST['IdModelo']; // Cambiado de idModelo a IdModelo
            $Serial = $_POST['serial']; // Cambiado de serial a Serial
            $IdTipo = $_POST['IdTipo'];
            $IpTelefono = $_POST['ipTelefono'];
            $Mac = $_POST['Mac'];
            $FechaCompra = $_POST['FechaCompra'];
            $IdEstado = $_POST['IdEstado'];
            // Convertir y validar el precio
            $Precio = !empty($_POST['Precio']) ? floatval(str_replace(',', '.', $_POST['Precio'])) : 0.00;
            if (!is_numeric($Precio) || $Precio < 0) {
                $conn->rollBack();
                return "El precio debe ser un número válido y no puede ser negativo";
            }
            $Notas = $_POST['Observaciones']; // Cambiado de Notas a Observaciones para coincidir con el formulario
            $IdUbicacion = $_POST['IdUbicacion'];

            // 2. Validar que el teléfono existe
            $stmt = $conn->prepare("SELECT PlacaTelefono FROM Telefonos WHERE PlacaTelefono = ?");
            $stmt->execute([$PlacaTelefono]);
            if (!$stmt->fetch()) {
                $conn->rollBack();
                return "El teléfono no existe en la base de datos";
            }

            // 3. Validar que el modelo existe y pertenece a la marca seleccionada
            $stmt = $conn->prepare("SELECT IdModelo 
                                  FROM Modelos 
                                  WHERE IdModelo = ? AND IdMarca = ?");
            $stmt->execute([$IdModelo, $IdMarca]);
            if (!$stmt->fetch()) {
                $conn->rollBack();
                return "El modelo seleccionado no existe para esta marca";
            }

            // 4. Validar rango de placa (2001-2999)
            if ($PlacaTelefono < 2001 || $PlacaTelefono >= 3000) {
                $conn->rollBack();
                return "El número de placa debe estar en el rango del (2001) al (2999)";
            }

            // 5. Validar que el serial no esté duplicado (excluyendo el teléfono actual)
            if (!empty($Serial)) {
                $stmt = $conn->prepare("SELECT PlacaTelefono FROM Telefonos WHERE Serial = ? AND PlacaTelefono != ?");
                $stmt->execute([$Serial, $PlacaTelefono]);
                if ($stmt->fetch()) {
                    $conn->rollBack();
                    return "El número de serial ya está registrado en otro teléfono";
                }
            }

            // 7. Actualizar el teléfono
            $stmt = $conn->prepare("UPDATE Telefonos SET
                IdModelo = ?,
                IdTipoTelefono = ?,
                IpTelefono = ?,
                Mac = ?,
                FechaCompra = ?,
                IdEstado = ?,
                IdUbicacion = ?,
                Precio = ?,
                Notas = ?,
                Serial = ?
                WHERE PlacaTelefono = ?");

            $stmt->execute([
                $IdModelo,
                $IdTipo,
                $IpTelefono,
                $Mac,
                $FechaCompra,
                $IdEstado,
                $IdUbicacion,
                $Precio,
                $Notas,
                $Serial,
                $PlacaTelefono
            ]);

            $conn->commit();
            return true;

        } catch (Exception $e) {
            if (isset($conn)) $conn->rollBack();
            return 'Error al actualizar: ' . $e->getMessage();
        }
    }
}