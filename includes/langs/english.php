<?php 
function lang($word){
    $lang=array(
    //homepage
    'home' => 'Home Page',
    'message' => 'Welcome',
    'admin' => 'Adminstrator',
    //footer
    'about' => 'About',
    'services' => 'Services',
    //navbar
    'adminhome' =>'Admin Aria',
    'categories' =>'Catigories',
    'items' =>'Items',
    'members' =>'Members',
    'comments' =>"Comments",
    'stats' =>'Statistics',
    'logs' =>'Logs',
    'edit profile' =>'Edit Profile',
    'setting' =>'Setting',
    'log out' =>'Logout'

    
);
return $lang[$word];
}
?>
