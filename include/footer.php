<?php
    if (isset($_POST["subscribe"]) && $_POST["email"] !== "") { 
        $email = $_POST["email"];
        try {
                $user = $db->prepare("INSERT INTO `subscribe` (`id`, `email`)
                VALUES (?, ?)");
                $user->execute([NULL, $email]);
                $_SESSION['message'] = 'You subscribe!';  
                    
        } catch (PDOException $e) {
            $_SESSION['message'] = 'This email already subscribes!';
        }
    } elseif (isset($_POST["subscribe"]) && $_POST["email"] == ""){
      $_SESSION['message'] = 'Write your email!';
      }
    
?>
<footer">
  <div class="footer__top">
    <div class="container row justify__content__between">

      <div class="col-23">
        <p class="footer__p">Contact the Publisher</p>
        <ul>
          <li><a class="img__data" href="mailto:<?= $row['email'] ?>" target="_blank"><?= $row['email'] ?></a></li>
          <li><a class="img__data" href="tel:<?= $row['phone'] ?>"><?= $row['phone'] ?></a></li>
        </ul>
      </div>
      <div class="col-23">
        <p class="footer__p">Explorate</p>
        <ul>
          <li><a class="img__data" href="#"><?= $row['expl1'] ?></a></li>
          <li><a class="img__data" href="#"><?= $row['expl2'] ?></a></li>
          <li><a class="img__data" href="#"><?= $row['expl3'] ?></a></li>
          <li><a class="img__data" href="#"><?= $row['expl4'] ?></a></li>
          <li><a class="img__data" href="#"><?= $row['expl5'] ?></a></li>
        </ul>
      </div>
      <div class="col-23">
        <p class="footer__p">Headquarter</p>
        <ul>
          <li><a class="header__subtitle" href="#"><?= $row['address'] ?></a></li>
        </ul>
      </div>
      <div class="col-23">
        <p class="footer__p">Connections</p>
        <ul class="row gap__soc">
          <li><a href="#"><img src="images/<?= $row['soc1'] ?>" alt=""></a></li>
          <li><a href="#"><img src="images/<?= $row['soc2'] ?>" alt=""></a></li>
          <li><a href="#"><img src="images/<?= $row['soc3'] ?>" alt=""></a></li>
          <li><a href="#"><img src="images/<?= $row['soc4'] ?>" alt=""></a></li>
          <li><a href="#"><img src="images/<?= $row['soc5'] ?>" alt=""></a></li>
        </ul>
      </div>    
    </div>  
  </div>

  <div id="footer" class="footer__bottom">
    <div class="container row justify__content__between gap18">
      <p>2021 | <a href="#">RUNO</a> Publisher Studio</p>

        <form id="subscribe" class="none" enctype="multipart/form-data" method="post" action="">
          <p class="fw400">Subscribe to our news letter to get latest updates and news</p>
          <input type="email" name="email" placeholder="Enter your Email">
          <input type="submit" name="subscribe" value="SUBSCRIBE">
        </form>
        <?php 
            if(isset( $_SESSION['message'])){
            echo '<p id="message" class="form__polit">' . $_SESSION['message'] . '</p>';
            }
            unset( $_SESSION['message']);  
		    ?>
        <p class="subscribe fw400"><a href="#footer">Subscribe Now</a></p>
    </div>
  </div>
</footer>

<script> 
const subscribe = document.querySelector('.subscribe'),
      message = document.getElementById('message'),     
      form_subs = document.getElementById('subscribe');

      subscribe.addEventListener('click', () => {
      form_subs.classList.toggle('none'); 
      message.classList.toggle('none'); 
    })
</script>