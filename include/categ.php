<?php
 include_once("../config/db.php");

 $id=$_POST['cat'];

  if($id==NULL)exit();

if($id == 0)
    {
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

    } elseif ($id == '-1') { 
        $sql = "SELECT t1.id, t1.image, t1.date, t1.title, t1.subtitle, t1.pick, t1.check, t2.text, t2.image AS userimage, 
        t2.name AS username, t3.name AS category 
        FROM project t1 
        JOIN user t2 ON (t1.user_id = t2.id)
        JOIN category t3 ON (t1.category_id = t3.id) 
        WHERE t1.pick = ? AND t1.check = ?
        ORDER BY t1.date DESC;";

            $stmt = $db -> prepare($sql);
            $stmt -> execute([0, 1]);	
    } else {
        $sql = "SELECT t1.id, t1.image, t1.date, t1.title, t1.subtitle, t1.pick, t1.check, t2.text, t2.image AS userimage, 
        t2.name AS username, t3.name AS category 
        FROM project t1 
        JOIN user t2 ON (t1.user_id = t2.id)
        JOIN category t3 ON (t1.category_id = t3.id)
        WHERE t3.id = ? AND t1.pick = ? AND t1.check = ?
        ORDER BY t1.date DESC;";

        $stmt = $db -> prepare($sql);
        $stmt -> execute([$id, 0, 1]);
            }

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
        <div class="row align__items__center gap__nav">
            <img class="avatar" src="uploads_images/<?= $row['userimage'] ?>" alt="">
            <div>
                <p class="author">By <?= $row['username'] ?></p>
                <p class="card__text"><?= $row['text'] ?></p>
            </div>
        </div>
    </div>
</div>

<?php } ?> 