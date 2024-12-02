<?php require("../../template/header.php"); ?>

<style>
    /* Estilos generales para el contenedor */
.container12 {
    background-color: #f8f9fa; /* Color de fondo claro */
    border-radius: 10px; /* Bordes redondeados */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra sutil */
    padding: 0px; /* Espaciado interno */
    max-height: 794px;
    margin-left: 420px;
    margin-right: 420px;
    margin-top: 0px; /* Margen superior */
    margin-bottom: 0px;
}

/* Estilos para el título */
h1.text-center {
    color: #343a40; /* Color del texto */
    margin-top: -70px;
    
}

/* Estilos para los botones */
.btn {
    transition: background-color 0.3s; /* Transición suave para el color de fondo */
}

.btn-primary {
    background-color: #0b3e57!important; /* Color de fondo del botón */
    border-color: #0b3e57!important; /* Color del borde del botón */
}

.btn-primary:hover {
    background-color: #0056b3; /* Color de fondo al pasar el ratón */
    border-color: #0056b3; /* Color del borde al pasar el ratón */
}

/* Estilos para los campos del formulario */
.form-control, .form-select {
    border-radius: 5px; /* Bordes redondeados */
    border: 1px solid #ced4da; /* Color del borde */
    transition: border-color 0.3s; /* Transición suave para el borde */
}

.form-control:focus, .form-select:focus {
    border-color: #80bdff; /* Color del borde al enfocar */
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25); /* Sombra al enfocar */
}

/* Espaciado para los elementos del formulario */
.mb-3 {
    margin-bottom: 1rem; /* Espaciado inferior */
}

/* Centrando el contenido */
.text-center {
    text-align: center; /* Alineación centrada */
}
</style>

<section class="container12">
    <div class="row d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-md-6 col-lg-4">
            <h1 class="text-center">Mi Horario</h1>
            <form action="../../controllers/procesar_horario.php" method="post">
                <input class="d-none" type="number" id="cita_id" name="cita_id">

                <div class="mb-3">
                    <label for="dia" class="form-label">Día</label>
                    <input type="date" required id="dia" name="dia" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="turno" class="form-label">Turno</label>
                    <select name="turno" id="turno" class="form-select">
                        <option selected disabled>Seleccione un turno</option>
                        <option value="1">8am - 12pm</option>
                        <option value="2">1pm - 5pm</option>
                    </select>
                </div>

                <div class="text-center mt-2">
                    <button type="submit" class="btn btn-primary">Crear cita</button>
                </div>
            </form>
        </div>
    </div>
</section>

<?php require("../../template/footer.php") ?>