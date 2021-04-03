<?php

if(isset($_POST['submit'])){
require 'database.php';
$username = $_POST['username'];
$password = $_POST['password'];
 if(empty($username) || empty($password)){

    header("location: ../index.php?error=Empty Fields");
    exit();

 }
else{
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){

        header("location: ../index.php?error=SqlError");
        exit();

    }
    else{

        mysqli_stmt_bind_param($stmt,"s",$username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($result)){

            $PassCheck = password_verify($password,$row['password']);
            if($PassCheck == false){
                header("location: ../index.php?error=WrongPass");
                exit();


            }
            elseif($PassCheck==true){
                session_start();
                $_SESSION['sessionid'] = $row['id'];
                $_SESSION['sessionUser'] = $row ['username'];
                header("location: ../index.php?Success=LoggedIn.");
                exit();

            }
            
            else{
                header("location: ../index.php?error=WrongPass");
                exit();
            }

        }
        else{

            header("location: ../index.php?error=NoUser");
        exit();
        }

    }
}


}
else{

    header("location: ../index.php?error=Forbidden");
    exit();

}

?>