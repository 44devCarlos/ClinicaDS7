<?php
include "../includes/Database.php";
include "../includes/Usuarios.php";

$database = new Database();
$db = $database->getConnection();

$usuarios = new Usuarios($db);
$usuarios->usuario_id = $_POST["usuario_id"];
$usuarios->nombre = $_POST["nombre"];
$usuarios->email = $_POST["email"];
$usuarios->rol = $_POST["rol"];

$actualizado = $usuarios->actualizar_usuarios();
?>

<?php require("../template/header.php"); ?>

<style>
     .container21 {
        flex: 1;
        width: 1000px; /* Ancho completo */
        margin: 0 auto; /* Centrando el contenedor */
        margin-right: auto;
        margin-left: 470px;
        padding: 25px; /* Espaciado interno */
        background-color: #ffffff; /* Fondo blanco */
        border-radius: 10px; /* Bordes redondeados */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra suave */
    }

    .mb-4{
        margin-top: 250px;
    }
    
    .btn-custom{
        margin-bottom: 353.5px;
        background-color: #0B3E57!important; /* Color azul más oscuro al pasar el mouse */
        border-color: #0B3E57!important;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        color: white!important;
         /* Color del borde */
    }

    .btn-custom:hover {
        background-color: #2E708A!important; /* Color azul */
        border-color: #2E708A!important;
        transform: translateY(-2px); /* Mueve ligeramente hacia arriba */
        box-shadow: 0 4px 10px rgba(0, 123, 255, 0.4); 
    }
    .btn-custom:active {
    background-color: #0B3E57!important; /* Color de fondo al hacer clic */
    border-color: #0B3E57!important; /* Color del borde al hacer clic */
    }
</style>

<section class="container21">
    <div class="text-center">
        <h2 class="mb-4">
            <?php echo $actualizado ? "Actualización Exitosa" : "Error de Actualización"; ?>
        </h2>
        <p class="">
            <?php echo $actualizado ? "El usuario ha sido actualizado exitosamente." : "Hubo un error al actualizar el usuario. Por favor, intente de nuevo."; ?>
        </p>

        <div>
            <a href="../views/lista_usuarios.php" class="btn btn-custom">Volver a lista de usuarios</a>
        </div>
    </div>
</section>

<?php require("../template/footer.php"); ?>