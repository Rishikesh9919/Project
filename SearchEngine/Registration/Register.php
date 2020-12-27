<?php
if (isset($_POST['submit'])){
    require 'connection.php';
    
    $F_name = $_POST['F_name'];
    $L_name = $_POST['L_name'];
    $e_mail = $_POST['e_mail'];
	$seq = $_POST['seq'];
	$ans = $_POST['ans'];
    $pwd = $_POST['pwd'];
    $c_pwd = $_POST['c_pwd'];
    $Post = "user";
    
    $img = $_FILES["P_img"];
    $img_name = $img['name'];                   
    $img_temp = $img['tmp_name'];
    $img_er = $img['error'];
    
    $file_ext = explode('.',$img_name);
    $filecheck = strtolower(end($file_ext));
    $file_ext_stored = array('png','jpg','jpeg');
    
    
    if(empty($F_name) || empty($L_name) || empty($e_mail) || empty($ans) || empty($pwd) || empty($c_pwd) || empty($img)){
        header("Location:Sign-up.php?error=emptyFields&F_name=".$F_name."&L_name=".$L_name."&e_mail=".$e_mail."&ans=".$ans);
        exit();
    }
    elseif(!preg_match("/^[a-zA-Z]*$/",$F_name)){
        header("Location:Sign-up.php?error=onlyChar&L_name=".$L_name."&e_mail=".$e_mail."&ans=".$ans);
        exit();
    }
    elseif(!preg_match("/^[a-zA-Z]*$/",$L_name)){
        header("Location:Sign-up.php?error=onlyChar&F_name=".$F_name."&e_mail=".$e_mail."&ans=".$ans);
        exit();
    }
	elseif(!preg_match("/^[a-zA-Z]*$/",$ans)){
        header("Location:Sign-up.php?error=onlyChar&F_name=".$F_name."&L_name=".$L_name."&e_mail=".$e_mail);
        exit();
    }
    elseif(!filter_var($e_mail,FILTER_VALIDATE_EMAIL)){
        header("Location:Sign-up.php?error=invalidEmail&F_name=".$F_name."&L_name=".$L_name."&ans=".$ans);
        exit();
    }
    elseif(!preg_match("/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,22}$/",$pwd)){
        header("Location:Sign-up.php?error=inavlidPassword&F_name=".$F_name."&L_name=".$L_name."&e_mail=".$e_mail."&ans=".$ans);
        exit();
    }
    elseif($pwd !== $c_pwd){
        header("Location:Sign-up.php?error=passwordDoesntMatch&F_name=".$F_name."&L_name=".$L_name."&e_mail=".$e_mail."&ans=".$ans);
        exit();
    }
    else{
        $sql = "SELECT mail FROM user WHERE mail=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location:Sign-up.php?error=sqlerror&F_name=".$F_name."&L_name=".$L_name."&e_mail=".$e_mail."&ans=".$ans);
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt,"s",$e_mail);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $result = mysqli_stmt_num_rows($stmt);
            if($result > 0){
                header("Location:Sign-up.php?error=emailAlreadyExists&F_name=".$F_name."&L_name=".$L_name."&ans=".$ans);
                exit();
            }
            else{
                    if(in_array($filecheck,$file_ext_stored)){
                
                    $dest_file = 'UploadedFiles/'.$img_name;
                    move_uploaded_file($img_temp,$dest_file);
                
                    $sql = "INSERT INTO user(Fname,Lname,mail,Seq_Q,Ans,password,ProfileImg,Post) VALUES (?,?,?,?,?,?,?,?)";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt,$sql)){
                        header("Location:Sign-up.php?error=sqlerror&F_name=".$F_name."&L_name=".$L_name."&e_mail=".$e_mail."&ans=".$ans);
                        exit();
                    }
                    else{
                        $hashedpwd = password_hash($pwd,PASSWORD_DEFAULT);
                        mysqli_stmt_bind_param($stmt,"ssssssss",$F_name,$L_name,$e_mail,$seq,$ans,$hashedpwd,$dest_file,$Post);
                        mysqli_stmt_execute($stmt);
                        header("Location:Sign-up.php?sign-up=success");
                        exit();
                    }
                }
            }
        }
    }    
     
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else{
    echo "Access Denied";
}
    
?>