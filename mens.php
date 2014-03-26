<?php
include "header.php";
?>
<div class="container-fluid">
<div class="row">
   <div class="col-sm-8 col-sm-offset-2">
        <div class="tabbable"> <!-- Only required for left/right tabs -->
                <ul class="nav nav-tabs">
                    <?php 
                    $pants_sql = $DBH->query("select id, name, description, image_location,price from products where age_category = 'adult' and gender_category = 'male' and article_category = 'pants'");
					$pants_count_sql = $DBH->query("select count(*) from products where article_category = 'pants'");
                    $shirts_sql = $DBH->query("select id, name, description, image_location,price from products where age_category = 'adult' and gender_category = 'male' and article_category = 'shirts'");
					$shirts_count_sql = $DBH->query("select count(*) from products where article_category = 'shirts'");
                    $belts_sql = $DBH->query("select id, name, description, image_location,price from products where age_category = 'adult' and gender_category = 'male' and article_category = 'belts'");
                    $belts_count_sql = $DBH->query("select count(*) from products where article_category = 'belts'");
					$watches_sql = $DBH->query("select id, name, description, image_location,price from products where age_category = 'adult' and gender_category = 'male' and article_category = 'watches'");
                    $watches_count_sql = $DBH->query("select count(*) from products where article_category = 'watches'");
					$per_row = 3;
					?>
                    <li class="active"><a href="#Pants" data-toggle="tab">Pants</a></li>
                    
                    <li><a href="#Shirts" data-toggle="tab">Shirts</a></li>
                    
                    <li><a href="#Belts" data-toggle="tab">Belts</a></li>
                    
                    <li><a href="#Watches" data-toggle="tab">Watches</a></li>
                                
                </ul>
                
                <div class="tab-content">
                    
                    <div class="tab-pane active" id="Pants">
                    
                        <table class="table">
                        <?php
                        $pants_sql->setFetchMode(PDO::FETCH_ASSOC);
						$i = 0;
						$count1 = $pants_count_sql->fetch();
						
                        while($row = $pants_sql->fetch()) {
                          	echo '<td><a href="./details.php?data=' . $row['id'] . '"><img src="' . $row['image_location'] . '"></a>';
							echo "<br/><br/>\n";
                            echo '<a href="./details.php?data=' . $row['id'] . '">' . $row['name'] . '</a>';
							echo "<br/><br/>\n";
							echo '</td>';
							if (++$i % $per_row == 0 && $i >0 && $i < $count1) {
							echo '</tr><tr>';
							}
                        }
						# If the last row isn't 'full', fill it with empty cells
						for($x1 = 0; $x1 < $per_row - $i % $per_row; $x1++) {
							echo '<td></td>';
						}
                        ?>                        
                        </table>
                    </div>
                    
                    <div class="tab-pane" id="Shirts">
                        <table class="table">
                        <?php
                        $shirts_sql->setFetchMode(PDO::FETCH_ASSOC);
						$j = 0;
						$count2 = $shirts_count_sql->fetch();
						
                        while($row = $shirts_sql->fetch()) {
                          	echo '<td><a href="./details.php?data=' . $row['id'] . '"><img src="' . $row['image_location'] . '"></a>';
							echo "<br/><br/>\n";
                            echo '<a href="./details.php?data=' . $row['id'] . '">' . $row['name'] . '</a>';
							echo "<br/><br/>\n";
							echo '</td>';
							if (++$j % $per_row == 0 && $j >0 && $j < $count2) {
							echo '</tr><tr>';
							}
                        }
						# If the last row isn't 'full', fill it with empty cells
						for($x2 = 0; $x2 < $per_row - $i % $per_row; $x2++) {
							echo '<td></td>';
						}
                        ?>                        
                        </table>
                    </div>
                    
                    <div class="tab-pane" id="Belts">
                        <table class="table">
                        <?php
                        $belts_sql->setFetchMode(PDO::FETCH_ASSOC);
						$k = 0;
						$count3 = $belts_count_sql->fetch();
                        while($row = $belts_sql->fetch()) {
                            echo '<td><a href="./details.php?data=' . $row['id'] . '"><img src="' . $row['image_location'] . '"></a>';
							echo "<br/><br/>\n";
                            echo '<a href="./details.php?data=' . $row['id'] . '">' . $row['name'] . '</a>';
							echo "<br/><br/>\n";
							echo '</td>';
							if (++$k % $per_row == 0 && $k >0 && $k < $count3) {
							echo '</tr><tr>';
							}
                        }
						# If the last row isn't 'full', fill it with empty cells
						for($x3 = 0; $x3 < $per_row - $k % $per_row; $x3++) {
							echo '<td></td>';
						}
                        ?>                        
                        </table>
                    </div>
                    
                    <div class="tab-pane" id="Watches">
                        <table class="table">
                        <?php
                        $watches_sql->setFetchMode(PDO::FETCH_ASSOC);
						$l = 0;
						$count4 = $watches_count_sql->fetch();
						
                        while($row = $watches_sql->fetch()) {
                            echo '<td><a href="./details.php?data=' . $row['id'] . '"><img src="' . $row['image_location'] . '"></a>';
							echo "<br/><br/>\n";
                            echo '<a href="./details.php?data=' . $row['id'] . '">' . $row['name'] . '</a>';
							echo "<br/><br/>\n";
							echo '</td>';
							if (++$l % $per_row == 0 && $l >0 && $l < $count4) {
							echo '</tr><tr>';
							}
                        }
						# If the last row isn't 'full', fill it with empty cells
						for($x4 = 0; $x4 < $per_row - $l % $per_row; $x4++) {
							echo '<td></td>';
						}
                        ?>                        
                        </table>
                    </div>
                </div>
                
                
        </div>
    </div>
</div>
</div>
<br/><br/><br/><br/>

<?php
include "footer.php"
?>