<?php require("../../template/header.php") ?>

<style> 
    /* Estilos generales para el cuerpo */
body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
    color: #343a40;
    display: flex;
    flex-direction: column;
    min-height: 100vh; /* Asegura que el cuerpo ocupe toda la altura de la ventana */
}

/* Estilos para el contenedor del formulario */
.container2 {
    position: relative;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 500px;
    max-width: 500px; /* Limitar el ancho del formulario */
    margin: auto;
    margin-top: 250px; /* Centrar el contenedor horizontalmente */
}

/* Estilos para los títulos de las secciones */
h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #007bff;
}

/* Estilos para los grupos de formularios */
.form-group {
    width: 250px;
    margin-bottom: 25px;
}

/* Estilos para las etiquetas */
label {
    font-weight: bold;
    margin-bottom: 5px;
    display: block;
}

/* Estilos para los campos de entrada */
input[type="date"],
.form-select {
    border: 1px solid #ced4da;
    border-radius: 5px;
    padding: 10px;
    width: 100%;
    transition: border-color 0.3s ease;
}

/* Efecto al enfocar los campos de entrada */
input[type="date"]:focus,
.form-select:focus {
    border-color: #007bff;
    outline: none;
}

button.btn-primary {
        background-color: #0B3E57; /* Color azul más oscuro al pasar el mouse */
        border-color: #0B3E57;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
         /* Color del borde */
    }

    button.btn-primary:hover {
        background-color: #2E708A; /* Color azul */
        border-color: #2E708A;
        transform: translateY(-2px); /* Mueve ligeramente hacia arriba */
        box-shadow: 0 4px 10px rgba(0, 123, 255, 0.4); 
        /* Color del borde más oscuro */
    }
    button.btn-primary:active {
    background-color: #0B3E57!important; /* Color de fondo al hacer clic */
    border-color: #0B3E57!important; /* Color del borde al hacer clic */
    }

/* Estilos para el texto centrado */
.text-center {
    text-align: center;
}

</style>

<section class="container2">
    <div class="d-flex flex-column justify-content-center align-items-center" style="height: calc(100vh - 560px);">
        <form action="../../controllers/procesar_solicitar_cita.php" method="post">
            <div class="form-group">
                <label for="servicio">Servicio</label>
                <select required name="servicio" id="servicio" class="form-select">
                    <option value="" selected disabled>Seleccione un servicio</option>
                    <?php
                    require_once "../../includes/Database.php";
                    // Crear una instancia de la clase Database y obtener la conexión
                    $database = new Database();
                    $db = $database->getConnection();

                    $stmt = $db->query("SELECT * FROM servicios_medicos");

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $row['servicio_id'] . "'>" . htmlspecialchars($row['nombre_servicio']) . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="fecha" class="form-control">
            </div>

            <div class="form-group">
                <label for="turno">Turno:</label>
                <select required name="turno" id="turno" class="form-select">
                    <option selected disabled>Seleccione un turno</option>
                    <option value="1">8am - 12pm</option>
                    <option value="2">1pm - 5pm</option>
                </select>
            </div>

            <div class="text-center mt-5">
                <button type="submit" class="btn btn-primary">Solicitar Consulta Médica</button>
            </div>
        </form>
    </div>
</section>
<?php require("../../template/footer.php") ?>
