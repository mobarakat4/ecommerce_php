<?php
$title='Categories';
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
                <h1 class="text-center head-manager rounded container-md">Manage Categories</h1>
            </div>
            <div class="table-responsive container-md ">
            <table class="container table table-bordered main-table">
                <thead class="">
                    <tr>
                        <th>ID</th>
                        <th> Name</th>
                        <th>Desciption</th>
                        <th>ordering</th>
                        <th>Reg Date</th>
                        <th>Options</th>
                
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
                $row=selectOrderBy('*','cat','ordering');
                // links for update and 
                $linkd='?do=delete&id=';
                $linku='?do=edit&id=';


                foreach($row as $cat){
                    //for register status select
                    
                    //define val
                    $id=$cat['id'];
                    $name=$cat['name'];
                    $desc=$cat['description'];
                    $order=$cat['ordering'];
                    $date=$cat['date'];
                    //forlink
                    $alllinku="$linku$id";
                    $alllinkd="$linkd$id";

                    
                    // $id=$user['id'];
                echo "
                <tr>
                    <td>$id</td>
                    <td>$name</td>
                    <td>$desc</td>
                    <td>$order</td>
                    <td>$date</td>
                    <td class='member-buttons'> <a href=$alllinku class='btn btn-success my-1'>Edit</a>
                                <a href=$alllinkd class='btn btn-danger mx-md-3 my-1'>delete</a>";
                    echo "</td>
                </tr>
                ";
                }
                ?>
                </tr>
            </tbody>
            </table>
            <a href="?do=add" class=" btn btn-primary btn-lg  m-2 "><i class="fa fa-plus"></i> Add Category</a>
            <a href="Dashbord.php"  class="btn btn-info btn-lg px-4" >Home</a>
                </div>
                <?php
        break;
        //add link 
        case 'add':
            
        
                    ?>
            <div class="container ">
                <div class="text-center rounded">
                    <h1 styel="background-color:blue">
                        Create Categories
                    </h1>
                </div>
                <form action="?do=insert" method="post" class="m-auto ">
                    <div class="form-group  mb-4"><label for="name" class=" text-center form-label ">Name</label><div class ="mx-md-5 "><input  class="form-control" type="text" name="name"  required='required'><span></span></div></div>
                    <div class="form-group  mb-4"><label for="fullname" class="text-center form-label">Description</label><div class =" mx-md-5 "><input   class="form-control" type="text" name="desc" ><span></span></div></div>
                    <div class="form-group  mb-4"><label for="fullname" class="text-center form-label">Ordering</label><div class =" mx-md-5 "><input   class="form-control" type="text" name="order" required='required'><span></span></div></div>
                    <div class="form-group  mb-4"><label for="fullname" class="text-center form-label">visibilty</label><div class =" mx-md-5 "><div class="form-check">
                                            <input class="form-check-input" type="radio" name="visible" value=1 id="" >
                                            <label class="form-check-label" for="flexRadioDisabled">
                                            Yes
                                            </label>
                                            </div>
                                            <div class="form-check">
                                            <input class="form-check-input" type="radio" name="visible" value=0 id="" checked >
                                            <label class="form-check-label" for="flexRadioCheckedDisabled">
                                            NO
                                            </label>
                                            </div><span></span></div></div>
                    <div class="form-group  mb-4"><label for="fullname" class="text-center form-label">Allow Ads</label><div class =" mx-md-5 "><div class="form-check">
                                            <input class="form-check-input" type="radio" value=1 name="ads"  >
                                            <label class="form-check-label" >
                                            Yes
                                            </label>
                                            </div>
                                            <div class="form-check">
                                            <input class="form-check-input" type="radio" value=0 name="ads"  checked>
                                            <label class="form-check-label" >
                                            NO
                                            </label>
                                            </div><span></span></div></div>
                    <div class="form-group  mb-4"><label for="fullname" class="text-center form-label">Allow Commenets</label><div class =" mx-md-5 "><div class="form-check">
                                            <input class="form-check-input" type="radio" value=1 name="comment" >
                                            <label class="form-check-label" >
                                            Yes
                                            </label>
                                            </div>
                                            <div class="form-check">
                                            <input class="form-check-input" type="radio" value=0 name="comment" checked >
                                            <label class="form-check-label" >
                                            NO
                                            </label>
                                            </div><span></span></div></div>
                    <div class="form-group  mb-4 text-center buut"><input type="submit"class="btn btn-primary btn-lg" name="submit" value="create"><span><a href="categories.php?do=manage"  class="btn btn-info btn-lg" >Back</a></span></div></div>
                    
                    
                </form>
            </div>
                <?php
                    
        
        break;
        case 'insert':
            
            if($_SERVER['REQUEST_METHOD']=="POST"&&$_POST['submit']=='create')
            {
                
                if(!checkselect('name','cat',$_POST['name']))
                {
                        echo "<h1 class='text-center'>Insert page</h1>";
                        
                        
                        $name=$_POST['name'];
                        $desc=$_POST['desc'];
                        $order=$_POST['order'];
                        $visible=$_POST['visible'];
                        $comment=$_POST['comment'];
                        $ads=$_POST['ads'];
                        
                        //form errors
                        $formerrors=array();
                        if(strlen($name)==0){
                            $formerrors[]="the username must be unempty";
                        }
                        
                        if(strlen($name)<4){
                            $formerrors[]="the username must be more than 3";
                        }
                        
                        
                        if(empty($formerrors)){
                        
                        $stmt=$db->prepare("insert into cat(name,description,ordering,visible,allow_comment,allow_adds,date) values(?,?,?,?,?,?,now())");
                        $stmt->execute(array($name,$desc,$order,$visible,$comment,$ads));
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
                    $themsg="<h1 class='alert alert-danger'>USE ANOTHER NAME</h1>";
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
                        $stmt=$db->prepare("select * from cat where id=?  limit 1 ");
                        $stmt->execute(array($id));
                        $row=$stmt->fetch();
                        $count=$stmt->rowCount();
                        if($count>0){
                        
                    ?>
            <div class="container ">
                <div class="text-center rounded">
                    <h1 styel="background-color:blue">
                        Edit category
                    </h1>
                </div>
                <form action="?do=update" method="post" class="m-auto ">
                    <div class="form-group  mb-4"><label for="name" class=" text-center form-label ">Name</label><div class ="mx-md-5 "><input  class="form-control" type="text" name="name" value="<?php echo $row['name']?>" required='required'><span></span></div></div>
                    <div class="form-group  mb-4"><label for="fullname" class="text-center form-label">Description</label><div class =" mx-md-5 "><input   class="form-control" type="text" name="desc" value="<?php echo $row['description']?>" required='required'><span></span></div></div>
                    <div class="form-group  mb-4"><label for="fullname" class="text-center form-label">Ordering</label><div class =" mx-md-5 "><input   class="form-control" type="number" name="order" value="<?php echo $row['ordering']?>" required='required'><span></span></div></div>
                    <input class="form-control" type="hidden" name="id" value="<?php echo $row['id']?>">
                    <div class="form-group  mb-4"><label for="fullname" class="text-center form-label">visibilty</label><div class =" mx-md-5 "><div class="form-check">
                                            <input class="form-check-input" type="radio" name="visible" value=1 id=""<?php echo $row['visible']==1?'checked':'' ?> >
                                            <label class="form-check-label" for="flexRadioDisabled">
                                            Yes
                                            </label>
                                            </div>
                                            <div class="form-check">
                                            <input class="form-check-input" type="radio" name="visible" value=0 id="" <?php echo $row['visible']==0?'checked':'' ?> >
                                            <label class="form-check-label" for="flexRadioCheckedDisabled">
                                            NO
                                            </label>
                                            </div><span></span></div></div>
                    <div class="form-group  mb-4"><label for="fullname" class="text-center form-label">Allow Ads</label><div class =" mx-md-5 "><div class="form-check">
                                            <input class="form-check-input" type="radio" value=1 name="ads"  <?php echo $row['allow_adds']==1?'checked':'' ?>>
                                            <label class="form-check-label" >
                                            Yes
                                            </label>
                                            </div>
                                            <div class="form-check">
                                            <input class="form-check-input" type="radio" value=0 name="ads"  <?php echo $row['allow_adds']==0?'checked':'' ?>>
                                            <label class="form-check-label" >
                                            NO
                                            </label>
                                            </div><span></span></div></div>
                    <div class="form-group  mb-4"><label for="fullname" class="text-center form-label">Allow Commenets</label><div class =" mx-md-5 "><div class="form-check">
                                            <input class="form-check-input" type="radio" value=1 name="comment" <?php echo $row['allow_comment']==0?'checked':'' ?> >
                                            <label class="form-check-label" >
                                            Yes
                                            </label>
                                            </div>
                                            <div class="form-check">
                                            <input class="form-check-input" type="radio" value=0 name="comment" <?php echo $row['allow_comment']==0?'checked':'' ?> >
                                            <label class="form-check-label" >
                                            NO
                                            </label>
                                            </div><span></span></div></div>
                    <div class="form-group  mb-4 text-center buut"><input type="submit"class="btn btn-primary btn-lg" name="submit" value="update"><span><a href="categories.php?do=manage"  class="btn btn-info btn-lg" >Back</a></span></div></div>
                    
                    
                </form>
            </div>
                <?php
                        }else{
                            $msg="wrong url";
                            redirect($msg ,'index.php',5);
                        }
            
        break;
        case 'update':
    
            echo "<h1 class='text-center'>Update Page</h1>";
            echo "<div class='container'>";
            
            if($_SERVER['REQUEST_METHOD']=="POST")
                {
                    if(checkselect('name','cat',$_POST['name']))
                {
                    $themsg="<h1 class='alert alert-danger'>Choose another name </h1>";
                    redirect($themsg,'back');
                    exit();
                }
                            $id=$_POST['id'];
                            $name=$_POST['name'];
                            $desc=$_POST['desc'];
                            $order=$_POST['order'];
                            $visible=$_POST['visible'];
                            $comment=$_POST['comment'];
                            $ads=$_POST['ads'];
                            
                            //form errors
                            $formerrors=array();
                            if(strlen($name)==0){
                                $formerrors[]="the username must be unempty";
                            }
                            
                            if(strlen($name)<4){
                                $formerrors[]="the username must be more than 3";
                            }
                                if(empty($formerrors)){

                                
                                    $stmt=$db->prepare("UPDATE cat SET name = ? , description = ? , ordering = ? , visible = ? , allow_comment=? , allow_adds=? where id = ?");
                                    $stmt->execute(array($name,$desc,$order,$visible,$comment,$ads,$id));
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
    case 'delete':
        if(isset($_GET['id'])){
            if(checkselect('id','cat',$_GET['id'])){
                $stmt=$db->prepare("delete from cat where id=?");
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