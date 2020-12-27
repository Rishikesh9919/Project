<?php
    include_once 'Profile.php';
    if(!isset($_SESSION['F-name'])){
    	header("Location:index.php");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin/admin-header</title>   
    <script src="https://use.fontawesome.com/3caa8aa520.js"></script>
    <!--stylesheet -->
    <link href="css/Admin-Header.css" rel="stylesheet" type="text/css">
<script>
$(document).ready(function(){
  $("#dashbord").click(function(){
    $("#dashbord-box").fadeToggle(500);
  });
});
    
$(document).ready(function(){
  $("#dashbord-in").click(function(){
    $("#dashbord-box").fadeToggle(500);
  });
});
</script>
</head>
<body>
<div class="header-box">
    <div class="header">
        <div class="animate"></div>
        <div class="sidebar" id="dashbord">
           <span><img src="img/Anonymous-logo.png" alt="zoeken">&nbsp;</span><b>Dashboard</b>
        </div>
        
        <div class="sidebar-items" id="dashbord-box">
            <div class="sidebar" id="dashbord-in" style="color: #4a11a0">
                <span><img src="img/Anonymous-logo.png" alt="zoeken">&nbsp;</span><b>Dashboard</b>
            </div>
            <div class="items-group">
				<a href="admin-users.php" class="item"><i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp;&nbsp;Users</a>
                
                <a href="admin-web.php" class="item"><i class="fa fa-laptop" aria-hidden="true"></i>&nbsp;&nbsp;Websites</a>
                <a href="admin-requests.php" class="item"><i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;&nbsp;Requests</a>
                <a href="admin-signup.php" class="item"><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;&nbsp;Admin</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>