<?php
include "header.php";
?>

<div class="row">
   <div class="col-sm-8 col-sm-offset-1">
        <div class="tabbable"> <!-- Only required for left/right tabs -->
                <ul class="nav nav-tabs">
                    <?php 
                    $sql = $DBH->query("select id, name, description, image_location,price from products where age_category = 'adult' and gender_category = 'male' and article_category = 'pants'");
                    ?>
                    <li class="active"><a href="#Pants" data-toggle="tab">Pants</a></li>
                    
                    <li><a href="#Shirts" data-toggle="tab">Shirts</a></li>
                                
                </ul>
                
                <div class="tab-content">
                    
                    <div class="tab-pane active" id="Pants">
                    
                    <table class="table">
                    <?php
                    $sql->setFetchMode(PDO::FETCH_ASSOC);
                    while($row = $sql->fetch()) {
                        echo '<tr>' . "\n";
                        echo '<td><img src="' . $row['image_location'] . '"/></td>' . "\n";
                        echo '<td>' . $row['name'] . '</td>' . "\n";
                        echo '<td>' . $row['description'] . '</td>' . "\n";
                        echo '<td>$' . $row['price'] . '</td>' . "\n";
                        echo '</tr>' . "\n";
                    }
                    ?>                        
                    </table>
                    </div>
                    
                    <div class="tab-pane" id="Shirts">
                        <ul>
                        <li>shirt 1</li>
                        <li>shirt 2</li>
                        <li>shirt 3</li>
                        </ul>
                    </div>
                </div>
                
                
        </div>
    </div>
    
</div>
<?php
include "footer.php"
?>