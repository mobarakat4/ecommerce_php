<?php
$tmpl='../includes/templates/';
$langs='../includes/langs/';
$funcs='../includes/functions/';
$css= 'layout/css/';
$js= 'layout/js/';



include_once $langs.'english.php';
include_once $funcs.'function.php';
include_once 'conn.php';
include $tmpl.'head.php';
if(!isset($navnothere)){
    include_once $tmpl.'navbar.php';
}
?>