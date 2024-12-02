<?php
require("../../template/header.php");
include("../../includes/Database.php");
include("../../includes/Servicios_Medicos.php");

// Crear una instancia de la clase Database y obtener la conexión
$database = new Database();
$db = $database->getConnection();

$servicios_medicos = new Servicios_Medicos($db);

$result = $servicios_medicos->consultar_servicios();

?>

<style>
    .container21 {
        flex: 1;
        width: 1000px; /* Ancho completo */
        margin: 0 auto; /* Centrando el contenedor */
        margin-right: auto;
        margin-left: 468px;
        padding: 25px; /* Espaciado interno */
        background-color: #ffffff; /* Fondo blanco */
        border-radius: 10px; /* Bordes redondeados */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra suave */
    }
    .btn-custom {
        background-color: #0B3E57!important; /* Color azul más oscuro al pasar el mouse */
        border-color: #0B3E57!important;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        color: white!important;
        margin-top: 150px;
         /* Color del borde */
    }

    .btn-custom:hover {
        background-color: #2E708A!important; /* Color azul */
        border-color: #2E708A!important;
        transform: translateY(-2px); /* Mueve ligeramente hacia arriba */
        box-shadow: 0 4px 10px rgba(0, 123, 255, 0.4); 
        /* Color del borde más oscuro */
    }
    .btn-custom:active {
    background-color: #0B3E57!important; /* Color de fondo al hacer clic */
    border-color: #0B3E57!important; /* Color del borde al hacer clic */
    }

    .card{
        margin-bottom: 346px;
    }
</style>

<section class="container21">
    <div class="text-center">
        <h1 class="mb-4">Servicios Médicos</h1>
        <a href="../registrar/agregar_servicios.php" class="btn btn-custom">Agregar +</a>
    </div>

    <?php if (isset($result) && !empty($result)) : ?>
        <div class="row my-4">
            <?php foreach ($result as $row) : ?>
                <div class="col-md-4 mb-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($row['nombre_servicio']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($row['descripcion']); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <p class="my-4 text-center">No hay servicios registrados.</p>
    <?php endif; ?>
</section>

<?php require("../../template/footer.php") ?>