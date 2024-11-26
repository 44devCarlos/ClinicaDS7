<?php require("../../template/header.php"); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Clínica </title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: white;
        }
        .navbar-brand {
            font-weight: bold;
        }
        .hero-section {
            background: url('/img/bnda_paciente.jpg') no-repeat center center;
            background-size: cover;
            color: white;
            text-align: center;
            padding: 100px 0;
        }
        .logo {
            position: absolute;
            top: -20px;
            right: 0px;
            width: 110px;
            z-index: 1000; /* Asegura que el logo quede encima de otros elementos */
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
        .footer {
            background-color: cyan;
            padding: 20px 0;
            text-align: center;
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
    .btn-primary {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 10px rgba(0, 123, 255, 0.5);
    }
    </style>
</head>

<body>
    <a href="../../controllers/cerrar_sesion.php" class="btn btn-primary my-3 mx-4">Cerrar Sesión</a>
        
    <section class="hero-section">
        <div class="container">
            <h1>Bienvenidos a Clinica Vitalis</h1>
            <p>Tu salud es nuestra prioridad</p>
        </div>
        <img src="/img/LogoDs7.png" alt="Logo de la Clínica" class="logo">
        
    </section>


    <section class="services-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img alt="Imagen de un doctor con un estetoscopio" class="card-img-top" height="300" src="https://storage.googleapis.com/a1aa/image/MhMg8ClKP4KENBQi3rezKv6e5FZMBJLoG1E82jeSZzBSMfSPB.jpg" width="400"/>
                        <div class="card-body">
                            <a href="../consultar/solicitar_cita.php" class="btn btn-primary mb-3">Solicitar cita médica</a>
                                <p class="card-text">Contamos con un equipo de doctores capacitados y disponible en cualquier momento.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img alt="Imagen de un equipo de rayos X" class="card-img-top" height="300" src="https://storage.googleapis.com/a1aa/image/i0biLXv6N4KFNtveJeeugHpuhotLZs5ziAVUOOqlQFezYeleE.jpg" width="400"/>
                        <div class="card-body">
                          <a href="../listas/lista_citas.php" class="btn btn-primary mb-3">Lista de Citas</a>
                             <p class="card-text">Contamos con un equipo de doctores capacitados y disponible en cualquier momento.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img alt="Imagen de un laboratorio con tubos de ensayo" class="card-img-top" height="300" src="https://storage.googleapis.com/a1aa/image/7l2ByUrCQQKeMSO8JO2bjIYYr0T4TZWphgSB4MFV8VIFzX6JA.jpg" width="400"/>
                        <div class="card-body">
                            <a href="#" class="btn btn-primary mb-3">Verificar historial médico</a>
                            <p class="card-text">Realizamos una amplia gama de análisis clínicos con resultados rápidos y precisos.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img alt="Imagen de un equipo de rayos X" class="card-img-top" height="300" src="https://storage.googleapis.com/a1aa/image/i0biLXv6N4KFNtveJeeugHpuhotLZs5ziAVUOOqlQFezYeleE.jpg" width="400"/>
                        <div class="card-body">
                            <a href="../registrar/datos_medicos.php" class="btn btn-primary mb-3">Registrar Datos Médicos</a>
                            <p class="card-text">Contamos con un equipo de doctores capacitados y disponible en cualquier momento.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img alt="Imagen de un laboratorio con tubos de ensayo" class="card-img-top" height="300" src="https://storage.googleapis.com/a1aa/image/7l2ByUrCQQKeMSO8JO2bjIYYr0T4TZWphgSB4MFV8VIFzX6JA.jpg" width="400"/>
                        <div class="card-body">
                            <a href="../registrar/realizar_pago.php" class="btn btn-primary mb-3">Realizar Pagos</a>
                            <p class="card-text">Realizamos una amplia gama de análisis clínicos con resultados rápidos y precisos.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php require("../../template/footer.php") ?>
