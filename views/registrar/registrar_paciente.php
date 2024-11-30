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
        width: 1000px; /* Ancho completo */
        margin: 0 auto; /* Centrando el contenedor */
        margin-right: 468px;
        padding: 25px; /* Espaciado interno */
        background-color: #ffffff; /* Fondo blanco */
        border-radius: 10px; /* Bordes redondeados */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra suave */
    }
    .content {
            flex: 1; /* Permite que el contenido ocupe el espacio disponible */
        }
    /* Estilos para los títulos */
    .text-center h1 {
        font-size: 28px; /* Tamaño de fuente más grande */
        color: #0B3E57; /* Color azul */
        margin-bottom: 30px; /* Espaciado inferior */
    }

    /* Estilos para los formularios */
    .form-label {
        font-weight: bold; /* Texto en negrita */
        color: #343a40; /* Color del texto */
    }

    .form-control, .form-select {
        padding: 12px; /* Espaciado interno */
        border: 1px solid #dee2e6; /* Bordes */
        border-radius: 5px; /* Bordes redondeados */
        transition: border-color 0.3s; /* Transición de borde */
    }

    .form-control:focus, .form-select:focus {
        border-color: #0B3E57; /* Color del borde al enfocar */
        box-shadow: 0 0 5px rgba(11, 62, 87, 0.3); /* Sombra al enfocar */
    }

    /* Estilos para los botones */
    .btn-primary, .btn-secondary {
        width: 100%; /* Botones del mismo ancho */
        padding: 12px; /* Espaciado interno */
        font-size: 16px; /* Tamaño de fuente */
        border-radius: 5px; /* Bordes redondeados */
        transition: background-color 0.3s, transform 0.2s; /* Transiciones suaves */
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
    /* Espaciado entre campos del formulario */
    .mb-3 {
        margin-bottom: 20px; /* Espaciado inferior */
    }
</style>
<div class="content">
<section class="container2">
    <div class="row d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-md-6 col-lg-4">
            <h1 class="text-center mb-5">Registrar Paciente</h1>
            <form action="../../controllers/procesar_pacientes.php" method="post">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre Completo</label>
                    <input type="text" required id="nombre" name="nombre" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="cedula" class="form-label">Cédula</label>
                    <input type="text" required id="cedula" name="cedula" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" required id="fecha_nacimiento" name="fecha_nacimiento" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="genero" class="form-label">Género</label>
                    <select name="genero" required id="genero" class="form-select">
                        <option value="" selected disabled>Seleccione un genero</option>
                        <option value="masculino">Masculino</option>
                        <option value="femenino">Femenino</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="telefono" class="form-label">Telefono</label>
                    <input type="text" required id="telefono" name="telefono" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" required id="email" name="email" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="direccion" class="form-label">Direccion</label>
                    <input type="direccion" required id="direccion" name="direccion" class="form-control">
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary">Registrar Paciente</button>
                </div>
            </form>
        </div>
    </div>
</section>
</div>
<?php require("../../template/footer.php"); ?>