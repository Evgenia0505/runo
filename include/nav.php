<?php
  include_once("config/db.php");
?>
<nav class="nav">
  <div class="container">
    <div class="row justify__content__between align__items__center h80">
      
      <ul class="row gap10 align__items__center nav__lk">
        <li><a href="index.php?nav=Home" class="logo">RUNO</a></li>

          <?php 
                if(isset($_SESSION['user']['rights'])=='user' || isset($_SESSION['user']['rights'])=='admin') {
          ?>
            <li><a href="config/logout.php" class="nav__link0">Exit</a></li>
            <li><a href="lk.php" class="nav__link0">Profile</a></li>

            <?php  } elseif(isset($_SESSION['user']['id'])) { ?>
            <li><a href="config/logout.php" class="nav__link0">Exit</a></li>

            <?php  } else { ?>
          <li><a href="reg.php" class="nav__link0">Sign up</a></li>
          <li><a href="aut.php" class="nav__link0">Log in</a></li>
        <?php } ?>
      </ul>

      <input id="check" type="checkbox">
      <label class="menu-icon" for="check">
        <img src="images/menu.png" class="delete" alt="">
      </label>

    <?php 
      $stmt = $db -> query("SELECT * FROM `nav`");
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    ?>  
      <div class="burger">
        <ul class="row gap__nav align__items__center"> 
        <!-- вначале проверяем передана ли $_GET["nav"], чтобы не было предупреждений! -->
        <?php if (!isset($_GET["nav"]) || $_GET["nav"] != $row['nav1']) { ?>
          <li><a href="index.php?nav=<?= $row['nav1'] ?>" class="nav__link "><?= $row['nav1'] ?></a></li>
          <?php } elseif ($_GET["nav"] == $row['nav1']) { ?>
          <li><a href="index.php?nav=<?= $row['nav1'] ?>" class="nav__link nav__active"><?= $row['nav1'] ?></a></li>
          <?php } ?>
    
          <?php if (!isset($_GET["nav"]) || $_GET["nav"] != $row['nav2']) { ?>  
          <li><a href="about_us.php?nav=<?= $row['nav2'] ?>" class="nav__link"><?= $row['nav2'] ?></a></li>
          <?php } elseif ($row['nav2'] == $_GET["nav"]) { ?>
          <li><a href="about_us.php?nav=<?= $row['nav2'] ?>" class="nav__link nav__active"><?= $row['nav2'] ?></a></li>
          <?php } ?>

          <?php if (!isset($_GET["nav"]) || $row['nav3'] != $_GET["nav"]) { ?>
          <li><a href="all_articles.php?nav=<?= $row['nav3'] ?>" class="nav__link"><?= $row['nav3'] ?></a></li>
          <?php } elseif ($_GET["nav"] == $row['nav3']) { ?>
          <li><a href="all_articles.php?nav=<?= $row['nav3'] ?>" class="nav__link nav__active"><?= $row['nav3']  ?></a></li>
          <?php } ?>

          <?php if (!isset($_GET["nav"]) ||  $row['nav4'] != $_GET["nav"]){ ?>
          <li><a href="contact.php?nav=<?= $row['nav4'] ?>" class="nav__link"><?= $row['nav4'] ?></a></li>
          <?php } elseif ($_GET["nav"] == $row['nav4']) { ?>
          <li><a href="contact.php?nav=<?= $row['nav4'] ?>" class="nav__link nav__active"><?= $row['nav4'] ?></a></li>
          <?php } ?>

          <li><hr class="nav__hr"></li>
          <li><a href="#"><img src="images/<?= $row['soc1'] ?>" alt=""></a></li>
          <li><a href="#"><img src="images/<?= $row['soc2'] ?>" alt=""></a></li>
          <li><a href="#"><img src="images/<?= $row['soc3'] ?>" alt=""></a></li>
          <li><a href="#"><img src="images/<?= $row['soc4'] ?>" alt=""></a></li>
          <li><a href="#"><img src="images/<?= $row['soc5'] ?>" alt=""></a></li>
          <li><hr class="nav__hr"></li>
          <li>
            <form id="search_input" class="none" enctype="multipart/form-data" method="post" action="search.php">
              <input type="search" name="search" placeholder="What are you search?" required>
              <button type="submit" name="btn_search"><img src="images/<?= $row['search'] ?>" alt=""></button>
            </form> 
          </li>
          <li>
            <button id="search" type="submit" name="btn_search"><img  src="images/<?= $row['search'] ?>" alt=""></button>
          </li>
        </ul>
      </div>
    <?php } ?> 
    </div>  
  </div>  
</nav> 

<script> 
const links = document.querySelectorAll('.nav__link');

  links.forEach((link) => {
      link.addEventListener('click', () => {
        link.classList.toggle('nav__active'); 
      })
    })

const search = document.getElementById('search'),    
      form = document.getElementById('search_input');

      search.addEventListener('click', () => {
      form.classList.toggle('none');
      search.classList.toggle('none');
    })
</script>