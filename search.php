<?php 
  session_start();
  include_once("config/db.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/flex.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/nav.css">
    <script defer>
      // localStorage
      var storage = localStorage.getItem('key');   
    </script>    
</head>
<body>
    <header>
        <?php include('include/nav.php'); ?>
    </header> 

  <main>
    <section class="topics">
      <div class="container">
     
        <p class="p">Found according to your request</p>
        <ul class="mtb30">
            <li><a href="all_articles.php?nav=Articles" class="categ__link active">All articles</a></li>
        </ul>

      <div class="row mlr">      
<!-- подключение карточки -->	
        <?php 
    $search = $_POST["search"];
    $search_date = implode('-', array_reverse(explode('.', $search)));

        $sql ="SELECT t1.id, t1.image, t1.date, t1.title, t1.subtitle, t1.text, t1.text2,
        t2.text, t2.image AS userimage, t2.name AS username, t2.text, t3.name AS category 
        FROM project t1 
        JOIN user t2 ON (t1.user_id = t2.id)
        JOIN category t3 ON (t1.category_id = t3.id) 
        WHERE (t1.title LIKE ? || t1.subtitle LIKE ? || t1.text LIKE ? || t1.text2 LIKE ? || t1.date LIKE ? || t2.name LIKE ? || t2.text LIKE ?) AND t1.check = ?
        ORDER BY t1.id;";
    
        $stmt = $db -> prepare($sql);
        $stmt -> execute(["%$search%","%$search%","%$search%","%$search%","%$search_date%","%$search%","%$search%",1]);
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        ?>
  
  <div class="col-4 card link" onclick="location.href='article.php'+'?id=<?php echo $row['id'] ?>&local='+ storage;">
    <div class="card__img">
      <a><img src="uploads_images/<?= $row['image'] ?>" alt=""></a>
      <a class="categ card__categ"><?= $row['category'] ?></a>
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
 <?php } ?>

      </div>
      </div>   
    </section>
  </main>
      
<!-- подключение футера  -->
<!-- с помощью PDO -->
<?php 
  $stmt = $db -> query("SELECT * FROM `footer`");
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
    <?php include_once("include/footer.php") ?>
  <?php } ?> 

<script src="main.js"></script> 
<script type="text/javascript">
  const search = document.getElementById('search'),    
      form = document.getElementById('search_input');

      search.addEventListener('click', () => {
      form.classList.toggle('none'); 
    }) 
</script> 
     
</body>
</html>