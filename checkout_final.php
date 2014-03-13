<?php
include "header.php";
include_once( "Checkout/CheckoutManager.php" );
include_once( "Account/AccountManager.php" );
$total = 0;
$CHECKOUT_MGR = CheckoutManager::getInstance();


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $status = $CHECKOUT_MGR->checkout();
    
    if($status["success"] === 1){
        echo "Thanks for your purchase";
    }else{
        echo '<div class="row">';
            echo '<div class="col-sm-4 col-sm-offset-1">';
            echo '</div>';
            echo '<div class="col-sm-4 col-sm-offset-1">';
                foreach($status["errors"] as $key => $value) /* walk through the array so all the errors get displayed */
                    {
                        echo '<li>' . $value . '</li>'; 
                    }
                    echo '</ul>';
            echo '</div>';
        echo '</div>';
    }
}
?>
<div class="row">

    <div class="col-sm-4 col-sm-offset-4">
        
        
        
    </div>
    
</div>

<?php
include "footer.php";
?>