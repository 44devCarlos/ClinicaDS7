<?php require("../../template/header.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Gestión Clínica</title>
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
            <h1>Bienvenido a la Clínica</h1>
            <p>Gestión eficiente para una atención de calidad</p>
        </div>
    </section>

    <section class="services-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img alt="Gestión Administrativa" class="card-img-top" height="300" src="https://storage.googleapis.com/a1aa/image/MhMg8ClKP4KENBQi3rezKv6e5FZMBJLoG1E82jeSZzBSMfSPB.jpg" width="400"/>
                        <div class="card-body">
                            <h5 class="card-title">Gestión Administrativa</h5>
                            <p class="card-text">Añade, elimina o modifica usuarios.</p>
                            <a href="../registrar/registrar_usuario.php" class="btn btn-primary mb-3">Registrar Usuario</a>
                            <a href="../listas/lista_usuarios.php" class="btn btn-primary mb-3">Ver todos los usuarios</a>
                            <a href="../listas/servicios_medicos.php" class="btn btn-primary mb-3">Definir y Consultar Servicios Médicos</a>
                            <a href="../registrar/registrar_padecimiento.php" class="btn btn-primary mb-3">Control de Padecimientos</a>
                            <a href="../registrar/registrar_medicamento.php" class="btn btn-primary mb-3">Control de Medicamentos</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <img alt="Gestión de Recursos Humanos" class="card-img-top" height="300" src="https://storage.googleapis.com/a1aa/image/i0biLXv6N4KFNtveJeeugHpuhotLZs5ziAVUOOqlQFezYeleE.jpg" width="400"/>
                        <div class="card-body">
                            <h5 class="card-title">Gestión de Recursos Humanos</h5>
                            <p class="card-text">Consulta y genera reportes del sistema.</p>
                            <a href="../registrar/registrar_medico.php" class="btn btn-primary mb-3">Registro/Verificación de perfil médico</a>
                            <a href="#" class="btn btn-primary mb-3">Gestión de turnos y asignación de personal</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <img alt="Gestión de Recepción" class="card-img-top" height="300" src="https://storage.googleapis.com/a1aa/image/i0biLXv6N4KFNtveJeeugHpuhotLZs5ziAVUOOqlQFezYeleE.jpg" width="400"/>
                        <div class="card-body">
                            <h5 class="card-title">Gestión de Recepción</h5>
                            <p class="card-text">Ajusta las configuraciones globales.</p>
                            <a href="../registrar/registrar_paciente.php" class="btn btn-primary mb-3">Registro de pacientes</a>
                            <a href="#" class="btn btn-primary mb-3">Registro de pago de consultas</a>
                            <a href="#" class="btn btn-primary mb-3">Creación/Modificación/Cancelación de Citas</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <img alt="Gestión de Médicos" class="card-img-top" height="300" src="https://storage.googleapis.com/a1aa/image/MhMg8ClKP4KENBQi3rezKv6e5FZMBJLoG1E82jeSZzBSMfSPB.jpg" width="400"/>
                        <div class="card-body">
                            <h5 class="card-title">Gestión de Médicos</h5>
                            <p class="card-text">Ajusta las configuraciones globales.</p>
                            <a href="#" class="btn btn-primary mb-3">Lista de pacientes</a>
                            <a href="#" class="btn btn-primary mb-3">Consultar resultados de análisis médicos</a>
                            <a href="#" class="btn btn-primary mb-3">Consultar citas del día</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                    <img alt="Gestión de Pacientes" class="card-img-top" height="300" src="https://storage.googleapis.com/a1aa/image/7l2ByUrCQQKeMSO8JO2bjIYYr0T4TZWphgSB4MFV8VIFzX6JA.jpg" width="400"/>
                        <div class="card-body">
                            <h5 class="card-title">Gestión de Pacientes</h5>
                            <p class="card-text">Ajusta las configuraciones globales.</p>
                            <a href="#" class="btn btn-primary mb-3">Solicitar consulta médica</a>
                            <a href="#" class="btn btn-primary mb-3">Acceder a resultados médicos</a>
                            <a href="#" class="btn btn-primary mb-3">Calendario de citas</a>
                            <a href="#" class="btn btn-primary mb-3">Actualizar información personal</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php require("../../template/footer.php"); ?>