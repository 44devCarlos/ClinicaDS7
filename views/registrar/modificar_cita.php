<?php require("../../template/header.php");
$cita_id = htmlspecialchars($_GET["cita_id"]);
$nombre = htmlspecialchars($_GET["nombre"]);
?>

<style>
    body {
    background-color: #f8f9fa;
    font-family: 'Arial', sans-serif;
}

.container10 {
    margin-top: 0px;
    max-width: 1200px;
    margin-left: 340px;
}

h1 {
    color: #333;
    margin-bottom: 30px;
}

.form-control {
    border-radius: 0.25rem;
    border: 1px solid #ced4da;
    transition: border-color 0.2s;
}

.form-control:focus {
    border-color: #80bdff;
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
}

.form-label {
    font-weight: bold;
}

button.btn-primary {
    background-color: ##0B3E57!important;
    border-color: #007bff;
    transition: background-color 0.2s;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #004085;
}

.text-center {
    margin-top: 20px;
}

.row {
    justify-content: center;
}

.card {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 10px;
}

.card-header {
    font-size: 1.5rem;
    font-weight: bold;
    color: #333;
}
</style>

<section class="container10">
    <div class="row d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-md-6 col-lg-4">
            <h1 class="text-center">Modificar Cita</h1>
            <form action="../../controllers/procesar_modificar_cita.php" method="post">
                <input class="d-none" type="number" id="cita_id" name="cita_id" value="<?php echo $cita_id ?>">

                <div class="mb-3">
                    <label for="paciente" class="form-label">Paciente</label>
                    <input disabled type="text" required id="paciente" name="paciente" class="form-control" value="<?php echo $nombre ?>">
                </div>

                <div class="mb-3">
                    <label for="servicio" class="form-label">Servicio</label>
                    <select disabled name="servicio" id="servicio" class="form-select">
                        <option value="" selected disabled>Seleccione un servicio</option>
                        <?php
                        require_once "../../includes/Database.php";
                        // Crear una instancia de la clase Database y obtener la conexión
                        $database = new Database();
                        $db = $database->getConnection();
                        // Obtener el servicio_id de la cita
                        $query = $db->prepare("SELECT servicio_id FROM citas WHERE cita_id = :cita_id");
                        $query->bindParam(':cita_id', $cita_id, PDO::PARAM_INT);
                        $query->execute();
                        $servicio = $query->fetch(PDO::FETCH_ASSOC);

                        // Asegurarse de que servicio_id se obtuvo correctamente
                        $servicio_id = $servicio ? $servicio['servicio_id'] : null;
                        $stmt = $db->query("SELECT * FROM servicios_medicos");

                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $selected = ($row["servicio_id"] == $servicio_id) ? "selected" : "";
                            echo "<option value='" . $row['servicio_id'] . "' $selected>" . htmlspecialchars($row['nombre_servicio']) . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="medico" class="form-label">Médico</label>
                    <select required name="medico" id="medico" class="form-select">
                        <option value="" selected disabled>Seleccione un médico</option>
                        <?php
                        require_once "../../includes/Database.php";
                        require_once "../../includes/Medicos.php";
                        // Crear una instancia de la clase Database y obtener la conexión
                        $database = new Database();
                        $db = $database->getConnection();
                        $medicos = new Medicos($db);
                        // Obtener el medico dependiendo del servicio
                        $stmt = $medicos->consultar_medico_por_servicio_id($servicio_id);

                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='" . $row['usuario_id'] . "'>" . htmlspecialchars($row['nombre']) . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="date" required id="fecha" name="fecha" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="hora" class="form-label">Hora</label>
                    <input type="time" required id="hora" name="hora" class="form-control">
                </div>

                <div class="text-center mt-2">
                    <button type="submit" class="btn btn-primary">Modificar la cita</button>
                </div>
            </form>
        </div>
    </div>
</section>

<?php require("../../template/footer.php") ?>