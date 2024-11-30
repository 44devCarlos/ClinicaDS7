<?php
include "../includes/Database.php";
$database = new Database();
$db = $database->getConnection();

if (isset($_GET['id_padecimiento'])) {
    $id_padecimiento = $_GET['id_padecimiento'];  // Usar la variable correcta

    // Consulta para obtener medicamentos según el padecimiento
    $query = "SELECT m.medicamento_id, m.nombre 
              FROM medicamentos m
              WHERE m.id_padecimiento = :id_padecimiento";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id_padecimiento', $id_padecimiento);
    $stmt->execute();

    $medicamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($medicamentos);
}
?>
