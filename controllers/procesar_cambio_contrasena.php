<?php
include "../includes/Database.php";
include "../includes/usuarios.php";

// Crear una instancia de la clase Database y obtener la conexión
$database = new Database();
$db = $database->getConnection();

$usuarios = new Usuarios($db);

$usuarios->contrasena = password_hash($_POST["confirmPassword"], PASSWORD_DEFAULT);
$usuarios->email = $_POST["email"];

if ($usuarios->actualizar_contrasena()) {
    $resultado = "Contraseña actualizada exitosamente";
} else {
    $resultado = "Fallo al actualizar la contraseña";
} ?>

<?php require("../template/header.php"); ?>

<section class="container">
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="text-center border p-5">
            <?php echo $resultado; ?>
            <p class="mt-3">Redirigiendo en 5 segundos al login</p>
        </div>
    </div>
</section>

<!-- Script para redirigir después de 5 segundos -->
<script>
    setTimeout(function() {
        window.location.href = "../index.php";
    }, 5000);
</script>

<?php require("../template/footer.php"); ?>