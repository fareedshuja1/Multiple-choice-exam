<?php
ob_start();
session_start();

include "conn.php";
$config = new config();
include $config->absolute_path."includes/classes/database.php";
include $config->absolute_path."includes/classes/session.php";
include $config->absolute_path."includes/classes/users.php";
include $config->absolute_path."includes/classes/employees.php";
include $config->absolute_path."includes/classes/students.php";
include $config->absolute_path."includes/classes/courses.php";
include $config->absolute_path."includes/classes/menu.php";
include $config->absolute_path."includes/classes/mail.php";
include $config->absolute_path."includes/classes/general.php";
include $config->absolute_path."includes/classes/questions.php";
include $config->absolute_path."includes/classes/functions.php";

$database = new MySQLDatabase();
$db =& $database;

$session = new Session();
$message = $session->message();

$user = new User();
$employees = new Employees();
$students = new Students();
$courses = new Courses();
$menu = new Menu();
$general = new General();
$ques = new Questions();
$mail = new Mail();







?>