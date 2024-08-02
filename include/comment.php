<?php
session_start();
require '../config/db.php';

if(!isset($_SESSION['user']['id'])) {
    header("Location:../reg.php");
    exit();
}

    $review = $_POST['review'];
    // $project_id = $_POST['project_id'];
    $project_id = $_SESSION['project_id'];

    if(isset($_SESSION['user']['id']) && $review !== '')  {
        $sql = 'INSERT INTO comment(project_id, user_id, `text`) VALUES(:project_id, :user_id, :text)';
        $query = $db->prepare($sql);
        $query->execute(['project_id' => $project_id, 'user_id' => $_SESSION['user']['id'], 'text' => $review]);
        header("Location: {$_SERVER['HTTP_REFERER']}#write");

    } elseif(isset($_SESSION['user']['id']) && $review == '') {
        header("Location: {$_SERVER['HTTP_REFERER']}#write");
        $_SESSION['message'] = 'Write your comment!';

    } 
?>
