<?php
require "../../template/header.php";
require "../../includes/Database.php";
require "../../includes/Pacientes.php";
session_start();
$database = new Database();
$db = $database->getConnection();

$pacientes = new Pacientes($db);
$pacientes->paciente_id = $_SESSION["usuario_id"];
$result = $pacientes->consultar_citas();

if ($result === false) {
    $error = "Error en la consulta.";
    $result = [];
}
?>

<style>
    /* Estilos generales para el cuerpo */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f8f9fa; /* Color de fondo suave */
    color: #343a40; /* Color de texto */
    overflow-x: hidden; /* Evitar el scroll horizontal */
}

/* Estilos para el contenedor de la sección */
.container3 {
    margin-top: -171px; /* Espaciado superior */
    width: 100%; /* Ancho completo */
    max-width: auto;
    max-width: 1200px; /* Limitar el ancho máximo */
    margin-left: auto; /* Centrando el contenedor */
    margin-right: 370px; /* Centrando el contenedor */
}

/* Estilos para la tabla */
.table {
    width: 100%; /* Ancho completo */
    margin: 20px 0; /* Espaciado superior e inferior */
    border-collapse: collapse; /* Colapsar bordes */
    margin-top: 30px;
}

/* Estilos para las cabeceras de la tabla */
.table thead th {
    background-color: #0B3E57; /* Color de fondo azul */
    color: white; /* Color de texto blanco */
    padding: 10px; /* Espaciado interno */
    text-align: center; /* Centrar texto */
}

/* Estilos para las filas de la tabla */
.table tbody tr {
    transition: background-color 0.3s; /* Transición suave */
}

.table tbody tr:hover {
    background-color: #e9ecef; /* Color de fondo al pasar el ratón */
}

/* Estilos para las celdas de la tabla */
.table td {
    padding: 10px; /* Espaciado interno */
    border: 1px solid #dee2e6; /* Bordes de las celdas */
    text-align: center; /* Centrar texto */
}

/* Estilos para el mensaje de "No tienes citas" */
.text-center p {
    font-size: 18px; /* Tamaño de fuente */
    color: #6c757d; /* Color de texto gris */
}

.text-center h1{
    font-size: 18px; /* Tamaño de fuente */
    color: #6c757d; /* Color de texto gris */
}

/* Estilos para el botón de cancelar */
.btn-danger {
    background-color: #dc3545; /* Color de fondo rojo */
    border: none; /* Sin borde */
    color: white; /* Color de texto blanco */
    padding: 8px 12px; /* Espaciado interno */
    border-radius: 5px; /* Bordes redondeados */
    transition: background-color 0.3s, transform 0.2s; /* Transición suave */
}

.btn-danger:hover {
    background-color: #c82333; /* Color de fondo más oscuro al pasar el ratón */
    transform: translateY(-2px); /* Efecto de elevación */
}

.btn-danger:active {
    background-color: #bd2130; /* Color de fondo al hacer clic */
}
</style>

<section class="container3">
    <div class="row d-flex justify-content-center align-items-center min-vh-100">
        <?php if (isset($result) && !empty($result)) : ?>
            <div class="table-responsive">
                <h1 class="text-center">Citas</h1>
                <table class="table table-striped table-bordered table-hover text-center">
                    <thead class="table-light">
                        <tr>
                            <th>Especialidad</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Médico</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($result as $row) : ?>
                            <?php if (empty($row["Fecha"]) && empty($row["hora"]) && empty($row["Medico"])) : ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row["Especialidad"]); ?></td>
                                    <td colspan="4" class="text-center">La cita aún no ha sido agendada</td>
                                </tr>
                            <?php else : ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row["Especialidad"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["Fecha"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["Hora"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["Medico"]); ?></td>
                                    <td>
                                        <a href="../eliminar/cancelar_cita.php?cita_id=<?php echo $row["cita_id"]; ?>" class="btn btn-danger">Cancelar</a>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else : ?>
            <div class="text-center">
                <p>No tienes citas.</p>
            </div>
        <?php endif; ?>
    </div>
</section>


<?php require "../../template/footer.php"; ?>