<?php  
  session_start();
  include_once("config/db.php");
  $id = $_GET["id"];

  $_SESSION['project_id'] = $_GET["id"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/flex.css">
    <link rel="stylesheet" href="css/main.css">  
    <link rel="stylesheet" href="css/article.css">
</head>
<body>
  <header class="header">
<!-- подключение nav  -->
    <?php include_once("include/nav.php") ?>

    <div class="header__text2">
      <div class="container2">
        <div class="header__block2">
          <?php
          $sql="SELECT t1.id, t1.title, t1.subtitle, t1.text, t1.text2, t1.date, t1.likes, t1.glass, t1.time, t1.image, t1.image2, 
          t2.image AS userimage, 
          t2.name AS username, 
          t2.text AS usertext,
          t3.name AS category 
          FROM project t1 
          JOIN user t2 ON (t1.user_id = t2.id)
          JOIN category t3 ON (t1.category_id = t3.id) 
          WHERE t1.id = ?;";

          $stmt = $db -> prepare($sql);
          $stmt -> execute([$id]);
          $row = $stmt->fetch(PDO::FETCH_ASSOC); 

          $date = $row['date'];
          $like = $row['likes'];
          $glass = $row['glass'] + 1 ; 

          $update = $db->prepare("UPDATE project SET `glass` = ? WHERE id = ?");
          $update->execute([$glass, $id]);
        ?>
          <a class="categ"><?= $row['category'] ?></a>      
          <h1 class="header__block2 header__title"><?= $row['title'] ?></h1>
          <h2 class="header__sub header__subtitle"><?= $row['subtitle'] ?></h2>
          <p class="header__p">By <?= $row['username'] ?></p>
        </div>
      </div>
    </div>
  </header>

  <main>
    <section class="article row">

      <div class="container row align__items__center">
          <p class="article__data"><?= implode('.', array_reverse(explode('-', $row['date']))) ?></p>
          <hr class="article__hr">
          <p class="article__data"><?= $row['time'] ?>  minutes</p> 
      </div>   
  
      <div class="container2 top"> 
        <p class="article__p"><?= $row['text'] ?></p>

        <div class="row justify__content__between mtb">
          <div class="col-2">
            <img class="card__img  h300" src="uploads_images/<?= $row['image'] ?>" alt="">
          </div>
          <div class="col-2">
            <img class="card__img  h300" src="uploads_images/<?= $row['image2'] ?>" alt="">
          </div>
        </div>
    
        <p class="article__p">
          Efficiently empower seamless meta-services with impactful opportunities. Distinctively transition virtual outsourcing with focused e-tailers.
        </p>
        <br>
       <blockquote>
        “ Monotonectally seize superior mindshare <br> rather than efficient technology. ” 
       </blockquote><br>
        <p class="article__p">
          <?= $row['text2'] ?>
        </p>

        <div class="row justify__content__between align__items__end gap18">
          <div class="row gap10">
            <a href="#" class="article__categ">ADVENTURE</a> 
            <a href="#" class="article__categ">PHOTO</a> 
            <a href="#" class="article__categ">DESIGN</a> 
          </div>

<!-- like and dislike -->
          <?php
          if (!isset($_SESSION['liked']) && isset($_GET['local'])){
              $_SESSION['liked'] =  explode(",", $_GET['local']);
          }
          //var_dump($_SESSION['liked']);
          // echo "Значение GET-переменной: ". $_GET['local'];
          // echo "<br>Значение сессии: ". implode(',', $_SESSION['liked']) . '<br>';

            if (!isset($_POST['like']) && (!isset($_SESSION['liked']) || !in_array("$id", $_SESSION['liked']))){ 
          ?>
            <form enctype="multipart/form-data" method="post" action="#like">
              <span class="article__like">Click if you like it!</span>
              <button type="submit" name="like"><img id="like" src="images/article/heart.png" alt=""></button>
            </form>
          <?php
          } elseif (!isset($_POST['like']) && in_array("$id", $_SESSION['liked'])){ 
          ?>
            <form enctype="multipart/form-data" method="post" action="#like">
                <span class="article__like">Click if you don't like it anymore!</span>
                <button type="submit" name="like"><img id="like" src="images/article/heart1.png" alt=""></button>
              </form>
          <?php   
          } elseif (isset($_POST['like'])){
            if(isset($_SESSION['liked']) && in_array("$id", $_SESSION['liked'])){
              $like = $like - 1;          // dislike
              $update = $db->prepare("UPDATE project SET `likes` = ? WHERE id = ?");
              $update->execute([$like, $id]);

        // удаляем из массива $id; array_diff возвращает значения из массива $_SESSION['liked'], которые отсутствуют в массиве [$id]
              $_SESSION['liked'] = array_diff($_SESSION['liked'], [$id]); // Сессии присваиваем значение расхождение массивов, которое выкинуло $id из сессии, но сессия оставалась прежней! 
              //  echo implode(',', $_SESSION['liked']); 
          ?> 
          <!-- localStorage -->
          <script type="text/javascript">
            localStorage.setItem('key', [<?php echo implode(',', $_SESSION['liked']); ?>].join());
         // alert(localStorage.getItem('key')); 
          </script> 
          <form enctype="multipart/form-data" method="post" action="#like">
            <span class="article__like">Click if you like it!</span>
            <button type="submit" name="like"><img id="dislike" src="images/article/heart.png" alt=""></button>
          </form>

          <?php  } else {                 // like
              $like = $like + 1;
              $update = $db->prepare("UPDATE project SET `likes` = ? WHERE id = ?");
              $update->execute([$like, $id]);

              if(!isset($_SESSION['liked'])) {  //проверяем, чтобы сессия добавляла не ОДНО значение $id, а $id ВСЕХ статей! 
                    $_SESSION['liked'] = [];
              }
              // добавляем в массив $id
                 array_push($_SESSION['liked'], $id);
              // echo implode(',', $_SESSION['liked']); 
          ?> 
              <!-- localStorage -->
              <script type="text/javascript"> 
                 localStorage.setItem('key', [<?php echo implode(',', $_SESSION['liked']); ?>].join());
              // alert(localStorage.getItem('key'));
              </script> 
              <form enctype="multipart/form-data" method="post" action="#like">
                <span class="article__like">Click if you don't like it anymore!</span>
                <button type="submit" name="like"><img id="like" src="images/article/heart1.png" alt=""></button>
              </form>
    <?php }}  ?>   
        </div>
      
        <hr class="article__hr2">

        <div class="row justify__content__between align__items__center gap__nav">
          <div class="row align__items__center gap__nav">
            <div>
              <img class="avatar" src="uploads_images/<?= $row['userimage'] ?>" alt="">
            </div>
            <div>
              <p class="author">By <?= $row['username'] ?></p>
              <p class="card__text"><?= $row['usertext'] ?> </p>
       
            </div>
          </div>
         
          <ul class="row gap__soc">
            <li><a href="#"><img src="images/article/f.png" alt=""></a></li>
            <li><a href="#"><img src="images/article/t.png" alt=""></a></li>
            <li><a href="#"><img src="images/article/p.png" alt=""></a></li>
            <li><a href="#"><img src="images/article/be.png" alt=""></a></li>
          </ul>
        </div>
      </div> 

<!-- комментарии -->    
<div class="comment">
    <h3 id="write">Comments</h3>
    <form action="include/comment.php" method="post">
      <textarea name="review" class="review" placeholder="Sigh up or Log in before you write comments!" cols="" rows="5"></textarea>
      
      <!-- <input type="hidden" name="project_id" value="<?= $id ?>"> -->
      <?php 
            if(isset( $_SESSION['message'])){
            echo '<p class="form__polit">' . $_SESSION['message'] . '</p>';
            }
            unset( $_SESSION['message']);
		  ?>
      <button type="submit">Add comments</button>
    </form>

        <?php
            echo '<ul>';

            $query = $db->query('SELECT comment.id AS id, comment.project_id AS project_id, comment.user_id AS user_id, comment.date  AS `date`, comment.text AS `text`, 
            user.name AS `name` FROM comment JOIN user ON (comment.user_id = user.id) ORDER BY comment.id DESC');

            while ($row = $query->fetch(PDO::FETCH_OBJ)) {
              if($row -> project_id == $id){
                echo '<li><b>' . $row-> date . '<br>' . $row-> name .'</b><br>' . $row-> text . '</li>';
              
            // Если сессия не установлена кнопки "Удалить" не отображаются
                if(!isset($_SESSION['user']['id'])) {
                  echo '';
                }
            // Авторизованные пользователи могут удалять только свои комментарии - на них есть кнопка "Удалить"
                elseif($row-> user_id === $_SESSION['user']['id']) {
                    echo '<a href="include/delete_comm.php?comm_id=' . $row-> id . '"><button>Delete</button></a>';
                } 
            } 
          }
            echo '</ul>';
        ?>
    </div>
    </section> 

    <section class="posts row">
      <div class="container">
        <p class="posts__card__h">Related Posts</p>
     
        <div class="row mlr">
<!-- подключение Related Posts карточки -->	
<?php 
        $sql = "SELECT t1.id, t1.image, t1.title, t1.subtitle, t1.date, t3.name AS category 
        FROM project t1 
        JOIN category t3 ON (t1.category_id = t3.id) 
        WHERE t1.date = ? AND t1.id != ?
        ORDER BY t1.id;";

        $stmt = $db->prepare($sql); 
        $stmt->execute([$date, $id]);  
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        ?>
          <div class="col-4 card" onclick="location.href='article.php'+'?id=<?php echo $row['id'] ?>&local='+ storage;">
            <div class="card__img">
              <img class="round" src="uploads_images/<?= $row['image'] ?>" alt="">
              <span class="categ card__categ"><?= $row['category'] ?></span>
            </div>
            <p class="posts__card__text"><?= implode('.', array_reverse(explode('-', $row['date']))) ?></p>
            <div class="overflow">
              <h2 class="card__h"><?= $row['title'] ?></h2>
              <p class="card__text"><?= $row['subtitle'] ?></p>
            </div> 
          </div>
          <?php } ?>

        </div>
      </div>
    </section>      
  </main>

<!-- подключение футера  -->
<?php 
  $stmt = $db -> query("SELECT * FROM `footer`");
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
    <?php include_once("include/footer.php") ?>
  <?php } ?> 
  
<script type="text/javascript">
  const dislike = document.getElementById('dislike'),
        like = document.getElementById('like'),
        btn = document.querySelector('[name="like"]');

        btn.addEventListener('click', () => {
        dislike.src = "images/article/heart1.png";
        })

  // localStorage
  var storage = localStorage.getItem('key');   
</script>

</body>
</html>
