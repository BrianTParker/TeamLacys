<?php
include "header.php";
?>

<div class="row">
   <div class="col-sm-2 col-sm-offset-5">
        <div class="tabbable"> <!-- Only required for left/right tabs -->
                <ul class="nav nav-tabs">
                    <?php 
                    $pants_sql = $DBH->query("select id, name, description, image_location,price from products where age_category = 'adult' and gender_category = 'female' and article_category = 'pants'");
                    $shirts_sql = $DBH->query("select id, name, description, image_location,price from products where age_category = 'adult' and gender_category = 'female' and article_category = 'shirts'");
                    $skirts_sql = $DBH->query("select id, name, description, image_location,price from products where age_category = 'adult' and gender_category = 'female' and article_category = 'skirts'");
                    ?>
                    <li class="active"><a href="#Pants" data-toggle="tab">Pants</a></li>
                    
                    <li><a href="#Shirts" data-toggle="tab">Shirts</a></li>
                    
                    <li><a href="#Skirts" data-toggle="tab">Skirts</a></li>
                                
                </ul>
                
                <div class="tab-content">
                    
                    <div class="tab-pane active" id="Pants">
                    
                        <table class="table">
                        <?php
                        $pants_sql->setFetchMode(PDO::FETCH_ASSOC);
                        while($row = $pants_sql->fetch()) {
                            echo '<tr>' . "\n";
                            echo '<td><a href="./details.php?data=' . $row['id'] . '"><img src="' . $row['image_location'] . '"></a></td>' . "\n";
                            echo '<td><a href="./details.php?data=' . $row['id'] . '">' . $row['name'] . '</a></td>' . "\n";
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
                            echo '<td><a href="./details.php?data=' . $row['id'] . '"><img src="' . $row['image_location'] . '"></a></td>' . "\n";
                            echo '<td><a href="./details.php?data=' . $row['id'] . '">' . $row['name'] . '</a></td>' . "\n";
                            echo '</tr>' . "\n";
                        }
                        ?>                        
                        </table>
                    </div>
                    
                    <div class="tab-pane" id="SKirts">
                        <table class="table">
                        <?php
                        $skirts_sql->setFetchMode(PDO::FETCH_ASSOC);
                        while($row = $skirts_sql->fetch()) {
                            echo '<tr>' . "\n";
                            echo '<td><a href="./details.php?data=' . $row['id'] . '"><img src="' . $row['image_location'] . '"></a></td>' . "\n";
                            echo '<td><a href="./details.php?data=' . $row['id'] . '">' . $row['name'] . '</a></td>' . "\n";
                            echo '</tr>' . "\n";
                        }
                        ?>                        
                        </table>
                    </div>
                </div>
                
                
        </div>
    </div>
</div>
<br/><br/><br/><br/>

<?php
include "footer.php";
?>