<?php
// get tile

function get_title(){
    global $title;
    if(isset($title)){
        echo $title;
    }else
    {
        echo "default";
    }
}


// checkselect
function checkselect($select,$from,$value){
    global $db;
    $stmt=$db->prepare("select $select from $from where $select = ?");
    $stmt->execute(array($value));
    $row=$stmt->fetch();
    $count=$stmt->rowCount();
    return $count;

}
function checkselectwithkey($select,$from,$key,$value){
    global $db;
    $stmt=$db->prepare("select $select from $from where $key = ?");
    $stmt->execute(array($value));
    $row=$stmt->fetch();
    $count=$stmt->rowCount();
    return $count;

}
function checkselectwithkeyforactive($select,$from,$key,$value ,$id){
    global $db;
    $stmt=$db->prepare("select $select from $from where $key = ? AND id=?");
    $stmt->execute(array($value,$id));
    $row=$stmt->fetch();
    $count=$stmt->rowCount();
    return $count;

}

//select all
function select($select,$from){
    global $db;
    $stmt=$db->prepare("select $select from $from ");
    $stmt->execute();
    $row=$stmt->fetchall();
    return $row;
}
//select one column from table wher column
function selectonerow($select,$from,$value){
    global $db;
    $stmt=$db->prepare("select $select from $from where $select=?");
    $stmt->execute(array($value));
    $row=$stmt->fetchall();
    return $row;
}
function selectcolwithkey($select,$from,$key,$value){
    global $db;
    $stmt=$db->prepare("select $select from $from where $key=?");
    $stmt->execute(array($value));
    $row=$stmt->fetchall();
    return $row;
}

// redirect function
function redirect($msg,$to="null",$time=3){
    if($to===null){
        $link='index.php';
    }elseif($to=='back'&&isset( $_SERVER["HTTP_REFERER"])){
        $link= $_SERVER["HTTP_REFERER"];
    }elseif($to=='home'){
        $link='index.php';
    }else{
        $link=$to;
    }
    echo $msg;
    echo "<br>";
    echo "<p class='alert alert-info'>"."you will redirected in $time seconds";
    header("Refresh: $time; URL=$link");
    
}
//redirect immediately
function redirectback(){
    $link=$_SERVER['HTTP_REFERER'];
    header("location:$link");
}
function counitems($item,$from){
    global $db;
    $stmt=$db->prepare("SELECT COUNT($item) from $from ");
    $stmt->execute();
    $row=$stmt->fetchcolumn();
    return $row;
}
function counitemswhere($item,$from,$key,$value){
    global $db;
    $stmt=$db->prepare("SELECT COUNT($item) from $from where $key=? ");
    $stmt->execute(array($value));
    $row=$stmt->fetchcolumn();
    return $row;
}
//select latest 
function selectlatest($select,$from,$limit=5){
    global $db;
    $stmt=$db->prepare("select $select from $from ORDER BY id DESC limit $limit");
    $stmt->execute();
    $row=$stmt->fetchall();
    return $row;
}
//funcion ordered by
function selectOrderBy($select,$from,$order){
    global $db;
    $stmt=$db->prepare("select $select from $from order by $order");
    $stmt->execute();
    $row=$stmt->fetchall();
    return $row;
}