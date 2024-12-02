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
        transition: transform 0.3s ease; /* Transición para el logo */
    }

    #logo-button:hover img {
        transform: scale(1.1) rotate(5deg); /* Escala y rotación suave */
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
        animation: slideDown 0.5s ease-in-out; /* Animación al cargar */
    }

    @keyframes slideDown {
        from {
            transform: translateY(-100%);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .role-text {
        font-family: 'Roboto', sans-serif;
        font-size: 30px;
        align-self: center;
        font-weight: bold;
        margin-right: 0px;
    }

    .user-dropdown {
        position: relative;
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    .user-dropdown i {
        margin-left: 5px;
    }

    div.dropdown-menu {
        display: none;
        position: absolute;
        top: 100%;
        right: -5%;
        background-color: white;
        border: white;
        box-shadow: none;
        width: auto;
        animation: headerfadeIn 0.3s ease-in-out;
        z-index: 1000;
        min-width: 100px;
        transition: opacity 0.3s ease, transform 0.3s ease;
        opacity: 0;
        transform: translateY(-10px);
    }

    div.dropdown-menu.show {
        display: block;
        opacity: 1;
        transform: translateY(0);
    }

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
        color: #333;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .user-dropdown .dropdown-item:hover {
        background-color: #0B3E57 !important;
        color: white;
        border-radius: 3px;
        transform: scale(1.05); /* Animación de hover */
    }

    .username {
        display: inline-block;
        width: 120px;
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap;
    }
</style>
<header class="header">
    <button id="logo-button" style="background: none; border: none; padding: 0; cursor: pointer;">
        <img src="/img/Clinica Vitalis login.png" alt="Logo de la Clínica" class="logo">
    </button>
    <span class="role-text"><?php echo htmlspecialchars($rol); ?></span>
    <div class="dropdown user-dropdown">
        <span><?php echo htmlspecialchars($nombre); ?></span>
        <i class="fas fa-chevron-down"></i>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="../../controllers/cerrar_sesion.php">Cerrar sesión</a>
        </div>
    </div>
</header>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
<script>
    const userDropdown = document.querySelector('.user-dropdown');
    const dropdownMenu = document.querySelector('.dropdown-menu');

    userDropdown.addEventListener('click', function () {
        dropdownMenu.classList.toggle('show');
    });

    window.addEventListener('click', function (e) {
        if (!userDropdown.contains(e.target)) {
            dropdownMenu.classList.remove('show');
        }
    });

    document.getElementById('logo-button').addEventListener('click', function () {
        let ruta;

        switch ('<?php echo htmlspecialchars($rol); ?>') {
            case 'Administrador':
                ruta = '/views/inicio/admin_inicio.php';
                break;
            case 'Paciente':
                ruta = '/views/inicio/inicio_paciente.php';
                break;
            case 'Médico':
                ruta = '/views/inicio/medico_inicio.php';
                break;
            case 'Recepcionista':
                ruta = '/views/inicio/inicio_recepcionista.php';
                break;
            case 'Recursos Humanos':
                ruta = '/views/inicio/inicio_recursos_humanos.php';
                break;
            default:
                ruta = '/index.php';
                break;
        }

        document.body.style.transition = 'opacity 0.5s ease';
        document.body.style.opacity = '0';

        setTimeout(() => {
            window.location.href = ruta;
        }, 500);
    });
</script>
