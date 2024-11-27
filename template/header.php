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
        background-color: #f8f9fa;
        width: 100%;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
    }
    .role-text {
    font-family: 'Roboto', sans-serif; /* Aplica la fuente Roboto */
    font-size: 30px; /* Ajusta el tamaño de la fuente según sea necesario */
    margin-left: 10px; /* Espacio entre el logo y el texto */
    align-self: center; /* Alinea verticalmente el texto con el logo */
    font-weight: bold;
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
    /* Dropdown ajustado para estar sin bordes y visible */
    div.dropdown-menu {
        display: none;
        position: absolute;
        top: 180%; /* Aparece justo debajo del texto */
        left: -28px; /* Ajusta este valor para mover el dropdown más a la izquierda */
        background-color: white; /* Fondo blanco */
        border: white; /* Sin bordes */
        box-shadow: none; /* Sin sombra */
        width: auto;
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
</style>
<header class="header">
    <img src="/img/Clinica Vitalis login.png" alt="Logo de la Clínica" class="logo">
    <span class="role-text">Rol</span>
    <!-- Dropdown del usuario -->
    <div class="dropdown user-dropdown">
        <span>USUARIO</span>
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
</script>