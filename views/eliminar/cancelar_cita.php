<?php
require("../../template/header.php"); ?>

<style>
/* Estilo general del body */
body {
    background-color: #f8f9fa; /* Fondo suave */
    font-family: Arial, sans-serif; /* Fuente clara */
}

/* Estilo del contenedor principal */
.container5 {
    margin-left: 350px;
    margin-right: auto;
    margin-top: 0px; /* Espaciado superior */
    margin-bottom: -130px;
    max-width: 1200px;
    max-height: 917px;
}

/* Estilo del encabezado */
h1 {
    color: #dc3545; /* Color rojo para el título */
    font-size: 2.5rem; /* Tamaño de fuente grande */
}

/* Estilo del formulario */
form {
    background-color: #ffffff; /* Fondo blanco para el formulario */
    padding: 20px; /* Espaciado interno */
    border-radius: 8px; /* Bordes redondeados */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra sutil */
    margin-bottom: 120px;
}

/* Estilo de los botones */
.btn {
    width: 100%; /* Botones ocupan todo el ancho */
    padding: 10px; /* Espaciado interno */
    font-size: 1.2rem; /* Tamaño de fuente para botones */
    border-radius: 5px; /* Bordes redondeados */
}

/* Estilo del botón de cancelar */
.btn-danger {
    background-color: #dc3545; /* Color rojo */
    border: none; /* Sin borde */
    color: white; /* Texto blanco */
}

/* Estilo del botón de regresar */
.btn-secondary {
    background-color: #6c757d; /* Color gris */
    border: none; /* Sin borde */
    color: white; /* Texto blanco */
}

/* Efecto hover para botones */
.btn:hover {
    opacity: 0.9; /* Efecto de desvanecimiento al pasar el ratón */
}

/* Estilo del párrafo */
p {
    font-size: 1.2rem; /* Tamaño de fuente para el texto */
    margin: 10px; /* Espaciado superior e inferior */
}
</style>

<section class="container5">
    <div class="row d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-md-6 col-lg-4 text-center">
            <h1 class="mb-5">Cancelar Cita</h1>
            <form action="../../controllers/procesar_cancelar_cita.php" method="post">
                <input type="hidden" name="cita_id" value="<?php echo htmlspecialchars($_GET["cita_id"]) ?>">
                <p>¿Estas seguro de cancelar la cita?</p>
                <div>
                    <button type="submit" class="btn btn-danger">Cancelar</button>
                </div>
                <div class="my-3">
                    <a href="../listas/lista_citas.php" class="btn btn-secondary">Regresar a lista de citas</a>
                </div>
            </form>
        </div>
    </div>
</section>

<?php require("../../template/footer.php"); ?>