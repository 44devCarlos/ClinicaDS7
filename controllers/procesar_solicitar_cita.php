<?php
include "../includes/Database.php";
include "../includes/Citas.php";
include "../includes/Pacientes.php";

session_start();

// Crear una instancia de la clase Database y obtener la conexión
$database = new Database();
$db = $database->getConnection();

$citas = new Citas($db);
$pacientes = new Pacientes($db);

$result = $pacientes->obtener_id_paciente($_SESSION["usuario_id"]);
$citas->paciente_id = $result["paciente_id"];
$citas->servicio_id = $_POST["servicio"];
$citas->fecha = $_POST["fecha"];
$citas->id_turno = $_POST["turno"];

// Registrar la solicitud de cita
if ($citas->solicitar_cita()) {
    $resultado = "Cita solicitada con éxito.";
} else {
    $resultado = "No hay citas para ese dia vuelva a solicitar la cita.";
}

?>

<?php require("../template/header.php"); ?>

<section class="container">
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="text-center border p-5">
            <?php echo htmlspecialchars($resultado); ?>
            <p class="mt-3">Redirigiendo en 10 segundos a inicio...</p>
        </div>
    </div>
</section>

<!-- Script para redirigir después de 5 segundos -->
<script>
    setTimeout(function() {
        window.location.href = "../views/inicio/inicio_paciente.php";
    }, 10000);
</script>

<?php require("../template/footer.php"); ?>