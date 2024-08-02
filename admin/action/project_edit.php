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
    }

    if (isset($_FILES['upload_image2'])){
        $imgext2 = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES['upload_image2']['name']));
        $newfilename2 = $id.rand(10,3000).'.'.$imgext2;
        $uploadfile2 = $uploaddir.$newfilename2;
    }
    
    //загружаем файл move_uploaded_file
    if (isset($_FILES['upload_image'])){
        if (move_uploaded_file($_FILES['upload_image']['tmp_name'], $uploadfile)){       
            $update = $db->prepare("UPDATE project SET `image` = ? WHERE id = ?");
            $update->execute([$newfilename, $id]);
        } else {
        $error_img[] =  "Ошибка загрузки файла.";    
        } 
    };

    if (isset($_FILES['upload_image2'])){
        if (move_uploaded_file($_FILES['upload_image2']['tmp_name'], $uploadfile2)){   
            $update = $db->prepare("UPDATE project SET `image2` = ? WHERE id = ?");
            $update->execute([$newfilename2, $id]);
        } else {
        $error_img[] =  "Ошибка загрузки файла.";    
        } 
    }
?>