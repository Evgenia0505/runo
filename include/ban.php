<?php
include_once("../config/db.php");

$id=$_POST['id'];

if($id==NULL)exit();

 if($id)
    {
    $data = $db->prepare("SELECT `id`, `login` FROM `user` WHERE `id` = ?");
    $data->execute([$id]);
    $row = $data->fetch(PDO::FETCH_ASSOC);
        
    if($row['login'] !== 'ban'){
    $update = $db->prepare("UPDATE user SET `login` = ? WHERE id = ?");
        try {
            $update->execute(['ban', $id]); 
        }
        catch (PDOException $e) {
            die('Ошибка ' . $e->getMessage()); 
        }  
    } 
    else {

     $update = $db->prepare("UPDATE user SET `login` = ? WHERE id = ?");
    try {
        $update->execute(['', $id]); 
    }
    catch (PDOException $e) {
        die('Ошибка ' . $e->getMessage()); 
    }  
}

}

?>