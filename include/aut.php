<?php
session_start();
include_once("../config/db.php");

$project_id = $_SESSION['project_id'];


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $data = $db->prepare("SELECT * FROM `user` WHERE `email` = ?");
    $data->execute([$email]);
    $user = $data->fetch(PDO::FETCH_ASSOC);

    // if ($user && password_verify($password, $user['pass'])) {

    if ($password == $user['pass'] && $user['login'] == "author") {  
            // $_SESSION['user']['id'] = $user['id'];  
        $_SESSION['user'] = [
            "id" => $user["id"],
            "email"=> $user["email"],
            "login"=> $user["login"],
            "avatar"=> $user["image"],
            "rights" => $user["rights"]
        ];
        header("Location: ../lk.php");
        exit();

    } elseif ($password == $user['pass'] && $user['login'] !== "author" && $user['login'] !== "ban" && (isset($project_id))){
        // if ($user && password_verify($password, $user['pass'])) {

        $_SESSION['user'] = [
            "id" => $user["id"],
            "login"=> $user["login"]
        ];
            header("Location: ../article.php?id=$project_id#write");
            exit();

    } elseif ($password == $user['pass'] && $user['login'] !== "author" && $user['login'] !== "ban" && (!isset($project_id))){
    
        $_SESSION['user'] = [
            "id" => $user["id"],
            "login"=> $user["login"]
        ];

            header("Location: ../index.php");
            exit();

    } elseif ($user['login'] == 'ban'){
        $_SESSION['message'] = "You can't log in - you're banned!";
        header("Location: {$_SERVER['HTTP_REFERER']}");

    } else {
        $_SESSION['message'] = 'Password or email dont match!';
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }
}