<?php 
    session_start();
    $user = isset($_SESSION['user']['id']);
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

    <section class="form form__image-aut">
        <div class="container">
            <div class="row justify__content__center form__shadow">
                <div class="form__block">
                    <div class="container">
                        <h2 class="form__title">Welcome!</h2>
                        <p class="form__subtitle">If you want to place your blog on our website write to us! </p>

                        <form enctype="multipart/form-data" method="post" action="include/contact.php">
                            <input class="form__input" type="email" name="email" placeholder="Email*" required>
                            <textarea class="form__input" name="text" cols="30" rows="10" placeholder="What kind of blog do you want to post?*" required></textarea>
                            <input class="form__btn" type="submit" value="Send">
                        </form>
                        <?php 
                            if(isset( $_SESSION['message'])){
                            echo '<p class="form__polit0">' . $_SESSION['message'] . '</p>';
                            }
                            unset( $_SESSION['message']);
                        ?>
                        <p class="form__polit2">By clicking on the button you agree to the privacy policy</p>
                    </div>        
                </div>
                <div class="col-aut form__image-aut"></div>
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

</body>
</html>