<?php 
  session_start();
  include_once("config/db.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Runo on adventure, travel, fashion, branding and technology.</title>
    <meta name="description" content="Runo is a blog about adventure, travel, fashion, branding and technology from famous authors.">

    <link rel="stylesheet" href="css/flex.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
  <header class="slider-wrapper">
<!-- подключение nav  -->
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
    <section class="topics">
      <div class="container">
     
        <p class="p">Popular topics</p>
        <div class="row justify__content__between align__items__center gap__categ mtb30">
        <ul class="row gap__categ">
        <li  class="categ__link active" data-categ="All" onclick="getCat('0')">All</li>

        <?php 
          $stmt = $db -> query("SELECT * FROM `category`");
          while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
             <li class="categ__link" data-categ="<?= $row['name'] ?>" onclick="getCat(<?= $row['id'] ?>)"><?= $row['name'] ?></li>
          <?php } ?>
          </ul>
          
          <div id="view" class="categ__link">View All</div>
        </div>

      <div class="row mlr" id="result">      
<!-- подключение карточки -->	
<!-- с помощью PDO -->    
        <?php 
        $sql = "SELECT t1.id, t1.image, t1.date, t1.title, t1.subtitle, t1.likes, t1.pick, t1.check, t2.text, t2.image AS userimage, 
        t2.name AS username, t3.name AS category 
        FROM project t1 
        JOIN user t2 ON (t1.user_id = t2.id)
        JOIN category t3 ON (t1.category_id = t3.id) 
        WHERE t1.pick = ? AND t1.check = ?
        ORDER BY t1.likes DESC
        LIMIT 8;";
        
          $stmt = $db -> prepare($sql);
          $stmt -> execute([0, 1]);
           while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        ?>

  <div class="col-4 card" onclick="location.href='article.php'+'?id=<?php echo $row['id'] ?>&local='+ storage;">
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

<?php } ?> 
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
        <p class="img__data"><?= implode('.', array_reverse(explode('-', $row['date']))) ?> </p>
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
		ao.open('post','include/categ.php',true);
		ao.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		ao.send("cat="+cat);
	}

  // categories && view
  const categ = document.querySelectorAll('.categ__link');
  const view = document.getElementById('view');

  categ.forEach(item => {
    item.addEventListener('click', event => {
      for (const item of categ) {
        item.classList.remove('active');
      }
      item.classList.add('active');
        view.innerHTML="View " + event.target.getAttribute('data-categ');
    })
  })
  // localStorage
  var storage = localStorage.getItem('key');   
</script>

</body>
</html>