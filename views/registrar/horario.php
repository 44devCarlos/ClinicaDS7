<?php require("../../template/header.php"); ?>

<style>
    /* Estilos generales para el contenedor */
header{
    flex: 1;
}
body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0px;
    overflow-x: hidden;
}
footer{
    margin-top: auto;
    flex-shrink: 0;
}
.container12 {
    flex: 1;
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
                    <button type="submit" class="btn btn-primary">Crear turno</button>
                </div>
            </form>
        </div>
    </div>
</section>
<?php require("../../template/footer.php") ?>