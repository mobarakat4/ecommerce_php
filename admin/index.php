<?php

$navnothere="";//for not include nav bar
$title="Login";
include_once 'init.php';//include for all page needed

session_start();
//php for login form
if(isset($_SESSION['username']))
{
    header('location:dashbord.php');
    exit();
    }else{
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $username=$_POST['name'];
        $password=$_POST['pass'];
        
        $hashpass=sha1($password);
        $stmt=$db->prepare("select id,username ,password ,group_id from users where username=? and password=? and group_id = 1 limit 1 ");
        $stmt->execute(array($username,$hashpass));
        $row=$stmt->fetch();
        $count=$stmt->rowCount();
        if ($count>0 ){
            unset($_SESSION['errorlogin']);
            $_SESSION['username']=$username;
            $_SESSION['id']=$row['id'];
            header('location:dashbord.php');
            exit();
        }else{
            $_SESSION['errorlogin']='wrong username or password';
        }

    }
    ?>
<div class="full_index_page">
    <div class="wrapper"> 
        <form action="" method="post">
    <h1>
        Admin Login
    </h1>
    
    
        
            <div class="inbut_feild  mx-auto"> 
                <input  type="text" name='name' placeholder='Username'autocomplete="off">
                <i class="fa fa-user"></i>
            </div>
            
            <div class="inbut_feild my-3 mx-auto"> 
                <input  type="password" name='pass' placeholder='Password'autocomplete="off">
                <i class="fa fa-lock"></i>
            </div>
            
            <div class="form-group my-3 mx-auto text-center"> 
                <input class="butt" type="submit" value='Login' >
                
            </div>
            <div class="text-center"><span class=" "><?php  echo(isset($_SESSION['errorlogin']))? $_SESSION['errorlogin']:""?></span></div>

        </form>
    </div>
    
</div>

    <?php
    include $tmpl.'footer.php';
}
?>