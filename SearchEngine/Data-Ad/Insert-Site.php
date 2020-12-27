<?php
session_start();
if (isset($_POST['Add_Website'])){
    require 'connection.php';
    $title = addslashes($_POST["title"]);
    $url = addslashes($_POST["url"]);
    $keyword = addslashes($_POST["keyword"]);
    $description = addslashes($_POST["description"]);
    $check = $_POST["terms"];
    
    $webimg = $_FILES["web_img"];
    $img_name = $webimg['name'];                   
    $img_temp = $webimg['tmp_name'];
    $img_er = $webimg['error'];

    $file_ext = explode('.',$img_name);
    $filecheck = strtolower(end($file_ext));
    $file_ext_stored = array('png','jpg','jpeg');
    
    $uid = $_SESSION['u-id'];   
    $owner_Fname = $_SESSION['F-name'];
    $owner_Lname = $_SESSION['L-name'];

    if(empty($title) || empty($url) || empty($keyword) || empty($webimg) || empty($check)){
    	header("Location:../Add-Site.php?error=emptyFields&title=".$title."&url=".$url."&keyword=".$keyword);
		exit();
    }
	else{
		$sql = "SELECT * FROM website WHERE url = '".$url."'";
		$query = mysqli_query($conn,$sql);
		$result = mysqli_num_rows($query);
		if($result > 0){
			header("Location:../Add-Site.php?error=urlAlreadyExists&title=".$title."&keyword=".$keyword);
			exit();
		}
		else{
			if(in_array($filecheck,$file_ext_stored)){
				$dest_file = 'WebImages/'.$img_name;
				move_uploaded_file($img_temp,$dest_file);

				$sql = mysqli_query($conn, "INSERT INTO website(uid,owner_FName,owner_LName,title,url,keywords,description,webimages,val) VALUES ('$uid','$owner_Fname','$owner_Lname','$title','$url','$keyword','$description','$dest_file',1)");  
				if($sql){  
					header("Location:../Add-Site.php?data_sent=success");
					exit(); 
				}
				else{  
					header("Location:../Add-Site.php?error=sqlerror");
					exit();  
				}  
			}
		}
	}    
	mysqli_close($conn);   
}
else{
    echo "Access Denied";
}
?>