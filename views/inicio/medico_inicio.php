<?php require("../../template/header.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Gestión de Médicos</title>
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

        .services-section .card:nth-child(3) {
            animation-delay: 0.6s;
        }

        .services-section .card:nth-child(4) {
            animation-delay: 0.8s;
        }

        .services-section .card:nth-child(5) {
            animation-delay: 1s;
        }

        /* Efecto de hover en los botones */
        a.btn-primary {
            background-color: #0B3E57; /* Color azul más oscuro al pasar el mouse */
            border-color: #0B3E57;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        a.btn-primary:hover {
            background-color: #2E708A; /* Color azul */
            border-color: #2E708A;
            transform: translateY(-3px);
            box-shadow: 0 4px 10px rgba(0, 123, 255, 0.5);
        }
        a.btn-primary:active {
            background-color: #0B3E57!important; /* Color de fondo al hacer clic */
            border-color: #0B3E57!important; /* Color del borde al hacer clic */
        }
    </style>
</head>

<body>
<div class="content">
    <section class="hero-section">
            <div class="container">
                <h1>Bienvenido a Clinica Vitalis</h1>
                <p>Tu compromiso con la salud de nuestros pacientes es invaluable</p>
            </div>
    </section>
    <!-- Contenido principal -->
    <section class="container mt-5">
    <h1 class="text-center">Gestión de Médicos</h1>
    <div class="row my-4 d-flex justify-content-center">
        <div class="col-md-4 mb-4">
            <div class="card">
                <img alt="Lista de pacientes" class="card-img-top" height="300" src="https://storage.googleapis.com/a1aa/image/7l2ByUrCQQKeMSO8JO2bjIYYr0T4TZWphgSB4MFV8VIFzX6JA.jpg" width="400"/> <!-- Cambia esta URL por una imagen adecuada -->
                <div class="card-body text-center">
                    <p class="card-text">Ajusta las configuraciones globales.</p>
                    <a href="../listas/lista_pacientes.php" class="btn btn-primary mb-3">Lista de pacientes</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <img alt="Mi horario" class="card-img-top" height="300" src="https://storage.googleapis.com/a1aa/image/i0biLXv6N4KFNtveJeeugHpuhotLZs5ziAVUOOqlQFezYeleE.jpg" width="400"/> <!-- Cambia esta URL por una imagen adecuada -->
                <div class="card-body text-center">
                    <p class="card-text">Administra tu horario de atención.</p>
                    <a href="../registrar/horario.php" class="btn btn-primary mb-3">Mi horario</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <img alt="Consultar citas del día" class="card-img-top" height="300" src="https://storage.googleapis.com/a1aa/image/7l2ByUrCQQKeMSO8JO2bjIYYr0T4TZWphgSB4MFV8VIFzX6JA.jpg" width="400"/> <!-- Cambia esta URL por una imagen adecuada -->
                <div class="card-body text-center">
                    <p class="card-text">Consulta las citas programadas para hoy.</p>
                    <a href="../consultar/consultar_citas_del_dia.php" class="btn btn-primary mb-3">Consultar citas del día</a>
                </div>
            </div>
        </div>
    </div>
</section>
</div>

<?php require("../../template/footer.php"); ?>