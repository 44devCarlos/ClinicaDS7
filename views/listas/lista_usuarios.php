<?php
include "../../includes/Database.php";
include "../../includes/Usuarios.php";

$database = new Database();
$db = $database->getConnection();

$usuarios = new Usuarios($db);

$result = $usuarios->consultar_usuarios();

if ($result === false) {
    $error = "Error en la consulta.";
    $result = [];
}
?>

<?php require("../../template/header.php"); ?>

<style>
    body{
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }
    .container17 {
        flex: 1;
        width: 1200px; /* Ancho completo */
        margin: 0 auto; /* Centrando el contenedor */
        margin-right: 350px;
        margin-left: auto;
        margin-bottom: -21px;
        padding: 25px; /* Espaciado interno */
        background-color: #ffffff; /* Fondo blanco */
        border-radius: 10px; /* Bordes redondeados */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra suave */
    }

    h2.text-center{
        margin-top: 100px;
    }
    .table {
    width: 100%; /* Ancho completo */
    margin: 20px 0; /* Espaciado superior e inferior */
    border-collapse: collapse; /* Colapsar bordes */
    margin-top: 30px;
    margin-bottom: 200px!important;
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

    .btn-custom {
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
        /* Color del borde más oscuro */
    }
    .btn-custom:active {
    background-color: #0B3E57!important; /* Color de fondo al hacer clic */
    border-color: #0B3E57!important; /* Color del borde al hacer clic */
    }

    .btn-danger:hover{
        transform: translateY(-2px); /* Mueve ligeramente hacia arriba */
        box-shadow: 0 4px 10px rgba(0, 123, 255, 0.4); 
        /* Color del borde más oscuro */ 
    }
    .btn-danger:active {
    background-color: red!important; /* Color de fondo al hacer clic */
    border-color: red!important; /* Color del borde al hacer clic */
    }
</style>

<section class="container17">
    <div>
        <h2 class="text-center mb-4" >Lista de Usuarios</h2>
    </div>

    <?php if (isset($result) && !empty($result)) : ?>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $row) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row["usuario_id"]); ?></td>
                            <td><?php echo htmlspecialchars($row["nombre"]); ?></td>
                            <td><?php echo htmlspecialchars($row["email"]); ?></td>
                            <td><?php echo htmlspecialchars($row["rol"]); ?></td>
                            <td>
                                <a href="../actualizar/actualizar_usuario.php?usuario_id=<?php echo $row["usuario_id"]; ?>" class="btn btn-custom">Actualizar</a>
                                <a href="../eliminar/eliminar_usuario.php?usuario_id=<?php echo $row["usuario_id"]; ?>" class="btn btn-danger">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <div class="text-center">
            <p>No hay usuarios registrados.</p>
        </div>
    <?php endif; ?>
</section>

<?php require("../../template/footer.php"); ?>