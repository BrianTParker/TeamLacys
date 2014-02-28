<?php
include "header.php";
?>

<div class="row">
   <div class="col-sm-10 col-sm-offset-1">
        <div class="tabbable"> <!-- Only required for left/right tabs -->
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#Pants" data-toggle="tab">Pants</a></li>
                    <li><a href="#Shirts" data-toggle="tab">Shirts</a></li>
                                
                </ul>
                
                <div class="tab-content">
                    <div class="tab-pane active" id="Pants">
                    <ul>
                        <li>pants 1</li>
                        <li>pants 2</li>
                        <li>pants 3</li>
                    </ul>
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