<style>
    html, body {
        height: 100%; /* Asegura que el cuerpo ocupe el 100% de la altura */
        margin: 0; /* Elimina el margen por defecto */
    }

    .footer {
        position: relative;
        background-color: #0B3E57;
        padding: 20px 0;
        text-align: center;
        color: white;
        opacity: 0;
        animation: fadeIn 1.5s ease-out forwards; /* Animación de desvanecimiento */
        transition: background-color 0.3s ease; /* Transición suave de color de fondo */
    }

    .footer .social-icons a i {
        color: #2E708A; /* Color azul de los íconos por defecto */
        font-size: 24px; /* Tamaño de los íconos */
        transition: color 0.3s ease, transform 0.3s ease; /* Transición suave para el cambio de color y efecto de transformación */
    }

    .footer:hover .social-icons a:hover i {
        color: #9DDBD9; /* Color naranja al pasar el ratón sobre el ícono */
        transform: translateY(-5px); /* Efecto de subida al pasar el ratón */
    }

    /* Animación para hacer que el footer se desvanezca */
    @keyframes fadeIn {
        0% {
            opacity: 0;
        }
        100% {
            opacity: 1;
        }
    }

    /* Animación de fondo pulsante */
    .footer:hover {
        background-color: #2E708A; /* Fondo más claro cuando pasa el ratón */
    }

    /* Efecto de desplazamiento de los íconos */
    .social-icons a {
        animation: moveIcons 1.5s ease-in-out infinite alternate; /* Movimiento de los íconos */
    }

    @keyframes moveIcons {
        0% {
            transform: translateX(0);
        }
        50% {
            transform: translateX(10px); /* Desplazamiento hacia la derecha */
        }
        100% {
            transform: translateX(0);
        }
    }
    /* Al hacer hover sobre el footer, cambiamos el color de los íconos */
    .footer:hover .social-icons a i {
        color: #0B3E57; /* Los íconos cambian a color del fondo cuando se hace hover */
    }

    /* Al hacer hover sobre el footer, el fondo cambia a un color más claro */
    .footer:hover {
        background-color: #2E708A; /* Fondo más claro cuando pasa el ratón */
    }
</style>
<!-- Bootstrap CSS y JS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
<footer class="footer">
    <div class="container">
        <p>© 2024 Clínica Vitalis. Todos los derechos reservados.</p>
        <div class="social-icons">
            <p>
                <a class="text-decoration-none me-3" href="#"><i class="fab fa-facebook-f"></i></a>
                <a class="text-decoration-none me-3" href="#"><i class="fab fa-twitter"></i></a>
                <a class="text-decoration-none" href="#"><i class="fab fa-instagram"></i></a>
            </p>
        </div>
    </div>
</footer>

</html>
