<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign-up</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Place your stylesheet here-->
    <link href="Registration-css/Sign-style.css" rel="stylesheet" type="text/css">

<style>
body{
    background-image: url("Registration-img/Clouds.gif");
}
.success-img{
    height: 90px;
    width: auto;
    margin-top: 8px;
}
</style>
</head>

<body>
<main class="main">
    <form class="form-container" id="sign-up" method="post" action="Register.php" enctype="multipart/form-data">
        <div class="row">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <figure class="figure">
                    <img src="Registration-img/profile.png" onclick="triggerClick()" id="profileDisplay" alt="">
                    <figcaption class="figure-caption">Profile Image</figcaption>
                </figure>
                <input type="file" name="P_img" onchange="displayImage(this)" id="profileImage" style="display: none">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="input-box" style="margin-top: 2vh;">
                    <?php 
                        if(isset($_GET['F_name'])){
                            $F_name = $_GET['F_name'];
                            echo '<input type="text" value="'.$F_name.'" id="F_name" name="F_name" class="input"/>';
                        }
                        else{
                            echo '<input type="text" id="F_name" name="F_name" class="input"/>';
                        }
                    ?>
                    <label class="input-label">First Name</label>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="input-box" style="margin-top: 2vh;">
                    <?php 
                        if(isset($_GET['L_name'])){
                            $L_name = $_GET['L_name'];
                            echo '<input type="text" value="'.$L_name.'" id="L_name" name="L_name" class="input"/>';
                        }
                        else{
                            echo '<input type="text" id="L_name" name="L_name" class="input"/>';
                        }
                    ?>
                    <label class="input-label">Last Name</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="input-box">
                    <?php 
                        if(isset($_GET['e_mail'])){
                            $e_mail = $_GET['e_mail'];
                            echo '<input type="text" value="'.$e_mail.'" id="e_mail" name="e_mail" class="input"/>';
                        }
                        else{
                            echo '<input type="text" id="e_mail" name="e_mail" class="input"/>';
                        }
                    ?>
                    <label class="input-label">Email Address</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="input-box">
                    <select class="input" name="seq" style="padding-top:5px">
						<option value="What is your nickname?">What is your nickname?</option>
						<option value="Who is your inspiration?">Who is your inspiration?</option>
					</select>
					<label class="input-label">Sequrity Queston</label>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="input-box">
					<?php 
                        if(isset($_GET['ans'])){
                            $ans = $_GET['ans'];
                            echo '<input type="text" value="'.$ans.'" id="ans" name="ans" class="input"/>';
                        }
                        else{
                            echo '<input type="text" id="ans" name="ans" class="input"/>';
                        }
                    ?>
					<label class="input-label">Answer</label>
                </div>
            </div>
        </div> 
		
		<div class="row">
            <div class="col-sm-6">
                <div class="input-box">
                    <input type="password" id="paswrd" name="pwd" class="input"/>
                    <label class="input-label">Password</label>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="input-box">
                    <input type="password" id="cpaswrd" name="c_pwd" class="input"/>
					<label class="input-label">Confirm Password</label>
                </div>
            </div>
        </div>  
		<div class="row">
			<div class="col">
				
			</div>
		</div>
        <div class="row">
            <div class="col">
                <p>Use 8 or more characters with a mix of letters, numbers & symbols</p><br>
                <p class="error"><?php
                        if(isset($_GET['error'])){
                            $msg = $_GET['error'];
                            
                            if($msg == "emptyFields"){
                                echo "Please fill all the fields!";
                            }
                            if($msg == "onlyChar"){
                                echo "Only Characters are allowed!";
                            }
                            if($msg == "invalidEmail"){
                                echo "Please enter a valid e-mail id!";
                            }
                            if($msg == "inavlidPassword"){
                                echo "Please use 8 or more characters with a mix of letters, numbers & symbols!";
                            }
                            if($msg == "passwordDoesntMatch"){
                                echo "Password doesn't match!";
                            }
                            if($msg == "emailAlreadyExists"){
                                echo "E-mail already exists!";
                            }
                            if($msg == "sqlerror"){
                                echo "Sorry...! database error";
                            }
                        }
                    ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <input type="submit" class="btn btn-primary" name="submit" value="Sign up">
                <a href="Sign-in.php"><b>Sign in instead</b></a>
            </div>
        </div>
    </form>  
    
    <div class="success-box">
        <div class="success-content">
            <center>
                <img src="Registration-img/CheckedCircle.gif" class="success-img"/>
                <h4>Registration Successful</h4>
                <a href="Sign-in.php" class="ok">OK</a>
            </center>
        </div>
    </div>
</main>
<?php
    if(isset($_GET['sign-up'])){
        $msg = $_GET['sign-up'];
        echo '<script>document.querySelector(".form-container").style.display = "none";
            document.querySelector(".success-box").style.display = "flex";
        </script>';
    } 
?>
    
<script>
// to trigger input type file
    function triggerClick(){
        document.querySelector('#profileImage').click();
    }
// to display image after choosing profile 
    function displayImage(e){
        if(e.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                document.querySelector('#profileDisplay').setAttribute('src',e.target.result);
            }
            reader.readAsDataURL(e.files[0]);
        }
    }
	
</script>

</body>
</html>