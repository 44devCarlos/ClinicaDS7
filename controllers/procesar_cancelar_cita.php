<?php
include "../includes/Database.php";
include "../includes/Citas.php";

$database = new Database();
$db = $database->getConnection();

$citas = new Citas($db);

$mensaje = $citas->actualizar_estado_cita($_POST["cita_id"], "Cancelado");
?>

<?php require("../template/header.php"); ?>

<style>
    body {
    background-color: #f8f9fa; /* Color de fondo suave */
    font-family: 'Arial', sans-serif; /* Fuente moderna */
    color: #343a40; /* Color de texto oscuro */
    overflow-x: hidden;
}

.container7 {
    max-width: 600px; /* Ancho máximo de la sección */
    margin: auto; /* Centrar la sección */
    padding: 189.5px; /* Espaciado interno */
    margin-left: 650px;
    background-color: #ffffff; /* Fondo blanco para el contenedor */
    border-radius: 10px; /* Bordes redondeados */
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Sombra sutil */
}

h2 {
    font-size: 14px; /* Tamaño de fuente para el título */
    margin-top: 15px;
}

p {
    font-size: 16px; /* Tamaño de fuente para el párrafo */
    line-height: 1.5; /* Espaciado entre líneas */
    margin-bottom: 5px; /* Espaciado inferior */
}

.btn1 {
    background-color: #0b3e57; /* Color de fondo del botón */
    color: white; /* Color del texto del botón */
    padding: 10px 20px; /* Espaciado interno del botón */
    border: none; /* Sin borde */
    border-radius: 5px; /* Bordes redondeados del botón */
    text-decoration: none; /* Sin subrayado */
    transition: background-color 0.3s; /* Transición suave para el color de fondo */
}

.btn:hover {
    background-color: #0056b3; /* Color de fondo del botón al pasar el ratón */
}

.text-center {
    text-align: center; /* Centrar el texto */
    margin-top: 166px;
    margin-bottom: 100px;
}
</style>

<section class="container7 ">
    <div class="text-center">
        <h2 class="">
            <?php echo $mensaje ? "Cancelado Exitosamente" : "Error al Cancelar"; ?>
        </h2>
        <p class="">
            <?php echo $mensaje ? "La cita ha sido cancelada." : "Hubo un error al cancelar la cita. Por favor, intente de nuevo."; ?>
        </p>

        <div>
            <a href="../views/listas/lista_citas.php" class="btn1">Volver a lista de citas</a>
        </div>
    </div>
</section>

<?php require("../template/footer.php"); ?>