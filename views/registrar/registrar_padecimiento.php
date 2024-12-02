<?php
include "../../includes/Database.php";
include "../../includes/Padecimientos.php";

$database = new Database();
$db = $database->getConnection();

$padecimientos = new Padecimientos($db);
$padecimientos_list = $padecimientos->obtener_padecimientos();
?>

<?php require('../../template/header.php'); ?>

<style>
    .container23 {
        flex: 1;
        width: 1000px; /* Ancho completo */
        margin: 0 auto; /* Centrando el contenedor */
        margin-right: auto;
        margin-left: 465px;
        padding: 25px; /* Espaciado interno */
        background-color: #ffffff; /* Fondo blanco */
        border-radius: 10px; /* Bordes redondeados */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra suave */
    }
    .form-group{
        margin-top: 50px;
        font-size: 22px;
    }
    .form-control{
        margin-top: 8px;
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
    <div class="container23">
        <h2>Insertar Padecimiento</h2>
        <form action="../../controllers/procesar_padecimiento.php" method="POST">
            <div class="form-group">
                <label for="padecimiento">Padecimiento:</label>
                <input type="text" id="padecimiento" name="padecimiento" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-custom">Insertar</button>
        </form>

        <h2 class="mt-5">Lista de Padecimientos</h2>
        <?php if (empty($padecimientos_list)): ?>
            <div class="alert alert-warning">No hay padecimientos registrados.</div>
        <?php else: ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Padecimiento</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($padecimientos_list as $padecimiento): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($padecimiento['id_padecimiento']); ?></td>
                            <td><?php echo htmlspecialchars($padecimiento['padecimiento']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
<?php require('../../template/footer.php'); ?>