<?php include_once 'Webpage-header.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Webpage-all</title> 
    <!-- Place your stylesheet here-->
    <link href="css/Webpage.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container overflow-auto">
   <table>
		<?php
	   	require 'Registration/connection.php';
	   	$sql = "SELECT search_val FROM searchinput  WHERE id = 1";
		$data = mysqli_query($conn,$sql);
		$search_input = mysqli_fetch_array($data);
		$search_input = $search_input[0];
		$sql = "SELECT * FROM website WHERE val = 2 and keywords like '%$search_input%' ";
		$data = mysqli_query($conn,$sql);

		$data_per_page = 4;
		$total_data = mysqli_num_rows($data);
		$required_pages = ceil($total_data/$data_per_page);
		if(!isset($_GET['page'])){
			$page = 1;
		}
		else{
			$page = $_GET['page'];
		}
		$start = ($page - 1)*$data_per_page;
		$sql = "SELECT * FROM website WHERE val = 2 and keywords like '%$search_input%' LIMIT ".$start.','.$data_per_page;
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
			<tr>
				<td class="url">
					<a href='<?php echo $rows[5]?>'><?php echo $rows[5]?></a>
				</td>
			</tr>
			<tr>
				<td class="title">
					<a href='<?php echo $rows[5]?>' on><?php echo $rows['title']?></a>
				</td>
			</tr>
			<tr>    
				<td class="description"><?php echo $rows['description']?></td>
			</tr><?php
			}
       ?>
	   <tr>
	   <td>
	   <div class="button">
        <?php
        	for($page = 1; $page <= $required_pages; $page++){
            	echo'<a class="next" href="Webpage-all.php?page='.$page.' ">'.$page.'</a>&nbsp&nbsp&nbsp';
            }
		}
		?>   
        </div>
		</td>
		</tr>
    </table> 
</div>
</body>
</html>