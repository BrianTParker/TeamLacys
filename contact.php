<?php
include "header.php";


if($_SERVER['REQUEST_METHOD'] == 'POST'){
	
	$email = $_POST['email'];
	$name = $_POST['name'];
	$subject = $_POST['subject'];
	$body = $_POST['body'];
	
	
	$sql = "Insert into feedback(email, name, subject, body)
			values (:email, :name,:subject, :body)";
	$q = $DBH->prepare($sql);
	$q->execute(array(':email'=>$email,
					  ':name'=>$name,
					  ':subject'=>$subject,
					  ':body'=>$body
					  
					  ));
					  
	header("location: index.php");				  
}
?>

<div class="row">

    <div class="col-sm-4 col-sm-offset-4">
        
	
	<h1>Contact Us</h1><br />
	<p>Fill out the form below to send your comments.</p>
	<form class="form" action="" method="POST">
		<div class="form-group">
			
			<label for="emal">Your Email address</label>
				
			<input class="form-control" id="email" type="email" name="email" required>
		</div>
		<div class="form-group">
			<label for="name">Your Name</label>
				
			<input class="form-control" id="name" type="text" name="name" required>
		</div>
		<div class="form-group">
			<label for="subject">Subject</label>
				
			<input class="form-control" id="subject" type="text" name="subject" required>
		</div>
		<div class="form-group">
			<label for="body"></label>
				
			<textarea name = "body" class="form-control" id="textarea" rows="3" cols="70" required></textarea> 
		</div>

	
	<button name="submit" type="submit" class="btn btn-default">Submit</button>
	
</form>
    </div>
    
</div>

<?php
include "footer.php";
?>
</body>
</html>