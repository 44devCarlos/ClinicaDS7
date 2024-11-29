<?php
require("../../template/header.php");
include("../../includes/Database.php");
include("../../includes/Medicos.php");

$database = new Database();
$db = $database->getConnection();

// Instancia de la clase Medicos
$medicos = new Medicos($db);
//$lista_medicos = $medicos->consultar_medicos_disponibles();
?>
<style>
    /* Estilos generales para el cuerpo */
    body {
        display: flex;
        flex-direction: column;
        font-family: 'Arial', sans-serif;
        background-color: #f8f9fa; /* Color de fondo suave */
        color: #343a40; /* Color de texto */
        min-height: 100vh;
        overflow-x: hidden; /* Evitar el scroll horizontal */
    }

    /* Contenedor principal */
    .container2 {
        width: 100%;
        max-width: 900px; /* Ancho más amplio */
        margin: 0 auto; /* Centrando el contenedor */
        padding: 20px; /* Espaciado interno */
        background-color: #ffffff; /* Fondo blanco */
        border-radius: 10px; /* Bordes redondeados */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra suave */
        flex: 1;
    }
    #citasContainer.container2{
        margin-bottom: 35px;
    }
    /* Título principal */
    h1.text-center {
        font-size: 28px; /* Tamaño del texto */
        color: #0B3E57; /* Azul oscuro */
        margin-bottom: 30px; /* Espaciado inferior */
    }

    /* Estilos para las tarjetas */
    .card {
        border: 1px solid #dee2e6; /* Borde suave */
        border-radius: 8px; /* Bordes redondeados */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Sombra ligera */
    }

    .card-body {
        padding: 20px; /* Espaciado interno */
    }

    /* Estilos para el label */
    .form-label {
        font-weight: bold; /* Negrita */
        color: #343a40; /* Color del texto */
    }

    /* Estilos para el select */
    .form-select {
        padding: 12px; /* Espaciado interno */
        border: 1px solid #dee2e6; /* Borde */
        border-radius: 5px; /* Bordes redondeados */
        transition: border-color 0.3s; /* Transición de borde */
        font-size: 16px; /* Tamaño de texto */
    }

    .form-select:focus {
        border-color: #0B3E57; /* Azul oscuro al enfocar */
        box-shadow: 0 0 5px rgba(11, 62, 87, 0.3); /* Sombra al enfocar */
    }

    /* Estilos para el contenedor de las citas */
    #citasContainer {
        margin-top: 30px; /* Espaciado superior */
        padding: 20px; /* Espaciado interno */
        background-color: #ffffff; /* Fondo blanco */
        border: 1px solid #dee2e6; /* Borde */
        border-radius: 8px; /* Bordes redondeados */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Sombra ligera */
    }

    /* Botón de regresar */
    .btn-secondary {
        background-color: #6c757d; /* Gris oscuro */
        border: none; /* Sin borde */
        color: white; /* Texto blanco */
        padding: 12px 15px; /* Espaciado interno */
        border-radius: 5px; /* Bordes redondeados */
        transition: background-color 0.3s; /* Transición suave */
        text-decoration: none; /* Sin subrayado */
    }

    .btn-secondary:hover {
        background-color: #5a6268; /* Gris más oscuro */
    }

    .btn-secondary:active {
        background-color: #545b62; /* Gris al hacer clic */
    }

    /* Espaciado adicional */
    .my-4 {
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .mt-5 {
        margin-top: 50px;
    }
</style>

<a href="../inicio/inicio_recepcionista.php" class="btn btn-secondary my-3 mx-4">Regresar</a>

<!-- Contenido principal -->
<section class="container2 mt-5">
    <h1 class="text-center">Gestión de Médicos</h1>
    <div class="row my-4 d-flex justify-content-center">
        <div class="col-md-6 mb-4">
            <div class="card text-center">
                <div class="card-body">
                    <label for="medico" class="form-label">Seleccione al médico:</label>
                    <select id="medico" class="form-select mt-3" onchange="cargarCitas(this.value)">
                        <?php
                        // Carga los médicos en el select
                        if ($lista_medicos) {
                            foreach ($lista_medicos as $medico) {
                                // Asegúrate de que 'nombre' existe en tu arreglo
                                echo "<option value='{$medico['medico_id']}'>{$medico['nombre']}</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="citasContainer" class="container2 mt-5">
    <!-- Aquí se cargarán las citas -->
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Llama a la función cargarCitas cuando la página esté lista
        var medicoId = $('#medico').val(); // Obtiene el valor del médico seleccionado
        if (medicoId) {
            cargarCitas(medicoId); // Carga las citas automáticamente
        }
    });

    function cargarCitas(medicoId) {
        $.ajax({
            url: '../../ajax/get_disponibilidad_medico.php', // Cambia esto al nombre correcto de tu archivo PHP
            type: 'GET',
            data: {
                medico_id: medicoId
            },
            success: function(data) {
                $('#citasContainer').html(data); // Cargar la respuesta en un contenedor
            },
            error: function(xhr, status, error) {
                console.error(error);
                $('#citasContainer').html('<p>Error al cargar las citas.</p>');
            }
        });
    }
</script>

<?php require("../../template/footer.php") ?>