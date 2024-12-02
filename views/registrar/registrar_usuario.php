<?php require("../../template/header.php"); ?>

<style>
    body{
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }
    .container16 {
        flex: 1;
        display: flex;
        width: 100%;
        overflow-x: hidden;
        background-color: #ffffff; /* Fondo blanco */
        border-radius: 10px; /* Bordes redondeados */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra suave */
        justify-content: center;
        align-items: center;
    }
    .row {
        width: 1000px; /* Ancho fijo */
        max-width: 100%; /* Asegurarse de que no se desborde */
        justify-content: center;
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

<section class="container16">
    <div class="row">
        <div class="col-md-6 col-lg-4">
            <h1 class="text-center mb-5">Registrar Usuario</h1>
            <form action="../../controllers/procesar_usuarios.php" method="post">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre Completo</label>
                    <input type="text" required id="nombre" name="nombre" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" required id="email" name="email" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="rol" class="form-label">Rol</label>
                    <select name="rol" required id="rol" class="form-select">
                        <option value="" selected disabled>Seleccione un rol</option>
                        <option value="Administrador">Administrador</option>
                        <option value="Médico">Médico</option>
                        <option value="Enfermería">Enfermería</option>
                        <option value="Apoyo">Apoyo</option>
                        <option value="Farmacéuticos">Farmacéuticos</option>
                        <option value="Limpieza y Mantenimiento">Limpieza y Mantenimiento</option>
                        <option value="Emergencias">Emergencias</option>
                        <option value="Recursos Humanos">Recursos Humanos</option>
                        <option value="Recepcionista">Recepcionista</option>
                    </select>
                </div>

                <div class="text-center mt-2">
                    <button type="submit" class="btn btn-custom">Registrar usuario</button>
                </div>
            </form>
        </div>
    </div>
</section>

<?php require("../../template/footer.php"); ?>