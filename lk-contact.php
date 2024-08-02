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
            <li><a class="lk__link" href="lk-users.php">Users</a></li>
            <li><a class="lk__link lk__link__active" href="">Contacts</a></li>
            <li><a class="lk__link" href="lk-subscribe.php">Subscribe</a></li>
            <li><a class="lk__link" href="lk-add.php">Add an article</a></li>
            <li><a class="lk__link" href="lk-about.php?id=<?= $user ?>">About</a></li>
          </ul>
              
          <div class="comment"> 
        <?php
            if($rights == "admin"){
                echo '<ul>';
                $query = $db->query('SELECT contact.date AS `date`, contact.email AS `email`, contact.text AS `text` FROM contact ORDER BY `date` DESC');
                
                while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                        echo '<li><b>' . $row-> date . '<br>' . $row-> email .'</b><br>' . $row-> text . '</li>';
                        // echo '<a href="https://account.mail.ru/" target="_blank"><button>Answer</button></a>';
                        echo '<a href="mailto:'.$row-> email.'" target="_blank"><button>Answer</button></a>';
                }
                  echo '</ul>';
            } ?>
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

</body>
</html>