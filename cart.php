<?php
include "header.php";
?>
<div class="row">
    <div class="col-sm-8 col-sm-offset-1">
        <h2>Cart</h2>
        <?php
        
        if(isset($_SESSION['cart'])){
            if(count($_SESSION['cart']) >0){
                $items = "";
                for($i = 0; $i<count($_SESSION['cart']); $i++){
                    
                    $items .= $_SESSION['cart'][$i];
                    if(count($_SESSION['cart']) > 1 && $i < count($_SESSION['cart']) - 1){
                        $items .= ",";
                    }
                    
                }

                
                
                $cart_sql = $DBH->query("select id, name, description, image_location,price from products where id in (" . $items . "   )");
                ?>
                <table class="table">
                <?php
                
                
                $cart_sql->setFetchMode(PDO::FETCH_ASSOC);
                while($row = $cart_sql->fetch()) {
                    echo '<tr>' . "\n";
                    echo '<td><img src="' . $row['image_location'] . '"/></td>' . "\n";
                    echo '<td>' . $row['name'] . '</td>' . "\n";
                    echo '<td>' . $row['description'] . '</td>' . "\n";
                    echo '<td>$' . $row['price'] . '</td>' . "\n";
                    echo '</tr>' . "\n";
                }

            }
        }
        ?>
        </table>
    </div>
</div>

<?php
include "footer.php";
?>