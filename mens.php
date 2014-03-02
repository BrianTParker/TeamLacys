<?php
include "header.php";
?>

<div class="row">
   <div class="col-sm-8 col-sm-offset-1">
        <div class="tabbable"> <!-- Only required for left/right tabs -->
                <ul class="nav nav-tabs">
                    <?php 
                    $pants_sql = $DBH->query("select id, name, description, image_location,price from products where age_category = 'adult' and gender_category = 'male' and article_category = 'pants'");
                    $shirts_sql = $DBH->query("select id, name, description, image_location,price from products where age_category = 'adult' and gender_category = 'male' and article_category = 'shirts'");
                    ?>
                    <li class="active"><a href="#Pants" data-toggle="tab">Pants</a></li>
                    
                    <li><a href="#Shirts" data-toggle="tab">Shirts</a></li>
                                
                </ul>
                
                <div class="tab-content">
                    
                    <div class="tab-pane active" id="Pants">
                    
                        <table class="table">
                        <?php
                        $pants_sql->setFetchMode(PDO::FETCH_ASSOC);
                        while($row = $pants_sql->fetch()) {
                            echo '<tr>' . "\n";
                            echo '<td><img src="' . $row['image_location'] . '"/></td>' . "\n";
                            echo '<td>' . $row['name'] . '</td>' . "\n";
                            echo '<td>' . $row['description'] . '</td>' . "\n";
                            echo '<td>$' . $row['price'] . '</td>' . "\n";
                            echo '<td> <form method="POST" action="mens.php"> <button type="submit" class="btn btn-default">Add to cart</button>
                                <input type="hidden" name="id" value="' . $row['id'] . '"/> </form>' . "\n";
                            echo '</tr>' . "\n";
                        }
                        ?>                        
                        </table>
                    </div>
                    
                    <div class="tab-pane" id="Shirts">
                        <table class="table">
                        <?php
                        $shirts_sql->setFetchMode(PDO::FETCH_ASSOC);
                        while($row = $shirts_sql->fetch()) {
                            echo '<tr>' . "\n";
                            echo '<td><img src="' . $row['image_location'] . '"/></td>' . "\n";
                            echo '<td>' . $row['name'] . '</td>' . "\n";
                            echo '<td>' . $row['description'] . '</td>' . "\n";
                            echo '<td>$' . $row['price'] . '</td>' . "\n";
                            echo '<td> <form method="POST" action="mens.php"> <button type="submit" class="btn btn-default">Add to cart</button>
                                <input type="hidden" name="id" value="' . $row['id'] . '"/> </form>' . "\n";
                            echo '</tr>' . "\n";
                        }
                        ?>                        
                        </table>
                    </div>
                </div>
                
                
        </div>
    </div>
    
</div>
<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    if(!isset($_SESSION['firstName'])){
        header("location: login.php");
    }else{
        $id = $_POST['id'];
        array_push($_SESSION['cart'], $id);
    }
    
    
}
include "footer.php"
?>