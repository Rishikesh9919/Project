<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Recover Account</title>
    

	<script src="https://use.fontawesome.com/3caa8aa520.js"></script>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Place your stylesheet here-->
    <link href="Registration-css/Sign-style.css" rel="stylesheet" type="text/css">
<style>
body{
    background-image: url("Registration-img/Clouds.gif");
}
.next-btn{
    margin-top: 2.5vh;
}
h5{
    color: #FF4500;
    font-weight: 600;
}
.error{
    color: #ff0000;
    font-size: 13px;
    float: left;
    margin-top: 10px;
	margin-bottom: 10px;
}

</style>
</head>

<body>
<main class="main">
    <form class="form-container" method="post" action="Forget-Mail.php">
        <div class="row">
            <div class="col">
                <h5>Recover Account</h5>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="input-box">
                    <input type="text" name="e_mail" class="input"/>
                    <label class="input-label">Email Address</label>
                </div>
            </div>
        </div>
		<div class="row">
            <div class="col">
                <div class="input-box">
                    <select class="input" name="seq" style="padding-top:5px">
						<option value="What is your nickname?">What is your nickname?</option>
						<option value="Who is your inspiration?">Who is your inspiration?</option>
					</select>
					<label class="input-label">Sequrity Queston</label>
                </div>
			</div>
		</div>
	  	<div class="row">
			<div class="col">
				<div class="input-box">
					<input type="text" id="e_mail" name="ans" class="input"/>
					<label class="input-label">Answer</label>
				</div>
        	</div>
		</div>
        <div class="row">
            <div class="col">
                <p class="error"><?php
                        if(isset($_GET['error'])){
                            $msg = $_GET['error'];
                            
                            if($msg == "emptyFields"){
                                echo "Please fill all the fields!";
                            }
							if($msg == "invalidEmail"){
                                echo "Please enter a valid e-mail id!";
                            }
                            if($msg == "notExists"){
                                echo "User doesn't exists!";
                            }
                        }
                    ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <input type="submit" class="btn btn-primary next-btn" name="next" value="Next">
            </div>
        </div>
    </form>    
</main>

</body>
</html>


<?php 

if (isset($_POST['next'])){
    require 'connection.php';
	
   	$e_mail = $_POST['e_mail'];
	$seq = $_POST['seq'];
	$ans = $_POST['ans'];
    if(empty($e_mail)){
		header("Location:Forget-Mail.php?error=emptyFields");
		exit();
	}
	elseif(!filter_var($e_mail,FILTER_VALIDATE_EMAIL)){
        header("Location:Forget-Mail.php?error=invalidEmail");
        exit();
    }
	else{
		$sql = "SELECT * FROM user WHERE mail = '".$e_mail."'";		
		$query = mysqli_query($conn,$sql);
		$result = mysqli_num_rows($query);
		if($result > 0){;
			$rows = mysqli_fetch_array($query);
			$id = $rows[0];
			if($rows['Seq_Q'] == $seq && $rows['Ans'] == $ans){
				header("Location:Recover.php?id=".$id);
				exit();	
			}
		}
		else{
			 header("Location:Forget-Mail.php?error=notExists");
			exit();
		}
	}
}
?>