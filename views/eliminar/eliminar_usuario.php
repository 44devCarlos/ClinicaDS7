<?php
include "../../controllers/consultar_usuario.php";
require("../../template/header.php"); ?>

<style>
    .container19 {
        flex: 1;
        width: 1000px; /* Ancho completo */
        margin: 0 auto; /* Centrando el contenedor */
        margin-right: auto;
        margin-left: 465px;
        padding: 25px; /* Espaciado interno */
        background-color: #ffffff; /* Fondo blanco */
        border-radius: 10px; /* Bordes redondeados */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra suave */
    }
    .btn-secondary {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        color: white!important;
         /* Color del borde */
    }

    .btn-secondary:hover {
        transform: translateY(-2px); /* Mueve ligeramente hacia arriba */
        box-shadow: 0 4px 10px rgba(0, 123, 255, 0.4); 
        /* Color del borde más oscuro */
    }
    .btn-seconday:active {
    background-color: #0B3E57!important; /* Color de fondo al hacer clic */
    border-color: #0B3E57!important; /* Color del borde al hacer clic */
    }

    .btn-danger:hover{
        transform: translateY(-2px); /* Mueve ligeramente hacia arriba */
        box-shadow: 0 4px 10px rgba(0, 123, 255, 0.4); 
        /* Color del borde más oscuro */ 
    }
    .btn-danger:active {
    background-color: red!important; /* Color de fondo al hacer clic */
    border-color: red!important; /* Color del borde al hacer clic */
    }
</style>

<section class="container19">
    <div class="row d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-md-6 col-lg-4 text-center">
            <h1 class="mb-5">Eliminar Usuario</h1>
            <p><strong>Nombre: </strong><?php echo htmlspecialchars($usuario["nombre"]) ?></p>
            <p><strong>Email: </strong><?php echo htmlspecialchars($usuario["email"]) ?></p>
            <p><strong>Rol: </strong><?php echo htmlspecialchars($usuario["rol"]) ?></p>
            <form action="../../controllers/procesar_eliminar_usuario.php" method="post">
                <input type="hidden" name="usuario_id" value="<?php echo htmlspecialchars($usuario["usuario_id"]) ?>">
                <div class="my-3">
                    <a href="/views/listas/lista_usuarios.php" class="btn btn-secondary">Regresar a lista de usuarios</a>
                </div>
                <div>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </div>
            </form>
        </div>
    </div>
</section>

<?php require("../../template/footer.php"); ?>