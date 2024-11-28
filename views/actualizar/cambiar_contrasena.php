<?php
include "../../includes/Database.php";
include "../../includes/usuarios.php";

session_start();

$database = new Database();
$db = $database->getConnection();

$usuarios = new Usuarios($db);

$_SESSION["rol"] = "Invitado";
$correo_actual = isset($_GET["e"]) ? $_GET["e"] : null;
$hash = isset($_GET["h"]) ? $_GET["h"] : null;


$result = $usuarios->consultar_usuario_por_email($correo_actual);
require("../../template/header.php"); ?>
<style>
    .container_pass {
        padding-top: 5.7%;
        margin-bottom: 7%;
        margin-left: 35%;
        margin-right: 35%;
    }

    .invalid_container {
        padding-top: 40%;
        margin-bottom: 46%;
    }

    #error-message {
        position: absolute;
        color: red;
        margin-top: 2%;
        /* Ajusta según la posición deseada */
        visibility: hidden;
        /* Oculta el mensaje inicialmente */
        opacity: 0;
        /* Transición suave */
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }
</style>
<section class="container_pass position-relative">
    <?php if ($result["restablecer"] == $hash): ?>
        <h2 class="mt-5">Cambiar Contraseña</h2>
        <form id="passwordForm" action="../../controllers/procesar_cambio_contrasena.php" method="post">
            <input type="hidden" required id="email" name="email" value="<?php echo $_GET["e"]; ?>">

            <div class="mt-3">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>

            <div class="mt-3 position-relative">
                <label for="confirmPassword" class="form-label">Confirmar contraseña:</label>
                <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" required>
                <div id="error-message">Las contraseñas no coinciden.</div>
            </div>

            <button type="submit" class="btn btn-primary mt-5">Cambiar</button>
        </form>
    <?php else: ?>
        <div class="invalid_container">
            <p><b>No tienes permiso para cambiar esta contraseña.</b></p>
            <p><b>Por favor, asegúrate de usar el enlace correcto enviado a tu correo electrónico.</b></p>
        </div>
    <?php endif; ?>
</section>

<script>
    document.getElementById("passwordForm").addEventListener("submit", function(event) {
        const password = document.getElementById("password").value;
        const confirmPassword = document.getElementById("confirmPassword").value;
        const errorMessage = document.getElementById("error-message");

        // Verificar si las contraseñas coinciden
        if (password !== confirmPassword) {
            event.preventDefault(); // Evita que el formulario se envíe
            errorMessage.style.visibility = "visible";
            errorMessage.style.opacity = "1"; // Hace el mensaje visible
        } else {
            errorMessage.style.visibility = "hidden";
            errorMessage.style.opacity = "0"; // Oculta el mensaje si coincide
        }
    });
</script>

<?php require("../../template/footer.php"); ?>