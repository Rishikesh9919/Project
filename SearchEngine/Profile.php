<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Zoeken/Profile</title>
    
    <!--Template based on URL below-->
    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/starter-template/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://use.fontawesome.com/3caa8aa520.js"></script>
    <!-- Place your stylesheet here-->
    <link href="css/Profile.css" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("#profile").click(function(){
    $("#profile-box").fadeToggle(500);
  });
});
</script>    
</head>

<body>

<?php
if(isset($_SESSION['u-id'])){
    $id = $_SESSION['u-id'];
    $F_name = $_SESSION['F-name'];
    $L_name = $_SESSION['L-name'];
    $email = $_SESSION['e-mail'];
    $Pro_pic = $_SESSION['Pro-img'];
    ?>
    
<div class="profile" id="profile">
    <img src="Registration/<?php echo $Pro_pic;?>"> 
</div> 
    
<div class="profile-box profile-box-in" id="profile-box">
    <div class="content">
        <div class="image in">
        <img src="Registration/<?php echo $Pro_pic;?>" alt="Zoeken">
        </div>
        <h5 class="text-center">
        <b><?php
                echo $F_name." ".$L_name;   
            ?>
        </b></h5>
        <p>
            <?php
                echo $email;
            ?>
        </p>
        <p><a href="Registration/logout.php" onclick="../index.php"><b>Sign out</b></a></p>
        <hr>
        <h5><a href="index.php"><b>Home</b></a></h5><br>
        <h5><a href="Add-Site.php"><b>Search Console</b></a></h5> 
    </div>   
</div>

<?php
}
else{                        
    ?>
<div class="profile" id="profile">
    <img src="img/profile.png"> 
</div> 
<div class="profile-box profile-box-out" id="profile-box">
	<div class="content">
		<div class="image out">
		<img src="img/profile.png" alt="Zoeken">
		</div>
		<p>Not signed in</p>
		<p><a href="Registration/Sign-in.php"><b>Sign in</b></a></p>
		<p>or</p>
		<p><a href="Registration/Sign-up.php"><b>Create Account</b></a></p>
    </div>
</div>
      <?php
    }
?>
</body>
</html>