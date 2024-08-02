<?php
session_start();
include_once("../config/db.php");

$project_id = $_SESSION['project_id'];

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $login = $_POST["login"];
        $name = $_POST["name"];
        $phone = $_POST["phone"];
            // $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $email = $_POST["email"];
        $password = $_POST["password"];
        $repeat_password = $_POST["repeat_password"];
        $rights = $_POST["rights"];
        
        try {
            if($password === $repeat_password) {
                $password = $password;
                // без $path2 аватарка не появляется в личном кабинете после регистрации!

                $path = 'uploads_images/'.time().$_FILES['avatar']['name'];
                if (move_uploaded_file($_FILES['avatar']['tmp_name'], '../'.$path)) {
                $path2 = time().$_FILES['avatar']['name']; 
                } else {
                    $path2 = NULL;
                }

                // и вставлять в базу нужно $path2, а не  $path!
                $user = $db->prepare("INSERT INTO `user` (`id`, `login`, `pass`, `name`, `phone`, `email`, `text`, `image`, `rights`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $user->execute([NULL, $login, $password, $name, $phone, $email, NULL, $path2, $rights]);

                // если в базу смогли записать пользователя (а email в базе уникальный!), то после записываем аватарку в uploads_images
                $path = 'uploads_images/'.time().$_FILES['avatar']['name'];
                if(!move_uploaded_file($_FILES['avatar']['tmp_name'], '../'.$path)) {

                    // $_SESSION['message'] = 'Error loading the image';
                    header("Location: {$_SERVER['HTTP_REFERER']}");
                }
                // $_SESSION['message'] = 'Registration was successful!';
                
                $data = $db->prepare("SELECT * FROM `user` WHERE `email` = ?");
                $data->execute([$email]);
                $user = $data->fetch(PDO::FETCH_ASSOC);

                // if ($user && password_verify($password, $user['pass'])) {
                if ($password == $user['pass'] && $user['login'] == "author") {    
                    $_SESSION['user'] = [
                        "id" => $user["id"],
                        "email"=> $user["email"],
                        "login"=> $user["login"],
                        "avatar"=> $user["image"],
                        "rights" => $user["rights"]
                    ];
                    header("Location: ../lk.php");
                    exit();

                } elseif ($password == $user['pass'] && $user['login'] !== "author" && (isset($project_id))){
                    // if ($user && password_verify($password, $user['pass'])) {
                    $_SESSION['user'] = ["id" => $user["id"]]; 

                        header("Location: ../article.php?id=$project_id#write");
                        exit();
                } elseif ($password == $user['pass'] && $user['login'] !== "author" && (!isset($project_id))){
                    $_SESSION['user'] = ["id" => $user["id"]]; 

                        header("Location: ../index.php");
                        exit();
                }
            } else {
                $_SESSION['message'] = 'Passwords dont match!';
                header("Location: {$_SERVER['HTTP_REFERER']}");
            }
        } catch (PDOException $e) {
            $_SESSION['message'] = 'This email already exists - Log in!';
            header("Location: ../aut.php");
        } 
    } 
?>