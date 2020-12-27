<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sign-in</title>

	<script src="https://use.fontawesome.com/3caa8aa520.js"></script>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Place your stylesheet here-->
    <link href="Registration-css/Sign-style.css" rel="stylesheet" type="text/css">
<style>
body{
    background-image: url("Registration-img/Clouds.gif");
}
.sign-in-btn{
    margin-top: 2.5vh;
}
h4{
    color: #FF4500;
    font-weight: 600;
}

</style>
</head>

<body>
<main class="main">
    <form class="form-container" method="post" action="login.php">
        <div class="row">
            <div class="col">
                <h4>Sign in</h4>
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
                    <input type="password" id="paswrd" name="pwd" class="input password"/>
					<i id="eye" class="fa fa-lg fa-eye" aria-hidden="true"></i>
                    <label class="input-label">Password</label>
                </div>
            </div>
        </div>    
        <div class="row">
            <div class="col">
                <a href="Forget-Mail.php" style="margin-top:13px;"><b>Forgot Password?</b></a>
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
                            if($msg == "wrongPassword"){
                                echo "Wrong Password!";
                            }
                            if($msg == "wrongSomething"){
                                echo "Something wrong...!";
                            }
                            if($msg == "nouser"){
                                echo "User doesn't exists!";
                            }
                            if($msg == "sqlError"){
                                echo "Sorry...! database error";
                            }
                        }
                    ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <input type="submit" class="btn btn-primary sign-in-btn" name="log-in" value="Sign In">
                <a href="Sign-up.php" class="create-acc"><b>Create Account</b>
				</a>
            </div>
        </div>
    </form>    
</main>

<script>
//Hide and show password	
const eye = document.querySelector('#eye');
const paswrd = document.querySelector('#paswrd');
const cpaswrd = document.querySelector('#cpaswrd');
	
eye.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = paswrd.getAttribute('type') === 'password' ? 'text' : 'password';
    paswrd.setAttribute('type', type);
    this.classList.toggle('fa-eye-slash');
});
</script>

</body>
</html>