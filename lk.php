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
    <div class="row align__items__center bread">
      <ul>
        <li class="bread__item"><a class="bread__link" href="index.php?nav=Home">Home</a></li>
        <li class="bread__item">></li>
        <li class="bread__item"><p>Personal account</p></li>
      </ul>
    </div>

    <div class="row justify__content__around gap40">  
        <div>
          <?php include('include/about.php'); ?>
        </div>

        <?php
            if($rights == "user"){ 
        ?>
        <div class="col-75">
          <ul class="row gap10 lk__list">
            <li><a class="lk__link lk__link__active" href="lk.php">Articles</a></li>
            <li><a class="lk__link" href="lk-add.php">Add an article</a></li>
            <li><a class="lk__link" href="lk-about.php?id=<?= $user ?>">About</a></li>
          </ul>   
          <div class="row mlr">
          <?php      
                $sql = "SELECT t1.id, t1.title, t1.subtitle, t1.date, t1.likes, t1.glass, t1.image, t1.image2, t1.user_id, t1.pick,
                 t3.name AS category 
                FROM project t1 
                JOIN category t3 ON (t1.category_id = t3.id) 
                WHERE t1.user_id = ? AND t1.pick = ?
                ORDER BY t1.date DESC;";

                $stmt = $db -> prepare($sql);
                $stmt -> execute([$user, 0]);
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          ?>
<div class="col-3 card relative">
<div onclick="location.href='article.php'+'?id=<?php echo $row['id'] ?>&local='+ storage;">
  <div class="card__img">
    <img src="uploads_images/<?= $row['image'] ?>" alt="">
    <span class="categ card__categ"><?= $row['category'] ?></span>
  </div>
  <div class="card__info">
    <p class="card__text"><?= implode('.', array_reverse(explode('-', $row['date']))) ?></p>
    <div class="overflow">
      <h2 class="card__h"><?= $row['title'] ?></h2>
      <p class="card__text"><?= $row['subtitle'] ?></p>
    </div>
  </div>
</div>

  <div class="act">
    <div class="row justify__content__between align__items__center">
      <div>
        <a class="lk__ed" href="lk-edit.php?id=<?= $row['id'] ?>">Edit</a>
        <!-- диалоговое окно удаления статьи -->
        <span class="lk__del btn-open">Delete</span>

        <div class="wrapper-modal">
            <div class="modal-window">
                <div>
                    Do you really want to delete the article?
                </div>
                <div>
                    <button class="btn-close">No</button>
                    <a href="admin/delete/project.php?id=<?= $row['id'] ?>&image=<?= $row['image'] ?>&image2=<?= $row['image2'] ?>"><button class="del">Delete</button></a>
                </div>
            </div>   
        </div>
        <!--  -->

      </div>
      <div>
        <ul>
          <li class="proect__like"><?= $row['likes'] ?></li>
          <li class="proect__glass"><?= $row['glass'] ?></li>
        </ul>
      </div>
    </div>                  
  </div>                       
</div>
<?php }} ?>
  
       
      <?php
        if($rights == "admin"){
      ?>
        <div class="col-100">
          <ul class="row gap10 lk__list">
            <li><a class="lk__link" href="lk-articles.php">Articles</a></li>
            <li><a class="lk__link lk__link__active" href="">Check</a></li>
            <li><a class="lk__link" href="lk-comment.php">Comments</a></li>
            <li><a class="lk__link" href="lk-users.php">Users</a></li>
            <li><a class="lk__link" href="lk-contact.php">Contacts</a></li>
            <li><a class="lk__link" href="lk-subscribe.php">Subscribe</a></li>
            <li><a class="lk__link" href="lk-add.php">Add an article</a></li>
            <li><a class="lk__link" href="lk-about.php?id=<?= $user ?>">About</a></li>
          </ul>    
          <div class="row mlr">
          <?php   
                    $sql = "SELECT t1.id, t1.image, t1.image2, t1.date, t1.title, t1.subtitle, t2.text, t1.likes, t1.glass, t1.check,
                    t2.image AS userimage, t2.name AS username, t3.name AS category 
                    FROM project t1 
                    JOIN user t2 ON (t1.user_id = t2.id)
                    JOIN category t3 ON (t1.category_id = t3.id) 
                    WHERE t1.check = ?
                    ORDER BY t1.date DESC;";
                    
                    $stmt = $db -> prepare($sql);
                    $stmt -> execute([0]);
                     while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                    
  <div class="col-4 card relative">
  <div onclick="location.href='article.php'+'?id=<?php echo $row['id'] ?>&local='+ storage;">                   
    <div class="card__img">
      <img src="uploads_images/<?= $row['image'] ?>" alt="">
      <span class="categ card__categ"><?= $row['category'] ?></span>
    </div>
    <div class="card__info">
      <p class="card__text"><?= implode('.', array_reverse(explode('-', $row['date']))) ?></p>
      <div class="overflow">
        <h2 class="card__h"><?= $row['title'] ?></h2>
        <p class="card__text"><?= $row['subtitle'] ?></p>
      </div>
      <hr class="card__hr">
      <div class="row0 align__items__center gap__nav">
        <img class="avatar" src="uploads_images/<?= $row['userimage'] ?>" alt="">
        <div>
          <p class="author">By <?= $row['username'] ?></p>
          <p class="card__text"><?= $row['text'] ?></p>
        </div>
      </div>
    </div>
  </div> 

    <div class="act">
      <div class="row justify__content__between align__items__center">
        <div>
          <a class="lk__ed" href="lk-edit.php?id=<?= $row['id'] ?>">Edit</a>
 <!-- диалоговое окно удаления статьи -->
          <span class="lk__del btn-open">Delete</span>

          <div class="wrapper-modal">
              <div class="modal-window">
                  <div>
                      Do you really want to delete the article?
                  </div>
                  <div>
                      <button class="btn-close">No</button>
                      <a href="admin/delete/project.php?id=<?= $row['id'] ?>&image=<?= $row['image'] ?>&image2=<?= $row['image2'] ?>"><button class="del">Delete</button></a>
                  </div>
              </div>   
          </div>
    <!--  -->

        </div>
        <div>
          <ul>
            <li class="proect__like"><?= $row['likes'] ?></li>
            <li class="proect__glass"><?= $row['glass'] ?></li>
          </ul>
        </div>
      </div>                  
    </div>                       
  </div>
      <?php }} ?> 
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
// localStorage
var storage = localStorage.getItem('key'); 

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