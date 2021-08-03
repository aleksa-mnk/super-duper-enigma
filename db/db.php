<?php
// хост, имя базы данных и чарсет
$host = '127.0.0.1';
$db   = 'basa';
$user = 'root';
$pass = '';
$charset = 'utf8';
$table = 'table1';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$pdo = new PDO($dsn, $user, $pass, $opt);