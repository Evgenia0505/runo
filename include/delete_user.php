<?php
session_start();
    require '../config/db.php';

    $id = $_GET['id'];
    $user = $_SESSION['user']['id'];

       
    if (file_exists("../uploads_images/".$_GET["image"]))
    {
        unlink("../uploads_images/".$_GET["image"]);  
    }

    $sql = 'DELETE FROM `comment` WHERE `user_id` = ?';
    $data = $db->prepare($sql);
    $data->execute([$id]);


    $sql = 'DELETE FROM `user` WHERE `id` = ?';
    $stmt = $db->prepare($sql);
    $stmt->execute([$id]);

    header("Location: {$_SERVER['HTTP_REFERER']}"); 
?>