<?php 
    include_once 'admin-header.php';
    require 'Registration/connection.php';
    $sql = "SELECT * FROM user WHERE post = 'user'";
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
    $sql1 = "SELECT * FROM user where Post = 'user'  LIMIT ".$start.','.$data_per_page;
    $result = mysqli_query($conn,$sql1);
?>
<html lang="en">
<head>
    <title>Starter Template · Bootstrap</title>
    <script src="https://use.fontawesome.com/3caa8aa520.js"></script>
    <!--stylesheet-->
    <link href="css/Admin-User.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="main">
    <div class="form-control">
	<h4 style="text-align:center; color:#AA0606;"><i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp;&nbsp;<b>Users</b></h4>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
					<th>Sr. No.</th>
                    <th>Profile</th>    
                    <th>Name</th>    
                    <th>Surname</th>    
					<th>Email Address</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
					$i = $start + 1;
                    while($rows = mysqli_fetch_assoc($result)){ ?>
                        <td><?php echo $i ?></td>
						<td><img src="Registration/<?php echo $rows['ProfileImg']?>"class="table-img"/></td>    
                        <td><?php echo $rows['Fname']?></td>    
                        <td><?php echo $rows['Lname']?></td>    
					<td><?php echo $rows['mail']?></td>
                    </tr><?php
						$i++;
                    }
                ?>
            </tbody>
        </table>
    </div>
        <div class="button">
            <?php
                for($page = 1; $page <= $required_pages; $page++){
                    echo'<a class="next" href="admin-users.php?page='.$page.' ">'.$page.'</a>&nbsp&nbsp&nbsp';
                }

            ?>   
        </div>
    </div>  
</div>
</body>
</html>