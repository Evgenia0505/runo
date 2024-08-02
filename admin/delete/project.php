<?php
	session_start();
    include("../../config/db.php");

    $id = $_GET['id'];
       
    if (file_exists("../../uploads_images/".$_GET["image"]) || file_exists("../../uploads_images/".$_GET["image2"]))
    {
        unlink("../../uploads_images/".$_GET["image"]);  
        unlink("../../uploads_images/".$_GET["image2"]);
    }


    $stmt = $db->prepare('DELETE FROM `project` WHERE `id` = ?');
    try {
        $stmt->execute([$id]);
    } 
    catch (PDOException $e) {
        die('Ошибка  ' . $e->getMessage()); 
    } 
    // $db = NULL;
    header("Location: {$_SERVER['HTTP_REFERER']}");

?>
