<?php
$pdo = new PDO('mysql:host=mysql_db;dbname=odin', 'root', 'root');

$sql = 'SELECT
        *
        FROM `user` ';

$stmt = $pdo->query($sql);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt->execute();

var_dump($users);
