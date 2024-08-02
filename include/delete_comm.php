<?php
session_start();
    require '../config/db.php';
    
    $comm_id = $_GET['comm_id'];
    $user = $_SESSION['user']['id'];

    $sql = 'DELETE FROM `comment` WHERE `id` = ?';
    $stmt = $db->prepare($sql);
    $stmt->execute([$comm_id]);

    header("Location: {$_SERVER['HTTP_REFERER']}#write"); 
?>
