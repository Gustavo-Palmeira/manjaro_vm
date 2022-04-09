<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization');


$data = json_decode(file_get_contents('php://input'), true);

$playerId = $data['id'];
$playerName = $data['name'];

require_once('dbconfig.php');

echo $query = $playerId ? "SELECT * FROM player WHERE id = $playerId" : "SELECT * FROM player WHERE name LIKE '$playerName'";

$query = 'SELECT * FROM player';

$result = mysqli_query($conn, $query) or die('Falha na busca.');

$count = mysqli_num_rows($result);

if ($count > 0) {
    $row = mysqli_fetch_all($result, MYSQL_ASSOC);
    echo json_encode($row);
} else {
    echo json_encode(array('message' => 'Não encontrado.', 'status' => false));
}

?>