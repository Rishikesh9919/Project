<?php include_once 'Webpage-header.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Webpage-images</title>
    <!-- Place your stylesheet here-->
    <link href="css/Webpage.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container con-img">
    <div class="row">
        <?php
			require 'Registration/connection.php';
			$sql = "SELECT search_val FROM searchinput  WHERE id = 1";
			$data = mysqli_query($conn,$sql);
			$search_input = mysqli_fetch_array($data);
			$search_input = $search_input[0];
			$sql = "SELECT * FROM website WHERE val = 2 and keywords like '%$search_input%' ";
			$data = mysqli_query($conn,$sql);
			$num = mysqli_num_rows($data);
			if($num == 0){
				?>
				<div class="error-block">
				<img class="error-page img-fluid" src='img/error404.jpg' alt="error"></div>
		   <?php
			}
			else{
				while($rows = mysqli_fetch_array($data)){
				?>
					<img class="webimg img-thumbnail" src="Data-Ad/<?php echo $rows['webimages']; ?>">
				<?php
				}
			}
       ?>
    </div>
</div>
</body>
</html>