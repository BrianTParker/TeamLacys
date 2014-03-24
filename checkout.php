<?php
include "header.php";
include_once( "Checkout/CheckoutManager.php" );
include_once( "Account/AccountManager.php" );
$total = 0;


$CHECKOUT_MGR = CheckoutManager::getInstance();
$ACCT_MGR = AccountManager::getInstance();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $CHECKOUT_MGR->getNewSummary();
    if(isset($_POST['checkoutInput'])){
        $cardType = $_POST['type'];
        $cardName = $_POST['name'];
        $cardNumber = $_POST['number'];
        $security = $_POST['security'];
        $expirationMonth = $_POST['expMonth'];
        $expirationYear = $_POST['expYear'];
        $shipping = $_POST['shipping'];
        $street = $_POST['street'];
        $street2 = $_POST['street2'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zip = $_POST['zip'];
        $total = $_POST['total'];
		$saveCreditCard = $_POST['saveCreditCard'];
		
        
        
        //validate the checkout information
        $status = $CHECKOUT_MGR->validateCheckout($cardName,$cardNumber,$security,$expirationMonth, $expirationYear,$shipping,$street,$street2,$city,$state,$zip);
        
        
        
        if($status["success"] === 1){
            $summary = array(
                        'cardType' => $cardType,'name' => $cardName, 'number' => $cardNumber, 'security' => $security, 
                        'expirationMonth' => $expirationMonth, 'expirationYear' => $expirationYear,'saveCreditCard'=>$saveCreditCard,'shipping' => $shipping, 'street' => $street, 
                        'street2' => $street2, 'city' => $city, 'state'=> $state, 'zip' => $zip, 'total' => $total);
            $CHECKOUT_MGR->setCheckoutSummary($summary);
            header("location: checkout_summary.php");
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
    
    
    
}

if(!isset($cardName)){
    $cardName = '';
    $cardNumber = '';
    $security = '';
	$expMonth = '';
	$expYear = '';
    $shipping = '';
    $street = '';
    $street2 = '';
    $city = '';
    $state = '';
    $zip = '';
}
$total = 0;
?>

<div class="row">
    <div class="col-sm-4 col-sm-offset-1">
        <h1>Checkout</h1>
        
        <table class="table">
            
            <head>
                <th>Item</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </head>
                
                <?php
                $CART_MGR = CartManager::getInstance();
                foreach( $CART_MGR->getItems() as $index => $item ){
                    $subTotal = 0;
                    //print_r( $item );
                    // print item to screen -nm
                    echo '<tr>' . "\n";
                    echo '<td>' . $item['name'] . '</td>' . "\n";
                    echo '<td>$' . number_format($item['price'], 2) . '</td>' . "\n";
                    echo '<td> x' . $item['quantity'] . '</td>' . "\n";
                    $subTotal += ($item['price'] * $item['quantity']);
                    $total += ($item['price'] * $item['quantity']);
                    echo '<td>$' . number_format($subTotal, 2) . '</td>';
                    echo '</tr>' . "\n";
                    
                }
                ?>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td><strong>Total</strong></td>
			
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td>$<?php echo number_format($total, 2); ?></td>
			
		</tr>
        </table>
    </div>
    
    <div class="col-sm-4 col-sm-offset-1">
	
		<?php
			if (AccountManager::getInstance()->isLoggedIn()){
			
				$credit_info_sql = $DBH->query("select name_on_card, credit_card_number, card_type, security_code, expiration_date, expiration_month, expiration_year 
										from customers c
										join credit_card_info cc on cc.id = c.credit_card_id
										where c.id = " . $ACCT_MGR->getId());
				if($credit_info_sql->rowCount() >0){
					$row = $credit_info_sql->fetch();
					$cardName = $row['name_on_card'];
					$cardNumber = $row['credit_card_number'];
					$security = $row['security_code'];
					$expMonth = $row['expiration_month'];
					$expYear = $row['expiration_year'];
				}
			}
		?>
		
        <form class="form-horizontal" method="POST" action="">
            <h2>Credit Card Information</h2>
            <div class="form-group">
                <label for="" class="control-label col-xs-4">Card Type</label>
                <div class="col-xs-4">
                        <select class="form-control" name="type">
                            <option>Visa</option>
                            <option>Mastercard</option>
                        </select> 
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="control-label col-xs-4">Name on Card</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="name" value="<?php echo $cardName; ?>"/>
                        </div>
                </div>
                <div class="form-group">
                    <label for="" class="control-label col-xs-4">Card Number</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="number" value="<?php echo $cardNumber; ?>"/>
                        </div>
                </div>
                <div class="form-group">
                    <label for="" class="control-label col-xs-4">Security Code</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="security" value="<?php echo $security; ?>"/>
                        </div>
                </div>
                <div class="form-group">
                    <label for="" class="control-label col-xs-4">Expiration Date</label>
                        <div class="col-xs-8">
                            <?php 
                            $currentYear = date("Y");
                            $currentMonth = date("m");
                            ?>
                            <select name="expMonth" id="expMonth">
                            <option value="01" <?php echo ($expMonth == "01")?"selected":""; ?>>January</option>
                            <option value="02" <?php echo ($expMonth == "02")?"selected":""; ?>>February</option>
                            <option value="03" <?php echo ($expMonth == "03")?"selected":""; ?>>March</option>
                            <option value="04" <?php echo ($expMonth == "04")?"selected":""; ?>>April</option>
                            <option value="05" <?php echo ($expMonth == "05")?"selected":""; ?>>May</option>
                            <option value="06" <?php echo ($expMonth == "06")?"selected":""; ?>>June</option>
                            <option value="07" <?php echo ($expMonth == "07")?"selected":""; ?>>July</option>
                            <option value="08" <?php echo ($expMonth == "08")?"selected":""; ?>>August</option>
                            <option value="09" <?php echo ($expMonth == "09")?"selected":""; ?>>September</option>
                            <option value="10" <?php echo ($expMonth == "10")?"selected":""; ?>>October</option>
                            <option value="11" <?php echo ($expMonth == "11")?"selected":""; ?>>November</option>
                            <option value="12" <?php echo ($expMonth == "12")?"selected":""; ?>>December</option>
                            </select>
                            <select name="expYear" id="expYear">
                            <?php 
                            $i = $currentYear;
                            while ($i <= ($currentYear+6)) // this gives you six years in the future
                            {
                            
							if($i == $expYear){
								
								echo '<option value="' . $i . '" selected>' . $i . '</option>';
							}else{
								echo '<option value="' . $i . '">' . $i . '</option>';
							}
                            
                            
                            $i++;
                            } 
                            ?>
                            </select>
                        </div>
                </div>
				
				<?php 
				// display 'Save Credit Information' radio button only if an account is logged in -nm
				if (AccountManager::getInstance()->isLoggedIn()){
				
					echo '<div class="radio-inline">';
					echo '	<label>';
					echo '		<input type="radio" name="saveCreditCard" value="save"/>';
					echo '		Save Credit Card Information';
					echo '	</label>';
					echo '</div>';
				} 
				?>
				
                <br/><br/><br/>
                <div class="radio-inline">
                    <label>
                        <input type="radio" name="shipping" value="ship" checked="true"/>
                        Ship to Address
                      </label>
                    </div>
                    <div class="radio-inline">
                      <label>
                        <input type="radio" name="shipping" value="pickup"/>
                        Pick Up in Store
                      </label>
                    </div>
		        <div id="shippingInput">
                    <h2>Shipping Information </h2> <br/>
                    <div class="form-group">
                        <label for="" class="control-label col-xs-4">Street</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="street" value="<?php echo $street; ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-xs-4">Street 2</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="street2" value="<?php echo $street2; ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-xs-4">City</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="city" value="<?php echo $city; ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-xs-4">State</label>
                        <div class="col-xs-6">
                            <select class="form-control" name="state"> 
                            <option value="" selected="selected">Select a State</option> 
                            <option value="AL">Alabama</option> 
                            <option value="AK">Alaska</option> 
                            <option value="AZ">Arizona</option> 
                            <option value="AR">Arkansas</option> 
                            <option value="CA">California</option> 
                            <option value="CO">Colorado</option> 
                            <option value="CT">Connecticut</option> 
                            <option value="DE">Delaware</option> 
                            <option value="DC">District Of Columbia</option> 
                            <option value="FL">Florida</option> 
                            <option value="GA">Georgia</option> 
                            <option value="HI">Hawaii</option> 
                            <option value="ID">Idaho</option> 
                            <option value="IL">Illinois</option> 
                            <option value="IN">Indiana</option> 
                            <option value="IA">Iowa</option> 
                            <option value="KS">Kansas</option> 
                            <option value="KY">Kentucky</option> 
                            <option value="LA">Louisiana</option> 
                            <option value="ME">Maine</option> 
                            <option value="MD">Maryland</option> 
                            <option value="MA">Massachusetts</option> 
                            <option value="MI">Michigan</option> 
                            <option value="MN">Minnesota</option> 
                            <option value="MS">Mississippi</option> 
                            <option value="MO">Missouri</option> 
                            <option value="MT">Montana</option> 
                            <option value="NE">Nebraska</option> 
                            <option value="NV">Nevada</option> 
                            <option value="NH">New Hampshire</option> 
                            <option value="NJ">New Jersey</option> 
                            <option value="NM">New Mexico</option> 
                            <option value="NY">New York</option> 
                            <option value="NC">North Carolina</option> 
                            <option value="ND">North Dakota</option> 
                            <option value="OH">Ohio</option> 
                            <option value="OK">Oklahoma</option> 
                            <option value="OR">Oregon</option> 
                            <option value="PA">Pennsylvania</option> 
                            <option value="RI">Rhode Island</option> 
                            <option value="SC">South Carolina</option> 
                            <option value="SD">South Dakota</option> 
                            <option value="TN">Tennessee</option> 
                            <option value="TX">Texas</option> 
                            <option value="UT">Utah</option> 
                            <option value="VT">Vermont</option> 
                            <option value="VA">Virginia</option> 
                            <option value="WA">Washington</option> 
                            <option value="WV">West Virginia</option> 
                            <option value="WI">Wisconsin</option> 
                            <option value="WY">Wyoming</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="" class="control-label col-xs-4">Zip</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="zip" value="<?php echo $zip; ?>"/>
                        </div>
                    </div>
                    <input type="hidden" name="total" value="<?php echo $total; ?>"/>
                    <br/>
				</div>
                    <div class="form-group">
                        <div class="col-xs-offset-4 col-xs-10">
                            <button type="submit" class="btn btn-success btn-sm" name="checkoutInput" value="Continue Checkout"/>Continue Checkout</button>
                        </div>
                    </div>
	        </form>
    <br/><br/><br/><br/>

       



<?php
include "footer.php";
?>