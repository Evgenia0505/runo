<?php
                $sql = "SELECT * FROM `user` WHERE `id`=?;";
                $stmt = $db -> prepare($sql);
                $stmt -> execute([$user]);
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {        
        ?>    
                <div class="article__block">
                    <h2 class="article__name"><?=  $row['name'] ?></h2>
                    <img class="article__logo" src="uploads_images/<?=  $row['image'] ?>" alt="">
                    <p class="article__mintext"><?=  $row['text'] ?></p>
                </div>
        <?php } ?> 