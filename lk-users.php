<?php 
session_start();
include_once("config/db.php");

// устанавливаем новое значение сессии равное id Владельца личного кабинета (т.е сбрасываем значение сессии равное id Автора статьи)
$_SESSION['userid'] = $_SESSION['user']['id'];

$user = $_SESSION['user']['id'];
$rights = $_SESSION['user']['rights'];

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
          <?php include('include/about.php'); ?>
        </div>
        <div>
          <ul class="lk__list row gap10">
            <li><a class="lk__link" href="lk-articles.php">Articles</a></li>
            <li><a class="lk__link" href="lk.php">Check</a></li>
            <li><a class="lk__link" href="lk-comment.php">Comments</a></li>
            <li><a class="lk__link lk__link__active" href="">Users</a></li>
            <li><a class="lk__link" href="lk-contact.php">Contacts</a></li>
            <li><a class="lk__link" href="lk-subscribe.php">Subscribe</a></li>
            <li><a class="lk__link" href="lk-add.php">Add an article</a></li>
            <li><a class="lk__link" href="lk-about.php?id=<?= $user ?>">About</a></li>
          </ul>

          <div class="row justify__content__around gap18">  
        <?php
            if($rights == "admin"){

                $user_id = [];
                $authors = [];

                $sql ="SELECT `user_id` 
                FROM `project` ;";
              $data = $db ->  query($sql);
              while($row0 = $data->fetch(PDO::FETCH_ASSOC)) { 
            //   echo $row0['user_id'] . '<br>'; 
            
              // $user_id[] = $row0['user_id'];
                 array_push($user_id, $row0['user_id']);
            }

                $sql1 ="SELECT `id`, `login`
                FROM `user` 
                WHERE `id` > ?;";

                $data = $db -> prepare($sql1);
                $data -> execute([1]);
                while($row1 = $data->fetch(PDO::FETCH_ASSOC)) { 
                // echo $row1['id'] . '<br>'; 
            
                array_push($authors, $row1['id']);
            }
             
                $id0 = array_diff($authors, $user_id);
                //  var_dump($id0);
                $id1 = implode(',', $id0); // чтобы сбросить ключи делаем строку
                $id =  explode(",", $id1); // снова делаем массив, но ключи теперь 0, 1..., а не 8, 9...
                //  var_dump($id);

                for ($i = 0; $i < count($id); $i++) {
                //  echo $id[$i];
                    $sql = "SELECT * FROM `user` 
                    WHERE `id` = ? 
                    ORDER BY `id`;";
                  
                    $stmt = $db -> prepare($sql);
                    $stmt -> execute([$id[$i]]);  

                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        if($row['login'] !== "author" && $row['text'] == NULL) {
                            $row['text'] = "Commentator";
                        } elseif ($row['login'] == "author" && $row['text'] == NULL) {
                            $row['text'] = "Author";
                        } 
                    ?>
                    <div class="row direc align__items__center gap10 relative0 mtb30">

                      <div class="w-200 card__info">
                          <div class="row direc align__items__center gap__nav">

                        <?php if($row['image'] == NULL){ ?>
                            <img class="avatar" src="images/avatar.png" alt="">
                          <?php } else {?>
                            <img class="avatar" src="uploads_images/<?= $row['image'] ?>" alt="">
                        <?php } ?>
                            <!-- <div> -->
                              <p class="author">By <?= $row['name'] ?></p>
                              <p class="card__text"><?= $row['text'] ?></p>
                            <!-- </div> -->
                            <ul class="row gap__soc soc">
                              <li><a href="#"><img src="images/article/f.png" alt=""></a></li>
                              <li><a href="#"><img src="images/article/t.png" alt=""></a></li>
                              <li><a href="#"><img src="images/article/p.png" alt=""></a></li>
                              <li><a href="#"><img src="images/article/be.png" alt=""></a></li>
                            </ul> 
                          </div> 
                      </div>

                      <div >
                        <button type="button" class="author-del lk__del btn-open">Delete</button>
                       <!-- диалоговое окно удаления статьи -->
                        <div class="wrapper-modal">
                            <div class="modal-window user">
                                <div>
                                    Do you really want to delete the article?
                                </div>
                                <div>
                                    <button class="btn-close">No</button>
                                    <a href="include/delete_user.php?id=<?= $id[$i] ?>&image=<?= $row['image'] ?>"><button class="del">Delete</button></a>
                                </div>
                            </div>   
                        </div>
                        <!--  -->
                        </div>
                    </div>  
                        <?php } } } ?> 
                 
                </div> 
            </div>
        </div>
    </div>
</section>
    
<!-- подключение футера  -->
<!-- с помощью PDO -->
<?php 
  $stmt = $db -> query("SELECT * FROM `footer`");
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
    <?php include_once("include/footer.php") ?>
  <?php } ?> 


<script type="text/javascript">
// диалоговое окно
const btnOpen = document.querySelectorAll('.btn-open');
const btnClose = document.querySelectorAll('.btn-close');
const modal = document.querySelectorAll('.wrapper-modal');

for (let i = 0; i < btnOpen.length; i++) {
    btnOpen[i].onclick = () => {
        modal[i].classList.add('active');
        btnClose[i].onclick = () => {
            modal[i].classList.remove('active')
        }
    }
 }
  </script>
</body>
</html>