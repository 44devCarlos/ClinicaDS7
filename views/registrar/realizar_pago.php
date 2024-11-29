<?php
require("../../template/header.php");
include("../../includes/Database.php");
include("../../includes/Facturas.php");
include("../../includes/Citas.php");

session_start();
$database = new Database();
$db = $database->getConnection();

// Instancia de las clases Facturas y Citas
$facturas = new Facturas($db);
$citas = new Citas($db);

// Asegúrate de tener el ID de usuario disponible
if (isset($_SESSION['usuario_id'])) {
    $usuario_id = $_SESSION['usuario_id']; // Obtener ID de la sesión
} else {
    // Manejo del error si no está definido
    echo '<p>No se ha encontrado el ID del usuario. Por favor, inicie sesión nuevamente.</p>';
    exit; // Detener la ejecución si no hay usuario_id
}

// Buscar el paciente por usuario_id
$paciente_id = $citas->obtener_paciente_id_por_usuario($usuario_id);

if (!$paciente_id) {
    echo '<p>No se ha encontrado el paciente asociado al usuario.</p>';
    exit; // Detener la ejecución si no se encuentra el paciente
}

// Consultar citas atendidas
$citas_atendidas = $citas->consultar_citas_atendidas_por_paciente($paciente_id);
?>

<style>
    body {
    font-family: 'Arial', sans-serif;
    background-color: #f8f9fa; /* Color de fondo suave */
    color: #343a40; /* Color de texto */
    overflow-x: hidden; /* Evitar el scroll horizontal */
}
.container8 {
    margin-top: -171px; /* Espaciado superior */
    width: 100%; /* Ancho completo */
    max-width: auto;
    max-width: 1200px; /* Limitar el ancho máximo */
    margin-left: auto; /* Centrando el contenedor */
    margin-right: 370px; /* Centrando el contenedor */
    padding: 270.5px;
}
.table {
    width: 100%; /* Ancho completo */
    margin: 20px 0; /* Espaciado superior e inferior */
    border-collapse: collapse; /* Colapsar bordes */
    margin-top: 20px;
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

.btn1{
    background-color: #2e708a; /* Color de fondo rojo */
    border: none; /* Sin borde */
    color: white; /* Color de texto blanco */
    padding: 8px 12px; /* Espaciado interno */
    border-radius: 5px; /* Bordes redondeados */
    transition: background-color 0.3s, transform 0.2s; /* Transición suave */
}
</style>

<section class="container8 mt-3">
    <h1 class="text-center">Citas Atendidas</h1>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Costo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($citas_atendidas) > 0): ?>
                    <?php foreach ($citas_atendidas as $cita): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($cita["fecha"]); ?></td>
                            <td><?php echo htmlspecialchars($cita["hora"]); ?></td>
                            <td><?php echo htmlspecialchars($cita["costo"]); ?></td>
                            <td>
                                <form action="../../controllers/procesar_pago.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="cita_id" value="<?php echo htmlspecialchars($cita["cita_id"]); ?>">
                                    <input type="hidden" name="paciente_id" value="<?php echo htmlspecialchars($paciente_id); ?>">
                                    <input type="hidden" name="amount" value="<?php echo htmlspecialchars($cita["costo"]); ?>">
                                    <button type="submit" class="btn1">Pagar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">No tiene citas atendidas.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>
<?php require("../../template/footer.php") ?>
