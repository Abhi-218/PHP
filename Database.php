<!-- 1. Write a PHP script to connect to a MySQL database and display a success
or failure message. -->

<?php
require ("./Functions.php");
    $dns = "mysql:host=localhost;dbname=abhi;";
    $username = "root";
    $pass = "";
    try {
        $pdo = new PDO($dns,$username,$pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // success("Database connection success");
    } catch (PDOException $e) {
       error($e);
    }
  ?>

