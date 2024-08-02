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
            <li><a class="lk__link lk__link__active" href="">Comments</a></li>
            <li><a class="lk__link" href="lk-users.php">Users</a></li>
            <li><a class="lk__link" href="lk-contact.php">Contacts</a></li>
            <li><a class="lk__link" href="lk-subscribe.php">Subscribe</a></li>
            <li><a class="lk__link" href="lk-add.php">Add an article</a></li>
            <li><a class="lk__link" href="lk-about.php?id=<?= $user ?>">About</a></li>
          </ul>
              
          <div class="comment"> 

        <?php
            if($rights == "admin"){
             echo '<ul>';
                $query = $db->query('SELECT t1.id, t1.user_id, t1.date, t1.text AS `text`, t2.login,
                t2.name FROM comment t1 JOIN user t2 ON (t1.user_id = t2.id) ORDER BY t1.date DESC');

                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                  ?>
          <li><b><?= $row['date'] ?><br><?= $row['name'] ?></b><br><?= $row['text'] ?></li>

          <?php if($row['login'] == 'ban'){ ?>
            <a href=""><button type="button" class="red" data-user="<?= $row['user_id'] ?>" onclick="getUser(<?= $row['user_id'] ?>)">BAN</button></a>
         <?php  } else { ?>
            <button type="button" class="ban" data-user="<?= $row['user_id'] ?>" onclick="getUser(<?= $row['user_id'] ?>)">BAN</button>
          <?php } ?>

          <a href="include/delete_comm.php?comm_id=<?= $row['id'] ?>"><button type="button">Delete</button></a>

                <?php } echo '</ul>'; } ?>
      
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
const ban = document.querySelectorAll('.ban');
  // AJAX 
	function getUser(id)
	{
		if (id==""){
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
		ao.open('post','include/ban.php',true);
		ao.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		ao.send("id="+id);

    // если нажата одна из кнопок "BAN" комментатора, то все кнопки "BAN" этого пользователя становятся красными
    // ban.forEach(item => {
    //   // if (id==item.getAttribute('data-user')){
    //     if (id==item.dataset.user){
    //     item.classList.toggle('red');
    //   }
    // })	
	}

// если нажата одна из кнопок "BAN" комментатора, то все кнопки "BAN" этого пользователя становятся красными
ban.forEach(item => {
  item.addEventListener('click', event => {
      ban.forEach(item => {
    if(event.target.getAttribute('data-user') == item.getAttribute('data-user')){
      item.classList.toggle('red');
      }
    })
  })
})

  </script>
</body>
</html>