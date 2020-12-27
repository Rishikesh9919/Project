<?php

if (isset($_POST['Ad-Sign-up'])){
    require 'connection.php';
    
    $F_name = $_POST['Ad-FirstName'];
    $L_name = $_POST['Ad-LastName'];
    $e_mail = $_POST['Ad-Email'];
    $pwd = $_POST['Ad-Password'];
    $c_pwd = $_POST['Ad-ConfirmPassword'];
    $Post = "admin";
    
    $img = $_FILES["Ad-Profile-img"];
    $img_name = $img['name'];                   
    $img_temp = $img['tmp_name'];
    $img_er = $img['error'];
    
    $file_ext = explode('.',$img_name);
    $filecheck = strtolower(end($file_ext));
    $file_ext_stored = array('png','jpg','jpeg');
    
    
    if(empty($F_name) || empty($L_name) || empty($e_mail) || empty($pwd) || empty($c_pwd)){
        header("Location:../admin-signup.php?error=emptyFields&F_name=".$F_name."&L_name=".$L_name."&e_mail=".$e_mail);
        exit();
    }
    elseif(!preg_match("/^[a-zA-Z]*$/",$F_name)){
        header("Location:../admin-signup.php?error=onlyChar&L_name=".$L_name."&e_mail=".$e_mail);
        exit();
    }
    elseif(!preg_match("/^[a-zA-Z]*$/",$L_name)){
        header("Location:../admin-signup.php?error=onlyChar&F_name=".$F_name."&e_mail=".$e_mail);
        exit();
    }
    elseif(!filter_var($e_mail,FILTER_VALIDATE_EMAIL)){
        header("Location:../admin-signup.php?error=invalidEmail&F_name=".$F_name."&L_name=".$L_name);
        exit();
    }
    elseif(!preg_match("/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,22}$/",$pwd)){
        header("Location:../admin-signup.php?error=inavlidPassword&F_name=".$F_name."&L_name=".$L_name."&e_mail=".$e_mail);
        exit();
    }
    elseif($pwd !== $c_pwd){
        header("Location:../admin-signup.php?error=passwordDoesntMatch&F_name=".$F_name."&L_name=".$L_name."&e_mail=".$e_mail);
        exit();
    }
    else{
        $sql = "SELECT mail FROM user WHERE mail=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location:../admin-signup.php?error=sqlerror&F_name=".$F_name."&L_name=".$L_name."&e_mail=".$e_mail);
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt,"s",$e_mail);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $result = mysqli_stmt_num_rows($stmt);
            if($result > 0){
                header("Location:../admin-signup.php?error=emailAlreadyExists&F_name=".$F_name."&L_name=".$L_name);
                exit();
            }
            else{
                    if(in_array($filecheck,$file_ext_stored)){
                
                    $dest_file = 'UploadedFiles/'.$img_name;
                    move_uploaded_file($img_temp,$dest_file);
                
                    $sql = "INSERT INTO user(Fname,Lname,mail,password,ProfileImg,Post) VALUES (?,?,?,?,?,?)";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt,$sql)){
                        header("Location:../admin-signup.php?error=sqlerror&F_name=".$F_name."&L_name=".$L_name."&e_mail=".$e_mail);
                        exit();
                    }
                    else{
                        $hashedpwd = password_hash($pwd,PASSWORD_DEFAULT);
                        mysqli_stmt_bind_param($stmt,"ssssss",$F_name,$L_name,$e_mail,$hashedpwd,$dest_file,$Post);
                        mysqli_stmt_execute($stmt);
                        header("Location:../admin-signup?sign-up=success");
                        exit();
                    }
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