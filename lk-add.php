<?php 
session_start();
include_once("config/db.php");

$userid = $_SESSION["userid"];
$user = $_SESSION['user']['id'];
$rights = $_SESSION['user']['rights'];

if (isset($_POST["submit_add"]))
    {
      $error = array();
      if (count($error)) {           
            $_SESSION['message'] = "<p id='form-error'>".implode('<br />',$error)."</p>";  
       } else {
        $title = $_POST['title'];
        $subtitle = $_POST['subtitle']; 
        $text = $_POST['text']; $text2 = $_POST['text2'];
        $date = $_POST['date']; 
        $time = $_POST['time'];
        $category_id = $_POST['category_id']; 

        $user_id = $userid;

$stmt = $db->prepare("INSERT INTO project (`title`, `subtitle`, `text`, `text2`, `date`, `time`, `user_id`, `category_id`) VALUES (?, ?, ?, ?, ?, ?, ?, ? )");
try {
    $stmt->execute([$title, $subtitle, $text, $text2, $date, $time, $user_id, $category_id]);
    echo '<p class="form__polit3"> Ваши данные успешно добавлены!</p>';
} catch (PDOException $e) {
    die('Ошибка  ' . $e->getMessage()); 
    echo "Ваши данные не добавлены";
} 
$id = $db->lastInsertId();

    include("admin/action/project_add.php");
} }

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
                        <li><a class="lk__link lk__link__active" href="">Add an article</a></li>
                        <li><a class="lk__link" href="lk-about.php?id=<?= $userid ?>">About</a></li>
                    </ul>

                    <h2 class="form__title">Add an article</h2>
                    <p class="form__subtitle">Add your article, do not violate the rules of the site</p>

                    <form enctype="multipart/form-data" method="post">
                        <div><input class="form__input" type="text" name="title" placeholder="title"></div>
                        <div><input class="form__input" type="text" name="subtitle" placeholder="subtitle"></div>
                        <div><textarea class="form__input add" name="text" cols="70" rows="10" placeholder="article text"></textarea></div>
                        <div><input class="form__input" type="date" name="date" placeholder="date"></div>
                        <div><input class="form__input" type="text" name="time" placeholder="reading time"></div>
                        <div>
                            <select class="form__input" name="category_id" id="">

                            <?php 
                $data = $db->query("SELECT * FROM `category`");
                while($row = $data->fetch(PDO::FETCH_ASSOC)) {       
            
        ?>
                                <option value="<?=  $row['id'] ?>"><?=  $row['name'] ?></option>
                                <?php } ?>
                            </select>
                        </div> <br>
                        <label class="stylelabel">Add 2 photos for your article!</label>
                        <div>
                            <input class="form-control" type="hidden" name="MAX_FILE_SIZE" value="5000000"/>
                            <input class="form-control" type="file" name="upload_image[]" multiple accept=".png, .jpg, .jpeg" required /><br><br>
                            <div class="output form__polit"></div>
                        </div>
                        <div><textarea class="form__input2 add" name="text2" cols="70" rows="10" placeholder="article text"></textarea></div>
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
   

  <script>
    const fileInput=document.querySelector("input[type=file]");
    const btn=document.querySelector(".form__btn");
    const output = document.querySelector(".output");

    fileInput.addEventListener("change", () => {
    const fileList = fileInput.files;
    
    if(fileList.length != 2){
        btn.disabled = true;
        btn.style.backgroundColor="grey";
        output.textContent = `You need to select 2 photos! You've selected: ${fileList.length} file(s)`;
    }
    else if(fileList.length == 2){
        btn.disabled = false;
        btn.style.backgroundColor="#EA4C89";
        output.textContent = ``;
    }
});
</script>  

</body>
</html>