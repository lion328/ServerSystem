<?
	session_start();
	session_destroy();;
	/*session_unset($_SESSION["id"]);
	session_unset($_SESSION["username"]);
	session_unset($_SESSION["password"]);
	session_unset($_SESSION["status"]);
	session_unset($_SESSION["money"]);*/
?>
<!doctype html>
<html>
<head>
<title>SERVER SYSTEM : LOGOUT</title>
<meta http-equiv="content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="css/style.css" type="text/css">
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" media="screen">
<script type="text/javascript" src="js/jquery.min.js"></script>
</head>
<body>
<body>
<br>
<div class="container2 shadow whitebg borderrad">
<form method="post" action="" class="form-horizontal">
<input type="hidden" name="action" value="login">
<fieldset>
<legend>
<h1>LOGOUT</h1>
</legend>
</fieldset>
<?
require_once("function/func_static.php");
$error = greenBox("Logout success.","login.php");
if($error != "")
{
	echo "<tr><td>";
	echo $error;
	echo "</tr></td></table>";
	exit();
}
?>
</body>
</html>