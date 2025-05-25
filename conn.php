<?php 
session_start();
    try {
        $strConnection='mysql:host=localhost;dbname=dbwebcentric';
        $pdo=new PDO($strConnection,'root','root');
    } catch (PDOException $e) {
        $msg='Error in PDO - '. $e->getMessage();
        die($msg);
    }
?>