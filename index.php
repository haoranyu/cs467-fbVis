<?php
function std_class_object_to_array($stdclassobject)
{
    $_array = is_object($stdclassobject) ? get_object_vars($stdclassobject) : $stdclassobject;
	$array = array();
    foreach ($_array as $key => $value) {
        $value = (is_array($value) || is_object($value)) ? std_class_object_to_array($value) : $value;
        $array[$key] = $value;
    }
    return $array;
}
session_start();
if(!isset($_POST['friends'])){
header('Location: login.php');
}
$contact = $_POST['friends'];
$contact = json_decode($contact);
$_SESSION['contact'] = $contact;

$data = $_POST['feeds'];
$data = std_class_object_to_array(json_decode($data));
$_SESSION['data'] = $data;

$date = array_keys($data);
$_SESSION['date'] = $date;
 
include("template.php");
?>
