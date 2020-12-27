<?php 
    include_once 'admin-header.php';
	include_once 'Profile.php';
?>

<html lang="en">
<head>
    <title>Admin/admin-sign</title>
    <script src="https://use.fontawesome.com/3caa8aa520.js"></script>
    <!-- Place your stylesheet here-->
    <link href="css/Admin-signup.css" rel="stylesheet" type="text/css">   
</head>
    
<body>
<div class="main">
    <form class="form-control" method="post" action="Registration/admin-register.php" enctype="multipart/form-data">
		<h4 style="text-align:center;color:#9F063D;"><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;&nbsp;<b>Co-Admin</b></h4>
        <div class="form-group">
            <input type="file" class="input-control" name="Ad-Profile-img" accept="image/" id="Profile-img"/>
            <label for="Profile-img" class="file-label">
                <i class="fa fa-image"></i>&nbsp;
                Profile Picture</label>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <?php 
                        if(isset($_GET['F_name'])){
                            $Ad_FirstName = $_GET['F_name'];
                            echo '<input type="text" value="'.$Ad_FirstName.'" class="input-control" name="Ad-FirstName" id="Ad-FirstName"/>';
                        }
                        else{
                            echo '<input type="text" class="input-control" name="Ad-FirstName" id="Ad-FirstName"/>';
                        }
                    ?>
                    <label for="name" class="input-label">First Name</label>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <?php 
                        if(isset($_GET['L_name'])){
                            $Ad_LastName = $_GET['L_name'];
                            echo '<input type="text" value="'.$Ad_LastName.'" class="input-control" name="Ad-LastName" id="Ad-LastName"/>';
                        }
                        else{
                            echo '<input type="text" class="input-control" name="Ad-LastName" id="Ad-LastName"/>';
                        }
                    ?>
                    <label for="surname" class="input-label">Last Name</label>
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <?php 
                if(isset($_GET['e_mail'])){
                    $Ad_Email = $_GET['e_mail'];
                    echo '<input type="text" value="'.$Ad_Email.'" class="input-control" name="Ad-Email" id="Ad-Email"/>';
                }
                else{
                    echo '<input type="text" class="input-control" name="Ad-Email" id="Ad-Email"/>';
                }
            ?>
            <label for="mail" class="input-label">Email</label>
        </div>
        
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="text" class="input-control" name="Ad-Password" id="name"/>
                    <label for="user" class="input-label">Password</label>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="text" class="input-control" name="Ad-ConfirmPassword" id="user"/>
                    <label for="user" class="input-label">Confirm Password</label>
                </div>
            </div>
        </div>
        <div class="form-group">
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
        <div class="button">
            <input type="submit" name="Ad-Sign-up" class="next" value="Sign up">
        </div>
    </form>  
</div>
</body>
</html>