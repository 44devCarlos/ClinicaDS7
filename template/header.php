<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
} // Asegúrate de que la sesión esté iniciada
// Verifica si el usuario está autenticado
if (!isset($_SESSION['rol'])) {
    // Redirige al login si no está autenticado
    header("Location: ../../index.php");
    exit();
}
// Recupera el nombre del usuario de la sesión
$nombre = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : 'Invitado'; // Valor predeterminado si no está logueado
$rol = isset($_SESSION['rol']) ? $_SESSION['rol'] : 'Sin rol';
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"/>
<style>
    .logo {
        position: relative;
        height: 50px;
        left: 25px;
        transform: scale(1.3);
    }

    header.header {
        position: fixed;
        display: flex;
        background-color: white;
        width: 100%;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        z-index: 10000000;
        border-bottom: 0.3px solid rgba(0, 0, 0, 0.1); /* Línea gris tenue */
    }
    .role-text {
        font-family: 'Roboto', sans-serif; /* Aplica la fuente Roboto */
        font-size: 30px; /* Ajusta el tamaño de la fuente según sea necesario */
        align-self: center; /* Alinea verticalmente el texto con el logo */
        font-weight: bold;
        align-self: center;
        margin-right: 47px;
    }

    /* Posicionamiento del dropdown debajo de la flecha */
    .user-dropdown {
        position: relative;
        display: flex;
        align-items: center;
        cursor: pointer;
    }
    .user-dropdown i {
        margin-left: 5px;
    }
    /* Dropdown ajustado para estar en una posición fija */
    div.dropdown-menu {
    display: none;
    position: absolute;
    top: 100%; /* Coloca el dropdown justo debajo del contenedor */ 
    right: -5%;/* Alinea el dropdown a la izquierda del contenedor */
    background-color: white; /* Fondo blanco */
    border: white; /* Sin bordes */
    box-shadow: none; /* Sin sombra */
    width: auto; /* Puedes ajustar el ancho según sea necesario */
    animation: headerfadeIn 0.3s ease-in-out;
    z-index: 1000; /* Asegúrate de que el dropdown esté por encima de otros elementos */
    min-width: 100px; /* Puedes ajustar el ancho mínimo según sea necesario */
    }
    div.dropdown-menu.show {
        display: block;
    }
    /* Keyframes para animación de aparición */
    @keyframes headerfadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    div.dropdown-item {
        padding: 5px 10px;
        text-decoration: none;
        color: #333; /* Color del texto */
        transition: background-color 0.3s ease; /* Transición suave para el cambio de color */
    }
    .user-dropdown .dropdown-item:hover {
        background-color: #0B3E57!important; /* Color de fondo al hacer clic */
        border-color: #0B3E57!important; /* Color del borde al hacer clic */
        color: white;
        border-radius: 3px;
    }
    .user-dropdown .dropdown-item:active {
        background-color: #2E708A !important; /* Color azul */
        border-color: #2E708A !important;
        color: white;
    }
    .username {
    display: inline-block;
    width: 120px; /* Establece un ancho fijo para el contenedor del texto del usuario */
    text-overflow: ellipsis; /* Agrega puntos suspensivos si el texto es demasiado largo */
    overflow: hidden; /* Oculta el texto que sobra */
    white-space: nowrap; /* Evita que el texto se ajuste en varias líneas */
    }
</style>
<header class="header">
    <button id="logo-button" style="background: none; border: none; padding: 0; cursor: pointer;">
        <img src="/img/Clinica Vitalis login.png" alt="Logo de la Clínica" class="logo">
    </button>
    <span class="role-text"><?php echo htmlspecialchars($rol); ?></span>
    <!-- Dropdown del usuario -->
    <div class="dropdown user-dropdown">
        <span><?php echo htmlspecialchars($nombre); ?></span>
        <i class="fas fa-chevron-down"></i>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="../../controllers/cerrar_sesion.php">Cerrar sesión</a>
        </div>
    </div>
</header>
<!-- Scripts de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
<script>
    // Mostrar el dropdown cuando se haga clic en el usuario
    const userDropdown = document.querySelector('.user-dropdown');
    const dropdownMenu = document.querySelector('.dropdown-menu');

    userDropdown.addEventListener('click', function () {
        dropdownMenu.classList.toggle('show');
    });

    // Cerrar el dropdown si se hace clic fuera de él
    window.addEventListener('click', function (e) {
        if (!userDropdown.contains(e.target)) {
            dropdownMenu.classList.remove('show');
        }
    });
    // Redirigir según el rol al hacer clic en el logo
    document.getElementById('logo-button').addEventListener('click', function () {
        let ruta;

        // Determina la ruta según el rol
        switch ('<?php echo htmlspecialchars($rol); ?>') {
            case 'Administrador':
                ruta = '/views/inicio/admin_inicio.php'; // Ruta para el rol Admin
                break;
            case 'Paciente':
                ruta = '/views/inicio/inicio_paciente.php'; // Ruta para el rol Usuario
                break;
            case 'Médico':
                ruta = '/views/inicio/medico_inicio.php'; // Ruta para el rol Invitado
                break;
            case 'Recepcionista':
                ruta = '/views/inicio/inicio_recepcionista.php'; // Ruta para el rol Invitado
                break;
            case 'Recursos Humanos':
                ruta = '/views/inicio/inicio_recursos_humanos.php'; // Ruta para el rol Invitado
                break;
            default:
                ruta = '/index.php'; // Ruta por defecto
                break;
        }

        // Redirige a la ruta determinada
        window.location.href = ruta;
    });
</script>