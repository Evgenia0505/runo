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
</head>

<body>

  <header class="slider-wrapper">
    <?php include_once("include/nav.php") ?>

  <?php 
    $sql = "SELECT t1.id, t1.image, t1.image2, t1.image3, t1.title, t1.date, t1.subtitle, t1.pick, t2.name 
    FROM project t1 
    JOIN category t2 ON (t1.category_id = t2.id)
    WHERE t1.pick = ?;";

  $stmt = $db -> prepare($sql);
  $stmt -> execute([1]);
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
<div class="pointer" onclick="location.href='article.php'+'?id=<?php echo $row['id'] ?>&local='+ storage;">
    <!-- slider -->
<div class="slide active">
  <img src="uploads_images/<?= $row['image'] ?>" alt="">
</div>
<div class="slide">
 <img src="uploads_images/<?= $row['image2'] ?>" alt="">
</div>
<div class="slide">
  <img src="uploads_images/<?= $row['image3'] ?>" alt="">
</div>

<div class="header__text">
  <div class="container">
    <div>
        <span class="categ"><?= $row['name'] ?></span>
    </div>
    <div class="header__block">
        <h1 class="header__title"><?= $row['title'] ?></h1>
    </div>
    <div class="header__block">
        <h2 class="header__subtitle row0">
          <?= implode('.', array_reverse(explode('-', $row['date']))) ?> 
        <hr class="hr__subtitle">
        <div>
        <?= $row['subtitle'] ?>
        </div>
        </h2>
    </div>
  </div>
</div>
<div class="container">
    <!-- slider -->
    <div class="dots-wrapper">
        <span class="dot active"></span>
        <span class="dot"></span>
        <span class="dot"></span>
    </div>
</div>
  <?php } ?> 

  </div>
  </header>

  <main>
    <section class="topics" >
      <div class="container" id="result">

          <p class="p">Our authors</p>
          <p class="mtb30 categ__link active">You can look at articles by any author</p>
  
        <div class="row justify__content__between gap18">      
