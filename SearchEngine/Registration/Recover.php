<!DOCTYPE html>
<html lang="en">
<head>
    <title>Change Password</title>

	<script src="https://use.fontawesome.com/3caa8aa520.js"></script>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Place your stylesheet here-->
    <link href="Registration-css/Sign-style.css" rel="stylesheet" type="text/css">
<style>
body{
    background-image: url("Registration-img/Clouds.gif");
}
.reset-btn{
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
    <form class="form-container" method="post" action="Recover.php">
        <div class="row">
            <div class="col">
                <h5>Change Password</h5>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="input-box">
                    <input type="password" id="pwd" name="pwd" class="input"/>
					<label class="input-label">Password</label>
                </div>
			</div>
		</div>
	  	<div class="row">
			<div class="col">
				<div class="input-box">
					<input type="password" id="c_pwd" name="c_pwd" class="input"/>
					<label class="input-label">Confirm Password</label>
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
							if($msg == "passwordDoesntMatch"){
                                echo "Password doesn't match!";
                            }
							if($msg == "inavlidPassword"){
                                echo "Please use 8 or more characters with a mix of letters, numbers & symbols!";
                            }
                        }
                    ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <input type="submit" class="btn btn-primary reset-btn" name="reset" value="Reset">
            </div>
        </div>
    </form>    
</main>

</body>
</html>
<?php 
if(isset($_GET['id'])){
	require 'connection.php';
	$id = $_GET['id'];
	$sql = "UPDATE searchinput SET change_id  = '".$id."' WHERE id = 2";
	$query = mysqli_query($conn,$sql);

}
if(isset($_POST['reset'])){
	require 'connection.php';
	$pwd = $_POST['pwd'];
	$c_pwd = $_POST['c_pwd'];
	if(empty($pwd) || empty($c_pwd)){
		header("Location:Recover.php?error=emptyFields");
		exit();
	}
	elseif(!preg_match("/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,22}$/",$pwd)){
		header("Location:Recover.php?error=inavlidPassword");
		exit();
	}
	elseif($pwd !== $c_pwd){
		header("Location:Recover.php?error=passwordDoesntMatch");
		exit();
	}
	else{
		$sql = "SELECT change_id FROM searchinput  WHERE id = 2";
		$data = mysqli_query($conn,$sql);
		$change_id = mysqli_fetch_array($data);
		$change_id = $change_id[0];
		$hashedpwd = password_hash($pwd,PASSWORD_DEFAULT);
		$sql = "UPDATE user SET password  = '".$hashedpwd."' WHERE id = '".$change_id."'";
		$query = mysqli_query($conn,$sql);
		header("Location:Sign-in.php");
		exit();
		
	}
	mysqli_close($conn);	
}
?>