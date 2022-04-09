<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization');

$data = json_decode(file_get_contents('php://input'), true);

$playerName = $data['name'] ?? null;
$playerHeight = $data['height'] ?? null;
$playerBirthday = $data['birthday'] ?? null;

require_once('dbconfig.php');

$query = "INSERT INTO player(name, height, birthday) VALUES('$playerName', $playerHeight, '$playerBirthday')";

if (mysqli_query($conn, $query) or die($query)) {
    echo json_encode(array('message' => 'Jogador cadastrado.', 'status' => true));
} else {
    echo json_encode(array('message' => 'Não foi possível cadastrar o jogador.', 'status' => false));
}
?>