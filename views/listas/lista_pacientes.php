<?php
include "../../includes/Database.php";
include "../../includes/Medicos.php";
session_start();

$database = new Database();
$db = $database->getConnection();

$medicos = new Medicos($db);
$medicos->medico_id = $_SESSION['usuario_id'];
$result = $medicos->consultar_pacientes();



if ($result === false) {
    $error = "Error en la consulta.";
    $result = [];
}
?>

<?php require("../../template/header.php"); ?>

<style>
    body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    background-color: #f0f4f8;
    font-family: 'Arial', sans-serif;
}

.container11 {
    flex: 1;
    margin-top: 0px; /* Espaciado superior */
    margin-bottom: 320px;
    width: 100%; /* Ancho completo */
    max-width: 1600px; /* Limitar el ancho máximo */
    margin-left: auto; /* Centrando el contenedor */
    margin-right: auto; /* Centrando el contenedor */
    padding: 109.5px;
    
}

h1 {
    color: #333;
    margin-bottom: 0px;
    font-size: 18px;
    animation: fadeIn 1s ease-in-out;
    margin-left: 40px;
}

.table-responsive {
    animation: slideIn 0.5s ease-in-out;
}

.table {
    border-collapse: collapse;
    width: 100%;
    margin: 20px 0;
    margin-top: 40px;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.table-light {
    background-color: #f8f9fa;
}

.table th, .table td {
    padding: 15px;
    border-bottom: 1px solid #dee2e6;
    background-color: #0B3E57; /* Color de fondo azul */
    color: white; /* Color de texto blanco */
    padding: 10px; /* Espaciado interno */
    text-align: center; /* Centrar texto */
}

.table th {
    background-color: #0B3E57!important; /* Color de fondo azul */
    color: white!important; /* Color de texto blanco */
    padding: 10px; /* Espaciado interno */
    text-align: center; /* Centrar texto */
}

.table tr:hover {
    background-color: #e9ecef;
    transition: background-color 0.3s;
}

.text-center {
    margin-top: 100px;
    margin-right: 50px;
    font-size: 18px;
}

.card {
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin: 20px 0;
    animation: fadeIn 1s ease-in-out;
}

.card-header {
    font-size: 1.5rem;
    font-weight: bold;
    color: #333;
    margin-bottom: 1px;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes slideIn {
    from {
        transform: translateY(-20px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}
</style>

    <section class="container11">
        <div class="row d-flex justify-content-center align-items-center min-vh-90">
            <?php if (isset($result) && !empty($result)) : ?>
                <div class="table-responsive">
                <h1 class="text-center">Lista de Pacientes</h1>
                    <table class="table table-striped table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Cedula</th>
                                <th>Paciente</th>
                                <th>Fecha de Nacimiento</th>
                                <th>Genero</th>
                                <th>Telefono</th>
                                <th>Direccion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($result as $row) : ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row["Cedula"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["Paciente"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["Fecha_Nacimiento"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["Genero"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["Telefono"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["Direccion"]); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else : ?>
                <div class="text-center">
                    <p>No hay pacientes</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    

    <?php require("../../template/footer.php"); ?>