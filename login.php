<?
session_start();
if(isset($_SESSION["id"]))
{
	header("location:index.php");
}
if($_SESSION["id"] != "")
{
	header("location:index.php");
}
if(!file_exists("installed"))
{
	header("location:install.php");
}
?>
<!doctype html>
<html>
<head>
<title>SERVER SYSTEM : LOGIN</title>
<meta http-equiv="content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="css/style.css" type="text/css">
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" media="screen">
<script type="text/javascript" src="js/jquery.min.js"></script>
</head>
<body>
<br>
<div class="container2 shadow whitebg borderrad">
<form method="post" name="mainform" action="" class="form-horizontal">
<input type="hidden" name="act" value="">
<fieldset>
<legend>
<h1>LOGIN</h1>
</legend>
</fieldset>
<div>
<?
if(isset($_POST['act']) && $_POST['act'] == 'login')
{
	require_once("function/func_connect.php");
	require_once("function/func_static.php");
	$objLogin = checkPassword($_POST['log_user'],$_POST['log_pass']);
	if($objLogin == false)
	{
		$error = redBox("Your username or password incorrect.");
	}
	if($error != "")
	{
		echo "<tr><td>";
		echo $error;
		echo "</tr></td></table>";
		exit();
	}
	if($objLogin == true)
	{
		$strSQL = "SELECT * FROM authme WHERE username = '".$_POST['log_user']."'";
		$objQuery = mysql_query($strSQL);
		$objResult = mysql_fetch_array($objQuery);
		$error = greenBox("Login success.","index.php");
		$_SESSION["id"] = $objResult["id"];
		$_SESSION["username"] = $objResult["username"];
		$_SESSION["status"] = $objResult["status"];
		$_SESSION["money"] = $objResult2["balance"];
		session_write_close();
		echo "<tr><td>";
		echo $error;
		echo "</td></tr></table>";
		exit();
	}
	mysql_close();
}
?>
<label class="control-label">Username :</label><div class="controls"><input type="text" name="log_user"></div>
<br>
<label class="control-label">Password :</label><div class="controls"><input type="password" name="log_pass"></div>
<br>
<div class="controls" align="center"><input type="button" class="btn" value="Register" onclick="window.location='register.php'">&nbsp;<input type="submit" class="btn btn-success" value="Login" onclick="mainform.act.value='login';mainform.submit();"></div>
</div>
</form>
</div>
<br>
</body>
</html>