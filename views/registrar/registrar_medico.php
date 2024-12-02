<?php require("../../template/header.php"); ?>

<style>
    body{
        display: flex;
        flex-direction: column;
        font-family: 'Arial', sans-serif;
        background-color: #f8f9fa; /* Color de fondo suave */
        color: #343a40; /* Color de texto */
        overflow-x: hidden; /* Evitar el scroll horizontal */
    }
    .container15 {
        flex: 1;
        width: 1000px; /* Ancho completo */
        margin: 0 auto; /* Centrando el contenedor */
        margin-right: auto;
        margin-left: 467px;
        background-color: #ffffff; /* Fondo blanco */
        border-radius: 10px; /* Bordes redondeados */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra suave */
    }

    footer{
    margin-top: auto;
    flex-shrink: 0;
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
</style>

<section class="container15">
    <div class="row d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-md-6 col-lg-4">
            <h1 class="text-center mb-5">Registrar Médico</h1>
            <form action="../../controllers/procesar_registro_medico.php" method="post">

                <!-- Seleccionar médico desde los usuarios registrados con rol de "medico" -->
                <div class="mb-3">
                    <label for="usuario_id" class="form-label">Médico Registrado</label>
                    <select name="usuario_id" required id="usuario_id" class="form-select">
                        <option value="" selected disabled>Seleccione un médico</option>
                        <?php
                        // Obtenemos la lista de médicos desde la tabla usuarios
                        include "../../includes/Database.php";
                        include "../../includes/Usuarios.php";

                        $database = new Database();
                        $db = $database->getConnection();

                        $usuarios = new Usuarios($db);
                        $medicos = $usuarios->consultar_medicos_por_rol();

                        if ($medicos !== false && !empty($medicos)) {
                            foreach ($medicos as $medico) {
                                echo '<option value="' . $medico["usuario_id"] . '">' . htmlspecialchars($medico["nombre"]) . ' (' . htmlspecialchars($medico["email"]) . ')</option>';
                            }
                        }
                        ?>
                    </select>
                </div>

                <!-- Campos adicionales para registrar al médico -->
                <div class="mb-3">
                    <label for="especialidad" class="form-label">Especialidad</label>
                    <select required name="especialidad" id="especialidad" class="form-select">
                        <option value="" selected disabled>Seleccione un Especialidad</option>
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

                <div class="mb-3">
                    <label for="no_licencia_medica" class="form-label">Número de Licencia Médica</label>
                    <input type="text" required id="no_licencia_medica" name="no_licencia_medica" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="anio_experiencia" class="form-label">Años de Experiencia</label>
                    <input type="number" required id="anio_experiencia" name="anio_experiencia" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="institucion" class="form-label">Institución</label>
                    <input type="text" required id="institucion" name="institucion" class="form-control">
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-custom">Registrar médico</button>
                </div>
                <div class="text-center mt-4">
                    <a href="../listas/lista_medicos.php" class="btn btn-custom">Verificar Médicos</a>
                </div>
            </form>
        </div>
    </div>
</section>

<?php require("../../template/footer.php"); ?>