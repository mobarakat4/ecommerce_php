<?php
$title='Members';
session_start();

if(isset($_SESSION['username']))
{
    require_once 'init.php';
    
    //content
    $do=isset($_GET['do'])?$_GET['do']:'manage';
    switch ($do){
        case 'manage':
            //start mange table for show data   
            ?>
            <div>
                <h1 class="text-center head-manager rounded container-md">Manage Members</h1>
            </div>
            <div class="table-responsive container-md ">
            <table class="container table table-bordered main-table">
                <thead class="">
                    <tr>
                        <th>ID</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>full Name</th>
                        <th>Reg Date</th>
                        <th>Options</th>
                
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
                $row=(isset($_GET['pending'])&&$_GET['pending']=='active')?selectcolwithkey('*','users','reg_status',0): selectcolwithkey('*','users','group_id',0);
                // links for update and 
                $linkd='?do=delete&id=';
                $linku='?do=edit&id=';
                $linka='?do=activate&id=';
                $linknoa='?do=disactivate&id=';

                foreach($row as $user){
                    //for register status select
                    
                    //define val
                    $id=$user['id'];
                    $username=$user['username'];
                    $email=$user['email'];
                    $fullname=$user['fullname'];
                    $date=$user['date'];
                    //forlink
                    $alllinku="$linku$id";
                    $alllinkd="$linkd$id";
                    $alllinka="$linka$id";
                    $alllinknoa="$linknoa$id";
                    
                    // $id=$user['id'];
                echo "
                <tr>
                    <td>$id</td>
                    <td>$username</td>
                    <td>$email</td>
                    <td>$fullname</td>
                    <td>$date</td>
                    <td class='member-buttons'> <a href=$alllinku class='btn btn-success my-1'>Edit</a>
                                <a href=$alllinkd class='btn btn-danger mx-md-3 my-1'>delete</a>";
                        if($user['reg_status']==0){
                            echo"<a href=$alllinka class='btn btn-info lastbut my-1'>Activate</a>";
                        }
                        if($user['reg_status']==1){
                            echo"<a href=$alllinknoa class='btn btn-secondary lastbut my-1'>Dis Activate</a>";
                        }
                    echo "</td>
                </tr>
                ";
                }
                ?>
                </tr>
            </tbody>
            </table>
            <a href="?do=add" class=" btn btn-primary btn-lg  "><i class="fa fa-plus "></i> Add User</a>
            <a href="dashbord.php" class=" btn btn-info btn-lg  "><i class="fa fa-home "></i> Home</a>
            
                </div>
                <?php
        break;
        //add link 
        case 'add':
                    ?>
            <div class="container ">
                <div class="text-center rounded">
                    <h1 styel="background-color:blue">
                        Edit Profile
                    </h1>
                </div>
                <form action="?do=insert" method="post" class="m-auto ">
                    <div class="form-group  mb-4"><label for="name" class=" text-center form-label ">Username</label><div class ="mx-md-5 "><input  class="form-control" type="text" name="name"  required='required'><span></span></div></div>
                    <div class="form-group  mb-4"><label for="pass" class=" text-center form-label ">Password</label><div class =" mx-md-5 "><input class="form-control" type="password" name="pass" ><span></span></div></div>
                    <div class="form-group  mb-4"><label for="email" class="text-center  form-label">Email   </label><div class =" mx-md-5 "><input  class="form-control" type="email" name="email"  required='required'><span></span></div></div>
                    <div class="form-group  mb-4"><label for="fullname" class="text-center form-label">Full Name</label><div class =" mx-md-5 "><input   class="form-control" type="text" name="fullname" required='required'><span></span></div></div>
                    <div class="form-group  mb-4 text-center buut"><input type="submit"class="btn btn-primary btn-lg" name="submit" value="submit"><span><a href="members.php?do=manage"  class="btn btn-info btn-lg" >Back</a></span></div></div>
                    
                </form>
            </div>
                <?php
                    
        
        break;
        case 'insert':
            
            if($_SERVER['REQUEST_METHOD']=="POST"&&$_POST['submit']=='submit')
            {
                
                if(!checkselect('username','users',$_POST['name']))
                {
                        echo "<h1 class='text-center'>Insert page</h1>";
                        
                        $pass=$_POST['pass'];
                        $hashpass=sha1($pass);
                        $name=$_POST['name'];
                        $email=$_POST['email'];
                        $fullname=$_POST['fullname'];
                        //form errors
                        $formerrors=array();
                        if(strlen($name)==0){
                            $formerrors[]="the username must be unempty";
                        }
                        
                        if(strlen($name)<4){
                            $formerrors[]="the username must be more than 3";
                        }
                        
                        if(strlen($email)==0){
                            $formerrors[]="the Email must be unempty";
                        }
                        
                        if(strlen($pass==0)){
                            $formerrors[]="the username must be unempty";
                        }
                        
                        if(strlen($pass)<4){
                            $formerrors[]="the username must be more than 3";
                        }
                        
                        if(empty($formerrors)){

                        
                        $stmt=$db->prepare("insert into users(username,password,email,fullname,date) values(?,?,?,?,now())");
                        $stmt->execute(array($name,$hashpass,$email,$fullname));
                        $count=$stmt->rowCount();
                        $themsg= "<p class='alert alert-success'>$count row created successfully</p>";
                        redirect($themsg,'back');
                        }else{
                            foreach($formerrors as $formerr){
                            echo "<div class='alert alert-danger'>$formerr</div>";}
                            echo "<br><br>";
                            $themsg="<div class='alert alert-info'>Try Agin</div>";
                            redirect($themsg,'back');
                        }
                        
                }else{
                    $themsg="<h1 class='alert alert-danger'>USE ANOTHER USERNAME</h1>";
                    redirect($themsg,'back');
                }
            }
            else{
                
                                $themsg="<h1 class='alert alert-danger'>ERROR</h1>";
                                redirect($themsg,'back');
            }

            
            
        break;
        case 'edit':
            
                        $id=isset($_GET['id'])&&is_numeric($_GET['id'])?intval($_GET['id']):0;
                        $stmt=$db->prepare("select * from users where id=?  limit 1 ");
                        $stmt->execute(array($id));
                        $row=$stmt->fetch();
                        $count=$stmt->rowCount();
                        if($count>0){
                        
                    ?>
            <div class="container ">
                <div class="text-center rounded">
                    <h1 styel="background-color:blue">
                        Edit Profile
                    </h1>
                </div>
                <form action="?do=update" method="post" class="m-auto ">
                    <div class="form-group  mb-4"><label for="name" class=" text-center form-label ">Username</label><div class ="mx-md-5 "><input  class="form-control" type="text" name="name" value="<?php echo $row['username']?>" required='required'><span></span></div></div>
                    <input class="form-control" type="hidden" name="oldpass" value="<?php echo $row['password']?>">
                    <input class="form-control" type="hidden" name="id" value="<?php echo $row['id']?>">
                    <div class="form-group  mb-4"><label for="pass" class=" text-center form-label ">Password</label><div class =" mx-md-5 "><input class="form-control" type="password" name="newpass" value=""><span></span></div></div>
                    <div class="form-group  mb-4"><label for="email" class="text-center  form-label">Email   </label><div class =" mx-md-5 "><input  class="form-control" type="email" name="email" value="<?php echo $row['email']?>" required='required'><span></span></div></div>
                    <div class="form-group  mb-4"><label for="fullname" class="text-center form-label">Full Name</label><div class =" mx-md-5 "><input   class="form-control" type="text" name="fullname" value="<?php echo $row['fullname']?>" required='required'><span></span></div></div>
                    <div class="form-group  mb-4 text-center buut"><input type="submit"class="btn btn-primary btn-lg" name="update" value="submit"><span><a href="members.php?do=manage"  class="btn btn-info btn-lg" >Back</a></span></div></div>
                </form>
            </div>
                <?php
                        }else{
                            $msg="wrong url";
                            redirect($msg ,'index.php',5);
                        }
            
        break;
        case 'update':
    
            echo "<h1 class='text-center'>update page</h1>";
            echo "<div class='container'>";
            
            if($_SERVER['REQUEST_METHOD']=="POST"&&$_POST['update']=='submit')
                {
                        
                    
                                if(strlen($_POST['newpass'])==0)
                                {
                                    $hashpass=$_POST['oldpass'];
                                }else{
                                    $pass=$_POST['newpass'];
                                    $hashpass=sha1($pass);
                                }
                                $id=$_POST['id'];
                                $name=$_POST['name'];
                                $email=$_POST['email'];
                                $fullname=$_POST['fullname'];
                                //form errors
                                $formerrors=array();
                                if(strlen($name)==0){
                                    $formerrors[]="the username must be unempty";
                                }
                                
                                if(strlen($name)<4){
                                    $formerrors[]="the username must be more than 3";
                                }
                                
                                if(strlen($email)==0){
                                    $formerrors[]="the Email must be unempty";
                                }
                                
                                if(strlen($pass==0)){
                                    $formerrors[]="the username must be unempty";
                                }
                                
                                if(strlen($pass)<4){
                                    $formerrors[]="the username must be more than 3";
                                }
                                
                                if(empty($formerrors)){

                                
                                    $stmt=$db->prepare("UPDATE users SET username = ? , password = ? , email = ? , fullname = ? where id = ?");
                                    $stmt->execute(array($name,$hashpass,$email,$fullname,$id));
                                    $count=$stmt->rowCount();
                                    $themsg="<p class='alert alert-success'>$count row updated successfully</p>";
                                    redirect($themsg,'back');
                                }else{
                                    foreach($formerrors as $formerr){
                                    echo "<div class='alert alert-danger'>$formerr</div>";
                                    }
                                    $themsg="<div class='alert alert-infor'>$formerr</div>";
                                    redirect($themsg,'back');
                                }
        }else{
            $themsg="<h1 class='alert alert-danger'>ERROR</h1>";
            redirect($themsg,'home');
            exit();
        }
        echo '</div>';

    break;
    case 'disactivate':
        if(isset($_GET['id'])){
            if(checkselect('id','users',$_GET['id'])){
                $stmt=$db->prepare("UPDATE users SET reg_status=0 where id=?");
                $stmt->execute(array($_GET['id']));
                $count=$stmt->rowCount();
                if ($count>0){
                    $themsg="<p class='alert alert-success'>$count row disactivated successfully</p>";
                    redirect($themsg,'back');
                }

            }else{
                $themsg="<h1 class='alert alert-danger'>NO SUCH ID</h1>";
                redirect($themsg,'home');
            }
        }

    break;
    case 'activate':
        if(isset($_GET['id'])){
            if(checkselect('id','users',$_GET['id'])){
                $stmt=$db->prepare("UPDATE users SET reg_status=1 where id=?");
                $stmt->execute(array($_GET['id']));
                $count=$stmt->rowCount();
                if ($count>0){
                    $themsg="<p class='alert alert-success'>$count row activated successfully</p>";
                    redirect($themsg,'back');
                }

            }else{
                $themsg="<h1 class='alert alert-danger'>NO SUCH ID</h1>";
                redirect($themsg,'home');
            }
        }

    break;
    case 'delete':
        if(isset($_GET['id'])){
            if(checkselect('id','users',$_GET['id'])){
                $stmt=$db->prepare("delete from users where id=?");
                $stmt->execute(array($_GET['id']));
                $count=$stmt->rowCount();
                if ($count>0){
                    $themsg="<p class='alert alert-success'>$count row deleted successfully</p>";
                    redirect($themsg,'back');
                }

            }else{
                $themsg="<h1 class='alert alert-danger'>NO SUCH ID</h1>";
                redirect($themsg,'home');
            }
        }
    break;
    default:
        $msg="wrong url";
        redirect($msg ,'index.php',5);
        exit();
}

}else{
    $msg="error";
    redirect($msg);
}
include_once $tmpl.'footer.php';
?>