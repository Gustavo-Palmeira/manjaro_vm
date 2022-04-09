<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization');

$data = json_decode(file_get_contents('php://input'), true);

$playerId = $data['id'] ?? null;
$playerName = $data['name'] ?? null;
$playerHeight = $data['height'] ?? null;
$playerBirthday = $data['birthday'] ?? null;

require_once('dbconfig.php');

$query = "UPDATE player SET name = '$playerName', height = $playerHeight, birthday = '$playerBirthday' WHERE id = $playerId";

if (mysqli_query($conn, $query) or die($query)) {
    echo json_encode(array('message' => 'Jogador atualizado.', 'status' => true));
} else {
    echo json_encode(array('message' => 'Não foi possível atualizar o jogador.', 'status' => false));
}
?>