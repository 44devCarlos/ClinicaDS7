<?php require("../../template/header.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Gestión de Recursos Humanos</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"/>
    <style>
        body {
            display: flex;
            flex-direction: column;
            font-family: 'Roboto', sans-serif;
            background-color: white;
            min-height: 100vh;
        }
        .content {
            flex: 1; /* Permite que el contenido ocupe el espacio disponible */
        }
        .hero-section {
            background: url('/img/bnda_paciente.jpg') no-repeat center center;
            background-size: cover;
            color: white;
            text-align: center;
            padding: 100px 0;
        }
        .hero-section h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }
        .hero-section p {
            font-size: 1.5rem;
        }
        .services-section .card {
            margin-bottom: 30px;
        }
        /* Animación de aparición */
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .services-section .card {
            opacity: 0;
            transform: translateY(30px);
            animation: fadeIn 1s ease-in-out forwards;
        }

        .services-section .card:nth-child(1) {
            animation-delay: 0.2s;
        }

        .services-section .card:nth-child(2) {
            animation-delay: 0.4s;
        }

        /* Efecto de hover en los botones */
        a.btn-primary, a.btn-success {
            background-color: #0B3E57; /* Color azul más oscuro al pasar el mouse */
            border-color: #0B3E57;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        a.btn-primary:hover, a.btn-success:hover {
            background-color: #2E708A; /* Color azul */
            border-color: #2E708A;
            transform: translateY(-3px);
            box-shadow: 0 4px 10px rgba(0, 123, 255, 0.5);
        }
        a.btn-primary:active, a.btn-success:active {
            background-color: #0B3E57!important; /* Color de fondo al hacer clic */
            border-color: #0B3E57!important; /* Color del borde al hacer clic */
        }
    </style>
</head>

<body>
    <a href="../../controllers/cerrar_sesion.php" class="btn btn-secondary my-3 mx-4">Cerrar Sesión</a>
    <div class="content">    
    <!-- Contenido principal -->
    <section class="hero-section">
        <div class="container">
            <h1 class="text-center">Gestión de Recursos Humanos</h1>
            <p class="text-center">Consulta y genera reportes del sistema.</p>
        </div>
    </section>

    <section class="services-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img alt="Registro de médicos" class="card-img-top" height="300" src="https://storage.googleapis.com/a1aa/image/MhMg8ClKP4KENBQi3rezKv6e5FZMBJLoG1E82jeSZzBSMfSPB.jpg" width="400"/>
                        <div class="card-body">
                            <a href="/views/registrar/registrar_medico.php" class="btn btn-primary mb-3">Registro/Verificación de perfil médico</a>
                            <p class="card-text">Ajusta y verifica los perfiles médicos en el sistema.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img alt="Gestión de turnos" class="card-img-top" height="300" src="https://storage.googleapis.com/a1aa/image/i0biLXv6N4KFNtveJeeugHpuhotLZs5ziAVUOOqlQFezYeleE.jpg" width="400"/>
                        <div class="card-body">
                            <a href="#" class="btn btn-primary mb-3">Gestión de turnos y asignación de personal</a>
                            <p class="card-text">Administra los turnos y asigna el personal adecuado.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>
    <?php require("../../template/footer.php") ?>
</body>
</html>