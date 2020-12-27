<?php 
include_once 'Profile.php';
require 'Registration/connection.php';
if(isset($_POST['search-button'])){
	$s = $_POST['search-input'];
	$sql = "UPDATE searchinput SET search_val = '".$s."' WHERE id = 1";
	$query = mysqli_query($conn,$sql); 	
	header('Location:Webpage-all.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Webpage-header</title>
    <!-- Place your stylesheet here-->
    <link href="css/Webpage.css" rel="stylesheet" type="text/css">
</head>
<body>
<form action="Webpage-header.php" method="post" name="search">
<div class="main">
<div class="logo-box">
    <img src="img/Anonymous-logo.png" class="logo" alt="Zoeken">
</div>
    <div class="search-box">
        <div>
			<?php 
				$sql = "SELECT search_val FROM searchinput  WHERE id = 1";
				$data = mysqli_query($conn,$sql);
				$search_input = mysqli_fetch_array($data);
				$search_input = $search_input[0];
			?>
            <input type="text" value="<?php echo $search_input ?>" name="search-input" class="search-input" placeholder="Search...">
            <button type="submit" name="search-button" class="search-icon"><i class="fa fa-search" aria-hidden="true"></i></button>
        </div>
    </div>
    <div class="links">
        <a href="Webpage-all.php"><i class="fa fa-search"></i>&nbsp;&nbsp;All</a>
        <a href="Webpage-images.php"><i class="fa fa-image"></i>&nbsp;&nbsp;Images</a>
    </div>
</div>
	</form>
<div class="hr-line"></div>
</body>
</html>