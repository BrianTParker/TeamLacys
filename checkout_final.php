<?php
include "header.php";
include_once( "Checkout/CheckoutManager.php" );
include_once( "Account/AccountManager.php" );
$total = 0;
$CHECKOUT_MGR = CheckoutManager::getInstance();
$CART_MGR = CartManager::getInstance();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $status = $CHECKOUT_MGR->checkout();
    
   
    
    if($status["success"] === 1){
        $CART_MGR->emptyCart();
        $CHECKOUT_MGR->getNewSummary();
        header("location: index.php");
    }else{
        echo '<div class="row">';
            echo '<div class="col-sm-4 col-sm-offset-1">';
            echo '</div>';
            echo '<div class="col-sm-4 col-sm-offset-1">';
                foreach($status["errors"] as $key => $value) 
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