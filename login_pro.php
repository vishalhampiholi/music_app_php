<?php
include_once 'conn.php';
if(isset($_POST['submit']))
{
    $email=mysqli_real_escape_string($con,$_POST['email']);
    $pass=mysqli_real_escape_string($con,$_POST['password']);
    $hash_pass=sha1($pass);
    if(empty($email)||empty($pass)){
        echo"<script>alert('empty fields');
               window.location.href='login.php';
               </script>";
        exit();
    }
    else{
        $sql="SELECT email FROM register where email='$email'";
        $result=mysqli_query($con,$sql);
        $check=mysqli_num_rows($result);
        if($check>0){
            $sql="SELECT * FROM register where email='$email'";
            $result=mysqli_query($con,$sql);
            while($row=mysqli_fetch_assoc($result)){
                if($hash_pass==$row['password'])
                {
                    session_start();
                     $user=$row['username'];
                     $uid=$row['user_id'];
                     $passo=$row['password'];
                     $_SESSION['pass']=$passo;
                     $_SESSION['username']=$user;
                     $_SESSION['userid']=$uid;
                         header('Location:songs.php');
                }
                else{
                    echo"<script>alert('Incorrect email or password');
               window.location.href='login.php';
               </script>";
                }
            }
            }else{
            echo"<script>alert('User not exist!!!Please sign up');
               window.location.href='signup.php';
               </script>";

        }
    }
    

}else{
    echo"false";
    
}
