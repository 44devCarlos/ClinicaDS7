<?php
include "../../includes/Database.php";
include "../../includes/Padecimientos.php";
include "../../includes/Medicamentos.php";

$database = new Database();
$db = $database->getConnection();

$padecimientos = new Padecimientos($db);
$padecimientos_list = $padecimientos->obtener_padecimientos();

$medicamentos = new Medicamentos($db);
$medicamentos_list = $medicamentos->obtener_medicamentos();
?>

<?php require('../../template/header.php'); ?>

<style>
    .container24 {
        flex: 1;
        width: 1000px; /* Ancho completo */
        margin: 0 auto; /* Centrando el contenedor */
        margin-right: auto;
        margin-left: 465px;
        padding: 25px; /* Espaciado interno */
        padding-top: 100px;
        background-color: #ffffff; /* Fondo blanco */
        border-radius: 10px; /* Bordes redondeados */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra suave */
    }
    .form-group{
        margin-top: 15px;
        font-size: 18px;
    }
    .form-control{
        margin-top: 0px;
    }
    .form-control1{
        margin-top: 0px;
    }
    .btn-custom {
        background-color: #0B3E57!important; /* Color azul más oscuro al pasar el mouse */
        border-color: #0B3E57!important;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        color: white!important;
        margin-top: 10px;
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
    .table {
    width: 100%; /* Ancho completo */
    margin: 20px 0; /* Espaciado superior e inferior */
    border-collapse: collapse; /* Colapsar bordes */
    margin-top: 30px;
    margin-bottom: 50px!important;
}

    .table thead th {
    background-color: #0B3E57; /* Color de fondo azul */
    color: white; /* Color de texto blanco */
    padding: 10px; /* Espaciado interno */
    text-align: center; /* Centrar texto */
}

    .table tbody tr {
    transition: background-color 0.3s; /* Transición suave */
}

    .table tbody tr:hover {
    background-color: #e9ecef; /* Color de fondo al pasar el ratón */
}
    .table td {
    padding: 10px; /* Espaciado interno */
    border: 1px solid #dee2e6; /* Bordes de las celdas */
    text-align: center; /* Centrar texto */
}
</style>

<body>
    <div class="container24">
        <h2>Insertar Medicamento</h2>
        <form action="../../controllers/procesar_medicamentos.php" method="POST">
            <div class="form-group">
                <label for="nombre">Nombre del Medicamento:</label>
                <input type="text" id="nombre" name="nombre" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="cantidad">Cantidad:</label>
                <input type="number" id="cantidad" name="cantidad" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="unidad">Unidad:</label>
                <input type="text" id="unidad" name="unidad" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="tipo">Tipo:</label>
                <input type="text" id="tipo" name="tipo" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="tratamiento">Tratamiento:</label>
                <input type="text" id="tratamiento" name="tratamiento" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="id_padecimiento">Padecimiento:</label>
                <select id="id_padecimiento" name="id_padecimiento" class="form-select" required>
                    <option value="" selected disabled>Seleccione un padecimiento</option>
                    <?php foreach ($padecimientos_list as $padecimiento): ?>
                        <option value="<?php echo $padecimiento['id_padecimiento']; ?>"><?php echo htmlspecialchars($padecimiento['padecimiento']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-custom">Insertar</button>
        </form>

        <h2 class="mt-5">Lista de Medicamentos</h2>
        <?php if (empty($medicamentos_list)): ?>
            <div class="alert alert-warning">No hay medicamentos registrados.</div>
        <?php else: ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Unidad</th>
                        <th>Tipo</th>
                        <th>Tratamiento</th>
                        <th>ID Padecimiento</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($medicamentos_list as $medicamento): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($medicamento['medicamento_id']); ?></td>
                            <td><?php echo htmlspecialchars($medicamento['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($medicamento['cantidad']); ?></td>
                            <td><?php echo htmlspecialchars($medicamento['unidad']); ?></td>
                            <td><?php echo htmlspecialchars($medicamento['tipo']); ?></td>
                            <td><?php echo htmlspecialchars($medicamento['tratamiento']); ?></td>
                            <td><?php echo htmlspecialchars($medicamento['id_padecimiento']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
<?php require('../../template/footer.php'); ?>