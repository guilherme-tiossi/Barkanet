<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$dbname = "barkanet";

$pdo = new PDO("mysql:host=$servidor;dbname=$dbname",$usuario,$senha);