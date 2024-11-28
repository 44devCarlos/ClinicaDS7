<?php
include "../includes/Database.php";
include "../includes/Usuarios.php";
include "../includes/Correo.php";

// Crear una instancia de la clase Database y obtener la conexión
$database = new Database();
$db = $database->getConnection();

$usuarios = new Usuarios($db);
$correo = new Correo($db);

$usuarios->nombre = $_POST['nombre'];
$usuarios->email = $_POST['email'];
$contrasena = $usuarios->generar_contraseña(16);
$usuarios->contrasena = password_hash($contrasena, PASSWORD_DEFAULT);
$usuarios->rol = $_POST['rol'];

// Registrar el servicio médico
if ($usuarios->registrar_usuarios()) {
    $resultado = "Usuario registrado exitosamente.";
    $correo->cambiar_pass($usuarios->email, $usuarios, $contrasena);
} else {
    $resultado = "Error al registrar el Usuario.";
}

?>

<?php require("../template/header.php"); ?>

<section class="container">
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="text-center border p-5">
            <?php echo $resultado; ?>
            <p class="mt-3">Redirigiendo en 5 segundos a la lista de usuarios</p>
        </div>
    </div>
</section>

<!-- Script para redirigir después de 5 segundos -->
<script>
    setTimeout(function() {
        window.location.href = "../views/listas/lista_usuarios.php";
    }, 5000);
</script>

<?php require("../template/footer.php"); ?>