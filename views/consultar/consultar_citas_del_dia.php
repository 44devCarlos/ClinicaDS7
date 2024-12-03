<?php
include "../../includes/Database.php";
include "../../includes/Citas.php";
session_start();

$database = new Database();
$db = $database->getConnection();

$citas = new Citas($db);
$citas->medico_id = $_SESSION['usuario_id'];
$result = $citas->consultar_citas_del_dia();
$result1 = $citas->consultar_proximas_citas();


if ($result === false) {
    $error = "Error en la consulta.";
    $result = [];
}
?>

<?php require("../../template/header.php"); ?>

<style>
    /* Estilos generales */
body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
    margin: 0;
    padding: 0px;
    overflow-x: hidden;
}

.container13{
    flex: 1;
}
.container14{
    flex: 2;
}
/* Títulos */
h1.text-center {
    color: #343a40;
    margin-bottom: 20px;
    margin-top: 130px;
}

/* Tabla */
.table {
    width: 100px; /* Ancho completo */
    max-width: 1500px;
    border-collapse: collapse; /* Colapsar bordes */
    margin-top:20px;
    margin-left: auto;
    margin-right: auto;
}

.table th, .table td {
    background-color: #0B3E57; /* Color de fondo azul */
    color: white; /* Color de texto blanco */
    padding: 10px; /* Espaciado interno */
    text-align: center; /* Centrar texto */
}

.table th {
    background-color: #0B3E57!important;
    color: white!important;
}

.table tr:hover {
    background-color: #f1f1f1;
}

.table td {
    padding: 10px; /* Espaciado interno */
    border: 1px solid #dee2e6; /* Bordes de las celdas */
    text-align: center; /* Centrar texto */
}

.table-responsive1{
    margin-bottom: 250px;
}

/* Botón */
a.btn {
    background-color: #0B3E57!important; /* Color azul más oscuro al pasar el mouse */
    border-color: #0B3E57!important;
    color: #ffffff!important;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

a.btn:hover {
    background-color: #2E708A!important; /* Color azul */
    border-color: #2E708A!important;
    color: #ffffff!important;
    transform: translateY(-2px); /* Mueve ligeramente hacia arriba */
    box-shadow: 0 4px 10px rgba(0, 123, 255, 0.4); 
}

/* Mensajes de texto */
.text-center {
    margin: 20px 0;
    font-size: 18px;
    color: #6c757d;
}

/* Responsividad */
@media (max-width: 100px) {
    .container13, .container14 {
        padding: 15px;
    }

    .table th, .table td {
        padding: 10px;
    }

    .btn {
        padding: 8px 12px;
        font-size: 12px;
    }
}
</style>

    <section class="container13">
        <div class="row d-flex justify-content-center align-items-center min-vh-90">
            <?php if (isset($result) && !empty($result)) : ?>
                <div class="table-responsive">
                <h1 class="text-center">Citas del dia</h1>
                    <table class="table table-striped table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Cedula</th>
                                <th>Paciente</th>
                                <th>hora</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($result as $row) : ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row["Cedula"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["Paciente"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["hora"]); ?></td>
                                    <td>
                                        <a href="../registrar/atender_paciente.php?paciente_id=<?php echo htmlspecialchars($row["paciente_id"]); ?>&cita_id=<?php echo htmlspecialchars($row["cita_id"]);?>" class="btn btn-custom">Atender</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else : ?>
                <div class="text-center">
                    <p>No hay citas en el dia.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="container14">
        <div class="row d-flex justify-content-center align-items-center ">
            <?php if (isset($result1) && !empty($result1)) : ?>
                <div class="table-responsive1">
                <h1 class="text-center">Proximas Citas</h1>
                    <table class="table table-striped table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Cedula</th>
                                <th>Paciente</th>
                                <th>hora</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($result1 as $row) : ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row["Cedula"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["Paciente"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["hora"]); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else : ?>
                <div class="text-center">
                    <p>No hay proximas citas.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <?php require("../../template/footer.php"); ?>