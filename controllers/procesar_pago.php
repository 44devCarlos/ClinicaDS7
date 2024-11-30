<?php
require("../includes/Database.php");
include "../includes/Correo.php";
include "../includes/Usuarios.php";
session_start();

$database = new Database();
$db = $database->getConnection();

$correo = new Correo($db);
$usuarios = new Usuarios($db);
$usuarios->nombre = $_POST['nombre'];
// Obtener los datos del formulario
$cita_id = $_POST['cita_id'];
$monto = $_POST['amount'];
$paciente_id = $_POST['paciente_id'];


// Aquí iría la lógica para procesar el pago
// Suponiendo que el pago fue procesado exitosamente
$pagoExitoso = true;

if ($pagoExitoso) {
    try {
        // Iniciar una transacción
        $db->beginTransaction();

        // Cambiar el estado de la cita a "Pagado"
        $updateCitaQuery = "UPDATE citas SET transaccion = 'Pagado' WHERE cita_id = :cita_id";
        $stmt = $db->prepare($updateCitaQuery);
        $stmt->bindParam(':cita_id', $cita_id, PDO::PARAM_INT);

        // Ejecutar la consulta y verificar errores
        if ($stmt->execute()) {
            // Insertar un nuevo registro en la tabla `facturas`
            $insertFacturaQuery = "INSERT INTO facturas (paciente_id, fecha_emision, monto, estado) VALUES (:paciente_id, NOW(), :monto, 'Pagado')";
            $stmt = $db->prepare($insertFacturaQuery);
            $stmt->bindParam(':paciente_id', $paciente_id, PDO::PARAM_INT);
            $stmt->bindParam(':monto', $monto, PDO::PARAM_STR);
            $stmt->execute();

            // Confirmar la transacción
            $db->commit();
            $_SESSION['mensaje'] = "Pago procesado exitosamente.";
            $query = "SELECT 
                        c.cita_id,
                        u.nombre,
                        u.email,
                        sm.nombre_servicio
                        FROM citas AS c
                        LEFT JOIN pacientes AS p ON p.paciente_id = c.paciente_id
                        LEFT JOIN usuarios AS u ON u.usuario_id = p.usuario_id
                        LEFT JOIN servicios_medicos AS sm ON sm.servicio_id = c.servicio_id
                        WHERE c.cita_id = :cita_id ";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':cita_id', $cita_id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            //enviar correo de factura
            $correo->enviar_factura($result["email"], $result["nombre_servicio"], $monto, $usuarios);
            header("Location: ../controllers/pago_exitoso.php");
        } else {
            // Capturar y registrar el error si falla la actualización
            $_SESSION['mensaje_error'] = "Error al actualizar el estado de la cita: " . implode(" - ", $stmt->errorInfo());
            $db->rollBack();
            header("Location: ../controllers/pago_fallido.php");
        }
    } catch (Exception $e) {
        // Manejar excepciones y registrar el mensaje de error
        $db->rollBack();
        $_SESSION['mensaje_error'] = "Error al procesar el pago: " . $e->getMessage();
        header("Location: ../controllers/pago_fallido.php");
    }
} else {
    $_SESSION['mensaje_error'] = "Error al procesar el pago.";
    header("Location: ../controllers/pago_fallido.php");
}

exit();
