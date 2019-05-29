<?php
  $dsn = 'mysql:dbname=bbs;host=db;charset=utf8mb4';
  $username = 'root';
  $password = 'rootpw';
  $pdo = new PDO($dsn, $username, $password);
  $pdo -> query('SET NAMES utf8');
?>