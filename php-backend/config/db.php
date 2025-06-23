<?php

function getPDO(): PDO {
    $host = getenv('DB_HOST') ?: 'localhost';
    $db   = getenv('DB_NAME') ?: 'productdb';
    $user = getenv('DB_USER') ?: 'user';
    $pass = getenv('DB_PASS') ?: 'secret';

    return new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
}
