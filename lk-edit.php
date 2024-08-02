<?php 
session_start();
include_once("config/db.php");

$id = $_GET["id"];

$data = $db->prepare("SELECT `user_id` FROM `project` WHERE `id` = ?");
$data->execute([$id]);
$row = $data->fetch(PDO::FETCH_ASSOC);
// устанавливаем $_SESSION["userid"] именно на этой странице!
$_SESSION["userid"] = $row['user_id'];

$userid = $_SESSION["userid"];

$user = $_SESSION['user']['id'];
$rights = $_SESSION['user']['rights'];

if (isset($_GET["action"])) {
   if ($_GET["action"] == 'delete') {
	    // case 'delete':

        if (file_exists("uploads_images/".$_GET["image"])) {
                unlink("uploads_images/".$_GET["image"]); 
                $update = $db->prepare("UPDATE project SET `image` = ? WHERE id = ?");
                try {
                    $update->execute([NULL, $id]);
                } 
                catch (PDOException $e) {
                    die('Ошибка  ' . $e->getMessage()); 
                }
        }
    }
	    // break;
        // case 'delete2':
            
        if ($_GET["action"] == 'delete2') {
            if (file_exists("uploads_images/".$_GET["image2"])){
                unlink("uploads_images/".$_GET["image2"]); 
                $update = $db->prepare("UPDATE project SET `image2` = ?  WHERE id = ?");
                try {
                    $update->execute([NULL, $id]);
                } 
                catch (PDOException $e) {
                    die('Ошибка  ' . $e->getMessage()); 
                }
                }
    //    break;
    } 
}


if (isset($_POST["submit_add"]))
    {

      $error = array();
      if (count($error))
       {           
            $_SESSION['message'] = "<p id='form-error'>".implode('<br />',$error)."</p>";
            
       } else {
        $title = $_POST['title'];
        $subtitle = $_POST['subtitle']; 
        $text = $_POST['text'];  $text2 = $_POST['text2'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $category_id = $_POST['category_id']; $user_id = $user;

$update = $db->prepare("UPDATE project SET `title` = ?, `subtitle` = ?, `text` = ?, `text2` = ?,  `date` = ?, `time` = ?, `category_id` = ? WHERE id = ?");
                try {
                    $update->execute([$title, $subtitle, $text, $text2, $date, $time, $category_id, $id]);
                    echo '<p class="form__polit3"> Ваши данные успешно добавлены!</p>';
                } 
                catch (PDOException $e) {
                    die('Ошибка ' . $e->getMessage()); 
                    echo "Ваши данные не добавлены";
                }
 
        include("admin/action/project_edit.php");
      
            if($rights == "admin") {
                $update = $db->prepare("UPDATE project SET `check` = ? WHERE id = ?");
                    try {
                        $update->execute([1, $id]);
                    } 
                    catch (PDOException $e) {
                        die('Ошибка ' . $e->getMessage()); 
                        echo "Ваши данные не добавлены";
                    }
            }
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
                    <li class="bread__item"><p>Personal account</p></li>
                </ul>
            </div>

            <div class="row justify__content__around gap40">
                <div>
                    <?php include('include/about_edit.php'); ?>
                </div>
               
                <div> 
                    <ul class="lk__list row gap10 ">
                        <li><a class="lk__link" href="lk.php">Back</a></li>
                        <li><a class="lk__link lk__link__active" href="">Editing an article</a></li>
                        <li><a class="lk__link" href="lk-add.php">Add an article</a></li>
                        <li><a class="lk__link" href="lk-about.php?id=<?= $userid ?>">About</a></li>
                    </ul>

                    <h2 class="form__title">Editing an article</h2>
                    <p class="form__subtitle">Add your article, do not violate the rules of the site</p>

                    <form enctype="multipart/form-data" method="post">

                            <?php
                            $id = $_GET["id"];

        $data = $db->prepare("SELECT * FROM `project` WHERE `id` = ?");
        $data->execute([$id]);
        $proj = $data->fetch(PDO::FETCH_ASSOC);

            ?>	
                                <div><input class="form__input" type="text" value="<?= $proj['title'] ?>" name="title" placeholder="title" id=""></div>
                                <div><input class="form__input" type="text" value="<?= $proj['subtitle'] ?>" name="subtitle" placeholder="subtitle" id=""></div>
                                <div><textarea class="form__input add" name="text" id="" cols="70" rows="10"><?= $proj['text'] ?></textarea></div>
                                <div><input class="form__input" type="text" value="<?= $proj['date'] ?>" name="date" placeholder="date" id=""></div>
                                <div><input class="form__input" type="text" value="<?= $proj['time'] ?>" name="time" placeholder="reading time" id=""></div>
                                <div>
                                    <select class="form__input" name="category_id" id="">

                                    <?php 
			$category_name = $proj['category_id'];

            $data = $db->prepare("SELECT * FROM `category` WHERE `id` = ?");
            $data->execute([$category_name]);
            while($row = $data->fetch(PDO::FETCH_ASSOC)) {   
        ?>
                                        <option value="<?=  $row['id'] ?>"><?=  $row['name'] ?></option>
                                        <?php } ?>

                                    <?php 
            $data = $db->query("SELECT * FROM `category`");
            while($row = $data->fetch(PDO::FETCH_ASSOC)) {    
    
        ?>
                                        <option value="<?=  $row['id'] ?>"><?=  $row['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div> <br>

<p class="stylelabel">Photos for your article</p>
<div class="row align__items__end gap30">   

                <?php 
if  ((strlen($proj["image"]) > 0) && (file_exists("uploads_images/".$proj["image"])))
{
	$img_pathh = 'uploads_images/'.$proj["image"];
echo '
    <div>
        <img style="width: 200px;" src="'.$img_pathh.'" /> <br>
        <a class="btn" href="lk-edit.php?id='.$proj["id"].'&image='.$proj["image"].'&action=delete">Delete</a>
    </div>    
    ';
} else {  
echo '
<div>
    <input type="hidden" name="MAX_FILE_SIZE" value="5000000"/>
    <input type="file" name="upload_image" accept=".png, .jpg, .jpeg" required />
</div> <br>
'; } 


if  ((strlen($proj["image2"]) > 0) && ( file_exists("uploads_images/".$proj["image2"]))	)
{
    $img_pathh2 = 'uploads_images/'.$proj["image2"]; 
echo '
    <div>
        <img style="width: 200px;" src="'.$img_pathh2.'" /> <br>
        <a class="btn" href="lk-edit.php?id='.$proj["id"].'&image2='.$proj["image2"].'&action=delete2">Delete</a>
    </div>
    ';
} else {  
echo '
    <div>
        <input type="hidden" name="MAX_FILE_SIZE" value="5000000"/>
        <input type="file" name="upload_image2" accept=".png, .jpg, .jpeg" required />
    </div>
<br>
'; } 
?>
</div><br>
                        <div><textarea class="form__input2 " name="text2" id="" cols="70" rows="10"><?= $proj['text2'] ?></textarea></div>
                        <input class="form__btn" name="submit_add" type="submit" value="Publish">
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