<!-- подключение карточки автора-->	
        <?php 
        $user_id = [];
        $authors = [];

        $sql ="SELECT `user_id`
        FROM `project`
        WHERE `check` = ? ;";
        $data = $db ->  prepare($sql);
        $data -> execute([1]);
        while($row0 = $data->fetch(PDO::FETCH_ASSOC)) { 
          // echo $row0['user_id'] . '<br>'; 
         array_push($user_id, $row0['user_id']);
    }

        $sql1 ="SELECT `id`, `login`
        FROM `user` 
        WHERE `id` > ? AND `login` = ? ;";
        $data = $db -> prepare($sql1);
        $data -> execute([1, 'author']);
        while($row1 = $data->fetch(PDO::FETCH_ASSOC)) { 
          // echo $row1['id'] . '<br>'; 
        array_push($authors, $row1['id']);
    }
     
        $id0 = array_diff($authors, $user_id); // получаем авторов у которых нет ни одной созданной или проверенной статьи
        $id2 = array_diff($authors, $id0); // только те авторы, у которых есть хотя бы одна проверенная опубликованная статья

        for ($i = 0; $i < count($id2); $i++) {
        //  echo $id2[$i] . '<br>';
        
        $sql = "SELECT t2.id, t2.image, t2.name, t2.text
        FROM `user` t2
        WHERE t2.id = ?;";

        $stmt = $db -> prepare($sql);
        $stmt -> execute([ $id2[$i]]);  
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        ?> 
          <div class="w-200 card card__info" onclick="getCat(<?= $row['id'] ?>)">
           
              <div class="row direc align__items__center gap__nav">
                <img class="avatar" src="uploads_images/<?= $row['image'] ?>" alt="">
                <!-- <div> -->
                  <p class="author">By <?= $row['name'] ?></p>
                  <p class="card__text"><?= $row['text'] ?></p>
                <!-- </div> -->
                <ul class="row gap__soc">
                  <li><a href="#"><img src="images/article/f.png" alt=""></a></li>
                  <li><a href="#"><img src="images/article/t.png" alt=""></a></li>
                  <li><a href="#"><img src="images/article/p.png" alt=""></a></li>
                  <li><a href="#"><img src="images/article/be.png" alt=""></a></li>
                </ul>  
              </div>
          </div>
        <?php } } ?> 
        </div>
        
        <div class="row direc align__items__center gap30">
          <h2 class="center">Join our team to be a part of our story! </h2>
          <p class="center card__text ">
            Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem<br> ipsum dolor sit amet consectetur adipisicing elit. Vitae.
          </p>
          <a class="join" href="contact.php?nav=Contact Us">JOIN NOW</a> 
        </div>

      </div>   
    </section>

    <!-- подключение img big -->	
    <?php 
        $sql = "SELECT t1.id, t1.image, t1.date, t1.title, t1.subtitle, t1.pick, 
        t3.name AS category 
        FROM project t1 
        JOIN category t3 ON (t1.category_id = t3.id) 
        WHERE t1.pick = ?;";

        $stmt = $db -> prepare($sql);
        $stmt -> execute([2]);
         $row = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>
    <div class="img row direc align__items__center" onclick="location.href='article.php'+'?id=<?php echo $row['id'] ?>&local='+ storage;">
      <img src="uploads_images/<?= $row['image'] ?>" alt="">

      <div class="img__block0 row direc align__items__center">
        <p><span class="categ"><?= $row['category'] ?></span></p>

        <div class="img__block">
          <h2 class="img__title"><?= $row['title'] ?></h2>
        </div>  
        <div class="img__subtitle">
          <p class="header__subtitle"><?= $row['subtitle'] ?></p>
        </div> 

        <hr class="img__hr">
        <p class="img__data"><?= implode('.', array_reverse(explode('-', $row['date']))) ?></p>
      </div>
    </div>

    <section class="pick">
      <div class="container">
        <p class="p">Editor’s Pick</p>
        <div class="row justify__content__between">

<!-- подключение Editor’s Pick  карточки -->	
        <?php 
        $sql = "SELECT t1.id, t1.image, t1.date, t1.title, t1.subtitle, t1.pick, t3.name AS category 
        FROM project t1 
        JOIN category t3 ON (t1.category_id = t3.id) 
        WHERE t1.pick BETWEEN ? AND ?;";

          $stmt = $db -> prepare($sql);
          $stmt -> execute([3, 4]);
         while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        ?>
          <div class="col-2 card2" onclick="location.href='article.php'+'?id=<?php echo $row['id'] ?>&local='+ storage;">
            <div class="card__img">
              <img src="uploads_images/<?= $row['image'] ?>" alt="">

              <div class="card__categ">
                <span class="categ"><?= $row['category'] ?></span>
                <span class="categ">FASHION</span>
              </div>

              <div class="pick__text">
                <p class="img__data"><?= implode('.', array_reverse(explode('-', $row['date']))) ?></p>
                <h2 class="section2__title"><?= $row['title'] ?></h2> 
                <p class="header__subtitle"><?= $row['subtitle'] ?></p>          
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
  // AJAX 
	function getCat(cat)
	{
		if (cat==""){
			document.getElementById('result').innerHTML="";
			return;
		}
		if (window.XMLHttpRequest) 
			ao=new XMLHttpRequest();
		else 
			ao=new ActiveXObject('Microsoft.XMLHTTP');
		ao.onreadystatechange=function()
		{
			if (ao.readyState==4 && ao.status==200)
				document.getElementById('result').innerHTML=ao.responseText;
		}
		ao.open('post','author_articles.php',true);
		ao.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		ao.send("cat="+cat);
	}
   // localStorage
   var storage = localStorage.getItem('key'); 
</script>

</body>
</html>