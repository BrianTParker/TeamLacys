<?php
include "header.php";
include_once( "Checkout/CheckoutManager.php" );
$total = 0;
$CHECKOUT_MGR = CheckoutManager::getInstance();


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $CHECKOUT_MGR->checkout();
}
?>
<div class="row">

    <div class="col-sm-4 col-sm-offset-4">
        
        
        
    </div>
    
</div>

<?php
include "footer.php";
?>