<?php
include "functions.php";
session_start();
if ($_POST['submit'] != "OK" || $_POST['login'] == "" || $_POST['passwd'] == "")
	exit ("ERROR CREATE_USER (form empty or partially)\n");
else
{
	if (check_form($_POST['login']) != FALSE && check_form($_POST['passwd']) != FALSE)
	{
		if (!$db = db_init())
		{
			$_SESSION['msg'] = "DB Unloaded";
			header("Location: index.php");
			exit ("DB unloaded\n");
		}
		print_r($db);
		if (query_get_one_user($db, $_POST['login']) == FALSE)
		{
			$_SESSION['msg'] = "User already exist";
			header("Location: register.php");
			exit ();
		}
		else
		{
			$passwd = hash("whirlpool", $_POST['passwd']);
			if (query_add_new_user($db, $_POST['login'], $passwd) == FALSE)
			{
				$_SESSION['msg'] = "FAILED TO ADD USER IN DB";
				header("Location: register.php");
				exit ();
			}
			$_SESSION['msg'] = "SUCCESS";
			header("Location: index.php");
			exit ();
		}
	}
	$_SESSION['msg'] = "WRONG FORMAT";
	header("Location: register.php");
	exit ();
}
?>
