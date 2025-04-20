<?php
//Esta función recoge los detalles de la orden y los devuelve como un JSON para ser gestionados.
header('Content-Type: application/json');
include "../../db/db.php";

$response = ['success' => false];

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $conexion = mysqli_connect($host, $userAdmin, $passAdmin, $db);

    if ($conexion) {
        $query = "SELECT product_name, quantity, price_unit FROM order_details WHERE id_order = ?";
        $stmt = mysqli_prepare($conexion, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($result && mysqli_num_rows($result) > 0) {
            $detalles = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $detalles[] = $row;
            }
            $response['success'] = true;
            $response['detalles'] = $detalles;
        }
        mysqli_close($conexion);
    }
}
echo json_encode($response);
