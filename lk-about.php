<?php 
    session_start();
    include_once("config/db.php");

    $id = $_GET["id"];

    $userid = $_SESSION["userid"]; 
    $user = $_SESSION['user']['id'];
    $rights = $_SESSION['user']['rights'];

    $action = isset($_GET["action"]);
    if (isset($action)) {
        switch ($action) {    
            case 'delete':
            
            if (file_exists("uploads_images/".$_GET["image"]))
            {
            unlink('uploads_images/'.$_GET["image"]); 

            $update = $db->prepare("UPDATE user SET image = ? WHERE id = ?");
            try {
                $update->execute([NULL, $id]);
            } 
            catch (PDOException $e) {
                die('Ошибка  ' . $e->getMessage()); 
            }
            }
            break;
        } 
    }
    
 
if (isset($_POST["submit_add"]))
{
  $error = array();
  if (count($error)) {           
        $_SESSION['message'] = "<p id='form-error'>".implode('<br />',$error)."</p>";  
   } else {

            $login = $_POST["login"];
            $name = $_POST["name"];
            $text = $_POST["text"];
            $phone = $_POST["phone"];
            $email = $_POST["email"];
            $password = $_POST["password"];
               
                $update = $db->prepare("UPDATE user SET `login` = ?, `pass` = ?, `name` = ?, `phone` = ?, `email` = ?, `text` = ? WHERE id = ?");
                try {
                    echo '<p class="form__polit3"> Ваши данные успешно добавлены!</p>';
                    $update->execute([$login, $password, $name, $phone, $email, $text, $id]);
                } 
                catch (PDOException $e) {
                    die('Ошибка ' . $e->getMessage()); 
                    echo "Ваши данные не добавлены";
                }
   
                include("admin/action/about_image.php");
        }
    }  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="css/flex.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/nav.css">
</head>
<body>

<header>
    <?php include('include/nav.php'); ?>
</header>

    <section class="lk">
        <div class="container">
            <div class="row bread">
                <ul>
                    <li class="bread__item"><a class="bread__link" href="index.php?nav=Home">Home</a></li>
                    <li class="bread__item">></li>
                    <li class="bread__item"><p class="bread__name">Personal account</p></li>
                </ul>
            </div>

            <div class="row justify__content__around gap40">
                <div>
                    <?php include('include/about_edit.php'); ?>
                </div>
                <div>
                    <ul class="lk__list row gap10">
                        <li><a class="lk__link" href="lk.php">Back</a></li>
                        <li><a class="lk__link" href="lk-add.php">Add an article</a></li>
                        <li><a class="lk__link lk__link__active" href="">About</a></li>
                    </ul>

                    <h2 class="form__title">Information about me</h2>
                    <p class="form__subtitle">By filling in the data, I agree to the privacy policy</p>


                    <form enctype="multipart/form-data" method="post">
                    <?php
                    if($rights == "user" || empty($userid)){ 
                        $id = $_GET["id"];

                        $data = $db->prepare("SELECT * FROM user WHERE id = ?");
                        $data->execute([$id]);
                        $user = $data->fetch(PDO::FETCH_ASSOC);

                    } 
                    elseif($rights == "admin") { 	
                
                        $userid = $_SESSION["userid"];

                        $data = $db->prepare("SELECT * FROM user WHERE id = ?");
                        $data->execute([$userid]);
                        $user = $data->fetch(PDO::FETCH_ASSOC);
                    }
                    ?>

                    <?php 


if  (	(strlen($user["image"]) > 0) && (file_exists("uploads_images/".$user["image"]))	)
{
	$img_pathh = 'uploads_images/'.$user["image"];
echo '
<label class="stylelabel">Your avatar</label>
<div>
<img style="width: 200px;" src="'.$img_pathh.'" /> <br>
<a class="btn" href="lk-about.php?id='.$user["id"].'&image='.$user["image"].'&action=delete">Delete</a>
</div>';
} else {  
echo '
<label class="stylelabel">Add file</label>
<div>
<input class="form-control" type="hidden" name="MAX_FILE_SIZE" value="5000000"/>
<input class="form-control" type="file" name="upload_image" accept=".png, .jpg, .jpeg" required />
</div> <br>
'; } 
?>
                        <div><input class="form__input" type="text" name="login" value="<?=  $user['login'] ?>" placeholder="Login"></div>
                        <div><input class="form__input" type="text" name="name" value="<?=  $user['name'] ?>" placeholder="Name"></div>
                        <div><input class="form__input" type="tel" name="phone" value="<?=  $user['phone'] ?>" placeholder="Phone"></div>
                        <div><input class="form__input" type="email" name="email" value="<?=  $user['email'] ?>" placeholder="Email"></div>
                        <div><textarea class="form__input" name="text" cols="70" rows="10" placeholder="Your occupation"><?=  $user['text'] ?></textarea></div>
                        <div><input class="form__input" type="password" name="password" value="<?=  $user['pass'] ?>" placeholder="Password"></div>

                        <input class="form__btn" name="submit_add" type="submit" value="Send">
                    </form>
        
                </div>
            </div>
        </div>
    </section>

<!-- подключение футера  -->
<?php 
  $stmt = $db -> query("SELECT * FROM `footer`");
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
    <?php include_once("include/footer.php") ?>
  <?php } ?> 

</body>
</html>