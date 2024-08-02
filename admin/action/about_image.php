<?php
$error_img = array();

//папка для загрузки
$uploaddir = 'uploads_images/';
if (isset($_FILES['upload_image'])){
    $imgext = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES['upload_image']['name']));
   
    //новое сгенерированное имя файла
    $newfilename = $id.rand(10,3000).'.'.$imgext;
    //путь к файлу (папка.файл)
    $uploadfile = $uploaddir.$newfilename;


//загружаем файл move_uploaded_file
if (move_uploaded_file($_FILES['upload_image']['tmp_name'], $uploadfile))
{   
    $update = $db->prepare("UPDATE user SET `image` = ? WHERE id = ?");
    $update->execute([$newfilename, $id]);
}}
else
{
 $error_img[] =  "Ошибка загрузки файла.";    
}  
?>