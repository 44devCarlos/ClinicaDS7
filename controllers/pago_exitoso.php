<?php
session_start();
require("../template/header.php");
?>

<style>
    body {
        display: flex;
        flex-direction: column;
        background-color: #f8f9fa;
        font-family: 'Arial', sans-serif;
        overflow-x: hidden;
    }
    
    .container9 {
        flex: 1;
        max-width: 800px;
        padding: 200px;
        height: 794px;
        margin-left: 555px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    h1 {
        color: #28a745;
    }

    .alert {
        border-radius: 5px;
        padding: 15px;
        font-size: 18px;
        color: #155724;
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        margin-top: 100px;
    }

    .btn1 {
        background-color: #0B3E57;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        font-size: 16px;
        transition: background-color 0.3s;
    }

    .btn1:hover {
        background-color: #0B3E57;
    }
</style>

<section class="container9 ">
    <h1 class="text-center">¡Pago Exitoso!</h1>
    <div class="alert alert-success text-center">
        <?php
        // Mostrar mensaje de éxito si está disponible en la sesión
        if (isset($_SESSION['mensaje'])) {
            echo htmlspecialchars($_SESSION['mensaje']);
            unset($_SESSION['mensaje']); // Limpiar el mensaje de sesión después de mostrarlo
        } else {
            echo "Su pago se ha procesado correctamente.";
        }
        ?>
    </div>
    <div class="text-center">
        <a href="../views/inicio/inicio_paciente.php" class="btn1">Regresar a Inicio</a>
    </div>
</section>

<?php require("../template/footer.php") ?>
