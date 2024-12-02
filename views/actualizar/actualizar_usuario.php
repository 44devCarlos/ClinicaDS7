<?php include "../../controllers/consultar_usuario.php"; ?>

<?php require("../../template/header.php"); ?>

<style>
    .container18 {
        flex: 1;
        width: 1000px; /* Ancho completo */
        margin: 0 auto; /* Centrando el contenedor */
        margin-right: auto;
        margin-left: 468px;
        padding: 25px; /* Espaciado interno */
        background-color: #ffffff; /* Fondo blanco */
        border-radius: 10px; /* Bordes redondeados */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra suave */
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

    .btn-secondary:hover{
        transform: translateY(-2px); /* Mueve ligeramente hacia arriba */
        box-shadow: 0 4px 10px rgba(0, 123, 255, 0.4); 
    }
    .btn-secondary:active {
    background-color: #0B3E57!important; /* Color de fondo al hacer clic */
    border-color: #0B3E57!important; /* Color del borde al hacer clic */
    }
</style>

<section class="container18">
    <div class="row d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-md-6 col-lg-4">
            <h1 class="text-center mb-5">Actualizar Usuario</h1>
            <form action="../../controllers/procesar_actualizar_usuario.php" method="post">
                <input type="hidden" required id="usuario_id" name="usuario_id" class="form-control" value="<?php echo htmlspecialchars($usuario["usuario_id"]) ?>">

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre Completo</label>
                    <input type="text" required id="nombre" name="nombre" class="form-control" value="<?php echo htmlspecialchars($usuario["nombre"]) ?>">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" required id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($usuario["email"]) ?>">
                </div>

                <div class="mb-3">
                    <label for="rol" class="form-label">Rol</label>
                    <select name="rol" required id="rol" class="form-select">
                        <option value="" selected disabled>Seleccione un rol</option>
                        <option value="admin">Administrador</option>
                        <option value="medico">Médico</option>
                        <option value="enfermeria">Enfermería</option>
                        <option value="apoyo">Apoyo</option>
                        <option value="farmaceuticos">Farmacéuticos</option>
                        <option value="mantenimiento">Limpieza y Mantenimiento</option>
                        <option value="emergencias">Emergencias</option>
                    </select>
                </div>

                <div class="text-center mt-4">
                    <a href="../listas/lista_usuarios.php" class="btn btn-secondary my-3 mx-4">Regresar</a>
                </div>

                <div class="text-center mt-2">
                    <button type="submit" class="btn btn-custom">Actualizar usuario</button>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    var rol = "<?php echo htmlspecialchars($usuario["rol"]) ?>";

    var select_rol = document.getElementById('rol');

    select_rol.value = rol;
</script>
<?php require("../../template/footer.php"); ?>