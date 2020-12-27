<?php 
    include_once 'Profile.php';
    require 'Registration/connection.php';
    $id = $_SESSION['u-id'];
    $sql = "SELECT * FROM website WHERE uid = '".$id."'";
    $data = mysqli_query($conn,$sql);
    $rows = mysqli_fetch_assoc($data);
?>
<html lang="en">
<head>
    <title>Add-website</title>
    <!-- Place your stylesheet here-->
    <link href="css/Add-Site.css" rel="stylesheet" type="text/css">
<script>
$(document).ready(function(){
  $("#dashbord").click(function(){
    $("#add_site_form").fadeToggle(800);
	$("#web_status").fadeToggle(500);  
  });
});
</script>  
</head> 
<body>
<div class="header-box" id="dashboard_user">
    <div class="header">
        <div class="animate"></div>
        <div class="sidebar" id="dashbord">
           <span><img src="img/Anonymous-logo.png" alt="zoeken">&nbsp;</span><b>Dashboard</b>
        </div>
    </div>
</div>
<div class="web-status" id="web_status">
<?php
if($rows['val'] == 1){ 
?>
	<div>
		<img src="img/process.gif">
		<h5>Your request is under process...</h5>
		<div class="table-responsive">
			<table class="table align-middle">
				<tr>
					<td>Owner</td>
					<td><?php echo $rows['owner_FName']." ".$rows['owner_LName']?></td>
				</tr>
				<tr>
					<td>Website Name</td>
					<td><?php echo $rows['title']?></td>
				</tr>
				<tr>
					<td>Website Url</td>
					<td><?php echo $rows['url']?></td>
				</tr>
				<tr>
					<td>Status</td>
					<td style="color: #ff0000"><b>Pending</b></td>
				</tr>        
			</table>
		</div>
	</div><?php
}
elseif($rows['val'] == 2){
	?>

	<div>
		<img src="img/Verified.gif">
		<h5 style="color:#2020ff">Congratulations...! Your website is added to our server</h5>
		<div class="table-responsive">
			<table class="table align-middle">
				<tr>
					<td>Owner</td>
					<td><?php echo $rows['owner_FName']." ".$rows['owner_LName']?></td>
				</tr>
				<tr>
					<td>Website Name</td>
					<td><?php echo $rows['title']?></td>
				</tr>
				<tr>
					<td>Website Url</td>
					<td><?php echo $rows['url']?></td>
				</tr>
				<tr>
					<td>Status</td>
					<td style="color: #228b22"><b>Verified</b></td>
				</tr>        
			</table>
		</div>
	</div><?php }
else{
	?>
	<h3>Nothing is here for you...</h3>
	<?php
}
?>
</div> 
    
<form class="main" id="add_site_form" method="post" action="Data-Ad/Insert-Site.php" enctype="multipart/form-data">
    <div class="form-control">
		<h4 style="text-align:center"><b>Welcome to Search Console</b></h4>
        <div class="row">
            <div class="col-sm-6 form-group">
                <?php 
                    if(isset($_GET['title'])){
                        $title = $_GET['title'];
                        echo '<input type="text" value="'.$title.'" class="input-control" name="title" id="title"/>';
                    }
                    else{
                        echo '<input type="text" class="input-control" name="title" id="title"/>';
                    }
                ?>
                <label for="title" class="input-label">Title</label>
            </div>
            <div class="col-sm-6 form-group">
                <?php 
                    if(isset($_GET['url'])){
                        $url = $_GET['url'];
                        echo '<input type="text" value="'.$url.'" class="input-control" name="url" id="url"/>';
                    }
                    else{
                        echo '<input type="text" class="input-control" name="url" id="url"/>';
                    }
                ?>
                <label for="url" class="input-label">URL</label>
            </div>
        </div>
        
        <div class="form-group">
            <textarea rows="1" class="input-control" name="description"id="desc"></textarea>
            <label for="desc" class="input-label">Description</label>

        </div>
        
        <div class="row">
            <div class="col-sm-6 form-group">
                <?php 
                    if(isset($_GET['keyword'])){
                        $url = $_GET['keyword'];
                        echo '<input type="text" value="'.$url.'" class="input-control" name="keyword" id="keyword"/>';
                    }
                    else{
                        echo '<input type="text" class="input-control" name="keyword" id="keyword"/>';
                    }
                ?>
                <label for="keyword" class="input-label">Keywords</label>
            </div>
            <div class="col-sm-6 form-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="web_img" accept="image/" id="web_img">
                    <label class="custom-file-label" for="web_img" data-browse="Add Image"><i class="fa fa-image"></i></label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <input type="checkbox" class="" name="terms" value="True" id="terms"/>
            <label for="terms" class="check-label">&nbsp;&nbsp;I agree to the Terms and Conditions</label>
        </div>
        <p class="error"><?php
            if(isset($_GET['error'])){
                $msg = $_GET['error'];

                if($msg == "emptyFields"){
                    echo "Please fill all the fields!";
                }
                if($msg == "urlAlreadyExists"){
                    echo "E-mail already exists!";
                }
                if($msg == "sqlerror"){
                    echo "Sorry...! database error";
                }
            }
        ?></p>
        <div class="button">
            <input type="submit" name="Add_Website" value="Add Website" class="next">
        </div>
    </div>   
</form>
<div class="success-box">
    <div class="success-content">
        <center>
            <img src="img/fishprocessing.gif" class="success-img"/>
            <h4>Request has been sent for processing</h4>
            <a href="Add-Site.php" class="ok">OK</a>
        </center>
    </div>
</div>
<?php
    if(isset($_GET['data_sent'])){
        $msg = $_GET['data_sent'];
        echo '<script>document.querySelector(".form-control").style.display = "none";
            document.querySelector(".success-box").style.display = "flex";
        </script>';
    } 
?>
  
<script>
	$(".custom-file-input").on("change", function() {
	  var fileName = $(this).val().split("\\").pop();
	  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	});
</script>
</body>
</html>