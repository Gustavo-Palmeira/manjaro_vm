<?php

$DBhost = 'localhost';
$DBuser = 'root';
$DBpassword = '';
$DBname = 'nba_players';

$conn = mysqli_connect($DBhost, $DBuser, $DBpassword, $DBname);

if (!$conn) {
    die('Falha na conexão: ' . $mysqli_connect_error());
}

?>