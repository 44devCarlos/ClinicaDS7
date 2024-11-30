<?php
include "../../includes/Database.php";
include "../../includes/Citas.php";

$database = new Database();
$db = $database->getConnection();

$citas = new Citas($db);

$result = $citas->consultar_citas();

if ($result === false) {
    $error = "Error en la consulta.";
    $result = [];
}
?>

<?php require("../../template/header.php"); ?>
<style>
    /* Estilos generales para el cuerpo */
body {
    display: flex;
    flex-direction: column;
    font-family: 'Arial', sans-serif;
    background-color: #f8f9fa; /* Color de fondo suave */
    color: #343a40; /* Color de texto */
    overflow-x: hidden; /* Evitar el scroll horizontal */
}

/* Estilos para el contenedor de la sección */
.container2 {
    flex: 1;
    margin-top: 0; /* Espaciado superior */
    width: 100%; /* Ancho completo */
    height: min-content;
    margin-bottom: -123px;
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

a.btn-primary{
    background-color: #2E708A!important; /* Color azul más oscuro al pasar el mouse */
    border-color: #2E708A!important;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
     /* Color del borde */
    }

a.btn-primary:hover {
    background-color: #2E708A!important; /* Color azul */
    border-color: #2E708A!important;
    transform: translateY(-2px); /* Mueve ligeramente hacia arriba */
    box-shadow: 0 4px 10px rgba(0, 123, 255, 0.4); 
        /* Color del borde más oscuro */
    }
a.btn-primary:active {
    background-color: #0B3E57!important; /* Color de fondo al hacer clic */
    border-color: #0B3E57!important; /* Color del borde al hacer clic */
    }

button.btn-primary {
    background-color: #0B3E57!important; /* Color azul más oscuro al pasar el mouse */
    border-color: #0B3E57!important;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

button.btn-primary:hover {
    background-color: #2E708A!important; /* Color azul */
    border-color: #2E708A!important;
    transform: translateY(-2px); /* Mueve ligeramente hacia arriba */
    box-shadow: 0 4px 10px rgba(0, 123, 255, 0.4); 
    
    }
button.btn-primary:active {
background-color: #0B3E57!important; /* Color de fondo al hacer clic */
border-color: #0B3E57!important; /* Color del borde al hacer clic */
    }
</style>
<section class="container2 min-vh-100">
    <a href="../inicio/inicio_recepcionista.php" class="btn btn-secondary my-3 mx-4">Regresar</a>

    <!-- Formulario para buscar por cédula -->
    <form method="GET" class="my-4 d-flex justify-content-center">
        <input type="text" name="cedula" class="form-control mx-2" placeholder="Ingrese la cédula" required>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

    <div class="row d-flex justify-content-center align-items-center">
        <?php
        if (isset($_GET['cedula'])) {
            $cedula = htmlspecialchars($_GET['cedula']);

            $result = $citas->consultar_cita_por_paciente($cedula);

            if (!empty($result)) :
        ?>
                <div class="table-responsive">
                    <h1 class="text-center">Lista de Citas</h1>
                    <table class="table table-striped table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Servicio</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($result as $row) : ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row["Servicio"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["Fecha"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["Hora"]); ?></td>
                                    <td>
                                        <a href="../registrar/modificar_cita.php?nombre=<?php echo htmlspecialchars($row["Paciente"]); ?>&cita_id=<?php echo htmlspecialchars($row["cita_id"]); ?>" class="btn btn-primary">Modificar</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else : ?>
                <div class="text-center">
                    <p>No hay citas para la cédula ingresada.</p>
                </div>
        <?php endif;
        } else {
            echo '<div class="text-center"><p>Ingrese una cédula para buscar las citas.</p></div>';
        }
        ?>
    </div>
</section>


<?php require("../../template/footer.php"); ?>