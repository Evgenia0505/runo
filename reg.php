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
            <div class="row justify__content__center">
                <div class="form__block">
                    <div class="container">
                        <h2 class="form__title">Welcome!</h2>
                        <p class="form__subtitle">Register to make full use of our resource.</p>

                        <form enctype="multipart/form-data" method="post" action="include/reg.php">
                        <div><input class="form__input" type="text" name="login" placeholder="Login"></div>
                            <div><input class="form__input" type="text" name="name" placeholder="Name*" required></div>
                            <div><input class="form__input" type="tel" name="phone" placeholder="Phone"></div>
                            <div><input class="form__input" type="email" name="email" placeholder="Email*" required></div>
                            <div><input class="form__input" type="password" name="password" placeholder="Password*" required></div>
                            <div><input class="form__input" type="password" name="repeat_password" placeholder="Repeat at password*" required></div>
                            <div>
                                <input type="hidden" name="MAX_FILE_SIZE" value="5000000"/>
                                <input class="form__input" type="file" name="avatar" placeholder="Your photo" accept=".png, .jpg, .jpeg">
                            </div>
                            
                            <div><input type="text" name="rights" value="user" style="display: none;"></div>
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
<!-- с помощью PDO -->
<?php 
  $stmt = $db -> query("SELECT * FROM `footer`");
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
    <?php include_once("include/footer.php") ?>
  <?php } ?> 

</body>
</html>