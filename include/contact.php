<?php
session_start();
include_once("../config/db.php");

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $email = $_POST["email"];
        $text = $_POST["text"];

        try {
                $user = $db->prepare("INSERT INTO `contact` (`id`, `email`, `text`) VALUES (?, ?, ?)");
                $user->execute([NULL, $email, $text]);

                $_SESSION['message'] = 'We will answer you as soon as possible!';
                header("Location: {$_SERVER['HTTP_REFERER']}");
                exit();

        } catch (PDOException $e) {
            $_SESSION['message'] = 'You have already written to us!';
             header("Location: {$_SERVER['HTTP_REFERER']}");
        } 
    }         
?>