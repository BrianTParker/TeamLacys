<?php
include "header.php";
include "Account/AccountManager.php";


$ACCT_MGR = AccountManager::getInstance();
if(!isset($databaseError)){
	$databaseError = "";
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$databaseError = "";
	if(isset($_POST['yesClose'])){
		$status = $ACCT_MGR->closeAccount();
                
		if($status["success"] === 1){
			unset($_SESSION);
			session_destroy();
			header("location: index.php");
		}else{
		
			if(isset($status['errors']['database'])){
				$databaseError = $status['errors']['database'];
			}
			
			
		}
	}
	if(isset($_POST['noClose'])){
		header("location: account.php");
	}
}

?>

<div class="row">

    <div class="col-sm-4 col-sm-offset-1">
		<?php echo $databaseError; ?>
		<form method="POST" action="">
			<h2>Are you sure you want to close your account?</h2>
			<button class="btn btn-default" name="yesClose" type="submit">Yes</button>
			<button class="btn btn-default" name="noClose" type="submit">No</button>
		</form>
	</div>

</div>




<?php
include "footer.php"
?>