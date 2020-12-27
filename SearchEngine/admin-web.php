<?php 
    include_once 'admin-header.php';
    require 'Registration/connection.php';
    $sql = "SELECT * FROM website WHERE val = 2";
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
    $sql1 = "SELECT * FROM website WHERE val = 2  LIMIT ".$start.','.$data_per_page;
    $result = mysqli_query($conn,$sql1);
?>

<html lang="en">

<head>
    <title>Admin/admin-web</title>
    <script src="https://use.fontawesome.com/3caa8aa520.js"></script>
    <!-- Place your stylesheet here-->
    <link href="css/Admin-Web.css" rel="stylesheet" type="text/css">  
</head>
    
<body>
<div class="main">
    <div class="form-control">
    <h4 style="text-align:center;color:#1E06C3"><i class="fa fa-laptop" aria-hidden="true"></i>&nbsp;&nbsp;<b>Websites</b></h4>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>No.</th>    
                    <th>Owner</th>    
                    <th>Title</th>    
                    <th>Url</th>   
                    <th>Reject</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php  
					$i = $start + 1;
                    while($rows = mysqli_fetch_assoc($result)){ ?>
                        <td><?php echo $i?></td>    
                        <td><?php echo $rows['owner_FName']." ".$rows['owner_LName']?></td>    
                        <td><?php echo $rows['title']?>
						</td>    
                        <td><?php echo $rows['url']?></td>				
                        <td>
						<form method="post" action="Data-Ad/Acc_Rej.php?id=<?php echo $rows['id'];?>">
						<input type="submit" class="acc-rej reject" value="Delete" name="Delete">
						</form>
						</td>
						
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
                    echo'<a class="next" href="admin-web.php?page='.$page.' ">'.$page.'</a>&nbsp&nbsp&nbsp';
                }
            ?>   
        </div>
    </div>  
</div>
</body>
</html>