<?php

if(isset($_POST['submit'])){
require 'database.php';
$username = $_POST['username'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirmpassword'];

if(empty($username) || empty($password) || empty($confirmPassword)){
 header("location: ../register.php?error=emptyFields&username=".$username);
 exit();
}
elseif(!preg_match("/^[a-zA-Z0-9]*/","$username")){

    header("location: ../register.php?error=InvalidUsername&username=".$username);
    exit();
}
elseif($password !== $confirmPassword){

    header("location: ../register.php?error=PasswordsNotMatched&username=".$username);
    exit();
}
else{

    $sql = "SELECT username FROM users WHERE username = ?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../register.php?error=SqlError");
        exit();
    }
else{
    mysqli_stmt_bind_param($stmt,"s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $rowCount = mysqli_stmt_num_rows($stmt);


    if($rowCount > 0){

        header("location: ../register.php?error=UsernameTaken");
        exit();        
    }
    else{

        $sql = "INSERT INTO users (username, password) VALUES (?,?)";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../register.php?error=SqlError");
            exit();
        }
        else{

        $hashedPass = password_hash($password, PASSWORD_DEFAULT);

            mysqli_stmt_bind_param($stmt,"ss", $username , $hashedPass);
            mysqli_stmt_execute($stmt);
            header("location: ../register.php?Success=Registered");
        exit(); 
        }



    }
}

    }

mysqli_stmt_close($stmt);
mysqli_stmt_close($conn);

}



?>