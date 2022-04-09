<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization');

$data = json_decode(file_get_contents('php://input'), true);

$playerId = $data['id'] ?? null;

require_once('dbconfig.php');

$query = "DELETE FROM player WHERE id = $playerId";

if (mysqli_query($conn, $query) or die($query)) {
  echo json_encode(array('message' => 'Jogador apagado.', 'status' => true));
} else {
  echo json_encode(array('message' => 'Não foi possível apagar o jogador.', 'status' => false));
}
?>