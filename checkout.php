<?php
include "header.php";
include_once( "Checkout/CheckoutManager.php" );
include_once( "Account/AccountManager.php" );
$total = 0;


$CHECKOUT_MGR = CheckoutManager::getInstance();
$ACCT_MGR = AccountManager::getInstance();
$orderTotal = $CHECKOUT_MGR->getOrderTotal();

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
		
		if(isset($_POST['saveCreditCard'])){
			$saveCreditCard = $_POST['saveCreditCard'];
		}
		if(isset($_POST['saveShipping'])){
			$saveShipping = $_POST['saveShipping'];
		}
		$storeLocation = $_POST['storeLocation'];
		
		$nameError = '';
		$numberError='';
		$securityError = '';
		$streetError = '';
		$cityError = '';
		$stateError = '';
		$zipError = '';
		$storeLocationError = '';
        
		        
        //validate the checkout information
        $status = $CHECKOUT_MGR->validateCheckout($cardName,$cardNumber,$security,$expirationMonth, $expirationYear,$shipping,$street,$street2,$city,$state,$zip, $storeLocation);
        
        
        
        if($status["success"] === 1){
            $summary = array(
                        'cardType' => $cardType,'name' => $cardName, 'number' => $cardNumber, 'security' => $security, 
                        'expirationMonth' => $expirationMonth, 'expirationYear' => $expirationYear,'saveCreditCard'=>$saveCreditCard,'shipping' => $shipping, 'street' => $street, 
                        'street2' => $street2, 'city' => $city, 'state'=> $state, 'zip' => $zip, 'saveShipping'=>$saveShipping,'total' => $total, 'storeLocation'=>$storeLocation);
            $CHECKOUT_MGR->setCheckoutSummary($summary);
            header("location: checkout_summary.php");
        } else {
            
			if(isset($status['errors']['cardName'])){
				$nameError = $status['errors']['cardName'];
			}
			if(isset($status['errors']['cardNumber'])){
				$numberError = $status['errors']['cardNumber'];
			}
			if(isset($status['errors']['security'])){
				$securityError = $status['errors']['security'];
			}
			if(isset($status['errors']['street'])){
				$streetError = $status['errors']['street'];
			}
			if(isset($status['errors']['city'])){
				$cityError = $status['errors']['city'];
			}
			if(isset($status['errors']['state'])){
				$stateError = $status['errors']['state'];
			}
			if(isset($status['errors']['zip'])){
				$zipError = $status['errors']['zip'];
			}
			if(isset($status['errors']['storeLocation'])){
				$storeLocationError = $status['errors']['storeLocation'];
			}
        }
	}
}


