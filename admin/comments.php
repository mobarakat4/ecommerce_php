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
                <h1 class="text-center head-manager rounded container-md">Manage Comments</h1>
            </div>
            <div class="table-responsive container-md ">
            <table class="container table table-bordered main-table">
                <thead class="">
                    <tr>
                        <th>ID</th>
                        <th>Comment</th>
                        <th>User Name</th>
                        <th>Item Name</th>
                        <th>Comment Date</th>
                        <th>Options</th>
                
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
                // $row=select('*','comments');
                $stmt=$db->prepare("
                                select comments.*,users.username , cat.name As itemname
                                from ((comments
                                inner join  users  on users.id = comments.id )
                                inner join  items  on items.id = comments.id )
                                ");
                $stmt->execute(array($value));
                $row=$stmt->fetchall();
                // links for update and 
                $linkd='?do=delete&id=';
                $linku='?do=edit&id=';
                $linka='?do=approve&id=';
                $linknoa='?do=disapprove&id=';


                foreach($row as $item){
                    //for register status select
                    
                    //define val
                    $id=$item['id'];
                    $comment=$item['comment'];
                    $username=$item['user_id'];
                    $itemname=$item['item_id'];
                    $date=$item['date'];
                    //forlink
                    $alllinku="$linku$id";
                    $alllinkd="$linkd$id";
                    $alllinka="$linka$id";
                    $alllinknoa="$linknoa$id";

                    
                    // $id=$user['id'];
                echo "
                <tr>
                    <td>$id</td>
                    <td>$comment</td>
                    <td>$username</td>
                    <td>$itemname</td>
                    <td>$date</td>
                    <td class='member-buttons'> <a href=$alllinku class='btn btn-success my-1'>Edit</a>
                                <a href=$alllinkd class='btn btn-danger mx-md-3 my-1'>delete</a>";
                                if($item['status']==0){
                                    echo"<a href=$alllinka class='btn btn-info lastbut my-1'>Approve</a>";
                                }
                                if($item['status']==1){
                                    echo"<a href=$alllinknoa class='btn btn-secondary lastbut my-1'>Dis Approve</a>";
                                }
                    echo "</td>
                </tr>
                ";
                }
                ?>
                </tr>
            </tbody>
            </table>
            <!-- <a href="?do=add" class=" btn btn-primary btn-lg  m-2 "><i class="fa fa-plus"></i> Add Item</a> -->
            <a href="Dashbord.php"  class="btn btn-info btn-lg px-4" >Home</a>
                </div>
                <?php
        break;
    
        case 'edit':
            
                        $id=isset($_GET['id'])&&is_numeric($_GET['id'])?intval($_GET['id']):0;
                        $stmt=$db->prepare("select * from items where id=?  limit 1 ");
                        $stmt->execute(array($id));
                        $row=$stmt->fetch();
                        $count=$stmt->rowCount();
                        if($count>0){
                        
                    ?>
            <div class="container ">
                <div class="text-center rounded">
                    <h1 styel="background-color:blue">
                        Edit Item
                    </h1>
                </div>
                <form action="?do=insert" method="post" class="m-auto ">
                    <div class="form-group  mb-4"><label for="name" class=" text-center form-label ">Name</label><div class ="mx-md-5 "><input placeholder="Name of the item" value="<?php echo $row['name'] ?>" autocomplete="off" class="form-control" type="text" name="name"  required='required'><span></span></div></div>
                    <div class="form-group  mb-4"><label  class="text-center form-label">Description</label><div class =" mx-md-5 "><input placeholder="description of the item" value="<?php echo $row['description'] ?>" autocomplete="off" class="form-control" type="text" name="desc" ><span></span></div></div>
                    <div class="form-group  mb-4"><label  class="text-center form-label">Price</label><div class =" mx-md-5 "><input placeholder="Price of the item" value="<?php echo $row['price'] ?>" autocomplete="off" class="form-control" type="text" name="price" required='required'><span></span></div></div>
                    <div class="form-group  mb-4"><label  class="text-center form-label">Country</label><div class =" mx-md-5 "><input placeholder="country of made the item" value="<?php echo $row['country_made'] ?>" autocomplete="off" class="form-control" type="text" name="country" required='required'><span></span></div></div>
                    <div class="form-group  mb-4 ">
                        <label for="fullname" class="text-center form-label">Status</label>
                        <div class =" mx-md-5  row">
                            <select class=" form-control form-select form-select-sm" style="width:2000px;" name="status">
                                <option value="0" >Select</option>
                                <option value="1" <?php echo ($row['status']==1)?"selected":""?>>New</option>
                                <option value="2" <?php echo ($row['status']==2)?"selected":""?>>Like new</option>
                                <option value="3" <?php echo ($row['status']==3)?"selected":""?>>Used</option>
                                <option value="4" <?php echo ($row['status']==4)?"selected":""?>>Very old</option>
                            </select>
                        </div>

                    </div>
                    <div class="form-group  mb-4 ">
                        <label for="fullname" class="text-center form-label">Member</label>
                        <div class =" mx-md-5  row">
                            <select class=" form-control form-select form-select-sm" style="width:2000px;" name="status">
                                <option value="0">Select</option>
                                <?php
                                    $rows=select('*','users');

                                    foreach($rows as $ro){
                                        $id=$ro['id'];
                                        $name=$ro['username'];
                                        echo "<option value='{$id}'";
                                        
                                        echo ($row['member_id']==$id)?"selected":"";
                                        echo">".$name."</option>";
                                    }
                                ?>
                            </select>
                        </div>

                    </div>
                    <div class="form-group  mb-4 ">
                        <label for="fullname" class="text-center form-label">Category</label>
                        <div class =" mx-md-5  row">
                            <select class=" form-control form-select form-select-sm" style="width:2000px;" name="cat">
                                <option >Select</option>
                                <?php
                                    $rows=select('*','cat');
                                    
                                    foreach($rows as $ro){
                                        $id=$ro['id'];
                                        $name=$ro['name'];
                                        echo "<option value='{$id}'";
                                        echo ($row['cat_id']==$id)?"selected":"";
                                        echo ">$name</option>";
                                    }
                                ?>
                            </select>
                        </div>

                    </div>
                    <br>

                    <br>

                    <br>
                    
                    <div class="form-group  mb-4 text-center buut"><input type="submit"class="btn btn-primary btn-lg" name="submit"><span><a href="items.php?do=manage"  class="btn btn-info btn-lg" >Back</a></span></div></div>


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
            if(checkselect('id','items',$_GET['id'])){
                $stmt=$db->prepare("delete from items where id=?");
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
    case 'approve':
        if(isset($_GET['id'])){
            if(checkselect('id','items',$_GET['id'])){
                $stmt=$db->prepare("UPDATE items SET approve=1 where id=?");
                $stmt->execute(array($_GET['id']));
                $count=$stmt->rowCount();
                if ($count>0){
                    $themsg="<p class='alert alert-success'>$count item approved successfully</p>";
                    redirect($themsg,'back');
                }

            }else{
                $themsg="<h1 class='alert alert-danger'>NO SUCH ID</h1>";
                redirect($themsg,'home');
            }
        }
        break;
    case 'disapprove':
        echo "disapprove";
        if(isset($_GET['id'])){
            if(checkselect('id','items',$_GET['id'])){
                $stmt=$db->prepare("UPDATE items SET approve=0 where id=?");
                $stmt->execute(array($_GET['id']));
                $count=$stmt->rowCount();
                if ($count>0){
                    $themsg="<p class='alert alert-success'>$count item disapproved successfully</p>";
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