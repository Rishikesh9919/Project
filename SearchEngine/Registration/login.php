<?php
if(isset($_POST['log-in'])){
    require 'connection.php';
    
    $e_mail = $_POST['e_mail'];
    $pwd = $_POST['pwd'];
    
    if(empty($e_mail) || empty($pwd)){
        header("Location:Sign-in.php?error=emptyFields");
        exit();
    }
    else{
        $sql = "SELECT * FROM user WHERE mail = '".$e_mail."'";
        $query = mysqli_query($conn,$sql);
        $result = mysqli_num_rows($query);
        
        
        if($result == 1){ 
            $row = mysqli_fetch_assoc($query);
            $checkPass = password_verify($pwd,$row['password']);
            if($checkPass == true){
                session_start();
                $_SESSION['u-id'] = $row['Id'];
                $_SESSION['F-name'] = $row['Fname'];
                $_SESSION['L-name'] = $row['Lname'];
                $_SESSION['e-mail'] = $row['mail'];
                $_SESSION['Pro-img'] = $row['ProfileImg'];
                $_SESSION['Post'] = $row['Post'];
                
                if ($_SESSION['Post'] == 'user'){
                    header("Location:../index.php");
                    exit();   
                }
                elseif ($_SESSION['Post'] == 'admin'){
                    header("Location:../admin-users.php");
                    exit();   
                }
                else{
                    session_unset();
                    session_destroy();
                    header("Location:Sign-in.php?error=wrongSomething");
                    exit();
                }
                
            }
            elseif($checkPass == false){
                header("Location:Sign-in.php?error=wrongPassword");
                exit();    
            }
            else{
                header("Location:Sign-in.php?error=wrongSomething");
                exit();
            }
            
        }
        else{
             header("Location:Sign-in.php?error=nouser");
             exit();
        }
    }
    
}    

else{
    echo "Access Denied";
}

?>