if(!isset($cardName)){
    $cardName = '';
    $cardNumber = '';
    $security = '';
	$expirationMonth = '';
	$expirationYear = '';
    $shipping = '';
    $street = '';
    $street2 = '';
    $city = '';
    $state = '';
    $zip = '';
	$saveShipping = '';
	$saveCreditCard = '';
	$storeLocation = '';
	$nameError = '';
	$numberError='';
	$securityError = '';
	$streetError = '';
	$cityError = '';
	$stateError = '';
	$zipError = '';
	$storeLocationError = '';
	
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
                <th>Amount</th>
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
			<td><br/></td>
			<td></td>
			<td></td>
			<td></td>
			
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td><strong>Sub Total</strong></td>
			<td>$<?php echo number_format($total, 2); ?></td>
			
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td><strong>Sales Tax</strong></td>
			<td>$<?php echo number_format($orderTotal['tax'], 2); ?></td>
			
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td><strong>Shipping</strong></td>
			<td>$<?php echo number_format($orderTotal['ship'], 2); ?></td>
			
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td><strong>Total</strong></td>
			<td>$<?php echo number_format($orderTotal['grand'], 2); ?></td>
			
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
					$expirationMonth = $row['expiration_month'];
					$expirationYear = $row['expiration_year'];
				}
                
                $shipping_info_sql = $DBH->query("select street_address1, street_address2, city, state, zip
                                                    from customers c
                                                    join shipping sh on sh.id = c.shipping_id
                                                    where c.id = " . $ACCT_MGR->getId());
                if($shipping_info_sql->rowCount() >0){
                    $row = $shipping_info_sql->fetch();
                    $street = $row['street_address1'];
                    $street2 = $row['street_address2'];
                    $city = $row['city'];
                    $state = $row['state'];
                    $zip = $row['zip'];
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
				
				     <!--<label for="cardName">First Name</label> &nbsp;&nbsp&nbsp;&nbsp;<font color="red"><?php echo $cardNameError; ?></font>-->                
                    <label for="" class="control-label col-xs-4">Name on Card</label>
                        <div class="col-xs-8">
							
								
								<input type="text" class="form-control" name="name" value="<?php echo $cardName; ?>"/> 
								
								<font color="red"><?php echo $nameError; ?></font>
								
							
                        </div>
						
                </div>
                <div class="form-group">
                    <label for="" class="control-label col-xs-4">Card Number</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="number" value="<?php echo $cardNumber; ?>"/>
							<font color="red"><?php echo $numberError; ?></font>
                        </div>
                </div>
                <div class="form-group">
                    <label for="" class="control-label col-xs-4">Security Code</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="security" value="<?php echo $security; ?>"/>
							<font color="red"><?php echo $securityError; ?></font>
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
                            <option value="01" <?php echo ($expirationMonth == "01")?"selected":""; ?>>January</option>
                            <option value="02" <?php echo ($expirationMonth == "02")?"selected":""; ?>>February</option>
                            <option value="03" <?php echo ($expirationMonth == "03")?"selected":""; ?>>March</option>
                            <option value="04" <?php echo ($expirationMonth == "04")?"selected":""; ?>>April</option>
                            <option value="05" <?php echo ($expirationMonth == "05")?"selected":""; ?>>May</option>
                            <option value="06" <?php echo ($expirationMonth == "06")?"selected":""; ?>>June</option>
                            <option value="07" <?php echo ($expirationMonth == "07")?"selected":""; ?>>July</option>
                            <option value="08" <?php echo ($expirationMonth == "08")?"selected":""; ?>>August</option>
                            <option value="09" <?php echo ($expirationMonth == "09")?"selected":""; ?>>September</option>
                            <option value="10" <?php echo ($expirationMonth == "10")?"selected":""; ?>>October</option>
                            <option value="11" <?php echo ($expirationMonth == "11")?"selected":""; ?>>November</option>
                            <option value="12" <?php echo ($expirationMonth == "12")?"selected":""; ?>>December</option>
                            </select>
                            <select name="expYear" id="expYear">
                            <?php 
                            $i = $currentYear;
                            while ($i <= ($currentYear+6)) // this gives you six years in the future
                            {
                            
							if($i == $expirationYear){
								
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
				
					
					echo '		<input type="checkbox" name="saveCreditCard" value="save"/>';
					echo '		Save Credit Card Information';
					
				} 
				?>
				
                <br/><br/><br/>
                <div class="radio-inline">
                    <label>
                        <input type="radio" name="shipping" value="ship" <?php echo ($shipping == "ship" || empty($shipping))?'checked="true"':""; ?>/>
                        Ship to Address
                      </label>
                    </div>
                    <div class="radio-inline">
                      <label>
                        <input type="radio" name="shipping" value="pickup" <?php echo ($shipping == "pickup")?'checked="true"':""; ?>/>
                        Pick Up in Store
                      </label>
                    </div>
					
				<div id="storeSelect" <?php echo ($shipping == "ship" || empty($shipping))?'style="display:none"':""; ?>>
					
					<div class="form-group">
                        <label for="" class="control-label col-xs-4">Select Store Location</label>
                        <div class="col-xs-6">
                            <select class="form-control" name="storeLocation"> 
							<option value="" selected="selected">Select a Store Location</option> 

							<?php 
							$store_sql = $DBH->query("select id,street_address, city, state, zip from store_locations");
							while($row = $store_sql->fetch()){
								echo '<option value="' . $row['id'] . '" ' .(($storeLocation == $row['id'])?'selected':"") . '>'. $row['street_address'] . ' ' . $row['city'] . ', ' . $row['state'] . ' ' . $row['zip'] . '</option>' . "\n"; 
							}
							
							?>
							</select>
							<font color="red"><?php echo $storeLocationError; ?></font>
						</div>
					</div>
				</div>
				
		        <div id="shippingInput" <?php echo ($shipping == "pickup")?'style="display:none"':""; ?>>
                    <h2>Shipping Information </h2> <br/>
                    <div class="form-group">
                        <label for="" class="control-label col-xs-4">Street</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="street" value="<?php echo $street; ?>"/>
							<font color="red"><?php echo $streetError; ?></font>
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
							<font color="red"><?php echo $cityError; ?></font>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-xs-4">State</label>
                        <div class="col-xs-6">
                            <select class="form-control" name="state"> 
                            <option value="" selected="selected">Select a State</option> 
                            <option value="AL"<?php echo ($state == "AL")?"selected":""; ?>>Alabama</option> 
                            <option value="AK"<?php echo ($state == "AK")?"selected":""; ?>>Alaska</option> 
                            <option value="AZ"<?php echo ($state == "AZ")?"selected":""; ?>>Arizona</option> 
                            <option value="AR"<?php echo ($state == "AR")?"selected":""; ?>>Arkansas</option> 
                            <option value="CA"<?php echo ($state == "CA")?"selected":""; ?>>California</option> 
                            <option value="CO"<?php echo ($state == "CO")?"selected":""; ?>>Colorado</option> 
                            <option value="CT"<?php echo ($state == "CT")?"selected":""; ?>>Connecticut</option> 
                            <option value="DE"<?php echo ($state == "DE")?"selected":""; ?>>Delaware</option> 
                            <option value="DC"<?php echo ($state == "DC")?"selected":""; ?>>District Of Columbia</option> 
                            <option value="FL"<?php echo ($state == "FL")?"selected":""; ?>>Florida</option> 
                            <option value="GA"<?php echo ($state == "GA")?"selected":""; ?>>Georgia</option> 
                            <option value="HI"<?php echo ($state == "HI")?"selected":""; ?>>Hawaii</option> 
                            <option value="ID"<?php echo ($state == "ID")?"selected":""; ?>>Idaho</option> 
                            <option value="IL"<?php echo ($state == "IL")?"selected":""; ?>>Illinois</option> 
                            <option value="IN"<?php echo ($state == "IN")?"selected":""; ?>>Indiana</option> 
                            <option value="IA"<?php echo ($state == "IA")?"selected":""; ?>>Iowa</option> 
                            <option value="KS"<?php echo ($state == "KS")?"selected":""; ?>>Kansas</option> 
                            <option value="KY"<?php echo ($state == "KY")?"selected":""; ?>>Kentucky</option> 
                            <option value="LA"<?php echo ($state == "LA")?"selected":""; ?>>Louisiana</option> 
                            <option value="ME"<?php echo ($state == "ME")?"selected":""; ?>>Maine</option> 
                            <option value="MD"<?php echo ($state == "MD")?"selected":""; ?>>Maryland</option> 
                            <option value="MA"<?php echo ($state == "MA")?"selected":""; ?>>Massachusetts</option> 
                            <option value="MI"<?php echo ($state == "MI")?"selected":""; ?>>Michigan</option> 
                            <option value="MN"<?php echo ($state == "MN")?"selected":""; ?>>Minnesota</option> 
                            <option value="MS"<?php echo ($state == "MS")?"selected":""; ?>>Mississippi</option> 
                            <option value="MO"<?php echo ($state == "MO")?"selected":""; ?>>Missouri</option> 
                            <option value="MT"<?php echo ($state == "MT")?"selected":""; ?>>Montana</option> 
                            <option value="NE"<?php echo ($state == "NE")?"selected":""; ?>>Nebraska</option> 
                            <option value="NV"<?php echo ($state == "NV")?"selected":""; ?>>Nevada</option> 
                            <option value="NH"<?php echo ($state == "NH")?"selected":""; ?>>New Hampshire</option> 
                            <option value="NJ"<?php echo ($state == "NJ")?"selected":""; ?>>New Jersey</option> 
                            <option value="NM"<?php echo ($state == "NM")?"selected":""; ?>>New Mexico</option> 
                            <option value="NY"<?php echo ($state == "NY")?"selected":""; ?>>New York</option> 
                            <option value="NC"<?php echo ($state == "NC")?"selected":""; ?>>North Carolina</option> 
                            <option value="ND"<?php echo ($state == "ND")?"selected":""; ?>>North Dakota</option> 
                            <option value="OH"<?php echo ($state == "OH")?"selected":""; ?>>Ohio</option> 
                            <option value="OK"<?php echo ($state == "OK")?"selected":""; ?>>Oklahoma</option> 
                            <option value="OR"<?php echo ($state == "OR")?"selected":""; ?>>Oregon</option> 
                            <option value="PA"<?php echo ($state == "PA")?"selected":""; ?>>Pennsylvania</option> 
                            <option value="RI"<?php echo ($state == "RI")?"selected":""; ?>>Rhode Island</option> 
                            <option value="SC"<?php echo ($state == "SC")?"selected":""; ?>>South Carolina</option> 
                            <option value="SD"<?php echo ($state == "SD")?"selected":""; ?>>South Dakota</option> 
                            <option value="TN"<?php echo ($state == "TN")?"selected":""; ?>>Tennessee</option> 
                            <option value="TX"<?php echo ($state == "TX")?"selected":""; ?>>Texas</option> 
                            <option value="UT"<?php echo ($state == "UT")?"selected":""; ?>>Utah</option> 
                            <option value="VT"<?php echo ($state == "VT")?"selected":""; ?>>Vermont</option> 
                            <option value="VA"<?php echo ($state == "VA")?"selected":""; ?>>Virginia</option> 
                            <option value="WA"<?php echo ($state == "WA")?"selected":""; ?>>Washington</option> 
                            <option value="WV"<?php echo ($state == "WV")?"selected":""; ?>>West Virginia</option> 
                            <option value="WI"<?php echo ($state == "WI")?"selected":""; ?>>Wisconsin</option> 
                            <option value="WY"<?php echo ($state == "WY")?"selected":""; ?>>Wyoming</option>
                            </select>
							<font color="red"><?php echo $stateError; ?></font>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="" class="control-label col-xs-4">Zip</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="zip" value="<?php echo $zip; ?>"/>
							<font color="red"><?php echo $zipError; ?></font>
                        </div>
                    </div>
                    <?php 
                    // display 'Save Shipping Information' radio button only if an account is logged in -bp
                    if (AccountManager::getInstance()->isLoggedIn()){
                    
                        
                        echo '		<input type="checkbox" name="saveShipping" value="save"/>';
                        echo '		Save Shipping Information';
                        
                    } 
                    ?>
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