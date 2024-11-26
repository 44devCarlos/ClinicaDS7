<?php require("../template/header.php"); ?>

<style>
    html, body {
        height: 100%; /* Asegura que el html y body ocupen toda la altura */
        margin: 0; /* Elimina márgenes predeterminados */
        overflow: hidden; /* Evita el scroll */
    }

    body {
        background-image: url('../img/img login ds7.jpg'); /* Ruta a tu imagen */
        background-size: cover; /* Para cubrir toda la pantalla */
        background-position: center; /* Centrar la imagen */
        background-repeat: no-repeat;
    }

    .container {
        height: 100vh; /* Establece la altura al 100% de la ventana */
        display: flex; /* Utiliza flexbox para centrar el contenido */
        justify-content: center; /* Centra horizontalmente */
        align-items: center; /* Centra verticalmente */

    }

    .login-card {
        background-color: rgba(255, 255, 255, 0.9); /* Fondo blanco con un poco de transparencia */
        border-radius: 10px; /* Bordes redondeados */
        padding: 50px; /* Espaciado interno */
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Sombra para dar profundidad */
        text-align: center; /* Centrar el texto */
    }

    h1 {
        color: #007bff; /* Color del encabezado */
    }

    .form-label {
        color: #495057; /* Color de las etiquetas */
    }

    .form-control {
        border-radius: 5px; /* Bordes redondeados para los campos de texto */
    }

    .form-control:focus {
        box-shadow: none; /* Sin sombra al enfocar */
        border-color: #007bff; /* Color del borde al enfocar */
    }

    .btn-primary {
        background-color: #007bff; /* Color azul */
        border-color: #007bff; /* Color del borde */
    }

    .btn-primary:hover {
        background-color: #0056b3; /* Color azul más oscuro al pasar el mouse */
        border-color: #0056b3; /* Color del borde más oscuro */
    }

    .logo {
        max-width: 60%; /* Asegúrate de que la imagen no exceda el ancho del contenedor */
        height: auto; /* Mantener la relación de aspecto */
        margin-top: -80px;
    }
    /* Animación de entrada para la tarjeta */
    @keyframes fadeIn {
        0% {
            opacity: 0;
            transform: scale(0.8);
        }
        100% {
            opacity: 1;
            transform: scale(1);
        }
    }

    /* Animación de entrada para el logo */
    @keyframes slideDown {
        0% {
            opacity: 0;
            transform: translateY(-50px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Aplica la animación al contenedor */
    .container {
        animation: fadeIn 1s ease-in-out;
    }

    /* Aplica la animación al logo */
    .logo {
        animation: slideDown 1s ease-in-out;
    }

    /* Efecto hover en el botón */
    .btn-primary {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 123, 255, 0.4);
    }

    /* Opcional: Suaviza el botón al presionarlo */
    .btn-primary:active {
        transform: scale(0.98); /* Hace un leve "clic" */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); /* Reduce la sombra */
    }
</style>

<section class="container">
    <div class="login-card">
        <img src="../img/LogoDs7connombre.png" alt="Logo de la Clínica" class="logo"> <!-- Logo aquí -->
        <h1 class="mb-4">Inicio de Sesión</h1>
        <form action="../controllers/procesar_login.php" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" required id="email" name="email" class="form-control" oninvalid="this.setCustomValidity('Por favor, ingresa un correo válido.')" 
                oninput="this.setCustomValidity('')">
            </div>

            <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña</label>
                <input type="password" required id="contrasena" name="contrasena" class="form-control" oninvalid="this.setCustomValidity('Por favor, ingresa una contraseña.')" 
                oninput="this.setCustomValidity('')">
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
            </div>
        </form>
    </div>
</section>

<?php require("../template/footer.php"); ?>