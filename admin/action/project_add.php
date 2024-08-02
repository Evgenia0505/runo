<?php
foreach($_FILES['upload_image']['name'] as $k => $v){

$imgext = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES['upload_image']['name'][$k]));

    //папка для загрузки
$uploaddir = 'uploads_images/';

//новое сгенерированное имя файла
$_FILES['upload_image']['name'][$k] = $id.rand(10,3000).'.'.$imgext;

//загружаем файл move_uploaded_file
if (move_uploaded_file($_FILES['upload_image']['tmp_name'][$k], $uploaddir.$_FILES['upload_image']['name'][$k]))
{
    $update = $db->prepare("UPDATE project SET `image` = ?, `image2` = ? WHERE id = ?");
    // $update->execute([$_FILES['upload_image']['name'][0], $v, $id]);
    $update->execute([$_FILES['upload_image']['name'][0], $_FILES['upload_image']['name'][1] , $id]);
}
else
{
 $error_img[][$k] =  "Ошибка загрузки файла.";    
}  

}
?>