<?php
session_start();
include "db_conn.php";
if(isset($_POST['uname']) && isset($_POST['password']) && isset($_POST['name']) && isset($_POST['re_password']))
{
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return  $data;
    }
   $uname= validate($_POST['uname']);
    $password= validate($_POST['password']);
    $re_password= validate($_POST['re_password']);
    $name= validate($_POST['name']);
    $user_data ='uname'. $uname. '$name='.$name ;
   
    if( empty($uname))
    {
        header("location: signup.php?error=user Name is required&$user_data");
        exit();
    }else if(empty($password))
    {
        header("location:signup.php?error=password is required&$user_data");
        exit();
    }
    else if(empty($re_password))
    {
        header("location:signup.php?error= re password is required&$user_data");
        exit();
    }
    else if(empty($name))
    {
        header("location:signup.php?error=name is required&$user_data");
        exit();
    }
    else if($password !== $re_password)
    {
        header("location:signup.php?error= password does not match&$user_data");
        exit();
    }
    else{

     $sql ="SELECT * FROM users WHERE email='$uname' ";
       $result = mysqli_query($conn,$sql);
       if(mysqli_num_rows($result) > 0)
       {
        header("location:signup.php?error= the user name is taken try another one&$user_data");
        exit();
       }else{
         $sql2 ="INSERT INTO users(email,password,name) VALUES('$uname','$password','$name')";
         $result2 = mysqli_query($conn,$sql2);
        }
        if($result2){
            header("location:signup.php?success= your account has been created successfully$user_data");
        exit();

        }else{
            header("location:signup.php?errror= unknow error occure ");
            exit();
    
        }
      
    }
}
else{
    header("location: signup.php");
    exit();
}

?>
