<?php
session_start();

if (isset($_POST['name'])) {$_SESSION['user_name'] = $_POST['name'];}
if (isset($_POST['email'])) {$_SESSION['user_email'] = $_POST['email'];}
if (isset($_POST['id'])) {$_SESSION['user_id'] = $_POST['id'];}
if (isset($_POST['score'])) {$_SESSION['user_score'] = $_POST['score'];}

echo $_SESSION;
?>
