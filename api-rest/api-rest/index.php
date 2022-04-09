<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization');

require_once('dbconfig.php');

$query = 'SELECT * FROM player';

$result = mysqli_query($conn, $query) or die('Falha na consulta.');

$count = mysqli_num_rows($result);

if ($count > 0) {
  $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
  echo json_encode($row);
} else {
  echo json_encode(array('message' => 'Não há jogadores cadastrados', 'status' => false));
}

?>