<?php
include "../includes/Database.php";
$database = new Database();
$db = $database->getConnection();

// Leer el cuerpo de la solicitud (JSON)
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['padecimientos'])) {
    $padecimientos = $data['padecimientos'];  // Usar la variable correcta

    $placeholder = implode(',', array_fill(0, count($padecimientos), '?'));
    // Consulta para obtener medicamentos según el padecimiento
    $query = "SELECT m.medicamento_id, m.nombre 
              FROM medicamentos AS m
              WHERE m.id_padecimiento IN ($placeholder)";
    $stmt = $db->prepare($query);

    // Vincular los parámetros de la consulta
    foreach ($padecimientos as $index => $id) {
        $stmt->bindValue($index + 1, $id, PDO::PARAM_INT);  // Los valores son vinculados dinámicamente
    }

    $stmt->execute();

    $medicamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(['medicamentos' => $medicamentos]);
    exit;
}
