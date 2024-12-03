<?php
include "../includes/Database.php";
include "../includes/Citas.php";
session_start();

$database = new Database();
$db = $database->getConnection();

$citas = new Citas($db);

// Verificamos si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Asegurarse de que todos los datos estén presentes
    if (!isset($_POST['paciente_id'], $_POST['diagnostico'], $_POST['medicamento'], $_POST['tratamiento'])) {
        $_SESSION['error_message'] = 'Faltan datos requeridos.';
        header("Location: ../views/registrar/atender_paciente.php");
        exit();
    }
    $cita_id = $_POST["cita_id"];
    $paciente_id = $_POST['paciente_id'];
    $diagnosticos = $_POST['diagnostico']; // Puede ser un array de diagnósticos
    $medicamento = $_POST['medicamento'];
    $tratamiento = $_POST['tratamiento'];

    // Si 'medicamento' es un array, lo convertimos en una cadena separada por comas
    if (is_array($medicamento)) {
        // Obtener los nombres de los medicamentos utilizando sus IDs
        $medicamentosNombres = [];
        foreach ($medicamento as $med_id) {
            $query_medicamento_nombre = "SELECT nombre FROM medicamentos WHERE medicamento_id = :medicamento_id LIMIT 1";
            $stmt_medicamento_nombre = $db->prepare($query_medicamento_nombre);
            $stmt_medicamento_nombre->bindParam(':medicamento_id', $med_id);
            $stmt_medicamento_nombre->execute();

            if ($row = $stmt_medicamento_nombre->fetch(PDO::FETCH_ASSOC)) {
                $medicamentosNombres[] = $row['nombre']; // Añadir el nombre del medicamento
            }
        }
        // Convertir el array de nombres en una cadena separada por comas
        $medicamento = implode(", ", $medicamentosNombres);
    } else {
        // Si solo hay un medicamento, obtener su nombre directamente
        $query_medicamento_nombre = "SELECT nombre FROM medicamento WHERE id_medicamento = :medicamento_id LIMIT 1";
        $stmt_medicamento_nombre = $db->prepare($query_medicamento_nombre);
        $stmt_medicamento_nombre->bindParam(':medicamento_id', $medicamento);
        $stmt_medicamento_nombre->execute();

        if ($row = $stmt_medicamento_nombre->fetch(PDO::FETCH_ASSOC)) {
            $medicamento = $row['nombre']; // Asignar el nombre del medicamento
        }
    }

    // Verificar si 'tratamiento' es un array y convertirlo en una cadena separada por comas
    if (is_array($tratamiento)) {
        $tratamiento = implode(", ", $tratamiento); // Convertir tratamiento a cadena separada por comas
    }

    // Primero, deberías asegurarte de que el paciente existe (opcional)
    $paciente_data = $citas->consultar_paciente_por_id($paciente_id);
    if (!$paciente_data) {
        $_SESSION['error_message'] = "El paciente no existe.";
        header("Location: ../views/registrar/atender_paciente.php");
        exit();
    }

    // Crear el historial clínico
    $query_historial = "INSERT INTO historial_clinico (paciente_id, fecha_creacion) VALUES (:paciente_id, NOW())";
    $stmt_historial = $db->prepare($query_historial);
    $stmt_historial->bindParam(':paciente_id', $paciente_id);

    if ($stmt_historial->execute()) {
        $historial_id = $db->lastInsertId(); // Obtener el ID del historial creado

        // Obtener los nombres de los diagnósticos usando los IDs seleccionados
        $diagnosticosString = '';
        foreach ($diagnosticos as $diagnostico_id) {
            // Obtener el nombre del padecimiento desde la base de datos
            $query_diagnostico_nombre = "SELECT padecimiento FROM padecimiento WHERE id_padecimiento = :diagnostico_id LIMIT 1";
            $stmt_diagnostico_nombre = $db->prepare($query_diagnostico_nombre);
            $stmt_diagnostico_nombre->bindParam(':diagnostico_id', $diagnostico_id);
            $stmt_diagnostico_nombre->execute();

            // Si se encuentra el padecimiento, lo agregamos al string
            if ($row = $stmt_diagnostico_nombre->fetch(PDO::FETCH_ASSOC)) {
                if (!empty($diagnosticosString)) {
                    $diagnosticosString .= ","; // Separa los diagnósticos por coma
                }
                $diagnosticosString .= $row['padecimiento']; // Añadir el nombre del padecimiento
            }
        }

        // Insertar los diagnósticos en la tabla diagnósticos
        $query_diagnostico = "INSERT INTO diagnosticos (historial_id, paciente_id, descripcion, fecha_diagnostico) 
                              VALUES (:historial_id, :paciente_id, :descripcion, NOW())";
        $stmt_diagnostico = $db->prepare($query_diagnostico);
        $stmt_diagnostico->bindParam(':historial_id', $historial_id);
        $stmt_diagnostico->bindParam(':paciente_id', $paciente_id);
        $stmt_diagnostico->bindParam(':descripcion', $diagnosticosString); // Usar la cadena de padecimientos

        if ($stmt_diagnostico->execute()) {
            // Insertar receta médica
            $query_recetas = "INSERT INTO recetas (paciente_id, medicamento, tratamiento, fecha_prescripcion) 
                              VALUES (:paciente_id, :medicamento, :tratamiento, NOW())";
            $stmt_recetas = $db->prepare($query_recetas);
            $stmt_recetas->bindParam(':paciente_id', $paciente_id);
            $stmt_recetas->bindParam(':medicamento', $medicamento);
            $stmt_recetas->bindParam(':tratamiento', $tratamiento);

            // Ejecutar la inserción de la receta médica
            if ($stmt_recetas->execute()) {
                // Guardar el mensaje de éxito en la sesión
                $_SESSION['success_message'] = 'Atención registrada exitosamente.';
            } else {
                $_SESSION['error_message'] = 'Error al guardar la receta médica.';
            }
        } else {
            $_SESSION['error_message'] = 'Error al guardar el diagnóstico.';
        }
    } else {
        $_SESSION['error_message'] = 'Error al guardar el historial clínico.';
    }
    $query = "UPDATE citas
                SET estado = 'Atendido'
                WHERE cita_id = :cita_id";
    $stmt = $db->prepare($query);

    $stmt->bindParam(':cita_id', $cita_id);
    $stmt->execute();
    $resultado = 'El paciente ha sido atendido con éxito';
} else {
    $_SESSION['error_message'] = 'No se han enviado datos.';
    header("Location: ../views/registrar/atender_paciente.php");
    exit();
}
?>

<?php require("../template/header.php"); ?>

<section class="container">
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="text-center border p-5">
            <?php echo htmlspecialchars($resultado); ?>
            <p class="mt-3">Redirigiendo en 5 segundos a inicio...</p>
        </div>
    </div>
</section>

<!-- Script para redirigir después de 5 segundos -->
<script>
    setTimeout(function() {
        window.location.href = "../views/consultar/consultar_citas_del_dia.php";
    }, 5000);
</script>

<?php require("../template/footer.php"); ?>